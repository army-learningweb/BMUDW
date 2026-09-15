<?php

$error = [];
$success = [];

$ACCOUNT_SYSTEM['username'] = "admin";
$ACCOUNT_SYSTEM['password'] = "123456";

if(isset($error['login'])) $error['login'] = '';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Mặc định chỉ kiểm tra tài khoản
    // if ($username == $ACCOUNT_SYSTEM['username']) {
    //     $success['login'] = 'Đăng nhập thành công';
    // } else {
    //     $error['login'] = "Đăng nhập thất bại";
    // }
    
    // Fix (Kiểm tra cả tài khoản, lẫn mật khẩu)
    if ($username == $ACCOUNT_SYSTEM['username'] && $password == $ACCOUNT_SYSTEM['password']) {
        $success['login'] = 'Đăng nhập thành công';
    } else {
        $error['login'] = "Đăng nhập thất bại";
    }
}


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

    <?php if (!empty($error['login'])) { ?>
        <div class="error">
            <?php echo $error['login'] ?>
        </div>
    <?php } ?>

    <?php if (!empty($success['login'])) { ?>
        <div class="success">
            <?php echo $success['login'] ?>
        </div>
    <?php } ?>

</body>

</html>