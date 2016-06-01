<?php

/**
 * ECSHOP ֧����Ӧҳ��
 * ============================================================================
 * * ��Ȩ���� 2005-2012 �Ϻ���������Ƽ����޹�˾������������Ȩ����
 * ��վ��ַ: http://www.ecshop.com��
 * ----------------------------------------------------------------------------
 * �ⲻ��һ�������������ֻ���ڲ�������ҵĿ�ĵ�ǰ���¶Գ����������޸ĺ�
 * ʹ�ã�������Գ���������κ���ʽ�κ�Ŀ�ĵ��ٷ�����
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
/* �ж��Ƿ����� */
$sql = "SELECT COUNT(*) FROM " . $ecs->table('payment') . " WHERE pay_code = '$pay_code' AND enabled = 1";
if ($db->getOne($sql) == 0)
{
	$result = false;
	$msg = 'δ��֧ͨ����';
}
else
{
	$plugin_file = 'includes/modules/payment/' . $pay_code . '.php';

	/* ������ļ��Ƿ���ڣ������������֤֧���Ƿ�ɹ��������򷵻�ʧ����Ϣ */
	if (file_exists($plugin_file))
	{
		/* ����֧����ʽ���봴��֧����Ķ��󲢵�������Ӧ�������� */
		include_once($plugin_file);

		$payment = new $pay_code();
		$result  = $payment->respond();
		//$result     = (@$payment->respond()) ? $_LANG['pay_success'] : $_LANG['pay_fail'];
	}
	else
	{
		$result = false;
		$msg = '�Ҳ����ӿ��ļ�';
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