<?php
function sendMail($mail,$url){
    $companyname = 'テスト';
    $companymail = 'info@aso2001026.itigo.jp';
    $registation_subject ='本人確認メール';
    $mailTo = $mail;
    $body = <<< EOM
            この度は仮ご登録いただきありがとうございます。
            24時間以内に下記のURLからご登録下さい。
            {$url}
EOM;
    mb_language('ja');
    mb_internal_encoding('UTF-8');

    //Fromヘッダーを作成
    $header = 'From: ' . mb_encode_mimeheader($companyname). ' <' . $companymail. '>';

    if(mb_send_mail($mailTo, $registation_subject, $body, $header, '-f'. $companymail)){
        //セッション変数を全て解除
        $_SESSION = array();
        //クッキーの削除
        if (isset($_COOKIE["PHPSESSID"])) {
            setcookie("PHPSESSID", '', time() - 1800, '/');
        }
    }
}
?>