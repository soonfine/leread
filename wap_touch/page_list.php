<div id="msg_box1" class="msg_box_arc"></div>
<div class="log_box t list">
  <h2>
    <?=$arc_row['typename'];?>
  </h2>
</div>
<div id="page_list">
  <div class="goodsBody list"> <a href="javascript:(0)" class="data" style="border-top:none;"><img src="<?=$TOUCH_URL;?>images/loading_data.gif" style="display:inline;" />&nbsp;���ڼ�������...</a> 
    <!--�½��б�-->
    <p class="line"></p>
  </div>
</div>
<script type="text/javascript">call_page_list("<?=$arc_row['id'];?>",1);</script>
<div id="msg_box2" class="msg_box_arc"></div>
<p class="arc_btn"><a href="<?=$TOUCH_URL;?>?caid=<?=$arc_row['topid'];?>">������Ŀ</a>&nbsp;|&nbsp;<a href="<?=$TOUCH_URL;?>page.php?aid=<?=$arc_row['id'];?>">������ҳ</a>&nbsp;|&nbsp;<a href="javascript:add_favorite(mid,mname,regdate,'<?=$arc_row['id'];?>','1','2');">����ղ�</a>&nbsp;|&nbsp;<a href="<?=$TOUCH_URL;?>adminm.php?action=favorites">���ղؼ�</a> </p>
