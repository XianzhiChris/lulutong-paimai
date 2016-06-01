<script type="text/javascript">
var process_request = "<?php echo $this->_var['lang']['process_request']; ?>";
</script>
<div id="sn-bd">
  <div class="sn-container"> 
  	<?php echo $this->smarty_insert_scripts(array('files'=>'utils.js,common.min.js')); ?>

    <ul class="sn-quick-menu">
      <?php 
$k = array (
  'name' => 'member_info',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
    </ul>
  </div>
</div>
</div>
<script>
header_login();
function header_login()
{	
	Ajax.call('login_act_ajax.php', '', loginactResponse, 'GET', 'JSON', '1', '1');
}
function loginactResponse(result)
{
	var MEMBERZONE =document.getElementById('login-info');
	MEMBERZONE.innerHTML= result.memberinfo;
}
</script>