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
	$dsql->SetQuery($where_sql." order by chapter_no asc, id asc limit $offset,$num");
	$dsql->Execute();
	while($SByou_NET=$dsql->GetObject())
	{
			$arcURL='archive.php?aid='.$SByou_NET->id;//章节链接
			
			$ii++;
			$ii==1?$class=' style="border-top:none;"':$class='';
			//条目
			$liSTR.='
			<a href="'.$TOUCH_URL.$arcURL.'" class="data"'.$class.'>'.$SByou_NET->title.'</a>
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
echo '<div class="goodsBody list">'.$liSTR.'<p class="line"></p></div>'.$pageNav;	
?>
