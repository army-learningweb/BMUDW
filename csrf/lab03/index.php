<?php
require_once __DIR__ . '/../common.php';
csrf_start('lab03');

$success = null;
$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = csrf_validate_request('lab03_csrf_token');
    if ($error === null) {
        $email = csrf_valid_email_from_post();
        if ($email === null) {
            $error = 'Email không hợp lệ.';
        } else {
            $_SESSION['csrf_email'] = $email;
            $success = 'Email đã được cập nhật sau khi kiểm tra CSRF token và request signals.';
        }
    }
}
$origin = $_SERVER['HTTP_ORIGIN'] ?? '(không có Origin header)';
$fetchSite = $_SERVER['HTTP_SEC_FETCH_SITE'] ?? '(không có Sec-Fetch-Site header)';
$token = csrf_token('lab03_csrf_token');
csrf_page_start('Lab 03 - CSRF Defenses');
?>
    <h1>Lab 03 - CSRF Defenses</h1>
    <p>Endpoint dùng đồng thời CSRF token, kiểm tra Origin khi header hiện diện và Fetch Metadata khi browser gửi header.</p>

    <article>
        <h2>Protected profile</h2>
        <p>User: <code>student01</code></p>
        <p>Email hiện tại: <strong><?= csrf_escape((string) $_SESSION['csrf_email']) ?></strong></p>
        <form method="post">
            <input type="hidden" name="csrf_token" value="<?= csrf_escape($token) ?>">
            <label for="email">Email mới</label>
            <input id="email" name="email" type="email" value="student01+protected@example.test" required>
            <button type="submit">Cập nhật có bảo vệ</button>
        </form>
    </article>

    <article>
        <h2>Request signals</h2>
        <table>
            <tbody>
                <tr><th>Origin</th><td><code><?= csrf_escape($origin) ?></code></td></tr>
                <tr><th>Sec-Fetch-Site</th><td><code><?= csrf_escape($fetchSite) ?></code></td></tr>
                <tr><th>CSRF token</th><td>Form có token ngẫu nhiên theo session; server so sánh bằng <code>hash_equals</code>.</td></tr>
            </tbody>
        </table>
    </article>

    <aside class="test-guide">
        <h2>Hướng dẫn kiểm thử</h2>
        <ol>
            <li>Gửi form bình thường. Email thay đổi vì form mang token hợp lệ và request cùng origin.</li>
            <li>Mở <code>lab02/attacker.html</code> trên origin khác, đặt Target URL là endpoint Lab 03, rồi gửi. Server phải từ chối do token thiếu (hoặc Origin/Fetch Metadata khác origin).</li>
            <li>Trong DevTools → Network, xem form request có <code>csrf_token</code> hay không và đối chiếu Origin cùng Sec-Fetch-Site.</li>
            <li>Thử bỏ trường token bằng cách sửa HTML trong DevTools rồi submit; kết quả mong đợi là bị từ chối và email không đổi.</li>
        </ol>
        <p>Token là defense chính trong ví dụ này; Origin và Fetch Metadata là các kiểm tra bổ sung. Chúng không thay thế authorization hay validation.</p>
    </aside>
    <?php csrf_render_result($success, $error); ?>
<?php csrf_page_end('../'); ?>
