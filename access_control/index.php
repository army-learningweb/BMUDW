<?php
$labs = [
    ['01', 'Horizontal Profile Access', 'Kiểm tra quyền truy cập hồ sơ giữa các tài khoản student.', 'lap1_user_profile.php'],
    ['02', 'Invoice IDOR', 'Thử truy cập hóa đơn bằng ID không thuộc user hiện tại.', 'lap2_order_invoice.php'],
    ['03', 'Vertical Privilege Escalation', 'Kiểm tra server-side authorization cho khu vực administrator.', 'lap3_vertical_previlage.php'],
    ['04', 'Access Control Challenge', 'Kết hợp kiểm tra quyền profile, invoice và admin area.', 'lap4_access_controll_challenges.php'],
];
?>
<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Access Control Labs</title>
    <link rel="stylesheet" href="../lab-theme.css">
</head>

<body id="lab-theme">
    <main>
        <h1>Access Control Labs</h1>
        <p>Thực hành kiểm tra quyền sở hữu tài nguyên và phân quyền theo vai trò.</p>
        <aside class="test-guide">
            <h2>Cách kiểm thử</h2>
            <ol>
                <li>Ghi nhận user, role và ID tài nguyên hiện tại.</li>
                <li>Thử đổi ID trên URL hoặc mở trực tiếp chức năng quản trị.</li>
                <li>So sánh response với quyền mà user hiện tại được phép có.</li>
            </ol>
            <p>Chỉ chạy các bài tập này trên dữ liệu giả lập cục bộ.</p>
        </aside>
        <?php foreach ($labs as $lab): ?>
            <article>
                <p><strong>Lab <?= htmlspecialchars($lab[0], ENT_QUOTES, 'UTF-8') ?></strong></p>
                <h2><?= htmlspecialchars($lab[1], ENT_QUOTES, 'UTF-8') ?></h2>
                <p><?= htmlspecialchars($lab[2], ENT_QUOTES, 'UTF-8') ?></p>
                <a href="<?= htmlspecialchars($lab[3], ENT_QUOTES, 'UTF-8') ?>">Mở lab</a>
            </article>
        <?php endforeach; ?>
    </main>
</body>

</html>