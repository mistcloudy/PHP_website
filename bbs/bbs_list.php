<html>
<head>
<meta http-equiv=content-type content=text/html; charset=euckr>
<title>게시판 리스트</title>

</head>
<body>
<?
//DB에 연결
mysql_connect("localhost","root","apmsetup") or die (mysql_error());
mysql_select_db("phpmyadmin");
mysql_query(" set names euckr ");

$page=$_GET["page"];
$prev = $_GET["prev"];
$page_link = $_GET["page_link"];
$go_page= $_GET["go_page"];
$netxt=$_GET["netxt"];
$total_page=$_GET["total_page"];

//게시판 목록보기 변수
$tablename="board"; //테이블 이름
if($page =='') $page = 1; //페이지 번호가 없으면 1
$list_num = 10; //한 페이지에 보여줄 목록 갯수
$page_num = 10; //한 화면에 보여줄 페이지 링크 갯수
$offset = $list_num*($page-1); //한 페이지의 시작 글 번호(listnum 수만큼 나누었을 때 시작하는 글 번호)
$query="select count(*) from $tablename";
$result=mysql_query($query) or die (mysql_error()); //위의 쿼리문을 실제로 실행ㅎ라여 결과를 result에 대입
$row=mysql_fetch_row($result);
$total_no=$row[0];

//전체 페이지 수와 현재 글 번호를 구합니다.
$total_page=ceil($total_no/$list_num); //전체글수를 페이지당 글수로 나눈 값의 올림 값을 구함
$cur_num=$total_no - $list_num*($page-1); //현재 글번호

//bbs테이블에서 목록을 가져옵니다. (위의 쿼리문 사용예와 비슷합니다 .)
$query="select * from $tablename order by number desc limit $offset, $list_num"; // SQL 쿼리문
$result=mysql_query($query) or die (mysql_error()); // 쿼리문을 실행 결과
//쿼리 결과를 하나씩 불러와 실제 HTML에 나타내는 것은 HTML 문 중간에 삽입합니다.

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
//여기서부터 각종 페이지 링크
//먼저, 한 화면에 보이는 블록($page_num 기본값 이상일 때 블록으로 나뉘어짐 )
$total_block=ceil($total_page/$page_num);
$block=ceil($page/$page_num); //현재 블록
 
$first=($block-1)*$page_num; // 페이지 블록이 시작하는 첫 페이지
$last=$block*$page_num; //페이지 블록의 끝 페이지
 
if($block >= $total_block) {
        $last=$total_page;
}
 
echo "
                       <p align=center>";
//[처음][*개앞]
if($block > 1) {
        $prev=$first-1;
        echo "<a href='bbs_list.php?page=1'>[처음 ]</a>&nbsp; ";
        echo "<a href='bbs_list.php?page=$prev'>[$page_num 개 앞]</a>";
}
 
//[이전]
if($page > 1) {
        $go_page=$page-1;
        echo "  <a href='bbs_list.php?page=$go_page'>[이전 ]</a>&nbsp;       ";
}
 
//페이지 링크
for ($page_link=$first+1;$page_link<=$last;$page_link++) {
        if($page_link==$page) {
                echo "<font color=green><b>$page_link</b></font>";
        }
        else {
                echo "<a href='bbs_list.php?page=$page_link'>[$page_link]</a>";
        }
}
 
//[다음]
if($total_page > $page) {
        $go_page=$page+1;
        echo "&nbsp;<a href='bbs_list.php?page=$go_page'>[다음]</a>";
}
 
//[*개뒤][마지막]
if($block < $total_block) {
        $next=$last+1;
        echo "<a href='bbs_list.php?page=$netxt'>[$page_num 개 뒤]</a>&nbsp;";
        echo "<a href='bbs_list.php?page=$total_page'>[마지막]</a></p>";
}


 
?>
        </td>
    </tr>
    <tr>
        <td width=100% colspan=5>
            <p align=center><a href='bbs_write.php'>[글쓰기]</a></p>
        </td>
    </tr>
</table>
</body>
</html>