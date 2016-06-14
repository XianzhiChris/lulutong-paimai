
<?php if ($this->_var['shipping_list']): ?>
    <ul class="shipping_jm">
      <li>
	      <select name='pay_ship[<?php echo $this->_var['suppid']; ?>]' id='pay_ship_<?php echo $this->_var['suppid']; ?>' onchange='selectShipping(this.value,<?php echo $this->_var['suppid']; ?>);' class='shipping'>
	      <?php $_from = $this->_var['shipping_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'shipping');if (count($_from)):
    foreach ($_from AS $this->_var['shipping']):
?>
	      <option <?php echo $this->_var['shipping']['selected']; ?> value="<?php echo $this->_var['shipping']['shipping_id']; ?>" title="<?php echo $this->_var['shipping']['shipping_desc']; ?>"><?php echo $this->_var['shipping']['shipping_name']; ?> （<?php echo $this->_var['shipping']['format_shipping_fee']; ?> 免费额度：<?php echo $this->_var['shipping']['free_money']; ?>  <?php echo sub_str($this->_var['shipping']['shipping_desc'],25); ?>）</option>
	      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	      </select>
      </li>
     <!-- <li style="text-align:right;">
	<input name="need_insure[<?php echo $this->_var['suppid']; ?>]" id="ECS_NEEDINSURE_<?php echo $this->_var['suppid']; ?>" type="checkbox"  onclick="selectInsure(this.checked)" value="1" <?php if ($this->_var['order']['need_insure']): ?>checked="true"<?php endif; ?> <?php if ($this->_var['insure_disabled']): ?>disabled="true"<?php endif; ?>  />
	<?php echo $this->_var['lang']['need_insure']; ?>
      </li>-->
    </ul>
<?php else: ?>
    <ul class="shipping_jm">
      <li>
	      <select name='pay_ship[<?php echo $this->_var['suppid']; ?>]' id='pay_ship_<?php echo $this->_var['suppid']; ?>' onchange='selectShipping(this.value,<?php echo $this->_var['suppid']; ?>);' class='shipping'>
	      <option value='0'>暂不支持收货地址配送</option>
	      </select>
      </li>
    </ul>
<?php endif; ?>