<?php
error_reporting(0);
$page_id='page';
$id=$_GET['aid'];
$list=$_GET['list'];

include_once dirname(__FILE__).'/header.php';

//����Ϣ
$arc_row=$dsql->GetOne("select * from dede_arctype where id='$aid' and topid!=45 limit 1");
$id=$arc_row['id'];
if($id){
	$dsql->ExecuteNoneQuery("update dede_arctype set bookclick=bookclick+3,bookclickm=bookclickm+1,bookclickw=bookclickw+1 where id=$id limit 1");
}else{
	msg('��Ǹ����ʱ�Ҳ������С˵�����ڷ�����ҳ��',$MOBILE_URL);
	include_once dirname(__FILE__).'/footer.php';
	exit;
}

//ҳͷ���
if($list==1){
	$bac_hrf='page.php?aid='.$id;
	$list_str='';
}else{
	$bac_hrf=$MOBILE_URL.'?caid='.SBYOU_NET_catalog($id,'topid');
	$list_sc='get_id("h_list").href="page.php?aid='.$id.'&list=1";';
}
echo '
<script type="text/javascript">
	function get_id(id){return document.getElementById(id);}
	get_id("h_page").href="'.$bac_hrf.'";
	'.$list_sc.'
	get_id("h_fav").href="javascript:add_favorite(mid,mname,regdate,\''.$id.'\',\''.$row[chid].'\',\'1\');";
</script>
';

//����
if($list==''){
	//���ҳ
	include_once dirname(__FILE__).'/page_aid.php';
}else if($list==1){
	//Ŀ¼ҳ
	include_once dirname(__FILE__).'/page_list.php';
}else{
	msg('��Ǹ�������ڷǷ�����״̬�����ڷ�����ҳ��',$MOBILE_URL);
}
include_once dirname(__FILE__).'/footer.php';
?>