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
function SByou_NET_caBlock($topid,$id){
	global $dsql,$TOUCH_URL;
	if($id=='1'){
		$sbyou_Net='<a href="'.$TOUCH_URL.'?caid='.$topid.'">'.SBYOU_NET_catalog($topid,'typename').'</a>';
	}
	if($id=='2'){
		$dsql->SetQuery("select * from dede_arctype where topid=$topid and booksize!=0 order by id desc limit 5");
		$dsql->Execute();
		while($sbyou_net=$dsql->GetObject())
		{
				$arcURL='page.php?aid='.$sbyou_net->id;//简介页链接
				$booksize=$sbyou_net->booksize;
				$catalog='['.SBYOU_NET_catalog($sbyou_net->topid,'typename').']&nbsp;';
				$overdate=$sbyou_net->overdate;
				$overdate?$overdate='完结':$overdate='连载';
				
				$ii++;
				$ii==1?$class=' style="border-top:none;"':$class='';
				//条目
				$sbyou_Net.='
				<a href="'.$arcURL.'" class="data"'.$class.'>'.$sbyou_net->typename.'<span class="s1">'.$catalog.'作者:'.$sbyou_net->zuozhe.'</span><span class="s2">'.date('Y-m-d',$sbyou_net->lastupdate).'</span><span class="s3">'.$overdate.'，'.$booksize.'字</span></a>
				';
		}
	}
	if($id=='3'){
		$dsql->SetQuery("select * from dede_arctype where topid=$topid and booksize!=0 order by bookclick desc limit 10");
		$dsql->Execute();
		while($sbyou_net=$dsql->GetObject())
		{
			$sbyou_Net.='<a href="'.$TOUCH_URL.'page.php?aid='.$sbyou_net->id.'">'.$sbyou_net->typename.'</a>';
		}
	}
	if($id=='4'){
		$sbyou_Net='<a href="'.$TOUCH_URL.'?caid='.$topid.'" class="greet"><span>更多['.SBYOU_NET_catalog($topid,'typename').']小说</span><b></b></a>';
	}
	return $sbyou_Net;
}
//最新章节
function SbYOU_Net_newChapter($id){
	global $dsql,$TOUCH_URL;
	$SbYou_Net=$dsql->GetOne("select * from dede_archives where typeid=\"$id\" order by id desc limit 1");
	if($SbYou_Net['id']){
		$www_sbyou_net='<a href="archive.php?aid='.$SbYou_Net['id'].'" class="data new"><span>'.$SbYou_Net['title'].'</span><em>最近更新：'.date('Y-m-d H:i:s',$SbYou_Net['pubdate']).'</em><b></b></a>';
	}else{
		$www_sbyou_net='<a href="javascript:(0)" class="data"><span>还没有统计最新章节</span><i></i><b></b></a>';
	}
	return $www_sbyou_net;
}
?>