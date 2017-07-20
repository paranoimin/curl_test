<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    header("Content-Type: text/html; charset=UTF-8");

    $ch = curl_init();

    $url = "http://arribista.co.kr/product/메리홀터나시/960/";

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

    $result = curl_exec ($ch);

    $is_site_up = false;

    if($result === false) {
        echo 'Error: '.curl_error($ch). "\n";
        curl_close($ch);
    } else {
        curl_close($ch);
        $search_text = "pars_no";

        $document = new DOMDocument();
        if($document->loadHTML($result) !== false) {
            $elements = $document->getElementsByTagName('input');
            if($elements->length > 0) {
                if(stripos($elements->item(0)->nodeValue, $search_text) !== false) {
                    $is_site_up = true;
                }
            }
            print_r($elements);
        }
    }











?>
<!--
foreach($html->find('[id="pars_price"]') as $element)
    echo $element->dds . '<br>'; -->
