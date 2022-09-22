<?php
function logout(){
    $_SESSION = array();
//クッキーの削除
    if (isset($_COOKIE["PHPSESSID"])) {
        setcookie("PHPSESSID", '', time() - 1800, '/');
    }
//セッションを破棄する
    session_destroy();
}
?>