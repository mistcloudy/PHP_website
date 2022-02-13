<?

	$upfile = $_POST["upfile"];
	$path="C:\\APM_Setup\\htdocs\\up\\";
	$uploadfile= $path.$_FILES["upfile"]["name"];
	echo $uploadfile;
	if($_FILES["upfile"]["error"] > 0){
		echo "파일전송 실패";
	} else {
		$tmp_name = $_FILES["upfile"]["tmp_name"][$key];
		$name = $_FILES["upfile"]["name"][$key];
		
		$uploadfile= $target_dir . basename($_FILES['upfile']['name']);
	echo $uploadfile;
	}
	if (is_uploaded_file($_FILES['upfile']['tmp_name'])) {
		echo "File ". $_FILES['upfile'];
		move_uploaded_file($_FILES['upfile']['tmp_name'], $path.$_FILES["upfile"]["name"]);
		echo "업로드 된 파일 : ".$path.$_FILES["upfile"]["name"];

		echo "Displaying contents\n";
	} 

?>