<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$ch = curl_init();
$item = array();

$siteMap = "http://arribista.co.kr/product/메리홀터나시/960/";

curl_setopt($ch, CURLOPT_URL, $siteMap);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

$result = curl_exec ($ch);

if($result === FALSE) {
    echo "cURL Error: " . curl_error($ch);
}
curl_close($ch);

preg_match_all('!<h2>(.*?)</h2>!', $result, $match);
$item["p_no"] = $match[1];
echo "넘버 : " . $item["p_no"][0];







?>

<!-- echo '<xml version="1.0">';
echo '<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">';
echo '<channel>';
echo '<title>Test Store</title>';
echo '<link>http://arribista.co.kr/</link>';
echo '<description>An example item from the feed</description>';
echo '<item>';

echo '<g:id>DB_1</g:id>';

echo '<g:title>Dog Bowl In Blue</g:title>';

echo '<g:description>Solid plastic Dog Bowl in marine blue color</g:description>';

echo '<g:link>http://www.example.com/bowls/db-1.html</g:link>';

echo '<g:image_link>http://images.example.com/DB_1.png</g:image_link>';

echo '<g:brand>Example</g:brand>';

echo '<g:condition>new</g:condition>';

echo '<g:availability>in stock</g:availability>';

echo '<g:price>9.99 GBP</g:price>';

echo '<g:shipping> 안씀 ';
echo '<g:country>UK</g:country>';
echo '<g:service>Standard</g:service>';
echo '<g:price>4.95 GBP</g:price>';
echo '</g:shipping> 여기까지 안씀';
echo '<g:google_product_category>Animals &gt; Pet Supplies</g:google_product_category>';
echo '<g:custom_label_0>Made in Waterford, IE</g:custom_label_0>';
echo '</item>';
echo '</channel>';
echo '</rss>'; -->
