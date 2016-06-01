
	//var serverNowTime = new Date().getTime()/1000;
	var serverNowTime = parseInt(new Date().getTime()/1000);  //不要毫秒数
	updateEndTime();


//倒计时函数
function updateEndTime()
{
	$("[data-endTime]").each(function(i){
		var startTime=$(this).attr("data-startTime");  //开始时间
		var endTime =$(this).attr("data-endTime"); //结束时间字符串
		var lbg = startTime-serverNowTime;//当前时间和开始时间之间的秒数，>0未开始,<0已开始
		var lag = endTime - serverNowTime; //当前时间和结束时间之间的秒数，>0未结束，<0已结束
		console.log(startTime+"|"+serverNowTime+"|"+lbg+"|||"+endTime+"|"+serverNowTime+"|"+lag);
			if(lbg > 0)
			{
				var str="<i></i>距离开拍";
				var second = Math.floor(lbg % 60)
					, minutes = Math.floor((lbg / 60) % 60)
					, hour = Math.floor((lbg / 3600) % 24)
					, day = Math.floor((lbg / 3600) / 24);

				if(second<10)second='0'+second;
				if(minutes<10)minutes='0'+minutes;
				if(hour<10)hour='0'+hour;
				if(day<10)day='0'+day;

				var con = str;
				if(day>0)con+="<b>"+day+"</b>天";
				con+="<b>"+hour+"</b>时"
					+ "<b>"+minutes+"</b>分"
					+ "<b>"+second+"</b>";

				$(this).html(con);
			}else if(lbg < 0 && lag > 0)
			{
				var str="<i></i>剩余时间";
				var second = Math.floor(lag % 60)
					, minutes = Math.floor((lag / 60) % 60)
					, hour = Math.floor((lag / 3600) % 24)
					, day = Math.floor((lag / 3600) / 24);

				if(second<10)second='0'+second;
				if(minutes<10)minutes='0'+minutes;
				if(hour<10)hour='0'+hour;
				if(day<10)day='0'+day;

				var con = str;
				if(day>0)con+="<b>"+day+"</b>天";
				con+="<b>"+hour+"</b>时"
					+ "<b>"+minutes+"</b>分"
					+ "<b>"+second+"</b>";

				$(this).html(con);
			}else if(lag==0 || lbg==0){
				window.location.reload();
			}
			else {
				$(this).html("<span class='info failure'>已结束！</span>");
			}
	});
	serverNowTime++;
	setTimeout("updateEndTime()",1000);
}