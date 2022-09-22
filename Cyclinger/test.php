<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Test</title>

    <link rel="stylesheet" href="../commonCSS/menu.css">

</head>
<body>
<?php
$test[][] = null;
$test['test'] =1;
$test['test']['test'] =1;

$test1['test1'] =1;
$test1['test1']['test1'] =1;

$testA = $test;
print_r($testA);
$testA = $test1;
print_r($testA);


?>

<?php require '../display/menu.php'?>
<?php require '../display/BackButton.php'?>
<?php require '../display/footer.php'?>
<?php
try{
$pdo = getDB();
}catch (PDOException $e){
$error['db'] = $e->getMessage();
}

$pdo = null;
?>
<?php
//header("Location: ../title/titleMain.html");
?>
</body>
</html>