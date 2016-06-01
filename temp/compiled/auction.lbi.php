<dl class="jrpp l">
    <dt>今日拍品</dt>
    <?php $_from = $this->_var['today_auction']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'auction');if (count($_from)):
    foreach ($_from AS $this->_var['auction']):
?>
    <dd>
        <a href="<?php echo $this->_var['auction']['url']; ?>"><img src="<?php echo $this->_var['auction']['thumb']; ?>" alt=""></a>
        <div class="zt">
            <div class="chujia">
            <i></i>
            <em><?php echo $this->_var['auction']['chujia_count']; ?></em>次出价</div>
            <div class="name"><a href="<?php echo $this->_var['auction']['url']; ?>"><?php echo $this->_var['auction']['short_name']; ?></a></div>
            <div class="sysj" data-startTime="<?php echo $this->_var['auction']['start_time']; ?>" data-endTime="<?php echo $this->_var['auction']['end_time']; ?>"><?php echo $this->_var['lang']['please_waiting']; ?></div>
        </div>
        <div class="clear"></div>
    </dd>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</dl>