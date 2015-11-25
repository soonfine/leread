<?php
/*-----------------
独立功能PHP程序
开发者：枯叶天
淘宝店铺：669977.TaoBao.com
演示站：www.SBYOU.net
官网：www.669977.net
QQ：1981255858
-----------------*/

require_once(dirname(__FILE__)."/include/common.inc.php");

$entry=$_GET['entry'];
$id1=$_GET['id1'];
$id2=$_GET['id2'];
$id3=$_GET['id3'];
$id4=$_GET['id4'];
$id5=$_GET['id5'];

//简介页精品随机推荐/右侧随机推荐
if($entry=='bwjp' || $entry=='randBOX'){
	echo SByou_Net_rand($entry,$id1,$id2);
}
//封面页心情评分
if(strpos($entry,'score')){
	echo SbYOU_NeT_score($id1,$id2);
}
//封面页评论
if($entry=='com_box'){
	echo SbYoU_neT_comments($id1,$id2);
}
//统计会员浏览数据
if($entry=='look'){
	$aid=$_GET['aid'];
	$mid=$_GET['mid'];
	$mname=$_GET['mname'];
	$regdate=$_GET['regdate'];
	echo sbyou_NeT_ArticleInfo($aid,$mid,$mname,$regdate);
}
//统计会员点赞数据
if($entry=='good'){
	$aid=$_GET['aid'];
	$mid=$_GET['mid'];
	$mname=$_GET['mname'];
	$regdate=$_GET['regdate'];
	echo sbyou_NET_addGood($aid,$mid,$mname,$regdate);
}
//统计会员点赞数据
if($entry=='bad'){
	$aid=$_GET['aid'];
	$mid=$_GET['mid'];
	$mname=$_GET['mname'];
	$regdate=$_GET['regdate'];
	echo sbyou_NET_addBad($aid,$mid,$mname,$regdate);
}
?>