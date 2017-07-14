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
$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL,"http://arribista.co.kr/product/detail.html?product_no=3353&cate_no=1&display_group=7"); //접속할 URL 주소
//curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 인증서 체크같은데 true 시 안되는 경우가 많다.
// default 값이 true 이기때문에 이부분을 조심 (https 접속시에 필요)
//curl_setopt ($ch, CURLOPT_SSLVERSION,3); // SSL 버젼 (https 접속시에 필요)
curl_setopt ($ch, CURLOPT_HEADER, 0); // 헤더 출력 여부
curl_setopt ($ch, CURLOPT_POST, 1); // Post Get 접속 여부
curl_setopt ($ch, CURLOPT_POSTFIELDS, "var1=str1&var2=str2"); // Post 값  Get 방식처럼적는다.
curl_setopt ($ch, CURLOPT_TIMEOUT, 30); // TimeOut 값
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); // 결과값을 받을것인지
$result = curl_exec ($ch);
curl_close ($ch);

echo $result;
?>

<script type="text/javascript">
    (function() {
        console.log(<? echo $result?>);
    })();
</script>
