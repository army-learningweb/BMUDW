<?php
$labs = [
    ['01', 'Basic CSRF', 'Quan sát request đã đăng nhập nhưng chưa chứng minh ý định người dùng.', 'lab01/'],
    ['02', 'CSRF Across Origins', 'Thử form từ origin khác và phân tích Origin, session cookie, SameSite.', 'lab02/'],
    ['03', 'CSRF Defenses', 'Thực hành token, kiểm tra Origin và Fetch Metadata.', 'lab03/'],
    ['04', 'Combined CSRF Challenge', 'Phân tích, khai thác endpoint demo rồi so sánh với endpoint đã bảo vệ.', 'lab04/'],
];
?>
<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CSRF Labs</title>
    <link rel="stylesheet" href="../lab-theme.css">
</head>

<body id="lab-theme">
    <main>
        <h1>Cross-Site Request Forgery (CSRF)</h1>
        <p>Web Security Training Lab · Topic 07 · Authentication xác định user, nhưng chưa chứng minh request thay đổi trạng thái là điều user chủ động mong muốn.</p>
        <aside class="test-guide">
            <h2>Cách kiểm thử</h2>
            <ol>
                <li>Mở từng lab, ghi lại email ban đầu và gửi một request hợp lệ làm baseline.</li>
                <li>Làm theo payload và các bước trong mục hướng dẫn kiểm thử ở lab đó.</li>
                <li>So sánh state trước/sau, response của server và request headers/cookie.</li>
                <li>Dùng Lab 01, Lab 02 và Lab 04 qua HTTPS để thử cookie <code>SameSite=None; Secure</code>; trên HTTP các lab này dùng <code>Lax</code> để form cùng origin vẫn hoạt động.</li>
            </ol>
            <p>Các tài khoản và email chỉ được lưu trong PHP session của trình duyệt. Chỉ dùng trên bộ lab này.</p>
        </aside>
        <?php foreach ($labs as $lab): ?>
            <article>
                <h2>Lab <?= htmlspecialchars($lab[0], ENT_QUOTES, 'UTF-8') ?> - <?= htmlspecialchars($lab[1], ENT_QUOTES, 'UTF-8') ?></h2>
                <p><?= htmlspecialchars($lab[2], ENT_QUOTES, 'UTF-8') ?></p>
                <a href="<?= htmlspecialchars($lab[3], ENT_QUOTES, 'UTF-8') ?>">Mở lab</a>
            </article>
        <?php endforeach; ?>
    </main>
</body>

</html>
