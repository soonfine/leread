<?php
/*-----------------
��������PHP����
�����ߣ���Ҷ��
�Ա����̣�669977.TaoBAo.com
��ʾվ��www.SbYoU.net
������www.669 977.net
QQ��1981 25 58 58
-----------------*/

require_once(dirname(__FILE__)."/config.php");

$menutype = 'mydede';
$menutype_son = 'cc';

if(!$cfg_ml->IsLogin())
{
	header("location:".$BOOK_URL.'member/login.php');
	exit;
}

//������Ŀҳ��
$page=htmlspecialchars($_GET['page']);
if(!$page || !is_numeric($page)){
	$page=1;
}

//��ر���
$BOOK_URL=sbyou_net_sysconfig('cfg_basehost').sbyou_net_sysconfig('cfg_indexurl');
$cfg_indexurl=sbyou_net_sysconfig('cfg_indexurl');
$templets=$cfg_indexurl.'templets/'.sbyou_net_sysconfig('cfg_df_style');


$num='10';//ÿҳ����

$where_sql='select * from dede_arctype where topid!=0 and topid!=45 and booksize!=0';
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
  $pre='<a id="pre_page" href="'.$BOOK_URL.'member/caicai.php" title="��һҳ">��һҳ</a>';
  $first='<a href="'.$BOOK_URL.'member/caicai.php" title="��һҳ">��һҳ</a>';
}else{
  $pre='<a class="none" id="pre_page" title="��һҳ">��һҳ</a>';
  $first='<a class="none" title="��һҳ">��һҳ</a>';
}
if($nextpg){
  $next='<a id="next_page" href="'.$BOOK_URL.'member/caicai.php?page='.$nextpg.'" title="��һҳ">��һҳ</a>';
  $last='<a href="'.$BOOK_URL.'member/caicai.php?page='.$pagenum.'" title="���һҳ">���һҳ</a>';
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
			  $numnav.='<a href="'.$BOOK_URL.'member/caicai.php?page='.$i.'" class="p_num">'.$i.'</a>';
		  }
	  }
  }else{
	  for($i=($page-1);$i<=((($page+1)<=$pagenum)?($page+1):$pagenum);$i++){
		  if($page==$i){
			  $numnav.='<a class="p_curpage">'.$i.'</a>';
		  }else{
			  $numnav.='<a href="'.$BOOK_URL.'member/caicai.php?page='.$i.'" class="p_num">'.$i.'</a>';
		  }
	  }
  }
  $numnav.='<a class="p_num m">...</a>';
  if($page!=$pagenum && $page!=($pagenum-1)){
	  (($page+5)<=$pagenum)?$page_big=($page+5):$page_big=$pagenum;
	  $numnav.='<a href="'.$BOOK_URL.'member/caicai.php?page='.$page_big.'" class="p_num">'.$page_big.'</a>';  
  }
}
//ҳ���ַ���
$pageNav='
<div class="page_info">ÿҳ��ʾ<b>&nbsp;10&nbsp;</b>������<b>'.$total.'</b>��</div>
<div class="page_num">
  <div><a class="info">��<b>'.$page.'</b>ҳ/��'.$pagenum.'ҳ</a>'.$first.$pre.'</div>
  <div class="p_bar">'.$numnav.'</div>
  <div>'.$next.$last.'</div>
</div>
';

//�б�
$dsql->SetQuery($where_sql." order by id desc limit $offset,$num");
$dsql->Execute();
while($sbYou_neT_row=$dsql->GetObject())
{
	$topid=$sbYou_neT_row->topid;
	$sbyou_typeimg=ltrim($sbYou_neT_row->typeimg,'/');
	if(!$sbyou_typeimg){
		$randPICID=rand(1,50);
		$sbyou_typeimg="uploads/empty/".$randPICID.".jpg";
	}
	$sByou_NET_list.='
	<li>
	  <a href="'.$BOOK_URL.ltrim($sbYou_neT_row->typedir,'/').'/" target="_blank" class="preview"><img src="'.$BOOK_URL.$sbyou_typeimg.'" alt="" width="84"  height="112"/></a>
	  <div class="cbody">
		<a href="'.$BOOK_URL.ltrim($sbYou_neT_row->typedir,'/').'/" target="_blank" class="title">'.$sbYou_neT_row->typename.'</a> <span class="endpl">������£�<small>'.date('Y-m-d H:i:s',$sbYou_neT_row->lastupdate).'</small></span>
		<p class="intro">'.sbyou_nEt_cut_str($sbYou_neT_row->description,'90','0','gbk').'</p>
		<span class="info">
		  <small class="view">���:</small>'.$sbYou_neT_row->bookclick.'<small class="hpd">�Ƽ�:</small>'.$sbYou_neT_row->tuijian.'<small class="pl">����:</small>'.$sbYou_neT_row->booksize.'
		  <small class="btn">
		  [<a class="yd" href="'.$BOOK_URL.ltrim($sbYou_neT_row->typedir,'/').'/" target="_blank">�����Ķ�</a>]
		  [<a class="sm" href="'.$BOOK_URL.ltrim($sbYou_neT_row->typedir,'/').'/chapter.html" target="_blank">�鿴��Ŀ</a>]
		  [<a class="xz" href="'.$TXT_URL.'?topid='.$topid.'&id='.$sbYou_neT_row->id.'&date='.$sbYou_neT_row->lastupdate.'" target="_blank">����TXT</a>]
		  </small>
		</span>
	  </div>
	</li>
	';
}

//����ģ��
require_once(DEDEINC."/datalistcp.class.php");
$dlist = new DataListCP();
$dlist->SetTemplet(DEDEMEMBER.'/templets/caicai.htm');
$dlist->Display();
?>