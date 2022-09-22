<?php
require '../display/UserCheck.php';
require '../function/DBFunction.php';
require_once  '../DB/db.php';

try{
    $pdo = getDB();
}catch (PDOException $e){
    $error['db'] = $e->getMessage();
}

$data=[0,0,0,0,0,0,0];
$flag = false;
$distanceResult = sumDistance($_SESSION['user']['id'],$pdo);
if(is_null($distanceResult['sumDistance'])){
    $sumDistance = 0;
}else{
    $sumDistance = $distanceResult['sumDistance'];
}
$history = historyCourseSelect($_SESSION['user']['id'],$pdo);
if($history != false){
    $flag = true;
}
if($flag == true){
    $result = $history->fetchAll(PDO::FETCH_ASSOC);
}
$result = $history->fetchAll(PDO::FETCH_ASSOC);
$count = $history->rowCount();
var_dump($result);
if($count != 0){
    foreach ($result as $row){
        for($i = 0;$i<7;$i++){
            $day = "-".$i." day";
            if($row['time'] ==  date('Y-m-d', strtotime($day))){
                $data[$i] = $row['sum'];
            }
        }
    }
    var_dump($data);
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=320,height=480,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=yes" />
    <title></title>
    <link rel="stylesheet" href="../commonCSS/menu.css">
    <link rel = "stylesheet" href = "./css/Data.css">

</head>
<body>
<div class = "IPhone">
    <?php require '../display/menu.php'?>
<!--    <div class="ham">-->
<!--        <span class="ham_line ham_line1"></span>-->
<!--        <span class="ham_line ham_line2"></span>-->
<!--        <span class="ham_line ham_line3"></span>-->
<!--    </div>-->
<!--    <button class = "back"><img src = "./img/back1.png" width = "30" height = "30"></button>-->
    <?php require '../display/BackButton.php'?>
    <h1>Data</h1>
    <div class="graph">
        <canvas id="myChart"></canvas>
        <!-- グラフ用のchart.jsの読み込み -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>

        <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',//線の種類
                data: {
                    labels: ['今日', '1日前', '2日前', '3日前', '4日前', '5日前', '6日前'],//横軸のラベル
                    datasets: [{
                        label: '走行距離 ',
                        lineTension: 0, //グラフの曲がり度合い(デフォルトは0.5)
                        fill: false, //グラフの線より下側を塗りつぶさないようにする
                        data: [12, 19, 3, 17, 6, 3, 7],　　//縦軸の値
                        borderColor: "#0066FF", //線の色
                        backgroundColor: "#0066FF" //塗りつぶしの色
                    }]
                },
                options: {
                    title: {
                        display: true, //タイトルの表示可否
                        text: 'あなたの記録' //タイトル
                    },
                    scales: {
                        yAxes: [{//縦軸のスケールを指定
                            ticks: {
                                suggestedMax: 80,//縦軸の最大値
                                suggestedMin: 0,//縦軸の最小値（最小値以下の値があれば自動で変更）
                                stepSize: 10,//縦軸の間隔
                                callback: function(value, index, values) {
                                    return value + 'km'
                                }
                            }
                        }]
                    },
                }
            });
        </script>
    </div>
    <div class = "total">
        <p>total</p>
        <h2><?php echo $sumDistance;?> km</h2>
    </div>
    <div class = "a">
        <div class = "Room">
            <div class = "deta">
                <p>5月20日</p>
                <p><h2>桜井二見ケ浦の夫婦岩</h2></p>
                <p class = "dis">0.00 km</p>
            </div>
        </div>

        <div class = "Room02">
            <div class = "deta02">
                <p>5月21日</p>
                <p><h2>志摩中央公園</h2></p>
                <p class = "dis">0.00 km</p>
            </div>
        </div>
    </div>
    <footer>
        <?php require '../display/footer.php'?>
<!--        <button class = "btn1"><img src = "./img/page.png" width = "119" height = "80"></button>-->
<!--        <button class = "btn2"><img src = "./img/cyclring.png" width = "119" height = "80"></button>-->
<!--        <button class = "btn3"><img src = "./img/post.png" width = "119" height = "80"></button>-->
    </footer>
</div>
</body>
</html>