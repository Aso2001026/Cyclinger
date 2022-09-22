<?php
  session_start();

?>
<!DOCTYPE html>
<html>
<head>
  <?php
    $_SESSION['name'] = $_POST['placeName'];
    $_SESSION['lat'] = $_POST['lat'];
    $_SESSION['lng'] = $_POST['lng'];
  ?>
  <meta charset = "utf-8">
  <meta name = "viewport" content = "width=320,height=480,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=yes" />
  <title></title>
  <link rel = "stylesheet" href = "css/CheckPoint1.css">
    <link rel="stylesheet" href="../commonCSS/menu.css">
</head>
<body>
  <div class = "IPhone">
  <button class = "back" onclick = "history.back()"><img src = "img/back1.png" width = "30" height = "30"></button>
  <div class = "Room02">
    <div class = "deta02">
      <p id = "date"></p>
      
      <h3><?php echo $_SESSION['name']?></h3>
    </div>
  </div>

  <div id="map" style="width:100%;height:60vw;"></div>
  <script>
    let la = <?php echo $_SESSION['lat'];?>;
    let ln = <?php echo $_SESSION['lng'];?>;
  </script>
  <script src = "javascript/CheckPoint1.js"></script>
  <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=APIkey&callback=initMap&libraries=places">
  </script>

  <div class = "dista">
    <div class = "kyoi">
      <h3 id = "view_dista"></h3>
    </div>
  </div>
  
  <div class="point">
    <h3>Check Point</h3>
  </div>

  <span class="round_btn" id = "del" onclick = "deleteMarkers([0])"></span>

  <div class = "a">
    <div class="check">
      <h3 id = "view_array"></h3>
  </div>
  </div>
      

  <button class = "record" onclick="location.href='../START/START.php'"><h2>record</h2></button>
  <footer>
      <?php require '../display/footer.php'?>
<!--    <button class = "btn1"><img src = "img/page.png" width = "119" height = "80"></button>-->
<!--    <button class = "btn2"><img src = "img/cyclring.png" width = "119" height = "80"></button>-->
<!--    <button class = "btn3"><img src = "img/post.png" width = "119" height = "80"></button>-->
  </footer>
</div>

</body>
</html>
