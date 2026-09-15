<?php 
session_start();

if(isset($_SESSION['user_login'])){
    if($_SESSION['user_login']['role'] !== 'admin'){
        $_SESSION['error'] = 'Lỗi, không được phép truy cập';
        header('location: lap3_vertical_previlage.php');
    }
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
    <h1 style="color:green">Bạn đã truy cập thành công vào ADMIN PANEL</h1>
    <table border=1>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1001</td>
                <td>student01</td>
                <td>student</td>
            </tr>
            <tr>
                <td>1002</td>
                <td>student02</td>
                <td>student</td>
            </tr>
            <tr>
                <td>1</td>
                <td>administrator</td>
                <td>admin</td>
            </tr>
        </tbody>
    </table>

    <a href="lap3_vertical_previlage.php">Quay về</a>
</body>

</html>