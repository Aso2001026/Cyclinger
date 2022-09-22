<?php
require '../display/UserCheck.php';

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Title</title>
  <meta name = "viewport" content = "width=320,height=480,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=yes" />
  <link rel = "stylesheet" href = "css/ArrivalPoint.css">
  <link rel="stylesheet" href="../commonCSS/menu.css">
</head>
<body>
<div class = "IPhone">
  <input id="pac-input" class="controls" type="text" placeholder="Search Box" style="top: 5px;z-index: 0;position: absolute;height: 15vw;width: 99%;left: 10px;" autocomplete="off">
  <div id="map" style="width:100%;height:190vw;"></div>
  <form action = "../ChackPoint1/CheckPoint1.php" method = "post">
    <input type = "hidden"id = "placeName" name = "placeName" value = "">
    <input type = "hidden"id = "lat" name = "lat" value = "">
    <input type = "hidden"id = "lng" name = "lng" value = "">

  <div class="enter" id="enter">
    <button class="enter_bnt">NEXT</button>
  </div>

  </form>
  <script src = "javascript/ArrivalPoint.js"></script>
  <script async defer
          src="https://maps.googleapis.com/maps/api/js?key=APIkey&callback=initMap&libraries=places">
  </script>

    <footer>
        <?php require '../display/footer.php'?>
<!--      <a href = ""><button class = "btn1"><img src = "img/page.png" width = "119px" height = "85"></button></a>-->
<!--      <a href = ""><button class = "btn2"><img src = "img/cyclring.png" width = "119px" height = "85"></button></a>-->
<!--      <a href = ""><button class = "btn3"><img src = "img/post.png" width = "119px" height = "85"></button></a>-->
<!--      <button class = "btn1" onclick="location.href='../MyPage/MyPage.php'"><img src = "./img/page.png" width = "119" height ="80"></button>-->
<!--      <button class = "btn2" onclick="location.href='../ArrivalPoint/ArrivalPoint.html'"><img src = "./img/cyclring.png" width = "119" height ="80"></button>-->
<!--      <button class = "btn3"><img src = "./img/post.png" width = "119" height = "80"></button>-->
    </footer>

</div>
</body>
</html>
