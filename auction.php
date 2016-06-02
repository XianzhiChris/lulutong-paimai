<?php

/**
 * ECSHOP 拍卖前台文件
 * ============================================================================
 * 版权所有 2005-2011 上海商派网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: liubo $
 * $Id: auction.php 17217 2011-01-19 06:29:08Z liubo $
 */

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');

/*------------------------------------------------------ */
//-- act 操作项的初始化
/*------------------------------------------------------ */
if (empty($_REQUEST['act']))
{
    $_REQUEST['act'] = 'list';
}

/*------------------------------------------------------ */
//-- 拍卖活动列表
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'list')
{
    /* 取得拍卖活动总数 */
    $count = auction_count();
    if ($count > 0)
    {
        /* 取得每页记录数 */
        $size = isset($_CFG['page_size']) && intval($_CFG['page_size']) > 0 ? intval($_CFG['page_size']) : 10;

        /* 计算总页数 */
        $page_count = ceil($count / $size);

        /* 取得当前页 */
        $page = isset($_REQUEST['page']) && intval($_REQUEST['page']) > 0 ? intval($_REQUEST['page']) : 1;
        $page = $page > $page_count ? $page_count : $page;

        /* 缓存id：语言 - 每页记录数 - 当前页 */
        $cache_id = $_CFG['lang'] . '-' . $size . '-' . $page;
        $cache_id = sprintf('%X', crc32($cache_id));
    }
    else
    {
        /* 缓存id：语言 */
        $cache_id = $_CFG['lang'];
        $cache_id = sprintf('%X', crc32($cache_id));
    }

    /* 如果没有缓存，生成缓存 */
    if (!$smarty->is_cached('auction_list.dwt', $cache_id))
    {
        if ($count > 0)
        {
            /* 取得当前页的拍卖活动 */
            $auction_list = auction_list($size, $page);
            $auction_list_hot = auction_list($size, $page, "act_count");
            $smarty->assign('auction_list',      $auction_list);
            $smarty->assign('auction_list_hot',  $auction_list_hot);

            /* 设置分页链接 */
            $pager = get_pager('auction.php', array('act' => 'list'), $count, $page, $size);
            $smarty->assign('pager', $pager);
        }

        /* 模板赋值 */
        $smarty->assign('cfg', $_CFG);
        assign_template();
        $position = assign_ur_here();
        $smarty->assign('page_title', $position['title']);    // 页面标题
        $smarty->assign('ur_here',    $position['ur_here']);  // 当前位置
        $smarty->assign('categories', get_categories_tree()); // 分类树
        $smarty->assign('helps',      get_shop_help());       // 网店帮助
        $smarty->assign('top_goods',  get_top10());           // 销售排行
        $smarty->assign('promotion_info', get_promotion_info());
        $smarty->assign('feed_url',         ($_CFG['rewrite'] == 1) ? "feed-typeauction.xml" : 'feed.php?type=auction'); // RSS URL

        assign_dynamic('auction_list');
    }

    /* 显示模板 */
    $smarty->display('auction_list.dwt', $cache_id);
}
/*------------------------------------------------------ */
//-- 拍卖预展`历史列表  李云鹏20160513
/*------------------------------------------------------ */
if ($_GET['act'] == 'lishi')
{
        /* 缓存id：语言 */
        $cache_id = $_CFG['lang'];
        $cache_id = sprintf('%X', crc32($cache_id));

    /* 如果没有缓存，生成缓存 */
    if (!$smarty->is_cached('auction_lishi_list.dwt', $cache_id))
    {
        /* 模板赋值 */
        $smarty->assign('cfg', $_CFG);
        assign_template();
        $auction_list = lishi_list();
        $position = assign_ur_here();
        $smarty->assign('page_title', $position['title']);    // 页面标题
        $smarty->assign('ur_here',    $position['ur_here']);  // 当前位置
        $smarty->assign('auction_list',      $auction_list);

        assign_dynamic('auction_lishi_list');
    }

    /* 显示模板 */
    $smarty->display('auction_lishi_list.dwt', $cache_id);
}
/*------------------------------------------------------ */
//-- 拍卖未开始和已结束  李云鹏20160602
/*------------------------------------------------------ */
if ($_GET['act'] == 'new' || $_GET['act'] == 'old')
{
    $count = new_auction_count($_GET['act']);

    if ($count > 0)
    {
        /* 取得每页记录数 */
        $size = isset($_CFG['page_size']) && intval($_CFG['page_size']) > 0 ? intval($_CFG['page_size']) : 10;

        /* 计算总页数 */
        $page_count = ceil($count / $size);

        /* 取得当前页 */
        $page = isset($_REQUEST['page']) && intval($_REQUEST['page']) > 0 ? intval($_REQUEST['page']) : 1;
        $page = $page > $page_count ? $page_count : $page;

        /* 缓存id：语言 - 每页记录数 - 当前页 */
        $cache_id = $_CFG['lang'] . '-' . $size . '-' . $page;
        $cache_id = sprintf('%X', crc32($cache_id));
    }
    else
    {
        /* 缓存id：语言 */
        $cache_id = $_CFG['lang'];
        $cache_id = sprintf('%X', crc32($cache_id));
    }
    /* 缓存id：语言 */
    $cache_id = $_CFG['lang'];
    $cache_id = sprintf('%X', crc32($cache_id));

    /* 如果没有缓存，生成缓存 */
    if (!$smarty->is_cached('auction_new.dwt', $cache_id))
    {
        /* 模板赋值 */
        $smarty->assign('cfg', $_CFG);
        assign_template();
        $pager = get_pager('auction.php', array('act' => $_GET['act']), $count, $page, $size);
        $smarty->assign('pager', $pager);
        $auction_list = new_list($size, $page,$_GET['act']);
        $position = assign_ur_here();
        $smarty->assign('page_title', $position['title']);    // 页面标题
        $smarty->assign('ur_here',    $position['ur_here']);  // 当前位置
        $smarty->assign('auction_list',      $auction_list);

        assign_dynamic('auction_new');
    }

    /* 显示模板 */
    $smarty->display('auction_new.dwt', $cache_id);
}
/*------------------------------------------------------ */
//-- 拍卖限时拍列表  李云鹏20160516
/*------------------------------------------------------ */
if ($_GET['act'] == 'xianshi')
{
    $type=$_GET['type'];
    //如果为空获取当前小时  李云鹏20160518
    if(empty($type)){
        $type=date('H');
    }
    //根据小时判断属于那个场次  李云鹏20160518
    if($type<11 || $type>22){
        $time=10;
    }else if($type<13){
        $time=12;
    }else if($type<15){
        $time=14;
    }else if($type<17){
        $time=16;
    }else if($type<19){
        $time=18;
    }else if($type<21){
        $time=20;
    }else if($type<23){
        $time=22;
    }
    //计算开始时间和结束时间 李云鹏20160518
    $now = gmtime();  //当前时间
    $todate=date('Y-m-d'); //当前日期
    $nextdate=date("Y-m-d",strtotime("+1 day")); //明天
    $endtime=$todate." ".($time+1).":00";
    $endtime=local_strtotime($endtime);
    if($now<$endtime){
        $starttime=$todate." ".$time.":00";
        $starttime=local_strtotime($starttime);

    }else{
        $starttime=$nextdate." ".$time.":00";
        $starttime=local_strtotime($starttime);
        $endtime=$nextdate." ".($time+1).":00";
        $endtime=local_strtotime($endtime);
    }
    /* 缓存id：语言 */
    $cache_id = $_CFG['lang'];
    $cache_id = sprintf('%X', crc32($cache_id));

    /* 如果没有缓存，生成缓存 */
    if (!$smarty->is_cached('auction_lishi_list.dwt', $cache_id))
    {
        /* 模板赋值 */
        $smarty->assign('cfg', $_CFG);
        $smarty->assign('type', $type);
        $smarty->assign('time', $time);
        $smarty->assign('starttime', $starttime);
        $smarty->assign('endtime', $endtime);
        assign_template();
        $auction_list = xianshipai_list($time);  //获取该场次拍品  李云鹏20160518
        $position = assign_ur_here();
        $smarty->assign('page_title', $position['title']);    // 页面标题
        $smarty->assign('ur_here',    $position['ur_here']);  // 当前位置
        $smarty->assign('auction_list',      $auction_list);

        assign_dynamic('auction_xianshi_list');
    }

    /* 显示模板 */
    $smarty->display('auction_xianshi_list.dwt', $cache_id);
}
/*------------------------------------------------------ */
//-- 拍卖商品 --> 商品详情
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'view')
{
    /* 取得参数：拍卖活动id */
    $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
    if ($id <= 0)
    {
        ecs_header("Location: ./\n");
        exit;
    }

    /* 取得拍卖活动信息 */
    $auction = auction_info($id);
    if (empty($auction))
    {
        ecs_header("Location: ./\n");
        exit;
    }

    /* 缓存id：语言，拍卖活动id，状态，如果是进行中，还要最后出价的时间（如果有的话） */
    $cache_id = $_CFG['lang'] . '-' . $id . '-' . $auction['status_no'];
    if ($auction['status_no'] == UNDER_WAY)
    {
        if (isset($auction['last_bid']))
        {
            $cache_id = $cache_id . '-' . $auction['last_bid']['bid_time'];
        }
    }
    elseif ($auction['status_no'] == FINISHED &&isset($auction['last_bid'])&& $auction['last_bid']['bid_user'] == $_SESSION['user_id']
        && $auction['order_count'] == 0)
    {
        //如果距离结束超过24小时,那么关闭交易
        if((local_strtotime($auction['end_time'])+60*60*24)<time()){
            $auction['closed']=1;
        }

        $auction['is_winner'] = 1;
        $cache_id = $cache_id . '-' . $auction['last_bid']['bid_time'] . '-1';
    }elseif ($auction['status_no'] == SETTLED &&isset($auction['last_bid'])&& $auction['last_bid']['bid_user'] == $_SESSION['user_id']
        && $auction['order_count'] > 0)
    {
        $auction['is_winner'] = 1;
        $auction['is_finished']=1;
    }
    //如果有出价信息,获取最后出价用户名  李云鹏20160510
    if (isset($auction['last_bid'])){
        $user_name = $GLOBALS['db']->getOne("select user_name from ". $ecs->table('users') ." where user_id=".$auction['last_bid']['bid_user']);
        $auction['user_name']="****".substr($user_name,-4);  //截取用户名后四位 李云鹏20160428
    }


    $cache_id = sprintf('%X', crc32($cache_id));

    /* 如果没有缓存，生成缓存 */
    if (!$smarty->is_cached('auction.dwt', $cache_id))
    {
        //取货品信息
        if ($auction['product_id'] > 0)
        {
            $goods_specifications = get_specifications_list($auction['goods_id']);

            $good_products = get_good_products($auction['goods_id'], 'AND product_id = ' . $auction['product_id']);

            $_good_products = explode('|', $good_products[0]['goods_attr']);
            $products_info = '';
            foreach ($_good_products as $value)
            {
                $products_info .= ' ' . $goods_specifications[$value]['attr_name'] . '：' . $goods_specifications[$value]['attr_value'];
            }
            $smarty->assign('products_info',     $products_info);
            unset($goods_specifications, $good_products, $_good_products,  $products_info);
        }

        $auction['gmt_end_time'] = local_strtotime($auction['end_time']);
        $auction['gmt_start_time'] = local_strtotime($auction['start_time']);
        $smarty->assign('auction', $auction);

        /* 取得拍卖商品信息 */
        $goods_id = $auction['goods_id'];
        $goods = goods_info($goods_id);
        if (empty($goods))
        {
            ecs_header("Location: ./\n");
            exit;
        }
        $goods['url'] = build_uri('goods', array('gid' => $goods_id), $goods['goods_name']);
        $smarty->assign('auction_goods', $goods);

        /* 出价记录 */
        $smarty->assign('auction_log', auction_log($id));
        /*获取送拍人信息  李云鹏20160428*/
        //$smarty->assign('supplier_info', supplier_info($auction['supplier_id']));
        //送拍机构:品牌 李云鹏20160509
        $smarty->assign('brand_info', brand_info($auction['brand_id']));
        //var_dump(supplier_info($auction['supplier_id']));
        

        //模板赋值
		$smarty->assign('auction_log_count', auction_log_count($id));
        $smarty->assign('cfg', $_CFG);
        assign_template();

        $position = assign_ur_here(0, $goods['goods_name']);
        $smarty->assign('page_title', $position['title']);    // 页面标题
        $smarty->assign('ur_here',    $position['ur_here']);  // 当前位置
        $smarty->assign('pictures',            get_goods_gallery_attr_www_ecshop68_com($goods['goods_id'])); // 商品相册_李云鹏20160428
        //var_dump(get_goods_gallery_attr_www_ecshop68_com($goods['goods_id']));
        $smarty->assign('categories', get_categories_tree()); // 分类树
        $smarty->assign('helps',      get_shop_help());       // 网店帮助
        $smarty->assign('top_goods',  get_top10());           // 销售排行
        $smarty->assign('promotion_info', get_promotion_info());

        assign_dynamic('auction');
    }

    $sql = 'UPDATE ' . $ecs->table('goods') . ' SET click_count = click_count + 1 '.
        "WHERE goods_id = '" . $auction['goods_id'] . "'";
    $db->query($sql);

    $smarty->assign('now_time',  gmtime());           // 当前系统时间
    $smarty->display('auction.dwt', $cache_id);
}

/*------------------------------------------------------ */
//-- 拍卖商品 --> 出价
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'bid')
{
    include_once(ROOT_PATH . 'includes/lib_order.php');

    /* 取得参数：拍卖活动id */
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    if ($id <= 0)
    {
        ecs_header("Location: ./\n");
        exit;
    }

    /* 取得拍卖活动信息 */
    $auction = auction_info($id);
    if (empty($auction))
    {
        ecs_header("Location: ./\n");
        exit;
    }

    /* 活动是否正在进行 */
    if ($auction['status_no'] != UNDER_WAY)
    {
        show_message($_LANG['au_not_under_way'], '', '', 'error');
    }

    /* 是否登录 */
    $user_id = $_SESSION['user_id'];
    if ($user_id <= 0)
    {
        show_message($_LANG['au_bid_after_login']);
    }
    $user = user_info($user_id);

    /* 取得出价 */
    $bid_price = isset($_POST['price']) ? round(floatval($_POST['price']), 2) : 0;
    if ($bid_price <= 0)
    {
        show_message($_LANG['au_bid_price_error'], '', '', 'error');
    }

    /* 如果有一口价且出价大于等于一口价，则按一口价算 */
    $is_ok = false; // 出价是否ok
    if ($auction['end_price'] > 0)
    {
        if ($bid_price >= $auction['end_price'])
        {
            $bid_price = $auction['end_price'];
            $is_ok = true;
        }
    }

    /* 出价是否有效：区分第一次和非第一次 */
    if (!$is_ok)
    {
        if ($auction['bid_user_count'] == 0)
        {
            /* 第一次要大于等于起拍价 */
            $min_price = $auction['start_price'];
        }
        else
        {
            /* 非第一次出价要大于等于最高价加上加价幅度，但不能超过一口价 */
            $min_price = $auction['last_bid']['bid_price'] + $auction['amplitude'];
            if ($auction['end_price'] > 0)
            {
                $min_price = min($min_price, $auction['end_price']);
            }
        }

        if ($bid_price < $min_price)
        {
            show_message(sprintf($_LANG['au_your_lowest_price'], price_format($min_price, false)), '', '', 'error');
        }
    }

    /* 检查联系两次拍卖人是否相同 */
    if ($auction['last_bid']['bid_user'] == $user_id && $bid_price != $auction['end_price'])
    {
        show_message($_LANG['au_bid_repeat_user'], '', '', 'error');
    }

    /* 是否需要保证金 */
    if ($auction['deposit'] > 0)
    {
        /* 可用资金够吗 */
        if ($user['user_money'] < $auction['deposit'])
        {
            show_message($_LANG['au_user_money_short'], '', '', 'error');
        }

        /* 如果不是第一个出价，解冻上一个用户的保证金 */
        if ($auction['bid_user_count'] > 0)
        {
            log_account_change($auction['last_bid']['bid_user'], $auction['deposit'], (-1) * $auction['deposit'],
                0, 0, sprintf($_LANG['au_unfreeze_deposit'], $auction['act_name']));
        }

        /* 冻结当前用户的保证金 */
        log_account_change($user_id, (-1) * $auction['deposit'], $auction['deposit'],
            0, 0, sprintf($_LANG['au_freeze_deposit'], $auction['act_name']));
    }

    /* 插入出价记录 */
    $auction_log = array(
        'act_id'    => $id,
        'bid_user'  => $user_id,
        'bid_price' => $bid_price,
        'bid_time'  => gmtime()
    );
    $db->autoExecute($ecs->table('auction_log'), $auction_log, 'INSERT');
	$act_count = $_POST['act_count'] + 1;
	$db->query("UPDATE " . $ecs->table('goods_activity') . " SET act_count = " . $act_count . " WHERE act_id = " . $id);

    /* 出价是否等于一口价 */
    if ($bid_price == $auction['end_price'])
    {
        /* 结束拍卖活动 */
        $sql = "UPDATE " . $ecs->table('goods_activity') . " SET is_finished = 1 WHERE act_id = '$id' LIMIT 1";
        $db->query($sql);
    }

    /* 跳转到活动详情页 */
    ecs_header("Location: auction.php?act=view&id=$id\n");
    exit;
}

/*------------------------------------------------------ */
//-- 拍卖商品 --> 购买
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'buy')
{
    /* 查询：取得参数：拍卖活动id */
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    if ($id <= 0)
    {
        ecs_header("Location: ./\n");
        exit;
    }

    /* 查询：取得拍卖活动信息 */
    $auction = auction_info($id);
    if (empty($auction))
    {
        ecs_header("Location: ./\n");
        exit;
    }

    /* 查询：活动是否已结束 */
    if ($auction['status_no'] != FINISHED)
    {
        show_message($_LANG['au_not_finished'], '', '', 'error');
    }

    /* 查询：有人出价吗 */
    if ($auction['bid_user_count'] <= 0)
    {
        show_message($_LANG['au_no_bid'], '', '', 'error');
    }

    /* 查询：是否已经有订单 */
    if ($auction['order_count'] > 0)
    {
        show_message($_LANG['au_order_placed']);
    }

    /* 查询：是否登录 */
    $user_id = $_SESSION['user_id'];
    if ($user_id <= 0)
    {
        show_message($_LANG['au_buy_after_login']);
    }

    /* 查询：最后出价的是该用户吗 */
    if ($auction['last_bid']['bid_user'] != $user_id)
    {
        show_message($_LANG['au_final_bid_not_you'], '', '', 'error');
    }

    /* 查询：取得商品信息 */
    $goods = goods_info($auction['goods_id']);

    /* 查询：处理规格属性 */
    $goods_attr = '';
    $goods_attr_id = '';
    if ($auction['product_id'] > 0)
    {
        $product_info = get_good_products($auction['goods_id'], 'AND product_id = ' . $auction['product_id']);

        $goods_attr_id = str_replace('|', ',', $product_info[0]['goods_attr']);

        $attr_list = array();
        $sql = "SELECT a.attr_name, g.attr_value " .
                "FROM " . $ecs->table('goods_attr') . " AS g, " .
                    $ecs->table('attribute') . " AS a " .
                "WHERE g.attr_id = a.attr_id " .
                "AND g.goods_attr_id " . db_create_in($goods_attr_id);
        $res = $db->query($sql);
        while ($row = $db->fetchRow($res))
        {
            $attr_list[] = $row['attr_name'] . ': ' . $row['attr_value'];
        }
        $goods_attr = join(chr(13) . chr(10), $attr_list);
    }
    else
    {
        $auction['product_id'] = 0;
    }

    /* 清空购物车中所有拍卖商品 */
    include_once(ROOT_PATH . 'includes/lib_order.php');
    clear_cart(CART_AUCTION_GOODS);

    /* 加入购物车 */
     $cart = array(
        'user_id'        => $user_id,
        'session_id'     => SESS_ID,
        'goods_id'       => $auction['goods_id'],
        'goods_sn'       => addslashes($goods['goods_sn']),
        'goods_name'     => addslashes($goods['goods_name']),
        'market_price'   => $goods['market_price'],
    	'cost_price'     => $goods['cost_price'],
    	'promote_price'  => $goods['promote_price'],
        'goods_price'    => $auction['last_bid']['bid_price'],
        'goods_number'   => 1,
        'goods_attr'     => $goods_attr,
        'goods_attr_id'  => $goods_attr_id,
        'is_real'        => $goods['is_real'],
        'extension_code' => addslashes($goods['extension_code']),
        'parent_id'      => 0,
        'rec_type'       => CART_AUCTION_GOODS,
        'is_gift'        => 0
    );
    $db->autoExecute($ecs->table('cart'), $cart, 'INSERT');
    
    $_SESSION['sel_cartgoods'] = $db->insert_id();
    /* 记录购物流程类型：团购 */
    $_SESSION['flow_type'] = CART_AUCTION_GOODS;
    $_SESSION['extension_code'] = 'auction';
    $_SESSION['extension_id'] = $id;

    /* 进入收货人页面 */
    ecs_header("Location: ./flow.php?step=checkout\n");
    exit;
}
/* 代码增加_start By www.ecshop68.com */
/**
 * 获得指定商品的相册
 *
 * @access  public
 * @param   integer     $goods_id
 * @return  array
 */
function get_goods_gallery_attr_www_ecshop68_com($goods_id, $goods_attr_id)
{

    $sql = 'SELECT img_id, img_original, img_url, thumb_url, img_desc' .
        ' FROM ' . $GLOBALS['ecs']->table('goods_gallery') .
        " WHERE goods_id = '$goods_id' and goods_attr_id='$goods_attr_id' order by img_sort,img_id LIMIT " . $GLOBALS['_CFG']['goods_gallery_number'];
    $row = $GLOBALS['db']->getAll($sql);
    if (count($row)==0)
    {
        $sql = 'SELECT img_id, img_original, img_url, thumb_url, img_desc' .
            ' FROM ' . $GLOBALS['ecs']->table('goods_gallery') .
            " WHERE goods_id = '$goods_id' and goods_attr_id='0' LIMIT " . $GLOBALS['_CFG']['goods_gallery_number'];
        $row = $GLOBALS['db']->getAll($sql);
    }
    /* 格式化相册图片路径 */
    foreach($row as $key => $gallery_img)
    {
        $row[$key]['img_url'] = get_image_path($goods_id, $gallery_img['img_url'], false, 'gallery');
        $row[$key]['thumb_url'] = get_image_path($goods_id, $gallery_img['thumb_url'], true, 'gallery');
        $row[$key]['img_original'] = get_image_path($goods_id, $gallery_img['img_original'], true, 'gallery');
    }
    return $row;
    $ret = array();
    foreach($row as $v){
        $ret[$v['img_id']] = $v;
    }
    ksort($ret);
    return array_values($ret);
}
/**
 * 取得未开始和已结束拍卖活动数量  李云鹏20160602
 * @return  int
 */
function new_auction_count($act)
{
    $now = gmtime();
    if($act=="new"){
        $where.=" and start_time > '$now'";
    }elseif($act=="old"){
        $where.=" and end_time < '$now'";
    }
    $sql = "SELECT COUNT(*) " .
        "FROM " . $GLOBALS['ecs']->table('goods_activity') .
        "WHERE act_type = '" . GAT_AUCTION . "' " .
        " AND is_finished < 2".$where;
    return $GLOBALS['db']->getOne($sql);
}
/* 代码增加_end By www.ecshop68.com */
/**
 * 取得拍卖活动数量
 * @return  int
 */
function auction_count()
{
    $now = gmtime();
    $sql = "SELECT COUNT(*) " .
            "FROM " . $GLOBALS['ecs']->table('goods_activity') .
            "WHERE act_type = '" . GAT_AUCTION . "' " .
            "AND start_time <= '$now' AND end_time >= '$now' AND is_finished < 2";
    return $GLOBALS['db']->getOne($sql);
}

/**
 * 取得某页的拍卖活动
 * @param   int     $size   每页记录数
 * @param   int     $page   当前页
 * @return  array
 */
function auction_list($size, $page)
{
    $auction_list = array();
    $auction_list['finished'] = $auction_list['finished'] = array();

    $now = gmtime();
    $sql = "SELECT a.*,g.original_img, IFNULL(g.goods_thumb, '') AS goods_thumb " .
            "FROM " . $GLOBALS['ecs']->table('goods_activity') . " AS a " .
                "LEFT JOIN " . $GLOBALS['ecs']->table('goods') . " AS g ON a.goods_id = g.goods_id " .
            "WHERE a.act_type = '" . GAT_AUCTION . "' " .
            "AND a.start_time <= '$now' AND a.end_time >= '$now' AND a.is_finished < 2 ORDER BY a.act_id DESC";
    $res = $GLOBALS['db']->selectLimit($sql, $size, ($page - 1) * $size);
    while ($row = $GLOBALS['db']->fetchRow($res))
    {
        $ext_info = unserialize($row['ext_info']);
        $auction = array_merge($row, $ext_info);
        $auction['status_no'] = auction_status($auction);

        $auction['start_time'] = local_date($GLOBALS['_CFG']['time_format'], $auction['start_time']);
        $auction['end_time']   = local_date($GLOBALS['_CFG']['time_format'], $auction['end_time']);
        $auction['formated_start_price'] = price_format($auction['start_price']);
        $auction['formated_end_price'] = price_format($auction['end_price']);
        $auction['formated_deposit'] = price_format($auction['deposit']);
		
		$sql = "SELECT COUNT(*) FROM " . $GLOBALS['ecs']->table('auction_log') .
				" WHERE act_id = " . $auction['act_id'];
		$auction['bid_user_count'] = $GLOBALS['db']->getOne($sql);
		if ($auction['bid_user_count'] > 0)
		{
			$auction['formated_bid_price'] = $GLOBALS['db']->getOne("select bid_price from " . $GLOBALS['ecs']->table('auction_log') . " where act_id = '" . $auction['act_id'] . "' order by bid_price desc limit 0,1");
		}
		$auction['current_price'] = isset($auction['formated_bid_price']) ? $auction['formated_bid_price'] : $auction['start_price'];
		$auction['formated_current_price'] = price_format($auction['current_price'], false);
		
        $auction['goods_thumb'] = get_image_path($row['goods_id'], $row['goods_thumb'], true);
		$auction['original_img']= get_image_path($row['goods_id'], $row['original_img']);
        $auction['url'] = build_uri('auction', array('auid'=>$auction['act_id']));

        if($auction['status_no'] < 2)
        {
            $auction_list['under_way'][] = $auction;
        }
        else
        {
            $auction_list['finished'][] = $auction;
        }
    }

    $auction_list = @array_merge($auction_list['under_way'], $auction_list['finished']);

    return $auction_list;
}

/**
 * 取得所有拍卖活动 按照开拍时间分组 李云鹏20160514
 * @param   int
 * @return  array
 */
function lishi_list()
{
    $auction_list = array();
    $auction_list['finished'] = $auction_list['finished'] = array();

    $now = gmtime();
    $sql="select distinct date from " . $GLOBALS['ecs']->table('goods_activity') ." order by date desc";
    $res = $GLOBALS['db']->getAll($sql);
    foreach ($res AS $idx => $row){
        $sql = "SELECT a.act_id,a.act_name,g.goods_thumb,g.click_count,g.goods_id " .
            "FROM " . $GLOBALS['ecs']->table('goods_activity') . " AS a " .
            ", " . $GLOBALS['ecs']->table('goods') . " AS g " .
            "WHERE a.goods_id = g.goods_id and a.act_type = '" . GAT_AUCTION . "' and date='".$row['date']."' " .
            " ORDER BY a.act_id DESC";
        $res = $GLOBALS['db']->query($sql);
        $i=0;
        $auction=array();
        while ($rq=$GLOBALS['db']->fetchRow($res)){
            $rq['url']          = build_uri('auction', array('auid' => $rq['act_id']));
            $auction[$i]=$rq;
            $i++;
        }
        $arr[$idx]['auction']=$auction;
        $arr[$idx]['date']=$row['date'];
    }
    return $arr;
}
/**
 * 取得限时拍拍品 李云鹏20160518
 * @param   int 场次
 * @return  array
 */
function xianshipai_list($time)
{
    $now = gmtime();  //当前时间
    $todate=date('Y-m-d'); //当前日期
    $nextdate=date("Y-m-d",strtotime("+1 day")); //明天
    $endtime=$todate." ".($time+1).":00";
    $endtime=local_strtotime($endtime);
    if($now>$endtime){
        $date=$nextdate;
    }else{
        $date=$todate;
    }

    $sql = "SELECT a.act_id,a.act_name,g.goods_thumb,g.click_count,g.goods_id " .
        "FROM " . $GLOBALS['ecs']->table('goods_activity') . " AS a " .
        ", " . $GLOBALS['ecs']->table('goods') . " AS g " .
        "WHERE a.goods_id = g.goods_id and a.act_type = '" . GAT_AUCTION . "' and date='".$date."' and is_xianshipai=1 and xianshipai_type=".$time." " .
        " ORDER BY a.act_id DESC";
    $res = $GLOBALS['db']->query($sql);
    $i=0;
    $auction=array();
    while ($rq=$GLOBALS['db']->fetchRow($res)){
        $rq['url']          = build_uri('auction', array('auid' => $rq['act_id']));
        $auction[$i]=$rq;
        $i++;
    }
    //var_dump($sql);
    return $auction;
}
/**
 * 未开始和已结束拍品 李云鹏20160602
 * @param str  new|old
 */
function new_list($size, $page, $act)
{
    $now = gmtime();
    $auction_list = array();
    $where="";
    if($act=="new"){
        $where.=" and a.start_time > '$now' ORDER BY a.start_time ASC,a.act_id DESC";
    }elseif($act=="old"){
        $where.=" and a.end_time < '$now' ORDER BY a.act_id DESC";
    }
    $sql = "SELECT a.*,g.original_img, g.goods_thumb,goods_thumb2 " .
        "FROM " . $GLOBALS['ecs']->table('goods_activity') . " AS a " .
        "LEFT JOIN " . $GLOBALS['ecs']->table('goods') . " AS g ON a.goods_id = g.goods_id " .
        "WHERE a.act_type = '" . GAT_AUCTION . "' " .
        " AND a.is_finished < 2".$where;

    $res = $GLOBALS['db']->selectLimit($sql, $size, ($page - 1) * $size);
    while ($row = $GLOBALS['db']->fetchRow($res)){
        $auction_list[$row['goods_id']]['act_name']   = $row['act_name'];
        $auction_list[$row['goods_id']]['goods_thumb']   = get_image_path($row['goods_id'], $row['goods_thumb'], true);
        $auction_list[$row['goods_id']]['goods_thumb2']   = get_image_path($row['goods_id'], $row['goods_thumb2'], true);
        $auction_list[$row['goods_id']]['goods_img']     = get_image_path($row['goods_id'], $row['goods_img']);
        $auction_list[$row['goods_id']]['url']           = build_uri('auction', array('auid' => $row['act_id']), $row['act_name']);
        $auction_list[$row['goods_id']]['click_count']  = $row['click_count'];

    //出价次数
        $auction_list[$row['goods_id']]['chujia_count']=$GLOBALS['db']->getOne("select count(*) from ". $GLOBALS['ecs']->table('auction_log') ." where act_id='".$row['act_id']."'");
    //最后出价价格
    $chujia=$GLOBALS['db']->getOne("select bid_price from ". $GLOBALS['ecs']->table('auction_log') ." where act_id='".$row['act_id']."' order by log_id desc");

    //如果当前商品无人出价，则显示设定起拍价
        $auction_list[$row['goods_id']]['chujia']=$chujia?price_format($chujia):price_format($ext_info['start_price']);
    //送拍人：商家
        $auction_list[$row['goods_id']]['songpairen']=$GLOBALS['db']->getOne("select supplier_name from ". $GLOBALS['ecs']->table('supplier') ." where supplier_id='".$row['supplier_id']."'");
    //结束时间：倒计时
        $auction_list[$row['goods_id']]['end_time']=$row['end_time'];
    //开始时间：
        $auction_list[$row['goods_id']]['start_time']=$row['start_time'];

    }
    //var_dump($auction_list);exit;
    return $auction_list;
}
?>