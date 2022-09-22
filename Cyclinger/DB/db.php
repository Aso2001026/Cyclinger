<?php
function getDB()
{
    $pdo = new PDO(
        'mysql:host=mysql203.phy.lolipop.lan;
dbname=dbname',
        'dbname',
        'Password'
    );
    return $pdo;
}

?>
