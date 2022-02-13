<?php
    session_start();
if(isset($_COOKIE["login"])){
    unset($_COOKIE["login"]);
    setcookie("login", $_COOKIE["id"],  (time()-3600), "/" ); // 일주일 간 자동로그인 유지
    setcookie("login1", $_COOKIE["name"],   (time()-3600), "/");
    setcookie("login2", $_COOKIE["nick"], (time()-3600), "/");
    setcookie("login3", $_COOKIE["leve"],  (time()-3600), "/");
}

unset($_SESSION["userid"]);
unset($_SESSION["name"]);
unset($_SESSION["nick"]);
unset($_SESSION["leve"]);


//http://10.211.55.3/connect.php
header("Location:http://10.211.55.3/index.php");
?>