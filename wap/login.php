<?php
$page_id='log';
include_once dirname(__FILE__).'/base.inc.php';

include_once 'header.php';
if($forward==$BOOK_URL.'member/index_do.php'){
	$forward=$MOBILE_URL.'login.php';
}
?>
<script>document.write("<script src='<?=$BOOK_URL;?>sb.login.php?entry=permissions&t="+(new Date).getTime()+"'></s"+"cript>");</script>

<div class="dl" id="box">
  <p>δ�����ʺţ�����<a href="<?=$MOBILE_URL;?>register.php?forward=<?=$forward;?>" id="regA">����ע��</a></p>
  <form action="<?=$BOOK_URL;?>member/index_do.php" method="post" name="logForm">
    <input type="hidden" name="fmdo" value="login">
    <input type="hidden" name="dopost" value="login">
    <input type="hidden" name="gourl" value="<?=$forward;?>">
    �û�����<br>
    <input id="txtUsername" name="userid" type="text" value="">
    <br>
    ���룺<br>
    <input id="txtPassword" name="pwd" type="password">
    <br>
    ��֤�룺<br>
    <input id="vdcode" name="vdcode" type="text" maxlength="4">
    <br>
    <img src="<?=$BOOK_URL;?>include/vdimgck.php" id="vdimgck"><a href="javascript:vdimgck.src='<?=$BOOK_URL;?>include/vdimgck.php?t='+(new Date).getTime()" style="position:relative; top:-5px;">&nbsp;ˢ����֤��</a><br>
    <input type="submit" name="btnSignCheck" id="btnSignCheck" value="��¼">
  </form>
</div>
<script>
if(mid!='0'){
	document.getElementById("box").innerHTML="<p style=\"text-align:center;line-height:30px;padding-top:20px;font-size:14px;\">��ϲ�����Ѿ���½��</p>";
	setTimeout(function(){window.location.href="<?=$MOBILE_URL;?>"},1000);
}
</script>
<?php include_once 'footer.php';?>
