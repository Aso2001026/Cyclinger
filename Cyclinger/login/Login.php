<?php
session_start();
require_once '../DB/db.php';
require '../function/CheckFunction.php';
require '../function/DBFunction.php';

try{
    $pdo = getDB();
}catch (PDOException $e){
    $error['db'] = $e->getMessage();
}

$error['flag'] = false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST['e-mail']) && isset($_POST['pass'])){
        $loginFlag = loginCheck($_POST['e-mail'],$_POST['pass'],$pdo);
        if($loginFlag){
            login($_POST['e-mail'],$pdo);
            $error['flag'] = true;
        }else{
            $error['login'] = 'notMatch';
        }
    }else{
        $error['form'] = 'notMatch';
        header("Location:".$_SERVER['PHP_SELF']);
    }
    if($error['flag'] && isset($_SESSION['user'])){
        header("Location: ../MyPage/MyPage.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=320,height=480,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=yes" />
    <title></title>
    <link rel = "stylesheet" href = "./css/Login.css">
</head>
<body>
<div class = "IPhone">
    <form action = "" method = "post">
        <div class = "Form">
            <p>E-email</p>
            <input type = "text" name = "e-mail">
            <p>Pass</p>
            <input type = "password" name = "pass"></br>
            <?php if (!empty($error['login']) && $error['login'] === 'notMatch'): ?>
                <p class="error">＊入力に間違いがあります。</p>
            <?php endif ?>
            <a href = "../singup/Singup.php" class ="newAco">Create Account</a>
        </div>
    <button type="submit" value="send" class = "Login">Login</button>
    </form>
</div>
</body>
</html>