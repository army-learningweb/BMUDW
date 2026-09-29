<?php
$labs = [
    ['01', 'Login Validation', 'So sánh xác thực username/password đầy đủ với kiểm tra thiếu điều kiện.', 'lap1_loginclaw.php'],
    ['02', 'Client-Side Cookie Trust', 'Quan sát cookie role và cách server quyết định quyền dashboard.', 'lap2_trustin_client_side_cookie.php'],
    ['03', 'Session Management', 'Theo dõi session ID trước và sau khi xác thực thành công.', 'lap3_session_management.php'],
    ['04', 'Authentication Challenge', 'Kiểm tra session, logout và quyền truy cập dashboard admin.', 'lap4_authentication_challenge.php'],
];
?>
<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Authentication Labs</title>
    <link rel="stylesheet" href="../lab-theme.css">
</head>

<body id="lab-theme">
    <main>
        <h1>Authentication Labs</h1>
        <p>Thực hành xác thực đăng nhập, session lifecycle và kiểm tra role.</p>
        <aside class="test-guide">
            <h2>Cách kiểm thử</h2>
            <ol>
                <li>Thử một bộ thông tin hợp lệ và một bộ sai để ghi nhận baseline.</li>
                <li>Quan sát session ID, cookie và response sau đăng nhập hoặc logout.</li>
                <li>Thử truy cập dashboard admin trong phiên student; quyền phải được kiểm tra ở server.</li>
            </ol>
            <p>Các tài khoản mẫu chỉ dùng trong môi trường lab cục bộ.</p>
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