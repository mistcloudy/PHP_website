<?
	mysql_connect("localhost", "root", "apmsetup");
	mysql_select_db("phpmyadmin");
	mysql_query(" Set names euckr" );
	
	$tablename="board";
	$number=$_GET['number'];
	$page=$_GET['page'];
	$name=$_POST['name'];
	$email=$_POST['email'];
	$home=$_POST['home'];
	$subject=$_POST['subject'];
	$memo=$_POST['memo'];
	$password=$_POST['password'];

	echo $number;
	echo $password;
	
	$sql = "select number from $tablename where number='$number' and password='$password'";
	$result=mysql_query($sql) or die (mysql_error());
	echo mysql_num_rows($result);
	if(mysql_num_rows($result)) { //��ȯ�� ���� ������
		//������ ������ UPDATE�մϴ�.
		$sql="update $tablename set name='$name', email='$email', home='$home', subject='$subject', memo='$memo' where number='$number'";
		$result=mysql_query($sql) or die (mysql_error());
		$msg="��������!";
		
		echo "<html><head><script name=javascript>
					if('$msg' != ''){
						self.window.alert('$msg');
						}
						
						location.href='bbs_list.php?page=$page';
						
						</script>
						</head>
						</html>";
	} else {
		$msg="�������";
		echo "<html><head>
					<script name=javascript>
					
					if('$msg' != '') {
							self.window.alert('$msg');
					}
					
					history.go(-1);
					
					</script>
					</head>
					</html> ";
							
					
	}
	

?>