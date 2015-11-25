<?php
//回调
function msg($msg_str,$forward){
	echo '
	<meta http-equiv="refresh" content="2;url='.$forward.'">
	<div style="width:300px;margin:0px auto;padding:20px 0px;font-size:14px;text-align:center;overflow:hidden;">'.$msg_str.'</div>
	';	
	return false;
}
//单个栏目小说数量
function sbyou_net_total($topid){
	$sbyou_net=mysql_query("select * from dede_arctype where topid=$topid and booksize!=0");
	$total=mysql_num_rows($sbyou_net);
	return $total;
}
//首页栏目块
function SByou_NET_caBlock($topid){
	global $dsql,$MOBILE_URL;
	$dsql->SetQuery("select * from dede_arctype where topid=$topid and booksize!=0 order by lastupdate desc limit 5");
	$dsql->Execute();
	while($sbyou_net=$dsql->GetObject())
	{
	  $sbyou_Net.='
	  ·<a href="'.$MOBILE_URL.'?caid='.$topid.'">'.str_replace('·','',SBYOU_NET_catalog($topid,'typename')).'</a>|<a href="'.$MOBILE_URL.'page.php?aid='.$sbyou_net->id.'">'.$sbyou_net->typename.'</a>：'.$sbyou_net->zuozhe.'<br />
	  ';
	}
	$sbyou_Net='<div class="kind"><h1>'.SBYOU_NET_catalog($topid,'typename').'</h1></div><div class="list">'.$sbyou_Net.'</div>';
	return $sbyou_Net;
}
//最新章节
function SbYOU_Net_newChapter($id){
	global $dsql,$MOBILE_URL;
	$SbYou_Net=$dsql->GetOne("select * from dede_archives where typeid=\"$id\" order by id desc limit 1");
	if($SbYou_Net['id']){
		$www_sbyou_net='<a href="archive.php?aid='.$SbYou_Net['id'].'" class="data new">'.$SbYou_Net['title'].'</a>';
	}else{
		$www_sbyou_net='<a href="javascript:(0)" class="data">还没有统计最新章节</a>';
	}
	return $www_sbyou_net;
}
?>