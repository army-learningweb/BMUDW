<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lab 03 - Weak Path Validation</title>
    <link rel="stylesheet" href="../../lab-theme.css">
</head>

<body id="lab-theme">
    <h1>Lab 03 - Weak Path Validation</h1>
    <p>Developer đã loại bỏ chuỗi <code>../</code> trước khi đọc file. Challenge: đọc <code>files/private/secret.txt</code>.</p>
    <h2>Public Documents</h2>
    <ul>
        <li><a href="view.php?file=guide.txt">Student Guide</a></li>
        <li><a href="view.php?file=faq.txt">FAQ</a></li>
    </ul>
    <p>Endpoint: <code>view.php?file=guide.txt</code></p>
    <aside class="test-guide">
        <h2>Hướng dẫn kiểm thử</h2>
        <ol>
            <li>Mở Student Guide để xác nhận truy vấn bình thường.</li>
            <li>Thử <code>view.php?file=....//private/secret.txt</code>.</li>
            <li>Quan sát cách chuỗi traversal được biến đổi bởi bộ lọc loại bỏ một lần.</li>
        </ol>
    </aside>
    <p><a href="../">Quay lại danh sách lab</a></p>
</body>

</html>