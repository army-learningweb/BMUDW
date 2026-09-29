<?php
require_once __DIR__ . '/../database.php';
$id = $_GET['id'] ?? '';
$product = null;
$error = null;
if ($id !== '') {
    $pdo = getDatabase();
    $sql = "SELECT id, name, category, price FROM products WHERE id = $id AND is_public = 1";
    try {
        $product = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC) ?: null;
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
    <title>Lab 02 · Numeric Parameter Injection</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body class="path-lab">
    <main class="path-container">
        <h1>Lab 02 - Numeric Parameter Injection</h1>
        <p>Tham số <code>id</code> được đưa thẳng vào ngữ cảnh số trong câu SQL. Thử các ID công khai bên dưới, sau đó kiểm tra xem biểu thức số có thể thay đổi logic truy vấn không.</p>
        <article>
            <h2>Product lookup</h2>
            <form method="get">
                <label for="id">Product ID</label>
                <input id="id" name="id" value="<?= e($id) ?>" placeholder="1">
                <div class="path-form-actions"><button type="submit">View product</button></div>
            </form>
        </article>
        <article>
            <h2>Hướng dẫn kiểm thử</h2>
            <ol>
                <li>Nhập <code>1</code> để xem sản phẩm public bình thường.</li>
                <li>Thử biểu thức số sau trong ô Product ID: <code>0 OR id=999 -- </code></li>
                <li>Kết quả dự kiến là <strong>Internal Security Package</strong>; phần điều kiện public phía sau dấu comment không còn được áp dụng.</li>
            </ol>
        </article>
        <?php if ($product): ?><article>
                <p class="path-muted">Product #<?= e((string) $product['id']) ?></p>
                <h2><?= e($product['name']) ?></h2>
                <p class="muted">Category: <?= e($product['category']) ?></p><strong><?= money((int) $product['price']) ?></strong>
            </article><?php elseif ($id !== '' && !$error): ?><p class="path-warning">Không tìm thấy sản phẩm public.</p><?php endif; ?>
        <?php if ($error): ?><p class="path-warning"><?= e($error) ?></p><?php endif; ?>
        <p class="path-important">Mục tiêu: tìm <strong>Internal Security Package</strong>, sản phẩm không xuất hiện trong catalog public.</p>
        <p><a href="../">Quay lại danh sách lab</a></p>
    </main>
</body>

</html>