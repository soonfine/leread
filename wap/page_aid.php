<?php
if($arc_row['booksize']>=1000000){
	$bw='<b>百万</b>';
}else{
	$bw='';
}
?>

<div class="tj">
  <div class="text">
    <h2>
      <?='<a href="'.$MOBILE_URL.'page.php?aid='.$id.'&list=1">《'.$arc_row['typename'].'》</a><span class="fred fs">【'.($arc_row['overdate']?'完结':'连载').'】</span>';?>
    </h2>
    <span class="fs">
    <?='作者:'.$arc_row['zuozhe'];?>
    </span><br />
    <span class="fs">
    <?='总点击:'.$arc_row['bookclick'].'&nbsp;&nbsp;月点击:'.$arc_row['bookclickm'].' &nbsp;&nbsp;周点击:'.$arc_row['bookclickw'];?>
    </span><br />
    <span class="fs">
    <?='总推荐:'.$arc_row['tuijian'].'&nbsp;&nbsp;月推荐:'.$arc_row['tuijianm'].' &nbsp;&nbsp;周推荐:'.$arc_row['tuijianw'];?>
    </span><br />
    <span class="fs">
    <?='最新章节:'.SbYOU_Net_newChapter($id);?>
    </span> </div>
</div>
<div class="pl"> <a href="<?=$MOBILE_URL;?>page.php?aid=<?=$id;?>&list=1">查看书目</a> </div>
<script type="text/javascript" src="<?=$BOOK_URL;?>plus/ad_js.php?aid=20"></script>
<p class="pl3"> 作品简介:<br />
  <?=$arc_row['description'];?>
</p>
<div id="msg_box"></div>
<div class="pl"> <a href="<?=$MOBILE_URL;?>page.php?aid=<?=$id;?>&list=1">点击阅读</a>|<a href="javascript:add_favorite(mid,mname,regdate,'<?=$id;?>','1','');">加入收藏</a>|<a href="<?=$MOBILE_URL;?>adminm.php?action=favorites">打开书架</a> </div>
<div class="kind">
  <h1>热门随机推荐</h1>
</div>
<div class="list">
  <?php
	$dsql->SetQuery("select * from dede_arctype where topid=$arc_row[topid] order by rand() limit 3");
	$dsql->Execute();
	while($sbyou_net=$dsql->GetObject())
	{
		$typeimg=ltrim($sbyou_net->typeimg,'/');
		if(!$typeimg){
			$randPICID=rand(1,50);
			$typeimg="uploads/empty/".$randPICID.".jpg";
		}
		
		if($sbyou_net->booksize){
			$s_str='<span>百万</span>';
		}else{
			$s_str='';
		}
		//列表
	  $LIST_STR.='
	  ·<a href="'.$MOBILE_URL.'page.php?aid='.$sbyou_net->id.'">'.$sbyou_net->typename.'</a>：'.$sbyou_net->zuozhe.'<br />
	  ';
		//更新数据
		$dsql->ExecuteNoneQuery("update dede_arctype set bookclick=bookclick+3,bookclickm=bookclickm+1,bookclickw=bookclickw+1 where id=$sbyou_net->id limit 1");
	}
  echo $LIST_STR;
  $LIST_STR='';

  ?>
</div>
