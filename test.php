<?php
class curl{
public static function curl_post(){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://m.baidu.com/?normalload=1#");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    // 要求结果为字符串且输出到屏幕上
curl_setopt($ch, CURLOPT_HEADER, 0); // 不要http header 加快效率
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
curl_setopt($ch, CURLOPT_TIMEOUT, 15);
$rs=curl_exec($ch);
curl_close($ch);
return $rs;
}
}
print_r(curl::curl_post());