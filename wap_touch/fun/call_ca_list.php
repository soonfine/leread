<?php
include_once dirname(__FILE__)."/../base.inc.php";
$caid=$_GET['caid'];

$page=$_GET['page'];
empty($page)?$page=1:"";

//ҳ��
$entry='catalog_list';
include_once dirname(__FILE__)."/pageNav.php";
//�б�
if($total){
	$dsql->SetQuery($where_sql." order by id desc limit $offset,$num");
	$dsql->Execute();
	while($sbyou_net=$dsql->GetObject())
	{
			$arcURL='page.php?aid='.$sbyou_net->id;//���ҳ����
			$booksize=$sbyou_net->booksize;
			$catalog='['.SBYOU_NET_catalog($sbyou_net->topid,'typename').']&nbsp;';
			$overdate=$sbyou_net->overdate;
			$overdate?$overdate='���':$overdate='����';
			
			$ii++;
			$ii==1?$class=' style="border-top:none;"':$class='';
			//��Ŀ
			$liSTR.='
			<a href="'.$arcURL.'" class="data"'.$class.'>'.$sbyou_net->typename.'<span class="s1">'.$catalog.'����:'.$sbyou_net->zuozhe.'</span><span class="s2">'.date('Y-m-d',$sbyou_net->lastupdate).'</span><span class="s3">'.$overdate.'��'.$booksize.'��</span></a>
			';
	}
}else{
	$liSTR='
	<div class="goodsBody s">
		<br />
		&nbsp;&nbsp;&nbsp;:&nbsp;:&nbsp;��Ǹ������������ݣ�����Ϊ���ռ���
		<br />
		<br />
		<br />
	</div>
	';
}
//���
echo '<div class="goodsBody ca">'.$liSTR.'<p class="line"></p></div>'.$pageNav;
?>