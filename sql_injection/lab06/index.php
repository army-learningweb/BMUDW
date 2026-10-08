<?php
require_once __DIR__ . '/../database.php';
$username = $_GET['username'] ?? '';
$exists = false;
$error = null;

if ($username !== '') {
    $pdo = getDatabase();
    $sql = "SELECT 1 FROM users WHERE username = '$username' LIMIT 1";

    try {
        $exists = (bool) $pdo->query($sql)->fetchColumn();
    } catch (Throwable $exception) {
        $error = 'Database error: ' . $exception->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab 06 · Boolean-Based Blind SQL Injection</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body class="path-lab">
    <main class="path-container">
        <h1>Lab 06 - Boolean-Based Blind SQL Injection</h1>
        <p>Ứng dụng không trả trực tiếp dữ liệu Query, nhưng phản hồi vẫn thay đổi khi điều kiện đúng hoặc sai. Đây là dạng blind SQL injection dựa trên side-channel boolean.</p>

        <article>
            <h2>Bối cảnh truy vấn</h2>
            <p>Endpoint kiểm tra username bằng một query để biết liệu tài khoản có tồn tại hay không. Ứng dụng chỉ hiển thị gợi ý đúng/sai, không in ra dữ liệu thực tế từ bảng.</p>
            <pre><code>SELECT 1
FROM users
WHERE username = '&lt;input username&gt;'
LIMIT 1</code></pre>
            <p class="path-important">Nếu query trả về một hàng, ứng dụng báo <strong>"Matching account found"</strong>; nếu không, nó báo <strong>"No matching account"</strong>. Đây là dấu hiệu của boolean-based blind SQLi.</p>
        </article>

        <article>
            <h2>Username check</h2>
            <form method="get">
                <label for="username">Username</label>
                <input id="username" name="username" value="<?= e($username) ?>" placeholder="admin">
                <div class="path-form-actions"><button type="submit">Check username</button></div>
            </form>
        </article>

        <article>
            <h2>Hướng dẫn kiểm thử</h2>
            <ol>
                <li>Gõ username bình thường như <code>student01</code> để thấy phản hồi đúng/sai cơ bản.</li>
                <li>Thử payload dưới đây trong ô Username:
                    <p><code>' OR '1'='1' -- </code></p>
                </li>
                <li>Quan sát rằng ứng dụng vẫn trả về trạng thái "matching account found". Điều này cho thấy câu truy vấn đang được thay đổi và kết quả được suy ra qua Boolean response.</li>
                <li>Để thực hành sâu hơn, thử các điều kiện như <code>admin' AND SUBSTR(password,1,1)='a' -- </code> hoặc <code>admin' AND LENGTH(password) = 16 -- </code> rồi so sánh sự khác biệt trong phản hồi.</li>
            </ol>
        </article>

        <?php if ($username !== ''): ?>
            <?php if ($error): ?>
                <p class="path-warning"><?= e($error) ?></p>
            <?php else: ?>
                <p class="<?= $exists ? 'path-success' : 'path-warning' ?>">
                    <strong><?= $exists ? 'Condition returned TRUE' : 'Condition returned FALSE' ?></strong>
                    <?= $exists ? ' - A matching account was found.' : ' - No matching account was found.' ?>
                </p>
            <?php endif; ?>
        <?php endif; ?>

        <p class="path-important">Mục tiêu: hiểu cách sử dụng phản hồi đúng/sai để suy ra thông tin mà không cần trực tiếp xem dữ liệu query trả về.</p>
        <p><a href="../">Quay lại danh sách lab</a></p>
    </main>
</body>

</html>