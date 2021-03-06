<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
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
    $itemLength = count($item["urls"]);
    //$itemLength = 5;
    $innerItem = array();


    for ($i = 0; $i < $itemLength; $i++) {
      $ch2 = curl_init();
      curl_setopt($ch2, CURLOPT_URL, $item["urls"][$i]);
      curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
      $secondResult = curl_exec ($ch2);
      curl_close($ch2);
      if($result === FALSE) {
          echo "cURL Error: " . curl_error($ch2);
      }

      $secondResult = preg_replace("/\s|/", '', $secondResult);
      $secondResult = str_replace("<", "&lt;", $secondResult);
      $secondResult = str_replace(">", "&gt;", $secondResult);

      $xmlIitem = $xml -> createElement( "item" );
      $channel -> appendChild( $xmlIitem );

      $p_no_result = $secondResult;
      $p_name_result = $secondResult;
      $p_img_result = $secondResult;
      $p_price_result = $secondResult;

      $p_no_result = strstr($p_no_result, "pars_no");
      $p_no_result = strstr($p_no_result, "dds");
      $p_no_result = strstr($p_no_result, '"');
      $p_no_last_index = strpos($p_no_result, 'name');
      $p_no_result = substr($p_no_result, 1, $p_no_last_index-2);

      $g_id = $xml -> createElement( "g:id", $p_no_result );
      $xmlIitem -> appendChild( $g_id );

      $p_name_result = strstr($p_name_result, "pars_namu");
      $p_name_result = strstr($p_name_result, "dds");
      $p_name_result = strstr($p_name_result, '"');
      $p_name_last_index = strpos($p_name_result, 'name');
      $p_name_result = substr($p_name_result, 1, $p_name_last_index-2);

      $g_title = $xml -> createElement( "g:title", $p_name_result );
      $xmlIitem -> appendChild( $g_title );

      $g_description = $xml -> createElement( "g:description", $p_name_result );
      $xmlIitem -> appendChild( $g_description );

      $g_p_category = $xml -> createElement("g:google_product_category", "미정");
      $xmlIitem -> appendChild( $g_p_category );

      $p_type = $xml -> createElement("g:product_type", "product");
      $xmlIitem -> appendChild( $p_type );

      $g_link = $xml -> createElement( "g:link", $item["urls"][$i] );
      $xmlIitem -> appendChild( $g_link );

      $p_img_result = strstr($p_img_result, "pars_img");
      $p_img_result = strstr($p_img_result, "dds");
      $p_img_result = strstr($p_img_result, '"');
      $p_img_last_index = strpos($p_img_result, 'name');
      $p_img_result = substr($p_img_result, 1, $p_img_last_index-2);

      $g_image_link = $xml -> createElement( "g:image_link", "http:".$p_img_result );
      $xmlIitem -> appendChild( $g_image_link );

      $g_condition = $xml -> createElement( "g:condition", "new" );
      $xmlIitem -> appendChild( $g_condition );

      $g_availability = $xml -> createElement( "g:availability", "in stock" );
      $xmlIitem -> appendChild( $g_availability );


      $p_price_result = strstr($p_price_result, "pars_price");
      $p_price_result = strstr($p_price_result, "dds");
      $p_price_result = strstr($p_price_result, '"');
      $p_price_last_index = strpos($p_price_result, 'name');
      $p_price_result = substr($p_price_result, 1, $p_price_last_index-2);

      $g_price = $xml -> createElement( "g:price", $p_price_result." KRW" );
      $xmlIitem -> appendChild( $g_price );

      $g_brand = $xml -> createElement( "g:brand", "아리비스타" );
      $xmlIitem -> appendChild( $g_brand );

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
