<?
include "./lastRSS.php";
// -------------------------------------------------------------------
// 출력할 라인수를 결정합니다. 
$line = 50;
// -------------------------------------------------------------------
// 설정 URL을 지정합니다.
$rssurl = "http://www.albamon.com/rss/rss_list.asp?scd=c000&gcd=c130&rbcd=&rpcd=&gubun=1";
// -------------------------------------------------------------------
// rss설정
$rss = new lastRSS;
$rss->cache_dir = './cache/';   //케쉬를만들 폴더설정
$rss->cache_time = 0;     //케쉬생성주기
$rss->cp = 'UTF-8';      //인코딩
$rss->date_format = 'y-m-d';   //날짜형식 년월일
   
if ($rs = $rss->get($rssurl)) {
  $i=0;
  foreach($rs['items'] as $item) {
// -------------------------------------------------------------------
// 인코딩및 cdta 태그를 지우는 부분입니다.
   $item[link]=str_replace("<![CDATA[", "",$item[link]);
   $item[link]=str_replace("]]>", "",$item[link]);
   $item[link]=iconv('UTF-8', 'EUC-KR', $item[link]);
   $item[title]=str_replace("<![CDATA[", "",$item[title]);
   $item[title]=str_replace("]]>", "",$item[title]);
   $item[title]=iconv('UTF-8', 'EUC-KR', $item[title]);
   $item[description]=str_replace("<![CDATA[", "",$item[description]);
   $item[description]=str_replace("]]>", "",$item[description]);
   $item[description]=iconv('UTF-8', 'EUC-KR', $item[description]);
   $item[author]=iconv('UTF-8', 'EUC-KR', $item[author]);
   $item[category]=iconv('UTF-8', 'EUC-KR', $item[category]);
// -------------------------------------------------------------------
// 출력 HTML 부분
   ?>
    제목 :  <?=$item['title']?>   <br/>
    링크 :  <?=$item[link]?>   <br/>
    내용 :  <?=$item[description]?>  <br/>
    작성자 : <?=$item[author]?>   <br/>
    작성일 : <?=$item[pubDate]?>   <br/>
    <br/><br/>
   <?
// -------------------------------------------------------------------
// 라인수결정
   if($i++ > $line-2) break;
  } 
}
// -------------------------------------------------------------------
// RSS경로가 잘못되거나 열수 없을때
else {?>
경로를 찾을수 없거나, 서버를 찾을수 없습니다.
<?
}
?>