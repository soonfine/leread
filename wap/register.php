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
  <p>已申请帐号，请点此<a href="<?=$MOBILE_URL;?>login.php?forward=<?=$forward;?>" id="regA">快速登陆</a></p>
  <form action="<?=$BOOK_URL;?>member/reg_new.php" method="post" name="regForm">
    <input type="hidden" value="regbase" name="dopost"/>
    <input type="hidden" value="1" name="step"/>
    <input type="hidden" value="个人" name="mtype"/>
    <input type="hidden" checked="checked" value="" name="sex"/>
    <input style="display:none;" type="checkbox" checked="checked" name="agree"/>
    *&nbsp;用户名：<br>
    <input type="text" name="userid" value="">
    <br>
    <span class="cb fs">英文、数字组合，6-16个字符</span><br>
    *&nbsp;昵称：<br>
    <input type="text" name="uname" value="">
    <br>
    <span class="cb fs">站内展示，网友看到的</span><br>
    *&nbsp;输入密码：<br>
    <input type="password" name="userpwd">
    <br>
    <span class="cb fs">6-16个字符，英文字母或数字组成</span><br>
    *&nbsp;重输密码：<br>
    <input type="password" name="userpwdok">
    <br>
    <span class="cb fs">确认输入</span><br>
    *&nbsp;E-mail：<br>
    <input type="text" name="email" value="">
    <br>
    <span class="cb fs">请认真填写，用于找回和修改密码</span><br>
    *&nbsp;验证码：<br>
    <input type="text" name="vdcode">
    <br>
    <img src="<?=$BOOK_URL;?>include/vdimgck.php" id="vdimgck"><a href="javascript:vdimgck.src='<?=$BOOK_URL;?>include/vdimgck.php?t='+(new Date).getTime()" style="position:relative; top:-5px;">&nbsp;刷新验证码</a><br>
    <input type="submit" name="register" value="提交">
  </form>
</div>
<script>
if(mid!='0'){
	document.getElementById("box").innerHTML="<p style=\"text-align:center;line-height:30px;padding-top:20px;font-size:14px;\">抱歉，退出登陆才可注册！</p>";
	setTimeout(function(){window.location.href="<?=$MOBILE_URL;?>"},1000);
}
</script>
<?php include_once 'footer.php';?>