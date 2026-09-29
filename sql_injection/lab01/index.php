<?php
require_once __DIR__ . '/../database.php';
$message = null;
$loggedInAs = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $pdo = getDatabase();
    $sql = "SELECT id, username FROM users WHERE username = '$username' AND password = '$password'";

    try {
        $user = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $loggedInAs = $user['username'];
            $message = 'Đăng nhập thành công.';
        } else {
            $error = 'Sai username hoặc password.';
        }
    } catch (Throwable $exception) {
        $error = 'Database error: ' . $exception->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab 01 · Login SQL Injection</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body class="path-lab">
    <main class="path-container">
        <h1>Lab 01 - Login SQL Injection</h1>
        <p>Ứng dụng xây dựng câu SQL login bằng cách nối trực tiếp <code>username</code> và <code>password</code>. Hãy phân tích cách hai input ảnh hưởng tới điều kiện <code>WHERE</code>.</p>
        <article>
            <h2>Login form</h2>
            <form method="post">
                <label for="username">Username</label>
                <input id="username" name="username" autocomplete="off" required>
                <label for="password">Password</label>
                <input id="password" name="password" type="password" autocomplete="off" required>
                <div class="path-form-actions"><button type="submit">Login</button></div>
            </form>
        </article>
        <article>
            <h2>Hướng dẫn kiểm thử</h2>
            <ol>
                <li>Kiểm tra baseline: nhập <code>student01</code> và một password sai; kết quả dự kiến là đăng nhập thất bại.</li>
                <li>Thử payload dưới đây trong ô Username và nhập bất kỳ giá trị nào trong ô Password:
                    <p><code>' OR '1'='1' -- </code></p>
                </li>
                <li>So sánh kết quả: form có thể đăng nhập mà không cần password đúng vì điều kiện SQL bị thay đổi.</li>
            </ol>
        </article>
        <?php if ($message): ?><p class="path-success"><strong><?= e($message) ?></strong> User: <?= e($loggedInAs ?? '') ?></p><?php endif; ?>
        <?php if ($error): ?><p class="path-warning"><?= e($error) ?></p><?php endif; ?>
        <p class="path-important">Mục tiêu: đăng nhập bằng một trong các tài khoản <code>student01</code>, <code>student02</code> hoặc <code>admin</code> mà không cần biết password hợp lệ.</p>
        <p><a href="../">Quay lại danh sách lab</a></p>
    </main>
</body>

</html>