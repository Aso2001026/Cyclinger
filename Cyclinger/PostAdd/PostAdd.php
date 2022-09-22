<?php
require '../display/UserCheck.php';
require_once  '../DB/db.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width=320,height=480,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=yes" />
        <title></title>
        <link rel="stylesheet" href="../commonCSS/menu.css">
        <link rel = "stylesheet" href = "./css/PostAdd.css">
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
            $sql = $dbh->prepare('select * from m_course where course_id = ?');
            $sql -> bindValue(1,$_POST['days'],PDO::PARAM_INT);
            $sql->execute();
                foreach ($sql as $title){
                    echo '<input type="text" name="itle" value="',$title['course_name'],'" style="display:none;">';
            echo '<p><h1>',$title['course_name'],'</h1></p>';
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
                <textarea name = "story" row = "5" cols = "33" placeholder = "コメント入力"></textarea>
                <div class = "np">
                <p>post nm-um</p>
                <select name = "num">
                    <option value = "1">1</option>
                    <option value = "2">2</option>
                    <option value = "3">3</option>
                    <option value = "4">4</option>
                </select>
                </div>
            </div> 
                <button type="submit" class="SubPos" name="send" >Post</button>
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
           /*function connectDB() {
            $dbh = new PDO('mysql:host=mysql203.phy.lolipop.lan;
            dbname=LAA1290570-kaihatu;charset=utf8',
                'LAA1290570',
                '0617');
            return $dbh;
        }*/

        function insert() {
            try{
                $dbh = getDB();
                }catch (PDOException $e){
                $error['db'] = $e->getMessage();
                }
            $sqls = "select * from t_RecruitmentBulletinBoard";
            $sth = $dbh -> query($sqls);
            $count = $sth -> rowCount();
            $sql = "insert into  t_RecruitmentBulletinBoard (user_id,RecruitmentbulletinBoard_title,course_id,schedule_date,participantUser_num,RecruitmentbulletinBoard_explanation)
 VALUES (:uid,:title,:id,:day,:num,:exp)";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':uid',$_SESSION['user']['id'],PDO::PARAM_STR);
            $stmt->bindParam(':title',$_POST['itle'],PDO::PARAM_STR);
            $stmt->bindParam(':id',$count,PDO::PARAM_STR);
	        $stmt->bindParam(':day',$_GET['day'],PDO::PARAM_STR);
            $stmt->bindParam(':num',$_POST['num'],PDO::PARAM_STR);
            $stmt->bindParam(':exp',$_POST['story'],PDO::PARAM_STR);
            $stmt->execute();
	  echo <<<EOF
<script>
    location.href='../Calender/Calender.php';
</script>
EOF;
        }
        ?>
    </section>
</html>