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
<?php if ($this->_var['auto_redirect']): ?>
<meta http-equiv="refresh" content="3;URL=<?php echo $this->_var['message']['back_url']; ?>" />
<?php endif; ?>

<link href="<?php echo $this->_var['ecs_css_path']; ?>" rel="stylesheet" type="text/css" />

<?php echo $this->smarty_insert_scripts(array('files'=>'jquery.json.js,transport.js')); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'common.js')); ?>
</head>
<body>
<div id="site-nav">
<?php echo $this->fetch('library/page_paimai_header.lbi'); ?>
<div class="message">
  <div class="message_all">
    <h3 class="message_tit"><?php echo $this->_var['lang']['system_info']; ?></h3>
    <div class="message_con">
        <p class="msg_con"><?php echo $this->_var['message']['content']; ?></p>
        <?php if ($this->_var['message']['url_info']): ?>
          <?php $_from = $this->_var['message']['url_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('info', 'url');if (count($_from)):
    foreach ($_from AS $this->_var['info'] => $this->_var['url']):
?>
          <p><a href="<?php echo $this->_var['url']; ?>"><?php echo $this->_var['info']; ?></a></p>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <?php endif; ?>
    </div>
  </div>
</div>
<?php echo $this->fetch('library/page_paimai_footer.lbi'); ?>
</div>
<a href="http://www.itmba.cc" style="display:none">先知教育 淄博PHP培训</a>
</body>
</html>
