<?php
require_once __DIR__ . '/../common.php';
$sameSite = csrf_start('lab01', 'None');

$success = null;
$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = csrf_valid_email_from_post();
    if ($email === null) {
        $error = 'Email không hợp lệ.';
    } else {
        $_SESSION['csrf_email'] = $email;
        $success = 'Email đã được cập nhật. Endpoint chỉ kiểm tra session và input, không kiểm tra CSRF token.';
    }
}
csrf_page_start('Lab 01 - Basic CSRF');
?>
    <h1>Lab 01 - Basic CSRF</h1>
    <p><strong>Authenticated Request ≠ Intended Request.</strong> Ứng dụng nhận diện bạn bằng session và cho phép đổi email bằng một POST không có CSRF protection.</p>

    <article>
        <h2>Training account</h2>
        <p>User: <code>student01</code></p>
        <p>Session cookie: <code>SameSite=<?= csrf_escape($sameSite) ?></code><?= $sameSite === 'None' ? '; Secure' : '' ?>.</p>
        <p>Email hiện tại: <strong><?= csrf_escape((string) $_SESSION['csrf_email']) ?></strong></p>
        <form method="post">
            <label for="email">Email mới</label>
            <input id="email" name="email" type="email" value="student01+new@example.test" required>
            <button type="submit">Cập nhật email</button>
        </form>
    </article>

    <aside class="test-guide">
        <h2>Hướng dẫn kiểm thử</h2>
        <ol>
            <li>Ghi lại email hiện tại. Gửi form bình thường với <code>student01+new@example.test</code>; email cần được cập nhật.</li>
            <li>Trên HTTPS, session cookie dùng <code>SameSite=None; Secure</code>. Mở <code>lab02/attacker.html</code> từ một origin khác hoặc mở file HTML trực tiếp trên máy.</li>
            <li>Nhập URL endpoint Lab 01 vào trường Target URL, ví dụ <code>https://&lt;domain&gt;/25_26_BMUDW/07_CSRF/lab01/</code>, rồi gửi email khác.</li>
            <li>Quay lại Lab 01 và kiểm tra email. Nếu browser gửi session cookie cùng request, email đổi dù thao tác được khởi tạo từ trang attacker.</li>
        </ol>
        <p class="warning">Lab cố ý thiếu token và kiểm tra Origin. Nếu site đang chạy HTTP, cookie sẽ dùng <code>SameSite=Lax</code> để form cùng origin vẫn hoạt động; browser thường không gửi cookie này cùng cross-site POST.</p>
    </aside>
    <?php csrf_render_result($success, $error); ?>
<?php csrf_page_end('../'); ?>
