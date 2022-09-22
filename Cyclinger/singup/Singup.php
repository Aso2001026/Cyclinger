<?php
require_once '../DB/db.php';
require '../function/SendMailFunction.php';
require '../function/CheckFunction.php';
require '../function/DBFunction.php';

try{
    $pdo = getDB();
}catch (PDOException $e){
    $error['db'] = $e->getMessage();
}
$checkError['flag'] = false;
//print_r($checkError);
if($_SERVER["REQUEST_METHOD"]=="POST"){
//    print_r($_POST);
   $checkError += nameCheck($_POST['user']);
   $checkError += mailCheck($_POST['e-mail'],$pdo);
   $checkError += passCheck($_POST['pass'],$_POST['check_pass']);
   $checkError += ageCheck($_POST['Age']);
   if(!is_null($_POST['Gender'])){
       $checkError += sexCheck($_POST['Gender']);
   }else{
       $checkError['sex'] =  'notMatch';
   }
   if($_POST['Confirm'] === 'true'){
       $checkError['Confirm'] = true;
   }else{
       $checkError['Confirm'] = 'notCheck';
   }
//   print_r($checkError);
   if($checkError['name']=== true && $checkError['email'] ===true && $checkError['password'] ===true &&
       $checkError['age']=== true && $checkError['sex']=== true && $checkError['Confirm'] === true){
       $checkError['flag'] = true;
//      echo 'flagtest';
   }
//   echo $checkError['flag'];
   if($checkError['flag'] === true){
//       echo 'test';
       $checkError['flag'] = false;
       $urltoken = hash('sha256',uniqid(rand(),1));
        $url = "http://aso2001026.itigo.jp/Cyclinger/Completed/Completed.php?urltoken=".$urltoken;
       sendMail($_POST['e-mail'],$url);
       preInsert($urltoken,$_POST['user'],$_POST['e-mail'],$_POST['pass'],$_POST['Age'],$_POST['Gender'],$pdo);
       $checkError['flag'] = true;
//       print_r($checkError);
   }
}


?>

<!DOCTYPE html>

<?php if ($_SERVER["REQUEST_METHOD"]=="POST" && $checkError['flag'] === true ): ?>
    <head>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width=320,height=480,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=yes" />
        <title></title>
        <link rel = "stylesheet" href = "./css/I sent an e-mail.css">
    </head>
    <body>
    <div class = "IPhone">
        <div class = "message">
            <p>I sent an e-mail</p>
        </div>
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
    <link rel = "stylesheet" href = "./css/Signup.css">
</head>
<body>
<div class = "IPhone">
    <form action = "" method = "post">
        <div class = "Form">
            <p>User</p>
            <input type = "text" name = "user">
            <?php if (!empty($checkError["name"]) && $checkError['name'] === 'blank'): ?>
                <p class="error">＊ユーザーネームを入力してください</p>
            <?php elseif (!empty($checkError["name"]) && $checkError['name'] === 'length'): ?>
                <p class="error">＊ユーザーネームは20文字以下までです</p>
            <?php endif ?>
            <p>E-email</p>
            <input type = "text" name = "e-mail">
            <?php if (!empty($checkError["email"]) && $checkError['email'] === 'blank'): ?>
                <p class="error">＊メールアドレスを入力してください</p>
            <?php elseif (!empty($checkError["email"]) && $checkError['email'] === 'duplicate'): ?>
                <p class="error">＊このメールアドレスはすでに登録済みです</p>
            <?php elseif (!empty($checkError["email"]) && $checkError['email'] === 'notMatch'): ?>
                <p class="error">＊メールアドレスの形式が正しくありません</p>
            <?php endif ?>
            <p>Pass</p>
            <input type = "password" name = "pass">
            <?php if (!empty($checkError["password"]) && $checkError['password'] === 'blank'): ?>
                <p class="error">＊パスワードを入力してください</p>
            <?php elseif (!empty($checkError["password"]) && $checkError['password'] === 'notSame'): ?>
                <p class="error">＊パスワードが一致しません</p>
            <?php elseif  (!empty($checkError["password"]) && $checkError['password'] === 'length'): ?>
                <p class="error">＊パスワードを5桁以上15桁以下にしてください</p>
            <?php endif ?>
            <input type = "password" name = "check_pass">
            <p>Age</p>
            <input type = "date" name = "Age">
            <?php if (!empty($checkError["age"]) && $checkError['age'] === 'notMatch'): ?>
                <p class="error">＊15~120才の方のみ登録できます</p>
            <?php endif ?>
            <p>Gender</p>
        </div>
        <div class = "ra">
            <label><input type = "radio" name = "Gender" value = "1" checked>man</label>
            <label><input type = "radio" name = "Gender" value = "2">woman</label>
            <label><input type = "radio" name = "Gender" value = "3">other</label>
            <?php if (!empty($checkError["sex"]) && $checkError['sex'] === 'notMatch'): ?>
                <p class="error">＊いずれかを選択してください</p>
            <?php endif ?>
        </div>
        <div class = "ra">
            <p>Confirm input (入力内容確認ボタン)</p>
            <input type="hidden" name="Confirm" value="false">
            <label><input type = "checkbox" name = "Confirm" value = "true">Yes</label>
            <?php if (!empty($checkError["Confirm"]) && $checkError['Confirm'] === 'notCheck'): ?>
                <p class="error">＊入力内容に間違えがなければ選択してください</p>
            <?php endif ?>
        </div>
        <button type="submit" value="send" class = "btn">Sign up</button>
    </form>
</div>
</body>
<?php endif;
$pdo = null;
?>
</html>
