<?php
if($arc_row['booksize']>=1000000){
	$bw='<b>百万</b>';
}else{
	$bw='';
}
?>

<div class="goodsBody g">
  <dl class="goods">
    <div id="msg_box1" class="msg_box_arc1"></div>
    <dd>
      <p class="p1">
        <?='<a href="'.$TOUCH_URL.'page.php?aid='.$id.'&list=1">'.$arc_row['typename'].$bw.'</a>';?>
      </p>
      <p class="p2"><span class="span1">作者：</span><span class="span2">
        <?=$arc_row['zuozhe'];?>
        </span></p>
      <p class="p2"><span class="span1">类型：</span><span class="span2">
        <?=SBYOU_NET_catalog($id,'typename');?>
        </span></p>
      <p class="p2"><span class="span1">点击：</span><span class="span2">
        <?=$arc_row['bookclick'].'/'.$arc_row['bookclickm'].'/'.$arc_row['bookclickw'].'（总/月/周）';?>
        </span></p>
      <p class="p2"><span class="span1">字数：</span><span class="span2"><font>
        <?=$arc_row['booksize'];?>
        </font></span></p>
    </dd>
  </dl>
  <div class="jj_box"> 
    <script type="text/javascript" src="<?=$BOOK_URL;?>plus/ad_js.php?aid=20"></script>
    <?='<span>简介：（入库时间&nbsp;'.date('Y-m-d H:i',$arc_row['lastupdate']).'）</span>';?>
    <?=$arc_row['description'];?>
  </div>
  <div id="msg_box"></div>
  <p class="buy"> <a href="<?=$TOUCH_URL;?>page.php?aid=<?=$aid;?>&list=1" class="left">在线阅读</a><a href="<?=$TXT_URL.'?txt-'.$arc_row['topid'].'-'.$id.'-'.$arc_row['lastupdate'].'.html';?>" class="right txt" target="_blank">TXT下载</a> <a href="javascript:add_favorite(mid,mname,regdate,'<?=$aid;?>','1','');" class="right">加入收藏夹</a> </p>
  <?=SbYOU_Net_newChapter($id);?>
  <div class="data" style="cursor:text; border-bottom:none;"><span><font>热门小说</font><strong style="font-weight:normal; color:#EE2E5B;">最新最热小说随机推荐</strong></span></div>
</div>
<div class="listBody one p">
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
		<a href="'.$TOUCH_URL.'page.php?aid='.$sbyou_net->id.'">
		<dl class="goods">
			<dt><img src="'.$BOOK_URL.$typeimg.'">'.$s_str.'</dt>
			<dd><span class="span1">浏览'.$sbyou_net->booksize.'</span></dd>
			<dd>'.$sbyou_net->typename.'</dd>
		</dl>
		</a>
		';
		//更新数据
		$dsql->ExecuteNoneQuery("update dede_arctype set bookclick=bookclick+3,bookclickm=bookclickm+1,bookclickw=bookclickw+1 where id=$sbyou_net->id limit 1");
	}
  echo $LIST_STR;
  $LIST_STR='';
  ?>
</div>
