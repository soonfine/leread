<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");

//配置后台路径，默认为“697_admin”
$dir_admin=dirname(__FILE__).'/../697_admin/';
if(is_dir($dir_admin)){
	require_once($dir_admin."config.php");
}else{
	echo '<center>抱歉，由于您修改了默认后台路径，请您在当前页面文件中配置后台路径！</center>';
	exit;
}

?>

<script>BOOK_URL='<?=$BOOK_URL;?>';</script>
<script type="text/javascript" src="js/xmlJS.js"></script>

<p style="color:#F00;">采集正在进行，不可关闭此页！</p>
<p>注：此采集功能为24小时不间断连续自动循环采集，采集过程中意外关闭、意外刷新，不会影响采集结果，下次打开页面会接着采集！</p>

<p id="time_continue"></p>
<div id="ajax_caiji"></div>

<script type="text/javascript">

var time_continue=0;
var error_continue=0;

var sbyou_Net_result='ok';
var page=1;

function SByou_NET_caiji()
{
	setTimeout(function(){
		
		if(sbyou_Net_result=='ok'){
			page=parseInt(page)+1;
			ajax_caiji(page);
			error_continue=0;
		}else{
			error_continue=parseInt(error_continue)+1;
		}
		
		if(error_continue>=10){
			ajax_caiji(page);
		}		
		
		time_continue=parseInt(time_continue)+1;
		$id('time_continue').innerHTML='页面执行时间：<span style="color:red">'+time_continue+'</span>&nbsp;秒';
		
		SByou_NET_caiji();
		
	},1000);
}
SByou_NET_caiji();

</script>
