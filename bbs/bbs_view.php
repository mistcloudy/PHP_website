<?
	session_start();
//변수 설정합니다.
$tablename="board"; //테이블 이름
				$test = $_COOKIE["user_id"];	
				$user_key = $_COOKIE['user_key'];
				$auth_key = $_COOKIE["auth_key"];	
$number = $_GET["number"];
$page = $_GET["page"];
setcookie("num", $number, time()+100);
setcookie("p", $page, time()+100);

//DB에 연결하는 부분입니다. 항상 반복되는 부분이니 꼭 암기!!!

mysql_connect("localhost", "root", "apmsetup") or die (mysql_error());
mysql_select_db("phpmyadmin");
mysql_query(" set names euckr ");
//테이블에서 글을 가져옵니다.
$query = "select * from $tablename where number='$number'"; // 글 번호를 가지고 조회를 합니다.
$result = mysql_query($query) or die (mysql_error());
$array = mysql_fetch_array($result);
 
//백슬래쉬 제거, 특수문자 변환(HTML용), 개행(<br>)처리 등
$array[name] = stripslashes($array[name]);
$array[email] = stripslashes($array[email]);
$array[subject] = stripslashes($array[subject]);
 
$array[memo] = htmlspecialchars($array[memo]);

$array[memo] = nl2br($array[memo]);


// 조회수 카운터 증가
$query = "update $tablename set count = count + 1 where number='$number'";
mysql_query($query);


?>
 
<html>
<head>
<title>PHP 게시판 프로젝트 - 보기</title>
</head>
<body bgcolor=white>
<table border=0 cellspacing=1 cellpadding="3" width=670>
        <tr>
          <td align=center>
          <font color=green><b>내용 보기 화면입니다.</b></font>
          </td>
        </tr>
    <tr>
          <td bgcolor="#EAC3EA">
<table border=0 cellspacing=1 cellpadding=0 width=670 bgcolor="white">
        <tr>
          <td width="100">
            <p align="right"><b>이름 &nbsp;</b></p>
 
          </td>
          <td width="400">
                        <p><? echo $array[name]; ?></p>
          </td>
          <td width="100">
                        <p align="right"><b>조회수 &nbsp;</b></p>
          </td>
          <td>
                        <p><? echo $array[count]; ?></p>
          </td>
        </tr>
                <tr>
          <td width="100">
                        <p align="right"><b>전자우편 &nbsp;</b></p>
          </td>
          <td colspan="3">
                        <p><? echo $array[email]; ?></p>
          </td>
                </tr>
                <tr>
          <td width="100">
                        <p align="right"><b>홈페이지 &nbsp;</b></p>
          </td>
          <td colspan="3">
                        <p><? echo $array[home]; ?></p>
          </td>
                </tr>
                <tr>
                	<td width="100">
                		<p align="right"><b>파일 &nbsp;</b></p>
                	</td>
                	<td colspan="3">
                		<p><? echo "<a href='$array[file_name]'>$array[s_file_name]</a>"; ?></p>
                	</td>
                </tr>
                <tr>
          <td width="100">
                        <p align="right"><b>제목 &nbsp;</b></p>
          </td>
          <td colspan="3">
                        <p><? echo $array[subject]; ?></p>
          </td>
                </tr>
        <tr>
          <td width="100">
                        <p align="right"><b>내용 &nbsp;</b></p>
          </td>
          <td colspan="3">
                        <p><? echo $array[memo]; ?></p>
          </td>
        </tr>
</table>


<table>
	<tr>
	<td>
            <p align="center"><a href="bbs_list.php?page=<? echo $page; ?>">[목록]</a> &nbsp;<a href="bbs_write.php">[쓰기]</a> &nbsp;<a href="bbs_modify.php?number=<? echo $number; ?>&page=<? echo $page; ?>">[수정]</a> &nbsp;<a href="bbs_delete.php?number=<? echo $number; ?>&page=<? echo $page; ?>">[삭제]</a></p>
          </td>
    </tr>
</table>
<table>
	<tr>
		<?
		
		
			require_once("config.php");
			
			$result=json_decode(file_get_contents("http://me2day.net/api/get_auth_url.json?akey=".A_KEY));
			$replytable="replytable";
			$query="select * from $replytable where number='$number'";
			$resultdb=mysql_query($query) or die (mysql_error());
			if($repage=='') $repage =1;
			$relist_num=5;
			$repage_num=5;
			$offset=$relist_num*($repage-1);
			

			
			
		?>
		<a href="<? echo $result->url ?>">me2day인증하기</a><br/>



		<form name='reply' method='GET' action='reply_insert.php'>
		<textarea name='rebox' cols=50 rows=3 maxlength=100></textarea>
		<input type='submit' value='덧글달기'><br/>

		</form>
	</tr>
</table>
<table>
	<?

	while ($array=mysql_fetch_array($resultdb)) {
			echo "
				<tr>
					<td>
						<p align=center>$array[me2id]</p>
					</td>
					<td>
						<p align=center>$array[memo]</p>	
					</td>
				</tr> ";
			}
	?>
	
</table>
</body>
</html>