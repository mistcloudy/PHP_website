<?
	session_start();
//���� �����մϴ�.
$tablename="board"; //���̺� �̸�
				$test = $_COOKIE["user_id"];	
				$user_key = $_COOKIE['user_key'];
				$auth_key = $_COOKIE["auth_key"];	
$number = $_GET["number"];
$page = $_GET["page"];
setcookie("num", $number, time()+100);
setcookie("p", $page, time()+100);

//DB�� �����ϴ� �κ��Դϴ�. �׻� �ݺ��Ǵ� �κ��̴� �� �ϱ�!!!

mysql_connect("localhost", "root", "apmsetup") or die (mysql_error());
mysql_select_db("phpmyadmin");
mysql_query(" set names euckr ");
//���̺��� ���� �����ɴϴ�.
$query = "select * from $tablename where number='$number'"; // �� ��ȣ�� ������ ��ȸ�� �մϴ�.
$result = mysql_query($query) or die (mysql_error());
$array = mysql_fetch_array($result);
 
//�齽���� ����, Ư������ ��ȯ(HTML��), ����(<br>)ó�� ��
$array[name] = stripslashes($array[name]);
$array[email] = stripslashes($array[email]);
$array[subject] = stripslashes($array[subject]);
 
$array[memo] = htmlspecialchars($array[memo]);

$array[memo] = nl2br($array[memo]);


// ��ȸ�� ī���� ����
$query = "update $tablename set count = count + 1 where number='$number'";
mysql_query($query);


?>
 
<html>
<head>
<title>PHP �Խ��� ������Ʈ - ����</title>
</head>
<body bgcolor=white>
<table border=0 cellspacing=1 cellpadding="3" width=670>
        <tr>
          <td align=center>
          <font color=green><b>���� ���� ȭ���Դϴ�.</b></font>
          </td>
        </tr>
    <tr>
          <td bgcolor="#EAC3EA">
<table border=0 cellspacing=1 cellpadding=0 width=670 bgcolor="white">
        <tr>
          <td width="100">
            <p align="right"><b>�̸� &nbsp;</b></p>
 
          </td>
          <td width="400">
                        <p><? echo $array[name]; ?></p>
          </td>
          <td width="100">
                        <p align="right"><b>��ȸ�� &nbsp;</b></p>
          </td>
          <td>
                        <p><? echo $array[count]; ?></p>
          </td>
        </tr>
                <tr>
          <td width="100">
                        <p align="right"><b>���ڿ��� &nbsp;</b></p>
          </td>
          <td colspan="3">
                        <p><? echo $array[email]; ?></p>
          </td>
                </tr>
                <tr>
          <td width="100">
                        <p align="right"><b>Ȩ������ &nbsp;</b></p>
          </td>
          <td colspan="3">
                        <p><? echo $array[home]; ?></p>
          </td>
                </tr>
                <tr>
                	<td width="100">
                		<p align="right"><b>���� &nbsp;</b></p>
                	</td>
                	<td colspan="3">
                		<p><? echo "<a href='$array[file_name]'>$array[s_file_name]</a>"; ?></p>
                	</td>
                </tr>
                <tr>
          <td width="100">
                        <p align="right"><b>���� &nbsp;</b></p>
          </td>
          <td colspan="3">
                        <p><? echo $array[subject]; ?></p>
          </td>
                </tr>
        <tr>
          <td width="100">
                        <p align="right"><b>���� &nbsp;</b></p>
          </td>
          <td colspan="3">
                        <p><? echo $array[memo]; ?></p>
          </td>
        </tr>
</table>


<table>
	<tr>
	<td>
            <p align="center"><a href="bbs_list.php?page=<? echo $page; ?>">[���]</a> &nbsp;<a href="bbs_write.php">[����]</a> &nbsp;<a href="bbs_modify.php?number=<? echo $number; ?>&page=<? echo $page; ?>">[����]</a> &nbsp;<a href="bbs_delete.php?number=<? echo $number; ?>&page=<? echo $page; ?>">[����]</a></p>
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
		<a href="<? echo $result->url ?>">me2day�����ϱ�</a><br/>



		<form name='reply' method='GET' action='reply_insert.php'>
		<textarea name='rebox' cols=50 rows=3 maxlength=100></textarea>
		<input type='submit' value='���۴ޱ�'><br/>

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