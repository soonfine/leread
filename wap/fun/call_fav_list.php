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
$pageNav=$pre.'&nbsp;&nbsp;'.$next;

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
		
		$ii++;
		$ii%2==0?$class=' class="bgf6"':$class='';
		//列表
		$liSTR.='
			<p'.$class.'>
			  <a href="page.php?aid='.$bid.'" title="'.$sByoU_neT_row['typename'].'">'.$sByoU_neT_row['typename'].'</a>-'.$sByoU_neT_row['zuozhe'].'<br>
			  <span class="c6">类型：<a href="'.$MOBILE_URL.'?caid='.$sByoU_neT_row['topid'].'">'.SBYOU_NET_catalog($sByoU_neT_row['topid'],'typename').'</a></span><br>
			  <span class="c6">更新时间：'.date('Y-m-d H:i:s',$sByoU_neT_row['lastupdate']).'</span><br>
			  <span class="c6">最新：'.SbYOU_Net_NEW($bid,'wap').'</span><br>
			  <span>书签：'.$sq.'</span><br>
			  <span id="msg_box'.$ii.'">管理：<a href="javascript:del_favorite(mid,mname,regdate,\'delfav\',\''.$bid.'\',\''.$ii.'\');">下架本书</a></span>
			</p>
		';
	}
}else{
	$liSTR='
	<br />
	抱歉，暂无相关内容！
	<br />
	<br />
	';
	$pageNav='';
}
//输出
echo '<div class="bookshelf">'.$liSTR.$pageNav.'</div>';
?>