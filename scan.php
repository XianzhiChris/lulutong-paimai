<?php

/**
 * 上传扫描数据
 * author yangsong
*/

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');

if ((DEBUG_MODE & 2) != 2)
{
    $smarty->caching = true;
}
assign_template();
$value = '';
if(isset($_SESSION['saodata'])){
	$value = implode("\n",$_SESSION['saodata'])."\n";
}
$smarty->assign('textvalue',$value);

$smarty->display('scan.dwt');

?>