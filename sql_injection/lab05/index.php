<?php
require_once __DIR__ . '/../database.php';
$searchTerm = $_GET['q'] ?? '';
$records = [];
$error = null;

if ($searchTerm !== '') {
    try {
        $sql = "SELECT id, name, category, CAST(price AS TEXT) AS value FROM products WHERE name LIKE '%$searchTerm%' AND is_public = 1";
        $records = getDatabase()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    } catch (Throwable $exception) {
        $error = 'Query failed. Check the SQL structure and column compatibility.';
    }
}
?>
<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lab 05 - Information Disclosure</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body class="path-lab">
    <main class="path-container">
        <h1>Lab 05 - Information Disclosure</h1>
        <p>Trang catalog chỉ nên hiển thị sản phẩm public. Quan sát liệu input tìm kiếm có thể khiến query trả về dữ liệu từ bảng training-secret hay không.</p>

        <article>
            <h2>Bối cảnh truy vấn</h2>
            <p>Query gốc trả về bốn cột từ catalog public: <code>id</code>, <code>name</code>, <code>category</code> và <code>value</code>.</p>
            <pre><code>SELECT id, name, category, CAST(price AS TEXT) AS value
FROM products
WHERE name LIKE '%&lt;input q&gt;%'
  AND is_public = 1</code></pre>
            <p class="path-important">Bảng <code>training_secrets</code> không thuộc chức năng catalog. Mục tiêu là quan sát việc dữ liệu ngoài phạm vi có thể xuất hiện trong cùng response.</p>
        </article>

        <article>
            <h2>Product search</h2>
            <form method="get">
                <label for="q">Tên sản phẩm</label>
                <input id="q" name="q" value="<?= e($searchTerm) ?>" placeholder="handbook">
                <div class="path-form-actions"><button type="submit">Search products</button></div>
            </form>
            <p class="path-muted">Từ khóa bình thường: <a href="?q=handbook">handbook</a>, <a href="?q=notebook">notebook</a></p>
        </article>

        <article>
            <h2>Hướng dẫn kiểm thử</h2>
            <ol>
                <li>Tìm <code>handbook</code> và ghi nhận kết quả catalog public.</li>
                <li>Thử chuỗi sau trong ô tìm kiếm:
                    <p><code>%' UNION SELECT id, name, category, secret_value FROM training_secrets -- </code></p>
                </li>
                <li>Kết quả dự kiến có thêm record <strong>Internal Training Key</strong> cùng giá trị flag.</li>
                <li>Bỏ một cột trong SELECT bổ sung để quan sát lỗi khi cấu trúc hai kết quả không khớp.</li>
            </ol>
        </article>

        <?php if ($records): ?>
            <article>
                <h2>Query results</h2>
                <div class="path-table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($records as $record): ?>
                                <tr>
                                    <td><?= e((string) $record['id']) ?></td>
                                    <td><?= e((string) $record['name']) ?></td>
                                    <td><?= e((string) $record['category']) ?></td>
                                    <td><?= e((string) $record['value']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </article>
        <?php elseif ($searchTerm !== '' && !$error): ?>
            <p class="path-warning">Không tìm thấy sản phẩm phù hợp.</p>
        <?php endif; ?>

        <?php if ($error): ?>
            <p class="path-warning"><?= e($error) ?></p>
        <?php endif; ?>

        <p class="path-warning"><strong>Lưu ý:</strong> Đây là endpoint cố ý dễ bị SQL Injection, chỉ dùng với database lab cục bộ.</p>
        <p><a href="../">Quay lại danh sách lab</a></p>
    </main>
</body>

</html>