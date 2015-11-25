<?php
//页面ID
$SByou_NET_QC_Loader='www.669977.net';
//配置文件
include_once dirname(__FILE__).'/base.inc.php';

$wei='www.669977.net';

echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>一键登陆</title>
<link type="text/css" rel="stylesheet" href="css/log.css" />
<script type="text/javascript" src="js/xmlJS.js"></script>
</head>
<body>
';

//各项处理
$entry=$_GET['entry'];
if(!$entry){
	header('location:../');
	exit;
}else if($entry=='success'){
	//首次登陆后界面（暂时不用）
	include_once dirname(__FILE__).'/success.php';
}else{
	if($entry!='qq' && $entry!='weibo'){
		header('location:../');
		exit;
	}
	//QQ互联或者微博登陆等
	include_once dirname(__FILE__).'/'.$entry.'.php';
}

echo '
</body>
</html>
';
?>