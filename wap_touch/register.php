<?php
$page_id='reg';
include_once dirname(__FILE__).'/base.inc.php';

include_once 'header.php';
if($forward==$BOOK_URL.'member/index_do.php?fmdo=user&dopost=regnew'){
	$forward=$MOBILE_URL.'register.php';
}
?>
<script>document.write("<script src='<?=$BOOK_URL;?>sb.login.php?entry=permissions&t="+(new Date).getTime()+"'></s"+"cript>");</script>

<form action="<?=$BOOK_URL;?>member/reg_new.php" method="post" name="regForm">
  <input type="hidden" value="regbase" name="dopost"/>
  <input type="hidden" value="1" name="step"/>
  <input type="hidden" value="����" name="mtype"/>
  <input type="hidden" checked="checked" value="" name="sex"/>
  <input style="display:none;" type="checkbox" checked="checked" name="agree"/>
  <div class="shopBody loginBody" id="box">
    <div class="info">
      <dl>
        <dd>�û�����</dd>
        <dt>
          <input type="text" name="userid" id="userid" maxlength="25" />
        </dt>
      </dl>
      <dl>
        <dd>�ǳƣ�</dd>
        <dt>
          <input type="text" name="uname" id="uname" maxlength="25" />
        </dt>
      </dl>
      <dl>
        <dd>���룺</dd>
        <dt>
          <input type="password" name="userpwd" id="userpwd" maxlength="25" />
        </dt>
      </dl>
      <dl>
        <dd>ȷ�����룺</dd>
        <dt>
          <input type="password" name="userpwdok" id="userpwdok" maxlength="25" />
        </dt>
      </dl>
      <dl>
        <dd>���䣺</dd>
        <dt>
          <input type="text" name="email" id="email" maxlength="25" />
        </dt>
      </dl>
      <dl>
        <dd>��֤�룺</dd>
        <dt>
          <input type="text" name="vdcode" id="vdcode" class="regcode" maxlength="4" />
          <img src="<?=$BOOK_URL;?>include/vdimgck.php" onclick="this.src='<?=$BOOK_URL;?>include/vdimgck.php?t='+(new Date).getTime()" width="84" height="35" /> </dt>
      </dl>
    </div>
    <input type="submit" class="button reg_sub" name="register" value="�ύע����Ϣ">
    <dl class="dlLo">
      <dd><a href="<?=$TOUCH_URL;?>login.php?forward=<?=$forward;?>">�û���¼</a></dd>
    </dl>
  </div>
</form>
<script>
if(mid!='0'){
	document.getElementById("box").innerHTML="<p style=\"text-align:center;line-height:30px;padding-top:20px;font-size:14px;\">��Ǹ���˳���½�ſ�ע�ᣡ</p>";
	setTimeout(function(){window.location.href="<?=$TOUCH_URL;?>"},1000);
}
</script>
<?php include_once 'footer.php';?>