<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lab 01 - Basic Path Traversal</title>
    <link rel="stylesheet" href="../../lab-theme.css">
</head>

<body id="lab-theme">
    <h1>Lab 01 - Basic Path Traversal</h1>
    <p>Ứng dụng chỉ định đọc tài liệu trong <code>files/public/</code>. Challenge: đọc <code>files/private/secret.txt</code>.</p>
    <h2>Public Documents</h2>
    <ul>
        <li><a href="download.php?file=lesson01.txt">Lesson 01</a></li>
        <li><a href="download.php?file=lesson02.txt">Lesson 02</a></li>
    </ul>
    <p>Endpoint: <code>download.php?file=lesson01.txt</code></p>
    <aside class="test-guide">
        <h2>Hướng dẫn kiểm thử</h2>
        <ol>
            <li>Mở Lesson 01 để xác nhận file public đọc được.</li>
            <li>Thử <code>download.php?file=../private/secret.txt</code>.</li>
            <li>Quan sát nội dung file private được trả về do endpoint ghép filename vào filesystem path.</li>
        </ol>
    </aside>
    <p><a href="../">Quay lại danh sách lab</a></p>
</body>

</html>