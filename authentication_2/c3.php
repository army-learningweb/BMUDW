<?php
$validUsername = 'student';
$validPassword = '12345';
$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === $validUsername && $password === $validPassword) {
        $message = 'Đăng nhập thành công.';
        $messageType = 'success';
    } else {
        $message = 'Tên đăng nhập hoặc mật khẩu không đúng.';
        $messageType = 'error';
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challenge 01 - Login</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 40px 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .back-link {
            color: #0d6efd;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .card {
            background: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 32px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        h1 {
            font-size: 28px;
            margin-top: 0;
            margin-bottom: 24px;
            color: #212529;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #212529;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            max-width: 400px;
            padding: 8px 12px;
            border: 1px solid #ced4da;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 14px;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #0d6efd;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.25);
        }

        .btn-submit {
            background-color: #0d6efd;
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 6px;
            width: 100%;
            max-width: 400px;
            font-size: 14px;
            cursor: pointer;
            margin-top: 8px;
        }

        .btn-submit:hover {
            background-color: #0b5ed7;
        }

        .message {
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .message.error {
            color: #842029;
            background-color: #f8d7da;
        }

        .message.success {
            color: #0f5132;
            background-color: #d1e7dd;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card">
            <h1>Authentication Portal</h1>
            <?php if ($message !== ''): ?>
                <div class="message <?= htmlspecialchars($messageType, ENT_QUOTES, 'UTF-8') ?>">
                    <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
                </div>
            <?php endif; ?>
            <form action="c3.php" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn-submit">Login</button>
            </form>
        </div>
    </div>

</body>

</html>