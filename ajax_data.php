<?php
/*-----------------
��������PHP����
�����ߣ���Ҷ��
�Ա����̣�669977.TaoBao.com
��ʾվ��www.SBYOU.net
������www.669977.net
QQ��1981255858
-----------------*/

require_once(dirname(__FILE__)."/include/common.inc.php");

$entry=$_GET['entry'];
$id1=$_GET['id1'];
$id2=$_GET['id2'];
$id3=$_GET['id3'];
$id4=$_GET['id4'];
$id5=$_GET['id5'];

//���ҳ��Ʒ����Ƽ�/�Ҳ�����Ƽ�
if($entry=='bwjp' || $entry=='randBOX'){
	echo SByou_Net_rand($entry,$id1,$id2);
}
//����ҳ��������
if(strpos($entry,'score')){
	echo SbYOU_NeT_score($id1,$id2);
}
//����ҳ����
if($entry=='com_box'){
	echo SbYoU_neT_comments($id1,$id2);
}
//ͳ�ƻ�Ա�������
if($entry=='look'){
	$aid=$_GET['aid'];
	$mid=$_GET['mid'];
	$mname=$_GET['mname'];
	$regdate=$_GET['regdate'];
	echo sbyou_NeT_ArticleInfo($aid,$mid,$mname,$regdate);
}
//ͳ�ƻ�Ա��������
if($entry=='good'){
	$aid=$_GET['aid'];
	$mid=$_GET['mid'];
	$mname=$_GET['mname'];
	$regdate=$_GET['regdate'];
	echo sbyou_NET_addGood($aid,$mid,$mname,$regdate);
}
//ͳ�ƻ�Ա��������
if($entry=='bad'){
	$aid=$_GET['aid'];
	$mid=$_GET['mid'];
	$mname=$_GET['mname'];
	$regdate=$_GET['regdate'];
	echo sbyou_NET_addBad($aid,$mid,$mname,$regdate);
}
?>