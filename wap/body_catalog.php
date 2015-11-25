<?php
$caid=$_GET['caid'];
?>

<div id="ca_list" class="list">
  <div class="goodsBody ca"><br />
    <img src="<?=$MOBILE_URL;?>images/loading_data.gif" />&nbsp;正在加载内容...<br />
    <br />
    <!--栏目小说列表--> 
  </div>
  <p class="page ca"> 
    <!--页码--> 
  </p>
</div>
<script type="text/javascript">call_ca_list('<?=$caid;?>',1);</script> 
