<?php
session_start();
if (!isset($_SESSION['user_login'])) {
    $_SESSION['error'] = 'Truy cập trái phép trái phép';
    header('location: lap2_trustin_client_side_cookie.php');
    exit;
}

// Mặc định khi kiểm tra bằng cookie
// $cookie = $_COOKIE['user_role'];
// if(isset($cookie) && $cookie == 'admin'){
//     $_SESSION['error'] = 'Truy cập dashboard thành công';
// }else{
//     $_SESSION['error'] = 'Truy cập trái phép';
//     header('location: lap2_trustin_client_side_cookie.php');
// }

// Kiểm tra bằng quyền của user đang đăng nhập
if (isset($_SESSION['user_login']) && $_SESSION['user_login']['role'] == 'admin') {
    $_SESSION['error'] = 'Truy cập dashboard thành công';
} else {
    $_SESSION['error'] = 'Truy cập trái phép';
    header('location: lap2_trustin_client_side_cookie.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../lab-theme.css">
</head>

<body id="lab-theme">
    <h1>DASHBOARD</h1>
    <p style="color:green">Truy cập dashboard thành công !</p>
    <aside class="test-guide">Mở trực tiếp trang này khi phiên đang mang role <code>Student</code> và quan sát redirect/thông báo. So sánh với quyền được lưu trong session, không chỉ nội dung role ở trình duyệt.</aside>
</body>

</html>