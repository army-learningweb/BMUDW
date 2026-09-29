<?php
$labs = [
    ['01', 'Login Response', 'Gửi thông tin đăng nhập và phân biệt phản hồi thành công/thất bại.', 'c1.php'],
    ['02', 'Login Attempt Limit', 'Kiểm tra số lần đăng nhập sai và trạng thái khóa trong session.', 'c2.php'],
    ['03', 'Plaintext Password', 'Quan sát cách ứng dụng so sánh mật khẩu dạng plaintext.', 'c3.php'],
    ['04', 'Password Hash', 'So sánh xác thực mật khẩu bằng password_verify() với challenge plaintext.', 'c4.php'],
];
?>
<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Authentication Challenges</title>
    <link rel="stylesheet" href="../lab-theme.css">
</head>

<body id="lab-theme">
    <main>
        <h1>Authentication Challenges</h1>
        <p>Các bài thực hành về login validation, rate limiting và lưu trữ mật khẩu.</p>
        <aside class="test-guide">
            <h2>Cách kiểm thử</h2>
            <ol>
                <li>Dùng thông tin mẫu được ghi trong từng challenge để tạo một lần đăng nhập thành công.</li>
                <li>Thử password sai và so sánh thông báo hoặc HTTP status.</li>
                <li>Với Challenge 02, dùng phiên mới để kiểm thử lại sau khi đã chạm giới hạn đăng nhập.</li>
            </ol>
            <p>Không dùng credential hoặc script thử mật khẩu ngoài ứng dụng lab.</p>
        </aside>
        <?php foreach ($labs as $lab): ?>
            <article>
                <p><strong>Challenge <?= htmlspecialchars($lab[0], ENT_QUOTES, 'UTF-8') ?></strong></p>
                <h2><?= htmlspecialchars($lab[1], ENT_QUOTES, 'UTF-8') ?></h2>
                <p><?= htmlspecialchars($lab[2], ENT_QUOTES, 'UTF-8') ?></p>
                <a href="<?= htmlspecialchars($lab[3], ENT_QUOTES, 'UTF-8') ?>">Mở challenge</a>
            </article>
        <?php endforeach; ?>
    </main>
</body>

</html>