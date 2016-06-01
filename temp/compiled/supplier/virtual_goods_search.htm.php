<!-- $Id: goods_search.htm 16790 2009-11-10 08:56:15Z wangleisvn $ -->
<script type="text/javascript" src="../js/jquery.js"></script>
<div class="form-div">
  <form action="javascript:searchGoods()" name="searchForm">
    <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
    <?php if ($_GET['act'] != "trash"): ?>
    <!-- 商圈 -->
    <select name="city" onchange="selectCity()">
      <option value="">城市</option>
    <?php $_from = $this->_var['city']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'city_0_90444500_1442994050');if (count($_from)):
    foreach ($_from AS $this->_var['city_0_90444500_1442994050']):
?>
	<?php if ($this->_var['selectKey']['city'] == $this->_var['city_0_90444500_1442994050']['city']): ?>
	 <option value="<?php echo $this->_var['city_0_90444500_1442994050']['city']; ?>" selected="selected"><?php echo $this->_var['city_0_90444500_1442994050']['region_name']; ?></option>
	<?php else: ?>
	<option value="<?php echo $this->_var['city_0_90444500_1442994050']['city']; ?>"><?php echo $this->_var['city_0_90444500_1442994050']['region_name']; ?></option>
	<?php endif; ?>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>	 
    </select>
    <select name="county" onchange="selectCounty()">
      <option value="">区县</option>
    </select>
    <select name="district">
      <option value="">商圈</option>
    </select>
    <!-- 分类 -->
    <!--<select name="cat_id"><option value="0"><?php echo $this->_var['lang']['goods_cat']; ?></option><?php echo $this->_var['cat_list']; ?></select>-->

    <!-- 推荐 -->
   <!-- <select name="intro_type"><option value="0"><?php echo $this->_var['lang']['intro_type']; ?></option><?php echo $this->html_options(array('options'=>$this->_var['intro_list'],'selected'=>$_GET['intro_type'])); ?></select>-->
     
      <!-- 上架 -->
      <select name="is_on_sale"><option value=''>上架状态</option><option value="1"><?php echo $this->_var['lang']['on_sale']; ?></option><option value="0"><?php echo $this->_var['lang']['not_on_sale']; ?></option></select>
    <select name="supplier_status"><option value=''>审核状态</option><option value="0">未审核</option><option value="1">已通过</option><option value="2">未通过</option></select>
      <?php endif; ?>
    <!-- 关键字 -->
    <?php echo $this->_var['lang']['keyword']; ?> <input type="text" name="keyword" size="15" />
    <input type="submit" value="<?php echo $this->_var['lang']['button_search']; ?>" class="button" />
  </form>
</div>


<script language="JavaScript">
    function searchGoods()
    {

        <?php if ($_GET['act'] != "trash"): ?>
       // listTable.filter['cat_id'] = document.forms['searchForm'].elements['cat_id'].value;
        
       // listTable.filter['brand_id'] = document.forms['searchForm'].elements['brand_id'].value;
        listTable.filter['supplier_status'] = document.forms['searchForm'].elements['supplier_status'].value;
       // listTable.filter['intro_type'] = document.forms['searchForm'].elements['intro_type'].value;
        listTable.filter['city'] = document.forms['searchForm'].elements['city'].value;
        listTable.filter['county'] = document.forms['searchForm'].elements['county'].value;
        listTable.filter['district_id'] = document.forms['searchForm'].elements['district'].value;
          <?php if ($this->_var['suppliers_exists'] == 1): ?>
         //listTable.filter['suppliers_id'] = document.forms['searchForm'].elements['supplier_id'].value;
          <?php endif; ?>
        listTable.filter['is_on_sale'] = document.forms['searchForm'].elements['is_on_sale'].value;
        <?php endif; ?>

        listTable.filter['keyword'] = Utils.trim(document.forms['searchForm'].elements['keyword'].value);
        listTable.filter['page'] = 1;

        listTable.loadList();
    }
    
function selectCity(){
    var city = $("select[name='city']").val();
            $.ajax({url:'virtual_goods.php?act=selectCounty',
            dataType: 'json', 
            data:{city:city},
            success: function(data){
            $('select[name="county"]').empty();
            $('select[name="county"]').append('<option value="">区县</option>');  
            $('select[name="district"]').empty();
            $('select[name="district"]').append('<option value="">商圈</option>');  
            $.each(data, function(i, item) {
            $('select[name="county"]').append('<option value="'+item.county+'">'+item.region_name+'</option>');  
        })
      }
    });
}

function selectCounty(){
    var county = $("select[name='county']").val();
            $.ajax({url:'virtual_goods.php?act=selectDistrict',
            dataType: 'json', 
            data:{county:county},
            success: function(data){
               
            $('select[name="district"]').empty();
            $('select[name="district"]').append('<option value="">商圈</option>');  
            $.each(data, function(i, item) {
            $('select[name="district"]').append('<option value="'+item.district_id+'">'+item.district_name+'</option>');  
        })
      }
    });
}
</script>
