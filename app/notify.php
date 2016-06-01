<?php

/**
 * ECSHOP 支付响应页面
 * ============================================================================
 * * 版权所有 2005-2012 上海商派网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: liubo $
 * $Id: respond.php 17217 2011-01-19 06:29:08Z liubo $
 */

define('IN_ECS', true);

require('includes/init.php');
require('includes/lib_payment.php');
require('includes/lib_order.php');

$pay_code = !empty($_REQUEST['code']) ? trim($_REQUEST['code']) : '';
if(empty($pay_code))
{
	exit;
}
/* 判断是否启用 */
$sql = "SELECT COUNT(*) FROM " . $ecs->table('payment') . " WHERE pay_code = '$pay_code' AND enabled = 1";
if ($db->getOne($sql) == 0)
{
	$result = false;
	$msg = '未开通支付宝';
}
else
{
	$plugin_file = 'includes/modules/payment/' . $pay_code . '.php';

	/* 检查插件文件是否存在，如果存在则验证支付是否成功，否则则返回失败信息 */
	if (file_exists($plugin_file))
	{
		/* 根据支付方式代码创建支付类的对象并调用其响应操作方法 */
		include_once($plugin_file);

		$payment = new $pay_code();
		$result  = $payment->respond();
		//$result     = (@$payment->respond()) ? $_LANG['pay_success'] : $_LANG['pay_fail'];
	}
	else
	{
		$result = false;
		$msg = '找不到接口文件';
	}
}
if($result)
{
	echo 'success';
}
else
{
	echo $msg;
}