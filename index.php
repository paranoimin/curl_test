<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>cURL Test</title>
    <script type="text/javascript" src="./node_modules/jquery/dist/jquery.min.js"></script>

    <link rel="stylesheet" href="./src/css/index.css">
</head>
<body>
    <div id="wrap">
        <h1>Hello PHP!</h1>
    </div>
    <!-- <script type="text/javascript" src="./src/js/index.js"></script> -->
</body>
</html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

//basic cURL
//$ch = curl_init();
//$url = "http://arribista.co.kr/product/detail.html?product_no=3353&cate_no=1&display_group=7";
//$siteMap = "http://arribista.co.kr/sitemap.xml";

//URL to send the request to
// curl_setopt($ch, CURLOPT_URL, $siteMap);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
// $result = curl_exec ($ch);
// if($result === FALSE) {
//     echo "cURL Error: " . curl_error($ch);
// }
// curl_close($ch);
// //$result = str_replace("<", "&lt;", $result);
// //$result = str_replace(">", "&gt;", $result);
// $total = array();
// preg_match_all("!<loc>(.*?)<\/loc>!", $result, $match);
// $itemURLs["URLs"] = $match[1];
// $itemLength = count($itemURLs["URLs"]);
// //print_r($itemURLs["URLs"]);
// echo "길이 : " . count($itemURLs["URLs"]);
// echo "0번 : " . $itemURLs["URLs"][0];

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
    $ch2 = curl_init();
    curl_setopt($ch2, CURLOPT_URL, $item["urls"][$i]);
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
    $secondResult = curl_exec ($ch2);
    curl_close($ch2);
    if($result === FALSE) {
        echo "cURL Error: " . curl_error($ch2);
    }
    preg_match_all("!<h2>(.*?)<\/h2>!", $secondResult, $match);
    $innerItem["name"] = $match[1];

    preg_match_all('!<strong id="span_product_price_text">(.*?)<\/strong>!', $secondResult, $match);
    $innerItem["price"] = $match[1];

    print_r($innerItem["price"]);
    //echo $innerItem["price"][0];

    // preg_match_all('!<span style="font-size:12px;color:#555555;">(.*?)<\/span>!', $secondResult, $match);
    //
    // $innerItem["desc"] = $match[1];
    //
    //
    // print_r($innerItem["desc"]);
    //echo "아이템 설명 [" . $i . "] : " . $innerItem["desc"][0] . "<br />";



    //print_r($innerItem["name"]);
}

// for ($j = 0; $j < count($innerItem["name"]); $j++) {
//     echo "길이 : " . count($innerItem["name"]) . "<br />";
//     echo "이름 : " . $innerItem["name"][$j] . "<br />";
// }



// $item = array();
// preg_match_all("!<h2>(.*?)<\/h2>!", $result, $match);
// $item["name"] = $match[1];
// //print_r($item["name"]);die;
// $itemName = $item["name"][0];
//
// echo "아이템 이름 : " . $itemName . "<br />";
//
// preg_match_all('!<strong id="span_product_price_text">(.*?)<\/strong>!', $result, $match);
// $item["price"] = $match[1];
// //print_r($item["price"]);die;
// $itemPrice = $item["price"][0];
//
// echo "아이템 가격 : " . preg_replace("/[^0-9]*/s", "", $itemPrice) . "<br />";
//
// //preg_match_all('!<img src="(.*?)" alt="'.$itemName.'" class="BigImage\s\">!', $result, $match);
// preg_match_all('!<div class="keyImg">(.*?)&nbsp;<\/div>!', $result, $match);
// $item["image"] = $match[1];
// print_r($item["image"]);die;
// //$imageName = $item["image"][0];
// echo "이미지 : ".$imageName."<br />";
// echo '&lt;img src="(.*?)" alt="'.$itemName.'" class="BigImage&nbsp;"&gt;';


?>


<!-- //curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 인증서 체크같은데 true 시 안되는 경우가 많다.
// default 값이 true 이기때문에 이부분을 조심 (https 접속시에 필요)
//curl_setopt ($ch, CURLOPT_SSLVERSION,3); // SSL 버젼 (https 접속시에 필요)
//curl_setopt ($ch, CURLOPT_HEADER, 0); // 헤더 출력 여부
//curl_setopt ($ch, CURLOPT_POST, 1); // Post Get 접속 여부
//curl_setopt ($ch, CURLOPT_POSTFIELDS, "var1=str1&amp;var2=str2"); // Post 값  Get 방식처럼적는다.
//curl_setopt ($ch, CURLOPT_TIMEOUT, 30); // TimeOut 값
//curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); // 결과값을 받을것인지
<a href="/product/detail.html?product_no=[^\s]*?&;cate_no=[^\s]*?&;display_group=[^\s]*?"><span style="font-size:12px;color:#000000;">[^\s]*?</span></a>
http://www.arribista.co.kr/product/detail.html?product_no=[^\s]*?&cate_no=[^\s]*?&display_group=[^\s]*?

<div class="keyImg">
               <img src="//arribista.co.kr/web/product/big/201707/3353_shop1_248663.jpg" alt="레이스 펀칭나시" class="BigImage ">
            &nbsp;</div>

-->

<!-- //initialize Session
// $ch = curl_init();
// curl_setopt ($ch, CURLOPT_URL,"http://arribista.co.kr/product/detail.html?product_no=3353&cate_no=1&display_group=7"); //접속할 URL 주소
// curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
// $result = curl_exec ($ch);
// $title = array();
// preg_match_all('!<div class="headingArea"><h2>(.*?)</h2><\/div>!', $result, $match);
// $title['name'] = $match[1];
// print_r($title['name']);die;
// curl_close ($ch);
//echo $result;
//curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 인증서 체크같은데 true 시 안되는 경우가 많다.
// default 값이 true 이기때문에 이부분을 조심 (https 접속시에 필요)
//curl_setopt ($ch, CURLOPT_SSLVERSION,3); // SSL 버젼 (https 접속시에 필요)
//curl_setopt ($ch, CURLOPT_HEADER, 0); // 헤더 출력 여부
//curl_setopt ($ch, CURLOPT_POST, 1); // Post Get 접속 여부
//curl_setopt ($ch, CURLOPT_POSTFIELDS, "var1=str1&var2=str2"); // Post 값  Get 방식처럼적는다.
//curl_setopt ($ch, CURLOPT_TIMEOUT, 30); // TimeOut 값
//curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); // 결과값을 받을것인지 -->
