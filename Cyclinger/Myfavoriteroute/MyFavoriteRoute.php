<?php
require '../display/UserCheck.php';
require_once '../DB/db.php';
require '../function/DBFunction.php';
try{
    $pdo = getDB();
}catch (PDOException $e){
    $error['db'] = $e->getMessage();
}
$flag = false;
$favorite = myFavoriteSelect($_SESSION['user']['id'],$pdo);
if($favorite != false){
    $flag = true;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=320,height=480,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=yes" />
    <title></title>
    <link rel = "stylesheet" href = "./css/My favorite route.css">
    <link rel="stylesheet" href="../commonCSS/menu.css">
</head>
<body>
<div class = "IPhone">
    <?php require '../display/menu.php';?>
<!--    <div class="ham">-->
<!--        <span class="ham_line ham_line1"></span>-->
<!--        <span class="ham_line ham_line2"></span>-->
<!--        <span class="ham_line ham_line3"></span>-->
<!--    </div>-->
<!--    <button class = "back"><img src = "./img/back1.png" width = "30" height = "30"></button>-->
    <?php require '../display/BackButton.php';?>
    <h1>My favorite route</h1>

    <div class = "a">
        <?php
        if($flag){
            $result = $favorite->fetchAll(PDO::FETCH_ASSOC);
//  var_dump($result);
            $count = 0;

            foreach ($result as $row){
                $date = date('m月d日', strtotime($row['reg_date']));
                if(is_null($row['course_distance'])){
                    $distance = "距離不明";
                }else{
                    $distance = (string) $row['course_distance'];
//                    var_dump($row['course_distance']);
                    $distance = $distance." km";
                }
                if($count == 0){
echo <<< EDF
<div class = "Room">
            <div class = "deta">
                <p>{$date}</p>
                <p><h2>{$row['course_name']}</h2></p>
                <p class = "dis">{$distance}</p>
            </div>
        </div>
EDF;
                }else{
                    echo <<< EDF
<div class = "Room02">
            <div class = "deta02">
                <p>{$date}</p>
                <p><h2>{$row['course_name']}</h2></p>
                <p class = "dis">{$distance}</p>
            </div>
        </div>
EDF;
                }
                $count++;

            }
        }
        ?>
<!--        <div class = "Room">-->
<!--            <div class = "deta">-->
<!--                <p>5月20日</p>-->
<!--                <p><h2>桜井二見ケ浦の夫婦岩</h2></p>-->
<!--                <p class = "dis">0.00 km</p>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class = "Room02">-->
<!--            <div class = "deta02">-->
<!--                <p>5月21日</p>-->
<!--                <p><h2>志摩中央公園</h2></p>-->
<!--                <p class = "dis">0.00 km</p>-->
<!--            </div>-->
<!--        </div>-->
    </div>
    <footer>
        <?php require '../display/footer.php'; ?>
<!--        <button class = "btn1"><img src = "./img/page.png" width = "119" height = "80"></button>-->
<!--        <button class = "btn2"><img src = "./img/cyclring.png" width = "119" height = "80"></button>-->
<!--        <button class = "btn3"><img src = "./img/post.png" width = "119" height = "80"></button>-->
    </footer>
</div>
</body>
</html>
<?php

?>