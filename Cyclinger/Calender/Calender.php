<?php
session_start();
$today = new DateTime();

/*---------------------------------------------------
追加部分
----------------------------------------------------*/
if(isset($_GET['t']) && preg_match('/\A\d{4}-\d{2}\z/', $_GET['t'])) {
  //クエリ情報を基にしてDateTimeインスタンスを作成
  $start_day = new DateTime($_GET['t'] . '-01');
} else {
  //当月初日のDateTimeインスタンスを作成
  $start_day = new DateTime('first day of this month');
}

//カレンダー表示月の前月の年月を取得
$dt = clone($start_day);
$prev_month =  $dt->modify('-1 month')->format('Y-m');

//カレンダー表示月の翌月の年月を取得
$dt = clone($start_day);
$next_month =  $dt->modify('+1 month')->format('Y-m');
/*---------------------------------------------------
追加部分終了
----------------------------------------------------*/

//カレンダー表示月の年と月を取得
$year_month = $start_day->format('Y-m');

//表示月初日の曜日を数値で取得
$w = $start_day->format('w');

//表示月初日をカレンダーの開始日に変更する
$start_day->modify('-' . $w . ' day');

/*---------------------------------------------------
修正部分
----------------------------------------------------*/
//表示月末日のDateTimeインスタンスを作成
$end_day = new DateTime('last day of ' . $year_month);
/*---------------------------------------------------
修正部分終了
----------------------------------------------------*/

//カレンダーの終了日を取得するため月末の曜日を数値で取得
$w = $end_day->format('w');

//土曜日を数値にすると6。そこから月末の曜日に対応する数を引いてやれば、カレンダー末尾に追加すべき日数が判明する。
//+1しているのはDatePeriodの特性を考慮するため
$w = 6 - $w + 1;

//月末をカレンダーの終了日の翌日に変更する
$end_day->modify('+' . $w . ' day');

//カレンダーに表示する期間のインスタンスを作成する
$period = new DatePeriod(
  $start_day,
  new DateInterval('P1D'),
  $end_day
);

//htmlに描写するための変数
$body = '';

foreach ($period as $day) {
  //当月以外の日付はgreyクラスを付与してCSSで色をグレーにする
  $grey_class = $day->format('Y-m') === $year_month ? '' : 'grey';

  //本日にはtodayクラスを付与してCSSで数字の見た目を変える
  $today_class = $day->format('Y-m-d') === $today->format('Y-m-d') ? 'today' : '';
  
  //その曜日が日曜日なら<tr>タグを挿入する
  if ($day->format('w') == 0) {
    $body .= '<tr>';
  }
  
  //sprintfを使って整形しながらhtml部分を作成する
  $body .= sprintf(
    '<td class="youbi_%d %s %s"><a href = "../Select/Select.php?days=%d">%d</a></td>',
    $day->format('w'),
    $today_class,
    $grey_class,
    $day->format('Ymd'),
    $day->format('d')
  );
  
  //その曜日が土曜日なら</tr>タグを挿入する
  if ($day->format('w') == 6) {
    $body .= '</tr>';
  }
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name = "viewport" content = "width=320,height=480,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=yes" />
  <title>Calendar</title>
  <link rel="stylesheet" href="./css/Calender.css">
    <link rel="stylesheet" href="../commonCSS/menu.css">
</head>
<body>
<div class = "IPhone">
<!--    <div class="ham">-->
<!--        <span class="ham_line ham_line1"></span>-->
<!--        <span class="ham_line ham_line2"></span>-->
<!--        <span class="ham_line ham_line3"></span>-->
<!--    </div>-->
    <?php require '../display/menu.php'?>
  <table class="calendar">
    <thead class="calendar-head">
      <tr class="calendar-row">
        <!-- リンクにクエリ情報を設定する -->
        <th><a href="?t=<?php echo $prev_month ?>">&laquo;</a></th>
        <th colspan="5"><?php echo $year_month ?></th>
        <th><a href="?t=<?php echo $next_month ?>">&raquo;</a></th>
      </tr>
    </thead>
    <tbody>
      <tr class="calendar-row">
        <td class = "red">日</td>
        <td>月</td>
        <td>火</td>
        <td>水</td>
        <td>木</td>
        <td>金</td>
        <td class = "blue">土</td>
      </tr>
      <?php echo $body ?>
    </tbody>
  </table>
  <button class = "gruCh"><a href = "../ChatList/ChatList.php">Chat List</a></button>
  <footer>
      <?php require '../display/footer.php'?>
<!--        <button class = "btn1"><img src = "./img/page.png" width = "119" height = "80"></button>-->
<!--        <button class = "btn2"><img src = "./img/cyclring.png" width = "119" height = "80"></button>-->
<!--        <button class = "btn3"><img src = "./img/post.png" width = "119" height = "80"></button>-->
    </footer>
</div>
</body>
</html>