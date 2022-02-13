<?
		mysql_connect("localhost", "root", "apmsetup") or die (mysql_error());
		mysql_select_db("phpmyadmin");
		
		$tablename="board";
		$number=$_GET['number'];
		$page=$_GET['page'];
		$query = "select * from $tablename where number='$number'";
		$result = mysql_query($query) or die (mysql_error());
		$array = mysql_fetch_array($result);
		
		//백슬래쉬 제거, 특수문자 변환(HTML용), 개행(<br>)처리 등
		$array[name] = stripslashes($array[name]);
		$array[subject] = stripslashes($array[subject]);
		$array[memo] = stripslashes($array[memo]);
		
		//$array[subject]=htmlspecialchars($array[subject]);
		
		//$array[memo]=nl2br($array[memo]);
?>

<html>
	<head>
		<title>modify</title>
	</head>
	<body>
		<form name='myForm' method='post' action='bbs_modifyok.php?number=<? echo $number; ?>&page=<? echo $page; ?>'>
		이름 : <input type='text' name='name' value='<? echo $array[name]; ?>'><br/>
		비밀번호 : <input type='password' name='password' value='<? echo $array[password]; ?>'> <br/>
		전자우편 : <input type='text' name='email' value='<? echo $array[email]; ?>'> <br/>
		홈페이지 : <input type='text' name='homepage' value='<? echo $array[home]; ?>'> <br/>
		제목 : <input type='text' name='subject' value='<? echo $array[subject]; ?>'><br/>
		내용 : <textarea name=memo><? echo $array[memo]; ?></textarea>
		<input type='submit' name='modify' value='수정'>

		</form>
		
	</body>
	