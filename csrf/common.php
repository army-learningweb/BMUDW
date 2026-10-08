<?php

function csrf_start(string $lab, string $sameSite = 'Lax'): string
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return $sameSite;
    }

    $sameSite = in_array($sameSite, ['Lax', 'Strict', 'None'], true) ? $sameSite : 'Lax';
    $https = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
    if ($sameSite === 'None' && !$https) {
        $sameSite = 'Lax';
    }

    session_name('BMU_CSRF_' . strtoupper($lab));
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_COOKIE[session_name()])) {
        http_response_code(403);
        header('Content-Type: text/plain; charset=utf-8');
        exit('Request rejected: no authenticated lab session cookie was sent. Open the lab page first and check the browser SameSite/Secure policy.');
    }

    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => $sameSite === 'None' || $https,
        'httponly' => true,
        'samesite' => $sameSite,
    ]);
    session_start();

    if (!isset($_SESSION['csrf_email'])) {
        $_SESSION['csrf_email'] = 'student01@example.test';
    }

    return $sameSite;
}

function csrf_escape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function csrf_token(string $key): string
{
    if (!isset($_SESSION[$key]) || !is_string($_SESSION[$key])) {
        $_SESSION[$key] = bin2hex(random_bytes(32));
    }

    return $_SESSION[$key];
}

function csrf_validate_request(string $key): ?string
{
    $submittedToken = $_POST['csrf_token'] ?? '';
    $expectedToken = $_SESSION[$key] ?? '';

    if (!is_string($submittedToken) || !is_string($expectedToken) || $expectedToken === '' || !hash_equals($expectedToken, $submittedToken)) {
        return 'Request bị từ chối: CSRF token không hợp lệ hoặc bị thiếu.';
    }

    $origin = $_SERVER['HTTP_ORIGIN'] ?? '';
    if ($origin !== '' && !hash_equals(csrf_current_origin(), $origin)) {
        return 'Request bị từ chối: Origin không khớp với ứng dụng.';
    }

    $fetchSite = $_SERVER['HTTP_SEC_FETCH_SITE'] ?? '';
    if ($fetchSite !== '' && $fetchSite !== 'same-origin') {
        return 'Request bị từ chối: Fetch Metadata cho biết request không cùng origin.';
    }

    return null;
}

function csrf_current_origin(): string
{
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';

    return $scheme . '://' . $host;
}

function csrf_valid_email_from_post(): ?string
{
    $email = $_POST['email'] ?? '';
    if (!is_string($email) || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        return null;
    }

    return $email;
}

function csrf_page_start(string $title): void
{
    ?>
    <!doctype html>
    <html lang="vi">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= csrf_escape($title) ?></title>
        <link rel="stylesheet" href="../../lab-theme.css">
    </head>

    <body id="lab-theme">
    <?php
}

function csrf_page_end(string $backLink = '../'): void
{
    ?>
        <p><a href="<?= csrf_escape($backLink) ?>">Quay lại danh sách CSRF labs</a></p>
    </body>

    </html>
    <?php
}

function csrf_render_result(?string $success, ?string $error): void
{
    if ($success !== null) {
        echo '<p class="success"><strong>' . csrf_escape($success) . '</strong></p>';
    }
    if ($error !== null) {
        echo '<p class="error"><strong>' . csrf_escape($error) . '</strong></p>';
    }
}
