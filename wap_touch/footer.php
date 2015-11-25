<center>
  <script type="text/javascript" src="<?=$BOOK_URL;?>plus/ad_js.php?aid=17"></script>
</center>
<div class="seach">
  <form action="<?=$TOUCH_URL;?>search.php" method="post">
    <input type="hidden" name="forward" value="<?=$forward;?>" />
    <input type="text" name="searchword" id="searchword" value="<?=$searchword;?>" class="text">
    <input type="submit" class="button" value="">
  </form>
</div>
<div class="footer footer_b">
  <?php
  if($page_id!='log'){
	  $f_str='
		<p class="user_info">
			<span class="logreg"><script type="text/javascript" src="'.$FULL_URL.'login.php?mode=js&to=wap_touch_bot&t='.time().'"></script></span>
			<span class="c_gotop"><a href="javascript:Top();">top<b></b></a></span>
		</p>
	  ';
  }else{
	  $f_str='';
  }
  echo $f_str;
  ?>
  <p class="gwc"> <a class="a1" href="<?=$TOUCH_URL;?>">首页</a> <a class="a2" href="<?=$TOUCH_URL;?>all.php">全部分类</a> <a class="a3" href="<?=$TOUCH_URL;?>paihang.php">排行榜</a> <a class="a4" href="<?=$TOUCH_URL;?>tuwen.php">图文推荐</a> </p>
  <p class="phone"><b></b><span><a href="<?=$TOUCH_URL;?>">
    <?=$HOSTNAME;?>
    </a> </span></p>
  <p class="copy">与PC站同步更新&nbsp;&nbsp;北京时间： 
    <script>var myDate=new Date();if(myDate.getMinutes()<10){var m='0'+myDate.getMinutes();}else{var m=myDate.getMinutes();};document.write(myDate.getHours()+':'+m);</script> 
  </p>
</div>
<img src="<?=$TOUCH_URL;?>images/hm.gif" width="0" height="0">
</body></html>