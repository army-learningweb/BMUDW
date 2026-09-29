<?php
session_start();

$user_role = $_SESSION['users'][1001]['role'];

if ($user_role !== 'admin') {
    $_SESSION['error'] = 'Lỗi, không được phép truy cập';
    header('location: lap4_access_controll_challenges.php');
}

?>


<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Administrator Area</title>
    <link rel="stylesheet" href="../lab-theme.css">
</head>

<body id="lab-theme">
    <h1>Administrator Area</h1>

    <h2>System Information</h2>
    <ul>
        <li>Registered users: 3</li>
        <li>Active courses: 7</li>
        <li>Pending invoices: 2</li>
    </ul>

    <aside class="test-guide">Mở trang này từ phiên student và xác nhận hệ thống từ chối quyền administrator.</aside>
    <p><a href="index.php">Dashboard</a></p>
</body>

</html>