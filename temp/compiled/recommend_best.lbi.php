<?php
$GLOBALS['smarty']->assign('best_goods',      get_yupai_auction());    // 精品展示
?>
<dl class="jpzs r">
    <dt>拍品展示</dt>
    <?php $_from = $this->_var['best_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
    <dd>
        <a href="<?php echo $this->_var['goods']['url']; ?>"><img src="<?php echo $this->_var['goods']['thumb']; ?>" alt=""></a>
        <div class="title">
            <?php echo $this->_var['goods']['short_name']; ?>
            <span>开拍日期:<?php echo $this->_var['goods']['format_start_time']; ?></span>
        </div>
    </dd>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</dl>