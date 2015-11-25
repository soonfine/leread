<div class="yd">
  <?='<a href="'.$MOBILE_URL.'page.php?aid='.$id.'">《'.$arc_row['typename'].'》</a><span class="fred fs">【'.($arc_row['overdate']?'完结':'连载').'】</span>';?>
</div>
<div class="kind">
  <h1>本书书目</h1>
</div>
<div id="page_list">
  <div class="list"><br />
    <img src="<?=$MOBILE_URL;?>images/loading_data.gif" />&nbsp;正在加载内容...<br />
    <br />
    <!--章节列表--> 
  </div>
  <p class="page"> 
    <!--页码--> 
  </p>
</div>
<script type="text/javascript">call_page_list("<?=$arc_row['id'];?>",1);</script>
<div id="msg_box"></div>
<div class="pl"><a href="javascript:add_favorite(mid,mname,regdate,'<?=$arc_row['id'];?>','1','');">加入收藏</a>|<a href="<?=$MOBILE_URL;?>adminm.php?action=favorites">打开书架</a> </div>
