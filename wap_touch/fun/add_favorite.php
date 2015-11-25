<?php
include_once dirname(__FILE__).'/../base.inc.php';

//登陆状态
$memberid=$_GET['mid'];
$mname=$_GET['mname'];
$regdate=$_GET['regdate'];

$info_m = $dsql->GetOne("select * from #@__member where mid='$memberid' limit 1");
if(!$memberid || $info_m['jointime']!=$regdate || $info_m['uname']!=$mname){
	echo '<div class="data msg"><a href="'.$TOUCH_URL.'login.php">抱歉，您还未登陆！[快速登陆]</a></div>';
	exit;
}

//下架收藏
$entry=$_GET[entry];
if($entry=='delfav'){
	include_once dirname(__FILE__).'/fun.php';
	$aid=$_GET[aid];
	if(!$aid){
		echo '抱歉，未选择小说！正在刷新当前页！';
		exit;
	}

	$dsql->ExecuteNoneQuery("DELETE FROM #@__member_stow WHERE bid='$aid' AND mid='$memberid'");
	//更新用户统计
	$row = $dsql->GetOne("SELECT COUNT(*) AS nums FROM #@__member_stow WHERE mid='$memberid'");
	$dsql->ExecuteNoneQuery("UPDATE #@__member_tj SET stow='$row[nums]' WHERE mid='$memberid'");
	
	echo '<font>成功下架！正在刷新当前页！</font>';
	exit;
}

//添加收藏
$aid=$_GET['aid'];
$chid=$_GET['chid'];
$time=time();

if($chid==1){
	$arcRow = $dsql->GetOne("select id from #@__arctype where id='$aid' and topid!=45 limit 1");
	if(!$arcRow['id'])
	{
		echo '<div class="data msg">抱歉，收藏失败，请您刷新重新收藏！</div>';
	}else{
		//判断是否已经收藏
		$sRow = $dsql->GetOne("select bid from #@__member_stow where bid='$aid' and mid='$memberid' limit 1");
		if($sRow['bid'])
		{
			echo '<div class="data msg"><a href="'.$TOUCH_URL.'adminm.php?action=favorites">您已经收藏过这本小说了，请查看收藏夹！[打开收藏夹]</a></div>';
		}else{
			$dsql->ExecuteNoneQuery("INSERT INTO `#@__member_stow`(mid,bid,addtime) VALUES ('$memberid','$aid','$time')");
			echo '<div class="data msg"><a href="'.$TOUCH_URL.'adminm.php?action=favorites">恭喜您，成功添加书签！[打开收藏夹]</a></div>';
		}
	}
}else{
	$arcRow = $dsql->GetOne("select id,typeid from #@__archives where id='$aid' limit 1");
	if(!$arcRow['id'])
	{
		echo '<div class="data msg">抱歉，收藏失败，请您刷新重新收藏！</div>';
	}else{
		//判断是否已经收藏
		$sRow = $dsql->GetOne("select bid from #@__member_stow where bid='$arcRow[typeid]' and mid='$memberid' limit 1");
		if($sRow['bid'])
		{
			$dsql->ExecuteNoneQuery("UPDATE #@__member_stow SET aid='$aid',addtime='$addtime' WHERE bid='$arcRow[typeid]' and mid='$memberid'");
			echo '<div class="data msg"><a href="'.$TOUCH_URL.'adminm.php?action=favorites">恭喜您，成功添加书签！[打开收藏夹]</a></div>';
		}else{
			$dsql->ExecuteNoneQuery("INSERT INTO `#@__member_stow`(mid,bid,aid,addtime) VALUES ('$memberid','$arcRow[typeid]','$aid','$time')");
			echo '<div class="data msg"><a href="'.$TOUCH_URL.'adminm.php?action=favorites">恭喜您，成功添加书签！[打开收藏夹]</a></div>';
		}
	}
}
?>