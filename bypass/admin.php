<?php 
session_start();
$role = $_SESSION['user_login']['role'] ?? null;

if($role !== 'admin') {
    $_SESSION['error'] = 'Truy cập trái phép';
    header('location: lap4.php');
    exit;
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Bạn đã truy cập được trang admin</h1>
</body>
</html>