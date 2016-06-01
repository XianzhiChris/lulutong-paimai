<?php if ($this->_var['full_page'] == 1): ?>
<!DOCTYPE HTML>
<html>
  <head>
    <?php echo $this->fetch('html_header.htm'); ?>
	<script src='js/touch.js'></script>
    <script>
	;(function($)
	{
		Zepto(function($)
        {
			init();
			$.zcontent.add_success(init);
        });
	    function init()
	    {
			$('#rebate_paytime_start').intimidatetime({format:'yyyy-MM-dd'});
			$('#rebate_paytime_end').intimidatetime({format:'yyyy-MM-dd'});
	    }
	})(Zepto)
     
      function search_commission()
      {
        if(check_form_empty('theForm'))
        {
          $.zalert.add('至少有一项输入不为空！',1)
        }
        else
        {
          $.zcontent.set('rebate_paytime_start',$('#rebate_paytime_start').val());
          $.zcontent.set('rebate_paytime_end',$('#rebate_paytime_end').val());
          search();
        }
        return false;
      }
      
      function change_is_pay_ok(is_pay_ok)
      {
        $.zcontent.set('is_pay_ok',is_pay_ok);
        search();
      }
	  
    </script>
  </head>
  <body>
    <div id='container'>
      <?php endif; ?>
      <?php echo $this->fetch('page_header.htm'); ?>
      <section>
        <?php echo $this->fetch('menu_list.htm'); ?>
        <div class="order_con" id="con_order_manage_2" style="display:none">
          <div class="order_pd">
            <div class="order order_t">
              <form name="theForm" method="" action="" class="order_search" onsubmit='return search_commission();'>
                <table width="100%" border="0">
                  <tr>
                    <td>
                      <input type="text" name="rebate_paytime_start" id='rebate_paytime_start' class="inputBg" placeholder="请选择开始时间" <?php if ($this->_var['filter']['rebate_paytime_start']): ?>value='<?php echo $this->_var['filter']['rebate_paytime_start']; ?>'<?php endif; ?>/>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <input type="text" name="rebate_paytime_end" id='rebate_paytime_end' class="inputBg" placeholder="请选择结束时间" <?php if ($this->_var['filter']['rebate_paytime_end']): ?>value='<?php echo $this->_var['filter']['rebate_paytime_end']; ?>'<?php endif; ?>/>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <input type="submit" name="" class="button2" value="查找"/>
                    </td>
                  </tr>
                </table>
              </form>
            </div>
          </div>
        </div>
        <div class="order_con" id="con_order_manage_1">
          <ul class="rebate_type">
            <li <?php if ($this->_var['filter']['is_pay_ok'] == 0): ?>class="curr"<?php endif; ?> id="type1" onclick="change_is_pay_ok('0')">本期结算</li>
            <li <?php if ($this->_var['filter']['is_pay_ok'] == 1): ?>class="curr"<?php endif; ?> id="type2" onclick="change_is_pay_ok('1')">往期结算</li>
          </ul>
          <div class="order_pd"  id="con_type_1">
            <div class="order">
              <ul class="order_list">
                <?php $_from = $this->_var['supplier_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                <li>
                  <table width="100%" cellpadding="3" cellspacing="1" >
                    <tr>
                      <td align="left" class="font2" width='50%'>编号：<?php echo $this->_var['item']['sign']; ?></td>
                      <td align="left" width='50%'>时间段：<?php echo $this->_var['item']['rebate_paytime_start']; ?>-<?php echo $this->_var['item']['rebate_paytime_end']; ?></td>
                    </tr>
                    <tr>
                      <td align="left" >总营业额：<?php echo $this->_var['item']['all_money_formated']; ?></td>
                      <td align="left">佣金：<?php echo $this->_var['item']['rebate_money_formated']; ?></td>
                    </tr>
                    <tr>
                      <td align="left">实际结算金额：<?php echo $this->_var['item']['pay_money_formated']; ?></td>
                      <td align="left">返佣状态：<?php echo $this->_var['item']['status_name']; ?></td>
                    </tr>
                    <tr>
                      <td align="left">返佣日期：<?php if ($this->_var['item']['pay_time']): ?><?php echo $this->_var['item']['pay_time']; ?><?php else: ?><font style='color:red'>无</font><?php endif; ?></td>
                      <td align="left">
                        <a href="supplier_rebate.php?act=view&rid=<?php echo $this->_var['item']['rebate_id']; ?>" class="font">查看结算单</a>
                        <span>&nbsp;/&nbsp;</span>
                        <a href="supplier_order.php?act=view&rid=<?php echo $this->_var['item']['rebate_id']; ?>" class="font">查看明细</a>
                      </td>
                    </tr>
                  </table>
                </li>
                <?php endforeach; else: ?>
                <li>
                  <table width="100%" cellpadding="3" cellspacing="1" >
                    <tr>
                      <td align="center" class="font2" width='100%'>找不到任何结算单！</td>
                    </tr>
                  </table>
                </li>
                <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
              </ul>
            </div>
            <?php echo $this->fetch('page.htm'); ?>
          </div>
        </div>
      </section>
      <?php echo $this->fetch('page_footer.htm'); ?>
      <?php if ($this->_var['full_page'] == 1): ?>
    </div>
    <?php echo $this->fetch('static_div.htm'); ?>
  </body>
</html>
<?php endif; ?>