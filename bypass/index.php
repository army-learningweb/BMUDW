<?php
$labs = [
    ['01', 'Quantity Limit', 'So sánh giới hạn số lượng ở trình duyệt với kiểm tra phía server.', 'lap1.php'],
    ['02', 'Hidden Price', 'Thử sửa giá gửi từ form và quan sát validation ở server.', 'lap2.php'],
    ['03', 'Read-Only Discount', 'Kiểm tra liệu thay đổi trường chỉ đọc có ảnh hưởng kết quả thanh toán không.', 'lap3.php'],
    ['04', 'Hidden Admin Link', 'Mở trực tiếp trang admin và kiểm tra role ở server.', 'lap4.php'],
];
?>
<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Client-Side Bypass Labs</title>
    <link rel="stylesheet" href="../lab-theme.css">
</head>

<body id="lab-theme">
    <main>
        <h1>Client-Side Bypass Labs</h1>
        <p>Kiểm tra các giả định đặt ở trình duyệt và xác nhận server có tự kiểm tra dữ liệu gửi lên hay không.</p>
        <aside class="test-guide">
            <h2>Cách kiểm thử</h2>
            <ol>
                <li>Gửi form với giá trị mặc định để ghi nhận kết quả ban đầu.</li>
                <li>Trong lab có ghi chú, thử sửa giới hạn hoặc field bằng DevTools rồi gửi lại.</li>
                <li>Đối chiếu response thực tế: thay đổi phía client chỉ thành công nếu server không xác minh dữ liệu.</li>
            </ol>
            <p>Chỉ sửa request của các bài tập cục bộ này.</p>
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