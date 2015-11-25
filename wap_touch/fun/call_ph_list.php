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
			$booksize=$Sbyou_Net->booksize;
			$catalog='['.SBYOU_NET_catalog($Sbyou_Net->topid,'typename').']&nbsp;';
			$overdate=$Sbyou_Net->overdate;
			$overdate?$overdate='完结':$overdate='连载';
			
			$ii++;
			$ii==1?$class=' style="border-top:none;"':$class='';
			//条目
			$liSTR.='
			<a href="'.$arcURL.'" class="data"'.$class.'>'.$Sbyou_Net->typename.'<span class="s1">'.$catalog.'作者:'.$Sbyou_Net->zuozhe.'</span><span class="s2">'.$Sbyou_Net->bookclick.'</span><span class="s3">'.$overdate.'，'.$booksize.'字</span></a>
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