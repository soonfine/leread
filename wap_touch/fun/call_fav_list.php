<?php
include_once dirname(__FILE__).'/../base.inc.php';

$page=$_GET['page'];
empty($page)?$page=1:"";

$memberid=$_GET['mid'];
$mname=$_GET['mname'];
$regdate=$_GET['regdate'];

if(!$memberid || !$mname || !$regdate){
	echo '<br /><a href="login.php">抱歉，您还没有登陆，请您先登陆！</a><br /><br />';
	echo '<script type="text/javascript">setTimeout(function(){window.location.href="'.$MOBILE_URL.'login.php"},1000);</script>';
	exit;
}

$num='5';//每页条数

$where_sql='select * from dede_member_stow where mid='.$mid;
//计算总页数
$dsql->SetQuery($where_sql.' order by id desc');
$dsql->Execute();
while($total_row=$dsql->GetObject())
{
	$total++;
}
!$total?$total='0':'';
//页数
$pagenum=ceil($total/$num);
$page=min($pagenum,$page);
$prepg=$page-1;
$nextpg=($page==$pagenum?0:$page+1);
$offset=($page-1)*$num;
//快捷页码
!$pagenum?$prepg="":"";
if($prepg){
	$pre='<a href="javascript:call_fav_list(mid,mname,regdate,\''.$prepg.'\',\'yes\')" class="left">上一页</a>';
}else{
	$pre='<a href="javascript:(0)" class="left none">无上一页</a>';
}
if($nextpg){
	$next='<a href="javascript:call_fav_list(mid,mname,regdate,\''.$nextpg.'\',\'yes\')" class="left right">下一页</a>';
}else{
	$next='<a href="javascript:(0)" class="left right none">无下一页</a>';
}
//页码字符串
$pageNav='<p class="page ca"><span><font>'.$page.'</font>/'.$pagenum.'</span>'.$pre.$next.'</p>';

//列表
if($total){
	$dsql->SetQuery($where_sql." order by id desc limit $offset,$num");
	$dsql->Execute();
	while($sbYou_neT_row=$dsql->GetObject())
	{
		$bid=$sbYou_neT_row->bid;
		$aid=$sbYou_neT_row->aid;
		//书签
		$sByoU_nET_row = $dsql->GetOne("select * from #@__archives where id='$aid' limit 1");
		if($sByoU_nET_row['id']){
			$sq='<a href="archive.php?aid='.$aid.'" title="'.$sByoU_nET_row['title'].'" target="_blank">'.$sByoU_nET_row['title'].'</a>';
		}else{
			$sq='暂时没有书签';
		}
		//主表信息
		$sByoU_neT_row = $dsql->GetOne("select * from #@__arctype where id='$bid' and topid!=45 limit 1");
		
		if($sByoU_neT_row['overdate']){
			$abover='完结';
		}else{
			$abover='连载';
		}
		
		$ii++;
		$ii%2==0?$class=' style="border-top:none;"':$class='';
		//列表
		$liSTR.='
		<li'.$class.'>
			<p class="t"><a href="page.php?aid='.$bid.'">'.$sByoU_neT_row['typename'].'</a><span>'.$abover.','.$sByoU_neT_row['booksize'].'字</span></p>
			<p class="z">作者：<span>'.$sByoU_neT_row['zuozhe'].'</span>&nbsp;&nbsp;类型：<a href="'.$MOBILE_URL.'?caid='.$sByoU_neT_row['topid'].'">'.SBYOU_NET_catalog($sByoU_neT_row['topid'],'typename').'</a></p>
			<p class="new">最新：'.SbYOU_Net_NEW($bid,'wap').'</p>
			<p class="s">书签：'.$sq.'</p>
			<p class="g" id="msg_box'.$ii.'"><span>管理：</span><a href="javascript:del_favorite(mid,mname,regdate,\'delfav\',\''.$bid.'\',\''.$ii.'\');">下架本书</a></p>
			<p>添加书签时间：'.date('Y-m-d H:i:s',$sByoU_neT_row['lastupdate']).'</p>
		</li>
		';
	}
}else{
	$liSTR='
	<div class="goodsBody s">
		<br />
		&nbsp;&nbsp;&nbsp;:&nbsp;:&nbsp;抱歉，暂无相关内容，立马为您收集！
		<br />
		<br />
		<br />
	</div>
	';
	$pageNav='';
}
//输出
echo '<ul>'.$liSTR.'</ul><p class="line"></p>'.$pageNav;	
?>