<?php
include dirname(__FILE__)."/../base.inc.php";
$searchword=$_GET['searchword'];
if(!$searchword){
	echo '
	<br />
	��������ؼ��ʽ���������
	<br />
	<br />
	';
	exit;
}

$page=$_GET['page'];
empty($page)?$page=1:"";

//ҳ��
$entry='search';
include dirname(__FILE__)."/pageNav.php";
//�б�
if($total){
	$dsql->SetQuery($where_sql." order by bookclick desc limit $offset,$num");
	$dsql->Execute();
	while($sbYoU_net=$dsql->GetObject())
	{
		$id=$sbYoU_net->id;
		$typename=$sbYoU_net->typename;

		$arcURL='page.php?aid='.$id;//���ҳ��̬����
		
		$ii++;
		//��Ŀ
		$liSTR.=$ii.'.<a href="'.$arcURL.'">'.$typename.'</a>��'.$sbYoU_net->zuozhe.'��'.date('Y-m-d',$sbYoU_net->lastupdate).'<br>';
	}
}else{
	$liSTR='
	<br />
	��Ǹ������������ݣ�
	<br />
	<br />
	';
}
//���
echo $liSTR.$pageNav;
?>