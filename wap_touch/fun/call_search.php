<?php
include dirname(__FILE__)."/../base.inc.php";
$searchword=$_GET['searchword'];
if(!$searchword){
	echo '
	<div class="goodsBody s">
		<br />
		&nbsp;&nbsp;&nbsp;:&nbsp;:&nbsp;��������ؼ��ʽ���������
		<br />
		<br />
		<br />
	</div>
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
		
		//����ͼ
		$typeimg=ltrim($sbYoU_net->typeimg,'/');
		if(!$typeimg){
			$randNUM=rand(1,50);
			$typeimg="uploads/empty/".$randNUM.".jpg";
		}

		$arcURL='page.php?aid='.$id;//���ҳ��̬����
		
		$ii++;
		$ii==1?$class=' style="border-top:none;"':$class='';
		//��Ŀ
		$liSTR.='
		<a href="'.$TOUCH_URL.$arcURL.'" class="data"'.$class.'><img src="'.$BOOK_URL.$typeimg.'" /><span>'.$typename.'</span><b></b></a>
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
echo '<p class="ss_str">��&nbsp;'.$total.'&nbsp;���������</p><div class="goodsBody s">'.$liSTR.'<p class="line lines"></p></div>'.$pageNav;
?>