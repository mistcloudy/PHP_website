<html>
	<head>
		<title>write_insert</title>
	</head>
	
	<body>

<?
mysql_connect("localhost", "root", "apmsetup") or die (mysql_error());
mysql_select_db("phpmyadmin");
mysql_query(" set names euckr ");
$name = $_POST["name"];
$password = $_POST["password"];
$email = $_POST["email"];
$home = $_POST["home"];
$subject = $_POST["subject"];
$memo = $_POST["memo"];
$upfile=$_POST["upfile"];
$path="./up/";

	$upfile = $_POST["upfile"];
	if($_FILES["upfile"]["error"] > 0){
		echo "파일전송 실패";
	} else {
		$tmp_name = $_FILES["upfile"]["tmp_name"][$key];
		$file_name = $_FILES["upfile"]["name"];
		
		$uploadfile= $path.$_FILES["upfile"]["name"];

	}
	if (is_uploaded_file($_FILES['upfile']['tmp_name'])) {
		echo "File ". $_FILES['upfile'];
		move_uploaded_file($_FILES['upfile']['tmp_name'], $uploadfile);
		

	} 

$sql = "insert into board values('','$name','$password','$email','$home','$subject','$memo','','$uploadfile','$file_name')";

mysql_query($sql) or die (mysql_error());
echo "<meta http-equiv='refresh' content='0; url=./bbs_list.php'>";
?>


</body>

</html>