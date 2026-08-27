<?php

if(isset($_POST['submit'])){
    $basePrice = 500000;
    $error = [];
    $number = $_POST['number'];
    $price = $_POST['price'];
    $result = $number * $price;

    // Kiểm tra giá vé tại server
    if($price < 500000){
        $error['error'] = 'Giá vé không hợp lệ';   
    }else{
        $error['success'] = 'Thanh toán thành công';  
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

        .result{
            margin: 10px 0;
        }
    </style>
    <h1>MUA SẢN PHẨM</h1>
    <p>Yêu cầu đề bài (Mua được sản phẩm thấp hơn giá được niêm yết trên giao diện)</p>
    <form action="#" method="post">  
        <img src="./images/lap2.png" alt="">
        <h1>500.000VNĐ</h1>
       
        <label for="number">Số lượng</label>
        <input type="number" name="number" id="number" min='1' max='2' value='1'>

        <!-- Giá vé không an toàn -->
         
        <input type="hidden" name="price" id="price" value="500000">

        <button type="submit" name="submit">Thanh toán</button>

        <?php  if(isset($error['error'])){ ?>
            <div class="error">
                <?php echo $error['error'] ?>
            </div>
        <?php } ?>

        <?php  if(isset($error['success'])){ ?>
            <div class="success">
                <?php echo $error['success'] ?>
            </div>
        <?php } ?>
    </form> 

    <div class="result">
        <?php if(isset($number)) { ?>
            Số lượng vé đã đặt : <?php echo $number ?>
        <?php } ?>

        <?php if(isset($result)) { ?>
            Tổng tiền : <?php echo $result ?>
        <?php } ?>
    </div>
    
   
    
</body>
</html>