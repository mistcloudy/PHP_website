<html>
	<head>
		<title>PHP 파일 업로드 기능</title>
		<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
	</head>
	<body>
		<form ENCTYPE='multipart/form-data' action="upload_ok.php" method="POST">
			<!-- //기본값은 "application/x-www-form-urlencoded"입니다. 그러나 파일을 전송해야할 때는 반드시 "multipart/form-data"를 써야합 -->
			<table>
				<tr>
					<td>
						파일 업로드 기능
					</td>
				</tr>
				<tr>
					<td>
						<input name="upfile" type="file">(파일의 용량 제한 : 2000M)
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" value="전송">
						<input type="reset" value="취소">
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>