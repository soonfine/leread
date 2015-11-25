<?php
if($SByou_NET_QC_Loader!='www.669977.net'){
	header('location:../');
	exit;
}

echo '
<html xmlns:wb="http://open.weibo.com/wb">
<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js?appkey='.$appkey.'&debug=true" type="text/javascript" charset="utf-8"></script>

<div>
  <wb:login-button type="3,2" onlogin="login" onlogout="logout" ></wb:login-button>
</div>
<script type="text/javascript">
//Î¢²©µÇÂ½
function login(o){
	SByou_NET_QC_Loader(o.screen_name,o.avatar_hd,"",o.id);
}
</script>
';
?>