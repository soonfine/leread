<?php
include dirname(__FILE__)."/../base.inc.php";
$searchword=$_GET['searchword'];
if(!$searchword){
	echo '
	<div class="goodsBody s">
		<br />
		&nbsp;&nbsp;&nbsp;:&nbsp;:&nbsp;请您输入关键词进行搜索！
		<br />
		<br />
		<br />
	</div>
	';
	exit;
}

$page=$_GET['page'];
empty($page)?$page=1:"";

//页码
$entry='search';
include dirname(__FILE__)."/pageNav.php";
//列表
if($total){
	$dsql->SetQuery($where_sql." order by bookclick desc limit $offset,$num");
	$dsql->Execute();
	while($sbYoU_net=$dsql->GetObject())
	{
		$id=$sbYoU_net->id;
		$typename=$sbYoU_net->typename;
		
		//缩略图
		$typeimg=ltrim($sbYoU_net->typeimg,'/');
		if(!$typeimg){
			$randNUM=rand(1,50);
			$typeimg="uploads/empty/".$randNUM.".jpg";
		}

		$arcURL='page.php?aid='.$id;//简介页动态链接
		
		$ii++;
		$ii==1?$class=' style="border-top:none;"':$class='';
		//条目
		$liSTR.='
		<a href="'.$TOUCH_URL.$arcURL.'" class="data"'.$class.'><img src="'.$BOOK_URL.$typeimg.'" /><span>'.$typename.'</span><b></b></a>
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
echo '<p class="ss_str">共&nbsp;'.$total.'&nbsp;个搜索结果</p><div class="goodsBody s">'.$liSTR.'<p class="line lines"></p></div>'.$pageNav;
?>