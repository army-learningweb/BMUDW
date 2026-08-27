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
</head>
<body>
    <style>
        a{
            display: block;
            margin: 10px 0;
        }
        .error{
            color:red;
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

        <?php if($error !== null) { ?>
            <div class="error"><?php echo $error ?></div>
        <?php } ?>
    </div>
</body>
</html>