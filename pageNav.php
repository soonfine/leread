<?php

/*-----------------
��������PHP����
�����ߣ���Ҷ��
�Ա����̣�669977.TaoBao.com
��ʾվ��www.SBYOU.net
������www.669977.net
QQ��1981255858
-----------------*/

$num='52';//ÿҳ����

//��ҳ�����¸���ҳ
if($entry=='shuku'){
	$where_sql='select * from dede_arctype where topid!=0 and topid!=45 and booksize!=0';
	$typedir='';
}
//ȫ��С˵
if($entry=='quanben'){
	$where_sql='select * from dede_arctype where topid!=0 and topid!=45 and booksize!=0 and overdate!=0';
	$typedir='quanben/';
}
//��Ŀ�б�ҳ
if($entry=='catalog_list'){
	$where_sql='select * from dede_arctype where topid='.$id.' and booksize!=0';
	$typedir=$typedir.'/';
}

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
  $pre='<a id="pre_page" href="'.$cfg_indexurl.$typedir.'shuku_'.$pagenum.'_'.$prepg.'.html" title="��һҳ">��һҳ</a>';
  $first='<a href="'.$cfg_indexurl.$typedir.'shuku_'.$pagenum.'_1.html" title="��һҳ">��һҳ</a>';
}else{
  $pre='<a class="none" id="pre_page" title="��һҳ">��һҳ</a>';
  $first='<a class="none" title="��һҳ">��һҳ</a>';
}
if($nextpg){
  $next='<a id="next_page" href="'.$cfg_indexurl.$typedir.'shuku_'.$pagenum.'_'.$nextpg.'.html" title="��һҳ">��һҳ</a>';
  $last='<a href="'.$cfg_indexurl.$typedir.'shuku_'.$pagenum.'_'.$pagenum.'.html" title="���һҳ">���һҳ</a>';
}else{
  $next='<a class="none" id="next_page" title="��һҳ">��һҳ</a>';
  $last='<a class="none" title="���һҳ">���һҳ</a>';
}
//����ҳ��
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
//ҳ���ַ���
$pageNav='
<div class="page_info">ÿҳ��ʾ<b>&nbsp;52&nbsp;</b>������<b>'.$total.'</b>��</div>
<div class="page_num">
  <div><a class="info">��<b>'.$page.'</b>ҳ/��'.$pagenum.'ҳ</a>'.$first.$pre.'</div>
  <div class="p_bar">'.$numnav.'</div>
  <div>'.$next.$last.'</div>
</div>
';
?>