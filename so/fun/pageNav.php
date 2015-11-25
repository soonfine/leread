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

$where_sql="select * from dede_arctype where ".$fuck." like '%".$searchword."%'";

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
  $pre='<a class="on" href="'.$SEARCH_URL."?fuck=".$p_fuck."&searchword=".$code_searchword."&page=".$prepg.'" title="上一页">上一页</a>';
  $first='<a class="on" href="'.$SEARCH_URL."?fuck=".$p_fuck."&searchword=".$code_searchword.'&page=1" title="第一页">第一页</a>';
}else{
  $pre='<a class="on none" title="上一页">上一页</a>';
  $first='<a class="on none" title="第一页">第一页</a>';
}
if($nextpg){
  $next='<a class="on" href="'.$SEARCH_URL."?fuck=".$p_fuck."&searchword=".$code_searchword."&page=".$nextpg.'" title="下一页">下一页</a>';
  $last='<a class="on" href="'.$SEARCH_URL."?fuck=".$p_fuck."&searchword=".$code_searchword."&page=".$pagenum.'" title="最后一页">最后一页</a>';
}else{
  $next='<a class="on none" title="下一页">下一页</a>';
  $last='<a class="on none" title="最后一页">最后一页</a>';
}
//数字页码
if($pagenum=='1'){
	$numnav='<strong>1</strong>';
}else if($pagenum>1){
  if($page<3){
	  for($i=1;$i<=(($pagenum>=3)?3:$pagenum);$i++){
		  if($page==$i){
			  $numnav.='<strong>'.$i.'</strong>';
		  }else{
			  $numnav.='<a href="'.$SEARCH_URL."?fuck=".$p_fuck."&searchword=".$code_searchword."&page=".$i.'">'.$i.'</a>';
		  }
	  }
  }else{
	  for($i=($page-1);$i<=((($page+1)<=$pagenum)?($page+1):$pagenum);$i++){
		  if($page==$i){
			  $numnav.='<strong>'.$i.'</strong>';
		  }else{
			  $numnav.='<a href="'.$SEARCH_URL."?fuck=".$p_fuck."&searchword=".$code_searchword."&page=".$i.'">'.$i.'</a>';
		  }
	  }
  }
  $numnav.='<a class="m">...</a>';
  if($page!=$pagenum && $page!=($pagenum-1)){
	  (($page+5)<=$pagenum)?$page_big=($page+5):$page_big=$pagenum;
	  $numnav.='<a href="'.$cfg_indexurl.$typedir.'shuku_'.$pagenum.'_'.$page_big.'.html">'.$page_big.'</a>';  
  }
}
//页码字符串
$pageNav='<div id="page">'.$first.$pre.$numnav.$next.$last.'<span class="nums">&nbsp;:&nbsp;:&nbsp;找到相关结果约'.($total?$total:0).'个</span></div>';
?>