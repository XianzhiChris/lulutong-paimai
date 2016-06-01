<?php if ($this->_var['full_page'] == 1): ?>
<!DOCTYPE HTML>
<html>
  <head>
    <?php echo $this->fetch('html_header.htm'); ?>
    <link rel='stylesheet' href='styles/intimidatetime.css'/>
    <script src='js/intimidatetime.js'></script>
    <script src='js/intimidatetime.zh_CN.js'></script>
    <script>
      Zepto(function($)
      {
        $('#order_add_time_start').intimidatetime({format:'yyyy-MM-dd'});
        $('#order_add_time_end').intimidatetime({format:'yyyy-MM-dd'});
        $.zcontent.set('extra',cb_extra);
      });
      function cb_extra(result)
      {
        if(result === 'success')
        {
          $('#order_add_time_start').intimidatetime({format:'yyyy-MM-dd'});
          $('#order_add_time_end').intimidatetime({format:'yyyy-MM-dd'});
        }
      }
      function search_commission_order()
      {
        $.zcontent.set('order_sn',$('#order_sn').val());
        $.zcontent.set('order_add_time_start',$('#order_add_time_start').val());
        $.zcontent.set('order_add_time_end',$('#order_add_time_end').val());
        search();
        return false;
      }
      function change_otype(otype)
      {
        $.zcontent.set('otype',otype);
        search();
      }
    </script>
  </head>
  <body>
  <div id='container'>
    <?php endif; ?>
    <?php echo $this->fetch('page_header.htm'); ?>
    <section>
      <div class="order_info_con">
        <div class="stock_query">
          <p class="edit" id="goods_list" onclick="toggle_search();">佣金查询<i></i></p>
        </div>
      </div>
      <div class="order_con" id="con_order_manage_2" style="display:none">
        <div class="order_pd">
          <div class="order order_t">
            <form name="" method="" action="" class="order_search" onsubmit='return search_commission_order()'>
              <table width="100%" border="0">
                <tr>
                  <td>
                    <input type="text" name="order_sn" id='order_sn' class="inputBg" placeholder="请输入订单编号" <?php if ($this->_var['order_sn']): ?>value='<?php echo $this->_var['order_sn']; ?>'<?php endif; ?>/>
                  </td>
                </tr>
                <tr>
                  <td>
                    <input type="text" name="order_add_time_start" id='order_add_time_start' class="inputBg" placeholder="请选择下单开始时间" <?php if ($this->_var['order_add_time_start']): ?>value='<?php echo $this->_var['order_add_time_start']; ?>'<?php endif; ?>/>
                  </td>
                </tr>
                <tr>
                  <td>
                    <input type="text" name="order_add_time_end" id='order_add_time_end' class="inputBg" placeholder="请选择下单结束时间" <?php if ($this->_var['order_add_time_end']): ?>value='<?php echo $this->_var['order_add_time_end']; ?>'<?php endif; ?>/>
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
      <div class="order_info_con order_pd" id="con_order_manage_1">
        <ul class="rebate_type" style='width:100%;padding:0'>
          <li <?php if (! $this->_var['filter']['otype'] || $this->_var['filter']['otype'] != 2): ?>class="curr"<?php endif; ?> id="type1" style='margin-left:0' onclick="change_otype(0)">妥投订单</li>
          <li <?php if ($this->_var['filter']['otype'] == 2): ?>class="curr"<?php endif; ?> id="type2" onclick="change_otype('2')">退货订单</li>
        </ul>
        <div class="order_base">
          <p class="edit"><span>基本信息</span></p>
          <div class="base_info base_info_search">
            <p class="first">结算单编号：<?php echo $this->_var['rebate']['sign']; ?></p>
            <p>结算期间：<?php echo $this->_var['rebate']['rebate_paytime_start']; ?>-<?php echo $this->_var['rebate']['rebate_paytime_end']; ?></p>
          </div>
        </div>
        <div class="order_base" >
          <p class="edit"><span>结算信息</span></p>
          <div class="base_info base_info_search">
            <table width="100%" >
              <?php $_from = $this->_var['money_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'money');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['money']):
?>
              <tr>
                <td align="left" width='33%'><?php if ($this->_var['key'] == 'online'): ?>线上货款：<?php else: ?>线下货款(货到付款)：<?php endif; ?><?php echo $this->_var['money']['allmoney']; ?></td>
                <td align='left' width='33%'>佣金比例：<?php echo $this->_var['money']['supplier_rebate']; ?>%</td>
                <td align="left" width='33%'>佣金：<?php echo $this->_var['money']['rebatemoney']; ?></td>
              </tr>
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </table>
          </div>
        </div>
        <?php if ($this->_var['filter']['otype'] == 2): ?>
        <div class="order_base" >
          <p class="edit"><span>退货信息</span></p>
          <div class="base_info base_info_search">
            <table width="100%" cellpadding="3" cellspacing="1">
              <tr>
                <td>退货总货款：<?php echo $this->_var['back_money']['all']; ?>元（线上货款：<?php echo $this->_var['back_money']['online']; ?>元，货到付款：<?php echo $this->_var['back_money']['onout']; ?>元）
                <td>已完成退货货款：<?php echo $this->_var['back_money']['finish']; ?>元</td>
                <td>申请中退货货款：<?php echo $this->_var['back_money']['nofinish']; ?>元</td>
              </tr>
            </table>
          </div>
        </div>
        <?php endif; ?>
        <div class="order_base"  id="con_type_1">
          <div class="order">
            <p class="edit"><span>订单信息</span></p>
            <ul class="order_list">
              <?php if (! $this->_var['filter']['otype'] || $this->_var['filter']['otype'] != 2): ?>
              <?php $_from = $this->_var['order_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('okey', 'order');if (count($_from)):
    foreach ($_from AS $this->_var['okey'] => $this->_var['order']):
?>
              <li>
                <table width="100%" cellpadding="3" cellspacing="1">
                  <tr>
                    <td align='left' width='50%'>订单编号：<?php echo $this->_var['order']['order_sn']; ?></td>
                    <td align='left' width='50%'>下单时间：<?php echo $this->_var['order']['short_order_time']; ?></td>
                  </tr>
                  <tr>
                    <td align='left' width='50%'>计费时间：<?php echo $this->_var['order']['order_sn']; ?></td>
                    <td align='left' width='50%'>货款：<?php echo $this->_var['order']['total_fee']; ?></td>
                  </tr>
                  <tr>
                    <td align='left' width='50%'>佣金：<?php echo $this->_var['order']['formated_rebate_fee']; ?></td>
                    <td align='left' width='50%'>订单状态：<?php echo $this->_var['lang']['os'][$this->_var['order']['order_status']]; ?>,<?php echo $this->_var['lang']['ps'][$this->_var['order']['pay_status']]; ?>,<?php echo $this->_var['lang']['ss'][$this->_var['order']['shipping_status']]; ?></td>
                  </tr>
                  <tr>
                    <td align='left' width='50%'>&nbsp;</td>
                    <td align='left' width='50%'><a href="order.php?act=info&order_id=<?php echo $this->_var['order']['order_id']; ?>">查看订单</td>
                  </tr>
                </table>
              </li>
              <?php endforeach; else: ?>
              <li>
                <table width="100%" cellpadding="3" cellspacing="1">
                  <tr>
                    <td align='center' width='100%'>找不到任何订单！</td>
                  </tr>
                </table>
              </li>
              <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
              <?php elseif ($this->_var['filter']['otype'] == 2): ?>
              <?php $_from = $this->_var['order_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('okey', 'order');if (count($_from)):
    foreach ($_from AS $this->_var['okey'] => $this->_var['order']):
?>
              <li>
                <table width="100%" cellpadding="3" cellspacing="1">
                  <tr>
                    <td align='left' width='50%'>订单编号：<?php echo $this->_var['order']['order_sn']; ?></td>
                    <td align='left' width='50%'>下单时间：<?php echo $this->_var['order']['short_order_time']; ?></td>
                  </tr>
                  <tr>
                    <td align='left' width='50%'>申请退货时间：<?php echo $this->_var['order']['order_sn']; ?></td>
                    <td align='left' width='50%'>货款：<?php echo $this->_var['order']['total_fee']; ?></td>
                  </tr>
                  <tr>
                    <td align='left' width='50%'>订单状态：<?php echo $this->_var['lang']['os'][$this->_var['order']['order_status']]; ?>,<?php echo $this->_var['lang']['ps'][$this->_var['order']['pay_status']]; ?>,<?php echo $this->_var['lang']['ss'][$this->_var['order']['shipping_status']]; ?></td>
                    <td align='left' width='50%'><a href="order.php?act=info&order_id=<?php echo $this->_var['order']['order_id']; ?>">查看订单</td>
                  </tr>
                </table>
              </li>
              <?php endforeach; else: ?>
              <li>
                <table width="100%" cellpadding="3" cellspacing="1">
                  <tr>
                    <td align='center' width='100%'>找不到任何订单！</td>
                  </tr>
                </table>
              </li>
              <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
              <?php endif; ?>
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