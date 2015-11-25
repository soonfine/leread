<div class="nav">
  <div class="link"> <a href="<?=$MOBILE_URL;?>paihang.php">排行榜</a>-<a href="<?=$MOBILE_URL;?>all.php">小说书库</a>-<a href="<?=$MOBILE_URL;?>">首页</a><br />
    <?php
		$dsql->SetQuery("select * from dede_arctype where topid=0 and id!=45 and id!=375 and id!=376 order by sortrank asc limit 6");
		$dsql->Execute();
		while($row=$dsql->GetObject())
		{
			$ca_top_i++;	
			$ca_top_id=$row->id;
			$ca_top_typename=str_replace('·','',$row->typename);
			if($ca_top_i%3==0){
				$fen='<br />';
			}else{
				$fen='|';
			}
			$ca_top_list.='<a href="'.$MOBILE_URL.'?caid='.$ca_top_id.'">'.$ca_top_typename.'</a>'.$fen;
		}
		echo $ca_top_list;
		?>
  </div>
</div>
<div class="search">
  <form action="<?=$MOBILE_URL;?>search.php" method="post">
    <input type="text" name="searchword" maxlength="15" style="width:135px" />
    <input type="submit" name="searchsubmit" value="搜索" />
  </form>
</div>
<div class="kind">
  <h1>风云榜<span><a href="<?=$MOBILE_URL;?>paihang.php">更多&gt;&gt;</a></span></h1>
</div>
<div class="list tj">
  <?php
		$dsql->SetQuery("select * from dede_arctype where topid!=0 and topid!=45 and booksize!=0 order by bookclick desc limit 5");
		$dsql->Execute();
		while($sbyou_net=$dsql->GetObject())
		{
			$fy_i++;
			$typeimg=ltrim($sbyou_net->typeimg,'/');
			if(!$typeimg){
					$randPICID=rand(1,50);
					$typeimg="uploads/empty/".$randPICID.".jpg";
			}
			if($fy_i=='1'){
				$LIST_STR.='
				<a href="'.$MOBILE_URL.'page.php?aid='.$sbyou_net->id.'"><img src="'.$BOOK_URL.$typeimg.'" width="84" height="112" /></a>
				<div class="text">
				  <h2><a href="'.$MOBILE_URL.'page.php?aid='.$sbyou_net->id.'">'.$sbyou_net->typename.'</a></h2>
				  <span class="fs fs16"> 作者：'.$sbyou_net->zuozhe.'<br>
				  点击：'.$sbyou_net->booksize.' </span>
				  <p class="fs">简介:'.$sbyou_net->description.'</p>
				</div>
				<div class="cl"></div>
				';
			}else{
				$LIST_STR.='
				<a href="'.$MOBILE_URL.'page.php?aid='.$sbyou_net->id.'">'.$sbyou_net->typename.'</a>：'.$sbyou_net->zuozhe.'<br />
				';
			}
		}
		echo $LIST_STR;
		$LIST_STR='';
  ?>
</div>
<div class="kind">
  <h1>分类推荐榜<span><a href="<?=$MOBILE_URL;?>?caid=4">玄幻</a>|<a href="<?=$MOBILE_URL;?>?caid=3">仙侠</a>|<a href="<?=$MOBILE_URL;?>?caid=2">都市</a></span></h1>
</div>
<div class="list">
  <?php
		$dsql->SetQuery("select * from dede_arctype where topid!=0 and topid!=45 and booksize!=0 order by lastupdate desc limit 5");
		$dsql->Execute();
		while($sbyou_net=$dsql->GetObject())
		{
			$LIST_STR.='
			·<a href="'.$MOBILE_URL.'?caid='.$sbyou_net->topid.'">'.str_replace('·','',SBYOU_NET_catalog($sbyou_net->topid,'typename')).'</a>|<a href="'.$MOBILE_URL.'page.php?aid='.$sbyou_net->id.'">'.$sbyou_net->typename.'</a>：'.$sbyou_net->zuozhe.'<br />
			';
		}
		echo $LIST_STR;
		$LIST_STR='';
  ?>
</div>
<div class="kind">
  <h1>字数推荐榜</h1>
</div>
<div class="list">
  <?php
		$dsql->SetQuery("select * from dede_arctype where topid!=0 and topid!=45 and booksize!=0 order by booksize desc limit 5");
		$dsql->Execute();
		while($sbyou_net=$dsql->GetObject())
		{
			$LIST_STR.='
			·<a href="'.$MOBILE_URL.'?caid='.$sbyou_net->topid.'">'.str_replace('·','',SBYOU_NET_catalog($sbyou_net->topid,'typename')).'</a>|<a href="'.$MOBILE_URL.'page.php?aid='.$sbyou_net->id.'">'.$sbyou_net->typename.'</a>：共'.$sbyou_net->booksize.'字<br />
			';
		}
		echo $LIST_STR;
		$LIST_STR='';
  ?>
</div>

<script type="text/javascript" src="<?=$BOOK_URL;?>plus/ad_js.php?aid=18"></script> 

<!--奇幻 开始-->
<?=SByou_NET_caBlock('11');?>
<!--奇幻 结束--> 

<!--武侠 开始-->
<?=SByou_NET_caBlock('22');?>
<!--武侠 结束--> 

<!--都市 开始-->
<?=SByou_NET_caBlock('33');?>
<!--都市 结束--> 

<script type="text/javascript" src="<?=$BOOK_URL;?>plus/ad_js.php?aid=19"></script> 

<!--历史 开始-->
<?=SByou_NET_caBlock('44');?>
<!--历史 结束--> 

<!--游戏 开始-->
<?=SByou_NET_caBlock('55');?>
<!--游戏 结束--> 

<!--科幻 开始-->
<?=SByou_NET_caBlock('66');?>
<!--科幻 结束--> 

