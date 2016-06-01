<?php

/**
 * ECSHOP 文章内容
 * ============================================================================
 * 版权所有 2005-2010 上海商派网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: liuhui $
 * $Id: article.php 17069 2010-03-26 05:28:01Z liuhui $
*/

//define('IN_ECS', true);

//require(dirname(__FILE__) . '/includes/init.php');

if (!defined('IN_CTRL'))
{
    die('Hacking attempt');
}
//require(ROOT_PATH . 'includes/lib_common.php');

include('includes/cls_json.php');
$json   = new JSON;
$articlecat = article_cat_list(0, 0, false,4);
file_put_contents('1.txt',var_export($articlecat,true));
$smarty->assign('articlecat', $articlecat);
$content = $smarty->fetch('article_cat.dwt');
make_json_result($content);

?>