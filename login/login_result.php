<?php
session_start();

$id = $_REQUEST["id"];
$pw = $_REQUEST["pass"];

if(isset($_REQUEST["id_ck"])){
    setcookie("id",$id,(time()+3600*24*7)); // 일주일 간 자동로그인 유지

}



if ($id=="admin" && $pw =="123456") {

    $_SESSION["userid"]="admin";
    $_SESSION["name"]="관리자";
    $_SESSION["nick"]="관리자";
    $_SESSION["leve"]="1";
    header("Location:http://10.211.55.3/index.php");
    exit;
}

require_once ("../lib/MYDB.php");
$pdo =db_connect();

/*$auto_login  = trim($_POST[auto_login]);
$query = "select * from test.member where id='$id' and pass='$pw'";
$result = mysqli_query($query);
if(mysqli_num_rows($result)) {
    $db = mysqli_fetch_array($result);
    if ($auto_login=="y") {
        setcookie("c_id",$id,(time()+3600*24*7),"/"); // 일주일 간 자동로그인 유지
    }
}*/

try{
    $sql = "select * from test.member where id=?";
    $stmh = $pdo->prepare($sql);
    $stmh->bindValue(1,$id,PDO::PARAM_STR);
    $stmh->execute();

    $count = $stmh->rowCount();
} catch (PDOException $Exception) {
    print "오류: ".$Exception->getMessage();
}

    $row =$stmh->fetch(PDO::FETCH_ASSOC);

if(isset($_REQUEST["id_ck2"])){
    setcookie("login", $row["id"],  (time()+3600*24*7), "/" ); // 일주일 간 자동로그인 유지
    setcookie("login1", $row["name"],   (time()+3600*24*7), "/" );
    setcookie("login2", $row["nick"], (time()+3600*24*7), "/" );
    setcookie("login3", $row["leve"],  (time()+3600*24*7), "/"  );
}

if($count<1) {
    ?>

<script>
    alert("아이디가 틀립니다.");
    history.back();
</script>

<?php
} elseif ($pw!=$row["pass"]) {
    ?>
}

<script>
    alert("비밀번호가 틀립니다.");
    history.back();
</script>

    <?php
} else {
    $_SESSION["userid"]=$row["id"];
    $_SESSION["name"]=$row["name"];
    $_SESSION["nick"]=$row["nick"];
    $_SESSION["leve"]=$row["leve"];


    header("Location:http://10.211.55.3/index.php");


    exit;
}
?>

