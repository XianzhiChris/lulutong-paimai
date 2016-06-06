<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="http://localhost/" />
<meta name="author" content="先知教育-IT培训 QQ:276906866" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />
<title><?php echo $this->_var['page_title']; ?></title>
<link href="<?php echo $this->_var['ecs_css_path']; ?>" rel="stylesheet" type="text/css" />
<link href="css/increase-68.css" rel="stylesheet" type="text/css">
<link href="themes/paimai/css/68ecshop_commin.css" rel="stylesheet" type="text/css">
<link href="themes/paimai/css/style_jm.css" rel="stylesheet" type="text/css">
<link href="themes/paimai/css/teshu.css" rel="stylesheet" type="text/css">

<?php echo $this->smarty_insert_scripts(array('files'=>'jquery-1.6.2.min.js')); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'jquery.json.js,transport.js')); ?>

<?php echo $this->smarty_insert_scripts(array('files'=>'common.js,shopping_flow.js')); ?>
</head>
<body>
<div role="navigation" id="site-nav" data-spm="a2226mz" style="position:relative;">
<script type="text/javascript" src="themes/paimai/js/base-2011.js"></script>
<?php echo $this->fetch('library/user_header.lbi'); ?>
<div class="headerLayout" style="padding-top:15px; padding-bottom:5px;">
    <div class="headerCon ">
      <h1 id="mallLogo" style="padding-top:10px;"> <a href="index.php" class="header-logo"><img src="themes/paimai/images/logo.jpg" /></a></h1>
      <div class="header-extra">
        
      </div>
    </div>
  </div>
<div class="block"> 
  <?php if ($this->_var['step'] == "cart"): ?>
  <div id="A_Stepbar" class="flowstep" style="right:166px;">
          <ol class="flowstep-5">
            <li class="step-first">
              <div class="step-done">
                <div class="step-name">查看购物车</div>
                <div class="step-no"></div>
              </div>
            </li>
            <li>
              <div class="step-name">拍下商品</div>
              <div class="step-no">2</div>
            </li>
            <li>
              <div class="step-name">付款</div>
              <div class="step-no">3</div>
            </li>
            <li>
              <div class="step-name">确认收货</div>
              <div class="step-no">4</div>
            </li>
            <li class="step-last">
              <div class="step-name">评价</div>
              <div class="step-no">5</div>
            </li>
          </ol>
        </div>
  
  
  <div class="w cart">
    <div class="cart-hd group">
      <h2>我的购物车</h2>
      <span id="show2" class="fore"></span> </div>
    <div id="show"></div>
  </div>
  
  <?php echo $this->smarty_insert_scripts(array('files'=>'showdiv.js')); ?> 
  <script type="text/javascript">
  <?php $_from = $this->_var['lang']['password_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
    var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </script>
  <DIV id=show-cart>
    <div class="cart-frame">
      <div class="tl"></div>
      <div class="tr"></div>
    </div>
  </div>
  
  <form id="formCart" name="formCart" method="post" action="flow.php">
    <table width="100%" align="center" border="0" cellpadding="5" cellspacing="1" bgcolor="#ffffff" style=" border:#DDDDDD 1px solid; border-top:#999999 2px solid;">
      <tr> 
        <th bgcolor="#F7F7F7" width="6%" align=center><input type="checkbox" autocomplete="off" id="chkAll" name="chkAll" onclick="return chkAll_onclick()" style="vertical-align:middle">
          全选</th>
        
        <th bgcolor="#F7F7F7"><?php echo $this->_var['lang']['goods_name']; ?></th>
        <?php if ($this->_var['show_goods_attribute'] == 1): ?>
        <th bgcolor="#F7F7F7"><?php echo $this->_var['lang']['goods_attr']; ?></th>
        <?php endif; ?> 
        <?php if ($this->_var['show_marketprice']): ?>
        <th bgcolor="#F7F7F7"><?php echo $this->_var['lang']['market_prices']; ?></th>
        <?php endif; ?>
        <th bgcolor="#F7F7F7"><?php echo $this->_var['lang']['shop_prices']; ?></th>
        <th bgcolor="#F7F7F7"><?php echo $this->_var['lang']['number']; ?></th>
        <th bgcolor="#F7F7F7"><?php echo $this->_var['lang']['subtotal']; ?></th>
        <th bgcolor="#F7F7F7"><?php echo $this->_var['lang']['handle']; ?></th>
      </tr>
       
      <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('cartkey', 'cartgoods');if (count($_from)):
    foreach ($_from AS $this->_var['cartkey'] => $this->_var['cartgoods']):
?>
      <tr>
        <td  colspan=20 style="border-top:2px solid #6699cc; background:#edf7ff;font-weight:bold;"> <?php echo $this->_var['cartgoods']['supplier_name']; ?> </td>
      </tr>
      <?php $_from = $this->_var['cartgoods']['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?> 
      
      <tr> 
        <td bgcolor="#FFFDEE" align="center" ><input type="checkbox" autocomplete="off" name="sel_cartgoods[]" value="<?php echo $this->_var['goods']['rec_id']; ?>" id="sel_cartgoods_<?php echo $this->_var['goods']['rec_id']; ?>" checked=checked onclick="select_cart_goods();"></td>
        
        <td bgcolor="#FFFDEE" align="center" style="width:40%"><?php if ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] != 'package_buy'): ?> 
          <?php if ($this->_var['show_goods_thumb'] == 1): ?> 
          <a href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" target="_blank" class="f6"><?php echo $this->_var['goods']['goods_name']; ?></a> 
          <?php elseif ($this->_var['show_goods_thumb'] == 2): ?> 
          <a href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" target="_blank"><img style="width:80px; height:80px;" src="<?php echo $this->_var['goods']['goods_thumb']; ?>" border="0" title="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>" /></a> 
          <?php else: ?> 
           <div class="p-goods">
              <div class="p-img" style="float:left; width:25%"><a target="_blank" href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>"><img width="80" height="80" src="<?php echo $this->_var['goods']['goods_thumb']; ?>"></a></div>
              <div class="p-detail" style="float:left; margin-left:10px; width:70%;">
                <div class="p-name" style="text-align:left; height:80px;line-height:80px"> <a target="_blank" href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>"><?php echo $this->_var['goods']['goods_name']; ?></a> </div>
              </div>
            </div>
          <?php endif; ?> 
          <?php if ($this->_var['goods']['parent_id'] > 0): ?> 
          <span style="color:#FFFDEE">（<?php echo $this->_var['lang']['accessories']; ?>）</span> 
          <?php endif; ?> 
          <?php if ($this->_var['goods']['is_gift'] > 0): ?> 
          <span style="color:#FFFDEE">（<?php echo $this->_var['lang']['largess']; ?>）</span> 
          <?php endif; ?> 
          <?php elseif ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] == 'package_buy'): ?> 
          <a href="javascript:void(0)" onclick="setSuitShow(<?php echo $this->_var['goods']['goods_id']; ?>)" class="f6"><?php echo $this->_var['goods']['goods_name']; ?><span style="color:#DD0000;">（<?php echo $this->_var['lang']['remark_package']; ?>）</span></a>
          <div id="suit_<?php echo $this->_var['goods']['goods_id']; ?>" style="display:none"> 
            <?php $_from = $this->_var['goods']['package_goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'package_goods_list');if (count($_from)):
    foreach ($_from AS $this->_var['package_goods_list']):
?> 
            <a href="goods.php?id=<?php echo $this->_var['package_goods_list']['goods_id']; ?>" target="_blank" class="f6"><?php echo $this->_var['package_goods_list']['goods_name']; ?></a><br />
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
          </div>
          
          <?php else: ?> 
          <?php echo $this->_var['goods']['goods_name']; ?> 
          <?php endif; ?></td>
        <?php if ($this->_var['show_goods_attribute'] == 1): ?>
        <td bgcolor="#FFFDEE" align="center"><?php echo nl2br($this->_var['goods']['goods_attr']); ?></td>
        <?php endif; ?> 
        <?php if ($this->_var['show_marketprice']): ?>
        <td align="center" bgcolor="#FFFDEE"><?php echo $this->_var['goods']['market_price']; ?></td>
        <?php endif; ?>
        <td align="center" bgcolor="#FFFDEE"><?php echo $this->_var['goods']['goods_price']; ?></td>
        <td align="center" bgcolor="#FFFDEE" style="width:15%"><?php if ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['is_gift'] == 0 && $this->_var['goods']['parent_id'] == 0): ?> 
          
          <script language="javascript" type="text/javascript">                 function goods_cut($val){                     var num_val=document.getElementById('number'+$val);                     var new_num=num_val.value;                     if(isNaN(new_num)){alert('请输入数字');return false}                     var Num = parseInt(new_num);                     if(Num>1)Num=Num-1;                     num_val.value=Num;                     document.getElementById('updatecart').click();                 }                 function goods_add($val){                     var num_val=document.getElementById('number'+$val);                     var new_num=num_val.value;                     if(isNaN(new_num)){alert('请输入数字');return false}                     var Num = parseInt(new_num);                     Num=Num+1;                     num_val.value=Num;                     document.getElementById('updatecart').click();                 }             </script> 
          <span class="goods_cut" onclick="goods_cut('<?php echo $this->_var['goods']['rec_id']; ?>');" style="margin-left:42px;"></span>
          <input type="text" name="goods_number[<?php echo $this->_var['goods']['rec_id']; ?>]" id="number<?php echo $this->_var['goods']['rec_id']; ?>" value="<?php echo $this->_var['goods']['goods_number']; ?>" size="4" class="number" onblur="if(isNaN(this.value)){alert('请输入数字');return false}else{document.getElementById('updatecart').click();}" title="<?php echo $this->_var['lang']['goods_number_tip']; ?>"/>
          <span class="goods_add" onclick="goods_add('<?php echo $this->_var['goods']['rec_id']; ?>');"></span> 
          <?php else: ?> 
          <?php echo $this->_var['goods']['goods_number']; ?> 
          <?php endif; ?></td>
        <td align="center" bgcolor="#FFFDEE"><?php echo $this->_var['goods']['subtotal']; ?></td>
        <td align="center" bgcolor="#FFFDEE"><a href="javascript:if (confirm('<?php echo $this->_var['lang']['drop_goods_confirm']; ?>')) location.href='flow.php?step=drop_goods&amp;id=<?php echo $this->_var['goods']['rec_id']; ?>'; " class="f6" style="color:#005AA0;"><?php echo $this->_var['lang']['drop']; ?></a> 
          <?php if ($_SESSION['user_id'] > 0 && $this->_var['goods']['extension_code'] != 'package_buy'): ?> 
          <a href="javascript:if (confirm('<?php echo $this->_var['lang']['drop_goods_confirm']; ?>')) location.href='flow.php?step=drop_to_collect&amp;id=<?php echo $this->_var['goods']['rec_id']; ?>'; " class="f6" style="color:#005AA0"><?php echo $this->_var['lang']['drop_to_collect']; ?></a> 
          <?php endif; ?></td>
      </tr>
      
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
      
       
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
      
    </table>
    <input type="hidden" name="step" value="update_cart" />
    <input name="submit111" type="submit" value="<?php echo $this->_var['lang']['update_cart']; ?>" style="display:none;"  id="updatecart" />
  </form>
  <div class="cart-toolbar clearfix">
    <div class="control fl"> <span class="delete"><b></b><a href="javascript:void(0);" onclick="location.href='flow.php?step=clear'">清空购物车</a></span> </div>
    <div id="cart_money_info" class="total fr" style="text-align:right; font-size:14px;"> 
      <?php if ($this->_var['discount'] > 0): ?><?php echo $this->_var['your_discount']; ?><br />
      <?php endif; ?> 
      <?php echo $this->_var['shopping_money']; ?><?php if ($this->_var['show_marketprice']): ?>，<?php echo $this->_var['market_price_desc']; ?><?php endif; ?> 
    </div>
  </div>
   
  <script type="text/javascript" charset="utf-8">
	function chkAll_onclick() 
	{
		for (var i=0;i<document.formCart.elements.length;i++)
		{
		var e = document.formCart.elements[i];
		if (e.name != 'chkAll') e.checked = document.formCart.chkAll.checked;
		}
		select_cart_goods();
	}
	function select_cart_goods()
	{
	      var sel_goods = new Array();
	      var obj_cartgoods = document.getElementsByName("sel_cartgoods[]");
	      var j=0;
	      for (i=0;i<obj_cartgoods.length;i++)
	      {
			if(obj_cartgoods[i].checked == true)
			{	
				sel_goods[j] = obj_cartgoods[i].value;
				j++;
			}
	      }
	      Ajax.call('flow.php', 'act=selcart&sel_goods=' + sel_goods, selcartResponse, 'GET', 'JSON');
	}
	function selcartResponse(res)
	{
	  if (res.err_msg.length > 0)
	  {
            alert(res.err_msg);
	  }
	  else
	  {
	     document.getElementById('cart_money_info').innerHTML=res.result;
	  }
	}
	function selcart_submit()
	{
	      var obj_cartgoods = document.getElementsByName("sel_cartgoods[]");
	      var j=0;
	      for (i=0;i<obj_cartgoods.length;i++)
	      {
			if(obj_cartgoods[i].checked == true)
			{	
				j++;
			}
	      }
	      if (j>0)
	      {
			document.formCart.action='flow.php?step=checkout';
			document.formCart.elements['step'].value='checkout';
			document.formCart.submit();
			return true;
	     }
	     else
	    {		
			alert('您还没有选择商品哦！');
			return false;
	    }
	}
	</script> 
  
  <div class="cart-button clearfix"> <a class="btn continue" href="index.php"  id="continue"><span class="btn-text" >继续购物</span></a> <a class="checkout" href="javascript:void(0);" onclick="return selcart_submit();"  id="toSettlement">去结算</a> </div>
  <?php
$this->assign('hot_1',get_hot_cat_goods('promote',12)); //1：对应分类ID ;20：显示数量
?>
  <DIV class="w w1" id=c-tabs style="margin-top:20px;" >
    <DIV class="m plist">
      <DIV class="cm fore1 curr" id=recommend-products 
data-widget="tab-item">
        <DIV class=cmt>
          <H3><I></I>购买了同样商品的顾客还购买了</H3>
        </DIV>
        <div class="roll">
          <div id=recommend-left></div>
          <DIV class=cmc id=some-buy  style="width:878px; overflow:hidden;">
            <div id="rollphoto1" class="rollcon"> 
              
              <?php if ($this->_var['hot_1']): ?> 
              
              
              <ul style="float:left;">
                <?php $_from = $this->_var['hot_1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['name']['iteration']++;
?>
                <LI>
                  <div  class="p-img"><a href='<?php echo $this->_var['goods']['url']; ?>' title='<?php echo htmlspecialchars($this->_var['goods']['name']); ?>' target='_blank'> <img src = '<?php echo $this->_var['goods']['thumb']; ?>' alt='<?php echo htmlspecialchars($this->_var['goods']['name']); ?>'   border='0'  width="130" height="130"/></a></div>
                  <p class='p-name'><a href='<?php echo $this->_var['goods']['url']; ?>' target='_blank' '<?php echo htmlspecialchars($this->_var['goods']['name']); ?>'><?php echo $this->_var['goods']['name']; ?></a></p>
                  <a href="javascript:addToCart(<?php echo $this->_var['goods']['id']; ?>)"><img src="themes/paimai/images/misc/lib/skin/i/adcart.gif" style="margin-top:5px;"/></a> </LI>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
              </ul>
              <?php endif; ?> 
            </div>
          </DIV>
          <div id="recommend-rigth"></div>
        </div>
      </DIV>
    </DIV>
  </DIV>
  <script language=javascript type=text/javascript>

		var scrollPic_01 = new ScrollPic();
		scrollPic_01.scrollContId   = "rollphoto1"; //内容容器ID
		scrollPic_01.arrLeftId      = "recommend-left";//左箭头ID
		scrollPic_01.arrRightId     = "recommend-rigth"; //右箭头ID

		scrollPic_01.frameWidth     = 878;//显示框宽度
		scrollPic_01.pageWidth      = 874; //翻页宽度

		scrollPic_01.speed          = 10; //移动速度(单位毫秒，越小越快)
		scrollPic_01.space          = 10; //每次移动像素(单位px，越大越快)
		scrollPic_01.autoPlay       = true; //自动播放
		scrollPic_01.autoPlayTime   = 3; //自动播放间隔时间(秒)

		scrollPic_01.initialize(); //初始化

</script> 
  <?php if ($_SESSION['user_id'] > 0): ?> 
  <?php echo $this->smarty_insert_scripts(array('files'=>'transport.js')); ?> 
  <script type="text/javascript" charset=utf-8>
        function collect_to_flow(goodsId)
        {
          var goods        = new Object();
          var spec_arr     = new Array();
          var fittings_arr = new Array();
          var number       = 1;
          goods.spec     = spec_arr;
          goods.goods_id = goodsId;
          goods.number   = number;
          goods.parent   = 0;
          Ajax.call('flow.php?step=add_to_cart', 'goods=' + goods.toJSONString(), collect_to_flow_response, 'POST', 'JSON');
        }
        function collect_to_flow_response(result)
        {
          if (result.error > 0)
          {
            // 如果需要缺货登记，跳转
            if (result.error == 2)
            {
              if (confirm(result.message))
              {
                location.href = 'user.php?act=add_booking&id=' + result.goods_id;
              }
            }
            else if (result.error == 6)
            {
              openSpeDiv(result.message, result.goods_id);
            }
            else
            {
              alert(result.message);
            }
          }
          else
          {
            location.href = 'flow.php';
          }
        }
      </script> 
  <?php endif; ?>
  
  
  <?php if ($this->_var['collection_goods']): ?>
  <div class="flowBox mod2"> <span class="lt"></span><span class="lb"></span><span class="rt"></span><span class="rb"></span>
    <h6><span><?php echo $this->_var['lang']['label_collection']; ?></span></h6>
    <table width="100%" align="center" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
      <?php $_from = $this->_var['collection_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
      <tr>
        <td bgcolor="#ffffff"><a href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" class="f6"><?php echo $this->_var['goods']['goods_name']; ?></a></td>
        <td bgcolor="#ffffff" align="center" width="100"><a href="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>)" class="f6"><?php echo $this->_var['lang']['collect_to_flow']; ?></a></td>
      </tr>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </table>
  </div>
  <?php endif; ?>
  
  
  <?php endif; ?> 
  
  <?php if ($this->_var['fittings_list']): ?> 
  <?php echo $this->smarty_insert_scripts(array('files'=>'transport.js')); ?> 
  <script type="text/javascript" charset=utf-8>
  function fittings_to_flow(goodsId,parentId)
  {
    var goods        = new Object();
    var spec_arr     = new Array();
    var number       = 1;
    goods.spec     = spec_arr;
    goods.goods_id = goodsId;
    goods.number   = number;
    goods.parent   = parentId;
    Ajax.call('flow.php?step=add_to_cart', 'goods=' + goods.toJSONString(), fittings_to_flow_response, 'POST', 'JSON');
  }
  function fittings_to_flow_response(result)
  {
    if (result.error > 0)
    {
      // 如果需要缺货登记，跳转
      if (result.error == 2)
      {
        if (confirm(result.message))
        {
          location.href = 'user.php?act=add_booking&id=' + result.goods_id;
        }
      }
      else if (result.error == 6)
      {
        openSpeDiv(result.message, result.goods_id, result.parent);
      }
      else
      {
        alert(result.message);
      }
    }
    else
    {
      location.href = 'flow.php';
    }
  }
  </script>
  <div class="block" >
    <div class="flowBox modd2"> <span class="lt"></span><span class="lb"></span><span class="rt"></span><span class="rb"></span>
      <h6><span><?php echo $this->_var['lang']['goods_fittings']; ?></span></h6>
      <form action="flow.php" method="post">
        <div class="flowGoodsFittings clearfix"> 
          <?php $_from = $this->_var['fittings_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'fittings');if (count($_from)):
    foreach ($_from AS $this->_var['fittings']):
?>
          <ul class="clearfix">
            <li class="goodsimg"> <a href="<?php echo $this->_var['fittings']['url']; ?>" target="_blank"><img src="<?php echo $this->_var['fittings']['goods_thumb']; ?>" alt="<?php echo htmlspecialchars($this->_var['fittings']['name']); ?>" class="B_blue" /></a> </li>
            <li> <a href="<?php echo $this->_var['fittings']['url']; ?>" target="_blank" title="<?php echo htmlspecialchars($this->_var['fittings']['goods_name']); ?>" class="f6"><?php echo htmlspecialchars($this->_var['fittings']['short_name']); ?></a><br />
              <?php echo $this->_var['lang']['fittings_price']; ?><font class="f1"><?php echo $this->_var['fittings']['fittings_price']; ?></font><br />
              <?php echo $this->_var['lang']['parent_name']; ?><?php echo $this->_var['fittings']['parent_short_name']; ?><br />
              <a href="javascript:fittings_to_flow(<?php echo $this->_var['fittings']['goods_id']; ?>,<?php echo $this->_var['fittings']['parent_id']; ?>)"><img src="themes/paimai/images/bnt_buy.gif" alt="<?php echo $this->_var['lang']['collect_to_flow']; ?>" /></a> </li>
          </ul>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
        </div>
      </form>
    </div>
  </div>
  
  <?php endif; ?> 
  
  <?php if ($this->_var['favourable_list']): ?>
  <div class="block">
    <div class="flowBox modd2"> <span class="lt"></span><span class="lb"></span><span class="rt"></span><span class="rb"></span>
      <h6><span><?php echo $this->_var['lang']['label_favourable']; ?></span></h6>
      <?php $_from = $this->_var['favourable_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'favourable');if (count($_from)):
    foreach ($_from AS $this->_var['favourable']):
?>
      <form action="flow.php" method="post">
        <table width="100%" align="center" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
          <tr>
            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['favourable_name']; ?></td>
            <td bgcolor="#ffffff"><strong><?php echo $this->_var['favourable']['act_name']; ?></strong></td>
          </tr>
          <tr>
            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['favourable_period']; ?></td>
            <td bgcolor="#ffffff"><?php echo $this->_var['favourable']['start_time']; ?> --- <?php echo $this->_var['favourable']['end_time']; ?></td>
          </tr>
          <tr>
            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['favourable_range']; ?></td>
            <td bgcolor="#ffffff"><?php echo $this->_var['lang']['far_ext'][$this->_var['favourable']['act_range']]; ?><br />
              <?php echo $this->_var['favourable']['act_range_desc']; ?></td>
          </tr>
          <tr>
            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['favourable_amount']; ?></td>
            <td bgcolor="#ffffff"><?php echo $this->_var['favourable']['formated_min_amount']; ?> --- <?php echo $this->_var['favourable']['formated_max_amount']; ?></td>
          </tr>
          <tr>
            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['favourable_type']; ?></td>
            <td bgcolor="#ffffff"><span class="STYLE1"><?php echo $this->_var['favourable']['act_type_desc']; ?></span> 
              <?php if ($this->_var['favourable']['act_type'] == 0): ?> 
              <?php $_from = $this->_var['favourable']['gift']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'gift');if (count($_from)):
    foreach ($_from AS $this->_var['gift']):
?><br />
              <input type="checkbox" value="<?php echo $this->_var['gift']['id']; ?>" name="gift[]" />
              <a href="goods.php?id=<?php echo $this->_var['gift']['id']; ?>" target="_blank" class="f6"><?php echo $this->_var['gift']['name']; ?></a> [<?php echo $this->_var['gift']['formated_price']; ?>] 
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
              <?php endif; ?></td>
          </tr>
          <?php if ($this->_var['favourable']['available']): ?>
          <tr>
            <td align="right" bgcolor="#ffffff">&nbsp;</td>
            <td align="center" bgcolor="#ffffff"><input type="image" src="themes/paimai/images/bnt_cat.gif" alt="Add to cart"  border="0" /></td>
          </tr>
          <?php endif; ?>
        </table>
        <input type="hidden" name="act_id" value="<?php echo $this->_var['favourable']['act_id']; ?>" />
        <input type="hidden" name="step" value="add_favourable" />
      </form>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
    </div>
  </div>
  <?php endif; ?> 
  
  <?php if ($this->_var['step'] == "consignee"): ?> 
  
  <div id="A_Stepbar" class="flowstep">
          <ol class="flowstep-5">
            <li class="step-first">
              <div class="step-done">
                <div class="step-name">查看购物车</div>
                <div class="step-no"></div>
              </div>
            </li>
            <li>
              <div class="step-name">拍下商品</div>
              <div class="step-no">2</div>
            </li>
            <li>
              <div class="step-name">付款</div>
              <div class="step-no">3</div>
            </li>
            <li>
              <div class="step-name">确认收货</div>
              <div class="step-no">4</div>
            </li>
            <li class="step-last">
              <div class="step-name">评价</div>
              <div class="step-no">5</div>
            </li>
          </ol>
        </div>
  <?php echo $this->smarty_insert_scripts(array('files'=>'region.js,utils.js')); ?> 
  <script type="text/javascript">
          region.isAdmin = false;
          <?php $_from = $this->_var['lang']['flow_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
          var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

          
          onload = function() {
            if (!document.all)
            {
              document.forms['theForm'].reset();
            }
          }
          
        </script> 
   
  <?php $_from = $this->_var['consignee_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('sn', 'consignee');if (count($_from)):
    foreach ($_from AS $this->_var['sn'] => $this->_var['consignee']):
?>
  <form action="flow.php" method="post" name="theForm" id="theForm" onsubmit="return checkConsignee(this)">
    <?php echo $this->fetch('library/consignee.lbi'); ?>
  </form>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
  <?php endif; ?> 
  
  <?php if ($this->_var['step'] == "checkout"): ?>
  <div id="A_Stepbar" class="flowstep">
          <ol class="flowstep-5">
            <li class="step-first">
              <div class="step-done">
                <div class="step-name">查看购物车</div>
                <div class="step-no"></div>
              </div>
            </li>
            <li>
            <div class="step-done">
              <div class="step-name">拍下商品</div>
              <div class="step-no">2</div>
            </div>
            </li>
            <li>
              <div class="step-name">付款</div>
              <div class="step-no">3</div>
            </li>
            <li>
              <div class="step-name">确认收货</div>
              <div class="step-no">4</div>
            </li>
            <li class="step-last">
              <div class="step-name">评价</div>
              <div class="step-no">5</div>
            </li>
          </ol>
        </div>
  
  <form action="flow.php" method="post" name="theForm" id="theForm" onsubmit="return checkOrderForm(this)">
    <script type="text/javascript">
        var flow_no_payment = "<?php echo $this->_var['lang']['flow_no_payment']; ?>";
        var flow_no_shipping = "<?php echo $this->_var['lang']['flow_no_shipping']; ?>";
        </script>
    <div class="pre_box w">
      <div class="title" style="background:#fff;" name="address_box" id="address_box">
        <div class="text"><?php echo $this->_var['lang']['goods_list']; ?> 
          <?php if ($this->_var['allow_edit_cart']): ?><a href="flow.php" class="orange fr" style="font-weight:bold; color:#FF6000;"><?php echo $this->_var['lang']['modify']; ?></a><?php endif; ?> 
        </div>
      </div>
      <table style="line-height:20px; border:#dddddd 1px solid;" width="100%" align="center"  cellpadding="5" cellspacing="1" bgcolor="#ffffff" >
        <tr>
          <th bgcolor="#eeeeee"><?php echo $this->_var['lang']['goods_name']; ?></th>
          <?php if ($this->_var['show_marketprice']): ?>
          <th bgcolor="#eeeeee"><?php echo $this->_var['lang']['market_prices']; ?></th>
          <?php endif; ?>
          <th bgcolor="#eeeeee"><?php if ($this->_var['gb_deposit']): ?><?php echo $this->_var['lang']['deposit']; ?><?php else: ?><?php echo $this->_var['lang']['shop_prices']; ?><?php endif; ?></th>
          <th bgcolor="#eeeeee"><?php echo $this->_var['lang']['number']; ?></th>
          <th bgcolor="#eeeeee"><?php echo $this->_var['lang']['subtotal']; ?></th>
        </tr>
        
        <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goodsinfo');if (count($_from)):
    foreach ($_from AS $this->_var['goodsinfo']):
?>
	<tr>
          <td  colspan=20 style="background:#DDEFFF; border-bottom:1px solid #ddd; font-weight:bold;" > <?php echo $this->_var['goodsinfo']['0']['seller']; ?></tr>
	<?php $_from = $this->_var['goodsinfo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['name']['iteration']++;
?>
        
        <tr <?php if (! ($this->_foreach['name']['iteration'] == $this->_foreach['name']['total'])): ?>class="pay-tr"<?php endif; ?>>
          <td bgcolor="#ffffff"><?php if ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] == 'package_buy'): ?> 
            <a href="javascript:void(0)" onclick="setSuitShow(<?php echo $this->_var['goods']['goods_id']; ?>)" class="f6"><?php echo $this->_var['goods']['goods_name']; ?><span style="margin-left:10px;"><?php echo nl2br($this->_var['goods']['goods_attr']); ?></span><span style="color:#FF0000;">（<?php echo $this->_var['lang']['remark_package']; ?>）</span></a>
            <div id="suit_<?php echo $this->_var['goods']['goods_id']; ?>" style="display:none"> 
              <?php $_from = $this->_var['goods']['package_goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'package_goods_list');if (count($_from)):
    foreach ($_from AS $this->_var['package_goods_list']):
?> 
              <a href="goods.php?id=<?php echo $this->_var['package_goods_list']['goods_id']; ?>" target="_blank" class="f6"><?php echo $this->_var['package_goods_list']['goods_name']; ?></a><br />
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
            </div>
            
            <?php else: ?>
            
            <div class="p-goods">
              <div class="p-img" style="float:left;"><a target="_blank" href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>"><img width="40" height="40" src="<?php echo $this->_var['goods']['goods_thumb']; ?>"></a></div>
              <div class="p-detail" style="float:left; margin-left:15px;">
                <div class="p-name"> <a target="_blank" href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>"><?php echo $this->_var['goods']['goods_name']; ?></a><?php if ($this->_var['goods']['parent_id'] > 0): ?> 
            <span style="color:#FF0000">（<?php echo $this->_var['lang']['accessories']; ?>）</span> 
            <?php elseif ($this->_var['goods']['is_gift']): ?> 
            <span style="color:#FF0000">（<?php echo $this->_var['lang']['largess']; ?>）</span> 
            <?php endif; ?>  </div>
             <?php if ($this->_var['goods']['goods_attr']): ?>   <div class="p-more">商品属性：<?php echo $this->_var['goods']['goods_attr']; ?>&nbsp;</div><?php endif; ?> 
              </div>
            </div>
            <?php endif; ?> 
            <?php if ($this->_var['goods']['is_shipping']): ?>(<span style="color:#FF0000"><?php echo $this->_var['lang']['free_goods']; ?></span>)<?php endif; ?></td>
          <?php if ($this->_var['show_marketprice']): ?>
          <td align="center" bgcolor="#ffffff"><?php echo $this->_var['goods']['formated_market_price']; ?></td>
          <?php endif; ?>
          <td bgcolor="#ffffff" align="center"><?php echo $this->_var['goods']['formated_goods_price']; ?></td>
          <td bgcolor="#ffffff" align="center"><?php echo $this->_var['goods']['goods_number']; ?></td>
          <td bgcolor="#ffffff" align="center"><?php echo $this->_var['goods']['formated_subtotal']; ?></td>
        </tr>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

        <?php if (! $this->_var['gb_deposit']): ?>
        <tr>
          <td bgcolor="#ffffff" colspan="7" style="font-size:14px; height:40px; line-height:40px; border-top:#F0F0F0 1px solid;"><?php if ($this->_var['discount'] > 0): ?><?php echo $this->_var['your_discount']; ?><br />
            <?php endif; ?> 
            <?php echo $this->_var['shopping_money']; ?><?php if ($this->_var['show_marketprice']): ?>，<?php echo $this->_var['market_price_desc']; ?><?php endif; ?></td>
        </tr>
        <?php endif; ?>
      </table>
    </div>
    
    <div class="pre_box w">
      <div class="title" name="address_box" id="address_box">
        <div class="text"><?php echo $this->_var['lang']['consignee_info']; ?> <a href="flow.php?step=consignee" class="orange fr"  style="font-weight:bold; color:#FF6000;"><?php echo $this->_var['lang']['modify']; ?></a> </div>
      </div>
      <table style="line-height:30px; padding:5px; text-indent:5px; border:#dddddd 1px solid; border-top:none;" width="100%" align="center"  cellpadding="5" cellspacing="1" bgcolor="#ffffff">
        <tr>
          <td bgcolor="#ffffff"><?php echo htmlspecialchars($this->_var['consignee']['consignee']); ?><span class="td-address"><?php echo htmlspecialchars($this->_var['consignee']['email']); ?></span><span class="td-address"><?php echo $this->_var['consignee']['tel']; ?></span><span class="td-address"><?php echo htmlspecialchars($this->_var['consignee']['mobile']); ?></span></td>
        </tr>
        <?php if ($this->_var['total']['real_goods_count'] > 0): ?>
        <tr>
          <td bgcolor="#ffffff"><?php echo htmlspecialchars($this->_var['consignee']['address']); ?><span class="td-address"><?php echo htmlspecialchars($this->_var['consignee']['zipcode']); ?></span></td>
        </tr>
        <?php endif; ?>
        <?php if ($this->_var['total']['real_goods_count'] > 0): ?>
        <tr>
          <td bgcolor="#ffffff"><?php echo htmlspecialchars($this->_var['consignee']['sign_building']); ?><span class="td-address"><?php echo htmlspecialchars($this->_var['consignee']['best_time']); ?></span></td>
        </tr>
        <?php endif; ?>
      </table>
    </div>
    
    <?php if ($this->_var['total']['real_goods_count'] != 0): ?>
    <div class="pre_box w">
      <div class="title" name="address_box" id="address_box" style="background:#ffffff;">
        <div class="text"><?php echo $this->_var['lang']['shipping_method']; ?> </div>
      </div>
      <table align="center" border="0" cellpadding="5" cellspacing="1" bgcolor="#ffffff" id="shippingTable" style="border:#dddddd 1px solid;">
        <tr>
          <th bgcolor="#eeeeee" width="5%">&nbsp;</th>
          <th bgcolor="#eeeeee" width="25%" ><?php echo $this->_var['lang']['name']; ?></th>
          <th bgcolor="#eeeeee"><?php echo $this->_var['lang']['describe']; ?></th>
          <th bgcolor="#eeeeee" width="15%"><?php echo $this->_var['lang']['fee']; ?></th>
          <th bgcolor="#eeeeee" width="15%"><?php echo $this->_var['lang']['free_money']; ?></th>
          <th bgcolor="#eeeeee" width="15%"><?php echo $this->_var['lang']['insure_fee']; ?></th>
        </tr>
        <?php $_from = $this->_var['shipping_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'shipping');if (count($_from)):
    foreach ($_from AS $this->_var['shipping']):
?>
        <tr class="pay-tr">
          <td bgcolor="#ffffff" valign="center"><input name="shipping" type="radio" value="<?php echo $this->_var['shipping']['shipping_id']; ?>" <?php if ($this->_var['order']['shipping_id'] == $this->_var['shipping']['shipping_id']): ?>checked="true"<?php endif; ?> supportCod="<?php echo $this->_var['shipping']['support_cod']; ?>" insure="<?php echo $this->_var['shipping']['insure']; ?>" onclick="selectShipping(this)" /></td>
          <td bgcolor="#ffffff" valign="center"><strong><?php echo $this->_var['shipping']['shipping_name']; ?></strong></td>
          <td bgcolor="#ffffff" valign="center"><?php echo $this->_var['shipping']['shipping_desc']; ?></td>
          <td bgcolor="#ffffff" align="center" valign="center"><?php echo $this->_var['shipping']['format_shipping_fee']; ?></td>
          <td bgcolor="#ffffff" align="center" valign="center"><?php echo $this->_var['shipping']['free_money']; ?></td>
          <td bgcolor="#ffffff" align="center" valign="center"><?php if ($this->_var['shipping']['insure'] != 0): ?><?php echo $this->_var['shipping']['insure_formated']; ?><?php else: ?><?php echo $this->_var['lang']['not_support_insure']; ?><?php endif; ?></td>
        </tr>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <tr>
          <td colspan="6" bgcolor="#ffffff" align="right"><label for="ECS_NEEDINSURE">
              <input name="need_insure" id="ECS_NEEDINSURE" type="checkbox"  onclick="selectInsure(this.checked)" value="1" <?php if ($this->_var['order']['need_insure']): ?>checked="true"<?php endif; ?> <?php if ($this->_var['insure_disabled']): ?>disabled="true"<?php endif; ?>  />
              <?php echo $this->_var['lang']['need_insure']; ?> </label></td>
        </tr>
      </table>
    </div>
    
    <div id="supplier_shipping" class="w" style="line-height:25px;"> <?php echo $this->fetch('library/order_supplier_shipping.lbi'); ?> </div>
     
    
    <?php else: ?>
    <input name = "shipping" type="radio" value = "-1" checked="checked"  style="display:none"/>
    <?php endif; ?> 
    
    <?php if ($this->_var['total']['real_goods_count'] != 0): ?>
    <div class="pre_box w"  style=" display:none" >
      <div class="title" name="address_box" id="address_box">
        <div class="text"><?php echo $this->_var['lang']['shipping_method']; ?></div>
      </div>
      <table style=" display:none" width="100%" align="center"  cellpadding="5" cellspacing="1" bgcolor="#dddddd" id="shippingTable">
        <tr>
          <th bgcolor="#ffffff" width="5%">&nbsp;</th>
          <th bgcolor="#ffffff" width="25%"><?php echo $this->_var['lang']['name']; ?></th>
          <th bgcolor="#ffffff"><?php echo $this->_var['lang']['describe']; ?></th>
          <th bgcolor="#ffffff" width="15%"><?php echo $this->_var['lang']['fee']; ?></th>
          <th bgcolor="#ffffff" width="15%"><?php echo $this->_var['lang']['free_money']; ?></th>
          <th bgcolor="#ffffff" width="15%"><?php echo $this->_var['lang']['insure_fee']; ?></th>
        </tr>
        <?php $_from = $this->_var['shipping_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'shipping');if (count($_from)):
    foreach ($_from AS $this->_var['shipping']):
?>
        <tr class="pay-tr">
          <td bgcolor="#ffffff" valign="center"><input name="shipping" type="radio" value="<?php echo $this->_var['shipping']['shipping_id']; ?>" checked="true" supportCod="<?php echo $this->_var['shipping']['support_cod']; ?>" insure="<?php echo $this->_var['shipping']['insure']; ?>" onclick="selectShipping(this)" /></td>
          <td bgcolor="#ffffff" valign="center"><strong><?php echo $this->_var['shipping']['shipping_name']; ?></strong></td>
          <td bgcolor="#ffffff" valign="center"><?php echo $this->_var['shipping']['shipping_desc']; ?></td>
          <td bgcolor="#ffffff" align="center" valign="center"><?php echo $this->_var['shipping']['format_shipping_fee']; ?></td>
          <td bgcolor="#ffffff" align="center" valign="center"><?php echo $this->_var['shipping']['free_money']; ?></td>
          <td bgcolor="#ffffff" align="center" valign="center"><?php if ($this->_var['shipping']['insure'] != 0): ?><?php echo $this->_var['shipping']['insure_formated']; ?><?php else: ?><?php echo $this->_var['lang']['not_support_insure']; ?><?php endif; ?></td>
        </tr>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <tr>
          <td colspan="6" bgcolor="#ffffff" align="center"><label for="ECS_NEEDINSURE">
              <input name="need_insure" id="ECS_NEEDINSURE" type="checkbox"  onclick="selectInsure(this.checked)" value="1" <?php if ($this->_var['order']['need_insure']): ?>checked="true"<?php endif; ?> <?php if ($this->_var['insure_disabled']): ?>disabled="true"<?php endif; ?>  />
              <?php echo $this->_var['lang']['need_insure']; ?> </label></td>
        </tr>
      </table>
    </div>
    
    <?php else: ?>
    <input name = "shipping" type="radio" value = "-1" checked="checked"  style="display:none"/>
    <?php endif; ?> 
    <?php if ($this->_var['is_exchange_goods'] != 1 || $this->_var['total']['real_goods_count'] != 0): ?>
    <div class="pre_box w">
      <div class="title" name="address_box" id="address_box" style="background:#ffffff;">
        <div class="text"><?php echo $this->_var['lang']['payment_method']; ?></div>
      </div>
      <table style="line-height:20px; border:#dddddd 1px solid;" width="100%" align="center"  cellpadding="5" cellspacing="1" bgcolor="#ffffff" id="paymentTable">
        <tr>
          <th width="5%" bgcolor="#eeeeee">&nbsp;</th>
          <th width="20%" bgcolor="#eeeeee"><?php echo $this->_var['lang']['name']; ?></th>
          <th bgcolor="#eeeeee"><?php echo $this->_var['lang']['describe']; ?></th>
          <th bgcolor="#eeeeee" width="15%"><?php echo $this->_var['lang']['pay_fee']; ?></th>
        </tr>
        <?php $_from = $this->_var['payment_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'payment');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['payment']):
        $this->_foreach['name']['iteration']++;
?> 
         
        
        <?php if ($this->_var['payment']['pay_code'] == 'alipay_bank'): ?>
        <tr <?php if (! ($this->_foreach['name']['iteration'] == $this->_foreach['name']['total'])): ?>class="pay-tr"<?php endif; ?>>
          <td bgcolor="#ffffff" colspan=2 style="padding-left:30px;"><input style="display:none;" type="radio" name="payment" id="alipay_bank" value="<?php echo $this->_var['payment']['pay_id']; ?>" <?php if ($this->_var['order']['pay_id'] == $this->_var['payment']['pay_id']): ?>checked<?php endif; ?> isCod="<?php echo $this->_var['payment']['is_cod']; ?>" onclick="selectPayment(this)" <?php if ($this->_var['cod_disabled'] && $this->_var['payment']['is_cod'] == "1"): ?>disabled="true"<?php endif; ?>/>
            <strong><?php echo $this->_var['payment']['pay_name']; ?></strong></td>
          <td valign="center" bgcolor="#ffffff"><?php echo $this->fetch('library/alipay_bank.lbi'); ?></td>
          <td align="center" bgcolor="#ffffff" valign="center"><?php echo $this->_var['payment']['format_pay_fee']; ?></td>
        </tr>
        <?php else: ?>
        <tr <?php if (! ($this->_foreach['name']['iteration'] == $this->_foreach['name']['total'])): ?>class="pay-tr"<?php endif; ?>>
          <td valign="center" bgcolor="#ffffff"><input type="radio" name="payment" value="<?php echo $this->_var['payment']['pay_id']; ?>" <?php if ($this->_var['order']['pay_id'] == $this->_var['payment']['pay_id']): ?>checked<?php endif; ?> isCod="<?php echo $this->_var['payment']['is_cod']; ?>" onclick="clear_radio_alipay_bank();selectPayment(this)" <?php if ($this->_var['cod_disabled'] && $this->_var['payment']['is_cod'] == "1"): ?>disabled="true"<?php endif; ?>/></td>
          <td valign="center" bgcolor="#ffffff"><strong><?php echo $this->_var['payment']['pay_name']; ?></strong></td>
          <td cvalign="center" bgcolor="#ffffff"> <?php echo $this->_var['payment']['pay_desc']; ?> </td>
          <td align="center" bgcolor="#ffffff" valign="center"><?php echo $this->_var['payment']['format_pay_fee']; ?></td>
        </tr>
        <?php endif; ?>
         
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      </table>
    </div>
    <?php else: ?>
    <input name = "payment" type="radio" value = "-1" checked="checked"  style="display:none"/>
    <?php endif; ?>
    
    <?php if ($this->_var['pack_list']): ?>
    <div class="pre_box w">
      <div class="title" name="address_box" id="address_box" style="background:#ffffff;">
        <div class="text"><?php echo $this->_var['lang']['goods_package']; ?></div>
      </div>
      <table style="line-height:20px; text-indent:5px; border:#dddddd 1px solid;" width="100%" align="center"  cellpadding="5" cellspacing="1" bgcolor="#ffffff" id="packTable" >
        <tr>
          <th width="5%" scope="col" bgcolor="#eeeeee">&nbsp;</th>
          <th width="35%" scope="col" bgcolor="#eeeeee"><?php echo $this->_var['lang']['name']; ?></th>
          <th width="22%" scope="col" bgcolor="#eeeeee"><?php echo $this->_var['lang']['price']; ?></th>
          <th width="22%" scope="col" bgcolor="#eeeeee"><?php echo $this->_var['lang']['free_money']; ?></th>
          <th scope="col" bgcolor="#eeeeee"><?php echo $this->_var['lang']['img']; ?></th>
        </tr>
        <tr>
          <td valign="center" bgcolor="#ffffff"><input type="radio" name="pack" value="0" <?php if ($this->_var['order']['pack_id'] == 0): ?>checked="true"<?php endif; ?> onclick="selectPack(this)" /></td>
          <td valign="center" bgcolor="#ffffff"><strong><?php echo $this->_var['lang']['no_pack']; ?></strong></td>
          <td valign="center" bgcolor="#ffffff">&nbsp;</td>
          <td valign="center" bgcolor="#ffffff">&nbsp;</td>
          <td valign="center" bgcolor="#ffffff">&nbsp;</td>
        </tr>
        <?php $_from = $this->_var['pack_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'pack');if (count($_from)):
    foreach ($_from AS $this->_var['pack']):
?>
        <tr>
          <td valign="center" bgcolor="#ffffff"><input type="radio" name="pack" value="<?php echo $this->_var['pack']['pack_id']; ?>" <?php if ($this->_var['order']['pack_id'] == $this->_var['pack']['pack_id']): ?>checked="true"<?php endif; ?> onclick="selectPack(this)" /></td>
          <td valign="center" bgcolor="#ffffff"><strong><?php echo $this->_var['pack']['pack_name']; ?></strong></td>
          <td valign="center" bgcolor="#ffffff" align="center"><?php echo $this->_var['pack']['format_pack_fee']; ?></td>
          <td valign="center" bgcolor="#ffffff" align="center"><?php echo $this->_var['pack']['format_free_money']; ?></td>
          <td valign="center" bgcolor="#ffffff" align="center"><?php if ($this->_var['pack']['pack_img']): ?> 
            <a href="data/packimg/<?php echo $this->_var['pack']['pack_img']; ?>" target="_blank" class="f6"><?php echo $this->_var['lang']['view']; ?></a> 
            <?php else: ?> 
            <?php echo $this->_var['lang']['no']; ?> 
            <?php endif; ?></td>
        </tr>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      </table>
    </div>
    
    <?php endif; ?> 
    
    <?php if ($this->_var['card_list']): ?>
    <div class="pre_box w">
      <div class="title" name="address_box" id="address_box" style="background:#ffffff;">
        <div class="text"><?php echo $this->_var['lang']['goods_card']; ?></div>
      </div>
      <table style="line-height:20px; border:#dddddd 1px solid; text-indent:5px;" width="100%" align="center"  cellpadding="5" cellspacing="1" bgcolor="#ffffff" id="cardTable">
        <tr>
          <th bgcolor="#eeeeee" width="5%" scope="col">&nbsp;</th>
          <th bgcolor="#eeeeee" width="35%" scope="col"><?php echo $this->_var['lang']['name']; ?></th>
          <th bgcolor="#eeeeee" width="22%" scope="col"><?php echo $this->_var['lang']['price']; ?></th>
          <th bgcolor="#eeeeee" width="22%" scope="col"><?php echo $this->_var['lang']['free_money']; ?></th>
          <th bgcolor="#eeeeee" scope="col"><?php echo $this->_var['lang']['img']; ?></th>
        </tr>
        <tr>
          <td bgcolor="#ffffff" valign="center"><input type="radio" name="card" value="0" <?php if ($this->_var['order']['card_id'] == 0): ?>checked="true"<?php endif; ?> onclick="selectCard(this)" /></td>
          <td bgcolor="#ffffff" valign="center"><strong><?php echo $this->_var['lang']['no_card']; ?></strong></td>
          <td bgcolor="#ffffff" valign="center">&nbsp;</td>
          <td bgcolor="#ffffff" valign="center">&nbsp;</td>
          <td bgcolor="#ffffff" valign="center">&nbsp;</td>
        </tr>
        <?php $_from = $this->_var['card_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'card');if (count($_from)):
    foreach ($_from AS $this->_var['card']):
?>
        <tr>
          <td valign="center" bgcolor="#ffffff"><input type="radio" name="card" value="<?php echo $this->_var['card']['card_id']; ?>" <?php if ($this->_var['order']['card_id'] == $this->_var['card']['card_id']): ?>checked="true"<?php endif; ?> onclick="selectCard(this)"  /></td>
          <td valign="center" bgcolor="#ffffff"><strong><?php echo $this->_var['card']['card_name']; ?></strong></td>
          <td valign="center" align="center" bgcolor="#ffffff"><?php echo $this->_var['card']['format_card_fee']; ?></td>
          <td valign="center" align="center" bgcolor="#ffffff"><?php echo $this->_var['card']['format_free_money']; ?></td>
          <td valign="center" align="center" bgcolor="#ffffff"><?php if ($this->_var['card']['card_img']): ?> 
            <a href="data/cardimg/<?php echo $this->_var['card']['card_img']; ?>" target="_blank" class="f6"><?php echo $this->_var['lang']['view']; ?></a> 
            <?php else: ?> 
            <?php echo $this->_var['lang']['no']; ?> 
            <?php endif; ?></td>
        </tr>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <tr>
          <td bgcolor="#ffffff"></td>
          <td bgcolor="#ffffff" valign="top"><strong><?php echo $this->_var['lang']['bless_note']; ?>:</strong></td>
          <td bgcolor="#ffffff" colspan="3"><textarea name="card_message" cols="60" rows="3" style="width:auto; border:1px solid #ccc;"><?php echo htmlspecialchars($this->_var['order']['card_message']); ?></textarea></td>
        </tr>
      </table>
    </div>
    
    <?php endif; ?>
    
    <div class="pre_box w">
      <div class="title" name="address_box" id="address_box">
        <div class="text"><?php echo $this->_var['lang']['other_info']; ?></div>
      </div>
      <table style="line-height:30px; padding:5px; text-indent:5px;border:#dddddd 1px solid; border-top:none;" width="100%" align="center"  cellpadding="5" cellspacing="1" bgcolor="#ffffff">
        <?php if ($this->_var['allow_use_surplus']): ?>
        <tr>
          <td width="9%" bgcolor="#ffffff"><strong><?php echo $this->_var['lang']['use_surplus']; ?>: </strong></td>
          <td bgcolor="#ffffff"><input name="surplus" type="text" class="inputBg" id="ECS_SURPLUS" size="10" value="<?php echo empty($this->_var['order']['surplus']) ? '0' : $this->_var['order']['surplus']; ?>" onblur="changeSurplus(this.value)" <?php if ($this->_var['disable_surplus']): ?>disabled="disabled"<?php endif; ?> />
            <?php echo $this->_var['lang']['your_surplus']; ?><?php echo empty($this->_var['your_surplus']) ? '0' : $this->_var['your_surplus']; ?> <span id="ECS_SURPLUS_NOTICE" class="notice"></span></td>
        </tr>
        <?php endif; ?> 
        <?php if ($this->_var['allow_use_integral']): ?>
        <tr>
          <td bgcolor="#ffffff"><strong><?php echo $this->_var['lang']['use_integral']; ?></strong></td>
          <td bgcolor="#ffffff"><input name="integral" type="text" class="inputBg" id="ECS_INTEGRAL" onblur="changeIntegral(this.value)" value="<?php echo empty($this->_var['order']['integral']) ? '0' : $this->_var['order']['integral']; ?>" size="10" />
            <?php echo $this->_var['lang']['can_use_integral']; ?>:<?php echo empty($this->_var['your_integral']) ? '0' : $this->_var['your_integral']; ?> <?php echo $this->_var['points_name']; ?>，<?php echo $this->_var['lang']['noworder_can_integral']; ?><?php echo $this->_var['order_max_integral']; ?>  <?php echo $this->_var['points_name']; ?>. <span id="ECS_INTEGRAL_NOTICE" class="notice"></span></td>
        </tr>
        <?php endif; ?> 
        <?php if ($this->_var['allow_use_bonus']): ?>
        <tr>
          <td bgcolor="#ffffff"><strong><?php echo $this->_var['lang']['use_bonus']; ?>:</strong></td>
          <td bgcolor="#ffffff"> <?php echo $this->_var['lang']['select_bonus']; ?>
            <select name="bonus" onchange="changeBonus(this.value)" id="ECS_BONUS" style="border:1px solid #ccc;">
              <option value="0" <?php if ($this->_var['order']['bonus_id'] == 0): ?>selected<?php endif; ?>><?php echo $this->_var['lang']['please_select']; ?></option>
              <?php $_from = $this->_var['bonus_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'bonus');if (count($_from)):
    foreach ($_from AS $this->_var['bonus']):
?>
              <option value="<?php echo $this->_var['bonus']['bonus_id']; ?>" <?php if ($this->_var['order']['bonus_id'] == $this->_var['bonus']['bonus_id']): ?>selected<?php endif; ?>><?php echo $this->_var['bonus']['type_name']; ?>[<?php echo $this->_var['bonus']['bonus_money_formated']; ?>]</option>
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </select>
            <?php echo $this->_var['lang']['input_bonus_no']; ?>
            <input name="bonus_sn" type="text" class="inputBg" size="15" value="<?php echo $this->_var['order']['bonus_sn']; ?>"/>
            <input name="validate_bonus" type="button" class="bnt_blue_1" value="<?php echo $this->_var['lang']['validate_bonus']; ?>" onclick="validateBonus(document.forms['theForm'].elements['bonus_sn'].value)" /></td>
        </tr>
        <?php endif; ?> 
        <?php if ($this->_var['inv_content_list']): ?>
        <tr>
          <td bgcolor="#ffffff"><strong><?php echo $this->_var['lang']['invoice']; ?>:</strong>
           </td>
          <td bgcolor="#ffffff"> <input name="need_inv" type="checkbox"  class="input" style="width:20px;" id="ECS_NEEDINV" onclick="changeNeedInv()" value="1" <?php if ($this->_var['order']['need_inv']): ?>checked="true"<?php endif; ?> /><?php if ($this->_var['inv_type_list']): ?> 
            <?php echo $this->_var['lang']['invoice_type']; ?>
            <select name="inv_type" id="ECS_INVTYPE" <?php if ($this->_var['order']['need_inv'] != 1): ?>disabled="true"<?php endif; ?> onchange="changeNeedInv()" style="border:1px solid #ccc;">
              
                <?php echo $this->html_options(array('options'=>$this->_var['inv_type_list'],'selected'=>$this->_var['order']['inv_type'])); ?>
            </select>
            
            <?php endif; ?> 
            <?php echo $this->_var['lang']['invoice_title']; ?>
            <input name="inv_payee" type="text"  class="input" id="ECS_INVPAYEE" size="20" <?php if (! $this->_var['order']['need_inv']): ?>disabled="true"<?php endif; ?> value="<?php echo $this->_var['order']['inv_payee']; ?>" onblur="changeNeedInv()" />
            <?php echo $this->_var['lang']['invoice_content']; ?>
            <select name="inv_content" id="ECS_INVCONTENT" <?php if ($this->_var['order']['need_inv'] != 1): ?>disabled="true"<?php endif; ?>  onchange="changeNeedInv()" style="border:1px solid #ccc;">
              

                <?php echo $this->html_options(array('values'=>$this->_var['inv_content_list'],'output'=>$this->_var['inv_content_list'],'selected'=>$this->_var['order']['inv_content'])); ?>

                
            </select></td>
        </tr>
        <?php endif; ?>
        <tr>
          <td valign="center" bgcolor="#ffffff"><strong><?php echo $this->_var['lang']['order_postscript']; ?>:</strong></td>
          <td bgcolor="#ffffff"><textarea name="postscript" cols="80" rows="3" id="postscript" style="border:1px solid #ccc;"><?php echo htmlspecialchars($this->_var['order']['postscript']); ?></textarea></td>
        </tr>
        <?php if ($this->_var['how_oos_list']): ?>
        <tr>
          <td bgcolor="#ffffff"><strong><?php echo $this->_var['lang']['booking_process']; ?>:</strong></td>
          <td bgcolor="#ffffff"><?php $_from = $this->_var['how_oos_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('how_oos_id', 'how_oos_name');if (count($_from)):
    foreach ($_from AS $this->_var['how_oos_id'] => $this->_var['how_oos_name']):
?>
            
            <label>
              <input name="how_oos" type="radio" value="<?php echo $this->_var['how_oos_id']; ?>" <?php if ($this->_var['order']['how_oos'] == $this->_var['how_oos_id']): ?>checked<?php endif; ?> onclick="changeOOS(this)" />
              <?php echo $this->_var['how_oos_name']; ?></label>
            
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?></td>
        </tr>
        <?php endif; ?>
      </table>
    </div>
    
    <div class="pre_box w">
      <div class="title" name="address_box" id="address_box">
        <div class="text"><?php echo $this->_var['lang']['fee_total']; ?></div>
      </div>
      <?php echo $this->fetch('library/order_total.lbi'); ?>
      <div align="center" style="margin:20px auto;">
        <input type="image" src="themes/paimai/images/jmpic/btn_done.gif" />
        <input type="hidden" name="step" value="done" />
      </div>
    </div>
  </form>
  <?php endif; ?> 
  
  <?php if ($this->_var['step'] == "done"): ?> 
  
  <div id="A_Stepbar" class="flowstep" style="right:166px;">
          <ol class="flowstep-5">
            <li class="step-first">
              <div class="step-done">
                <div class="step-name">查看购物车</div>
                <div class="step-no"></div>
              </div>
            </li>
            <li>
            <div class="step-done">
              <div class="step-name">拍下商品</div>
              <div class="step-no"></div>
            </div>
            </li>
            <li>
              <div class="step-name">付款</div>
              <div class="step-no">3</div>
            </li>
            <li>
              <div class="step-name">确认收货</div>
              <div class="step-no">4</div>
            </li>
            <li class="step-last">
              <div class="step-name">评价</div>
              <div class="step-no">5</div>
            </li>
          </ol>
        </div>
         <div class="flowBox checkBox_jm" style="margin:30px auto 70px auto;">
      <h6 style="text-align:center; height:30px; line-height:30px;color:#c40000">订单提交成功！</h6>
  <table width="99%" align="center" border="0" cellpadding="15" cellspacing="0" bgcolor="#fff" class="split_order" style="border:1px solid #ddd; margin:20px auto;">
    <tr>
      <td style="padding-bottom:10px;"> <?php if ($this->_var['split_order']['sub_order_count'] > 1): ?>
        <p style="padding-bottom:10px;font-weight:bold;">由于您的商品由不同的商家发出，此订单将分为<font style="color:#ff3300;"><?php echo $this->_var['split_order']['sub_order_count']; ?></font>个不同的子订单配送：</p>
        <?php endif; ?>
        <table width="100%" align=left cellpadding=0 cellspacing=0 bgcolor="#fff"  style="border:1px solid #ddd;border-bottom:none">
          <?php $_from = $this->_var['split_order']['suborder_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'suborder');if (count($_from)):
    foreach ($_from AS $this->_var['suborder']):
?>
          <tr >
            <td style="border-bottom:1px solid #ddd;padding-left:15px;background:#FAFAFA" height=30>订单号：<?php echo $this->_var['suborder']['order_sn']; ?></td>
            <td style="border-bottom:1px solid #ddd;background:#FAFAFA"><?php echo $this->_var['order']['pay_name']; ?>：<?php echo $this->_var['suborder']['order_amount_formated']; ?></td>
            <td style="border-bottom:1px solid #ddd;background:#FAFAFA"><?php echo $this->_var['order']['shipping_name']; ?>&nbsp;&nbsp;&nbsp;<?php echo $this->_var['order']['best_time']; ?></td>
          </tr>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </table></td>
    </tr>
    <tr>
      <td align="center" style="padding-bottom:30px;"> <?php if ($this->_var['pay_online']): ?>
        <?php echo $this->_var['pay_online']; ?>
        <?php else: ?> <a href="user.php?act=order_list"><img src="themes/paimai/images/btn_my_orders.gif" border=0 align="absmiddle"></a>&nbsp;&nbsp;&nbsp;&nbsp;<font color=#999999>订单已经提交成功</font> <?php endif; ?> </td>
    </tr>
  </table>
  <style>
  		  table.split_order tbody{background:#fff}
          .submit_back a{color:#F00;}
          </style>
          </div>
  <?php endif; ?> 
  <?php if ($this->_var['step'] == "login"): ?> 
<?php echo $this->smarty_insert_scripts(array('files'=>'utils.js,user.js')); ?> 
<script type="text/javascript">
        <?php $_from = $this->_var['lang']['flow_login_register']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
          var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

        
        function checkLoginForm(frm) {
          if (Utils.isEmpty(frm.elements['username'].value)) {
            alert(username_not_null);
            return false;
          }

          if (Utils.isEmpty(frm.elements['password'].value)) {
            alert(password_not_null);
            return false;
          }

          return true;
        }

        function checkSignupForm(frm) {
          if (Utils.isEmpty(frm.elements['username'].value)) {
            alert(username_not_null);
            return false;
          }
		 if(Utils.trim(frm.elements['username'].value).match(/[\u4e00-\u9fa5]/))
		  {
			alert(username_chana);
			return false;
		  }
          if (Utils.trim(frm.elements['username'].value).match(/^\s*$|^c:\\con\\con$|[%,\'\*\"\s\t\<\>\&\\]/))
          {
            alert(username_invalid);
            return false;
          }

          if (Utils.isEmpty(frm.elements['email'].value)) {
            alert(email_not_null);
            return false;
          }

          if (!Utils.isEmail(frm.elements['email'].value)) {
            alert(email_invalid);
            return false;
          }

          if (Utils.isEmpty(frm.elements['password'].value)) {
            alert(password_not_null);
            return false;
          }

          if (frm.elements['password'].value.length < 6) {
            alert(password_lt_six);
            return false;
          }

          if (frm.elements['password'].value != frm.elements['confirm_password'].value) {
            alert(password_not_same);
            return false;
          }
          return true;
        }
        
        </script> 

  <div id="A_Stepbar" class="flowstep">
          <ol class="flowstep-5">
            <li class="step-first">
              <div class="step-done">
                <div class="step-name">查看购物车</div>
                <div class="step-no"></div>
              </div>
            </li>
            <li>
              <div class="step-name">拍下商品</div>
              <div class="step-no">2</div>
            </li>
            <li>
              <div class="step-name">付款</div>
              <div class="step-no">3</div>
            </li>
            <li>
              <div class="step-name">确认收货</div>
              <div class="step-no">4</div>
            </li>
            <li class="step-last">
              <div class="step-name">评价</div>
              <div class="step-no">5</div>
            </li>
          </ol>
        </div>
        <div class="blank10"></div>
  <div class="flowBox ">
    <table width="100%" align="center" border="0" cellpadding="5" cellspacing="0" bgcolor="#ffffff">
      <tr>
        <td width="50%" valign="top"><h6 style=" height:32px; line-height:32px;"><span>用户登录：</span></h6>
          <form action="flow.php?step=login" method="post" name="loginForm" id="loginForm" onsubmit="return checkLoginForm(this)">
            <table width="90%" border="0" cellpadding="8" cellspacing="0" bgcolor="#ffffff" class="table">
              <tr>
                <td><div align="right"><strong><?php echo $this->_var['lang']['username']; ?></strong></div></td>
                <td><input name="username" type="text" class="inputBg" id="username" /></td>
              </tr>
              <tr>
                <td><div align="right"><strong><?php echo $this->_var['lang']['password']; ?></strong></div></td>
                <td><input name="password" class="inputBg" type="password" /></td>
              </tr>
              <?php if ($this->_var['enabled_login_captcha']): ?>
              <tr>
                <td><div align="right"><strong><?php echo $this->_var['lang']['comment_captcha']; ?>:</strong></div></td>
                <td><input type="text" size="8" name="captcha" class="inputBg" />
                  <img src="captcha.php?is_login=1&<?php echo $this->_var['rand']; ?>" alt="captcha" style="cursor: pointer; vertical-align:bottom" onClick="this.src='captcha.php?is_login=1&'+Math.random()" /></td>
              </tr>
              <?php endif; ?>
              <tr>
                <td></td>
                <td><input type="checkbox" value="1" name="remember" id="remember" />
                  <label for="remember"><?php echo $this->_var['lang']['remember']; ?></label></td>
              </tr>
              <tr>
                <td colspan="2" align="center"><a href="user.php?act=qpassword_name" class="f6"><?php echo $this->_var['lang']['get_password_by_question']; ?></a> <a href="user.php?act=get_password" class="f6"><?php echo $this->_var['lang']['get_password_by_mail']; ?></a></td>
              </tr>
              <tr>
                <td colspan="2"><div align="center">
                    <input type="submit" class="bnt_blue" name="login" value="<?php echo $this->_var['lang']['forthwith_login']; ?>" />
                    <?php if ($this->_var['anonymous_buy'] == 1): ?>
                    <input type="button" class="bnt_blue_2" value="<?php echo $this->_var['lang']['direct_shopping']; ?>" onclick="location.href='flow.php?step=consignee&amp;direct_shopping=1'" />
                    <?php endif; ?>
                    <input name="act" type="hidden" value="signin" />
                  </div></td>
              </tr>
            </table>
          </form></td>
        <td valign="top" bgcolor="#ffffff"><h6 style=" height:32px; line-height:32px;"><span>用户注册：</span></h6>
          <form action="flow.php?step=login" method="post" name="formUser" id="registerForm" onsubmit="return checkSignupForm(this)">
            <table width="98%" border="0" cellpadding="8" cellspacing="0" bgcolor="#ffffff" class="table">
              <tr>
                <td align="right" width="25%"><strong><?php echo $this->_var['lang']['username']; ?></strong></td>
                <td><input name="username" type="text" class="inputBg" id="username" onblur="is_registered(this.value);" />
                  <br />
                  <span id="username_notice" style="color:#DD0000"></span></td>
              </tr>
              <tr>
                <td align="right"><strong><?php echo $this->_var['lang']['email_address']; ?></strong></td>
                <td><input name="email" type="text" class="inputBg" id="email" onblur="checkEmail(this.value);" />
                  <br />
                  <span id="email_notice" style="color:#DD0000"></span></td>
              </tr>
              <tr>
                <td align="right"><strong><?php echo $this->_var['lang']['password']; ?></strong></td>
                <td><input name="password" class="inputBg" type="password" id="password1" onblur="check_password(this.value);" onkeyup="checkIntensity(this.value)" />
                  <br />
                  <span style="color:#DD0000" id="password_notice"></span></td>
              </tr>
              <tr>
                <td align="right"><strong><?php echo $this->_var['lang']['confirm_password']; ?></strong></td>
                <td><input name="confirm_password" class="inputBg" type="password" id="confirm_password" onblur="check_conform_password(this.value);" />
                  <br />
                  <span style="color:#DD0000" id="conform_password_notice"></span></td>
              </tr>
              <?php if ($this->_var['enabled_register_captcha']): ?>
              <tr>
                <td align="right"><strong><?php echo $this->_var['lang']['comment_captcha']; ?>:</strong></td>
                <td><input type="text" size="8" name="captcha" class="inputBg" />
                  <img src="captcha.php?<?php echo $this->_var['rand']; ?>" alt="captcha" style="vertical-align: bottom;cursor: pointer;" onClick="this.src='captcha.php?'+Math.random()" /></td>
              </tr>
              <?php endif; ?>
              <tr>
                <td colspan="2" align="center"><input type="submit" name="Submit" class="bnt_blue_1" value="<?php echo $this->_var['lang']['forthwith_register']; ?>" />
                  <input name="act" type="hidden" value="signup" /></td>
              </tr>
            </table>
          </form></td>
      </tr>
      <?php if ($this->_var['need_rechoose_gift']): ?>
      <tr>
        <td colspan="2" align="center" style="border-top:1px #ccc solid; padding:5px; color:red;"><?php echo $this->_var['lang']['gift_remainder']; ?></td>
      </tr>
      <?php endif; ?>
    </table>
  </div>
 
<?php endif; ?>
</div>

<div class="blank"></div>
<?php echo $this->fetch('library/page_footer.lbi'); ?> 
<script type="text/javascript" src="themes/68ecshopcom_360buy/js/lib-v1.js"></script> 
<script type="text/javascript">$("#store-selector").Jdropdown();</script> 
<script type="text/javascript">$.jdCalcul([537]);</script> 
<script type="text/javascript">pageConfig.FN_InitContrast();</script>  
<a href="http://www.itmba.cc" style="display:none">先知教育 淄博PHP培训</a>
</body>
<script type="text/javascript">
var process_request = "<?php echo $this->_var['lang']['process_request']; ?>";
<?php $_from = $this->_var['lang']['passport_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
var username_exist = "<?php echo $this->_var['lang']['username_exist']; ?>";
var compare_no_goods = "<?php echo $this->_var['lang']['compare_no_goods']; ?>";
var btn_buy = "<?php echo $this->_var['lang']['btn_buy']; ?>";
var is_cancel = "<?php echo $this->_var['lang']['is_cancel']; ?>";
var select_spe = "<?php echo $this->_var['lang']['select_spe']; ?>";
</script>
</html>
