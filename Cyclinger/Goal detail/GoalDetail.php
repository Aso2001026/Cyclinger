<?php
require '../display/UserCheck.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=320,height=480,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=yes" />
    <title></title>
    <link rel="stylesheet" href="../commonCSS/menu.css">
    <link rel = "stylesheet" href = "./css/Goal detail.css">
</head>
<body>
<div class = "IPhone">
    <?php require '../display/menu.php'?>
<!--    <div class="ham">-->
<!--        <span class="ham_line ham_line1"></span>-->
<!--        <span class="ham_line ham_line2"></span>-->
<!--        <span class="ham_line ham_line3"></span>-->
<!--    </div>-->
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
    <div class="point">
        <p><h3>Check Point</h3></p>
    </div>
    <button type="submit" class="share"><img src = "img/Share.png" width = "30" height = "30"></button>
    <div class = "a">
        <div class="checkpoint">
            <div class="check">
                <p>CheckPoint1</p>
                <p><h3>志摩中央公園</h3></p>
            </div>
            <div class="check">
                <p>CheckPoint2</p>
                <p><h3>九州大学</h3></p>
            </div>
            <div class="check">
                <p>CheckPoint3</p>
                <p><h3>ヤシの木ブランコ</h3></p>
            </div>
            <div class="check">
                <p>GoalPoint</p>
                <p><h3>桜井二見ケ浦の夫婦岩</h3></p>
            </div>
        </div>
    </div>
    <footer>
        <?php require '../display/footer.php'?>
<!--        <button class = "btn1"><img src = "img/page.png" width = "119" height = "80"></button>-->
<!--        <button class = "btn2"><img src = "img/cyclring.png" width = "119" height = "80"></button>-->
<!--        <button class = "btn3"><img src = "img/post.png" width = "119" height = "80"></button>-->
    </footer>
</div>

</body>
</html>