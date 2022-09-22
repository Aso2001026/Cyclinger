<?php
session_start();

?>

<!DOCTYPE html>
<html lang = "ja">
<head>
    <meta charset="UTF-8">
    <title>Map</title>
    <meta name = "viewport" content = "width=320,height=480,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=yes" />
    <link rel = "stylesheet" href = "Main.css">
</head>
<body>
<div class = "IPhone">
    <button class = "Mv_On" id = "Mv_On">Move</button>
    <div class = "ba" id = "ba">
        <p class = "chN">チェックポイント付近</p>
        <button class = "p2" id = "p2">CheckPoint</button>
        <button class = "p3" id = "p3">Back</button>
    </div>
    <h5 id = "view_h"></h5>
    <div id="map" style="width:100%;height:190vw;"></div>
    <script src = "./javascript/Main.js"></script>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=APIkey&callback=initMap&libraries=places">
    </script>
    <div class = "st">
        <!--ポップアップ-->
        <button class = "stop" id = "stop" onclick="location.href='../Share/Share.php'">Stop</button>
    </div>
    <footer>

        <?php require '../display/footer.php'?>
<!--        <button class = "btn1" onclick="location.href='../MyPage/MyPage.php'"><img src = "./img/page.png" width = "119" height ="80"></button>-->
<!--        <button class = "btn2" onclick="location.href='../ArrivalPoint/ArrivalPoint.html'"><img src = "./img/cyclring.png" width = "119" height ="80"></button>-->
<!--        <button class = "btn3" onclick="location.href='../Post/Post.php'"><img src = "./img/post.png" width = "119"-->
<!--                                                                               height =-->
<!--                                                                               "80"></button>-->
        <!--            <a href = ""><button class = "btn1"><img src = "../img/page.png" width = "119px" height = "85"></button></a>-->
        <!--            <a href = ""><button class = "btn2"><img src = "../img/cyclring.png" width = "119px" height = "85"></button></a>-->
        <!--            <a href = ""><button class = "btn3"><img src = "../img/post.png" width = "119px" height = "85"></button></a>-->
    </footer>
</div>
</body>
</html>