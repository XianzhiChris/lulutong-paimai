<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,selectzone.js,colorselector.js')); ?>
<div class="tab-div">
    <!-- tab bar -->
    <div id="tabbar-div">
      <p>
		<span class="tab-front" id="detail-tab">详情</span>
		<span class="tab-back" id="gallery-tab">图片</span>
		<span class="tab-back" id="comment-tab">评价</span>
		<span><a href="getTaoBaoGoods.php?gid=<?php echo $this->_var['gid']; ?>&id=<?php echo $this->_var['id']; ?>&do=1&istitle=<?php echo $this->_var['istitle']; ?>&iscomment=<?php echo $this->_var['iscomment']; ?>">【导入】</a></span>
      </p>
    </div>
    <!-- tab body -->
    <div id="tabbody-div">
      <form action="" method="post" name="theForm" >
        <table width="90%" id="detail-table">
          <tr>
            <td>标题：<?php echo $this->_var['goods_name']; ?><br><?php echo $this->_var['content']; ?></td>
          </tr>
        </table>
        <table width="90%" id="gallery-table" style="display:none" align="center">
          <tr>
            <td>
              <?php $_from = $this->_var['img_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('i', 'img');if (count($_from)):
    foreach ($_from AS $this->_var['i'] => $this->_var['img']):
?>
              <div style="float:left; text-align:center; border: 1px solid #DADADA; margin: 4px; padding:2px;">
                <img src="../<?php echo $this->_var['img']; ?>" width="150" height="150">
              </div>
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </td>
          </tr>
        </table>
		<table width="90%" id="comment-table" style="display:none" align="center">
          <tr>
            <td>
              <?php $_from = $this->_var['comment_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                <p><?php echo $this->_var['item']['nick']; ?>：<?php echo $this->_var['item']['feedback']; ?></p>
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </td>
          </tr>
        </table>
      </form>
    </div>
</div>
<?php echo $this->smarty_insert_scripts(array('files'=>'validator.js,tab.js')); ?>
<?php echo $this->fetch('pagefooter.htm'); ?>
