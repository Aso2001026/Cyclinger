<?php 
session_start();
require_once '../DB/db.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=320,height=480,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=yes" />
    <title></title>
    <link rel="stylesheet" href="../commonCSS/menu.css">
    <link rel = "stylesheet" href = "./css/PostList.css">
</head>
<body>
<div class = "IPhone">
    <?php require '../display/menu.php'?>
<!--    <div class="ham">-->
<!--        <span class="ham_line ham_line1"></span>-->
<!--        <span class="ham_line ham_line2"></span>-->
<!--        <span class="ham_line ham_line3"></span>-->
<!--    </div>-->
	<button class="back" onclick = "history.back()"><img src = "./img/back1.png" width = "30" height = "30"></button>
	<h1>Recruitment</h1>
        <?php
    
    try{
        $dbh = getDB();
        }catch (PDOException $e){
        $error['db'] = $e->getMessage();
        }
    $sql = $dbh->prepare('select * from t_RecruitmentBulletinBoard');
    $sql->execute();
    //グループチャットのタイトルを取得
echo '<div class = "a">';
  foreach ($sql as $title){
        if($title['schedule_date']==$_GET['days']){
	echo '<div class = "Room03">';
        	echo '<div class = "deta03">';
        		echo '<form action="../JoinAdd/JoinAdd.php" method="post">';
        		echo '<input type="text" name="days" value="',$title['RecruitmentbulletinBoard_id'],'" style="display:none;">';
			echo '<div class="info">';
				echo '<p><h2>',$title['RecruitmentbulletinBoard_title'],'</h2></p>';
        			echo '<input class="Go" type="submit" value="Go">';
			echo '</div>';
        echo '</form>';
	echo '</div>';
echo '</div>';
        }
    }
    ?>
</div>
    <footer>
        <?php require '../display/footer.php'?>
<!--        <button class = "btn1"><img src = "./img/page.png" width = "119" height = "80"></button>-->
<!--        <button class = "btn2"><img src = "./img/cyclring.png" width = "119" height = "80"></button>-->
<!--        <button class = "btn3"><img src = "./img/post.png" width = "119" height = "80"></button>-->
    </footer>
</div>
</body>
<section>
        <?php 
           /*function connectDB() {
            $dbh = new PDO('mysql:host=mysql203.phy.lolipop.lan;
            dbname=LAA1290570-kaihatu;charset=utf8',
                'LAA1290570',
                '0617');
            return $dbh;
        }*/
        ?>
    </section>
</html>