<?php
include_once dirname(__FILE__)."/../base.inc.php";
$caid=$_GET['caid'];

$page=$_GET['page'];
empty($page)?$page=1:"";

if($caid){
	$cstr=" topid=$caid";
}else{
	$cstr=" topid!=0 and topid!=45 and booksize!=0";
}

//ҳ��
$entry='paihang';
include_once dirname(__FILE__)."/pageNav.php";
//�б�
if($total){
	$dsql->SetQuery($where_sql." order by bookclick desc limit $offset,$num");
	$dsql->Execute();
	while($Sbyou_Net=$dsql->GetObject())
	{
			$arcURL='page.php?aid='.$Sbyou_Net->id;//���ҳ����
			
			$ii++;
			$ii==10?$nbsp='':$nbsp='&nbsp;';
			//��Ŀ
			$liSTR.='
			'.$ii.$nbsp.'.<a href="'.$arcURL.'">'.$Sbyou_Net->typename.'</a>��'.$Sbyou_Net->zuozhe.'��<br/>
			<span class="fs">���£�'.date('Y-m-d',$Sbyou_Net->lastupdate).'</span><br/>
			';
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