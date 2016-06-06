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
</head>
<body>
	<?php echo $this->fetch('library/page_paimai_header.lbi'); ?>
	<div id="main">
		<div class="w">
		    
<?php echo $this->fetch('library/auction.lbi'); ?>

			
<?php echo $this->fetch('library/recommend_best.lbi'); ?>

			<div class="clear"></div>
			
<?php $this->assign('cat_goods',$this->_var['cat_goods_1']); ?><?php $this->assign('goods_cat',$this->_var['goods_cat_1']); ?><?php echo $this->fetch('library/cat_goods.lbi'); ?>

            
<?php $this->assign('cat_goods',$this->_var['cat_goods_2']); ?><?php $this->assign('goods_cat',$this->_var['goods_cat_2']); ?><?php echo $this->fetch('library/cat_goods.lbi'); ?>

            
<?php $this->assign('cat_goods',$this->_var['cat_goods_3']); ?><?php $this->assign('goods_cat',$this->_var['goods_cat_3']); ?><?php echo $this->fetch('library/cat_goods.lbi'); ?>

            
<?php $this->assign('cat_goods',$this->_var['cat_goods_4']); ?><?php $this->assign('goods_cat',$this->_var['goods_cat_4']); ?><?php echo $this->fetch('library/cat_goods.lbi'); ?>


			<dl class="hzjg jg">
				<dt><span>合作</span>机构</dt>
				<?php $_from = $this->_var['links2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'links');if (count($_from)):
    foreach ($_from AS $this->_var['links']):
?>
                <dd><a href="<?php echo $this->_var['links']['url']; ?>" target="_blank"><img src="<?php echo $this->_var['links']['logo']; ?>" alt=""></a></a></dd>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				<div class="clear"></div>
			</dl>
			<dl class="rzjg jg">
				<dt><span>入驻</span>机构</dt>
				<?php $_from = $this->_var['links3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'links');if (count($_from)):
    foreach ($_from AS $this->_var['links']):
?>
				<dd><a href="<?php echo $this->_var['links']['url']; ?>" target="_blank"><img src="<?php echo $this->_var['links']['logo']; ?>" alt=""></a></dd>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				<div class="clear"></div>
			</dl>
		</div>
	</div>
	<?php echo $this->fetch('library/page_paimai_footer.lbi'); ?>
	<script type="text/javascript" src="themes/paimai/js/setHdTime.js"></script>
<a href="http://www.itmba.cc" style="display:none">先知教育 淄博PHP培训</a>
</body>
</html>