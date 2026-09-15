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
</head>

<body>
    <h1><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></h1>
</body>

</html>