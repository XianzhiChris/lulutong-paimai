<div id="pphead">
    <div class="topmenu">
        <div class="w">
            <ul class="r">
                <?php 
$k = array (
  'name' => 'member_info',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
                <li><a href="user.php?act=order_list">我的交易</a></li>
                <?php $_from = $this->_var['navigator_list']['top']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'nav');$this->_foreach['nav_top_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nav_top_list']['total'] > 0):
    foreach ($_from AS $this->_var['nav']):
        $this->_foreach['nav_top_list']['iteration']++;
?>
                <li><a href="<?php echo $this->_var['nav']['url']; ?>"><?php echo $this->_var['nav']['name']; ?></a></li>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                <li><a href="">关注我们</a></li>
                <li><a href="">手机端</a></li>
            </ul>
        </div>
    </div>
    <div class="app">
        <div class="w">
            <?php 
$k = array (
  'name' => 'ads',
  'id' => '58',
  'num' => '1',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
        </div>
    </div>
    <div class="pplogo">
        <div class="w">
            <img src="themes/paimai/images/logo.jpg" alt="">


            <form action="search.php" method="get" id="searchForm" name="searchForm">
                <input type='hidden' name='type' id="searchtype" value="<?php echo empty($_REQUEST['type']) ? '0' : $_REQUEST['type']; ?>">
                <input type="text" name="keywords" placeholder="<?php if ($this->_var['search_keywords']): ?><?php echo htmlspecialchars($this->_var['search_keywords']); ?><?php else: ?>请输入关键词<?php endif; ?>" required>
                <input type="submit">
                <div class="wdpm">
                    <div class="pman">
                        <i class="left"></i>
                        <i class="right"><s>◇</s></i>
                        <a href="user.php?act=auction_list">我的拍卖</a>
                    </div>
                    <div class="pmxl" style="display:none">
                        <div class="spacer"></div>
                        <a href="user.php?act=auction_list">我的竞拍</a>
                        <a href="">我的获拍</a>
                        <a href="">我的保证金</a>
                    </div>
                </div>
            </form>

            <div class="clear"></div>
        </div>
    </div>
    <div class="menu">
        <div class="w">
            <ul>
                <li><a href="/">首页</a><span>/</span></li>
                <?php $_from = $this->_var['navigator_list']['middle']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'nav');$this->_foreach['nav_middle_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nav_middle_list']['total'] > 0):
    foreach ($_from AS $this->_var['nav']):
        $this->_foreach['nav_middle_list']['iteration']++;
?>
                <li><a href="<?php echo $this->_var['nav']['url']; ?>"><?php echo $this->_var['nav']['name']; ?></a><span>/</span></li>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
</div>
