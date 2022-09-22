<?php
require_once '../DB/db.php';
require '../function/DBFunction.php';
require  '../function/CheckFunction.php';

try{
    $pdo = getDB();
}catch (PDOException $e){
    $error['db'] = $e->getMessage();
}
$checkError['flag'] = false;

if($_SERVER["REQUEST_METHOD"]=="GET" && isset($pdo)){
    if(is_null($_GET['urltoken'])){
        $checkError['token'] = 'nothing';
    }else if(isset($_GET['urltoken'])){
        $checkError +=  tokenCheck($_GET['urltoken'],$pdo);
    }else{
        $checkError['token'] = 'nothing';
    }
    if($checkError['token'] === true){
        $checkError += mailCountCheck($_GET['urltoken'],$pdo);
    }else{
        $checkError['email'] = false;
    }
    if($checkError['token'] === true && $checkError['email'] === true){
        if(userInsert($_GET['urltoken'],$pdo)) {
            $checkError['flag'] = true;
        }else{
            $checkError['flag'] = 'DBerror';
        }
    }
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"]=="GET" && $checkError['flag'] === true ):
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset = "utf-8">
  <meta name = "viewport" content = "width=320,height=480,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=yes" />
  <title></title>
  <link rel = "stylesheet" href = "./css/Completed.css">
</head>
<body>
<div class = "IPhone">
  <div class = "message">
    <p>Thank  You <br><p2>for</p2> Registration Completed!!!</p>
    </div>
  <p>Let's enjoy Cyclinger</p>
  <button class = "MyPage" onclick="location.href='../login/Login.php'"><a href="../login/Login.php">
          Loginへ</a></button>
</div>
</body>
</html>
<?php else: ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width=320,height=480,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=yes" />
        <title></title>
        <link rel = "stylesheet" href = "./css/Completed.css">
    </head>
    <body>
    <div class = "IPhone">
        <div class = "message">
            <?php if ($_SERVER["REQUEST_METHOD"] !="GET"): ?>
                <p>Error:Method miss</p>
            <?php elseif (!empty($checkError["token"]) && $checkError['token'] === 'urltoken_timeover'): ?>
                <p>Error:Time over or token miss</p>
            <?php elseif (!empty($checkError["token"]) && $checkError['token'] === 'nothing'): ?>
                <p>Error:Token is nothing</p>
            <?php elseif (!empty($checkError["email"]) && $checkError['email'] === 'duplicate'): ?>
                <p>Error:This mail is registered</p>
            <?php elseif (!empty($checkError["flag"]) && $checkError['flag'] === 'DBerror'): ?>
                <p>Error:Insert miss</p>
            <?php endif ?>
        </div>
        <p>Let's enjoy Cyclinger</p>
        <button class = "MyPage" onclick="location.href='../singup/Singup.php'"><a href="../singup/Singup.php">
                SingUpへ</a></button>
    </div>
    </body>
    </html>
<?php endif;
$pdo = null;
?>
