<?
	mysql_connect("localhost", "root", "apmsetup") or die (mysql_error()); //host,id,password
	mysql_select_db("phpmyadmin"); //db�̸�
	
	
	//����
	$number=$_POST['number'];
	$password = $_POST['password'];
	$password = addslashes($password);
	$tablename="board"; //���̺� �̸�
	echo "$password<br/>";
	echo "$number<br/>";
	//��й�ȣ�� �´��� Ȯ��
	$sql = "select number from $tablename where number=$number and password='$password'";
	$result = mysql_query($sql) or die (mysql_error());
	
	$msg="��й�ȣ�� Ʋ���ϴ�.";
	
	if(mysql_num_rows($result)) { //��ȯ�� ���� ������,,,
		//����
		$sql = "delete from $tablename where number=$number";
		mysql_query($sql) or die (mysql_error());
		$msg = "�����Ͽ����ϴ�.";
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