<?php
    $GLOBALS['smarty']->assign('pmbz',     assign_articles(10, 5));       // 拍卖保障
    $GLOBALS['smarty']->assign('zfbz',     assign_articles(9, 5));       // 支付帮助
    $GLOBALS['smarty']->assign('sqsp',     assign_articles(21, 5));       // 申请送拍
    $GLOBALS['smarty']->assign('xsbz',     assign_articles(8, 5));       // 新手帮助
    ?>
<div id="foot">
    <div class="fc">
        <div class="w">
            <dl>
                <dt>拍卖保障</dt>
                <?php $_from = $this->_var['pmbz']['arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article_item');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['article_item']):
        $this->_foreach['name']['iteration']++;
?>
                <dd><i></i><a target="_blank" href="<?php echo $this->_var['article_item']['url']; ?>" title="<?php echo $this->_var['article_item']['title']; ?>"><?php echo $this->_var['article_item']['short_title']; ?></a></dd>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </dl>
            <dl>
                <dt>支付帮助</dt>
                <?php $_from = $this->_var['zfbz']['arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article_item');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['article_item']):
        $this->_foreach['name']['iteration']++;
?>
                <dd><i></i><a target="_blank" href="<?php echo $this->_var['article_item']['url']; ?>" title="<?php echo $this->_var['article_item']['title']; ?>"><?php echo $this->_var['article_item']['short_title']; ?></a></dd>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </dl>
            <dl class="ewm">
                <dd><img src="themes/paimai/images/ewm.png" alt=""></dd>
            </dl>
            <dl>
                <dt>申请送拍</dt>
                <?php $_from = $this->_var['sqsp']['arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article_item');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['article_item']):
        $this->_foreach['name']['iteration']++;
?>
                <dd><i></i><a target="_blank" href="<?php echo $this->_var['article_item']['url']; ?>" title="<?php echo $this->_var['article_item']['title']; ?>"><?php echo $this->_var['article_item']['short_title']; ?></a></dd>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </dl>
            <dl>
                <dt>新手帮助</dt>
                <?php $_from = $this->_var['xsbz']['arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article_item');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['article_item']):
        $this->_foreach['name']['iteration']++;
?>
                <dd><i></i><a target="_blank" href="<?php echo $this->_var['article_item']['url']; ?>" title="<?php echo $this->_var['article_item']['title']; ?>"><?php echo $this->_var['article_item']['short_title']; ?></a></dd>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </dl>
            <div class="clear"></div>
        </div>
    </div>
    <div class="ppcopyright">
        <div class="w">
            <div class="footmenu">
                <?php $_from = $this->_var['navigator_list']['bottom']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'nav_0_70429900_1465194877');$this->_foreach['nav_bottom_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nav_bottom_list']['total'] > 0):
    foreach ($_from AS $this->_var['nav_0_70429900_1465194877']):
        $this->_foreach['nav_bottom_list']['iteration']++;
?>
                |<a href="<?php echo $this->_var['nav_0_70429900_1465194877']['url']; ?>"><?php echo $this->_var['nav_0_70429900_1465194877']['name']; ?></a>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>|
            </div>
            <?php echo $this->_var['copyright']; ?>
        </div>

    </div>
    <div style="display:none"><script src="http://s4.cnzz.com/stat.php?id=1259134342&web_id=1259134342" language="JavaScript"></script></div>
</div>
