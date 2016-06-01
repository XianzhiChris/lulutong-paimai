<?php
//define('IN_ECS', true);

//require(dirname(__FILE__) . '/includes/init.php');

if (!defined('IN_CTRL'))
{
    die('Hacking attempt');
}
$page_name = isset($_POST['page_name']) ? trim($_POST['page_name']) : 'root';

if($page_name == 'index')
{
	//热门搜索关键词
	$search_keywords = $GLOBALS['_CFG']['search_keywords'];
	
	//轮播图
	
	//广告
	$banner = $db -> getAll("SELECT ad_name,ad_code,ad_link FROM  ".$ecs->table('ad')." WHERE position_id='112' and start_time<='".time()."' and end_time>='".time()."' LIMIT 0 , 5");
	$smarty->assign('banner',$banner);
	
	$ad1 = $db -> getAll("SELECT ad_name,ad_code,ad_link FROM  ".$ecs->table('ad')." WHERE position_id='113' and start_time<='".time()."' and end_time>='".time()."' order by ad_id asc LIMIT 0 , 3");
	foreach ($ad1 as $key => $val)
	{
		$smarty->assign('ad1_'.$key,$val);
	}
	
	
	$ad2 = $db -> getAll("SELECT ad_name,ad_code,ad_link FROM  ".$ecs->table('ad')." WHERE position_id='114' and start_time<='".time()."' and end_time>='".time()."' order by ad_id asc LIMIT 0 , 3");
	foreach ($ad2 as $key => $val)
	{
		$smarty->assign('ad2_'.$key,$val);
	}
	
	//九宫格菜单
	$menu = array
	(
		array(
			array('title'=>'店铺街','page'=>'shop_list'),
			array('title'=>'全部品牌','page'=>'brand_list'),
			array('title'=>'限时抢购','page'=>'promote_list'),
			array('title'=>'优惠活动','page'=>'activity')
			),
		array
		(
			array('title'=>'我的关注','page'=>'shop_list'),
			array('title'=>'我的资金','page'=>'shop_list'),
			array('title'=>'文章资讯','page'=>'article_cat'),
			array('title'=>'联系我们','page'=>'shop_list')
		)
	);
	
	$smarty->assign('menu',$menu);
	
	//促销列表
	$timeVal=time();
	$sql="SELECT goods_id,goods_name,shop_price,promote_price,market_price,goods_thumb,is_hot,is_new,is_best,is_promote,promote_end_date,promote_start_date,click_count FROM  ".$ecs->table('goods')."  WHERE is_promote='1' AND is_delete = '0' AND is_on_sale = '1' AND promote_end_date>='$timeVal'  order by sort_order,last_update desc LIMIT 0,9 ";
	$tmp = $db -> getAll($sql);
	$goods_per_row = 3;
	$promote = array();
	foreach ($tmp as $key => $val)
	{
		$val['formatted_shop_price'] = price_format($val['shop_price']);
		$val['formatted_promote_price'] = price_format($val['promote_price']);
		$val['formatted_market_price'] = price_format($val['market_price']);
		
		$promote[$key/$goods_per_row][] = $val;
	}
	$smarty->assign('promote',$promote);
	
	//新品列表
	$sql="SELECT goods_id,goods_name,shop_price,promote_price,market_price,goods_thumb,is_hot,is_new,is_best,is_promote,promote_end_date,promote_start_date,click_count FROM  ".$ecs->table('goods')."  WHERE is_new='1' AND is_delete = '0' AND is_on_sale = '1' order by sort_order,last_update desc LIMIT 0,9 ";
	$tmp = $db -> getAll($sql);
	$goods_per_row = 3;
	$new = array();
	foreach ($tmp as $key => $val)
	{
		$val['formatted_shop_price'] = price_format($val['shop_price']);
		$val['formatted_promote_price'] = price_format($val['promote_price']);
		$val['formatted_market_price'] = price_format($val['market_price']);
		
		$new[$key/$goods_per_row][] = $val;
	}
	$smarty->assign('new',$new);
	
	//精品列表
	$sql="SELECT goods_id,goods_name,shop_price,promote_price,market_price,goods_thumb,is_hot,is_new,is_best,is_promote,promote_end_date,promote_start_date,click_count FROM  ".$ecs->table('goods')."  WHERE is_best='1' AND is_delete = '0' AND is_on_sale = '1' order by sort_order,last_update desc LIMIT 0,9 ";
	$tmp = $db -> getAll($sql);
	$goods_per_row = 3;
	$best = array();
	foreach ($tmp as $key => $val)
	{
		$val['formatted_shop_price'] = price_format($val['shop_price']);
		$val['formatted_promote_price'] = price_format($val['promote_price']);
		$val['formatted_market_price'] = price_format($val['market_price']);
		
		$best[$key/$goods_per_row][] = $val;
	}
	$smarty->assign('best',$best);
	
	//热卖列表
	$sql="SELECT goods_id,goods_name,shop_price,promote_price,market_price,goods_thumb,is_hot,is_new,is_best,is_promote,promote_end_date,promote_start_date,click_count FROM  ".$ecs->table('goods')."  WHERE is_hot='1' AND is_delete = '0' AND is_on_sale = '1' order by sort_order,last_update desc LIMIT 0,9 ";
	$tmp = $db -> getAll($sql);
	$goods_per_row = 3;
	$hot = array();
	foreach ($tmp as $key => $val)
	{
		$val['formatted_shop_price'] = price_format($val['shop_price']);
		$val['formatted_promote_price'] = price_format($val['promote_price']);
		$val['formatted_market_price'] = price_format($val['market_price']);
		
		$hot[$key/$goods_per_row][] = $val;
	}
	$smarty->assign('hot',$hot);
	
	//分类商品
	$cat_id_arr = array('2','3','8');
	$cat_arr = array();
	foreach ($cat_id_arr as $cat_id)
	{
		$sql="SELECT cat_name FROM  ".$ecs->table('category')." WHERE  cat_id = '$cat_id'";
		$cat_arr[$cat_id]['cat_name'] = $db->getOne($sql);
		$in_cat_id = get_children($cat_id);
		
		$sql="SELECT goods_id,goods_name,shop_price,promote_price,goods_thumb FROM  ".$ecs->table('goods')." as g  WHERE $in_cat_id AND is_delete = '0' AND is_on_sale = '1' order by add_time desc LIMIT 0,6 ";
		$tmp = $db -> getAll($sql);
		$goods_per_row = 3;
		foreach ($tmp as $key => $val)
		{
			$val['formatted_shop_price'] = price_format($val['shop_price']);
			$val['formatted_promote_price'] = price_format($val['promote_price']);
			$val['formatted_market_price'] = price_format($val['market_price']);
			$cat_arr[$cat_id]['goods'][$key/$goods_per_row][] = $val;
		}
	}
	$smarty->assign('cat_arr',$cat_arr);
	$content = $smarty->fetch('index.dwt');
	make_json_result($content,'',array('search_keywords'=>$search_keywords));
}
else if($page_name == 'category')
{
	//商品分类
	$result=array();
	$result2=array();
	$res = $db -> getAll("SELECT cat_id,cat_name FROM  ".$ecs->table('category')." WHERE  parent_id='0'  and  is_show='1'  order by sort_order asc");
	foreach ($res as $key=>$val)
    {
		$parent_id=$val['cat_id'];
		$result2['cat_id']=$val['cat_id'];
		$result2['cat_name']=$val['cat_name'];
		$rows = $db -> getAll("SELECT cat_id,cat_name FROM  ".$ecs->table('category')." WHERE  parent_id='$parent_id' and is_show='1'   order by sort_order asc");
		for($i=0;$i<count($rows);$i++){
			$children_id=$rows[$i]['cat_id'];
			$rows2 = $db -> getAll("SELECT cat_id,cat_name FROM  ".$ecs->table('category')." WHERE  parent_id='$children_id' and is_show='1'   order by sort_order asc");
			$rows[$i]['children']=$rows2;
		}
		$result2['list']=$rows;
		$result[]=$result2;
	}
	$smarty->assign('category',$result);
	$smarty->assign('cat_count',count($result));
	make_json_result($smarty->fetch('category.dwt'));
}
else if($page_name == 'discovery')
{
	make_json_result($smarty->fetch('discovery.dwt'));
}
else if($page_name == 'cart')
{
	make_json_result($smarty->fetch('cart.dwt'));
}
else if($page_name == 'user')
{
	make_json_result($smarty->fetch('user.dwt'));
}
/*
*
*
*/
function get_categories($cat_id = 0)
{
    if ($cat_id > 0)
    {
        $parent_id = $cat_id;
    }
    else
    {
        $parent_id = 0;
    }

    /*
     判断当前分类中全是是否是底级分类，
     如果是取出底级分类上级分类，
     如果不是取当前分类及其下的子分类
     */
    $sql = 'SELECT count(*) FROM ' . $GLOBALS['ecs']->table('category') . " WHERE parent_id = '$cat_id' AND is_show = 1 ";
    if ($GLOBALS['db']->getOne($sql) || $parent_id == 0)
    {
        /* 获取当前分类及其子分类 */
        $sql = 'SELECT a.cat_id, a.cat_name, a.sort_order AS parent_order,a.is_show,' .
            'b.cat_id AS child_id, b.cat_name AS child_name, b.sort_order AS child_order ' .
            'FROM ' . $GLOBALS['ecs']->table('category') . ' AS a ' .
            'LEFT JOIN ' . $GLOBALS['ecs']->table('category') . ' AS b ON b.parent_id = a.cat_id AND b.is_show = 1 ' .
            "WHERE a.parent_id = '$parent_id' ORDER BY parent_order ASC, a.cat_id ASC, child_order ASC";
    }
    else
    {
        /* 获取当前分类及其父分类 */
        $sql = 'SELECT a.cat_id, a.cat_name, b.cat_id AS child_id, b.cat_name AS child_name, b.sort_order, b.is_show ' .
            'FROM ' . $GLOBALS['ecs']->table('category') . ' AS a ' .
            'LEFT JOIN ' . $GLOBALS['ecs']->table('category') . ' AS b ON b.parent_id = a.cat_id AND b.is_show = 1 ' .
            "WHERE b.parent_id = '$parent_id' ORDER BY sort_order ASC";
    }
    $res = $GLOBALS['db']->getAll($sql);

    $cat_arr = array();
    foreach ($res AS $row)
    {
        if ($row['is_show'])
        {
            $cat_arr[$row['cat_id']]['id']   = $row['cat_id'];
            $cat_arr[$row['cat_id']]['name'] = $row['cat_name'];
            //$cat_arr[$row['cat_id']]['url']  = build_uri('category', array('cid' => $row['cat_id']), $row['cat_name']);

            if ($row['child_id'] != NULL)
            {
                $cat_arr[$row['cat_id']]['children'][$row['child_id']]['id']   = $row['child_id'];
                $cat_arr[$row['cat_id']]['children'][$row['child_id']]['name'] = $row['child_name'];
                //$cat_arr[$row['cat_id']]['children'][$row['child_id']]['url']  = build_uri('category', array('cid' => $row['child_id']), $row['child_name']);
            }
        }
    }

    return $cat_arr;
}