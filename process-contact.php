<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/mailer.php';

// Only allow POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Method not allowed.']);
    } else {
        header('Location: ' . site_url('contact.php'));
    }
    exit;
}

$isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

// 1. Honeypot check (anti-bot)
if (!empty($_POST['_eb_hp_website']) || !empty($_POST['website_hp'])) {
    // Silent fail for bots
    if ($isAjax) {
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Your transmission has been queued.']);
    } else {
        header('Location: ' . site_url('contact.php?status=sent'));
    }
    exit;
}

// 2. CSRF Token Verification
$submittedCsrf = $_POST['csrf_token'] ?? '';
if (!verify_csrf_token($submittedCsrf)) {
    http_response_code(403);
    if ($isAjax) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Security token invalid or expired. Please refresh the page.']);
    } else {
        header('Location: ' . site_url('contact.php?status=csrf_error'));
    }
    exit;
}

// 3. Rate Limiting Check (Simple session-based & IP hash)
$clientIp = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
$ipHash = hash('sha256', $clientIp . 'eb_salt_2026');
$currentTime = time();

if (!isset($_SESSION['last_inquiry_time'])) {
    $_SESSION['last_inquiry_time'] = 0;
}

if ($currentTime - $_SESSION['last_inquiry_time'] < 8) {
    http_response_code(429);
    if ($isAjax) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Please wait a moment before sending another inquiry.']);
    } else {
        header('Location: ' . site_url('contact.php?status=rate_limited'));
    }
    exit;
}

// 4. Sanitize and Validate Input Fields
$fullName = trim((string)($_POST['name'] ?? ''));
$email = trim((string)($_POST['email'] ?? ''));
$organization = trim((string)($_POST['organization'] ?? ''));
$phone = trim((string)($_POST['phone'] ?? ''));
$discipline = trim((string)($_POST['service'] ?? $_POST['discipline'] ?? 'General Inquiry'));
$budgetTier = trim((string)($_POST['budget_tier'] ?? 'Standard'));
$message = trim((string)($_POST['message'] ?? ''));

$errors = [];

if (mb_strlen($fullName) < 2 || mb_strlen($fullName) > 100) {
    $errors[] = 'Please provide your valid name.';
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 120) {
    $errors[] = 'Please provide a valid email address.';
}

if (mb_strlen($phone) < 7 || mb_strlen($phone) > 30) {
    $errors[] = 'Please provide a valid Phone or WhatsApp number.';
}

if (mb_strlen($message) < 10 || mb_strlen($message) > 5000) {
    $errors[] = 'Please provide details about your project scope or message (minimum 10 characters).';
}

if (!empty($errors)) {
    http_response_code(422);
    if ($isAjax) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => implode(' ', $errors)]);
    } else {
        header('Location: ' . site_url('contact.php?status=invalid'));
    }
    exit;
}

// 5. Structure Record for Persistent Storage
$record = [
    'timestamp' => date('c'),
    'ip_hash' => $ipHash,
    'full_name' => htmlspecialchars($fullName, ENT_QUOTES | ENT_HTML5, 'UTF-8'),
    'email' => htmlspecialchars($email, ENT_QUOTES | ENT_HTML5, 'UTF-8'),
    'organization' => htmlspecialchars($organization, ENT_QUOTES | ENT_HTML5, 'UTF-8'),
    'phone' => htmlspecialchars($phone, ENT_QUOTES | ENT_HTML5, 'UTF-8'),
    'discipline' => htmlspecialchars($discipline, ENT_QUOTES | ENT_HTML5, 'UTF-8'),
    'budget_tier' => htmlspecialchars($budgetTier, ENT_QUOTES | ENT_HTML5, 'UTF-8'),
    'message' => htmlspecialchars($message, ENT_QUOTES | ENT_HTML5, 'UTF-8')
];

$storageFilePath = get_inquiry_storage_path();

// Fail safely: Never write to web-accessible locations if secure storage path cannot be resolved
if ($storageFilePath === null) {
    error_log('[SECURITY ALERT] Secure inquiry storage location is unavailable or not writable.');
    http_response_code(500);
    if ($isAjax) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Transmission queue temporarily unavailable. Please email directly.']);
    } else {
        header('Location: ' . site_url('contact.php?status=storage_error'));
    }
    exit;
}

$jsonLine = json_encode($record, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "\n";

// Append with exclusive write lock
$saved = @file_put_contents($storageFilePath, $jsonLine, FILE_APPEND | LOCK_EX);

if ($saved === false) {
    error_log('[ERROR] Failed writing inquiry record to secure storage.');
    http_response_code(500);
    if ($isAjax) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Unable to save inquiry. Please email directly.']);
    } else {
        header('Location: ' . site_url('contact.php?status=error'));
    }
    exit;
}

// Update session cooldown and rotate CSRF token
$_SESSION['last_inquiry_time'] = $currentTime;
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));

// 6. Dispatch Email Notification (Authenticated SMTP with automatic mail() fallback)
$emailDispatched = send_inquiry_notification([
    'timestamp' => $record['timestamp'],
    'full_name' => $fullName,
    'email' => $email,
    'organization' => $organization,
    'phone' => $phone,
    'discipline' => $discipline,
    'budget_tier' => $budgetTier,
    'raw_message' => $message
]);

// 7. Optional: Webhook Dispatch for Real-Time Notifications (e.g. Discord, Slack, Zapier, Formspree)
$webhookUrl = getenv('CONTACT_WEBHOOK_URL') ?: (getenv('WEBHOOK_URL') ?: null);
if ($webhookUrl && filter_var($webhookUrl, FILTER_VALIDATE_URL)) {
    $payload = json_encode([
        'event' => 'new_inquiry',
        'site' => 'Engineer Baah',
        'timestamp' => $record['timestamp'],
        'name' => $fullName,
        'email' => $email,
        'phone' => $phone,
        'organization' => $organization,
        'discipline' => $discipline,
        'budget_tier' => $budgetTier,
        'message' => $message
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/json\r\nAccept: application/json\r\n",
            'content' => $payload,
            'timeout' => 3,
            'ignore_errors' => true
        ]
    ]);
    @file_get_contents($webhookUrl, false, $context);
}

if ($isAjax) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'message' => 'Thank you. Your message has been received. Engineer Baah will review your details and respond promptly.'
    ]);
} else {
    header('Location: ' . site_url('contact.php?status=success'));
}
exit;

