<?
	require_once("config.php");
	$json="me2day.net/api/get_auth_url.json?akey=ad40b07a8de6eaf13732299da7e8ce4a";
	$result = json_decode(file_get_contents("http://me2day.net/api/get_auth_url.json?akey=".A_KEY));
	print_r($result);	
?>
<!doctype html>
<html>
<head>
	<meta charset="euc-kr">
	<title>�������� ���� �� �۾���</title>
</head>
	<body>
			<br/>
			<a href="<? echo $result->url; ?>">�������� �����ϱ�</a>
			<?
			$number = $_COOKIE['use_id'];
			echo $number;
			?>
	</body>
</html>	