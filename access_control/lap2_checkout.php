<?php
session_start();
$id = str_split($_GET['id'])[3];

if ($id != 1) {
    $_SESSION['error'] = 'Lỗi, không được phép truy cập';
    header('location: lap2_order_invoice.php');
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

    <p>Current user ID:
        <span>
            <?php echo $_SESSION['invoice'][$id]['user_id'] ?>
        </span>
    </p>
    <p>Requested invoice: <span>
            <?php echo $_SESSION['invoice'][$id]['id'] ?>
        </span></p>

    <div>
        <p>Invoice: <strong><?php echo $_SESSION['invoice'][$id]['invoice_code'] ?></strong></p>
        <p>Customer: <strong><?php echo $_SESSION['invoice'][$id]['user_name'] ?></strong></p>
        <p>Email: <strong><?php echo $_SESSION['invoice'][$id]['user_email'] ?></strong></p>
        <p>Description: <strong><?php echo $_SESSION['invoice'][$id]['desc'] ?></strong></p>
        <p>Amount: <strong><?php echo $_SESSION['invoice'][$id]['total'] ?></strong></p>
    </div>

    <a href="lap2_order_invoice.php">&larr; Lab Home</a>
</body>

</html>