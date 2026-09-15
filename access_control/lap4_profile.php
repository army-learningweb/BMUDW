<?php
session_start();
$id = $_GET['id'];

if (isset($_SESSION['users'][1001])) {
    if ($id != $_SESSION['users'][1001]['id']) {
        $_SESSION['error'] = 'Lỗi, không được phép truy cập';
        header('location: lap4_access_controll_challenges.php');
    }
}

?>


<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
</head>

<body>
    <h1>User Profile</h1>

    <p>Requested ID: <span><?php echo $_SESSION['users'][$id]['id'] ?></span></p>
    <p>Username: <span><?php echo $_SESSION['users'][$id]['username'] ?></span></p>
    <p>Name: <span><?php echo $_SESSION['users'][$id]['name'] ?></span></p>
    <p>Email: <span><?php echo $_SESSION['users'][$id]['email'] ?></span></p>

    <br>
    <a href="lap4_access_controll_challenges.php">Dashboard</a>
</body>

</html>