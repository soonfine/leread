<?php
$caid=$_GET[caid];
?>

<div class="body">
  <div class="floor_head">
    <h1>
      <?=SBYOU_NET_catalog($caid,'typename');?>
    </h1>
  </div>
  <div id="ca_list">
    <div class="goodsBody ca"> <a href="javascript:(0)" class="data" style="line-height:52px;border:none;"><img src="<?=$TOUCH_URL;?>images/loading_data.gif" style="display:inline;" />&nbsp;正在加载内容...</a> 
      <!--栏目小说列表--> 
    </div>
  </div>
  <script type="text/javascript">call_ca_list('<?=$caid;?>',1);</script> 
</div>
