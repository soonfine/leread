<?php
/*-----------------
��������PHP����
�����ߣ���Ҷ��
�Ա����̣�669977.TaoBAo.com
��ʾվ��www.SbYoU.net
������www.669 977.net
QQ��1981 25 58 58
-----------------*/

require_once(dirname(__FILE__)."/config.php");

$mid=$cfg_ml->M_ID;

if(!$cfg_ml->IsLogin())
{
	header("location:".$BOOK_URL.'member/login.php');
	exit;
}

//������Ŀҳ��
$page=htmlspecialchars($_GET['page']);
if(!$page || !is_numeric($page)){
	$page=1;
}

//��ر���
$BOOK_URL=sbyou_net_sysconfig('cfg_basehost').sbyou_net_sysconfig('cfg_indexurl');
$cfg_indexurl=sbyou_net_sysconfig('cfg_indexurl');
$templets=$cfg_indexurl.'templets/'.sbyou_net_sysconfig('cfg_df_style');

$num='10';//ÿҳ����

$where_sql="select * from dede_member_stow where mid='$mid'";
//������ҳ��
$dsql->SetQuery($where_sql.' order by id desc');
$dsql->Execute();
while($total_row=$dsql->GetObject())
{
	$total++;
}
//ҳ��
$pagenum=ceil($total/$num);
$page=min($pagenum,$page);
$prepg=$page-1;
$nextpg=($page==$pagenum?0:$page+1);
$offset=($page-1)*$num;
//���ҳ��
!$pagenum?$prepg="":"";
if($prepg){
  $pre='<a id="pre_page" href="'.$BOOK_URL.'member/mystow.php" title="��һҳ">��һҳ</a>';
  $first='<a href="'.$BOOK_URL.'member/mystow.php" title="��һҳ">��һҳ</a>';
}else{
  $pre='<a class="none" id="pre_page" title="��һҳ">��һҳ</a>';
  $first='<a class="none" title="��һҳ">��һҳ</a>';
}
if($nextpg){
  $next='<a id="next_page" href="'.$BOOK_URL.'member/mystow.php?page='.$nextpg.'" title="��һҳ">��һҳ</a>';
  $last='<a href="'.$BOOK_URL.'member/mystow.php?page='.$pagenum.'" title="���һҳ">���һҳ</a>';
}else{
  $next='<a class="none" id="next_page" title="��һҳ">��һҳ</a>';
  $last='<a class="none" title="���һҳ">���һҳ</a>';
}
//����ҳ��
if($pagenum=='1'){
	$numnav='<a class="p_curpage">1</a>';
}else if($pagenum>1){
  if($page<3){
	  for($i=1;$i<=(($pagenum>=3)?3:$pagenum);$i++){
		  if($page==$i){
			  $numnav.='<a class="p_curpage">'.$i.'</a>';
		  }else{
			  $numnav.='<a href="'.$BOOK_URL.'member/mystow.php?page='.$i.'" class="p_num">'.$i.'</a>';
		  }
	  }
  }else{
	  for($i=($page-1);$i<=((($page+1)<=$pagenum)?($page+1):$pagenum);$i++){
		  if($page==$i){
			  $numnav.='<a class="p_curpage">'.$i.'</a>';
		  }else{
			  $numnav.='<a href="'.$BOOK_URL.'member/mystow.php?page='.$i.'" class="p_num">'.$i.'</a>';
		  }
	  }
  }
  $numnav.='<a class="p_num m">...</a>';
  if($page!=$pagenum && $page!=($pagenum-1)){
	  (($page+5)<=$pagenum)?$page_big=($page+5):$page_big=$pagenum;
	  $numnav.='<a href="'.$BOOK_URL.'member/mystow.php?page='.$page_big.'" class="p_num">'.$page_big.'</a>';  
  }
}
//ҳ���ַ���
$pageNav='
<div class="page_info">ÿҳ��ʾ<b>&nbsp;10&nbsp;</b>������<b>'.$total.'</b>��</div>
<div class="page_num">
  <div><a class="info">��<b>'.$page.'</b>ҳ/��'.$pagenum.'ҳ</a>'.$first.$pre.'</div>
  <div class="p_bar">'.$numnav.'</div>
  <div>'.$next.$last.'</div>
</div>
';

//�б�
$dsql->SetQuery($where_sql." order by id desc limit $offset,$num");
$dsql->Execute();
while($sbYou_neT_row=$dsql->GetObject())
{
	$bid=$sbYou_neT_row->bid;
	$aid=$sbYou_neT_row->aid;
	//��ǩ
	$sByoU_nET_row = $dsql->GetOne("select * from #@__archives where id='$aid' limit 1");
	if($sByoU_nET_row['id']){
		$sq='<a href="'.$BOOK_URL.ltrim(SBYOU_NET_catalog($bid,'typedir'),'/').'/'.$aid.'.html" title="'.$sByoU_nET_row['title'].'" target="_blank">'.$sByoU_nET_row['title'].'</a>';
	}else{
		$sq='��ʱû����ǩ';
	}
	//������Ϣ
	$sByoU_neT_row = $dsql->GetOne("select * from #@__arctype where id='$bid' and topid!=45 limit 1");
	//�б�
	$sByou_NET_list.='
	<tr>
	  <td colspan="5" class="tabTitle">
		<a href="'.$BOOK_URL.ltrim($sByoU_neT_row['typedir'],'/').'/" title="'.$sByoU_neT_row['typename'].'" target="_blank">'.$sByoU_neT_row['typename'].'</a>
		/&nbsp;��ǩ��'.$sq.'
	  </td>
	  <td width="25%" align="center" class="doPost">
		<span class="itemDigg">
		  <a class="text_button" href="'.$TXT_URL.'?topid='.$sByoU_neT_row['topid'].'&id='.$bid.'&date='.$sByoU_neT_row['lastupdate'].'" target="_blank">[����TXT]</a>
		</span>
		<span class="itemManage">
		  <a href="'.$BOOK_URL.'member/archives_do.php?dopost=delStow&aid='.$bid.'">[ɾ���ղ�]</a>
		</span>
	  </td>
	</tr>
	<tr>
	  <td colspan="6" class="tabTitle tbBtm">�ղ�ʱ��:'.date('Y-m-d H:i:s',$sbYou_neT_row->addtime).'</td>
	</tr>
	';
}

if(!$pagenum){
	$sByou_NET_list='<tr><td>&nbsp;&nbsp;&nbsp;��ʱû���ղأ�</td></tr>';
}

//����ģ��
require_once(DEDEINC."/datalistcp.class.php");
$dlist = new DataListCP();
$dlist->SetTemplet(DEDEMEMBER.'/templets/mystow.htm');
$dlist->Display();
?>