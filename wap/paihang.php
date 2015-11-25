<?php
error_reporting(0);
//排行榜
$page_id='paihang';
$caid=$_GET['caid'];
include_once 'header.php';
?>

<div id="ph_list" class="list">
  <div class="goodsBody ca"><br />
    <img src="<?=$MOBILE_URL;?>images/loading_data.gif" />&nbsp;正在加载内容...<br />
    <br />
    <!--栏目小说列表--> 
  </div>
  <p class="page ca"> 
    <!--页码--> 
  </p>
</div>
<script type="text/javascript">call_ph_list('<?=$caid;?>',1);</script>
<?php include_once 'footer.php';?>