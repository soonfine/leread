<?php
include_once dirname(__FILE__).'/base.inc.php';

$forward=$_GET['forward'];
!$forward?$forward=$_SERVER['HTTP_REFERER']:'';

include_once dirname(__FILE__).'/fun/fun.php';
include_once dirname(__FILE__).'/fun/ready.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<?php
echo '<title>'.$title.'</title>
<meta name="keywords" content="'.$keywords.'" />
<meta name="description" content="'.$description.'" />
';
?>
<meta name="baidu-site-verification" content="Y0TLptgXHCElY9mS">
<meta name="apple-touch-fullscreen" content="yes">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
<meta content="no" name="apple-mobile-web-app-capable">
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<link href="<?=$TOUCH_URL;?>css/wap.css" rel="stylesheet" type="text/css">
<meta http-equiv="Cache-Control" content="no-siteapp" />
<script>var MOBILE_URL="<?=$TOUCH_URL;?>";</script>
<script type="text/javascript" src="<?=$TOUCH_URL;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?=$TOUCH_URL;?>js/xmlJS.js"></script>
<script type="text/javascript" src="<?=$TOUCH_URL;?>js/common.js"></script>
</head>
<body>
<center>
  <script type="text/javascript" src="<?=$BOOK_URL;?>plus/ad_js.php?aid=16"></script>
</center>
<div class="header<?=$header_class;?>">
  <?=$header_str;?>
</div>
<div class="loca_box log"> 
  <script>document.write("<script src='<?=$BOOK_URL;?>sb.login.php?entry=wap_touch&t="+(new Date).getTime()+"'></s"+"cript>")</script> 
</div>
