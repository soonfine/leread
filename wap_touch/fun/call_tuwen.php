<?php
include_once dirname(__FILE__)."/../base.inc.php";

$page=$_GET['page'];
empty($page)?$page=1:"";

//ҳ��
$entry='tuwen';
include_once dirname(__FILE__)."/pageNav.php";
//�б�
if($total){
	$dsql->SetQuery($where_sql." order by id desc limit $offset,$num");
	$dsql->Execute();
	while($SbYou_Net=$dsql->GetObject())
	{
			$arcURL='page.php?aid='.$SbYou_Net->id;//���ҳ����
			$booksize=$SbYou_Net->booksize;
			$catalog=str_replace('��','',SBYOU_NET_catalog($SbYou_Net->topid,'typename'));
			$overdate=$SbYou_Net->overdate;
			$overdate?$overdate='���':$overdate='����';

			if($booksize>=1000000){
				$bw='<span>������</span>';
			}else{
				$bw='';
			}
			
			$typeimg=ltrim($SbYou_Net->typeimg,'/');
			if(!$typeimg){
					$randPICID=rand(1,50);
					$typeimg="uploads/empty/".$randPICID.".jpg";
			}
			
			$description=$SbYou_Net->description;
			strip_tags($description)?$description=mb_substr(trim(strip_tags($description)),0,80,"gbk").'����':$description='';

			$ii++;
			$ii==1?$class=' style="border-top:none;"':$class='';
			//��Ŀ
			$liSTR.='
			<a href="'.$arcURL.'">
			  <dl class="goods"'.$class.'>
				<dt><img src="'.$BOOK_URL.$typeimg.'"></dt>
				<dd class="t t2">'.$SbYou_Net->typename.'&nbsp;['.$overdate.']'.$bw.'</dd>
				<dd><span class="span3">���ߣ�</span><span>'.$SbYou_Net->zuozhe.'</span>&nbsp;&nbsp;<span class="span3">���ͣ�</span>'.$catalog.'</dd>
				<dd><span class="span3">�����</span><span class="span4">'.$SbYou_Net->bookclick.'</span><span class="span3">&nbsp;��</span></dd>
				<dd class="con">'.$description.'</dd>
			  </dl>
			</a>
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
echo '<div class="listBody nyBody g tw">'.$liSTR.'<p class="line"></p></div>'.$pageNav;
?>