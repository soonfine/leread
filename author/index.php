<?php
/*-----------------
��������PHP����
�����ߣ���Ҷ��
�Ա����̣�669977.TaoBao.com
��ʾվ��www.SBYOU.net
������www.669977.net
QQ��1981255858
-----------------*/

$sbyou_net='author';

require_once(dirname(__FILE__)."/../include/common.inc.php");

//��ر���
$BOOK_URL=sbyou_net_sysconfig('cfg_basehost').sbyou_net_sysconfig('cfg_indexurl');
$cfg_indexurl=sbyou_net_sysconfig('cfg_indexurl');
$templets=$cfg_indexurl.'templets/'.sbyou_net_sysconfig('cfg_df_style');

$id=str_replace('.html','',trim($_SERVER['QUERY_STRING']));
if(!$id || !is_numeric($id)){
	header('location:'.$BOOK_URL);
}
$sbyou_net2=$dsql->GetOne("select zuozhe from dede_arctype where id='$id' limit 1");
$zuozhe=$sbyou_net2['zuozhe'];
if(!$zuozhe){
	header('location:'.$BOOK_URL);
}

//����ģ��
require_once(DEDEINC."/datalistcp.class.php");
$dlist = new DataListCP();
$dlist->SetTemplet($cfg_basedir.$cfg_templets_dir."/".$cfg_df_style."/author.htm");
$dlist->Display();
?>
