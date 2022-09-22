<?php 
session_start();
require_once '../DB/db.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
<meta name = "viewport" content = "width=320,height=480,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=yes" />
    <title>Cyclinger</title>
    <link rel = "stylesheet" href = "./css/Chat.css">
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
    <button class="back" onclick = "location.href='../ChatList/ChatList.php'"><img src = "./img/back1.png" width = "30" height =
        "30"></button>
    <?php
    
    try{
        $dbh = getDB();
        }catch (PDOException $e){
        $error['db'] = $e->getMessage();
        }
    $sql = $dbh->prepare('select * from t_RecruitmentBulletinBoard
    where RecruitmentbulletinBoard_id = ? ');
    $sql -> bindValue(1,$_POST['days'],PDO::PARAM_INT);
    $sql->execute();
    //グループチャットのタイトルを取得

    echo '<form action = "" method = "post">';
    echo '<input type="text" name="days" value="',$_POST['days'],'" readonly="readonly" style="display:none;">';
    echo '<input type="text" name="comment" value="///^^/" readonly="readonly" style="display:none;">';
    echo '<button type="submit" class="reload blue"></button>';
    echo '</form>';

    foreach ($sql as $title){
        echo '<div class = "Room02">';
        echo '<div class = "deta02" name="days">';
        echo '<p>',$title['schedule_date'],'</p>';
        echo '<p><h3>',$title['RecruitmentbulletinBoard_title'],'</h3></p>';
        echo '</div>';
        echo '</div>';
    }
     // DBからデータ(投稿内容)を取得 
           $stmt = select(); 
            $chat = $stmt->fetchAll(PDO::FETCH_ASSOC);
                // 投稿内容を表示
                echo '<div class = "a">';
                    echo '<div class="kaiwa line">';
                        echo '<div class="name">';
                             echo $_SESSION['user']['name'];;
                        echo '</div>';
                        foreach($chat as $chats){
                            if($chats['RecruitmentbulletinBoard_id'] == $_POST['days']){
                                if($chats['user_id'] != $_SESSION['user']['id']){
                                        echo '<div class="fukidasi right">';
                                        echo $chats['comment'];
                                        echo '</div>';
                                        }else{
                                        echo '<div class="fukidasi left">';
                                        echo $chats['comment'];
                                        echo '</div>';
                                        }
                            }
                        }
                        if(isset($_POST["send"])) {
                            $ks = "///^^/";
                            if(!(strstr($_POST['comment'],$ks))){
                            insert();
                            }
                            // 投稿した内容を表示
                           $stmt = select_new();
                           $chat = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            // 投稿内容を表示
                            foreach($chat as $chats){
                                if($chats['RecruitmentbulletinBoard_id'] == $_POST['days']){
                                    if($chats['user_id'] != $_SESSION['user']['id']){
                                        echo '<div class="fukidasi right">';
                                        echo $chats['comment'];
                                        echo '</div>';
                                        }else{
                                        echo '<div class="fukidasi left">';
                                        echo $chats['comment'];
                                        echo '</div>';
                                        }                  
        			 }
                            }
                        }
                echo '</div>';
	echo '</div>';
            


    ?>
<form action = "" method = "post">
        <div class = "Form">
    <?php
        echo '<input type="text" name="days" value="',$title['RecruitmentbulletinBoard_id'],'" readonly="readonly" style="display:none;">';
    ?>
            <input type="text" name="comment" value="">
        </div>
        <button type="submit" class="arrow sample1-1" name="send" ></button>
    </form>
    <footer>
        <?php require '../display/footer.php'?>
<!--        <button class = "btn1"><img src = "img/page.png" width = "119" height = "80"></button>-->
<!--        <button class = "btn2"><img src = "img/cyclring.png" width = "119" height = "80"></button>-->
<!--        <button class = "btn3"><img src = "img/post.png" width = "119" height = "80"></button>-->
    </footer>
</div>
</body>
<section>
        <?php // DBからデータ(投稿内容)を取得 
           

           
 
            // DB接続
            /*function connectDB() {
                $dbh = new PDO('mysql:host=mysql203.phy.lolipop.lan;
                dbname=LAA1290570-kaihatu;charset=utf8',
                    'LAA1290570',
                    '0617');
                return $dbh;
            }*/
 
            // DBから投稿内容を取得
            function select() {
                try{
                    $dbh = getDB();
                    }catch (PDOException $e){
                    $error['db'] = $e->getMessage();
                    }
                $sql = "SELECT * FROM t_RecruitmentBulletinBoardComment ORDER BY comment_id";
                $stmt = $dbh->prepare($sql);
                $stmt->execute();
                return $stmt;
            }
 
            // DBから投稿内容を取得(最新の1件)
            function select_new() {
                try{
                    $dbh = getDB();
                    }catch (PDOException $e){
                    $error['db'] = $e->getMessage();
                    }
                $sql = "SELECT * FROM t_RecruitmentBulletinBoardComment ORDER BY comment_id desc limit 1";
                $stmt = $dbh->prepare($sql);
                $stmt->execute();
                return $stmt;
            }
 
            // DBから投稿内容を登録
            function insert() {
                try{
                    $dbh = getDB();
                    }catch (PDOException $e){
                    $error['db'] = $e->getMessage();
                    }
                $sqls = "select * from t_RecruitmentBulletinBoardComment";
                $sth = $dbh -> query($sqls);
                $count = $sth -> rowCount();
                $sql = "insert into  t_RecruitmentBulletinBoardComment (RecruitmentbulletinBoard_id,comment_id,user_id,comment) VALUES (:id,:count,:user,:comment)";
		        $stmt = $dbh->prepare($sql);
                $stmt->bindParam(':id',$_POST['days'],PDO::PARAM_STR);
                $stmt->bindParam(':count',$count,PDO::PARAM_STR);
		$stmt->bindParam(':user',$_SESSION['user']['id'],PDO::PARAM_STR);
                $stmt->bindParam(':comment',$_POST['comment'],PDO::PARAM_STR);
                $stmt->execute();
            }
        ?>
    </section>
</html>