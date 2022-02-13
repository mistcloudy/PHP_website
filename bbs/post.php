<?

	
	
	require_once("config.php");
	
	$body=$_GET["body"];
	$callback=$_GET["callback"];
	
	session_start();
	$user_id = $_SESSION["user_id"];
	$user_key = $_SESSION["user_key"];
	
	
	// 인증이 확실한지 확인
    $authKey = "12345678" . md5("12345678" . $user_key);
    $result = file_get_contents("http://me2day.net/api/create_post/{$user_id}.json?uid={$user_id}&ukey={$authKey}&akey=" . A_KEY . "&post[body]={$body}");
    

    header("Content-type; application/json");
    echo "{$callback}({'result':'{$result}'})";

    
?>