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
</head>

<body>
    <h1>Administrator Area</h1>

    <h2>System Information</h2>
    <ul>
        <li>Registered users: 3</li>
        <li>Active courses: 7</li>
        <li>Pending invoices: 2</li>
    </ul>

    <p><a href="index.php">Dashboard</a></p>
</body>

</html>