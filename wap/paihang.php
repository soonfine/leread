<?php
error_reporting(0);
//���а�
$page_id='paihang';
$caid=$_GET['caid'];
include_once 'header.php';
?>

<div id="ph_list" class="list">
  <div class="goodsBody ca"><br />
    <img src="<?=$MOBILE_URL;?>images/loading_data.gif" />&nbsp;���ڼ�������...<br />
    <br />
    <!--��ĿС˵�б�--> 
  </div>
  <p class="page ca"> 
    <!--ҳ��--> 
  </p>
</div>
<script type="text/javascript">call_ph_list('<?=$caid;?>',1);</script>
<?php include_once 'footer.php';?>