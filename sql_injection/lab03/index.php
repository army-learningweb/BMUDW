<?php
require_once __DIR__ . '/../database.php';
$category = $_GET['category'] ?? '';
$products = [];
$error = null;
if ($category !== '') {
    $pdo = getDatabase();
    $sql = "SELECT id, name, category, price FROM category_products WHERE category = '$category' AND is_public = 1";
    try {
        $products = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    } catch (Throwable $exception) {
        $error = 'Database error: ' . $exception->getMessage();
    }
}
function money(int $value): string
{
    return number_format($value, 0, ',', '.') . ' VND';
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab 03 · String Parameter Injection</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body class="path-lab">
    <main class="path-container">
        <h1>Lab 03 - String Parameter Injection</h1>
        <p>Category được đưa vào câu SQL trong string context. Hãy xem liệu input có thể thay đổi điều kiện <code>category = ... AND is_public = 1</code> hay không.</p>
        <article>
            <h2>Product category filter</h2>
            <form method="get">
                <label for="category">Category</label>
                <input id="category" name="category" value="<?= e($category) ?>" placeholder="books">
                <div class="path-form-actions"><button type="submit">Filter products</button></div>
            </form>
            <p class="path-muted">Category mẫu: <a href="?category=books">books</a>, <a href="?category=stationery">stationery</a>, <a href="?category=accessories">accessories</a></p>
        </article>
        <article>
            <h2>Hướng dẫn kiểm thử</h2>
            <ol>
                <li>Thử category <code>books</code> và ghi nhận các sản phẩm được trả về.</li>
                <li>Thử input sau trong ô Category: <code>books' OR 1=1 -- </code></li>
                <li>Kết quả dự kiến gồm cả sản phẩm thuộc category khác và bản ghi không public.</li>
            </ol>
        </article>
        <?php if ($products): ?><article>
                <h2>Products</h2>
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
                        <tbody><?php foreach ($products as $product): ?><tr>
                                    <td><?= e((string) $product['id']) ?></td>
                                    <td><?= e($product['name']) ?></td>
                                    <td><?= e($product['category']) ?></td>
                                    <td><?= money((int) $product['price']) ?></td>
                                </tr><?php endforeach; ?></tbody>
                    </table>
                </div>
            </article><?php elseif ($category !== '' && !$error): ?><p class="path-warning">Không có sản phẩm public trong category này.</p><?php endif; ?>
        <?php if ($error): ?><p class="path-warning"><?= e($error) ?></p><?php endif; ?>
        <p class="path-important">Mục tiêu: làm ứng dụng trả về <strong>Internal Red Team Manual</strong>.</p>
        <p><a href="../">Quay lại danh sách lab</a></p>
    </main>
</body>

</html>