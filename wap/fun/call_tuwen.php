<?php
include_once dirname(__FILE__)."/../base.inc.php";

$page=$_GET['page'];
empty($page)?$page=1:"";

//页码
$entry='tuwen';
include_once dirname(__FILE__)."/pageNav.php";
//列表
if($total){
	$dsql->SetQuery($where_sql." order by id desc limit $offset,$num");
	$dsql->Execute();
	while($SbYou_Net=$dsql->GetObject())
	{
			$arcURL='page.php?aid='.$SbYou_Net->id;//简介页链接
			$booksize=$SbYou_Net->booksize;
			$catalog=str_replace('·','',SBYOU_NET_catalog($SbYou_Net->topid,'typename'));
			$overdate=$SbYou_Net->overdate;
			$overdate?$overdate='完结':$overdate='连载';

			if($booksize>=1000000){
				$bw='<span>百万字</span>';
			}else{
				$bw='';
			}
			
			$typeimg=ltrim($SbYou_Net->typeimg,'/');
			if(!$typeimg){
					$randPICID=rand(1,50);
					$typeimg="uploads/empty/".$randPICID.".jpg";
			}
			
			$description=$SbYou_Net->description;
			strip_tags($description)?$description=mb_substr(trim(strip_tags($description)),0,80,"gbk").'……':$description='';

			$ii++;
			$ii==1?$class=' style="border-top:none;"':$class='';
			//条目
			$liSTR.='
			<a href="'.$arcURL.'">
			  <dl class="goods"'.$class.'>
				<dt><img src="'.$BOOK_URL.$typeimg.'"></dt>
				<dd class="t t2">'.$SbYou_Net->typename.'&nbsp;['.$overdate.']'.$bw.'</dd>
				<dd><span class="span3">作者：</span><span>'.$SbYou_Net->zuozhe.'</span>&nbsp;&nbsp;<span class="span3">类型：</span>'.$catalog.'</dd>
				<dd><span class="span3">浏览：</span><span class="span4">'.$SbYou_Net->bookclick.'</span><span class="span3">&nbsp;次</span></dd>
				<dd class="con">'.$description.'</dd>
			  </dl>
			</a>
			';
	}
}else{
	$liSTR='
	<div class="goodsBody s">
		<br />
		&nbsp;&nbsp;&nbsp;:&nbsp;:&nbsp;抱歉，暂无相关内容，立马为您收集！
		<br />
		<br />
		<br />
	</div>
	';
}
//输出
echo '<div class="listBody nyBody g tw">'.$liSTR.'<p class="line"></p></div>'.$pageNav;
?>