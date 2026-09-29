<?php
$currentUser = ['id' => 1001, 'username' => 'student01'];
?>
<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lab 02 - File ID Authorization</title>
    <link rel="stylesheet" href="../../lab-theme.css">
</head>

<body id="lab-theme">
    <h1>Lab 02 - File ID Authorization</h1>
    <p>Current user: <strong><?= htmlspecialchars($currentUser['username']) ?></strong> (ID <?= $currentUser['id'] ?>)</p>
    <p>Ứng dụng không nhận filesystem path trực tiếp. Challenge: đọc report của <code>student02</code>.</p>
    <h2>My Files</h2>
    <p><a href="download.php?id=101">Student Report (ID 101)</a></p>
    <aside class="test-guide">
        <h2>Hướng dẫn kiểm thử</h2>
        <ol>
            <li>Mở file của mình bằng ID <code>101</code>.</li>
            <li>Thử <code>download.php?id=102</code> để yêu cầu report của student02.</li>
            <li>So sánh file trả về với owner hiện tại; endpoint hiện chưa kiểm tra ownership nên request 102 vẫn đọc được.</li>
        </ol>
    </aside>
    <p><a href="../">Quay lại danh sách lab</a></p>
</body>

</html>