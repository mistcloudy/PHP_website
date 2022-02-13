<?


	session_start();
	require_once("config.php");
	$number = $_COOKIE['num'];
	$page = $_COOKIE["p"];
	$token=$_GET["token"];
	$user_id=$_GET["user_id"];
	$user_key=$_GET["user_key"];
	$result=$_GET["result"];

	setcookie("user_id", $user_id);
	setcookie("user_key", $user_key);
	
	$test = $_COOKIE["use_id"];	

	// 세션저장

	$_SESSION["user_id"] = $user_id;
	$_SESSION["user_key"]=$user_key;


	// 인증이 확실한지 확인
	$test=md5("12345678", $user_key);
	$auth_key="12345678".md5("12345678".$user_key);
	setcookie("auth_key", $auth_key);

	$result = file_get_contents("http://me2day.net/api/noop?uid={$user_id}&ukey={$auth_key}&akey=".A_KEY);
	echo "<br>";
	echo "token=$token<br>";
	echo "user_id=$user_id<br>";
	echo "user_key=$user_key<br>";
	echo "result=$result<br>";
	echo "authKey=$auth_key<br>";
	echo "<br>";
	echo "<meta http-equiv='refresh' content='0; url=bbs_view.php?number=$number&page=$page'>"; 

?>
<!doctype html>
<html>
	<head>
		<meta charset="euc-kr">
		<title>미투데이 인증 콜백</title>
		        <script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#btnPost").click(function(){
                    var body = $("#inputPost").val();
                    if (body.length < 1){
                        alert("글입력해요!");
                        return;
                    }
                    $.getJSON("post.php?callback=?", {body:body}, function(data){
                        alert("글쓰기 성공 = " + data.result);
                    });
                });
            });
        </script>
      </head>
      <body>
      	<? echo $result; ?><br/>
      	<input type="text" id="inputPost" name="inputPost" /><br/>
      	<input type="button" id="btnPost" name="btnPost" value="글쓰기"/>
      </body>
      
 </html>