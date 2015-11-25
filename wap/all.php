<?php
//全部分类
$page_id='all';
include_once 'header.php';

//栏目
$dsql->SetQuery("select * from dede_arctype where topid=0 and id!=45 and id!=375 and id!=376 order by sortrank asc limit 6");
$dsql->Execute();
while($row=$dsql->GetObject())
{
	$ca_i++;	
	$id=$row->id;
	$typename=$row->typename;
	if($ca_i==1){
		$style=' style="border-top:none;"';
	}else{
		$style='';
	}
	$ca_list.='<a href="'.$MOBILE_URL.'?caid='.$id.'" class="data"'.$style.'>'.$typename.'<span>（共计'.sbyou_net_total($id).'部小说）</span></a><br />';
}
?>

<div id="all" class="list">
  <?=$ca_list;?>
</div>
<?php include_once 'footer.php';?>