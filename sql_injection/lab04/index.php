<?php
require_once __DIR__ . '/../database.php';
$searchTerm = $_GET['q'] ?? '';
$products = [];
$error = null;
$sql = "SELECT id, name, category, price FROM products WHERE name LIKE '%$searchTerm%' AND is_public = 1";

if ($searchTerm !== '') {
    try {
        $products = getDatabase()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    } catch (Throwable $exception) {
        $error = 'Query failed. Check the UNION column count and compatible data types. ' . $exception->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab 04 · UNION Query</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body class="path-lab">
    <main class="path-container">
        <h1>Lab 04 - UNION Query</h1>
        <p>Thực hành cấu trúc kết quả và tính tương thích kiểu dữ liệu trong UNION-based SQL Injection.</p>

        <article>
            <h2>Bối cảnh truy vấn</h2>
            <p>Ứng dụng tìm sản phẩm bằng cách ghép giá trị <code>q</code> vào câu SQL. Truy vấn gốc trả về bốn cột theo thứ tự: <code>id</code>, <code>name</code>, <code>category</code>, <code>price</code>.</p>
            <pre><code>SELECT id, name, category, price
FROM products
WHERE name LIKE '%&lt;input q&gt;%'
  AND is_public = 1</code></pre>
            <p class="path-important">Với <code>UNION</code>, truy vấn bổ sung cần trả cùng số cột với truy vấn gốc; kiểu dữ liệu ở các vị trí tương ứng cũng cần tương thích.</p>
        </article>

        <article>
            <h2>Thử tìm sản phẩm</h2>
            <p>Thử một từ khóa bình thường trước, sau đó quan sát phản hồi khi cấu trúc truy vấn thay đổi.</p>
            <form method="get">
                <label for="q">Tên sản phẩm</label>
                <input id="q" name="q" value="<?= e($searchTerm) ?>" placeholder="handbook">
                <div class="path-form-actions"><button type="submit">Search products</button></div>
            </form>
            <p class="path-muted">Từ khóa mẫu: <a href="?q=handbook">handbook</a>, <a href="?q=notebook">notebook</a></p>
        </article>
        <article>
            <h2>Hướng dẫn kiểm thử</h2>
            <ol>
                <li>Tìm <code>handbook</code> để xem kết quả bình thường có bốn cột.</li>
                <li>Thử chuỗi sau trong ô Tên sản phẩm:
                    <p><code>%' UNION SELECT 42, 'Union row', 'training', 9000 -- </code></p>
                </li>
                <li>Kết quả dự kiến có thêm hàng <strong>Union row</strong>. Thử bỏ một giá trị khỏi SELECT bổ sung để quan sát lỗi số cột không khớp.</li>
            </ol>
        </article>

        <?php if ($products): ?>
            <article>
                <h2>Kết quả truy vấn</h2>
                <div class="path-table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?= e((string) $product['id']) ?></td>
                                    <td><?= e((string) $product['name']) ?></td>
                                    <td><?= e((string) $product['category']) ?></td>
                                    <td><?= e((string) $product['price']) ?></td>
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

        <p class="path-warning"><strong>Lưu ý:</strong> Endpoint cố ý dễ bị SQL Injection để thực hành. Không dùng cách ghép input vào SQL trong ứng dụng thật.</p>
        <p><a href="../">Quay lại danh sách lab</a></p>
    </main>
</body>

</html>