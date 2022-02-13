<?
	mysql_connect("localhost", "root", "apmsetup") or die (mysql_error()); //host,id,password
	mysql_select_db("phpmyadmin"); //db이름
	
	
	//변수
	$number=$_POST['number'];
	$password = $_POST['password'];
	$password = addslashes($password);
	$tablename="board"; //테이블 이름
	echo "$password<br/>";
	echo "$number<br/>";
	//비밀번호가 맞는지 확인
	$sql = "select number from $tablename where number=$number and password='$password'";
	$result = mysql_query($sql) or die (mysql_error());
	
	$msg="비밀번호가 틀립니다.";
	
	if(mysql_num_rows($result)) { //반환된 열이 있으면,,,
		//삭제
		$sql = "delete from $tablename where number=$number";
		mysql_query($sql) or die (mysql_error());
		$msg = "삭제하였습니다.";
	}
	echo "<html><head><script name=javascript>
				if('$msg' != '') {
					self.window.alert('$msg');
				}
				
				location.href='bbs_list.php?page=$page';
				
				</script>
				</head>
				</html>";
				
?>