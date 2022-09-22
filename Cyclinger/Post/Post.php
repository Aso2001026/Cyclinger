<?php
require '../display/UserCheck.php';
require_once '../DB/db.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=320,height=480,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=yes" />
    <title></title>
    <link rel="stylesheet" href="../commonCSS/menu.css">
    <link rel = "stylesheet" href = "./css/Post.css">
</head>
<body>

<div class = "IPhone">
    <?php require '../display/menu.php'?>
<!--    <div class="ham">-->
<!--        <span class="ham_line ham_line1"></span>-->
<!--        <span class="ham_line ham_line2"></span>-->
<!--        <span class="ham_line ham_line3"></span>-->
<!--    </div>-->
    <form action = "" method = "post">
        <div class = "Form">
            <input type = "text" name = "search">
        </div>
    </form>

    <div class = "a">

        <div class = "Room02">
            <button onclick="location.href='../Goal detail/GoalDetail.php'">
            <div class = "deta02">
                <p>5月20日</p>
                <p><h2>桜井二見ケ浦の夫婦岩</h2></p>
                <p class = "dis">0.00 km</p>
            </div>
            </button>
        </div>

        <div class = "Room02">
            <button onclick="location.href='../Goal detail/GoalDetail.php'">
                <div class = "deta02">
                    <p>5月20日</p>
                    <p><h2>桜井二見ケ浦の夫婦岩</h2></p>
                    <p class = "dis">0.00 km</p>
                </div>
            </button>
        </div>

    </div>

    <footer>
        <?php require '../display/footer.php'?>
<!--        <button class = "btn1"><img src = "./img/page.png" width = "119" height = "80"></button>-->
<!--        <button class = "btn2"><img src = "./img/cyclring.png" width = "119" height = "80"></button>-->
<!--        <button class = "btn3"><img src = "./img/post.png" width = "119" height = "80"></button>-->
    </footer>
</div>
</body>
</html>