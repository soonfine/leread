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

//页码
$entry='paihang';
include_once dirname(__FILE__)."/pageNav.php";
//列表
if($total){
	$dsql->SetQuery($where_sql." order by bookclick desc limit $offset,$num");
	$dsql->Execute();
	while($Sbyou_Net=$dsql->GetObject())
	{
			$arcURL='page.php?aid='.$Sbyou_Net->id;//简介页链接
			
			$ii++;
			$ii==10?$nbsp='':$nbsp='&nbsp;';
			//条目
			$liSTR.='
			'.$ii.$nbsp.'.<a href="'.$arcURL.'">'.$Sbyou_Net->typename.'</a>（'.$Sbyou_Net->zuozhe.'）<br/>
			<span class="fs">更新：'.date('Y-m-d',$Sbyou_Net->lastupdate).'</span><br/>
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