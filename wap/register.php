<?php
$page_id='reg';
include_once dirname(__FILE__).'/base.inc.php';

include_once 'header.php';
if($forward==$BOOK_URL.'member/index_do.php?fmdo=user&dopost=regnew'){
	$forward=$MOBILE_URL.'register.php';
}
?>
<script>document.write("<script src='<?=$BOOK_URL;?>sb.login.php?entry=permissions&t="+(new Date).getTime()+"'></s"+"cript>");</script>

<div class="dl" id="box">
  <p>�������ʺţ�����<a href="<?=$MOBILE_URL;?>login.php?forward=<?=$forward;?>" id="regA">���ٵ�½</a></p>
  <form action="<?=$BOOK_URL;?>member/reg_new.php" method="post" name="regForm">
    <input type="hidden" value="regbase" name="dopost"/>
    <input type="hidden" value="1" name="step"/>
    <input type="hidden" value="����" name="mtype"/>
    <input type="hidden" checked="checked" value="" name="sex"/>
    <input style="display:none;" type="checkbox" checked="checked" name="agree"/>
    *&nbsp;�û�����<br>
    <input type="text" name="userid" value="">
    <br>
    <span class="cb fs">Ӣ�ġ�������ϣ�6-16���ַ�</span><br>
    *&nbsp;�ǳƣ�<br>
    <input type="text" name="uname" value="">
    <br>
    <span class="cb fs">վ��չʾ�����ѿ�����</span><br>
    *&nbsp;�������룺<br>
    <input type="password" name="userpwd">
    <br>
    <span class="cb fs">6-16���ַ���Ӣ����ĸ���������</span><br>
    *&nbsp;�������룺<br>
    <input type="password" name="userpwdok">
    <br>
    <span class="cb fs">ȷ������</span><br>
    *&nbsp;E-mail��<br>
    <input type="text" name="email" value="">
    <br>
    <span class="cb fs">��������д�������һغ��޸�����</span><br>
    *&nbsp;��֤�룺<br>
    <input type="text" name="vdcode">
    <br>
    <img src="<?=$BOOK_URL;?>include/vdimgck.php" id="vdimgck"><a href="javascript:vdimgck.src='<?=$BOOK_URL;?>include/vdimgck.php?t='+(new Date).getTime()" style="position:relative; top:-5px;">&nbsp;ˢ����֤��</a><br>
    <input type="submit" name="register" value="�ύ">
  </form>
</div>
<script>
if(mid!='0'){
	document.getElementById("box").innerHTML="<p style=\"text-align:center;line-height:30px;padding-top:20px;font-size:14px;\">��Ǹ���˳���½�ſ�ע�ᣡ</p>";
	setTimeout(function(){window.location.href="<?=$MOBILE_URL;?>"},1000);
}
</script>
<?php include_once 'footer.php';?>