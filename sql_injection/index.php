<?php
$labs = [
    ['01', 'Login SQL Injection', 'Bypass authentication logic', 'lab01/'],
    ['02', 'Numeric Parameter Injection', 'Understand numeric SQL context', 'lab02/'],
    ['03', 'String Parameter Injection', 'Test a category filter', 'lab03/'],
    ['04', 'UNION Query', 'Explore result column count and type compatibility', 'lab04/'],
];
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Injection Labs</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="path-lab">
    <main class="path-container">
        <h1>SQL Injection</h1>
        <p>Web Security Lab · Part 05. Thực hành SQL Injection qua login, tham số số, chuỗi và cấu trúc kết quả UNION.</p>
        <article>
            <h2>Cách kiểm thử</h2>
            <ol>
                <li>Mở một lab và gửi dữ liệu bình thường để ghi nhận kết quả ban đầu.</li>
                <li>Thử input mẫu trong phần hướng dẫn của lab đó, rồi so sánh phản hồi.</li>
                <li>Quan sát input đã tác động đến cấu trúc hoặc điều kiện SQL như thế nào.</li>
            </ol>
            <p class="path-warning"><strong>Chỉ thực hành trên ứng dụng và database lab cục bộ.</strong> Các input mẫu cố ý khai thác lỗi ghép chuỗi SQL.</p>
        </article>
        <?php foreach ($labs as $lab): ?>
            <article>
                <p class="path-muted">Lab <?= htmlspecialchars($lab[0], ENT_QUOTES, 'UTF-8') ?></p>
                <h2><?= htmlspecialchars($lab[1], ENT_QUOTES, 'UTF-8') ?></h2>
                <p><?= htmlspecialchars($lab[2], ENT_QUOTES, 'UTF-8') ?></p>
                <a href="<?= htmlspecialchars($lab[3], ENT_QUOTES, 'UTF-8') ?>">Mở lab</a>
            </article>
        <?php endforeach; ?>
        <p class="path-warning"><strong>Lưu ý:</strong> Các endpoint trong lab cố ý dùng string concatenation để phục vụ học tập. Không dùng mẫu này trong ứng dụng thật.</p>
    </main>
</body>

</html>