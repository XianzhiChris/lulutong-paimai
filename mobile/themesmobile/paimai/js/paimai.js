/*  李云鹏20160428  */
$(function(){
	/*拍卖快捷出价*/
	$("#cjkj a").click(function(){
		var dqj=$("#dqj").text();  //获取当前价格
		var jj=$(this).attr("data-cj"); //获取当前加价
		var zzjg=parseInt(dqj)+parseInt(jj); //最终价格
		$("#zzjg").val("￥"+zzjg+".00");
		$("#zzjg2").val(zzjg);
	});
	/*标签切换*/
	$("#tab_hd li").hover(function(){
		$("#tab_hd").find("li").removeClass("curr");
		$(this).addClass("curr");
		index=$(this).index();
		$("#tab_bd").find("li").removeClass("curr");
		$("#tab_bd li").eq(index).addClass("curr");
	});
	/*拍卖右侧出价记录更多按钮*/
	$("#seemore").click(function(){
		$("#tab_hd").find("li").removeClass("curr");
		$("#tab_hd li").eq(1).addClass("curr");
		$("#tab_bd").find("li").removeClass("curr");
		$("#tab_bd li").eq(1).addClass("curr");
		document.getElementById("tab_hd").scrollIntoView();  //滚动页面到ID位置
	});
});
//拍卖详情页出价表单验证
function checkchujiaform(){
	if($("#zzjg").val()=="￥"){
		alert("请出价");
		return false;
	}
}
