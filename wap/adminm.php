<?php
//��Ա����
$page_id='adminm';
include_once 'header.php';
?>

<div id="fav_list"><br />
  <img src="<?=$MOBILE_URL;?>images/loading_data.gif" />&nbsp;���ڼ�������...<br />
  <br />
  <!--�ղ��б�--> 
</div>
<script>
  if(mid=='0'){
	  document.getElementById('fav_list').innerHTML='<br /><a href="login.php">��Ǹ������û�е�½�������ȵ�½��</a><br /><br />';
	  setTimeout(function(){window.location.href='<?=$MOBILE_URL;?>login.php'},1000);
  }else{
	  call_fav_list(mid,mname,regdate,"1",'');
  }
</script>
<?php include_once 'footer.php';?>