<?php
session_start();
require '../function/logoutFunction.php';
if(empty($_SESSION['user'])){
   header("Location: ../title/titleMain3.html");
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if($_POST['logout'] == 1 ){
        logout();
        header("Location: ../title/titleMain3.html");
    }elseif($_POST['logout'] == 2){
        header("Location: ../MyPage/MyPage.php");
    }else{
        header("Location: ../title/titleMain3.html");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=320,height=480,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=yes" />
    <title></title>
    <link rel="stylesheet" href="../commonCSS/menu.css">
    <link rel = "stylesheet" href = "css/Logout.css">
</head>
<body>
<div class = "IPhone">
    <p>ログアウトしますか？</p>
    <form action="" method="post">
    <button class = "btn" value="1" type="submit" name="logout">Yes</button>
    <button class = "btn1" value="2" type="submit" name="logout">No</button>
    </form>
    <footer>
        <?php require '../display/footer.php'?>
<!--        <button class = "btn2"><a href=""><img src="img/page.png" width="119" height="80"></a> </button>-->
<!--        <button class = "btn3"><a href=""><img src="img/cyclring.png" width="119" height="80"></a> </button>-->
<!--        <button class = "btn4"><a href=""><img src="img/post.png" width="119" height="80"></a> </button>-->
    </footer>
</div>
</body>
</html>