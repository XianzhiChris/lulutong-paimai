<?php
//判断是否为指定的APP访问
if(!empty($_SERVER['HTTP_APPVERIFY']))
{
	$app_verify = trim($_SERVER['HTTP_APPVERIFY']);
	$arr = explode(';',$app_verify);
	$md5 = $arr[0];
	$md5 = explode('=',$md5);
	$md5 = $md5[1];
	$ts = $arr[1];
	$ts = explode('=',$ts);
	$ts = $ts[1];

	require(dirname(__FILE__).'/data/app_setting.php');
	if(empty($app_setting['appid']))
	{
		die('ERROR1');
	}
	if(empty($app_setting['appkey']))
	{
		die('ERROR2');
	}
	$appid = $app_setting['appid'];
	$appkey = $app_setting['appkey'];
	if(trim($md5) != md5($appid.':'.$appkey.':'.$ts))
	{
		die('ERROR3');
	}
}
/*
else
{
	die('ERROR4');
}
*/
$script_name = empty($_REQUEST['script_name']) ? '' : trim($_REQUEST['script_name']);
$script_arr = array('index','user','flow','goods','search','category','article_cat','article_list','article','goods_comment','stores','brand','pro_search','activity','register','find_password','validate');
$supplier_arr = array('supplier');
if($script_name == 'region')
{
	require('region.php');
}
else if(in_array($script_name,$supplier_arr))
{
	define('IN_ECS',true);
	define('IN_CTRL',true);
	require(dirname(__FILE__).'/includes/init_supplier.php');
	require($script_name.'.php');
}
else if(in_array($script_name,$script_arr))
{
	define('IN_ECS',true);
	define('IN_CTRL',true);
	require(dirname(__FILE__).'/includes/init.php');
	require($script_name.'.php');
}
else
{
	die('ERROR5');
}