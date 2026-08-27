<?php
if(isset($_POST['submit'])){
    $error = [];
    $number = $_POST['number'];

    if($number > 2 || $number < 1){
        $error['error_number'] = 'Số lượng vé không hợp lệ';   
    }else{
        $error['success_number'] = 'Đặt vé thành công';  
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
    <style>
        label{
            display: block;
            margin: 5px 0;
        }
        input{
            display: block;
            margin: 5px 0;
        }
        button{
            display: inline-block;
        }
        .error{
            color: red;
            margin: 5px;
        }

        .success{
            color: green;
            margin: 5px;
        }
    </style>
    <h1>MUA VÉ XEM PHIM</h1>
    <p>Yêu cầu đề bài (Đặt vé với số lương lớn hơn 2)</p>
    <img src="./images/lap2.png" alt="">
    <form action="#" method="post">
        <label for="number">Số lượng</label>

        <input type="number" name="number" id="number" min='1' max='2' value='1'>

        <button type="submit" name="submit">Đặt vé</button>

        <?php  if(isset($error['error_number'])){ ?>
            <div class="error">
                <?php echo $error['error_number'] ?>
            </div>
        <?php } ?>

        <?php  if(isset($error['success_number'])){ ?>
            <div class="success">
                <?php echo $error['success_number'] ?>
            </div>
        <?php } ?>
        
    </form>
    
</body>
</html>