<?php
require __DIR__ . '/lap4_data.php';

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
    <h1>Lab 04 - Access Control Challenge</h1>
    <section>
        <h2>Current User</h2>
        <p>Username: <strong><?php echo $_SESSION['users'][1001]['username'] ?></strong></p>
        <p>User ID: <span><?php echo $_SESSION['users'][1001]['id'] ?></span></p>
        <p>Role: <code><?php echo $_SESSION['users'][1001]['role'] ?></code></p>
    </section>

    <section>
        <h2>Student Portal</h2>
        <div>
            <h3>My Profile</h3>
            <p>Xem thông tin tài khoản hiện tại.</p>
            <a href="lap4_profile.php?id=<?php echo $_SESSION['users'][1001]['id'] ?>">View Profile</a>
        </div>

        <div>
            <h3>My Invoice</h3>
            <p>Xem hóa đơn khóa học của bạn.</p>
            <a href="lap4_invoice.php?id=<?php echo $_SESSION['users'][1001]['invoices'][5001]['invoice_id'] ?>">View Invoice</a>
        </div>

        <div>
            <h3>Administration</h3>
            <p>Chức năng dành cho administrator.</p>
            <a href="lap4_admin_panel.php">Admin Area</a>
        </div>

        <?php if ($error) { ?>
            <p style="color:red"><?php echo $error ?></p>
        <?php } ?>
    </section>
    <aside class="test-guide">
        <h2>Hướng dẫn kiểm thử</h2>
        <ol>
            <li>Mở profile <code>1001</code> và invoice <code>5001</code> của student01.</li>
            <li>Đổi lần lượt ID trên URL thành <code>1002</code> và <code>5002</code> để kiểm tra quyền sở hữu.</li>
            <li>Thử Admin Area trong phiên student; server dự kiến từ chối truy cập.</li>
        </ol>
    </aside>
</body>

</html>