<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");

//���ú�̨·����Ĭ��Ϊ��697_admin��
$dir_admin=dirname(__FILE__).'/../697_admin/';
if(is_dir($dir_admin)){
	require_once($dir_admin."config.php");
}else{
	echo '<center>��Ǹ���������޸���Ĭ�Ϻ�̨·���������ڵ�ǰҳ���ļ������ú�̨·����</center>';
	exit;
}

?>

<script>BOOK_URL='<?=$BOOK_URL;?>';</script>
<script type="text/javascript" src="js/xmlJS.js"></script>

<p style="color:#F00;">�ɼ����ڽ��У����ɹرմ�ҳ��</p>
<p>ע���˲ɼ�����Ϊ24Сʱ����������Զ�ѭ���ɼ����ɼ�����������رա�����ˢ�£�����Ӱ��ɼ�������´δ�ҳ�����Ųɼ���</p>

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
		$id('time_continue').innerHTML='ҳ��ִ��ʱ�䣺<span style="color:red">'+time_continue+'</span>&nbsp;��';
		
		SByou_NET_caiji();
		
	},1000);
}
SByou_NET_caiji();

</script>
