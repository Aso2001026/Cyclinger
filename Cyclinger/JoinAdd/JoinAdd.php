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
        <link rel = "stylesheet" href = "./css/JoinAdd.css">
    </head>
    <body>
        <div class = "IPhone">
            <?php require '../display/menu.php'?>
<!--            <div class="ham">-->
<!--                <span class="ham_line ham_line1"></span>-->
<!--                <span class="ham_line ham_line2"></span>-->
<!--                <span class="ham_line ham_line3"></span>-->
<!--            </div>-->
            <button class = "back" onclick = "history.back()"><img src = "img/back1.png" width = "30" height = "30"></button>
            <form action="" method="post">
                <?php
                try{
                    $pdo = getDB();
                    }catch (PDOException $e){
                    $error['db'] = $e->getMessage();
                    }
                echo <<< END
            <div class = "Room02">
              <div class = "deta02">
            <form action = "" method = "post">
            END;
            try{
                $dbh = getDB();
                }catch (PDOException $e){
                $error['db'] = $e->getMessage();
                }
            $sql = $dbh->prepare('select * from t_RecruitmentBulletinBoard where RecruitmentbulletinBoard_id = ?');
            $sql -> bindValue(1,$_POST['days'],PDO::PARAM_INT);
            $sql->execute();
                foreach ($sql as $title){
                    echo '<input type="text" name="itle" value="',$title['RecruitmentbulletinBoard_id'],'" style="display:none;">';
            echo '<p><h1>',$title['RecruitmentbulletinBoard_title'],'</h1></p>';
                }
                    echo <<< END

                    
                
              </div>
            </div>
            <div class = "dista">
                <div class = "kyoi">                      
                    <p><h3>距離</h3></p>
                </div>
            </div>
            <div class = "posad">
            END;
                try{
                    $dbmt = getDB();
                }catch (PDOException $e){
                    $error['db'] = $e->getMessage();
                }
                $sqls = $dbmt->prepare('select * from t_RecruitmentBulletinBoard where RecruitmentbulletinBoard_id = ?');
                $sqls -> bindValue(1,$_POST['days'],PDO::PARAM_INT);
            $sqls->execute();
                foreach ($sqls as $exm){
                echo '<textarea name = "story" row = "5" cols = "33" readonly="readonly">',$exm["RecruitmentbulletinBoard_explanation"],'</textarea>';
               echo '<div class = "np">';
                echo '<p>post nm-um</p>';
                echo '<h3>',$exm['participantUser_num'],'</h3>';
                echo '</div>';
                }
            echo <<< END
            </div> 
                <button type="submit" class="SubPos" name="send" >Join</button>
            END;
            ?>
            </form>       
            <footer>
                <?php require '../display/footer.php'?>
<!--                <button class = "btn1"><img src = "img/page.png" width = "119" height = "80"></button>-->
<!--                <button class = "btn2"><img src = "img/cyclring.png" width = "119" height = "80"></button>-->
<!--                <button class = "btn3"><img src = "img/post.png" width = "119" height = "80"></button>-->
            </footer>
            </div>
        
    </body>
    <section>
        <?php 
        if(isset($_POST["send"])) {
            insert();
        }
//           function connectDB() {
//            $dbh = new PDO('mysql:host=mysql203.phy.lolipop.lan;
//            dbname=LAA1290570-kaihatu;charset=utf8',
//                'LAA1290570',
//                '0617');
//            return $dbh;
//        }
        require_once '../DB/db.php';

        function insert() {
            try{
                $dbh = getDB();
                }catch (PDOException $e){
                $error['db'] = $e->getMessage();
                }
            $sqls = $dbh->prepare('select * from t_participantUser where RecruitmentbulletinBoard_id = ?');
            $sqls -> bindValue(1,$_POST['days'],PDO::PARAM_INT);
            $sqls->execute();
            $count = $sqls -> rowCount();
            $sql = "insert into t_participantUser (user_id,RecruitmentbulletinBoard_id,participant_num) VALUES (:uid,:id,:num)";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':uid',$_SESSION['user']['id'],PDO::PARAM_STR);
            $stmt->bindParam(':id',$_POST['itle'],PDO::PARAM_STR);
            $stmt->bindParam(':num',$count,PDO::PARAM_STR);
            $stmt->execute();
            echo <<<EOF
<script>
    location.href='../ChatList/ChatList.php';
</script>
EOF;
        }
        ?>
    </section>
</html>