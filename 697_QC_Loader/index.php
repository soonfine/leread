<?php
//ҳ��ID
$SByou_NET_QC_Loader='www.669977.net';
//�����ļ�
include_once dirname(__FILE__).'/base.inc.php';

$wei='www.669977.net';

echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>һ����½</title>
<link type="text/css" rel="stylesheet" href="css/log.css" />
<script type="text/javascript" src="js/xmlJS.js"></script>
</head>
<body>
';

//�����
$entry=$_GET['entry'];
if(!$entry){
	header('location:../');
	exit;
}else if($entry=='success'){
	//�״ε�½����棨��ʱ���ã�
	include_once dirname(__FILE__).'/success.php';
}else{
	if($entry!='qq' && $entry!='weibo'){
		header('location:../');
		exit;
	}
	//QQ��������΢����½��
	include_once dirname(__FILE__).'/'.$entry.'.php';
}

echo '
</body>
</html>
';
?>