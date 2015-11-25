<?php

/*-----------------
独立功能PHP程序
开发者：枯叶天
淘宝店铺：669977.TaoBao.com
演示站：www.SBYOU.net
官网：www.669977.net
QQ：1981255858
-----------------*/

$num='10';//每页条数

//栏目列表页
if($entry=='catalog_list'){
	$where_sql='select * from dede_arctype where topid='.$caid.' and booksize!=0';
	$fun_str='call_ca_list';
}
//排行榜
if($entry=='paihang'){
	$where_sql='select * from dede_arctype where'.$cstr;
	$fun_str='call_ph_list';
}
//排行榜
if($entry=='tuwen'){
	$where_sql='select * from dede_arctype where topid!=0 and topid!=45 and booksize!=0 and typeimg!=""';
	$fun_str='call_tuwen';
	$num='5';
}
//目录页
if($entry=='list'){
	$where_sql='select * from dede_archives where typeid='.$id;
	$fun_str='call_page_list';
	$num='20';
	$caid=$id;
}
//搜索页
if($entry=='search'){
	$where_sql='select * from dede_arctype where topid!=0 and topid!=45 and booksize!=0 and typename'." like '%".$searchword."%'";
	$fun_str='call_search';
	$num='5';
	$caid=$searchword;
}

//计算总页数
$dsql->SetQuery($where_sql);
$dsql->Execute();
while($total_row=$dsql->GetObject())
{
	$total++;
}
!$total?$total='0':'';

//页数
$pagenum=ceil($total/$num);
$page=min($pagenum,$page);
$prepg=$page-1;
$nextpg=($page==$pagenum?0:$page+1);
$offset=($page-1)*$num;
//快捷页码
!$pagenum?$prepg="":"";
if($prepg){
	$pre='<a href="javascript:'.$fun_str.'(\''.$caid.'\',\''.$prepg.'\',\'yes\')" class="left">上一页</a>';
}else{
	$pre='<a href="javascript:(0)" class="left none">无上一页</a>';
}
if($nextpg){
	$next='<a href="javascript:'.$fun_str.'(\''.$caid.'\',\''.$nextpg.'\',\'yes\')" class="left right">下一页</a>';
}else{
	$next='<a href="javascript:(0)" class="left right none">无下一页</a>';
}
//页码字符串
$pageNav='<p class="page ca"><span><font>'.$page.'</font>/'.$pagenum.'</span>'.$pre.$next.'</p>';
?>