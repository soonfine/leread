<?php
include_once dirname(__FILE__)."/../base.inc.php";
$caid=$_GET['caid'];

$page=$_GET['page'];
empty($page)?$page=1:"";

//页码
$entry='catalog_list';
include_once dirname(__FILE__)."/pageNav.php";
//列表
if($total){
	$dsql->SetQuery($where_sql." order by id desc limit $offset,$num");
	$dsql->Execute();
	while($sbyou_net=$dsql->GetObject())
	{
			$arcURL='page.php?aid='.$sbyou_net->id;//简介页链接
			$booksize=$sbyou_net->booksize;
			$catalog='['.SBYOU_NET_catalog($sbyou_net->topid,'typename').']&nbsp;';
			$overdate=$sbyou_net->overdate;
			$overdate?$overdate='完结':$overdate='连载';
			
			$ii++;
			$ii==1?$class=' style="border-top:none;"':$class='';
			//条目
			$liSTR.='
			<a href="'.$arcURL.'" class="data"'.$class.'>'.$sbyou_net->typename.'<span class="s1">'.$catalog.'作者:'.$sbyou_net->zuozhe.'</span><span class="s2">'.date('Y-m-d',$sbyou_net->lastupdate).'</span><span class="s3">'.$overdate.'，'.$booksize.'字</span></a>
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
echo '<div class="goodsBody ca">'.$liSTR.'<p class="line"></p></div>'.$pageNav;
?>