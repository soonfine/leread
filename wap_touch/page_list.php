<div id="msg_box1" class="msg_box_arc"></div>
<div class="log_box t list">
  <h2>
    <?=$arc_row['typename'];?>
  </h2>
      <br><a href="<?=$cfg_indexurl;?>error_report.php?id=<?=$arc_row['id'];?>"  target="_blank" title="error_report"><b>章节乱序/缺失/空白/错误请点击报错，我将会第一时间解决</b></a>
</div>
<div id="page_list">
  <div class="goodsBody list"> <a href="javascript:(0)" class="data" style="border-top:none;"><img src="<?=$TOUCH_URL;?>images/loading_data.gif" style="display:inline;" />&nbsp;正在加载内容...</a> 
    <!--章节列表-->
    <p class="line"></p>
  </div>
</div>
<script type="text/javascript">call_page_list("<?=$arc_row['id'];?>",1);</script>
<div id="msg_box2" class="msg_box_arc"></div>
<p class="arc_btn"><a href="<?=$TOUCH_URL;?>?caid=<?=$arc_row['topid'];?>">返回栏目</a>&nbsp;|&nbsp;<a href="<?=$TOUCH_URL;?>page.php?aid=<?=$arc_row['id'];?>">返回书页</a>&nbsp;|&nbsp;<a href="javascript:add_favorite(mid,mname,regdate,'<?=$arc_row['id'];?>','1','2');">添加收藏</a>&nbsp;|&nbsp;<a href="<?=$TOUCH_URL;?>adminm.php?action=favorites">打开收藏夹</a> </p>
