<?
		mysql_connect("localhost", "root", "apmsetup") or die(mysql_error());
		mysql_select_db("phpmyadmin");
		mysql_query("set names utf8");
		$keyword = $_POST["keyword"];
		$keyword = urlencode($keyword);
		$tablename = "naverkeyword";
		$query="select * from $tablename order by number";
		$result=mysql_query($query) or die (mysql_error());

		while ($array=mysql_fetch_array($result)){
			$keyword=$array[keyword];
			echo "<br/><b>$keyword</b> : ";
			$keyword=urlencode($keyword);
		
		$blog=array();
		$blog[0]="행복한 개구리";
		
		$count='0';
		/* Define some RSS 2.0 and other compatible feeds */
		$rssfeed = array();
		/* The PHP RSS feeds are RSS version 0.93 */
	
		$url= "http://openapi.naver.com/search?key=f9ac6b29e47575cc06fd9c6a1cc76c1b&query='$keyword'&display=10&start=1&target=blog&sort=sim";
		$rssParser = simplexml_load_file($url);
		
							foreach ($rssParser->channel->item AS $item) {
								
								$count ++;
								
										foreach($blog as $name){											
														if($item->bloggername==$name){
									
															print $count." ";
														}
										}
							}
			}

?>

<html>
	<head>
		<title>네이버 api 연동</title>
	</head>
		<body>
			<form name='myFORM' method='post' action='naveropenapi.php'>
			<input type='text' name='keyword'>
			<input type='submit' name='button'><br/>
			</form>
		</body>
</html>