<script type="text/javascript" src="<?=$BOOK_URL;?>plus/ad_js.php?aid=17"></script>
<div class="search">
  <form action="<?=$MOBILE_URL;?>search.php" method="post">
    <input type="text" name="searchword" maxlength="15" style="width:135px" />
    <input type="submit" name="searchsubmit" value="搜索" />
  </form>
</div>
<div class="bot"> <a href="<?=$MOBILE_URL;?>paihang.php">排行榜</a>-<a href="<?=$MOBILE_URL;?>all.php">小说书库</a>-<a href="<?=$MOBILE_URL;?>">首页</a><br />
  <?php
	$dsql->SetQuery("select * from dede_arctype where topid=0 and id!=45 and id!=375 and id!=376 order by sortrank asc limit 6");
	$dsql->Execute();
	while($row=$dsql->GetObject())
	{
		$ca_bot_i++;	
		$ca_bot_id=$row->id;
		$ca_bot_typename=str_replace('·','',$row->typename);
		if($ca_bot_i%3==0){
			$fen='<br />';
		}else{
			$fen='|';
		}
		$ca_bot_list.='<a href="'.$MOBILE_URL.'?caid='.$ca_bot_id.'">'.$ca_bot_typename.'</a>'.$fen;
	}
	echo $ca_bot_list;
	?>
  <span>北京时间：</span> 
  <script>var myDate=new Date();if(myDate.getMinutes()<10){var m='0'+myDate.getMinutes();}else{var m=myDate.getMinutes();};document.write(myDate.getHours()+':'+m);</script> 
</div>
</body></html>