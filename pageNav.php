<?php

/*-----------------
独立功能PHP程序
开发者：枯叶天
淘宝店铺：669977.TaoBao.com
演示站：www.SBYOU.net
官网：www.669977.net
QQ：1981255858
-----------------*/

$num='52';//每页条数

//首页及最新更新页
if($entry=='shuku'){
	$where_sql='select * from dede_arctype where topid!=0 and topid!=45 and booksize!=0';
	$typedir='';
}
//全本小说
if($entry=='quanben'){
	$where_sql='select * from dede_arctype where topid!=0 and topid!=45 and booksize!=0 and overdate!=0';
	$typedir='quanben/';
}
//栏目列表页
if($entry=='catalog_list'){
	$where_sql='select * from dede_arctype where topid='.$id.' and booksize!=0';
	$typedir=$typedir.'/';
}

//计算总页数
$dsql->SetQuery($where_sql);
$dsql->Execute();
while($total_row=$dsql->GetObject())
{
	$total++;
}
//页数
$pagenum=ceil($total/$num);
$page=min($pagenum,$page);
$prepg=$page-1;
$nextpg=($page==$pagenum?0:$page+1);
$offset=($page-1)*$num;
//快捷页码
!$pagenum?$prepg="":"";
if($prepg){
  $pre='<a id="pre_page" href="'.$cfg_indexurl.$typedir.'shuku_'.$pagenum.'_'.$prepg.'.html" title="上一页">上一页</a>';
  $first='<a href="'.$cfg_indexurl.$typedir.'shuku_'.$pagenum.'_1.html" title="第一页">第一页</a>';
}else{
  $pre='<a class="none" id="pre_page" title="上一页">上一页</a>';
  $first='<a class="none" title="第一页">第一页</a>';
}
if($nextpg){
  $next='<a id="next_page" href="'.$cfg_indexurl.$typedir.'shuku_'.$pagenum.'_'.$nextpg.'.html" title="下一页">下一页</a>';
  $last='<a href="'.$cfg_indexurl.$typedir.'shuku_'.$pagenum.'_'.$pagenum.'.html" title="最后一页">最后一页</a>';
}else{
  $next='<a class="none" id="next_page" title="下一页">下一页</a>';
  $last='<a class="none" title="最后一页">最后一页</a>';
}
//数字页码
if($pagenum=='1'){
	$numnav='<a class="p_curpage">1</a>';
}else if($pagenum>1){
  if($page<3){
	  for($i=1;$i<=(($pagenum>=3)?3:$pagenum);$i++){
		  if($page==$i){
			  $numnav.='<a class="p_curpage">'.$i.'</a>';
		  }else{
			  $numnav.='<a href="'.$cfg_indexurl.$typedir.'shuku_'.$pagenum.'_'.$i.'.html" class="p_num">'.$i.'</a>';
		  }
	  }
  }else{
	  for($i=($page-1);$i<=((($page+1)<=$pagenum)?($page+1):$pagenum);$i++){
		  if($page==$i){
			  $numnav.='<a class="p_curpage">'.$i.'</a>';
		  }else{
			  $numnav.='<a href="'.$cfg_indexurl.$typedir.'shuku_'.$pagenum.'_'.$i.'.html" class="p_num">'.$i.'</a>';
		  }
	  }
  }
  $numnav.='<a class="p_num m">...</a>';
  if($page!=$pagenum && $page!=($pagenum-1)){
	  (($page+5)<=$pagenum)?$page_big=($page+5):$page_big=$pagenum;
	  $numnav.='<a href="'.$cfg_indexurl.$typedir.'shuku_'.$pagenum.'_'.$page_big.'.html" class="p_num">'.$page_big.'</a>';  
  }
}
//页码字符串
$pageNav='
<div class="page_info">每页显示<b>&nbsp;52&nbsp;</b>部，共<b>'.$total.'</b>部</div>
<div class="page_num">
  <div><a class="info">第<b>'.$page.'</b>页/共'.$pagenum.'页</a>'.$first.$pre.'</div>
  <div class="p_bar">'.$numnav.'</div>
  <div>'.$next.$last.'</div>
</div>
';
?>