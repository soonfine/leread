<?php
/*-----------------
��������PHP����
�����ߣ���Ҷ��
�Ա����̣�669977.TaoBao.com
��ʾվ��www.SBYOU.net
������www.669977.net
QQ��1981255858
-----------------*/

require_once(dirname(__FILE__)."/include/common.inc.php");

//����С˵id
$id=htmlspecialchars($_GET['id']);
if(!$id){
	SBYOU_net_error('1','��ָ����ȷ���ĵ���');
}
if(!is_numeric($id)){
	$id='/'.$id;	
	$id_row=$dsql->GetOne("select * from dede_arctype where typedir='$id' and topid!=45 order by id desc limit 1");
	if(!$id_row['id']){
		SBYOU_net_error('1','��ָ����ȷ���ĵ���');
	}	
	$id=$id_row['id'];
	$topid=$id_row['topid'];
}

$sbyou_net=$topid;

//��ر���
$BOOK_URL=sbyou_net_sysconfig('cfg_basehost').sbyou_net_sysconfig('cfg_indexurl');
$cfg_indexurl=sbyou_net_sysconfig('cfg_indexurl');
$templets=$cfg_indexurl.'templets/'.sbyou_net_sysconfig('cfg_df_style');

//С˵����
$arctype_row=$dsql->GetOne("select * from dede_arctype where id=$id limit 1");
//С˵�½�
$dsql->SetQuery("select * from dede_archives where typeid=$id order by chapter_no asc,id asc");
$dsql->Execute();
while($archives_row=$dsql->GetObject())
{
	$list.='<li><a href="'.$cfg_indexurl.str_replace('/','',$arctype_row['typedir']).'/'.$archives_row->id.'.html" title="'.$archives_row->title.'" target="_blank">'.$archives_row->title.'</a></li>';
}
//��ǰ��Ŀ
$catalog=SBYOU_NET_catalog($arctype_row['topid'],'typename');
$catalog_typedir=SBYOU_NET_catalog($arctype_row['topid'],'typedir');
//����ģ��
require_once(DEDEINC."/datalistcp.class.php");
$dlist = new DataListCP();
$dlist->SetTemplet($cfg_basedir.$cfg_templets_dir."/".$cfg_df_style."/chapter.htm");
$dlist->Display();
?>
