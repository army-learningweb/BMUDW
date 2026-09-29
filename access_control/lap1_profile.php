<?php
session_start();
$id = str_split($_GET['id'])[3];

if ($id != 1) {
    $_SESSION['error'] = 'Lỗi, không được phép truy cập';
    header('location: lap1_user_profile.php');
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
    <h1>Hồ sơ cá nhân</h1>
    <h3><?php echo $_SESSION['user_login'][$id]['username'] ?></h3>
    <p>Họ và tên: <?php echo $_SESSION['user_login'][$id]['name'] ?></p>
    <p>UserID: <?php echo $_SESSION['user_login'][$id]['id'] ?></p>
    <aside class="test-guide"><strong>Đối chiếu quyền truy cập:</strong> So sánh UserID được yêu cầu với tài khoản hiện tại, sau đó dùng liên kết quay về để thử hồ sơ của tài khoản khác.</aside>
    <a href="lap1_user_profile.php"><- Quay về</a>
</body>

</html>