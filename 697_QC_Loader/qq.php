<?php
if($SByou_NET_QC_Loader!='www.669977.net'){
	header('location:../');
	exit;
}

echo '
<script type="text/javascript" src="http://qzonestyle.gtimg.cn/qzone/openapi/qc_loader.js" data-appid="'.$appid.'" data-redirecturi="'.$redirecturi.'" charset="utf-8"></script>
<script type="text/javascript" src="http://qzonestyle.gtimg.cn/qzone/openapi/qc_loader.js" charset="utf-8" data-callback="true"></script>
<script type="text/javascript">
//QQµÇÂ½
var paras = {};
QC.api("get_user_info", paras)
.success(function(s){
	nickname=s.data.nickname;
	if(QC.Login.check()){
		QC.Login.getMe(function(openId, accessToken){
			SByou_NET_QC_Loader(nickname,"",openId);
		});
	}
});
</script>
';
?>