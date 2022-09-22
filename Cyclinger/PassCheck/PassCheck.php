<?php
require '../display/UserCheck.php';
require_once '../DB/db.php';
require '../function/CheckFunction.php';
try{
    $pdo = getDB();
}catch (PDOException $e){
    $error['db'] = $e->getMessage();
}
$error['flag'] = false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_SESSION['user']['mail']) && isset($_POST['pass'])){
        $passCheckFlag = loginCheck($_SESSION['user']['mail'],$_POST['pass'],$pdo);
        if($passCheckFlag){
            $error['flag'] = true;
        }else{
            $error['pass'] = 'notMatch';
        }
    }else{
        header("Location: ../title/titleMain.html");
    }
    if($error['flag'] && isset($_SESSION['user'])){
        header("Location: ../Change/Change.php",true,307);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=320,height=480,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=yes" />
    <title></title>
    <link rel = "stylesheet" href = "./css/Pass Check.css">
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
    <form action = "" method = "post">
        <h1>Pass Check</h1>
        <div class = "Form">
            <p>Pass</p>
            <input type = "password" name = "pass">
            <?php if (!empty($error['pass']) && $error['pass'] === 'notMatch'): ?>
                <p class="error">＊入力に間違いがあります。</p>
            <?php endif ?>
        </div>
        <button class = "btn" type="submit">Check</button>
    </form>
</div>
</body>
</html>