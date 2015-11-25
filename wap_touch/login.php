<?php
$page_id='log';
include_once dirname(__FILE__).'/base.inc.php';

include_once 'header.php';
if($forward==$BOOK_URL.'member/index_do.php'){
	$forward=$MOBILE_URL.'login.php';
}
?>
<script>document.write("<script src='<?=$BOOK_URL;?>sb.login.php?entry=permissions&t="+(new Date).getTime()+"'></s"+"cript>");</script>

<form action="<?=$BOOK_URL;?>member/index_do.php" method="post" name="logForm">
  <input type="hidden" name="fmdo" value="login">
  <input type="hidden" name="dopost" value="login">
  <input type="hidden" name="gourl" value="<?=$forward;?>">
  <div class="shopBody loginBody" id="box">
    <div class="info">
      <dl>
        <dd>用户名：</dd>
        <dt>
          <input type="text" name="userid" maxlength="11" />
        </dt>
      </dl>
      <dl>
        <dd>密码：</dd>
        <dt>
          <input type="password" name="pwd" maxlength="16" />
        </dt>
      </dl>
      <dl>
        <dd>验证码：</dd>
        <dt>
          <input type="text" name="vdcode" id="vdcode" class="regcode" maxlength="4" />
          <img src="<?=$BOOK_URL;?>include/vdimgck.php" onclick="this.src='<?=$BOOK_URL;?>include/vdimgck.php?t='+(new Date).getTime()" width="84" height="35" /> </dt>
      </dl>
    </div>
    <input type="submit" name="btnSignCheck" class="button reg_sub" value="登录" />
    <dl class="dlLo">
      <dd><a href="<?=$TOUCH_URL;?>register.php?forward=<?=$forward;?>">用户注册</a></dd>
    </dl>
  </div>
</form>
<script>
if(mid!='0'){
	document.getElementById("box").innerHTML="<p style=\"text-align:center;line-height:30px;padding-top:20px;font-size:14px;\">恭喜，您已经登陆！</p>";
	setTimeout(function(){window.location.href="<?=$TOUCH_URL;?>"},1000);
}
</script>
<?php include_once 'footer.php';?>
