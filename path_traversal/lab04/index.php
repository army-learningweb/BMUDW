<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lab 04 - File Access Challenge</title>
    <link rel="stylesheet" href="../../lab-theme.css">
</head>

<body id="lab-theme">
    <h1>Lab 04 - File Access Challenge</h1>
    <p>Current user: <strong>student01</strong> (User ID <code>1001</code>)</p>
    <p>Phân tích các endpoint và tìm đủ 3 flag.</p>
    <h2>File Portal</h2>
    <ul>
        <li><a href="view.php?file=handbook.txt">Public Handbook</a></li>
        <li><a href="download.php?id=101">My Student Report</a></li>
    </ul>
    <p>Endpoints dùng trong challenge: <code>view.php?file=...</code> và <code>download.php?id=...</code></p>
    <aside class="test-guide">
        <h2>Hướng dẫn kiểm thử</h2>
        <ol>
            <li>Đọc public handbook bằng <code>view.php?file=handbook.txt</code>.</li>
            <li>Thử <code>view.php?file=../private/secret.txt</code> để kiểm tra path traversal.</li>
            <li>Thử download ID <code>102</code> và <code>103</code> để kiểm tra student-owner/admin authorization.</li>
            <li>So sánh nội dung trả về với user hiện tại (student01, ID 1001).</li>
        </ol>
    </aside>
    <p><a href="../">Quay lại danh sách lab</a></p>
</body>

</html>