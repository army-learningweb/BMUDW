<?php
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$isValid = $username === 'student' && $password === '12345';
$message = $isValid ? 'Login successful' : 'Invalid username or password';
$statusCode = $isValid ? 200 : 401;

http_response_code($statusCode);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login result</title>
    <link rel="stylesheet" href="../lab-theme.css">
</head>

<body id="lab-theme">
    <h1><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></h1>
    <aside class="test-guide">
        <h2>Hướng dẫn kiểm thử</h2>
        <p>Gửi <code>student</code> / <code>12345</code> từ Challenge 01: phản hồi hợp lệ có status 200; sai thông tin trả về status 401.</p>
    </aside>
    <p><a href="c1.php">Quay lại Authentication Portal</a></p>
</body>

</html>