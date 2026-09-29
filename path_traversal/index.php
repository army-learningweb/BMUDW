<?php
$labs = [
    ['01', 'Basic Path Traversal', 'Đọc file bên ngoài thư mục public bằng filename do client cung cấp.', 'lab01/'],
    ['02', 'File ID Authorization', 'Kiểm tra server có xác minh file được yêu cầu thuộc về current user hay không.', 'lab02/'],
    ['03', 'Weak Path Validation', 'Phân tích vì sao lọc chuỗi traversal không bảo vệ được đường dẫn cuối cùng.', 'lab03/'],
    ['04', 'File Access Challenge', 'Kết hợp path handling và access control để tìm đủ ba flag.', 'lab04/'],
];
?>
<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Path Traversal Labs</title>
    <link rel="stylesheet" href="../lab-theme.css">
</head>

<body id="lab-theme">
    <main>
        <h1>Path Traversal &amp; File Access</h1>
        <p>Bộ lab thực hành cục bộ về filesystem path và quyền truy cập file.</p>
        <aside class="test-guide">
            <h2>Cách kiểm thử</h2>
            <ol>
                <li>Mở từng lab và ghi nhận file public hoặc ID hợp lệ trước.</li>
                <li>Thử input mẫu trong hướng dẫn của lab để kiểm tra path validation hoặc authorization.</li>
                <li>Đối chiếu nội dung file trả về với quyền sở hữu dự kiến.</li>
            </ol>
            <p>Chỉ thử trên các file giả lập trong thư mục lab cục bộ.</p>
        </aside>
        <?php foreach ($labs as $lab): ?>
            <article>
                <h2>Lab <?= htmlspecialchars($lab[0]) ?> - <?= htmlspecialchars($lab[1]) ?></h2>
                <p><?= htmlspecialchars($lab[2]) ?></p>
                <a href="<?= htmlspecialchars($lab[3]) ?>">Mở lab</a>
            </article>
        <?php endforeach; ?>
    </main>
</body>

</html>