<?php if ($this->_var['user_info']): ?>
<li><em><?php echo $this->_var['user_info']['username']; ?> <?php echo $this->_var['lang']['welcome_return']; ?></em></li>
<li><a class="sn-login" href="user.php" target="_top"><?php echo $this->_var['lang']['user_center']; ?></a></li>
<li><a class="sn-register" href="user.php?act=logout" target="_top"><?php echo $this->_var['lang']['user_logout']; ?></a></li>
<?php else: ?>
<li><em><?php echo $this->_var['lang']['welcome']; ?></em><a class="sn-login" href="user.php" target="_top">请登录</a></li>
<li><a class="sn-register" href="register.php" target="_top">会员注册</a> </li>
<?php endif; ?>