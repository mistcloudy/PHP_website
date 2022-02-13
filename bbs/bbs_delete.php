

<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=euc-kr">
		<title>why</title>
	</head>
	<body>
	<?
	$number=$_GET['number'];
	$page=$_GET['page'];
	?>
		<form name="myForm" method="post" action="bbs_deleteok.php">
		<input type="hidden" name="page" value="<? echo $page; ?>">
		<input type="hidden" name="number" value="<? echo $number; ?>">
		<table>
			<tr>
				<td>
					<p>글 삭제 비밀번호</p>
				</td>
			</tr>
			<tr>
				<td>
					<input type="text" name="password" maxlength="12" size="12">
				</td>
			</tr>
		</table>
					<input type="submit" value="삭제">
		</form>
	</body>
</html>