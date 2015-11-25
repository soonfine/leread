<?php
/*-----------------
独立功能PHP程序
开发者：枯叶天
淘宝店铺：669977.TaoBao.com
演示站：www.SBYOU.net
官网：www.669977.net
QQ：1981255858
-----------------*/

$sbyou_net='ph';

require_once(dirname(__FILE__)."/include/common.inc.php");

//相关变量
$BOOK_URL=sbyou_net_sysconfig('cfg_basehost').sbyou_net_sysconfig('cfg_indexurl');
$cfg_indexurl=sbyou_net_sysconfig('cfg_indexurl');
$templets=$cfg_indexurl.'templets/'.sbyou_net_sysconfig('cfg_df_style');

//更新时间
$now_time='更新时间:'.date('Y-m-d H:i:s',time());

//各种榜单
function panghang($obj,$id1,$id2){
	if(!is_numeric($obj)){
		$topid=' topid!=0 and topid!=45 and booksize!=0';
	}else{
		$topid=' topid='.$obj.' and booksize!=0';
		$obj='bookclick';
	}
	global $dsql,$cfg_indexurl;
	$dsql->SetQuery("select * from dede_arctype where $topid order by $obj desc limit 10");
	$dsql->Execute();
	while($row=$dsql->GetObject())
	{
		$i++;
		$topid=$row->topid;

		$sbyou_typeimg=ltrim($row->typeimg,'/');
		if(!$sbyou_typeimg){
			$randPICID=rand(1,50);
			$sbyou_typeimg="uploads/empty/".$randPICID.".jpg";
		}

		$i==1?$class=' class="Li_Mover"':$class='';
		$phb.='
		<li onmouseover="Li_Mover(this,'.$id1.',\''.$id2.'\')"'.$class.'>
			<dl class="dl_0'.$i.'">
			<dt><em>'.$row->bookclick.'</em><a target="_blank" href="'.$cfg_indexurl.ltrim($row->typedir,'/').'/" title="'.$row->typename.'">'.$row->typename.'</a></dt>
			<dd>
				<div class="img"><a target="_blank" href="'.$cfg_indexurl.ltrim($row->typedir,'/').'/"><img src="'.$cfg_indexurl.$sbyou_typeimg.'"></a></div>
				<strong>类型：<a target="_blank" href="'.$cfg_indexurl.SBYOU_NET_catalog($topid,'typedir').'.html" title="'.str_replace('·','',SBYOU_NET_catalog($topid,'typename')).'">'.SBYOU_NET_catalog($topid,'typename').'</a></strong>
				<p>作者：<span><a href="'.$BOOK_URL.'author/?'.$row->id.'.html" title="'.$row->zuozhe.'" target="_blank">'.$row->zuozhe.'</a></span></p>
				<p>字数：'.$row->booksize.'</p>
				<p class="sc"><a href="javascript:ajax_favorite('.$row->id.',1);">[收藏本书]</a></p>
			</dd>
			</dl>
		</li>
		';
	}
	return $phb;
}

//加载模板
require_once(DEDEINC."/datalistcp.class.php");
$dlist = new DataListCP();
$dlist->SetTemplet($cfg_basedir.$cfg_templets_dir."/".$cfg_df_style."/paihang.htm");
$dlist->Display();
?>