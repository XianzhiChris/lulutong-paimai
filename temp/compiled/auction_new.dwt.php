<!DOCTYPE html>
<html lang="en">
<head>
<base href="http://localhost/" />
<meta name="author" content="先知教育-IT培训 QQ:276906866" />
	<meta charset="UTF-8">
	<?php echo $this->fetch('library/header.lbi'); ?>
	<title><?php echo $this->_var['page_title']; ?></title>
	<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
    <meta name="Description" content="<?php echo $this->_var['description']; ?>" />
    <link href="themes/paimai/css/category.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="site-nav"> 
    <?php echo $this->fetch('library/page_paimai_header.lbi'); ?>
    <?php echo $this->fetch('library/ur_here.lbi'); ?>
    <div id="main">
        <div class="w">

            <?php if ($this->_var['auction_list']): ?>
            <dl class="sortproduct">
                <dt></dt>
                <?php $_from = $this->_var['auction_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['name']['iteration']++;
?>
                <dd>
                    <a href="<?php echo $this->_var['goods']['url']; ?>" style="background:url(<?php echo $this->_var['goods']['goods_thumb2']; ?>) center no-repeat;"></a>
                    <div class="zt">
                        <div class="chujia">
                            <a href="<?php echo $this->_var['goods']['url']; ?>"><span>￥<?php echo $this->_var['goods']['chujia']; ?></span></a></div>
                        <div class="name"><a href="<?php echo $this->_var['goods']['url']; ?>" title="<?php echo $this->_var['goods']['act_name']; ?>"><?php echo $this->_var['goods']['act_name']; ?></a>送拍机构：<?php echo $this->_var['goods']['songpairen']; ?><br><em><?php echo $this->_var['goods']['chujia_count']; ?></em>次出价</div>
                        <div class="sysj" data-startTime="<?php echo $this->_var['goods']['start_time']; ?>" data-endTime="<?php echo $this->_var['goods']['end_time']; ?>"><?php echo $this->_var['lang']['please_waiting']; ?></div>
                    </div>
                    <div class="clear"></div>
                </dd>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </dl>
            <div class="clear"></div>
            <?php endif; ?>
        </div>
        <?php echo $this->fetch('library/pages.lbi'); ?>

    </div>
</div>
<?php echo $this->fetch('library/page_paimai_footer.lbi'); ?>
<script type="text/javascript" src="themes/paimai/js/setHdTime.js"></script>
<a href="http://www.itmba.cc" style="display:none">先知教育 淄博PHP培训</a>
</body>
</html>
