<?php
error_reporting(0);
//���а�
$page_id='paihang';
$caid=$_GET['caid'];
include_once 'header.php';

$typename=SBYOU_NET_catalog($caid,'typename');
?>

<div class="body">
  <div class="floor_head">
    <h1>
      <?='['.($typename?$typename:'ȫվ').']���а�';?>
    </h1>
  </div>
  <div id="ph_list">
    <div class="goodsBody ca"> <a href="javascript:(0)" class="data" style="line-height:52px;border:none;"><img src="<?=$TOUCH_URL;?>images/loading_data.gif" style="display:inline;" />&nbsp;���ڼ�������...</a> 
      <!--��ĿС˵�б�--> 
    </div>
  </div>
  <script type="text/javascript">call_ph_list('<?=$caid;?>',1);</script> 
</div>
<?php include_once 'footer.php';?>