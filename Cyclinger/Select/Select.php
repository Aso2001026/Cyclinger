<?php session_start() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width=320,height=480,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=yes" />
        <title></title>
        <link rel = "stylesheet" href = "./css/Select.css">
    </head>
    <body>
        <?php
        echo '<div class="IPhone">';
        $days = $_GET['days'];
        echo '<div class="btn1">','<a href = "../PostList/PostList.php?days=',$days,'">','Join</div>';
        echo '<div class="btn2">','<a href = "../PostAdd_Select/PostAdd_Select.php?days=',$days,'">','Post</div>';
        ?>
    </body>
</html>