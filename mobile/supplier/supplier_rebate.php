<?php

/**
 * 管理中心 返佣管理
 * $Author: yangsong
 * 
 */

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
require_once(ROOT_PATH . 'includes/lib_rebate.php');
require_once(ROOT_PATH . 'includes/lib_order.php');
require_once(ROOT_PATH . 'includes/lib_supplier_common_wap.php');


/*------------------------------------------------------ */
//-- 返佣列表
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'list')
{
     /* 检查权限 */
    admin_priv('rebate_manage');

    /* 查询 */
    $result = rebate_list();

    /* 模板赋值 */
    $smarty->assign('supplier_list',    $result['result']);
    $smarty->assign('filter',       $result['filter']);

    /* 显示模板 */
    _wap_assign_header_info('平台佣金列表');
    _wap_assign_footer_order_info();
    _wap_display_page('supplier_rebate_list.htm');
}

/*------------------------------------------------------ */
//-- 排序、分页、查询
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'query')
{
    check_authz_json('rebate_manage');

    $result = rebate_list('list');

    $smarty->assign('supplier_list',    $result['result']);
    $smarty->assign('filter',       $result['filter']);
    $smarty->assign('record_count', $result['record_count']);
    $smarty->assign('page_count',   $result['page_count']);

    /* 排序标记 */
    $sort_flag  = sort_flag($result['filter']);
    $smarty->assign($sort_flag['tag'], $sort_flag['img']);

    make_json_result($smarty->fetch('supplier_rebate_list.htm'), '',
        array('filter' => $result['filter'], 'page_count' => $result['page_count']));
}

//结算页面展示
elseif ($_REQUEST['act'] == 'view')
{
	admin_priv('rebate_manage');

	$id = intval($_REQUEST['rid']);
    if (($rebate = rebateHave($id)) === false)
    {
        sys_msg('该返佣记录不存在！');
    }
	else
	{
		$rebate['sign'] = createSign($rebate['rebate_id'],$rebate['supplier_id']);
		$rebate['rebate_paytime_start'] = local_date('Y.m.d', $rebate['rebate_paytime_start']);
		$paytime_end = $rebate['rebate_paytime_end'];
		$rebate['rebate_paytime_end'] = local_date('Y.m.d', $paytime_end);
		//结算信息
		$money = getRebateOrderMoney($id);
		$money_info = array();
		foreach($money as $key=>$val){
			$money_info[$key]['allmoney'] = $val;
			$money_info[$key]['allmoney'] = price_format($val);
			$money_info[$key]['supplier_rebate'] = $rebate['supplier_rebate'];
			$money_info[$key]['rebatemoney'] = price_format($val*$rebate['supplier_rebate']/100);
		}
		$smarty->assign('money_info',   $money_info);

		//佣金统计
		$allmoney = array_sum($money);
		$tongji['allmoney'] = price_format($allmoney);
		$tongji['allrebate'] = price_format($allmoney*$rebate['supplier_rebate']/100);
		$tongji['chamoney'] = price_format($allmoney*(1-$rebate['supplier_rebate']/100));

		$tongji['rebate_all'] = ($rebate['rebate_all'] > 0) ? $rebate['rebate_all'] : $tongji['allmoney'];
		$tongji['rebate_money'] = ($rebate['rebate_money'] > 0) ? $rebate['rebate_money'] : $tongji['allrebate'];
		$tongji['payable_price'] = $rebate['payable_price'];

		$rebate['caozuo'] = getRebateDo($rebate['status'],$rebate['rebate_id'],'rebate_view');
		$smarty->assign('allmoney',   $tongji);

		//商家店铺信息
		$sql = "select s.*, r.rank_name, u.user_name from ".$ecs->table('supplier')." AS s left join ".$ecs->table('supplier_rank').
					" AS r on s.rank_id=r.rank_id left join ". $ecs->table('users') ." AS u on s.user_id=u.user_id  where s.supplier_id='$rebate[supplier_id]' ";
		$supplier =$db->getRow($sql);
		if (!empty($supplier))
		{
			$supplier['province'] = $db->getOne("select region_name from ". $ecs->table('region') ." where region_id='$supplier[province]' ");
			$supplier['city'] = $db->getOne("select region_name from ". $ecs->table('region') ." where region_id='$supplier[city]' ");
			$supplier['district'] = $db->getOne("select region_name from ". $ecs->table('region') ." where region_id='$supplier[district]' ");
		}

		//佣金操作日志
		$sql = "select * from ".$ecs->table('supplier_rebate_log')." where rebateid=".$rebate['rebate_id']." and type=".REBATE_LOG_LIST." order by logid desc";
		$logs = array();
		$query = $db->query($sql);
		while($row = $db->fetchRow($query)){
			$row['addtime_dec'] = local_date('Y-m-d H:i', $row['addtime']);
			$logs[$row['logid']] = $row;
		}

		$smarty->assign('logs',   $logs);
	}

	$smarty->assign('rebate', $rebate);
	$smarty->assign('supplier', $supplier);
        $smarty->assign('full_page',1);
        $smarty->assign('ur_here','结算单详情');    
	assign_query_info();
    $smarty->display('supplier_rebate_view.htm');
}



/*------------------------------------------------------ */
//-- 发起结算操作
/*------------------------------------------------------ */
elseif ($_REQUEST['act']=='update')
{
    /* 检查权限 */
    admin_priv('rebate_manage'); 

   /* 提交值 */
   $rebate_id =  intval($_REQUEST['id']);
   if (($rebate = rebateHave($rebate_id)) === false)
    {
          sys_msg('该返佣记录不存在！');
    }
   $rebate = array(
		'status'	=> 3
   );

	/* 保存返佣信息 */
	$db->autoExecute($ecs->table('supplier_rebate'), $rebate, 'UPDATE', "rebate_id = '" . $rebate_id . "'");

	//修改佣金信息状态记录
		$rebate_list = array(
				'rebateid' => $rebate_id,
				'username' => '入驻方:'.$_SESSION['supplier_name'],
				'type' => REBATE_LOG_LIST,
				'typedec' => '确认通过',
				'contents' => '佣金状态由等待审核变等待平台付款',
				'addtime' => gmtime()
		);
		$db->autoExecute($ecs->table('supplier_rebate_log'), $rebate_list, 'INSERT');
	 /* 清除缓存 */
	clear_cache_files();

	/* 提示信息 */
	$links[] = array('href' => 'supplier_rebate.php?act=list' , 'text' => '返回本期佣金列表');
	sys_msg('恭喜，处理成功！', 0, $links);    

}

/*------------------------------------------------------ */
//-- 取消结算操作
/*------------------------------------------------------ */
elseif ($_REQUEST['act']=='cancel')
{
	 /* 检查权限 */
    admin_priv('rebate_manage');
	$rebate_id =  intval($_POST['id']);
   if (($rebate = rebateHave($rebate_id)) === false)
    {
          sys_msg('该返佣记录不存在！');
    }

	$rebate = array(
		'remark'   => '',
		'rebate_all'   => 0.00,
		'rebate_money'   => 0.00,
		'status'	=> 1
   );

	/* 保存返佣信息 */
	$db->autoExecute($ecs->table('supplier_rebate'), $rebate, 'UPDATE', "rebate_id = '" . $rebate_id . "'");

	//修改佣金信息状态记录
		$rebate_list = array(
				'rebateid' => $rebate_id,
				'username' => '平台方:'.$_SESSION['user_name'],
				'type' => REBATE_LOG_LIST,
				'typedec' => '取消发起结算',
				'contents' => '佣金状态由等待审核变可结算',
				'addtime' => gmtime()
		);
		$db->autoExecute($ecs->table('supplier_rebate_log'), $rebate_list, 'INSERT');
	 /* 清除缓存 */
	clear_cache_files();

	/* 提示信息 */
	$links[] = array('href' => 'supplier_rebate.php?act=list' , 'text' => '返回本期佣金列表');
	sys_msg('恭喜，处理成功！', 0, $links);    

}


/**
 *  获取供应商列表信息
 *
 * @access  public
 * @param
 *
 * @return void
 */
function rebate_list($act='')
{
    $result = get_filter();
    if ($result === false)
    {
        /* 过滤信息 */
        $filter['rebate_paytime_start'] = !empty($_REQUEST['rebate_paytime_start']) ? trim($_REQUEST['rebate_paytime_start']) : 0;
        $filter['rebate_paytime_end'] = !empty($_REQUEST['rebate_paytime_start']) ? trim($_REQUEST['rebate_paytime_start']) : 0;
        $filter['unix_rebate_paytime_start'] = !empty($filter['rebate_paytime_start']) ? local_strtotime($_REQUEST['rebate_paytime_start']) : 0;
		$filter['unix_rebate_paytime_end'] = !empty($filter['rebate_paytime_end']) ? local_strtotime($_REQUEST['rebate_paytime_end']." 23:59:59") : 0;
        $filter['sort_by'] = empty($_REQUEST['sort_by']) ? ' sr.supplier_id' : trim($_REQUEST['sort_by']);
        $filter['sort_order'] = empty($_REQUEST['sort_order']) ? ' ASC' : trim($_REQUEST['sort_order']);
		$filter['is_pay_ok'] = empty($_REQUEST['is_pay_ok']) ? '0' : intval($_REQUEST['is_pay_ok']);
		$filter['actname'] = empty($act) ? trim($_REQUEST['act']) : $act;
       
	$where = (isset($_SESSION['supplier_id']) && intval($_SESSION['supplier_id'])>0) ? 'WHERE sr.supplier_id='.intval($_SESSION['supplier_id']) : 'WHERE 1';
        $where .= $filter['unix_rebate_paytime_start'] ? " AND sr.rebate_paytime_start >= '". $filter['unix_rebate_paytime_start']. "' " :  " ";
	$where .= $filter['unix_rebate_paytime_end'] ? " AND sr.rebate_paytime_end <= '". $filter['unix_rebate_paytime_end']. "' " :  " ";
	$where .= $filter['is_pay_ok'] ? " AND sr.is_pay_ok = '". $filter['is_pay_ok']. "' " :  " AND sr.is_pay_ok = '0' ";

        /* 分页大小 */
        $filter['page'] = empty($_REQUEST['page']) || (intval($_REQUEST['page']) <= 0) ? 1 : intval($_REQUEST['page']);

        if (isset($_REQUEST['page_size']) && intval($_REQUEST['page_size']) > 0)
        {
            $filter['page_size'] = intval($_REQUEST['page_size']);
        }
        elseif (isset($_COOKIE['ECSCP']['page_size']) && intval($_COOKIE['ECSCP']['page_size']) > 0)
        {
            $filter['page_size'] = intval($_COOKIE['ECSCP']['page_size']);
        }
        else
        {
            $filter['page_size'] = 15;
        }

        /* 记录总数 */
        $sql = "SELECT COUNT(*) FROM " . $GLOBALS['ecs']->table('supplier_rebate') ." AS sr  " . $where;
        $filter['record_count']   = $GLOBALS['db']->getOne($sql);
        $filter['page_count']     = $filter['record_count'] > 0 ? ceil($filter['record_count'] / $filter['page_size']) : 1;

        /* 查询 */
        $sql = "SELECT sr.* , s.supplier_name, s.supplier_rebate ".
                "FROM " . $GLOBALS['ecs']->table("supplier_rebate") . " AS  sr left join " .$GLOBALS['ecs']->table("supplier") .  " AS s on sr.supplier_id=s.supplier_id 
                $where
                ORDER BY " . $filter['sort_by'] . " " . $filter['sort_order']. "
                LIMIT " . ($filter['page'] - 1) * $filter['page_size'] . ", " . $filter['page_size'] . " ";

        set_filter($filter, $sql);
    }
    else
    {
        $sql    = $result['sql'];
        $filter = $result['filter'];
    }

	$list=array();
	$res = $GLOBALS['db']->query($sql);
    while ($row = $GLOBALS['db']->fetchRow($res))
	{
		$row['sign'] = createSign($row['rebate_id'],$row['supplier_id']);
		$row['rebate_paytime_start'] = local_date('Y.m.d', $row['rebate_paytime_start']);
		$endtime = $row['rebate_paytime_end'];//+$GLOBALS['_CFG']['tuihuan_days_qianshou']*3600*24;
		$row['rebate_paytime_end'] = local_date('Y.m.d', $endtime);
		//$row['all_money'] = $GLOBALS['db']->getOne("select sum(money_paid + surplus) from ". $GLOBALS['ecs']->table('order_info') ." where rebate_id=". $row['rebate_id'] ." and rebate_ispay=2");
		$row['all_money'] = $GLOBALS['db']->getOne("select sum(" . order_amount_field() . ") from ". $GLOBALS['ecs']->table('order_info') ." where rebate_id=". $row['rebate_id'] ." and rebate_ispay=2");
		$row['all_money_formated'] = price_format($row['all_money']);
		$row['rebate_money'] = round(($row['all_money'] * $row['supplier_rebate'])/100, 2);
		$row['rebate_money_formated'] =  price_format($row['rebate_money']);
		$row['pay_money'] = $row['all_money'] - $row['rebate_money'];
		$row['pay_money_formated'] = price_format($row['pay_money']);
		$row['pay_status'] = $row['is_pay_ok'] ? "已处理，已返佣" : "未处理";
		$row['pay_time'] = local_date('Y.m.d', $row['pay_time']);
		$row['user'] = $_SESSION['user_name'];
		$row['payable_price'] = price_format($row['payable_price']);
		$row['status_name'] = rebateStatus($row['status']);
		$row['caozuo'] = getRebateDo($row['status'],$row['rebate_id'],$filter['actname']);
		$list[]=$row;
	}
    $arr = array('result' => $list, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);

    return $arr;
}

?>