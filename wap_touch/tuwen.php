<?php
//排行榜
$page_id='tuwen';
include_once 'header.php';
?>

<div class="body">
  <div class="floor_head">
    <h1>图文推荐</h1>
  </div>
  <div id="tuwen">
    <div class="listBody nyBody g tw"> <a href="javascript:(0)" class="data" style="line-height:14px;border:none;position: relative;top:8px;"><img src="<?=$TOUCH_URL;?>images/loading_data.gif" style="display:inline;" />&nbsp;正在加载内容...</a>
      <!--图文小说列表-->
    </div>
  </div>
  <script type="text/javascript">call_tuwen('','1','');</script>
</div>
<?php include_once 'footer.php';?>