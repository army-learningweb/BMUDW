<?php
require_once __DIR__ . '/../common.php';
$sameSite = csrf_start('lab04', 'None');

if (!isset($_SESSION['lab04_protection'])) {
    $_SESSION['lab04_protection'] = false;
}

$token = csrf_token('lab04_csrf_token');
$success = null;
$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'set_mode') {
        $error = csrf_validate_request('lab04_csrf_token');
        if ($error === null) {
            $_SESSION['lab04_protection'] = ($_POST['protection'] ?? '') === 'on';
            $success = $_SESSION['lab04_protection']
                ? 'Đã bật defense cho endpoint đổi email.'
                : 'Đã chuyển endpoint về chế độ vulnerable.';
        }
    } elseif ($action === 'update') {
        $useProtection = (bool) $_SESSION['lab04_protection'];
        if ($useProtection) {
            $error = csrf_validate_request('lab04_csrf_token');
        }
        if ($error === null) {
            $email = csrf_valid_email_from_post();
            if ($email === null) {
                $error = 'Email không hợp lệ.';
            } else {
                $_SESSION['csrf_email'] = $email;
                $success = $useProtection
                    ? 'Endpoint có defense chấp nhận request hợp lệ và cập nhật email.'
                    : 'Endpoint vulnerable chấp nhận POST không có CSRF validation và cập nhật email.';
            }
        }
    } else {
        $error = 'Action không hợp lệ.';
    }
}

csrf_page_start('Lab 04 - Combined CSRF Challenge');
?>
    <h1>Lab 04 - Combined CSRF Challenge</h1>
    <p><strong>Analyze → Exploit → Fix.</strong> Hai endpoint trong training app cùng đổi email, nhưng chỉ một endpoint áp dụng defense. Cookie hiện dùng <code>SameSite=<?= csrf_escape($sameSite) ?><?= $sameSite === 'None' ? '; Secure' : '' ?></code> để mô phỏng cross-site form trên HTTPS.</p>

    <article>
        <h2>Application state</h2>
        <p>User: <code>student01</code></p>
        <p>Email hiện tại: <strong><?= csrf_escape((string) $_SESSION['csrf_email']) ?></strong></p>
        <p>Endpoint mode: <strong><?= $_SESSION['lab04_protection'] ? 'Defense enabled' : 'Vulnerable baseline' ?></strong></p>
        <form method="post">
            <input type="hidden" name="action" value="set_mode">
            <input type="hidden" name="protection" value="<?= $_SESSION['lab04_protection'] ? 'off' : 'on' ?>">
            <input type="hidden" name="csrf_token" value="<?= csrf_escape($token) ?>">
            <button type="submit"><?= $_SESSION['lab04_protection'] ? 'Tắt defense (reset challenge)' : 'Bật defense cho endpoint protected' ?></button>
        </form>
    </article>

    <article>
        <h2>Change email · action=update</h2>
        <p>Form không có token. Ở Vulnerable baseline, endpoint chấp nhận request; khi bật defense, cùng request này phải bị từ chối.</p>
        <form method="post">
            <input type="hidden" name="action" value="update">
            <label for="vulnerable-email">Email mới</label>
            <input id="vulnerable-email" name="email" type="email" value="changed-by-vulnerable-endpoint@example.test" required>
            <button type="submit">Gửi request không có token</button>
        </form>
    </article>

    <article>
        <h2>Fixed client flow · action=update</h2>
        <p>Đây là cùng endpoint nhưng form có token hợp lệ; server vẫn kiểm tra thêm Origin và Fetch Metadata nếu browser cung cấp.</p>
        <form method="post">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="csrf_token" value="<?= csrf_escape($token) ?>">
            <label for="protected-email">Email mới</label>
            <input id="protected-email" name="email" type="email" value="changed-by-protected-endpoint@example.test" required>
            <button type="submit">Gửi protected request</button>
        </form>
    </article>

    <aside class="test-guide">
        <h2>Hướng dẫn kiểm thử</h2>
        <ol>
            <li>Baseline: gửi từng form trong application và xác nhận cả hai endpoint hoạt động với request hợp lệ.</li>
            <li>Exploit: mở <code>lab02/attacker.html</code> từ origin khác; đặt Target URL tới Lab 04 qua HTTPS và gửi form. Ở Vulnerable baseline, email cần bị đổi.</li>
            <li>Kiểm chứng fix: bật defense ở trên rồi gửi lại cùng attacker form. Cùng endpoint phải từ chối request thiếu token; email không đổi.</li>
            <li>Fix: gửi form Fixed client flow để cập nhật thành công. Defense xác minh token theo session; Origin/Fetch Metadata và SameSite là lớp bổ sung.</li>
            <li>Tắt defense để quay lại vulnerable baseline và lặp lại phép thử.</li>
        </ol>
        <p class="warning">Challenge chỉ lưu state giả lập trong session. Trên HTTPS cookie dùng <code>SameSite=None; Secure</code>; trên HTTP tự chuyển về <code>Lax</code>, vì vậy browser có thể không gửi cookie cùng cross-site POST.</p>
    </aside>
    <?php csrf_render_result($success, $error); ?>
<?php csrf_page_end('../'); ?>
