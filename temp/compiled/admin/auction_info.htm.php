<!-- $Id: auction_info.htm 16992 2010-01-19 08:45:49Z wangleisvn $ -->
<?php echo $this->fetch('pageheader.htm'); ?>
<script type="text/javascript" src="../js/calendar.php?lang=<?php echo $this->_var['cfg_lang']; ?>"></script>
<link href="../js/calendar/calendar.css" rel="stylesheet" type="text/css" />
<?php echo $this->smarty_insert_scripts(array('files'=>'validator.js,../js/transport.org.js,../js/utils.js')); ?>
<script type="text/javascript">
  //李云鹏 20160515
  $(function(){
    $("#is_xianshipai").click(function(){
      if(this.checked){
        $(".auction_time").css('display','none');
        $(".xianshipai_type").css('display','table-row');
      }else{
        $(".auction_time").css('display','table-row');
        $(".xianshipai_type").css('display','none');
      }
    });
    $("#xianshipai_type").change(function(){
      var start_time=$("#start_time").val();  //获取开始日期
      start_time=start_time.substring(0,10);  //截取日期部分
      var end_time=parseInt($(this).val())+1;
      end_time=start_time+" "+end_time+":00";
      start_time=start_time+" "+$(this).val()+":00";
      $("#start_time").val(start_time);
      $("#end_time").val(end_time);
    });
    $("#selbtn1").click(function(){
      $("#xianshipai_type").val("");
    });
  });
</script>
<div class="main-div">
<form method="post" action="auction.php" name="theForm" enctype="multipart/form-data" onSubmit="return validate()">
<table cellspacing="1" cellpadding="3" width="100%">
  <tr>
    <td class="label"><?php echo $this->_var['lang']['label_act_name']; ?></td>
    <td><input name="act_name" type="text" id="act_name" value="<?php echo $this->_var['auction']['act_name']; ?>" maxlength="60" />
    此处留空则用商品名称</td>
  </tr>
  <tr style="display:none">
    <td class="label"><?php echo $this->_var['lang']['label_act_desc']; ?></td>
    <td><textarea  name="act_desc" cols="60" rows="4" id="act_desc"  ><?php echo $this->_var['auction']['act_desc']; ?></textarea></td>
  </tr>
  <tr>
    <td align="right"><?php echo $this->_var['lang']['label_search_goods']; ?></td>
    <td><input name="keyword" type="text" id="keyword">
      <input name="search" type="button" id="search" value="<?php echo $this->_var['lang']['button_search']; ?>" class="button" onclick="searchGoods()" /></td>
  </tr>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['label_goods_name']; ?></td>
    <td><select name="goods_id" id="goods_id" onchange="javascript:change_good_products();">
      <option value="<?php echo $this->_var['auction']['goods_id']; ?>" selected="selected"><?php echo $this->_var['auction']['goods_name']; ?></option>
    </select>
    <select name="product_id" <?php if ($this->_var['auction']['product_id'] <= 0): ?>style="display:none"<?php endif; ?> >
        <?php echo $this->html_options(array('options'=>$this->_var['good_products_select'],'selected'=>$this->_var['auction']['product_id'])); ?>
        </select></td>
  </tr>
  <tr>
    <td class="label">参加限时拍：</td>
    <td>
      <input type="checkbox" name="is_xianshipai" id="is_xianshipai" value="1" <?php if ($this->_var['auction']['is_xianshipai']): ?>checked<?php endif; ?>>
    </td>
  </tr>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['label_start_time']; ?></td>
    <td><input name="start_time" type="text" id="start_time" value="<?php echo $this->_var['auction']['start_time']; ?>" readonly="readonly" />
      <input name="selbtn1" type="button" id="selbtn1" onclick="return showCalendar('start_time', '%Y-%m-%d %H:%M', '24', false, 'selbtn1');" value="<?php echo $this->_var['lang']['btn_select']; ?>" class="button" /></td>
  </tr>
  <tr class="auction_time" <?php if ($this->_var['auction']['is_xianshipai']): ?> style="display:none"<?php endif; ?>>
    <td class="label"><?php echo $this->_var['lang']['label_end_time']; ?></td>
    <td><input name="end_time" type="text" id="end_time" value="<?php echo $this->_var['auction']['end_time']; ?>" readonly="readonly" />
      <input name="selbtn2" type="button" id="selbtn2" onclick="return showCalendar('end_time', '%Y-%m-%d %H:%M', '24', false, 'selbtn2');" value="<?php echo $this->_var['lang']['btn_select']; ?>" class="button" /></td>
  </tr>
  <tr class="xianshipai_type" <?php if (! $this->_var['auction']['is_xianshipai']): ?> style="display:none"<?php endif; ?>>
    <td class="label">拍卖场次：</td>
    <td><select name="xianshipai_type" id="xianshipai_type">
      <option value=""> 请选择 </option>
      <option value="10" <?php if ($this->_var['auction']['xianshipai_type'] == 10): ?>selected<?php endif; ?>> 10:00 </option>
      <option value="12" <?php if ($this->_var['auction']['xianshipai_type'] == 12): ?>selected<?php endif; ?>> 12:00 </option>
      <option value="14" <?php if ($this->_var['auction']['xianshipai_type'] == 14): ?>selected<?php endif; ?>> 14:00 </option>
      <option value="16" <?php if ($this->_var['auction']['xianshipai_type'] == 16): ?>selected<?php endif; ?>> 16:00 </option>
      <option value="18" <?php if ($this->_var['auction']['xianshipai_type'] == 18): ?>selected<?php endif; ?>> 18:00 </option>
      <option value="20" <?php if ($this->_var['auction']['xianshipai_type'] == 20): ?>selected<?php endif; ?>> 20:00 </option>
      <option value="22" <?php if ($this->_var['auction']['xianshipai_type'] == 22): ?>selected<?php endif; ?>> 22:00 </option>
    </select></td>
  </tr>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['label_start_price']; ?></td>
    <td><input name="start_price" type="text" id="start_price" value="<?php echo $this->_var['auction']['start_price']; ?>"></td>
  </tr>
  <tr style="display:none">
    <td class="label"><?php echo $this->_var['lang']['label_end_price']; ?></td>
    <td><input name="end_price" type="text" id="end_price"  <?php if ($this->_var['auction']['no_top']): ?>disabled="true" <?php else: ?>value="<?php echo $this->_var['auction']['end_price']; ?>"<?php endif; ?>><input name="no_top" type="checkbox" value="1" onClick="checked_no_top(this);" onChange="checked_no_top(this);" checked/><?php echo $this->_var['lang']['label_no_top']; ?></td>
  </tr>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['label_amplitude']; ?></td>
    <td><input name="amplitude" type="text" id="amplitude" value="<?php echo $this->_var['auction']['amplitude']; ?>" disabled></td>
  </tr>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['label_deposit']; ?></td>
    <td><input name="deposit" type="text" id="deposit" value="<?php echo $this->_var['auction']['deposit']; ?>"></td>
  </tr>
  <?php if ($this->_var['auction']['act_id'] > 0): ?>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['label_status']; ?></td>
    <td><?php echo $this->_var['auction']['status']; ?><br /><?php echo $this->_var['bid_user_count']; ?> <a href="auction.php?act=view_log&id=<?php echo $this->_var['auction']['act_id']; ?>"> [ <?php echo $this->_var['lang']['view']; ?> ]</a></td>
  </tr>
  <?php endif; ?>
  <tr>
    <td colspan="2" align="center">
      <?php if ($this->_var['auction']['act_id'] == 0 || $this->_var['auction']['status_no'] == "0" || $this->_var['auction']['status_no'] == "1"): ?>
      <input type="submit" class="button" value="<?php echo $this->_var['lang']['button_submit']; ?>" />
      <input type="reset" class="button" value="<?php echo $this->_var['lang']['button_reset']; ?>" />
      <input type="hidden" name="act" value="<?php echo $this->_var['form_action']; ?>" />
      <?php elseif ($this->_var['auction']['status_no'] == "2"): ?>
        <?php if ($this->_var['auction']['deposit'] > 0): ?>
        <?php echo $this->_var['lang']['settle_frozen_money']; ?>
        <input type="submit" class="button" value="<?php echo $this->_var['lang']['unfreeze']; ?>" name="unfreeze" />
        <input type="submit" class="button" value="<?php echo $this->_var['lang']['deduct']; ?>" name="deduct" />
        <input type="hidden" name="act" value="settle_money" />
        <?php endif; ?>
      <?php endif; ?>
      <input type="hidden" name="id" value="<?php echo $this->_var['auction']['act_id']; ?>" /></td>
  </tr>
</table>
</form>
</div>


<script language="JavaScript">
<!--
var display_yes = (Browser.isIE) ? 'block' : 'table-row-group';

onload = function()
{
    // 开始检查订单
    startCheckOrder();
}
/**
 * 检查表单输入的数据
 */
function validate()
{
    validator = new Validator("theForm");
    validator.isNumber('start_price', start_price_not_number, false);
    validator.isNumber('end_price', end_price_not_number, false);

    if (document.forms['theForm'].elements['no_top'].checked == false)
    {
      validator.gt('end_price', 'start_price', end_gt_start);
    }
    validator.isNumber('amplitude', amplitude_not_number, false);
    validator.isNumber('deposit', deposit_not_number, false);
    validator.islt('start_time', 'end_time', start_lt_end);
    return validator.passed();
}
function checked_no_top(o)
{
  if (o.checked)
  {
    o.form.elements['end_price'].value = '';
    o.form.elements['end_price'].disabled = true;
  }
  else
  {
    o.form.elements['end_price'].disabled = false;
  }
}
function searchGoods()
{
  var filter = new Object;
  filter.keyword  = document.forms['theForm'].elements['keyword'].value;

  Ajax.call('auction.php?is_ajax=1&act=search_goods', filter, searchGoodsResponse, 'GET', 'JSON');
}

function searchGoodsResponse(result)
{
  if (result.error == '1' && result.message != '')
  {
    alert(result.message);
    return;
  }

  var frm = document.forms['theForm'];
  var sel = frm.elements['goods_id'];
  var sp = frm.elements['product_id'];

  if (result.error == 0)
  {
    /* 清除 options */
    sel.length = 0;
    sp.length = 0;

    /* 创建 options */
    var goods = result.content.goods;
    if (goods)
    {
      for (i = 0; i < goods.length; i++)
      {
          var opt = document.createElement("OPTION");
          opt.value = goods[i].goods_id;
          opt.text  = goods[i].goods_name;
          sel.options.add(opt);
      }
    }
    else
    {
      var opt = document.createElement("OPTION");
      opt.value = 0;
      opt.text  = search_is_null;
      sel.options.add(opt);
    }

    /* 创建 product options */
    var products = result.content.products;
    if (products)
    {
      sp.style.display = display_yes;

      for (i = 0; i < products.length; i++)
      {
        var p_opt = document.createElement("OPTION");
        p_opt.value = products[i].product_id;
        p_opt.text  = products[i].goods_attr_str;
        sp.options.add(p_opt);
      }
    }
    else
    {
      sp.style.display = 'none';

      var p_opt = document.createElement("OPTION");
      p_opt.value = 0;
      p_opt.text  = search_is_null;
      sp.options.add(p_opt);
    }
  }

  return;
}

function change_good_products()
{
  var filter = new Object;
  filter.goods_id = document.forms['theForm'].elements['goods_id'].value;

  Ajax.call('snatch.php?is_ajax=1&act=search_products', filter, searchProductsResponse, 'GET', 'JSON');
}

function searchProductsResponse(result)
{
  var frm = document.forms['theForm'];
  var sp = frm.elements['product_id'];

  if (result.error == 0)
  {
    /* 清除 options */
    sp.length = 0;

    /* 创建 product options */
    var products = result.content.products;
    if (products.length)
    {
      sp.style.display = display_yes;

      for (i = 0; i < products.length; i++)
      {
        var p_opt = document.createElement("OPTION");
        p_opt.value = products[i].product_id;
        p_opt.text  = products[i].goods_attr_str;
        sp.options.add(p_opt);
      }
    }
    else
    {
      sp.style.display = 'none';

      var p_opt = document.createElement("OPTION");
      p_opt.value = 0;
      p_opt.text  = search_is_null;
      sp.options.add(p_opt);
    }
  }

  if (result.message.length > 0)
  {
    alert(result.message);
  }
}
//-->
</script>

<?php echo $this->fetch('pagefooter.htm'); ?>
