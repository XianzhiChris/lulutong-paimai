
<div id="auction_log">
<?php $_from = $this->_var['auction_log']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'log');$this->_foreach['fe_bid_log'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fe_bid_log']['total'] > 0):
    foreach ($_from AS $this->_var['log']):
        $this->_foreach['fe_bid_log']['iteration']++;
?>
<?php if ($this->_foreach['fe_bid_log']['iteration'] < 5): ?>
<dd<?php if ($this->_foreach['fe_bid_log']['iteration'] == 1): ?> class="get"<?php endif; ?>>
    <span class="status">
    <?php if ($this->_foreach['fe_bid_log']['iteration'] == 1): ?>领先
    <?php else: ?>出局<?php endif; ?>
    </span>
    <span class="price">¥<em class="pm-num"><?php echo $this->_var['log']['formated_bid_price']; ?></em></span>
    <span class="user"><?php echo $this->_var['log']['user_name']; ?></span>
    <span class="time"><em class="pm-num"><?php echo $this->_var['log']['formated_bid_time']; ?></em></span>
</dd>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</div>