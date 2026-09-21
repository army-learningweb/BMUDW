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
    <style>
        body {
            font: 16px/1.5 system-ui, sans-serif;
            max-width: 850px;
            margin: 40px auto;
            padding: 0 20px;
            color: #182230;
            background: #f5f7fa
        }

        main {
            background: #fff;
            padding: 28px;
            border: 1px solid #d9e0e8;
            border-radius: 8px
        }

        h1 {
            margin-top: 0
        }

        article {
            border-top: 1px solid #e4e8ed;
            padding: 18px 0
        }

        article:first-of-type {
            border-top: 0
        }

        a {
            color: #075985;
            font-weight: 600
        }

        code {
            background: #eef2f6;
            padding: 2px 5px;
            border-radius: 3px
        }
    </style>
</head>

<body>
    <main>
        <h1>Path Traversal &amp; File Access</h1>
        <p>Bộ lab thực hành cục bộ về filesystem path và quyền truy cập file.</p>
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