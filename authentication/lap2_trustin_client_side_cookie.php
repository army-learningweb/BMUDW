<?php

session_start();

$_SESSION['user_login']['name'] = "AdamJones";
$_SESSION['user_login']['role'] = "Student";
setcookie('user_role', 'student');

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
        img {
            width: 100px;
            height: auto;
        }

        .role {
            color: blue;
        }

        .error {
            color: red;
            margin-top: 5px;
            font-weight: 500px;
        }
    </style>

    <h1>Thông tin tài khoản</h1>
    <img src="./image/avatar.avif" alt="">
    <p><?php echo $_SESSION['user_login']['name'] ?></p>
    <p class="role"><?php echo $_SESSION['user_login']['role'] ?></p>
    <a href="dashboard.php">Truy cập dashboard -></a>

    <?php if ($error) { ?>
        <div class="error">
            <?php echo $error ?>
        </div>
    <?php } ?>
</body>

</html>