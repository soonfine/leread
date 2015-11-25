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
			
			$ii++;
			$ii==10?$nbsp='':$nbsp='&nbsp;';
			//条目
			$liSTR.='
			'.$ii.$nbsp.'.<a href="'.$arcURL.'">'.$sbyou_net->typename.'</a>（'.$sbyou_net->zuozhe.'）<br/>
			<span class="fs">更新：'.date('Y-m-d',$sbyou_net->lastupdate).'</span><br/>
			';
	}
}else{
	$liSTR='
	<br />
	抱歉，暂无相关内容！
	<br />
	<br />
	';
	$pageNav='';
}
//输出
echo $liSTR.$pageNav;
?>