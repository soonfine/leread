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
	$id_row=$dsql->GetOne("select * from dede_arctype where typedir='$id' and topid!=45 limit 1");
	if(!$id_row['id']){
		SBYOU_net_error('1','��ָ����ȷ���ĵ���');
	}	
	$id=$id_row['id'];
}

//��ر���
$BOOK_URL=sbyou_net_sysconfig('cfg_basehost').sbyou_net_sysconfig('cfg_indexurl');
$cfg_indexurl=sbyou_net_sysconfig('cfg_indexurl');
$templets=$cfg_indexurl.'templets/'.sbyou_net_sysconfig('cfg_df_style');

//С˵����
$arctype_row=$dsql->GetOne("select * from dede_arctype where id=$id limit 1");
//��ǰ��Ŀ
$catalog=SBYOU_NET_catalog($arctype_row['topid'],'typename');
$catalog_typedir=SBYOU_NET_catalog($arctype_row['topid'],'typedir');
//������
$dsql->SetQuery("select * from dede_arctype where topid=$arctype_row[topid] order by bookclick desc limit 10");
$dsql->Execute();
while($hao_row=$dsql->GetObject())
{
	$hao_i++;
	$sbyou_typeimg=ltrim($hao_row->typeimg,'/');
	if(!$sbyou_typeimg){
		$randPICID=rand(1,50);
		$sbyou_typeimg="uploads/empty/".$randPICID.".jpg";
	}
	$hao_list.='<li><a href="'.$cfg_indexurl.ltrim($hao_row->typedir,'/').'/" title="'.$hao_row->typename.'" target="_blank">'.$hao_row->typename.'</a>&nbsp;<font style="color:green;">['.$hao_row->booksize.'��]</font><span><a href="'.$cfg_indexurl.'author/?'.$hao_row->id.'.html" target="_blank" title="'.$hao_row->zuozhe.'">'.$hao_row->zuozhe.'</a></span></li>';
	if($hao_i=='1'){
		$hao_list.='
		<li class="first_con">
			<div class="pic"><a href="'.$cfg_indexurl.ltrim($hao_row->typedir,'/').'/" title="'.$hao_row->typename.'" target="_blank"> <img class="lazy" data-original="'.$cfg_indexurl.$sbyou_typeimg.'" alt="'.$hao_row->typename.'" /></a></div>
			<div class="a_l">
				<div class="a"><span>����:</span><a href="'.$cfg_indexurl.'author/?'.$hao_row->id.'.html" target="_blank" title="'.$hao_row->zuozhe.'">'.$hao_row->zuozhe.'</a></div>
				<div class="l"><span>����:</span><a href="'.$cfg_indexurl.$catalog_typedir.'.html" title="'.$arctype_row['typename'].'">'.$catalog.'</a></div>
			</div>
			<div class="info"><a href="'.$cfg_indexurl.ltrim($hao_row->typedir,'/').'/" title="'.$hao_row->typename.'" target="_blank">'.strip_tags($hao_row->description).'</a></div>
		</li>
		';
	}
}
//�ղذ�
$dsql->SetQuery("select * from dede_arctype where topid=$arctype_row[topid] order by id desc limit 10");
$dsql->Execute();
while($sou_row=$dsql->GetObject())
{
	$shou_i++;
	$sbyou_typeimg=ltrim($sou_row->typeimg,'/');
	if(!$sbyou_typeimg){
		$randPICID=rand(1,50);
		$sbyou_typeimg="uploads/empty/".$randPICID.".jpg";
	}
	$shou_list.='<li><a href="'.$cfg_indexurl.ltrim($sou_row->typedir,'/').'/" title="'.$sou_row->typename.'" target="_blank">'.$sou_row->typename.'</a>&nbsp;<font style="color:green;">['.$sou_row->booksize.'��]</font><span><a href="'.$cfg_indexurl.'author/?'.$sou_row->id.'.html" target="_blank" title="'.$sou_row->zuozhe.'">'.$sou_row->zuozhe.'</a></span></li>';
	if($shou_i=='1'){
		$shou_list.='
		<li class="first_con">
			<div class="pic"><a href="'.$cfg_indexurl.ltrim($sou_row->typedir,'/').'/" title="'.$sou_row->typename.'" target="_blank"> <img class="lazy" data-original="'.$cfg_indexurl.$sbyou_typeimg.'" alt="'.$sou_row->typename.'" /></a></div>
			<div class="a_l">
				<div class="a"><span>����:</span><a href="'.$cfg_indexurl.'author/?'.$sou_row->id.'.html" target="_blank" title="'.$sou_row->zuozhe.'">'.$sou_row->zuozhe.'</a></div>
				<div class="l"><span>����:</span><a href="'.$cfg_indexurl.$catalog_typedir.'.html" title="'.$arctype_row['typename'].'">'.$catalog.'</a></div>
			</div>
			<div class="info"><a href="'.$cfg_indexurl.ltrim($sou_row->typedir,'/').'/" title="'.$sou_row->typename.'" target="_blank">'.strip_tags($sou_row->description).'</a></div>
		</li>
		';
	}
}
//�Ҳ����а�
function page_right($obj,$topid){
	global $dsql,$cfg_indexurl;
	$dsql->SetQuery("select * from dede_arctype where topid=$topid order by $obj desc limit 10");
	$dsql->Execute();
	while($row=$dsql->GetObject())
	{
		$list.='<li><a href="'.$cfg_indexurl.ltrim($row->typedir,'/').'/" title="'.$row->typename.'" target="_blank">'.$row->typename.'</a>&nbsp;<font style="color:green;">['.$row->booksize.'��]</font><span>'.$row->bookclick.'</span></li>';
	}
	return $list;
}
//�༭����
$dsql->SetQuery("select * from dede_arctype where topid=$arctype_row[topid] order by tuijian desc limit 3");
$dsql->Execute();
while($bj_row=$dsql->GetObject())
{
	$sbyou_typeimg=ltrim($sbyou_net_row->typeimg,'/');
	if(!$sbyou_typeimg){
		$randPICID=rand(1,50);
		$sbyou_typeimg="uploads/empty/".$randPICID.".jpg";
	}
	$bj_list.='<div class="pic"><a href="'.$cfg_indexurl.ltrim($bj_row->typedir,'/').'/" title="'.$bj_row->typename.'" target="_blank"> <img class="lazy" data-original="'.$cfg_indexurl.$sbyou_typeimg.'" alt="'.$bj_row->typename.'" /></a></div>';
}
//�����¹���
$dsql->SetQuery("select * from dede_arctype where topid=$arctype_row[topid] order by id desc limit 5");
$dsql->Execute();
while($sbyou_net_weiInfo=$dsql->GetObject())
{
	$weiInfo_list.='<li><a href="'.$cfg_indexurl.ltrim($sbyou_net_weiInfo->typedir,'/').'/" title="'.$sbyou_net_weiInfo->typename.'" target="_blank">['.$catalog.']��'.$sbyou_net_weiInfo->typename.'��-- ������'.$sbyou_net_weiInfo->booksize.'&nbsp;&nbsp;���ߣ�'.$sbyou_net_weiInfo->zuozhe.'</a><span>['.date('Y-m-d H:i:s',$sbyou_net_weiInfo->lastupdate).']</span></li>';
}
//��ͼ������С˵
$dsql->SetQuery("select * from dede_arctype where topid=$arctype_row[topid] order by lastclick desc limit 20");
$dsql->Execute();
while($remen_row=$dsql->GetObject())
{
	$remen_list.='<a href="'.$cfg_indexurl.ltrim($remen_row->typedir,'/').'/" title="'.$remen_row->typename.'" target="_blank">'.$remen_row->typename.'</a>';
}
//����ģ��
require_once(DEDEINC."/datalistcp.class.php");
$dlist = new DataListCP();
$dlist->SetTemplet($cfg_basedir.$cfg_templets_dir."/".$cfg_df_style."/page.htm");
$dlist->Display();
?>