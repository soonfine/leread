<?php
/*-----------------
独立功能PHP程序
开发者：枯叶天
淘宝店铺：669977
淘宝店铺：669977.TaoBao.Com
演示站：WWW.SbYou.NET
官网：WwW.669977.NeT
QQ：1981255858
-----------------*/

error_reporting(0);
include_once dirname(__FILE__).'/../base.inc.php'; 
include_once dirname(__FILE__).'/phpqrcode/phpqrcode.php';

$id=$_GET["id"];
if($id!='669977.net'){
	exit;
}

$url=$_GET["url"];
$level=$_GET["level"];
$size=$_GET["size"];
$margin=$_GET["margin"];

!$url?$url=$BOOK_URL:'';
!$size?$size='3':'';
!$level?$level='L':'';
!$margin?$margin='0':'';

QRcode::png($url,$outfile=false,$level,$size,$margin,$saveandprint=false);

?>