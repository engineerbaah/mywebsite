<?php
declare(strict_types=1);

/**
 * Engineer Baah — Production Email Delivery Engine
 * Supports Authenticated SMTP (SSL 465 / STARTTLS 587) with automatic fallback to PHP mail().
 */

/**
 * Strip CR/LF characters to prevent email header injection
 */
function sanitize_email_header(string $value): string {
    return trim(str_replace(["\r", "\n", "\0"], '', $value));
}

/**
 * Send an inquiry notification email to SITE_EMAIL
 *
 * @param array<string, string> $inquiry
 * @return bool
 */
function send_inquiry_notification(array $inquiry): bool {
    $toEmail = getenv('NOTIFY_EMAIL') ?: SITE_EMAIL;
    $clientName = sanitize_email_header($inquiry['full_name'] ?? 'Website Visitor');
    $clientEmail = sanitize_email_header($inquiry['email'] ?? '');
    $clientPhone = sanitize_email_header($inquiry['phone'] ?? '');
    $organization = sanitize_email_header($inquiry['organization'] ?? '');
    $discipline = sanitize_email_header($inquiry['discipline'] ?? 'General Inquiry');
    $budgetTier = sanitize_email_header($inquiry['budget_tier'] ?? 'Standard');
    $rawMessage = (string)($inquiry['raw_message'] ?? $inquiry['message'] ?? '');
    $timestamp = (string)($inquiry['timestamp'] ?? date('c'));

    $subject = sprintf('[Engineer Baah] New Enquiry: %s — %s', $discipline, $clientName);

    $bodyLines = [
        'NEW PROJECT ENQUIRY — ENGINEER BAAH',
        '==================================================',
        'Name:         ' . $clientName,
        'Email:        ' . $clientEmail,
        'Phone:        ' . $clientPhone,
        'Organization: ' . ($organization !== '' ? $organization : 'N/A'),
        'Service:      ' . $discipline,
        'Budget Tier:  ' . $budgetTier,
        'Submitted:    ' . $timestamp,
        '--------------------------------------------------',
        'PROJECT DETAILS / MESSAGE:',
        '',
        $rawMessage,
        '',
        '==================================================',
        'Reply directly to this email to respond to ' . $clientName . ' (' . $clientEmail . ').'
    ];
    $body = implode("\r\n", $bodyLines);

    $smtpHost = trim((string)(getenv('SMTP_HOST') ?: ''));
    $smtpUser = trim((string)(getenv('SMTP_USER') ?: ''));
    $smtpPass = (string)(getenv('SMTP_PASS') ?: '');
    $smtpPort = (int)(getenv('SMTP_PORT') ?: 465);
    $fromEmail = sanitize_email_header((string)(getenv('SMTP_FROM') ?: ($smtpUser !== '' ? $smtpUser : 'no-reply@engineerbaah.com')));
    $fromName = sanitize_email_header((string)(getenv('SMTP_FROM_NAME') ?: 'Engineer Baah Website'));

    // 1. Primary Channel: Authenticated SMTP (SSL/STARTTLS) when configured
    if ($smtpHost !== '' && $smtpUser !== '' && $smtpPass !== '') {
        $sent = send_via_smtp(
            $smtpHost,
            $smtpPort,
            $smtpUser,
            $smtpPass,
            $fromEmail,
            $fromName,
            $toEmail,
            $clientEmail,
            $clientName,
            $subject,
            $body
        );
        if ($sent) {
            return true;
        }
        error_log('[MAILER WARNING] Authenticated SMTP failed; attempting native mail() fallback.');
    }

    // 2. Fallback Channel: Local MTA (Postfix / Exim / Sendmail via PHP mail())
    $headers = [
        'MIME-Version: 1.0',
        'Content-Type: text/plain; charset=UTF-8',
        'Content-Transfer-Encoding: 8bit',
        'From: ' . sprintf('"%s" <%s>', addslashes($fromName), $fromEmail),
        'Reply-To: ' . ($clientEmail !== '' ? sprintf('"%s" <%s>', addslashes($clientName), $clientEmail) : $fromEmail),
        'X-Mailer: EngineerBaah-Mailer/2.0'
    ];

    return @mail($toEmail, $subject, $body, implode("\r\n", $headers));
}

/**
 * Zero-dependency Authenticated SMTP Client over SSL (465) or STARTTLS (587)
 */
function send_via_smtp(
    string $host,
    int $port,
    string $username,
    string $password,
    string $fromEmail,
    string $fromName,
    string $toEmail,
    string $replyToEmail,
    string $replyToName,
    string $subject,
    string $body
): bool {
    $transport = ($port === 465) ? 'ssl://' . $host : 'tcp://' . $host;
    $errno = 0;
    $errstr = '';

    $socket = @stream_socket_client(
        $transport . ':' . $port,
        $errno,
        $errstr,
        8,
        STREAM_CLIENT_CONNECT
    );

    if (!is_resource($socket)) {
        error_log(sprintf('[SMTP ERROR] Connection failed (%d): %s', $errno, $errstr));
        return false;
    }

    stream_set_timeout($socket, 8);

    $readResponse = static function () use ($socket): string {
        $data = '';
        while ($line = fgets($socket, 515)) {
            $data .= $line;
            if (isset($line[3]) && $line[3] === ' ') {
                break;
            }
        }
        return $data;
    };

    $sendCommand = static function (string $cmd, array $expectedCodes) use ($socket, $readResponse): bool {
        fwrite($socket, $cmd . "\r\n");
        $resp = $readResponse();
        $code = (int)substr($resp, 0, 3);
        return in_array($code, $expectedCodes, true);
    };

    // Greeting
    $greeting = $readResponse();
    if ((int)substr($greeting, 0, 3) !== 220) {
        fclose($socket);
        return false;
    }

    $localHost = sanitize_email_header($_SERVER['HTTP_HOST'] ?? 'engineerbaah.com');
    if (!$sendCommand('EHLO ' . $localHost, [250])) {
        fclose($socket);
        return false;
    }

    // Upgrade to TLS on port 587
    if ($port === 587) {
        if (!$sendCommand('STARTTLS', [220])) {
            fclose($socket);
            return false;
        }
        $cryptoOk = @stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT | STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT);
        if (!$cryptoOk || !$sendCommand('EHLO ' . $localHost, [250])) {
            fclose($socket);
            return false;
        }
    }

    // Authenticate
    if (
        !$sendCommand('AUTH LOGIN', [334]) ||
        !$sendCommand(base64_encode($username), [334]) ||
        !$sendCommand(base64_encode($password), [235])
    ) {
        error_log('[SMTP ERROR] Authentication failed for user ' . $username);
        fclose($socket);
        return false;
    }

    // Envelope
    if (
        !$sendCommand('MAIL FROM:<' . $fromEmail . '>', [250]) ||
        !$sendCommand('RCPT TO:<' . $toEmail . '>', [250, 251]) ||
        !$sendCommand('DATA', [354])
    ) {
        fclose($socket);
        return false;
    }

    // Headers + Body (dot-stuffed per RFC 5321)
    $headers = [
        'Date: ' . date('r'),
        'Message-ID: <' . bin2hex(random_bytes(12)) . '@' . $localHost . '>',
        'From: "' . addslashes($fromName) . '" <' . $fromEmail . '>',
        'To: <' . $toEmail . '>',
        'Reply-To: ' . ($replyToEmail !== '' ? '"' . addslashes($replyToName) . '" <' . $replyToEmail . '>' : '<' . $fromEmail . '>'),
        'Subject: =?UTF-8?B?' . base64_encode($subject) . '?=',
        'MIME-Version: 1.0',
        'Content-Type: text/plain; charset=UTF-8',
        'Content-Transfer-Encoding: 8bit'
    ];

    $safeBody = preg_replace('/^\./m', '..', str_replace(["\r\n", "\r"], "\n", $body));
    $safeBody = str_replace("\n", "\r\n", (string)$safeBody);

    $messageData = implode("\r\n", $headers) . "\r\n\r\n" . $safeBody . "\r\n.";
    $accepted = $sendCommand($messageData, [250]);

    $sendCommand('QUIT', [221, 250]);
    fclose($socket);

    return $accepted;
}
