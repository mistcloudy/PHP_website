<html>
	<head>
		<title>PHP ���� ���ε� ���</title>
		<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
	</head>
	<body>
		<form ENCTYPE='multipart/form-data' action="upload_ok.php" method="POST">
			<!-- //�⺻���� "application/x-www-form-urlencoded"�Դϴ�. �׷��� ������ �����ؾ��� ���� �ݵ�� "multipart/form-data"�� ����� -->
			<table>
				<tr>
					<td>
						���� ���ε� ���
					</td>
				</tr>
				<tr>
					<td>
						<input name="upfile" type="file">(������ �뷮 ���� : 2000M)
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" value="����">
						<input type="reset" value="���">
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>