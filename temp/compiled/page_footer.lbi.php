
<div class="site-footer">
  <div class="wrapper">
    <div class="footer-info clearfix">
      <div class="info-text">
        <p class="nav_bottom">
        <?php if ($this->_var['navigator_list']['bottom']): ?>
      <?php $_from = $this->_var['navigator_list']['bottom']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'nav');$this->_foreach['nav_bottom_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nav_bottom_list']['total'] > 0):
    foreach ($_from AS $this->_var['nav']):
        $this->_foreach['nav_bottom_list']['iteration']++;
?>
      <a href="<?php echo $this->_var['nav']['url']; ?>" <?php if ($this->_var['nav']['opennew'] == 1): ?>target="_blank"<?php endif; ?>><?php echo $this->_var['nav']['name']; ?></a><em <?php if (($this->_foreach['nav_bottom_list']['iteration'] == $this->_foreach['nav_bottom_list']['total'])): ?>style="display:none"<?php endif; ?>>|</em>
         <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      <?php endif; ?>
        </p>
         <p>
      <a href="javascript:;"><?php echo $this->_var['copyright']; ?></a>
      </p>
      </div>
    </div>
  </div>
  <div style="display:none"><script src="http://s4.cnzz.com/stat.php?id=1259134342&web_id=1259134342" language="JavaScript"></script></div>
</div>

<script type="text/javascript">
Ajax.call('api/okgoods.php', '', '', 'GET', 'JSON');
//预售
Ajax.call('pre_sale.php?act=check_order', '', '', 'GET', 'JSON');
</script>