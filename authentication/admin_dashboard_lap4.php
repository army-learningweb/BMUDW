<?php
session_start();

if (!isset($_SESSION['STUDENT_ACCOUNT'])) {
    $_SESSION['error'] = 'Truy cập trái phép trái phép';
    header('location: lap4_authentication_challenge.php');
    exit;
}

$cookie = $_COOKIE['role'];

// Kiểm tra quyền thông qua cookie không bảo mật
// if($cookie !== 'admin'){
//     header('location: dashboard_lap4.php');
//     $_SESSION['error'] = 'Truy cập trái phép';
// }else{
//     $_SESSION['success'] = 'Bạn đã truy cập thành công Admin Dashboard';
// }

// Kiểm tra quyền thông qua session
if ($_SESSION['STUDENT_ACCOUNT']['role'] !== 'admin') {
    header('location: dashboard_lap4.php');
    $_SESSION['error'] = 'Truy cập trái phép';
} else {
    $_SESSION['success'] = 'Bạn đã truy cập thành công Admin Dashboard';
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
        .success {
            color: green;
        }
    </style>
    <h1>ADMIN DASHBOARD LAP 4</h1>

    <?php if (!empty($_SESSION['success'])) { ?>
        <p class="success"><?php echo $_SESSION['success']; ?></p>
    <?php } ?>
    <aside class="test-guide">Mở trực tiếp trang này trong phiên student để kiểm tra rằng server-side role check chặn quyền admin.</aside>
</body>

</html>