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
			$booksize=$Sbyou_Net->booksize;
			$catalog='['.SBYOU_NET_catalog($Sbyou_Net->topid,'typename').']&nbsp;';
			$overdate=$Sbyou_Net->overdate;
			$overdate?$overdate='���':$overdate='����';
			
			$ii++;
			$ii==1?$class=' style="border-top:none;"':$class='';
			//��Ŀ
			$liSTR.='
			<a href="'.$arcURL.'" class="data"'.$class.'>'.$Sbyou_Net->typename.'<span class="s1">'.$catalog.'����:'.$Sbyou_Net->zuozhe.'</span><span class="s2">'.$Sbyou_Net->bookclick.'</span><span class="s3">'.$overdate.'��'.$booksize.'��</span></a>
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