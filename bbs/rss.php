<?
/* Define some RSS 2.0 and other compatible feeds */
ini_set('user_agent', 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.9) Gecko/20071025 Firefox/2.0.0.9');

$rssfeed = array();
/* The PHP RSS feeds are RSS version 0.93 */

$search = array(); //검색키워드를 배열로 선언
$put = file_get_contents('http://blog.rss.naver.com/sealriel.xml');
file_put_contents('./put.xml', $put);
$rssfeed['PHP']= 'put.xml';
/* The YAHOO RSS feeds are RSS version 2.0 */
echo $rssfeed['PHP'];
foreach($rssfeed AS $name=>$url) {
$rssParser = simplexml_load_file($url);
/* Output the channel information */
print $rssParser->channel->title."\n";
print " URL: ".$rssParser->channel->link."\n";
print " ".$rssParser->channel->description."\n\n";
/* Iterate through the items, and output each one */
foreach ($rssParser->channel->item AS $item) {
print $item->title."\n";
print $item->link."\n";
print $item->bloggername."\n";
print $item->description."\n\n";
}
}
?>