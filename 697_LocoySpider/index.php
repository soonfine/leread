<?php
include_once dirname(__FILE__).'/base.inc.php';
//include_once dirname(__FILE__).'/../'.$www_669977_net_ADMIN.'/config.php';
include_once dirname(__FILE__).'/include/sbyou.net.fun.php';
include_once dirname(__FILE__).'/../include/sbyou.net.pinyin.php';
include_once dirname(__FILE__).'/../include/userlogin.class.php';
include_once dirname(__FILE__).'/data.txt.php';
$wei='www.669977.net';

echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>��ͷ�ɼ����-697������-697ԭ��Դ����ҿ���</title>
<link rel="stylesheet" type="text/css" href="css/common.css" />
</head>
<body>
';


//�����û���¼״̬
$cuserLogin = new userLogin();
if($cuserLogin->getUserID()==-1)
{
    if($name!=''){
        $res=$cuserLogin->checkUser($name,$pwd);
        if($res==1) $cuserLogin->keepUser();
	}
    if($cuserLogin->getUserID()==-1){
        header("location:".$BOOK_URL.$www_669977_net_ADMIN."/login.php?gotopage=".$BOOK_URL."/697_LocoySpider/");
        exit();
    }
}
//��������
if(!$entry){
	$www_669977_Net=$sbyou_Net_Words;
	$www_669977_Net.='
	<p>[ѡ�������Ŀ]</p>
	<p><a class="blue" href="?entry=catalogs&name='.$name.'&pwd='.$pwd.'">�鿴��Ŀ</a></p>
	<p><a class="blue" href="?entry=article&name='.$name.'&pwd='.$pwd.'">��������</a></p>
	';
	echo $www_669977_Net;
}else{
	include_once dirname(__FILE__).'/'.$entry.'.php';
}

echo '
</body>
</html>
';
?>
