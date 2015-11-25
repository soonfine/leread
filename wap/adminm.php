<?php
//会员中心
$page_id='adminm';
include_once 'header.php';
?>

<div id="fav_list"><br />
  <img src="<?=$MOBILE_URL;?>images/loading_data.gif" />&nbsp;正在加载内容...<br />
  <br />
  <!--收藏列表--> 
</div>
<script>
  if(mid=='0'){
	  document.getElementById('fav_list').innerHTML='<br /><a href="login.php">抱歉，您还没有登陆，请您先登陆！</a><br /><br />';
	  setTimeout(function(){window.location.href='<?=$MOBILE_URL;?>login.php'},1000);
  }else{
	  call_fav_list(mid,mname,regdate,"1",'');
  }
</script>
<?php include_once 'footer.php';?>