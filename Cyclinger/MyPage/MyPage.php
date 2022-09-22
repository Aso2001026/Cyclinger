<?php
session_start();
//print_r($_SESSION);

require_once '../DB/db.php';
require '../function/DBFunction.php';

try{
    $pdo = getDB();
}catch (PDOException $e){
    $error['db'] = $e->getMessage();
}

$sumDistance = 0;
$distanceResult = false;
if(isset($_SESSION['user'])){
    if(isset($_SESSION['user']['id'])){
        $distanceResult = sumDistance($_SESSION['user']['id'],$pdo);
//        var_dump($distanceResult);
    }
    if(is_null($distanceResult['sumDistance'])){
        $sumDistance = 0;
    }else{
        $sumDistance = $distanceResult['sumDistance'];
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=320,height=480,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=yes" />
    <title>My Page</title>
    <link rel = "stylesheet" href = "./css/MyPage.css">
    <link rel="stylesheet" href="../commonCSS/menu.css">
</head>
<body>
<div class = "IPhone">
    <?php require '../display/menu.php'?>
<!--    <div class="ham">-->
<!--        <span class="ham_line ham_line1"></span>-->
<!--        <span class="ham_line ham_line2"></span>-->
<!--        <span class="ham_line ham_line3"></span>-->
<!--    </div>-->
<!--    --><?php //require '../display/BackButton.php'?>
<!--    <button class = "back" onclick="location.href=''"><img src = "./img/back1.png" width = "30" height = "30" onclick="location.href=''"></button>-->
    <div class = "my_info">
        <?php if (!empty($_SESSION["user"]['name'])): ?>
            <h1><?php echo $_SESSION["user"]['name']?></h1>
        <?php else: ?>
            <h1>Guests</h1>
        <?php endif ?>
        <img src = "./img/pf.jpg" width = "100" height = "100">
        <?php if (!empty($_SESSION["user"]['id'])): ?>
            <h2>ID <?php echo $_SESSION["user"]['id']?></h2>
        <?php else: ?>
            <h2>ID 00000</h2>
        <?php endif ?>
        <div class = "total">
            <p>total</p>
            <h2><?php echo $sumDistance;?> km</h2>
        </div>
        <button class = "fav" onclick="location.href='../Myfavoriteroute/MyFavoriteRoute.php'"><h2>My favorite route</h2></button>
        <button class = "data" onclick="location.href='../Data/Data.php'"><h2>My data</h2></button>
        <button class = "dreR" onclick="location.href='../Createroute/Createroute.php'"><h2>create route</h2></button>
    </div>
    <footer>
<!--        <button class = "btn1"><img src = "./img/page.png" width = "119" height = "80"></button>-->
<!--        <button class = "btn2"><img src = "./img/cyclring.png" width = "119" height = "80"></button>-->
<!--        <button class = "btn3"><img src = "./img/post.png" width = "119" height = "80"></button>-->
        <?php require '../display/footer.php'?>
    </footer>
</div>
</body>
</html>