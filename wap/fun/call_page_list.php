<?php
include dirname(__FILE__)."/../base.inc.php";
$id=$_GET['aid'];

$page=$_GET['page'];
empty($page)?$page=1:"";

//页码
$entry='list';
include dirname(__FILE__)."/pageNav.php";
//列表
if($total){
	$dsql->SetQuery($where_sql." order by id asc limit $offset,$num");
	$dsql->Execute();
	while($SByou_NET=$dsql->GetObject())
	{
			$arcURL='archive.php?aid='.$SByou_NET->id;//章节链接
			
			$ii++;
			$ii==1?$class=' style="border-top:none;"':$class='';
			//条目
			$liSTR.='
			<a href="'.$arcURL.'" class="data"'.$class.'>'.$SByou_NET->title.'</a><br />
			';
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