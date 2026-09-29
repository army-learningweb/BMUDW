<?php
session_start();
$username_systems = 'student01';
$password_systems = password_hash('123456', PASSWORD_DEFAULT);
$role_systems = 'student';
setcookie('role', $role_systems);

// Kiểm tra đăng nhập
if (isset($_POST['submit'])) {
    // Thông báo
    $_SESSION['success'] = [];
    $_SESSION['error'] = [];

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == $username_systems && password_verify($password, $password_systems)) {
        session_regenerate_id();
        // Tài khoản học sinh;
        $_SESSION['STUDENT_ACCOUNT']['username'] = $username;
        $_SESSION['STUDENT_ACCOUNT']['password'] = $password;
        $_SESSION['STUDENT_ACCOUNT']['role'] = $role_systems;

        header('location: dashboard_lap4.php');
    } else {
        $_SESSION['error'] = 'Đăng nhập thất bại';
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../lab-theme.css">
</head>

<body id="lab-theme">
    <style>
        label {
            display: block;
            margin-top: 2px;
        }

        input {
            display: block;
        }

        button {
            margin-top: 5px;
        }

        .error {
            color: red;
            margin-top: 5px;
            font-weight: 500px;
        }

        .success {
            color: green;
            margin-top: 5px;
            font-weight: 500px;
        }
    </style>

    <h1>Đăng nhập hệ thống</h1>

    <form action="" method="post">
        <label for="username">Tên tài khoản</label>
        <input type="text" name="username" id="username">

        <label for="">Mật khẩu</label>
        <input type="password" name="password" id="password">

        <button type="submit" name="submit">Đăng nhập</button>
    </form>

    <?php if (!empty($_SESSION['success'])) { ?>
        <div class="success">
            <?php echo $_SESSION['success'] ?>
        </div>
    <?php } ?>

    <?php if (!empty($_SESSION['error'])) { ?>
        <div class="error">
            <?php echo $_SESSION['error'] ?>
        </div>
    <?php } ?>
    <aside class="test-guide">
        <h2>Hướng dẫn kiểm thử</h2>
        <ol>
            <li>Đăng nhập bằng student01 / <code>123456</code> và mở Student Dashboard.</li>
            <li>Thử mở Admin Dashboard trong cùng phiên student.</li>
            <li>Kết quả dự kiến là từ chối truy cập; so sánh quyết định dựa trên session với cookie role.</li>
        </ol>
    </aside>
</body>

</html>