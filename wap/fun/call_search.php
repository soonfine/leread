<?php
include dirname(__FILE__)."/../base.inc.php";
$searchword=$_GET['searchword'];
if(!$searchword){
	echo '
	<br />
	请您输入关键词进行搜索！
	<br />
	<br />
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

		$arcURL='page.php?aid='.$id;//简介页动态链接
		
		$ii++;
		//条目
		$liSTR.=$ii.'.<a href="'.$arcURL.'">'.$typename.'</a>（'.$sbYoU_net->zuozhe.'）'.date('Y-m-d',$sbYoU_net->lastupdate).'<br>';
	}
}else{
	$liSTR='
	<br />
	抱歉，暂无相关内容！
	<br />
	<br />
	';
}
//输出
echo $liSTR.$pageNav;
?>