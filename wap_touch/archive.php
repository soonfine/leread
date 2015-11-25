<?php
$page_id='archive';
include_once dirname(__FILE__).'/header.php';

$id=$_GET['aid'];
//副信息
$chapter_row=$dsql->GetOne("select * from dede_archives where id='$id' limit 1");
//主信息
$arc_row=$dsql->GetOne("select * from dede_arctype where id='$chapter_row[typeid]' limit 1");

if(!$arc_row['id']){
	msg('抱歉，暂时找不到相关章节！正在返回首页！',$TOUCH_URL);
	include_once dirname(__FILE__).'/footer.php';
	exit;
}

//页头相关
echo '
<script type="text/javascript">
	function get_id(id){return document.getElementById(id);}
	get_id("h_page").href="'.$TOUCH_URL.'page.php?aid='.$arc_row['id'].'";
	get_id("h_list").href="'.$TOUCH_URL.'page.php?aid='.$arc_row['id'].'&list=1";
</script>
';

//上一章
$pre_row=$dsql->GetOne("select * from dede_archives where id<'$id' and typeid=$chapter_row[typeid] order by id desc limit 1");
if($pre_row['id']){
	$pre='<a href="'.$TOUCH_URL.'archive.php?aid='.$pre_row['id'].'" class="left">上一章</a>';
}else{
	$pre='<a href="javascript:(0)" class="left none">无上一章</a>';
}
//下一章
$next_row=$dsql->GetOne("select * from dede_archives where id>'$id' and typeid=$chapter_row[typeid] order by id asc limit 1");
if($next_row['id']){
	$next='<a href="'.$TOUCH_URL.'archive.php?aid='.$next_row['id'].'" class="left right">下一章</a>';
}else{
	$next='<a href="javascript:(0)" class="left right none">无下一章</a>';
}
?>

<div class="body arc">
  <div id="msg_box1" class="msg_box_arc"></div>
  <div class="log_box t">
    <h2>
      <?=$chapter_row['title'];?>
    </h2>
  </div>
  <div class="detail">
    <p></p>
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
    <p></p>
  </div>
  <p class="page arc">
    <?=$pre.$next;?>
  </p>
</div>
<div id="msg_box2" class="msg_box_arc"></div>
<p class="arc_btn"> <a class="a1" href="<?=$TOUCH_URL;?>page.php?aid=<?=$arc_row['id'];?>">返回书页</a>&nbsp;|&nbsp;<a class="a2" href="<?=$TOUCH_URL;?>page.php?aid=<?=$arc_row['id'];?>&list=1">返回目录</a>&nbsp;|&nbsp;<a class="a3" href="javascript:add_favorite(mid,mname,regdate,'<?=$id;?>','2','2');">添加书签</a>&nbsp;|&nbsp;<a class="a4" href="<?=$TOUCH_URL;?>adminm.php?action=favorites">打开收藏夹</a> </p>
<?php include_once dirname(__FILE__).'/footer.php';?>
