<?php
$currentUser = ['id' => 1001, 'username' => 'student01'];
?>
<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Lab 02 - File ID Authorization</title>
</head>

<body>
    <h1>Lab 02 - File ID Authorization</h1>
    <p>Current user: <strong><?= htmlspecialchars($currentUser['username']) ?></strong> (ID <?= $currentUser['id'] ?>)</p>
    <p>Ứng dụng không nhận filesystem path trực tiếp. Challenge: đọc report của <code>student02</code>.</p>
    <h2>My Files</h2>
    <p><a href="download.php?id=101">Student Report (ID 101)</a></p>
    <p><a href="../">Quay lại danh sách lab</a></p>
</body>

</html>