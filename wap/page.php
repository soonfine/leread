<?php
error_reporting(0);
$page_id='page';
$id=$_GET['aid'];
$list=$_GET['list'];

include_once dirname(__FILE__).'/header.php';

//主信息
$arc_row=$dsql->GetOne("select * from dede_arctype where id='$aid' and topid!=45 limit 1");
$id=$arc_row['id'];
if($id){
	$dsql->ExecuteNoneQuery("update dede_arctype set bookclick=bookclick+3,bookclickm=bookclickm+1,bookclickw=bookclickw+1 where id=$id limit 1");
}else{
	msg('抱歉，暂时找不到相关小说！正在返回首页！',$MOBILE_URL);
	include_once dirname(__FILE__).'/footer.php';
	exit;
}

//页头相关
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

//主休
if($list==''){
	//简介页
	include_once dirname(__FILE__).'/page_aid.php';
}else if($list==1){
	//目录页
	include_once dirname(__FILE__).'/page_list.php';
}else{
	msg('抱歉，您处于非法访问状态！正在返回首页！',$MOBILE_URL);
}
include_once dirname(__FILE__).'/footer.php';
?>