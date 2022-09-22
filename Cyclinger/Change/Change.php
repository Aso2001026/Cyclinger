<?php
require '../display/UserCheck.php';
require '../function/CheckFunction.php';
require '../function/DBFunction.php';
require_once '../DB/db.php';

try{
$pdo = getDB();
}catch (PDOException $e){
$error['db'] = $e->getMessage();
}
$error['flag'] = false;
$checkError['flag'] = false;
$changeFlag = false;
if($_SERVER["REQUEST_METHOD"]=="POST"){

    if(isset($_SESSION['user']['mail']) && (isset($_POST['pass']) || isset($_POST['password']))){
        if(!isset($_POST['SetCheck'])){
            $passCheckFlag = loginCheck($_SESSION['user']['mail'],$_POST['pass'],$pdo);
            if(!$passCheckFlag) {
                header("Location: ../title/titleMain3.html");
            }
        }else{
            $checkError += nameCheck($_POST['user']);
            $checkError += passCheck($_POST['password'],$_POST['check_password']);
            $checkError += mailExistCheck($_POST['e-mail'],$pdo);
            $checkError += ageCheck($_POST['Age']);
            if($checkError['name']=== true && $checkError['email'] ===true && $checkError['password'] ===true &&
                $checkError['age']=== true ){
                $checkError['flag'] = true;
//      echo 'flagtest';
            }
        }
    }else{
        header("Location: ../title/titleMain3.html");
    }
    if($checkError['flag'] && isset($_SESSION['user'])){
        $changeFlag = userChange($_POST['user'],$_POST['e-mail'],$_POST['password'],$_POST['Age'],$pdo);
    }
}else{
    header("Location: ../title/titleMain3.html");
}

?>
<?php if ($_SERVER["REQUEST_METHOD"]=="POST" && $changeFlag === true ): ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=320,height=480,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=yes" />
    <title></title>
    <link rel = "stylesheet" href = "./css/Change.css">
    <link rel="stylesheet" href="../commonCSS/menu.css">
</head>
<body>
<div class = "IPhone">
<?php require '../display/menu.php'?>
    <div class = "Form">
    <p>Change completed</p>
<!--    --><?php
//    var_dump($_SESSION);
//    ?>
    </div>
</div>
<footer>
<?php require '../display/footer.php';?>
</footer>
</div>
</body>
</html>
<?php else: ?>
<?php //var_dump($_SESSION);
//var_dump(($_POST));?>
<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=320,height=480,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=yes" />
    <title></title>
    <link rel="stylesheet" href="../commonCSS/menu.css">
    <link rel = "stylesheet" href = "./css/Change.css">
</head>
<body>
<div class = "IPhone">
    <?php require '../display/menu.php'?>
<!--    <div class="ham">-->
<!--        <span class="ham_line ham_line1"></span>-->
<!--        <span class="ham_line ham_line2"></span>-->
<!--        <span class="ham_line ham_line3"></span>-->
<!--    </div>-->
    <!--<button class = "back"><img src = "./img/back1.png" width = "30" height = "30"></button>-->
    <div class = "Form">
        <form action="Change.php" method="post">
        <input type = "text" name = "user" value="<?php if(isset($_POST['name'])){echo $_POST['name'];} elseif (isset
        ($_SESSION['user']['name'])){echo $_SESSION['user']['name'];} ?>">
        <div class = "my_info">
<!--            <img src = "./img/pf.jpg" width = "100" height = "100">-->
<!--            <button class = "plus">+<input type="file" name="image"></button>-->
<!--        </div>-->
            <img id="preview" src = "./img/pf.jpg" width = "100" height = "100" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" style="max-width:200px;">
            <script>
                function previewImage(obj)
                {
                    var fileReader = new FileReader();
                    fileReader.onload = (function() {
                        document.getElementById('preview').src = fileReader.result;
                    });
                    fileReader.readAsDataURL(obj.files[0]);
                }
            </script>
<!--            <form>-->
<!--                <label>-->
<!--                    <input type="file" class="plus" accept='image/*' onchange="previewImage(this);">+-->
<!--                </label>-->
<!--            </form>-->
        </div>
        <p>Pass</p>
        <input type = "password" name = "password" value="
<?php
        if(isset($_POST['pass'])){
            echo $_POST['pass'];
        } elseif (isset($_POST['password'])){
            echo $_POST['password'];
        }
?>">
        <input type = "text" name = "check_password"  value="
<?php
        if(isset($_POST['pass'])){
            echo $_POST['pass'];
        }elseif (isset($_POST['check_password'])){
            echo $_POST['check_password'];
        }
?>">
        <?php if (!empty($checkError["password"]) && $checkError['password'] === 'blank'): ?>
            <p class="error">＊パスワードを入力してください</p>
        <?php elseif (!empty($checkError["password"]) && $checkError['password'] === 'notSame'): ?>
            <p class="error">＊パスワードが一致しません</p>
        <?php elseif  (!empty($checkError["password"]) && $checkError['password'] === 'length'): ?>
            <p class="error">＊パスワードを5桁以上15桁以下にしてください</p>
        <?php endif ?>
        <input type = "date" name = "Age" value="<?php echo $_SESSION['user']['age']; ?>">
        <?php if (!empty($checkError["age"]) && $checkError['age'] === 'notMatch'): ?>
             <p class="error">＊15~120才の方のみ登録できます</p>
        <?php endif ?>
            <p>E-email <!--<br>Can not be changed--></p>
        <input type = "email" name = "e-mail" value="<?php echo $_SESSION['user']['mail']; ?>" readonly>
        <button class = "btn" type="submit" value="true" name="SetCheck">Set</button>
        </form>
    </div>
    <footer>
<?php require '../display/footer.php';?>
    </footer>
</div>
</body>
</html>
<?php
endif;
$pdo = null;
?>
