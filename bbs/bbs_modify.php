<?
		mysql_connect("localhost", "root", "apmsetup") or die (mysql_error());
		mysql_select_db("phpmyadmin");
		
		$tablename="board";
		$number=$_GET['number'];
		$page=$_GET['page'];
		$query = "select * from $tablename where number='$number'";
		$result = mysql_query($query) or die (mysql_error());
		$array = mysql_fetch_array($result);
		
		//�齽���� ����, Ư������ ��ȯ(HTML��), ����(<br>)ó�� ��
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
		�̸� : <input type='text' name='name' value='<? echo $array[name]; ?>'><br/>
		��й�ȣ : <input type='password' name='password' value='<? echo $array[password]; ?>'> <br/>
		���ڿ��� : <input type='text' name='email' value='<? echo $array[email]; ?>'> <br/>
		Ȩ������ : <input type='text' name='homepage' value='<? echo $array[home]; ?>'> <br/>
		���� : <input type='text' name='subject' value='<? echo $array[subject]; ?>'><br/>
		���� : <textarea name=memo><? echo $array[memo]; ?></textarea>
		<input type='submit' name='modify' value='����'>

		</form>
		
	</body>
	