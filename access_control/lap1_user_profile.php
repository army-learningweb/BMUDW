<?php
session_start();
$_SESSION['user_login'][1]['id'] = 1001;
$_SESSION['user_login'][1]['username'] = 'student1';
$_SESSION['user_login'][1]['name'] = 'nguyen van a';
$_SESSION['user_login'][1]['email'] = 'student01@gmail.com';
$_SESSION['user_login'][1]['phone'] = '090100100';

$_SESSION['user_login'][2]['id'] = 1002;
$_SESSION['user_login'][2]['username'] = 'student2';
$_SESSION['user_login'][2]['name'] = 'nguyen van b';
$_SESSION['user_login'][2]['email'] = 'student02@gmail.com';
$_SESSION['user_login'][2]['phone'] = '090100102';

$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);

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
        img {
            height: auto;
            width: 150px;
        }

        .error {
            color: red;
        }
    </style>
    <h3>
        <p>Mục tiêu:</p>
        <p>Bạn đang đăng nhập bằng tài khoản student01.</p>
        <p>Hãy kiểm tra xem ứng dụng có cho phép truy cập profile của user khác không.</p>
    </h3>

    <h1>Current User</h1>
    <img src="./image//profile.jpg" alt="">
    <h3><?php echo $_SESSION['user_login'][1]['username'] ?></h3>
    <p>UserID: <?php echo $_SESSION['user_login'][1]['id'] ?></p>
    <a href="lap1_profile.php?id=1001">Xem hồ sơ</a>

    <aside class="test-guide">
        <h2>Hướng dẫn kiểm thử</h2>
        <ol>
            <li>Mở hồ sơ hiện tại qua liên kết có ID <code>1001</code>.</li>
            <li>Đổi ID trên URL thành <code>1002</code>; ứng dụng dự kiến từ chối và quay lại trang này.</li>
            <li>So sánh thông báo lỗi và ID trả về giữa hai lần thử.</li>
        </ol>
    </aside>

    <?php if ($error) { ?>
        <p class="error"><?php echo $error ?></p>
    <?php } ?>

</body>

</html>