<?php
require '../display/UserCheck.php';
require_once '../DB/db.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width=320,height=480,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=yes" />
        <title></title>
        <link rel="stylesheet" href="../commonCSS/menu.css">
        <link rel = "stylesheet" href = "./css/PostAdd_Select.css">
    </head>
    <body>
        <div class = "IPhone">
            <?php require '../display/menu.php'?>
<!--            <div class = "menuToggle">-->
<!--                <input type = "checkbox" />-->
<!--                <span></span>-->
<!--                <span></span>-->
<!--                <span></span>-->
<!--                <ul class = "menu">-->
<!--                    <a href = ""><li>Setting</li></a>-->
<!--                    <a href = ""><li>Calendar</li></a>-->
<!--                    <a href = ""><li>Logout</li></a>-->
<!--                    <li class = "title">cyclringer</li>-->
<!--                </ul>-->
<!--            </div>-->
        <button class = "back" onclick = "history.back()"><img src = "./img/back1.png" width = "30" height = "30"></button>
        <h1>Create</h1>
    
        <?php
    try{
        $dbh = getDB();
        }catch (PDOException $e){
        $error['db'] = $e->getMessage();
        }
    $sql = $dbh->prepare('select * from m_course where user_id = ?');
    $sql -> bindValue(1,htmlspecialchars($_SESSION['user']['id']),PDO::PARAM_INT);
    $sql->execute();
    //グループチャットのタイトルを取得
echo '<div class = "a">';
$day = $_GET['days'];
    foreach ($sql as $title){
	echo '<div class = "Room03">';
        	echo '<div class = "deta03">';
        		echo '<form action="../PostAdd/PostAdd.php?day=',$day,'" method="post">';
        		echo '<input type="text" name="days" value="',$title['course_id'],'" style="display:none;">';
			echo '<div class="info">';
				echo '<p><h2>',$title['course_name'],'</h2></p>';
        			echo '<input class="Go" type="submit" value="Go">';
			echo '</div>';
        echo '</form>';
	echo '</div>';
echo '</div>';

    }
    ?>
</div>
        <footer>
            <?php require '../display/footer.php'?>
<!--            <a href = ""><button class = "btn1"><img src = "./img/page.png" width = "119px" height = "85"></button></a>-->
<!--            <a href = ""><button class = "btn2"><img src = "./img/cyclring.png" width = "119px" height = "85"></button></a>-->
<!--            <a href = ""><button class = "btn3"><img src = "./img/post.png" width = "119px" height = "85"></button></a>-->
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