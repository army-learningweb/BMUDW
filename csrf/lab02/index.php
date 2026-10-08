<?php
require_once __DIR__ . '/../common.php';

$requestedSameSite = $_POST['cookie_mode'] ?? $_GET['cookie_mode'] ?? 'Lax';
$requestedSameSite = in_array($requestedSameSite, ['Lax', 'Strict', 'None'], true) ? $requestedSameSite : 'Lax';
$sameSite = csrf_start('lab02', $requestedSameSite);

$success = null;
$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = csrf_valid_email_from_post();
    if ($email === null) {
        $error = 'Email không hợp lệ.';
    } else {
        $_SESSION['csrf_email'] = $email;
        $success = 'Endpoint nhận POST và cập nhật email nếu session cookie được gửi kèm. Origin chỉ được ghi nhận, chưa được dùng để từ chối request.';
    }
}
$origin = $_SERVER['HTTP_ORIGIN'] ?? '(không có Origin header)';
$fetchSite = $_SERVER['HTTP_SEC_FETCH_SITE'] ?? '(không có Sec-Fetch-Site header)';
csrf_page_start('Lab 02 - CSRF Across Origins');
?>
    <h1>Lab 02 - CSRF Across Origins</h1>
    <p>Quan sát cách browser gửi form cross-origin và cách cookie policy ảnh hưởng đến session. Endpoint vẫn cố ý không xác minh CSRF token hoặc Origin.</p>

    <article>
        <h2>Application state</h2>
        <p>User: <code>student01</code></p>
        <p>Email hiện tại: <strong><?= csrf_escape((string) $_SESSION['csrf_email']) ?></strong></p>
        <p>Session cookie policy đang chọn: <code>SameSite=<?= csrf_escape($sameSite) ?></code>; cookie là <code>HttpOnly</code><?= $sameSite === 'None' ? ' và Secure' : '' ?>.</p>
        <form method="post" action="?cookie_mode=<?= rawurlencode($sameSite) ?>">
            <input type="hidden" name="cookie_mode" value="<?= csrf_escape($sameSite) ?>">
            <label for="email">Email mới</label>
            <input id="email" name="email" type="email" value="student01+origin@example.test" required>
            <button type="submit">Gửi request từ application</button>
        </form>
    </article>

    <article>
        <h2>Request signals của request này</h2>
        <table>
            <tbody>
                <tr><th>Origin</th><td><code><?= csrf_escape($origin) ?></code></td></tr>
                <tr><th>Sec-Fetch-Site</th><td><code><?= csrf_escape($fetchSite) ?></code></td></tr>
                <tr><th>Method</th><td><code><?= csrf_escape($_SERVER['REQUEST_METHOD']) ?></code></td></tr>
                <tr><th>Cookie mode</th><td><code><?= csrf_escape($sameSite) ?></code></td></tr>
            </tbody>
        </table>
    </article>

    <aside class="test-guide">
        <h2>Hướng dẫn kiểm thử</h2>
        <ol>
            <li>Chọn <code>Lax</code> và mở trang lại để lưu cookie với policy đó. Gửi form cùng origin, rồi ghi nhận email và headers.</li>
            <li>Đặt URL endpoint này vào <code>lab02/attacker.html</code> từ origin khác và gửi một email khác. Với <code>Lax</code>, cookie thường không được gửi kèm cross-site POST.</li>
            <li>Mở Lab 02 với <code>?cookie_mode=None</code> qua HTTPS trước khi gửi từ attacker. <code>SameSite=None</code> cho phép cross-site cookie nhưng bắt buộc <code>Secure</code>; thử lại và đối chiếu thay đổi email.</li>
            <li>Kiểm tra kết quả tại đây: request có thể mang Origin khác, nhưng endpoint vẫn cập nhật state nếu session cookie được gửi.</li>
        </ol>
        <p class="warning">Nếu dùng HTTP, browser có thể từ chối cookie <code>SameSite=None; Secure</code>; khi đó cross-site request không có session. Hãy dùng URL HTTPS của lab hoặc xem lại cookie trong Developer Tools → Application/Storage.</p>
    </aside>
    <?php csrf_render_result($success, $error); ?>
    <p><a href="?cookie_mode=Lax">Đặt lại cookie mode Lax</a> · <a href="?cookie_mode=None">Chọn cookie mode None (HTTPS)</a> · <a href="attacker.html">Mở form attacker template</a></p>
<?php csrf_page_end('../'); ?>
