<?php
/*-----------------
��������PHP����
�����ߣ���Ҷ��
�Ա����̣�669977.TaoBao.com
��ʾվ��www.SBYOU.net
������www.669977.net
QQ��1981255858
-----------------*/

$sbyou_net='over';

require_once(dirname(__FILE__)."/include/common.inc.php");

//������Ŀҳ��
$page=htmlspecialchars($_GET['page']);
if(!$page || !is_numeric($page)){
	$page=1;
}

//��ر���
$BOOK_URL=sbyou_net_sysconfig('cfg_basehost').sbyou_net_sysconfig('cfg_indexurl');
$cfg_indexurl=sbyou_net_sysconfig('cfg_indexurl');
$templets=$cfg_indexurl.'templets/'.sbyou_net_sysconfig('cfg_df_style');

//ҳ��
$entry='shuku';
include_once dirname(__FILE__).'/pageNav.php';

//�б�
$dsql->SetQuery($where_sql." order by id desc limit $offset,$num");
$dsql->Execute();
while($list_row=$dsql->GetObject())
{
	$topid=$list_row->topid;

	if($list_row->zuozhe){
	$list_zz='<a style="color:#025b81;" href="'.$cfg_indexurl.'author/?'.$list_row->id.'.html" target="_blank" title="'.$list_row->zuozhe.'">'.$list_row->zuozhe.'</a>';
	}else{
	$list_zz='<font style="color:#343434;">δ��¼</font>';
	}
	
	$gxlb_i++;$gxlb_i%2==0?$class=' class="odd"':$class='';
	$list_str.='
	<li'.$class.'>
	  <div class="c"><a href="'.$cfg_indexurl.SBYOU_NET_catalog($topid,'typedir').'.html" title="'.str_replace('��','',SBYOU_NET_catalog($topid,'typename')).'">['.str_replace('��','',SBYOU_NET_catalog($topid,'typename')).']</a></div>
	  <div class="title">
		<div class="t"><a href="'.$cfg_indexurl.ltrim($list_row->typedir,'/').'/" title="'.$list_row->typename.'" target="_blank">'.$list_row->typename.'</a></div>
		<div class="n">'.SbYOU_Net_NEW($list_row->id,ltrim($list_row->typedir,'/')).'</div>
	  </div>
	  <div class="words">'.$list_row->booksize.'</div>
	  <div class="author">'.$list_zz.'</div>
	  <div class="abover">'.($list_row->overdate==0?'<span>����</span>':'<font style="color:blue">���</font>').'</div>
	  <div class="time">'.date('Y-m-d',$list_row->lastupdate).'</div>
	</li>
	';
}

//����ģ��
require_once(DEDEINC."/datalistcp.class.php");
$dlist = new DataListCP();
$dlist->SetTemplet($cfg_basedir.$cfg_templets_dir."/".$cfg_df_style."/shuku.htm");
$dlist->Display();
?>
