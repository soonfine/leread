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
	$dsql->SetQuery($where_sql." order by chapter_no asc, id asc limit $offset,$num");
	$dsql->Execute();
	while($SByou_NET=$dsql->GetObject())
	{
			$arcURL='archive.php?aid='.$SByou_NET->id;//�½�����
			
			$ii++;
			$ii==1?$class=' style="border-top:none;"':$class='';
			//��Ŀ
			$liSTR.='
			<a href="'.$TOUCH_URL.$arcURL.'" class="data"'.$class.'>'.$SByou_NET->title.'</a>
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
echo '<div class="goodsBody list">'.$liSTR.'<p class="line"></p></div>'.$pageNav;	
?>
