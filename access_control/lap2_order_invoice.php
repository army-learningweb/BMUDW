<?php
session_start();
$_SESSION['invoice'][1]['id'] = 5001;
$_SESSION['invoice'][1]['user_id'] = 1001;
$_SESSION['invoice'][1]['user_name'] = 'student01';
$_SESSION['invoice'][1]['user_email'] = 'student01@gmail.com';
$_SESSION['invoice'][1]['invoice_code'] = 'INV' . $_SESSION['invoice'][1]['id'];
$_SESSION['invoice'][1]['desc'] = 'Web Security Workshop 01';
$_SESSION['invoice'][1]['total'] = '500.000 VNĐ';

$_SESSION['invoice'][2]['id'] = 5002;
$_SESSION['invoice'][2]['user_id'] = 1002;
$_SESSION['invoice'][2]['user_name'] = 'student02';
$_SESSION['invoice'][2]['user_email'] = 'student02@gmail.com';
$_SESSION['invoice'][2]['invoice_code'] = 'INV' . $_SESSION['invoice'][2]['id'];
$_SESSION['invoice'][2]['desc'] = 'Web Security Workshop 02';
$_SESSION['invoice'][2]['total'] = '700.000 VNĐ';

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
            height: auto;
            width: 150px;
        }

        .error {
            color: red;
        }
    </style>
    <h3>
        <p>Mục tiêu:</p>
        <p>Bạn đang đăng nhập bằng tài khoản student01.</p>
        <p>Hãy kiểm tra xem ứng dụng có cho phép truy cập hóa đơn của một user khác hay không.</p>
    </h3>

    <h1>Current User</h1>
    <img src="./image//profile.jpg" alt="">
    <h3>student1</h3>
    <p>UserID: 1001</p>


    <h1>Invoices</h1>

    <table border="1">

        <tr>
            <td>InvoiceID</td>
            <td>Description</td>
            <td>Total</td>
            <td>Action</td>
        </tr>

        <tr>
            <td>
                <?php echo $_SESSION['invoice'][1]['id'] ?>
            </td>
            <td>
                <?php echo $_SESSION['invoice'][1]['desc'] ?>
            </td>
            <td>
                <?php echo $_SESSION['invoice'][1]['total'] ?>
            </td>
            <td>
                <a href="lap2_checkout.php?id=<?php echo $_SESSION['invoice'][1]['id'] ?>">Xem chi tiết</a>
            </td>
        </tr>


    </table>

    <?php if ($error) { ?>
        <p class="error"><?php echo $error ?></p>
    <?php } ?>

</body>

</html>