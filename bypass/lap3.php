<?php

if(isset($_POST['submit'])){
    $basePrice = 500000;
    $error = [];
    $result = null;
    $number = $_POST['number'];
    $discount = $_POST['discount'];

    // Kiểm tra giá vé tại server
    if($discount > 0){
        $error['error'] = 'Lỗi, không hợp lệ vui lòng thử lại sau';   
    }else{
        $error['success'] = 'Thanh toán thành công';  
    }
    
    if(!isset($error['error'])){
        $discount_price = ($basePrice / 100) * $discount;
        if($discount > 0) {
            $result = $number * ($basePrice - $discount_price);
        }else{
            $result = $number * $basePrice;
        }
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
    <h1>MUA SẢN PHẨM (GIẢM GIÁ)</h1>
    <p>Yêu cầu đề bài (Mua sản phẩm với % giảm giá)</p>
    <form action="#" method="post">  
        <img src="./images/lap2.png" alt="">
        <h1>500.000VNĐ</h1>

        <label for="number">Số lượng</label>
        <input type="number" name="number" id="number" min='1' max='2' value='1'>

        <label for="discount">Giảm giá</label>
        <input type="number" name="discount" id="discount" min='1' max='10' value='0' readonly>
        
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