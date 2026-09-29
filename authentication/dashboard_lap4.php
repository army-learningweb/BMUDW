<?php
session_start();
if (!isset($_SESSION['STUDENT_ACCOUNT'])) {
    $_SESSION['error'] = 'Truy cập trái phép trái phép';
    header('location: lap4_authentication_challenge.php');
    exit;
}

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
            margin: 20px 0;
        }

        .error {
            color: red;
        }
    </style>
    <h1>STUDENT DASHBOARD LAP 4</h1>
    <h3>Xin chào <?php echo $_SESSION['STUDENT_ACCOUNT']['username'] ?> !</h3>

    <a href="logout.php"><- Đăng xuất</a>

            <a href="admin_dashboard_lap4.php">Truy cập dashboard -></a>
            <?php if (!empty($error)) { ?>
                <p class="error"><?php echo $error  ?></p>
            <?php } ?>
            <aside class="test-guide">
                <h2>Hướng dẫn kiểm thử</h2>
                <p>Trong phiên student, mở Admin Dashboard và xác nhận server từ chối. Đăng xuất để xoá session trước khi chạy lại challenge.</p>
            </aside>
</body>

</html>