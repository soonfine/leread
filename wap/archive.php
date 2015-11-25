<?php
$page_id='archive';
include_once dirname(__FILE__).'/header.php';

$id=$_GET['aid'];
//副信息
$chapter_row=$dsql->GetOne("select * from dede_archives where id='$id' limit 1");
//主信息
$arc_row=$dsql->GetOne("select * from dede_arctype where id='$chapter_row[typeid]' limit 1");

if(!$arc_row['id']){
	msg('抱歉，暂时找不到相关章节！正在返回首页！',$MOBILE_URL);
	include_once dirname(__FILE__).'/footer.php';
	exit;
}

//页头相关
echo '
<script type="text/javascript">
	function get_id(id){return document.getElementById(id);}
	get_id("h_page").href="'.$MOBILE_URL.'page.php?aid='.$arc_row['id'].'";
	get_id("h_list").href="'.$MOBILE_URL.'page.php?aid='.$arc_row['id'].'&list=1";
	get_id("h_fav").href="javascript:add_favorite(mid,mname,regdate,\''.$id.'\',\''.$row[chid].'\',\'1\');";
</script>
';

//上一章
$pre_row=$dsql->GetOne("select * from dede_archives where id<'$id' and typeid=$chapter_row[typeid] order by id desc limit 1");
if($pre_row['id']){
	$pre='<a href="'.$MOBILE_URL.'archive.php?aid='.$pre_row['id'].'">上一章</a>';
}else{
	$pre='<a href="javascript:(0)" class="none">无上一章</a>';
}
//下一章
$next_row=$dsql->GetOne("select * from dede_archives where id>'$id' and typeid=$chapter_row[typeid] order by id asc limit 1");
if($next_row['id']){
	$next='<a href="'.$MOBILE_URL.'archive.php?aid='.$next_row['id'].'">下一章</a>';
}else{
	$next='<a href="javascript:(0)" class="none">无下一章</a>';
}
?>

<div id="msg_box1"></div>
<div class="yd">
  <?='<a href="'.$MOBILE_URL.'page.php?aid='.$arc_row['id'].'&list=1">《'.$arc_row['typename'].'》</a><span class="fred fs">【'.($arc_row['overdate']?'完结':'连载').'】</span>';?>
</div>
<div class="pl" style="margin-bottom:0px">
  <?=$pre.'&nbsp;'.$next.'&nbsp;'.'<a href="javascript:add_favorite(mid,mname,regdate,\''.$id.'\',\'2\',\'1\');">加入书签</a>';?>
</div>
<div class="yd">
  <h3>
    <?=$chapter_row['title'];?>
  </h3>
  <?='更新时间：'.date('Y-m-d',$chapter_row['pubdate']).'';?>
  <br />
  <br />
  <?php
	$addonarticle_row=$dsql->GetOne("select * from dede_addonarticle where aid=$id limit 1");
	$sbyou_net_body=$addonarticle_row['body'];
	if(strlen($sbyou_net_body)=='46' || strlen($sbyou_net_body)=='35' || strlen($sbyou_net_body)=='48'){
		include_once DEDEINC.'/../dynamic/htmltxt/'.$sbyou_net_body.'.php';
		$encode=mb_detect_encoding($caccnt,array('ASCII','GB2312','GBK','UTF-8'));
		if($encode=='UTF-8'){
			$caccnt=iconv('UTF-8','GB2312//IGNORE',$caccnt);
		}
		echo $caccnt;
	}else{
		if(strpos($sbyou_net_body,'fhhk')){
			echo sbyou_NET_qidian($sbyou_net_body);
		}else{
			echo $sbyou_net_body;
		}
	}
  ?>
  <br />
  <br />
</div>
<div id="msg_box2"></div>
<div class="pl">
  <?=$pre.'&nbsp;'.$next.'&nbsp;'.'<a href="javascript:add_favorite(mid,mname,regdate,\''.$id.'\',\'2\',\'2\');">加入书签</a>';?>
</div>
<?php include_once dirname(__FILE__).'/footer.php';?>
