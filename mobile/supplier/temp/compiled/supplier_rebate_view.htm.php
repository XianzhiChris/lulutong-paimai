<?php if ($this->_var['full_page'] == 1): ?>
<!DOCTYPE HTML>
<html>
  <head>
    <?php echo $this->fetch('html_header.htm'); ?>
    <script>
    Zepto(function($)
    {
       $.zcontent.add_static('rebate_id');
    })
      function toggle_other_info()
      {
        $('#other_info').slideToggle();
      }
      
      function toggle_verify_info()
      {
        $('#verify_info').slideToggle();
      }
      
      function toggle_logs_info()
      {
        $('#logs_info').slideToggle();
      }    
      
    </script>
  </head>
  <body>
    <div id='container'>
      <?php endif; ?>
      <?php echo $this->fetch('page_header.htm'); ?>
      <section>
        <div class="order_info_con order_pd">
          <div class="order_base">
            <p class="edit"><span>基本信息</span></p>
            <div class="base_info base_info_search">
              <p class="first">结算单编号：<?php echo $this->_var['rebate']['sign']; ?></p>
              <p>入驻商名称：<?php echo $this->_var['supplier']['user_name']; ?></p>
              <p>店铺名称：<?php echo $this->_var['supplier']['supplier_name']; ?></p>
              <p>结算期间：<?php echo $this->_var['rebate']['rebate_paytime_start']; ?>-<?php echo $this->_var['rebate']['rebate_paytime_end']; ?></p>
            </div>
          </div>
          <div class="order_base">
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
          <div class="order_base">
            <p class="edit"><span>佣金统计</span></p>
            <div class="base_info base_info_search">
              <table width="100%" >
                <tr>
                  <td align="left" width='33%'>实收货款：<?php echo $this->_var['allmoney']['rebate_all']; ?></td>
                  <td align='left' width='33%'>-佣金：<?php echo $this->_var['allmoney']['rebate_money']; ?></td>
                  <td align="left" width='33%'>=结算金额：<?php echo $this->_var['allmoney']['payable_price']; ?></td>
                </tr>
              </table>
            </div>
          </div>
          <div class="order_qita">
            <p class="edit" id="order_qita" onclick='toggle_other_info()'><span>收款账户信息</span> <i></i></p>
            <div class="qita_info" id='other_info'>
              <table width='100%'>
                <tr>
                  <td>公司名称：</td>
                  <td><?php echo $this->_var['supplier']['company_name']; ?></td>
                </tr>
                <tr>
                  <td>地址：</td>
                  <td><?php echo $this->_var['supplier']['province']; ?><?php echo $this->_var['supplier']['city']; ?><?php echo $this->_var['supplier']['district']; ?><?php echo $this->_var['supplier']['address']; ?></td>
                </tr>
                <tr>
                  <td>电话：</td>
                  <td><?php echo $this->_var['supplier']['tel']; ?></td>
                </tr>
                <tr>
                  <td>开户行：</td>
                  <td><?php echo $this->_var['supplier']['settlement_bank_name']; ?></td>
                </tr>
                <tr>
                  <td>帐号：</td>
                  <td><?php echo $this->_var['supplier']['settlement_bank_account_number']; ?></td>
                </tr>
              </table>
            </div>
          </div>
          <div class="order_qita">
            <p class="edit" onclick='toggle_verify_info()'><span>审核</span><a href='javascript:void(0);' class="special"><?php if ($this->_var['rebate']['status'] == 4): ?>完成汇款<?php elseif ($this->_var['rebate']['status'] == 2): ?>平台已发起结算<?php else: ?>等待平台方发起结算<?php endif; ?></a><i></i></p>
            <div class="qita_info" id='verify_info'>
              <?php if ($this->_var['rebate']['status'] == 4): ?>
              <table width='100%' cellpadding="3" cellspacing="1">
                <tr>
                  <td align='left'>汇款凭证：</td>
                  <td align='left'><a href="<?php echo $this->_var['rebate']['rebate_img']; ?>">查看汇款凭证</a></td>
                </tr>
                <tr>
                  <th align='left'>备注说明：</th>
                  <td align='left'><?php if ($this->_var['rebate']['remark']): ?><?php echo $this->_var['rebate']['remark']; ?><?php else: ?>无<?php endif; ?></td>
                </tr>
              </table>
              <?php else: ?>
              <table width='100%' cellpadding="3" cellspacing="1">
                <?php if ($this->_var['rebate']['status'] == 2): ?>
                <tr>
                  <th align='left'>当前进度：</th>
                  <td>
                    <input type='button' class='button' onclick='javscript:window.location.href="order.php?act=confirm_commission&id=<?php echo $this->_var['rebate']['rebate_id']; ?>"' value='确认通过' style='height:20px;line-hegiht:20px;width:60px;'/>
                  </td>
                  <td>如有疑问，请联系平台方负责人</td>
                </tr>
                <?php else: ?>
                <th>当前可操作项：</th>
                <td>
                  等待平台方发起结算
                </td>
                </tr>
                <?php endif; ?>
              </table>
              <?php endif; ?>
            </div>
          </div>
          <?php if ($this->_var['logs']): ?>
          <div class="order_qita">
            <p class="edit" id="order_qita" onclick='toggle_logs_info()'><span>操作记录</span> <i></i></p>
            <div class="qita_info" id='logs_info'>
              <table width='100%' cellpadding="3" cellspacing="1">
                <tr>
                  <th align='left'>操作者</th>
                  <th align='left'>操作时间</th>
                  <th align='left'>操作事件</th>
                  <th align='left'>备注</th>
                </tr>
                <?php $_from = $this->_var['logs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'log');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['log']):
?>
                <tr>
                  <td align='left'><?php echo $this->_var['log']['username']; ?></td>
                  <td align='left'><?php echo $this->_var['log']['addtime_dec']; ?></td>
                  <td align='left'><?php echo $this->_var['log']['typedec']; ?></td>
                  <td align='left'><?php echo $this->_var['log']['contents']; ?></td>
                </tr>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
              </table>
            </div>
          </div>
          <?php endif; ?>
        </div>
      </section>
      <?php echo $this->fetch('page_footer.htm'); ?>
      <?php if ($this->_var['full_page'] == 1): ?>
    </div>
    <?php echo $this->fetch('static_div.htm'); ?>
  </body>
</html>
<?php endif; ?>