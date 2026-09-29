<?php
session_start();
$_SESSION['user_login']['name'] = "AdamJones";
$_SESSION['user_login']['role'] = "Student";
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
        a {
            display: block;
            margin: 10px 0;
        }

        .error {
            color: red;
            margin: 10px 0;
        }
    </style>
    <div>
        <h1>Thông tin tài khoản</h1>
        <p>Name: <?php echo $_SESSION['user_login']['name'] ?></p>
        <p>Role: <?php echo $_SESSION['user_login']['role'] ?></p>
    </div>

    <div>
        <h2>Dashboard</h2>
        <a href="">My Course</a>
        <a href="">My Profile</a>

        <!-- Truy cập admin -->
        <a href="admin.php" target="self" style="display: none">Admin Panel</a>

        <?php if ($error !== null) { ?>
            <div class="error"><?php echo $error ?></div>
        <?php } ?>
    </div>
    <aside class="test-guide">
        <h2>Hướng dẫn kiểm thử</h2>
        <ol>
            <li>Ghi nhận role hiện tại là <code>Student</code>.</li>
            <li>Thử mở trực tiếp <code>admin.php</code> dù liên kết Admin Panel đang ẩn.</li>
            <li>Server dự kiến từ chối do role không phải admin; ẩn link không thay thế authorization.</li>
        </ol>
    </aside>
</body>

</html>