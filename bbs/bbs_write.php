<html>
<head>
<title>PHP 게시판 프로젝트 쓰기</title>
</head>
<body>
<form name='myForm' method='post' ENCTYPE='multipart/form-data' action='bbs_insert.php'>

이름 : <input type='text' name='name' size=20 maxlength=20> <br>
비밀번호 : <input type='password' name='password' size=20 maxlength=20> <br>
전자우편 : <input type='text' name='email' size=50 maxlength=70> <br>
홈페이지 : <input type='text' name='home' size=50 maxlength=70> <br>
제목 : <input type='text' name='subject' size=50 maxlength=70> <br>
내용 : <textarea name='memo' cols=50 rows=5 maxlength=500></textarea> <br>
파일첨부 : <input type='file' name="upfile">

<br>
<input type='submit' value='글쓰기'>

</form>
</body>
</html>