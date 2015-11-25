<?php
$mname=$_GET['mname'];
$mid=$_GET['mid'];
$mname2=SByou_net_GetOne("select mname from members where mid='$mid' limit 1");

if($SByou_NET_QC_Loader!='www.669977.net' || !$mname || !$mid || $mname!=$mname2){
	header('location:../');
	exit;
}

echo '
<div class="article-newslist">
  <center>
    <p>会员&nbsp;<span style="color:red"><b>'.$mname.'</b></span>&nbsp;您好，您已经成功注册本站会员！</p>
    <p>账号：<b>'.$mname.'</b>，密码：<b>123456</b></p>
    <p>请牢记上述账号密码哦，当前密码为初始化密码，可在会员中心修改密码以及完善会员资料！</p>
  </center>
  <p style="height:0px;"></p>
  <center>
    <a class="btn btn-primary loginsubmi" href="../" title="">返回首页</a>&nbsp;&nbsp;<a id="goto-reg" href="../adminm/?entry=book&action=memberinfo" class="btn">前往会员中心完善资料</a>
  </center>
</div>
';
?>
