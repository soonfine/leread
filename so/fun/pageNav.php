<?php

/*-----------------
��������PHP����
�����ߣ���Ҷ��
�Ա����̣�669977.TaoBao.com
��ʾվ��www.SBYOU.net
������www.669977.net
QQ��1981255858
-----------------*/

$num='10';//ÿҳ����

$where_sql="select * from dede_arctype where ".$fuck." like '%".$searchword."%'";

//������ҳ��
$dsql->SetQuery($where_sql);
$dsql->Execute();
while($total_row=$dsql->GetObject())
{
	$total++;
}
//ҳ��
$pagenum=ceil($total/$num);
$page=min($pagenum,$page);
$prepg=$page-1;
$nextpg=($page==$pagenum?0:$page+1);
$offset=($page-1)*$num;
//���ҳ��
!$pagenum?$prepg="":"";
if($prepg){
  $pre='<a class="on" href="'.$SEARCH_URL."?fuck=".$p_fuck."&searchword=".$code_searchword."&page=".$prepg.'" title="��һҳ">��һҳ</a>';
  $first='<a class="on" href="'.$SEARCH_URL."?fuck=".$p_fuck."&searchword=".$code_searchword.'&page=1" title="��һҳ">��һҳ</a>';
}else{
  $pre='<a class="on none" title="��һҳ">��һҳ</a>';
  $first='<a class="on none" title="��һҳ">��һҳ</a>';
}
if($nextpg){
  $next='<a class="on" href="'.$SEARCH_URL."?fuck=".$p_fuck."&searchword=".$code_searchword."&page=".$nextpg.'" title="��һҳ">��һҳ</a>';
  $last='<a class="on" href="'.$SEARCH_URL."?fuck=".$p_fuck."&searchword=".$code_searchword."&page=".$pagenum.'" title="���һҳ">���һҳ</a>';
}else{
  $next='<a class="on none" title="��һҳ">��һҳ</a>';
  $last='<a class="on none" title="���һҳ">���һҳ</a>';
}
//����ҳ��
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
//ҳ���ַ���
$pageNav='<div id="page">'.$first.$pre.$numnav.$next.$last.'<span class="nums">&nbsp;:&nbsp;:&nbsp;�ҵ���ؽ��Լ'.($total?$total:0).'��</span></div>';
?>