<?php
include_once dirname(__FILE__).'/../base.inc.php';

$page=$_GET['page'];
empty($page)?$page=1:"";

$memberid=$_GET['mid'];
$mname=$_GET['mname'];
$regdate=$_GET['regdate'];

if(!$memberid || !$mname || !$regdate){
	echo '<br /><a href="login.php">��Ǹ������û�е�½�������ȵ�½��</a><br /><br />';
	echo '<script type="text/javascript">setTimeout(function(){window.location.href="'.$MOBILE_URL.'login.php"},1000);</script>';
	exit;
}

$num='5';//ÿҳ����

$where_sql='select * from dede_member_stow where mid='.$mid;
//������ҳ��
$dsql->SetQuery($where_sql.' order by id desc');
$dsql->Execute();
while($total_row=$dsql->GetObject())
{
	$total++;
}
!$total?$total='0':'';
//ҳ��
$pagenum=ceil($total/$num);
$page=min($pagenum,$page);
$prepg=$page-1;
$nextpg=($page==$pagenum?0:$page+1);
$offset=($page-1)*$num;
//���ҳ��
!$pagenum?$prepg="":"";
if($prepg){
	$pre='<a href="javascript:call_fav_list(mid,mname,regdate,\''.$prepg.'\',\'yes\')" class="left">��һҳ</a>';
}else{
	$pre='<a href="javascript:(0)" class="left none">����һҳ</a>';
}
if($nextpg){
	$next='<a href="javascript:call_fav_list(mid,mname,regdate,\''.$nextpg.'\',\'yes\')" class="left right">��һҳ</a>';
}else{
	$next='<a href="javascript:(0)" class="left right none">����һҳ</a>';
}
//ҳ���ַ���
$pageNav='<p class="page ca"><span><font>'.$page.'</font>/'.$pagenum.'</span>'.$pre.$next.'</p>';

//�б�
if($total){
	$dsql->SetQuery($where_sql." order by id desc limit $offset,$num");
	$dsql->Execute();
	while($sbYou_neT_row=$dsql->GetObject())
	{
		$bid=$sbYou_neT_row->bid;
		$aid=$sbYou_neT_row->aid;
		//��ǩ
		$sByoU_nET_row = $dsql->GetOne("select * from #@__archives where id='$aid' limit 1");
		if($sByoU_nET_row['id']){
			$sq='<a href="archive.php?aid='.$aid.'" title="'.$sByoU_nET_row['title'].'" target="_blank">'.$sByoU_nET_row['title'].'</a>';
		}else{
			$sq='��ʱû����ǩ';
		}
		//������Ϣ
		$sByoU_neT_row = $dsql->GetOne("select * from #@__arctype where id='$bid' and topid!=45 limit 1");
		
		if($sByoU_neT_row['overdate']){
			$abover='���';
		}else{
			$abover='����';
		}
		
		$ii++;
		$ii%2==0?$class=' style="border-top:none;"':$class='';
		//�б�
		$liSTR.='
		<li'.$class.'>
			<p class="t"><a href="page.php?aid='.$bid.'">'.$sByoU_neT_row['typename'].'</a><span>'.$abover.','.$sByoU_neT_row['booksize'].'��</span></p>
			<p class="z">���ߣ�<span>'.$sByoU_neT_row['zuozhe'].'</span>&nbsp;&nbsp;���ͣ�<a href="'.$MOBILE_URL.'?caid='.$sByoU_neT_row['topid'].'">'.SBYOU_NET_catalog($sByoU_neT_row['topid'],'typename').'</a></p>
			<p class="new">���£�'.SbYOU_Net_NEW($bid,'wap').'</p>
			<p class="s">��ǩ��'.$sq.'</p>
			<p class="g" id="msg_box'.$ii.'"><span>����</span><a href="javascript:del_favorite(mid,mname,regdate,\'delfav\',\''.$bid.'\',\''.$ii.'\');">�¼ܱ���</a></p>
			<p>�����ǩʱ�䣺'.date('Y-m-d H:i:s',$sByoU_neT_row['lastupdate']).'</p>
		</li>
		';
	}
}else{
	$liSTR='
	<div class="goodsBody s">
		<br />
		&nbsp;&nbsp;&nbsp;:&nbsp;:&nbsp;��Ǹ������������ݣ�����Ϊ���ռ���
		<br />
		<br />
		<br />
	</div>
	';
	$pageNav='';
}
//���
echo '<ul>'.$liSTR.'</ul><p class="line"></p>'.$pageNav;	
?>