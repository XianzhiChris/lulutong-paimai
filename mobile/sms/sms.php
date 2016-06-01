<?php
error_reporting(0); // 代码增加 By www.68ecshop.com
//session_start();

header("Content-type:text/html; charset=UTF-8");
$_CFG = $GLOBALS['_CFG'];
function random ($length = 6, $numeric = 0)
{
	PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
	if($numeric)
	{
		$hash = sprintf('%0' . $length . 'd', mt_rand(0, pow(10, $length) - 1));
	}
	else
	{
		$hash = '';
		$chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
		$max = strlen($chars) - 1;
		for($i = 0; $i < $length; $i ++)
		{
			$hash .= $chars[mt_rand(0, $max)];
		}
	}
	return $hash;
}

function read_file ($file_name)
{
	$content = '';
	$filename = date('Ymd') . '/' . $file_name . '.log';
	if(function_exists('file_get_contents'))
	{
		@$content = file_get_contents($filename);
	}
	else
	{
		if(@$fp = fopen($filename, 'r'))
		{
			@$content = fread($fp, filesize($filename));
			@fclose($fp);
		}
	}
	$content = explode("\r\n",$content);
	return end($content);
}

if($_GET['act'] == 'check')
{
	/* 代码修改_start BY www.ecshop68.com */
	$mobile = isset($_POST['mobile']) ? trim($_POST['mobile']) : '';
	$mobile_code = isset($_POST['mobile_code']) ? trim($_POST['mobile_code']) : '';
	/* 代码修改_end BY www.ecshop68.com */

	if(time() - $_SESSION['time'] > 30 * 60)
	{
		unset($_SESSION['mobile_code']);
		exit(json_encode(array(
			'msg' => '验证码超过30分钟。'
		)));
	}
	else
	{
		if($mobile != $_SESSION['mobile'] or $mobile_code != $_SESSION['mobile_code'])
		{
			exit(json_encode(array(
				'msg' => '手机验证码输入错误。'
			)));
		}
		else
		{
			exit(json_encode(array(
				'code' => '2'
			)));
		}
	}

}

if($_GET['act'] == 'send')
{

	/* 代码修改_start BY www.ecshop68.com */
	$mobile = isset($_POST['mobile']) ? trim($_POST['mobile']) : '';
	$mobile_code = isset($_POST['mobile_code']) ? trim($_POST['mobile_code']) : '';
	/* 代码修改_end BY www.ecshop68.com */

	//session_start();
	if(empty($mobile))
	{
		exit(json_encode(array(
			'msg' => '手机号码不能为空'
		)));
	}

	$preg = '/^1[0-9]{10}$/'; // 简单的方法
	if(! preg_match($preg, $mobile))
	{
		exit(json_encode(array(
			'msg' => '手机号码格式不正确'
		)));
	}

	$mobile_code = random(6, 1);

	$content = sprintf($GLOBALS['_CFG']['sms_register_tpl'],$mobile_code,$GLOBALS['_CFG']['sms_sign']);


	if($_SESSION['mobile'])
	{
		if(strtotime(read_file($mobile)) > (time() - 60))
		{
			exit(json_encode(array(
				'msg' => '获取验证码太过频繁，一分钟之内只能获取一次。'
			)));
		}
	}

	//$num = sendSMS($mobile, $content);
	$num = $_CFG['sms_shop_mobile']?sendYunSMS($mobile, $content):sendJuheSMS($mobile, $content);  //获取后台设置短信接口参数 李云鹏 20160429

	if($num == true)
	{
		$_SESSION['mobile'] = $mobile;
		$_SESSION['mobile_code'] = $mobile_code;
		$_SESSION['time'] = time();
		exit(json_encode(array(
			'code' => 2
		)));
	}
	else
	{
		exit(json_encode(array(
			'msg' => '手机验证码发送失败。'
		)));
	}
}

function sendSMS ($mobile, $content, $time = '', $mid = '')
{
	$content = iconv('utf-8', 'gbk', $content);
	$http = 'http://http.yunsms.cn/tx/'; // 短信接口
	$uid = '57137'; // 用户账号
	$pwd = 'e5k9r6'; // 密码

	$data = array(
		'uid' => $uid, // 用户账号
		'pwd' => strtolower(md5($pwd)), // MD5位32密码,密码和用户名拼接字符
		'mobile' => $mobile, // 号码
		'content' => $content, // 内容
		'time' => $time, // 定时发送
		'mid' => $mid
	);
	$re = postSMS($http, $data); // POST方式提交

	// change_sms change_start

	$re_t = substr(trim($re), 3, 3);

	if(trim($re) == '100' || $re_t == '100')

		// change_sms change_end

	{
		return true;
	}
	else
	{
		return false;
	}
}

function postSMS ($url, $data = '')
{
	$row = parse_url($url);
	$host = $row['host'];
	$port = $row['port'] ? $row['port'] : 80;
	$file = $row['path'];
	while(list($k, $v) = each($data))
	{
		$post .= rawurlencode($k) . "=" . rawurlencode($v) . "&"; // 转URL标准码
	}
	$post = substr($post, 0, - 1);
	$len = strlen($post);
	$fp = @fsockopen($host, $port, $errno, $errstr, 10);
	if(! $fp)
	{
		return "$errstr ($errno)\n";
	}
	else
	{
		$receive = '';
		$out = "POST $file HTTP/1.1\r\n";
		$out .= "Host: $host\r\n";
		$out .= "Content-type: application/x-www-form-urlencoded\r\n";
		$out .= "Connection: Close\r\n";
		$out .= "Content-Length: $len\r\n\r\n";
		$out .= $post;
		fwrite($fp, $out);
		while(! feof($fp))
		{
			$receive .= fgets($fp, 128);
		}
		fclose($fp);
		$receive = explode("\r\n\r\n", $receive);
		unset($receive[0]);
		return implode("", $receive);
	}
}
/**
 * 聚合数据短信接口  李云鹏20160429
 */
function sendJuheSMS($mobile, $smscontent, $time = '', $mid = ''){
	$sendUrl = 'http://v.juhe.cn/sms/send'; //短信接口的URL

	$smsConf = array(
		'key'   => 'db2df17e51d091bcce1715441151566b', //您申请的APPKEY
		'mobile'    => $mobile, //接受短信的用户手机号码
		'tpl_id'    => '13291', //您申请的短信模板ID，根据实际情况修改
		'tpl_value' =>'#code#='.$smscontent //您设置的模板变量，根据实际情况修改
	);

	$content = juhecurl($sendUrl,$smsConf,1); //请求发送短信

	if($content){
		$result = json_decode($content,true);
		$error_code = $result['error_code'];
		if($error_code == 0){
			return true;
		}else{
			return false;
		}
	}else{
		return false;
	}
}
/**
 * 请求接口返回内容  聚合数据短信接口  李云鹏20160429
 * @param  string $url [请求的URL地址]
 * @param  string $params [请求的参数]
 * @param  int $ipost [是否采用POST形式]
 * @return  string
 */
function juhecurl($url,$params=false,$ispost=0){
	$httpInfo = array();
	$ch = curl_init();

	curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
	curl_setopt( $ch, CURLOPT_USERAGENT , 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.172 Safari/537.22' );
	curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 30 );
	curl_setopt( $ch, CURLOPT_TIMEOUT , 30);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
	if( $ispost )
	{
		curl_setopt( $ch , CURLOPT_POST , true );
		curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
		curl_setopt( $ch , CURLOPT_URL , $url );
	}
	else
	{
		if($params){
			curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
		}else{
			curl_setopt( $ch , CURLOPT_URL , $url);
		}
	}
	$response = curl_exec( $ch );
	if ($response === FALSE) {
		//echo "cURL Error: " . curl_error($ch);
		return false;
	}
	$httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
	$httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
	curl_close( $ch );
	return $response;
}
function checkSMS ($mobile, $mobile_code)
{
	$arr = array(
		'error' => 0,'msg' => ''
	);
	if(time() - $_SESSION['time'] > 30 * 60)
	{
		unset($_SESSION['mobile_code']);
		$arr['error'] = 1;
		$arr['msg'] = '验证码超过30分钟。';
	}
	else
	{
		if($mobile != $_SESSION['mobile'] or $mobile_code != $_SESSION['mobile_code'])
		{
			$arr['error'] = 1;
			$arr['msg'] = '手机验证码输入错误。';
		}
		else
		{
			$arr['error'] = 2;
		}
	}
	return $arr;
}
/** 云片短信接口 李云鹏20160430 */
function sendYunSMS($mobile, $smscontent){
	$apikey = "775ecd1a263ba64195d05b2668f350f7";
	$mobile = "$mobile"; //请用自己的手机号代替
	$text="【路路通拍卖】您的验证码是".$smscontent;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept:text/plain;charset=utf-8', 'Content-Type:application/x-www-form-urlencoded','charset=utf-8'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	$data=array('text'=>$text,'apikey'=>$apikey,'mobile'=>$mobile);
	$json_data = yun_send($ch,$data);
	$array = json_decode($json_data,true);

	if($array['code'] == 0){
		return true;
	}else{
		return false;
	}
	curl_close($ch);
}
//获取剩余金额
function syYunSMS(){
	$apikey = "775ecd1a263ba64195d05b2668f350f7";

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept:text/plain;charset=utf-8', 'Content-Type:application/x-www-form-urlencoded','charset=utf-8'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	$json_data = yun_get_user($ch,$apikey);
	$array = json_decode($json_data,true);

	return $array['balance'];
	//return $array;

	curl_close($ch);
}
function yun_get_user($ch,$apikey){
	curl_setopt ($ch, CURLOPT_URL, 'https://sms.yunpian.com/v2/user/get.json');
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('apikey' => $apikey)));
	return curl_exec($ch);
}
function yun_send($ch,$data){
	curl_setopt ($ch, CURLOPT_URL, 'https://sms.yunpian.com/v2/sms/single_send.json');
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	return curl_exec($ch);
}
?>
