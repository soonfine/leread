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

//php ��������post,get��������
if (get_magic_quotes_gpc()) {
  $_GET=stripslashes_array($_GET);
  $_POST=stripslashes_array($_POST);
}

$aid=$_GET['aid'];
$page_comment=$_POST['page_comment'];
$comment_title=$_POST['comment_title'];
$comment_content=$_POST['comment_content'];

$forward=$_SERVER['HTTP_REFERER'];
$cur_url=this.location.href;
if($forward==$cur_url){
	$forward=$BOOK_URL;
}

if($page_comment!='page_comment'){
	echo '<center>�������������������ۣ�</center>';
	echo '<meta http-equiv="refresh" content="3;url='.$forward.'">';
	exit;
}

//��ȫ����
$comment_title=lib_replace_end_tag($comment_title);
$comment_content=lib_replace_end_tag($comment_content);

$time=time();

//��������
//$ok=$dsql->ExecuteNoneQuery("insert into comments (aid,mname,title,content,createdate,checked) values ('$aid','�ο�','$comment_title','$comment_content','$time','$time','1')");

$ok=$dsql->ExecuteNoneQuery("insert into dede_comments (aid,cuid,mid,mname,title,content,score,createdate,updatedate,ip,checked) VALUES ('$aid','5','0','�ο�','$comment_title','$comment_content','0','$time','$time','','1')");

if($ok){
	$sbyou_net='
	<center>��ϲ�����ɹ����ۣ�</center>
	<meta http-equiv="refresh" content="3;url='.$forward.'">
	<script type="text/javascript">setcookie("Sbyou_neT_comment_'.$aid.'");</script>
	';
}else{
	$sbyou_net='
	<center>��Ǹ������ʧ�ܣ������������ۣ�</center>
	<meta http-equiv="refresh" content="3;url='.$forward.'">
	';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>
<?='��������-'.cfg_webname;?>
</title>
<script type="text/javascript" src="<?=$cfg_indexurl;?>templets/<?=$cfg_df_style;?>/js/common.js"></script>
</head>
<body>
<?=$sbyou_net;?>
</body>
</html>
