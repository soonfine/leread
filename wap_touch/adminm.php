<?php
//��Ա����
$page_id='adminm';
include_once 'header.php';
?>

<div class="body">
  <div class="floor_head fav">
    <h1>��Ա����</h1>
  </div>
  <div id="fav_list" class="fav_list">
    <div class="goodsBody ca"> <a href="javascript:(0)" class="data" style="line-height:52px;border:none;"><img src="<?=$TOUCH_URL;?>images/loading_data.gif" style="display:inline;" />&nbsp;���ڼ�������...</a> 
      <!--�ղ��б�--> 
    </div>
  </div>
  <script>
  if(mid=='0'){
	  document.getElementById('fav_list').innerHTML='<br /><a href="login.php">��Ǹ������û�е�½�������ȵ�½��</a><br /><br />';
	  setTimeout(function(){window.location.href='<?=$TOUCH_URL;?>login.php'},1000);
  }else{
	  call_fav_list(mid,mname,regdate,"1",'');
  }
  </script> 
</div>
<?php include_once 'footer.php';?>