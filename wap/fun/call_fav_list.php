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
$pageNav=$pre.'&nbsp;&nbsp;'.$next;

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
		
		$ii++;
		$ii%2==0?$class=' class="bgf6"':$class='';
		//�б�
		$liSTR.='
			<p'.$class.'>
			  <a href="page.php?aid='.$bid.'" title="'.$sByoU_neT_row['typename'].'">'.$sByoU_neT_row['typename'].'</a>-'.$sByoU_neT_row['zuozhe'].'<br>
			  <span class="c6">���ͣ�<a href="'.$MOBILE_URL.'?caid='.$sByoU_neT_row['topid'].'">'.SBYOU_NET_catalog($sByoU_neT_row['topid'],'typename').'</a></span><br>
			  <span class="c6">����ʱ�䣺'.date('Y-m-d H:i:s',$sByoU_neT_row['lastupdate']).'</span><br>
			  <span class="c6">���£�'.SbYOU_Net_NEW($bid,'wap').'</span><br>
			  <span>��ǩ��'.$sq.'</span><br>
			  <span id="msg_box'.$ii.'">����<a href="javascript:del_favorite(mid,mname,regdate,\'delfav\',\''.$bid.'\',\''.$ii.'\');">�¼ܱ���</a></span>
			</p>
		';
	}
}else{
	$liSTR='
	<br />
	��Ǹ������������ݣ�
	<br />
	<br />
	';
	$pageNav='';
}
//���
echo '<div class="bookshelf">'.$liSTR.$pageNav.'</div>';
?>