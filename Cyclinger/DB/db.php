<?php
function getDB()
{
    $pdo = new PDO(
        'mysql:host=mysql203.phy.lolipop.lan;
dbname=LAA1290630-cyclinger;charaset=utf8',
        'LAA1290630',
        'PassCyclinger'
    );
    return $pdo;
}

?>