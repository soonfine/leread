<?php
include dirname(__FILE__)."/../base.inc.php";
$id=$_GET['aid'];

$page=$_GET['page'];
empty($page)?$page=1:"";

//ҳ��
$entry='list';
include dirname(__FILE__)."/pageNav.php";
//�б�
if($total){
	$dsql->SetQuery($where_sql." order by id asc limit $offset,$num");
	$dsql->Execute();
	while($SByou_NET=$dsql->GetObject())
	{
			$arcURL='archive.php?aid='.$SByou_NET->id;//�½�����
			
			$ii++;
			$ii==1?$class=' style="border-top:none;"':$class='';
			//��Ŀ
			$liSTR.='
			<a href="'.$arcURL.'" class="data"'.$class.'>'.$SByou_NET->title.'</a><br />
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