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
$ch = curl_init();
$url = "http://arribista.co.kr/product/detail.html?product_no=3353&cate_no=1&display_group=7";

//URL to send the request to
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
$result = curl_exec ($ch);

if($result === FALSE) {
    echo "cURL Error: " . curl_error($ch);
}

curl_close($ch);

//$result = str_replace("<", "&lt;", $result);
//$result = str_replace(">", "&gt;", $result);

$item = array();

preg_match_all("!<h2>(.*?)<\/h2>!", $result, $match);
$item["name"] = $match[1];
//print_r($item["name"]);die;

preg_match_all('!<strong id="span_product_price_text">(.*?)<\/strong>!', $result, $match);
$item["price"] = $match[1];
//print_r($item["price"]);die;

preg_match_all('!<img src="//arribista.co.kr/web/product/big/(.*?).jpg" alt=".$item["name"]." class="BigImage">!', $result, $match);
$item["image"] = $match[1];
//print_r($item["image"]);die;





?>

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
