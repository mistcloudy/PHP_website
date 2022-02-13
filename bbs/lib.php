<?

function rssParse($rss_obj)
{  
     //내장 XML 파서 생성
    $xml_parser = xml_parser_create('UTF-8');
 
    xml_set_object($xml_parser, $rss_obj);   
    xml_parser_set_option($xml_parser, XML_OPTION_CASE_FOLDING, FALSE);

     //XML 파서에 이벤트 핸들러를 할당
    xml_set_element_handler($xml_parser, "startElement", "endElement");
    xml_set_character_data_handler($xml_parser, "characterData");

     //XML 파싱
    xml_parse($xml_parser, $rss_obj->getRSS());
    xml_parser_free($xml_parser);
}


class RSSParser
{
    private $rss_doc;

    private $current_element;
    private $in_item = FALSE;
    private $in_description = FALSE;
    private $title;
    private $date;
    private $link;
    private $category;
    private $content;


    function setRSS($rss_text)
    {
         $this->rss_doc = $rss_text;
    }

    function getRSS()
    {
         return $this->rss_doc;
    }

    //태그가 시작하는 부분에서 처리할 내용  
    function startElement($parser, $element, $attrs)
    {
         if ($this->in_description) return;    

         $this->current_element = strtoupper($element);
 
         switch ($this->current_element):
              case 'ITEM' :
                   $this->in_item = TRUE;
                   break;

              case 'DESCRIPTION' :
                   if ($this->in_item) {
                        $this->in_description = TRUE;
                        $this->content = '';
                   }
                   break;
   
              default: 
                   break;     
         endswitch;
    }

    function endElement($parser, $element)
    {
         $el = strtoupper($element);

         if ($this->in_description and 'DESCRIPTION' != $el) return;

         switch (strtoupper($el)):
              case 'ITEM' :
                   $this->in_item = FALSE;
                   $this->printItem();        // 저장된 포스트를 출력하거나 DB로 자장하면 됨.
                    break;

              case 'DESCRIPTION' :
                   if ($this->in_item) {
                        $this->in_description = FALSE;
                   } 
                   break;

              default: 
                   break;     
         endswitch;

         $this->current_element = '';
    }

    function characterData($parser, $data)
    {   
         if ('' == trim($data)) return; 

         if ($this->in_item):
  
          switch ($this->current_element):
               case 'TITLE' :
                    $this->title = $data;
                    break;

               case 'DESCRIPTION' :
                    $this->content .= $data; //반드시 .= 연산자를 써야함!
                     break;

               case 'CATEGORY' :
                    $this->category = $data;     
                    break;

               case 'PUBDATE' :
                    $this->date = $data;
                    break;

               case 'LINK' :
                    $this->link = $data;
                    break;
          endswitch;   
   
         endif;
    }      

     //여기서는 바로 출력을 하지만, DB에 저장하는 방식으로 구현할 수도 있습니다.
     private function printItem()
    {
         echo "<P><STRONG>";
         echo $this->title;
         echo "</STRONG>";
  
         echo "  (";
         echo $this->date.")</P>";
  
         echo $this->content;
         echo "<BR>";
         echo $this->category." | ";
         echo $this->link;
 
         echo "<br><br>";
    }
  
}//end of class

?>