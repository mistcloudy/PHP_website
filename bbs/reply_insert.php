		<?

				require_once("config.php");
		

				$number = $_COOKIE['num'];
				$page = $_COOKIE['p'];
				$memo=$_GET["rebox"];
				$user_id = $_COOKIE['user_id'];
				$user_key = $_COOKIE['user_key'];
				$auth_key= $_COOKIE['auth_key'];


				mysql_connect("localhost", "root", "apmsetup") or die(mysql_error());
				mysql_select_db("phpmyadmin");
				mysql_query("set names euckr");
				
		?>
<html>
	<head>
		<meta charset="euckr">
		<title>댓글 추가</title>
	</head>
	<body>
		<?
				$replytable="replytable";
				$query="select count(*) from $replytable";
				$result=mysql_query($query) or die (mysql_error()); //위의 쿼리문을 실제로 실행하여 결과를 result에 대입
				$row=mysql_fetch_row($result);
				$total_no=$row[0]+1;

				$query="insert into $replytable values('$total_no','$number','$user_id','$memo','')";
				mysql_query($query) or die(mysql_error());
				$memo = urlencode($memo);
				echo "http://me2day.net/api/create_post/{$user_id}?uid={$user_id}&ukey={$auth_key}&akey=".A_KEY."&post[body]={$memo}";
				simplexml_load_file("http://me2day.net/api/create_post/{$user_id}?uid={$user_id}&ukey={$auth_key}&akey=".A_KEY."&post[body]={$memo}");
				
		?>
		
	</body>
</html>