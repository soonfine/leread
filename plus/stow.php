<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");

$aid = ( isset($aid) && is_numeric($aid) ) ? $aid : 0;
$type=empty($type)? "" : HtmlReplace($type,1);

//����ղ�book/�����ǩchapter
$entry=$_GET['entry'];
!$entry?$entry='book':'';

if($aid==0)
{
	ShowMsg('�ĵ�id����Ϊ��!','javascript:window.close();');
	exit();
}

require_once(DEDEINC."/memberlogin.class.php");
$ml = new MemberLogin();

if($ml->M_ID==0)
{
	ShowMsg('ֻ�л�Ա�������ղز�����','javascript:window.close();');
	exit();
}


$aid = intval($aid);
$addtime = time();

//��ȡ�ĵ���Ϣ
if($entry=='book'){
	$arcRow = $dsql->GetOne("select id from #@__arctype where id='$aid' and topid!=45 limit 1");
	if(!$arcRow['id'])
	{
		ShowMsg("��Ҫ�ղص�С˵������!","javascript:window.close();");
		exit();
	}else{
		//�ж��Ƿ��Ѿ��ղ�
		$sRow = $dsql->GetOne("select bid from #@__member_stow where bid='$aid' and mid='{$ml->M_ID}' limit 1");
		if($sRow['bid'])
		{
			ShowMsg("���Ѿ��ղع��ˣ������ղؼв鿴��","javascript:window.close();");
			exit();
		}else{
			$dsql->ExecuteNoneQuery("INSERT INTO `#@__member_stow`(mid,bid,addtime) VALUES ('{$ml->M_ID}','$aid','$addtime')");
		}
	}
}
if($entry=='chapter'){
	$arcRow = $dsql->GetOne("select id,typeid from #@__archives where id='$aid' limit 1");
	if(!$arcRow['id'])
	{
		ShowMsg("��Ҫ�ղص��½ڲ�����!","javascript:window.close();");
		exit();
	}else{
		//�ж��Ƿ��Ѿ��ղ�
		$sRow = $dsql->GetOne("select bid from #@__member_stow where bid='$arcRow[typeid]' and mid='{$ml->M_ID}' limit 1");
		if($sRow['bid'])
		{
			$dsql->ExecuteNoneQuery("UPDATE #@__member_stow SET aid='$aid',addtime='$addtime' WHERE bid='$arcRow[typeid]' and mid='{$ml->M_ID}'");
		}else{
			$dsql->ExecuteNoneQuery("INSERT INTO `#@__member_stow`(mid,bid,aid,addtime) VALUES ('{$ml->M_ID}','$arcRow[typeid]','$aid','$addtime')");
		}
	}
}

//�����û�ͳ��
$row = $dsql->GetOne("SELECT COUNT(*) AS nums FROM `#@__member_stow` WHERE `mid`='{$ml->M_ID}' ");
$dsql->ExecuteNoneQuery("UPDATE #@__member_tj SET `stow`='$row[nums]' WHERE `mid`='".$ml->M_ID."'");

ShowMsg('�ɹ��ղ�һƪ�ĵ���','javascript:window.close();');
?>