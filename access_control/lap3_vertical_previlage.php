<?php
session_start();
$_SESSION['user_login']['id'] = 1001;
$_SESSION['user_login']['username'] = 'student1';
$_SESSION['user_login']['role'] = 'student';


$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);
?>


<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Lab 03 - Vertical Privilege Escalation</title>
    <link rel="stylesheet" href="../lab-theme.css">
</head>

<body id="lab-theme">

    <style>
        .hidden {
            opacity: 0;
            pointer-events: none;
        }
    </style>

    <h1>Lab 03 - Vertical Privilege Escalation</h1>

    <h2>Challenge</h2>
    <p><strong>Mục tiêu:</strong> Bạn đang đăng nhập bằng tài khoản <em>student01</em> với role <em>student</em>. Hãy kiểm tra xem chức năng administrator có thực sự được bảo vệ ở phía server hay không.</p>
    <p>Challenge hoàn thành khi tài khoản student truy cập được khu vực dành cho administrator.</p>

    <h2>Current User</h2>
    <p>Username: <strong><?php echo $_SESSION['user_login']['username'] ?></strong></p>
    <p>Role: <code><?php echo $_SESSION['user_login']['role'] ?></code></p>

    <h2>Dashboard</h2>
    <ul>
        <li><a href="#">My Profile</a></li>
        <li><a href="#">My Invoices</a></li>
        <li><a href="#">Account Settings</a></li>
        <li class="hidden"><a href="lap3_admin_panel.php">Admin Panel</a></li>
    </ul>

    <aside class="test-guide">
        <h2>Hướng dẫn kiểm thử</h2>
        <ol>
            <li>Xác nhận tài khoản hiện tại có role <code>student</code>.</li>
            <li>Mở trực tiếp <code>lap3_admin_panel.php</code> thay vì dựa vào liên kết đang ẩn.</li>
            <li>Trang quản trị dự kiến từ chối student và chuyển về challenge; việc ẩn liên kết không phải là biện pháp phân quyền.</li>
        </ol>
    </aside>

    <?php if ($error) { ?>
        <p style="color:red"><?php echo $error ?></p>
    <?php } ?>

</body>

</html>