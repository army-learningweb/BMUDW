<?php
session_start();
$id = $_GET['id'];
$id = str_split($id);
$id = array_slice($id, -4);
$id = implode($id);

$id_user = str_split($id)[3];
$complete_id = 100 . $id_user;

$user_id = $_SESSION['users'][$complete_id]['id'];


if (isset($_SESSION['users'][1001])) {
    if ($user_id != 1001) {
        $_SESSION['error'] = 'Lỗi, không được phép truy cập';
        header('location: lap4_access_controll_challenges.php');
    }
}

?>


<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
</head>

<body>
    <h1>Invoice Detail</h1>

    <p>Invoice: <?php echo $_SESSION['users'][$user_id]['invoices'][$id]['invoice_id'] ?></p>
    <p>Customer: <?php echo $_SESSION['users'][$user_id]['username'] ?></p>
    <p>Course: <?php echo $_SESSION['users'][$user_id]['invoices'][$id]['course'] ?></p>
    <p>Amount: <?php echo $_SESSION['users'][$user_id]['invoices'][$id]['amount'] ?></p>

    <p><a href="lap4_access_controll_challenges.php">Dashboard</a></p>
</body>

</html>