<?php
include_once dirname(__FILE__).'/../base.inc.php';

//��½״̬
$memberid=$_GET['mid'];
$mname=$_GET['mname'];
$regdate=$_GET['regdate'];

$info_m = $dsql->GetOne("select * from #@__member where mid='$memberid' limit 1");
if(!$memberid || $info_m['jointime']!=$regdate || $info_m['uname']!=$mname){
	echo '<div class="data msg"><a href="'.$TOUCH_URL.'login.php">��Ǹ������δ��½��[���ٵ�½]</a></div>';
	exit;
}

//�¼��ղ�
$entry=$_GET[entry];
if($entry=='delfav'){
	include_once dirname(__FILE__).'/fun.php';
	$aid=$_GET[aid];
	if(!$aid){
		echo '��Ǹ��δѡ��С˵������ˢ�µ�ǰҳ��';
		exit;
	}

	$dsql->ExecuteNoneQuery("DELETE FROM #@__member_stow WHERE bid='$aid' AND mid='$memberid'");
	//�����û�ͳ��
	$row = $dsql->GetOne("SELECT COUNT(*) AS nums FROM #@__member_stow WHERE mid='$memberid'");
	$dsql->ExecuteNoneQuery("UPDATE #@__member_tj SET stow='$row[nums]' WHERE mid='$memberid'");
	
	echo '<font>�ɹ��¼ܣ�����ˢ�µ�ǰҳ��</font>';
	exit;
}

//����ղ�
$aid=$_GET['aid'];
$chid=$_GET['chid'];
$time=time();

if($chid==1){
	$arcRow = $dsql->GetOne("select id from #@__arctype where id='$aid' and topid!=45 limit 1");
	if(!$arcRow['id'])
	{
		echo '<div class="data msg">��Ǹ���ղ�ʧ�ܣ�����ˢ�������ղأ�</div>';
	}else{
		//�ж��Ƿ��Ѿ��ղ�
		$sRow = $dsql->GetOne("select bid from #@__member_stow where bid='$aid' and mid='$memberid' limit 1");
		if($sRow['bid'])
		{
			echo '<div class="data msg"><a href="'.$TOUCH_URL.'adminm.php?action=favorites">���Ѿ��ղع��ⱾС˵�ˣ���鿴�ղؼУ�[���ղؼ�]</a></div>';
		}else{
			$dsql->ExecuteNoneQuery("INSERT INTO `#@__member_stow`(mid,bid,addtime) VALUES ('$memberid','$aid','$time')");
			echo '<div class="data msg"><a href="'.$TOUCH_URL.'adminm.php?action=favorites">��ϲ�����ɹ������ǩ��[���ղؼ�]</a></div>';
		}
	}
}else{
	$arcRow = $dsql->GetOne("select id,typeid from #@__archives where id='$aid' limit 1");
	if(!$arcRow['id'])
	{
		echo '<div class="data msg">��Ǹ���ղ�ʧ�ܣ�����ˢ�������ղأ�</div>';
	}else{
		//�ж��Ƿ��Ѿ��ղ�
		$sRow = $dsql->GetOne("select bid from #@__member_stow where bid='$arcRow[typeid]' and mid='$memberid' limit 1");
		if($sRow['bid'])
		{
			$dsql->ExecuteNoneQuery("UPDATE #@__member_stow SET aid='$aid',addtime='$addtime' WHERE bid='$arcRow[typeid]' and mid='$memberid'");
			echo '<div class="data msg"><a href="'.$TOUCH_URL.'adminm.php?action=favorites">��ϲ�����ɹ������ǩ��[���ղؼ�]</a></div>';
		}else{
			$dsql->ExecuteNoneQuery("INSERT INTO `#@__member_stow`(mid,bid,aid,addtime) VALUES ('$memberid','$arcRow[typeid]','$aid','$time')");
			echo '<div class="data msg"><a href="'.$TOUCH_URL.'adminm.php?action=favorites">��ϲ�����ɹ������ǩ��[���ղؼ�]</a></div>';
		}
	}
}
?>