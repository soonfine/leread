<?php
$page_id='archive';
include_once dirname(__FILE__).'/header.php';

$id=$_GET['aid'];
//����Ϣ
$chapter_row=$dsql->GetOne("select * from dede_archives where id='$id' limit 1");
//����Ϣ
$arc_row=$dsql->GetOne("select * from dede_arctype where id='$chapter_row[typeid]' limit 1");

if(!$arc_row['id']){
	msg('��Ǹ����ʱ�Ҳ�������½ڣ����ڷ�����ҳ��',$TOUCH_URL);
	include_once dirname(__FILE__).'/footer.php';
	exit;
}

//ҳͷ���
echo '
<script type="text/javascript">
	function get_id(id){return document.getElementById(id);}
	get_id("h_page").href="'.$TOUCH_URL.'page.php?aid='.$arc_row['id'].'";
	get_id("h_list").href="'.$TOUCH_URL.'page.php?aid='.$arc_row['id'].'&list=1";
</script>
';

//��һ��
$pre_row=$dsql->GetOne("select * from dede_archives where id<'$id' and typeid=$chapter_row[typeid] order by id desc limit 1");
if($pre_row['id']){
	$pre='<a href="'.$TOUCH_URL.'archive.php?aid='.$pre_row['id'].'" class="left">��һ��</a>';
}else{
	$pre='<a href="javascript:(0)" class="left none">����һ��</a>';
}
//��һ��
$next_row=$dsql->GetOne("select * from dede_archives where id>'$id' and typeid=$chapter_row[typeid] order by id asc limit 1");
if($next_row['id']){
	$next='<a href="'.$TOUCH_URL.'archive.php?aid='.$next_row['id'].'" class="left right">��һ��</a>';
}else{
	$next='<a href="javascript:(0)" class="left right none">����һ��</a>';
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
<p class="arc_btn"> <a class="a1" href="<?=$TOUCH_URL;?>page.php?aid=<?=$arc_row['id'];?>">������ҳ</a>&nbsp;|&nbsp;<a class="a2" href="<?=$TOUCH_URL;?>page.php?aid=<?=$arc_row['id'];?>&list=1">����Ŀ¼</a>&nbsp;|&nbsp;<a class="a3" href="javascript:add_favorite(mid,mname,regdate,'<?=$id;?>','2','2');">�����ǩ</a>&nbsp;|&nbsp;<a class="a4" href="<?=$TOUCH_URL;?>adminm.php?action=favorites">���ղؼ�</a> </p>
<?php include_once dirname(__FILE__).'/footer.php';?>
