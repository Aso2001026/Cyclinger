<?php
require '../display/UserCheck.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=320,height=480,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=yes" />
    <title></title>
    <link rel = "stylesheet" href = "./css/Share.css">
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
<!--    <button class = "back"><img src = "img/back1.png" width = "30" height = "30"></button>-->
    <div class = "Room02">
        <div class = "deta02">
            <p>5月20日</p>
            <p><h3>桜井二見ケ浦の夫婦岩</h3></p>
        </div>
    </div>
    <div class = "dista">
        <div class = "kyoi">
            <p>目的地</p>
            <p><h3>桜井二見ケ浦の夫婦岩</h3></p>
        </div>
    </div>
    <div class="comment">
        <p><h3>Comment</h3></p>
    </div>
    <div class = "a">
        <div class="in">
            <textarea name="massage" rows="6" cols="50"
                      placeholder="こちらにルート詳細をご記入ください"></textarea>
        </div>
    </div>
    <button class = "share" onclick="location.href='../Createroute/Createroute.php'"><h2>Shere</h2></button>
    <footer>
        <?php require '../display/footer.php'?>
<!--        <button class = "btn1"><img src = "img/page.png" width = "119" height = "80"></button>-->
<!--        <button class = "btn2"><img src = "img/cyclring.png" width = "119" height = "80"></button>-->
<!--        <button class = "btn3"><img src = "img/post.png" width = "119" height = "80"></button>-->
    </footer>
</div>

</body>
</html>