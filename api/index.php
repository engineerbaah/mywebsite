<?php
declare(strict_types=1);

/**
 * Engineer Baah — Vercel Serverless Entry Point & Front Controller
 * Handles routing on Vercel's serverless runtime (vercel-php).
 */

$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$path = parse_url($requestUri, PHP_URL_PATH) ?: '/';
$path = trim($path, '/');

// Root request -> Homepage
if ($path === '' || $path === 'index.php') {
    $_SERVER['SCRIPT_NAME'] = '/index.php';
    require __DIR__ . '/../index.php';
    exit;
}

// Route mapping table
$routes = [
    // Primary Pages
    'capabilities' => 'capabilities.php',
    'capabilities.php' => 'capabilities.php',
    'work' => 'work.php',
    'work.php' => 'work.php',
    'about' => 'about.php',
    'about.php' => 'about.php',
    'contact' => 'contact.php',
    'contact.php' => 'contact.php',
    'privacy' => 'privacy.php',
    'privacy.php' => 'privacy.php',
    'terms' => 'terms.php',
    'terms.php' => 'terms.php',
    'process-contact.php' => 'process-contact.php',
    'service.php' => 'service.php',

    // Dedicated Service Pages
    'services/web-engineering-development' => 'services/web-engineering-development.php',
    'services/web-engineering-development.php' => 'services/web-engineering-development.php',
    'services/brand-identity-digital-experience-design' => 'services/brand-identity-digital-experience-design.php',
    'services/brand-identity-digital-experience-design.php' => 'services/brand-identity-digital-experience-design.php',
    'services/digital-strategy-marketing' => 'services/digital-strategy-marketing.php',
    'services/digital-strategy-marketing.php' => 'services/digital-strategy-marketing.php',
    'services/it-solutions-technology-management' => 'services/it-solutions-technology-management.php',
    'services/it-solutions-technology-management.php' => 'services/it-solutions-technology-management.php',

    // Error handler
    '404' => '404.php',
    '404.php' => '404.php'
];

if (isset($routes[$path])) {
    $targetFile = realpath(__DIR__ . '/../' . $routes[$path]);
    if ($targetFile && file_exists($targetFile)) {
        $_SERVER['SCRIPT_NAME'] = '/' . $routes[$path];
        require $targetFile;
        exit;
    }
}

// Fallback for static assets requested via function
$staticCandidate = realpath(__DIR__ . '/../' . $path);
$appRoot = realpath(__DIR__ . '/..');
if ($staticCandidate && $appRoot && strpos($staticCandidate, $appRoot) === 0 && file_exists($staticCandidate) && is_file($staticCandidate)) {
    $ext = strtolower(pathinfo($staticCandidate, PATHINFO_EXTENSION));
    $mimes = [
        'css' => 'text/css; charset=utf-8',
        'js' => 'application/javascript; charset=utf-8',
        'webp' => 'image/webp',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'svg' => 'image/svg+xml',
        'ico' => 'image/x-icon',
        'xml' => 'application/xml; charset=utf-8',
        'txt' => 'text/plain; charset=utf-8'
    ];
    if (isset($mimes[$ext])) {
        header('Content-Type: ' . $mimes[$ext]);
        header('Cache-Control: public, max-age=31536000, immutable');
        readfile($staticCandidate);
        exit;
    }
}

// Unmatched route -> Render 404 page
$_SERVER['SCRIPT_NAME'] = '/404.php';
http_response_code(404);
require __DIR__ . '/../404.php';
exit;

