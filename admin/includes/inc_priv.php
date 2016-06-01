<?php

/**
 * ECSHOP 权限对照表
 * ============================================================================
 * * 版权所有 2005-2012 上海商派网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: sunxiaodong $
 * $Id: inc_priv.php 15503 2008-12-24 09:22:45Z sunxiaodong $
*/

if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}

//商品管理权限
	$purview['01_goods_list']        = array('goods_manage', 'remove_back');
	/* 代码增加_start  By  supplier.68ecshop.com */
    //$purview['02_supplier_goods_list']        = array('goods_manage', 'remove_back');
    $purview['02_supplier_goods_list']        = 'goods_batch';  //修改入驻商家商品列表权限为批量上传  李云鹏20160512
    $purview['pricecut']           =   'goods_batch';
    $purview['03_goods_add']         = 'goods_manage';
    $purview['04_category_list']     = array('cat_manage', 'cat_drop');   //分类添加、分类转移和删除
	/* 代码增加_end  By  supplier.68ecshop.com */
    $purview['05_comment_manage']    = 'comment_priv';
	$purview['05_order_comment']    = 'order_comment_priv';//代码增加 --订单评论
    $purview['06_goods_brand_list']  = 'brand_manage';
    $purview['08_goods_type']        = 'attr_manage';   //商品属性
    $purview['11_goods_trash']       = array('goods_manage', 'remove_back');
    $purview['12_batch_pic']         = 'picture_batch';
    $purview['13_batch_add']         = 'goods_batch';
    $purview['14_goods_export']      = 'goods_export';
    $purview['15_batch_edit']        = 'goods_batch';
    $purview['16_goods_script']      = 'gen_goods_script';
    $purview['17_tag_manage']        = 'tag_manage';
    $purview['50_virtual_card_list'] = 'virualcard';
    $purview['51_virtual_card_add']  = 'virualcard';
    $purview['52_virtual_card_change'] = 'virualcard';
    $purview['goods_auto']           = 'goods_auto';
	$purview['scan_store']           = 'scan_store';
    $purview['05_shaidan_manage'] = 'shaidan_manage';
    $purview['05_question_manage']           = 'question_manage';
    $purview['05_goods_tags']           = 'tag_manage';

//促销管理权限
    $purview['02_snatch_list']       = 'snatch_manage';
    $purview['04_bonustype_list']    = 'bonus_manage';
    $purview['06_pack_list']         = 'pack';
    $purview['07_card_list']         = 'card_manage';
    $purview['08_group_buy']         = 'group_by';
    $purview['09_topic']             = 'topic_manage';
    $purview['10_auction']           = 'auction';
    $purview['12_favourable']        = 'favourable';
    $purview['13_wholesale']         = 'whole_sale';
    $purview['14_package_list']      = 'package_manage';
//  $purview['02_snatch_list']       = 'gift_manage';  //赠品管理
    $purview['04_back_order']        = 'back_view';	
    $purview['15_exchange_goods']    = 'exchange_goods';  //赠品管理
    $purview['11_kuaidi_order']      = 'order_view';	
    $purview['12_kuaidi_order2']     = 'order_view';
    $purview['25_pre_sale_list']	 = 'pre_sale';  //预售管理

//文章管理权限
    $purview['02_articlecat_list']   = 'article_cat';
    $purview['03_article_list']      = 'article_manage';
    $purview['article_auto']         = 'article_auto';
    $purview['vote_list']            = 'vote_priv';

//会员管理权限
    $purview['03_users_list']        = 'users_manage';

	$purview['04_users_export']        = 'users_manage';  //代码增加  By   www.68ecshop.com

    $purview['04_users_add']         = 'users_manage';
    $purview['05_user_rank_list']    = 'user_rank';
    $purview['09_user_account']      = 'surplus_manage';
    $purview['06_list_integrate']    = 'integrate_users';
    $purview['08_unreply_msg']       = 'feedback_priv';
    $purview['10_user_account_manage'] = 'surplus_manage';
    $purview['09_postman_list']        = 'users_manage';

//权限管理
    $purview['admin_logs']           = array('logs_manage', 'logs_drop');
    $purview['admin_list']           = array('admin_manage', 'admin_drop', 'allot_priv');
    $purview['agency_list']          = 'agency_manage';
    $purview['suppliers_list']          = 'suppliers_manage'; // 供货商
    $purview['admin_role']             = 'role_manage';
    $purview['customer']        	 = 'customer'; //在线聊天客服管理

//商店设置权限
    $purview['01_shop_config']       = 'shop_config';
    $purview['shop_authorized']      = 'shop_authorized';
    $purview['shp_webcollect']       = 'webcollect_manage';
    $purview['02_payment_list']      = 'payment';
    $purview['03_shipping_list']     = array('ship_manage','shiparea_manage');
    $purview['04_mail_settings']     = 'shop_config';
    $purview['05_area_list']         = 'area_manage';
    $purview['07_cron_schcron']      = 'cron';
    $purview['08_friendlink_list']   = 'friendlink';
    $purview['sitemap']              = 'sitemap';
    $purview['check_file_priv']      = 'file_priv';
    $purview['captcha_manage']       = 'shop_config';
    $purview['file_check']           = 'file_check';
    $purview['navigator']            = 'navigator';
    $purview['flashplay']            = 'flash_manage';
    $purview['ucenter_setup']        = 'integrate_users';
    $purview['021_reg_fields']       = 'reg_fields';
    $purview['website']       		 = 'website_login';

//广告管理
    $purview['z_clicks_stats']       = 'booking';
    //$purview['ad_position']          = 'ad_manage';
    $purview['ad_position']          = 'booking';  //去掉广告位置权限  李云鹏20160512
    $purview['ad_list']              = 'ad_manage';
    $purview['ad_mlist']              = 'ad_manage'; //手机广告 李云鹏20160525

//订单管理权限
/* 代码增加_start  By  supplier.68ecshop.com */
    $purview['01_order_list']        = 'order_view';
	//$purview['02_supplier_order']        = 'order_view';
	$purview['02_supplier_order']        = 'booking';  //去掉供货商订单  李云鹏20160512
	/* 代码增加_end  By  supplier.68ecshop.com */
    $purview['03_order_query']       = 'order_view';
    $purview['04_merge_order']       = 'order_os_edit';
    $purview['05_edit_order_print']  = 'order_os_edit';
    $purview['06_undispose_booking'] = 'booking';
    $purview['08_add_order']         = 'order_edit';
    $purview['09_delivery_order']    = 'delivery_view';
    $purview['10_back_order']        = 'back_view';
    $purview['11_supplier_back_order']        = 'back_view';
    $purview['12_order_excel']        = 'order_view';
	$purview['12_invoice_list']    = 'invoice_manage';

//报表统计权限
    $purview['flow_stats']           = 'client_flow_stats';
	/* 代码添加_START   By www.68ecshop.com */
	$purview['keyword']              = 'client_flow_stats';
	/* 代码添加_SEND  By www.68ecshop.com */
    $purview['report_guest']         = 'client_flow_stats';
    $purview['report_users']         = 'client_flow_stats';
    $purview['visit_buy_per']        = 'client_flow_stats';
    $purview['searchengine_stats']   = 'client_flow_stats';
    $purview['report_order']         = 'sale_order_stats';
    $purview['report_sell']          = 'sale_order_stats';
    $purview['sale_list']            = 'sale_order_stats';
    $purview['sell_stats']           = 'sale_order_stats';


//模板管理
    $purview['02_template_select']   = 'template_select';
    $purview['03_template_setup']    = 'template_setup';
    $purview['04_template_library']  = 'library_manage';
    $purview['05_edit_languages']    = 'lang_edit';
    $purview['06_template_backup']   = 'backup_setting';
    $purview['mail_template_manage'] = 'mail_template';

//数据库管理
    $purview['02_db_manage']         = array('db_backup', 'db_renew');
    $purview['03_db_optimize']       = 'db_optimize';
    $purview['04_sql_query']         = 'sql_query';
    $purview['convert']              = 'convert';

//短信管理
    $purview['02_sms_my_info']       = 'my_info';
    $purview['03_sms_send']          = 'sms_send';
    $purview['04_sms_charge']        = 'sms_charge';
    $purview['05_sms_send_history']  = 'send_history';
    $purview['06_sms_charge_history']= 'charge_history';

//推荐管理
    $purview['affiliate']            = 'affiliate';
    $purview['affiliate_ck']         = 'affiliate_ck';

//邮件群发管理
    $purview['attention_list']       = 'attention_list';
    $purview['email_list']           = 'email_list';
    $purview['magazine_list']        = 'magazine_list';
    $purview['view_sendlist']        = 'view_sendlist';
    $purview['sendmail']        	 = 'send_mail';

/* 代码增加_start  By   supplier.68ecshop.com */
$purview['05_supplier_rank']        = 'supplier_rank';
$purview['01_supplier_reg']        = 'supplier_manage';
$purview['02_supplier_list']        = 'supplier_manage';
$purview['03_rebate_nopay']        = 'supplier_rebate';
$purview['03_rebate_pay']        = 'supplier_rebate';
$purview['04_shop_category']        = 'supplier_manage';
$purview['05_shop_street']        = 'supplier_manage';
$purview['06_supplier_tag']        = 'supplier_tag';
/* 代码增加_end  By   supplier.68ecshop.com */

	$purview['website']      = 'website';
	/* 代码增加_start  By  www.68ecshop.com */
	$purview['16_takegoods_list']			= 'takegoods_list';
	$purview['16_takegoods_order']    = 'takegoods_order';
	/* 代码增加_end  By  www.68ecshop.com */

//自提点管理权限
	$purview['pickup_point_list'] = 'pickup_point_manage';
    $purview['pickup_point_add'] = 'pickup_point_manage';
	$purview['pickup_point_batch_add'] = 'pickup_point_batch';


/* 虚拟团购 代码增加_start   By  www.68ecshop.com */
$purview['01_virtual_goods_classify'] = 'virtual_goods_classify';  //虚拟商品分类管理
$purview['01_virtual_goods_district'] = 'virtual_goods_classify';  //虚拟商品商圈管理
$purview['50_virtual_card_list_sup']   = 'virtual_card_list_sup'; //虚拟商品列表
$purview['virtual_goods_validate']   = 'virtual_goods_validate';
$purview['virtual_card_list']                 = 'virtual_card_list';
/* 虚拟团购 代码增加_end   By  www.68ecshop.com */


$purview['chat_server']       = 'chat_server';         // 聊天服务设置
$purview['customer']       = 'customer';         // 客服管理
?>