<?php
if($arc_row['booksize']>=1000000){
	$bw='<b>����</b>';
}else{
	$bw='';
}
?>

<div class="tj">
  <div class="text">
    <h2>
      <?='<a href="'.$MOBILE_URL.'page.php?aid='.$id.'&list=1">��'.$arc_row['typename'].'��</a><span class="fred fs">��'.($arc_row['overdate']?'���':'����').'��</span>';?>
    </h2>
    <span class="fs">
    <?='����:'.$arc_row['zuozhe'];?>
    </span><br />
    <span class="fs">
    <?='�ܵ��:'.$arc_row['bookclick'].'&nbsp;&nbsp;�µ��:'.$arc_row['bookclickm'].' &nbsp;&nbsp;�ܵ��:'.$arc_row['bookclickw'];?>
    </span><br />
    <span class="fs">
    <?='���Ƽ�:'.$arc_row['tuijian'].'&nbsp;&nbsp;���Ƽ�:'.$arc_row['tuijianm'].' &nbsp;&nbsp;���Ƽ�:'.$arc_row['tuijianw'];?>
    </span><br />
    <span class="fs">
    <?='�����½�:'.SbYOU_Net_newChapter($id);?>
    </span> </div>
</div>
<div class="pl"> <a href="<?=$MOBILE_URL;?>page.php?aid=<?=$id;?>&list=1">�鿴��Ŀ</a> </div>
<script type="text/javascript" src="<?=$BOOK_URL;?>plus/ad_js.php?aid=20"></script>
<p class="pl3"> ��Ʒ���:<br />
  <?=$arc_row['description'];?>
</p>
<div id="msg_box"></div>
<div class="pl"> <a href="<?=$MOBILE_URL;?>page.php?aid=<?=$id;?>&list=1">����Ķ�</a>|<a href="javascript:add_favorite(mid,mname,regdate,'<?=$id;?>','1','');">�����ղ�</a>|<a href="<?=$MOBILE_URL;?>adminm.php?action=favorites">�����</a> </div>
<div class="kind">
  <h1>��������Ƽ�</h1>
</div>
<div class="list">
  <?php
	$dsql->SetQuery("select * from dede_arctype where topid=$arc_row[topid] order by rand() limit 3");
	$dsql->Execute();
	while($sbyou_net=$dsql->GetObject())
	{
		$typeimg=ltrim($sbyou_net->typeimg,'/');
		if(!$typeimg){
			$randPICID=rand(1,50);
			$typeimg="uploads/empty/".$randPICID.".jpg";
		}
		
		if($sbyou_net->booksize){
			$s_str='<span>����</span>';
		}else{
			$s_str='';
		}
		//�б�
	  $LIST_STR.='
	  ��<a href="'.$MOBILE_URL.'page.php?aid='.$sbyou_net->id.'">'.$sbyou_net->typename.'</a>��'.$sbyou_net->zuozhe.'<br />
	  ';
		//��������
		$dsql->ExecuteNoneQuery("update dede_arctype set bookclick=bookclick+3,bookclickm=bookclickm+1,bookclickw=bookclickw+1 where id=$sbyou_net->id limit 1");
	}
  echo $LIST_STR;
  $LIST_STR='';

  ?>
</div>
