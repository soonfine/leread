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
    <p>��Ա&nbsp;<span style="color:red"><b>'.$mname.'</b></span>&nbsp;���ã����Ѿ��ɹ�ע�᱾վ��Ա��</p>
    <p>�˺ţ�<b>'.$mname.'</b>�����룺<b>123456</b></p>
    <p>���μ������˺�����Ŷ����ǰ����Ϊ��ʼ�����룬���ڻ�Ա�����޸������Լ����ƻ�Ա���ϣ�</p>
  </center>
  <p style="height:0px;"></p>
  <center>
    <a class="btn btn-primary loginsubmi" href="../" title="">������ҳ</a>&nbsp;&nbsp;<a id="goto-reg" href="../adminm/?entry=book&action=memberinfo" class="btn">ǰ����Ա������������</a>
  </center>
</div>
';
?>
