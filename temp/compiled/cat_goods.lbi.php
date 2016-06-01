<dl class="sortproduct">
    <dt><?php echo htmlspecialchars($this->_var['goods_cat']['name']); ?><a href="<?php echo $this->_var['goods_cat']['url']; ?>">更多>></a></dt>
    <?php $_from = $this->_var['cat_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_74396800_1464759672');if (count($_from)):
    foreach ($_from AS $this->_var['goods_0_74396800_1464759672']):
?>
    <dd>
        <a href="<?php echo $this->_var['goods_0_74396800_1464759672']['url']; ?>" style="background:url(<?php echo $this->_var['goods_0_74396800_1464759672']['thumb']; ?>) center no-repeat;"></a>
        <div class="zt">
            <div class="chujia">
            <i></i>
            <em><?php echo $this->_var['goods_0_74396800_1464759672']['chujia_count']; ?></em>次出价</div>
            <div class="name"><a href="<?php echo $this->_var['goods_0_74396800_1464759672']['url']; ?>"><?php echo htmlspecialchars($this->_var['goods_0_74396800_1464759672']['short_name']); ?></a></div>
            <div class="sysj" data-startTime="<?php echo $this->_var['goods_0_74396800_1464759672']['start_time']; ?>" data-endTime="<?php echo $this->_var['goods_0_74396800_1464759672']['end_time']; ?>"><?php echo $this->_var['lang']['please_waiting']; ?></div>
        </div>
        <div class="clear"></div>
    </dd>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    <div class="clear"></div>
</dl>
