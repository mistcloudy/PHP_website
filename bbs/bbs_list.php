<html>
<head>
<meta http-equiv=content-type content=text/html; charset=euckr>
<title>�Խ��� ����Ʈ</title>

</head>
<body>
<?
//DB�� ����
mysql_connect("localhost","root","apmsetup") or die (mysql_error());
mysql_select_db("phpmyadmin");
mysql_query(" set names euckr ");

$page=$_GET["page"];
$prev = $_GET["prev"];
$page_link = $_GET["page_link"];
$go_page= $_GET["go_page"];
$netxt=$_GET["netxt"];
$total_page=$_GET["total_page"];

//�Խ��� ��Ϻ��� ����
$tablename="board"; //���̺� �̸�
if($page =='') $page = 1; //������ ��ȣ�� ������ 1
$list_num = 10; //�� �������� ������ ��� ����
$page_num = 10; //�� ȭ�鿡 ������ ������ ��ũ ����
$offset = $list_num*($page-1); //�� �������� ���� �� ��ȣ(listnum ����ŭ �������� �� �����ϴ� �� ��ȣ)
$query="select count(*) from $tablename";
$result=mysql_query($query) or die (mysql_error()); //���� �������� ������ ���ा�� ����� result�� ����
$row=mysql_fetch_row($result);
$total_no=$row[0];

//��ü ������ ���� ���� �� ��ȣ�� ���մϴ�.
$total_page=ceil($total_no/$list_num); //��ü�ۼ��� �������� �ۼ��� ���� ���� �ø� ���� ����
$cur_num=$total_no - $list_num*($page-1); //���� �۹�ȣ

//bbs���̺��� ����� �����ɴϴ�. (���� ������ ��뿹�� ����մϴ� .)
$query="select * from $tablename order by number desc limit $offset, $list_num"; // SQL ������
$result=mysql_query($query) or die (mysql_error()); // �������� ���� ���
//���� ����� �ϳ��� �ҷ��� ���� HTML�� ��Ÿ���� ���� HTML �� �߰��� �����մϴ�.

?>

<table border=1 cellspacing=0 width=680 bordercolordark=white bordercolorlight=#999999>
    <tr>
        <td width=30 bgcolor=#CCCCCC>
            <p align=center>no</p>
        </td>
        <td bgcolor=#CCCCCC width=490>
            <p align=center>subject</p>
        </td>
        <td width=60 bgcolor=#CCCCCC>
            <p align=center>name</p>
        </td>
        <td width=70 bgcolor=#CCCCCC>
            <p align=center>date</p>
        </td>
        <td width=30 bgcolor=#CCCCCC>
            <p align=center>hit</p>
        </td>
    </tr>


<?
while ($array=mysql_fetch_array($result)) {
 

 
        echo "
    <tr>
        <td width=30>
            <p align=center>$cur_num</p>
        </td>
        <td width=490>
            <p><a href='bbs_view.php?number=$array[number]&page=$page'>$array[subject]</a></p>
        </td>
        <td width=60>
            <p align=center>$array[name]</p>
        </td>
        <td width=70>
            <p align=center>$array[email]</p>
        </td>
        <td width=30>
            <p align=center>$array[home]</p>
        </td>
    </tr> ";
 
        $cur_num --;
 
}
?>

 <tr>
        <td width=100% colspan=5>

<?
//���⼭���� ���� ������ ��ũ
//����, �� ȭ�鿡 ���̴� ���($page_num �⺻�� �̻��� �� ������� �������� )
$total_block=ceil($total_page/$page_num);
$block=ceil($page/$page_num); //���� ���
 
$first=($block-1)*$page_num; // ������ ����� �����ϴ� ù ������
$last=$block*$page_num; //������ ����� �� ������
 
if($block >= $total_block) {
        $last=$total_page;
}
 
echo "
                       <p align=center>";
//[ó��][*����]
if($block > 1) {
        $prev=$first-1;
        echo "<a href='bbs_list.php?page=1'>[ó�� ]</a>&nbsp; ";
        echo "<a href='bbs_list.php?page=$prev'>[$page_num �� ��]</a>";
}
 
//[����]
if($page > 1) {
        $go_page=$page-1;
        echo "  <a href='bbs_list.php?page=$go_page'>[���� ]</a>&nbsp;       ";
}
 
//������ ��ũ
for ($page_link=$first+1;$page_link<=$last;$page_link++) {
        if($page_link==$page) {
                echo "<font color=green><b>$page_link</b></font>";
        }
        else {
                echo "<a href='bbs_list.php?page=$page_link'>[$page_link]</a>";
        }
}
 
//[����]
if($total_page > $page) {
        $go_page=$page+1;
        echo "&nbsp;<a href='bbs_list.php?page=$go_page'>[����]</a>";
}
 
//[*����][������]
if($block < $total_block) {
        $next=$last+1;
        echo "<a href='bbs_list.php?page=$netxt'>[$page_num �� ��]</a>&nbsp;";
        echo "<a href='bbs_list.php?page=$total_page'>[������]</a></p>";
}


 
?>
        </td>
    </tr>
    <tr>
        <td width=100% colspan=5>
            <p align=center><a href='bbs_write.php'>[�۾���]</a></p>
        </td>
    </tr>
</table>
</body>
</html>