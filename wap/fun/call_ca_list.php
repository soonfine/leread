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
			
			$ii++;
			$ii==10?$nbsp='':$nbsp='&nbsp;';
			//��Ŀ
			$liSTR.='
			'.$ii.$nbsp.'.<a href="'.$arcURL.'">'.$sbyou_net->typename.'</a>��'.$sbyou_net->zuozhe.'��<br/>
			<span class="fs">���£�'.date('Y-m-d',$sbyou_net->lastupdate).'</span><br/>
			';
	}
}else{
	$liSTR='
	<br />
	��Ǹ������������ݣ�
	<br />
	<br />
	';
	$pageNav='';
}
//���
echo $liSTR.$pageNav;
?>