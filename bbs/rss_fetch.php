<?

include_once 'lib.php';

  //가져올 RSS 주소를 지정하면됩니다. 
$urls = array('http://www.feed43.com/4583741871504136.xml');

foreach ($urls as $url):
     $handle = fopen($url, 'r');

    if ($handle):
          $document = '';

         while (!feof($handle))
              $document .= fgets($handle, 4096);

         fclose($handle);

          //파서 생성
          $rss = new RSSParser;

          //파싱
         $rss->setRSS($document);
         rssParse($rss);

         $rss = NULL;
    endif;
endforeach;

?>