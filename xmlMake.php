<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    //include_once('./simple_html_dom.php');
    header("Content-Type: text/html; charset=UTF-8");

    $xml = new DOMDocument( '1.0', 'utf-8' );
    $xml -> formatOutput = true;

    $rss = $xml -> createElement( "rss" );
    $rss -> setAttribute( "xmlns:g", "http://base.google.com/ns/1.0" );
    $rss -> setAttribute( "version", 2.0 );
    $xml -> appendChild( $rss );

    $channel = $xml -> createElement( "channel" );
    $rss -> appendChild( $channel );
        //parent -> appendChild(child);

    $title = $xml -> createElement( "title", "Arribista" );
    $channel -> appendChild( $title );

    $link = $xml -> createElement( "link", "http://arribista.co.kr/" );
    $channel -> appendChild( $link );

    $description = $xml -> createElement( "description", "아리비스타" );
    $channel -> appendChild( $description );

    $ch = curl_init();
    $item = array();

    $siteMap = "http://arribista.co.kr/sitemap.xml";

    curl_setopt($ch, CURLOPT_URL, $siteMap);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

    $result = curl_exec ($ch);

    if($result === FALSE) {
        echo "cURL Error: " . curl_error($ch);
    }
    curl_close($ch);

    preg_match_all("!<loc>(.*?)<\/loc>!", $result, $match);
    $item["urls"] = $match[1];
    //$itemLength = count($item["urls"]);
    $itemLength = 5;
    $innerItem = array();



    for ($i = 0; $i < $itemLength; $i++) {
        @$xml->loadHTML($item["urls"][$i]);
        $inputs = $xml->getElementsByTagName('input');
        $val="";
        foreach ($inputs as $input) {
          // if the input nodes has an attribute named "linh"
          if ($input->getAttribute('id') == 'pars_no') {
             //get the value of the attribute "value" into the variable $val
             $val = $input->getAttribute('dds');
             break;
          }
        }

        echo "value found=" . $val;


    }


    // save XML as string or file
    //$test1 = $xml->saveXML(); // put string in test1
    //$xml->save('test1.xml'); // save as file

    echo "<xmp>" . $xml -> saveXML() . "</xmp>";
?>


<!-- for ($i = 0; $i < $itemLength; $i++) {

    $xmlIitem = $xml -> createElement( "item" );
    $channel -> appendChild( $xmlIitem );

    $html = file_get_html($item["urls"][$i]);


    foreach($html->find('[id="pars_no"]') as $element){
        $p_no =  $element->dds;
        $g_id = $xml -> createElement( "g:id", $p_no );
        $xmlIitem -> appendChild( $g_id );
    }
    foreach($html->find('[id="pars_name"]') as $element){
        $p_name =  $element->dds;
        $g_title = $xml -> createElement( "g:id", $p_name );
        $xmlIitem -> appendChild( $g_title );

        $g_description = $xml -> createElement( "g:description", $p_name );
        $xmlIitem -> appendChild( $g_description );
    }
    $g_p_category = $xml -> createElement("g:google_product_category", "미정");
    $xmlIitem -> appendChild( $g_p_category );

    $p_type = $xml -> createElement("g:product_type", "product");
    $xmlIitem -> appendChild( $p_type );

    $g_link = $xml -> createElement( "g:link", $item["urls"][$i] );
    $xmlIitem -> appendChild( $g_link );
    foreach($html->find('[id="pars_img"]') as $element){
        $p_img =  $element->dds;
        $g_image_link = $xml -> createElement( "g:image_link", "http:".$p_img );
        $xmlIitem -> appendChild( $g_image_link );
    }
    $g_condition = $xml -> createElement( "g:condition", "new" );
    $xmlIitem -> appendChild( $g_condition );

    $g_availability = $xml -> createElement( "g:availability", "in stock" );
    $xmlIitem -> appendChild( $g_availability );

    foreach($html->find('[id="pars_price"]') as $element){
        $p_price =  $element->dds;
        $g_price = $xml -> createElement( "g:image_link", $p_price." KRW" );
        $xmlIitem -> appendChild( $g_price );
    }
    $g_brand = $xml -> createElement( "g:brand", "아리비스타" );
    $xmlIitem -> appendChild( $g_brand );
} -->
