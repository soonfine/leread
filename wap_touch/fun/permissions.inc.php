<?php
include_once dirname(__FILE__).'/../../include/general.inc.php';
include_once dirname(__FILE__).'/../base.inc.php';
header("Content-type: text/html;charset=utf-8");
//ภดิดาณรๆ
if($_SERVER['HTTP_REFERER']){
	$back=$_SERVER['HTTP_REFERER'];
}else{
	$back=$TOUCH_URL;
}
?>