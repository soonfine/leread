<div class="nav">
  <div class="link"> <a href="<?=$MOBILE_URL;?>paihang.php">���а�</a>-<a href="<?=$MOBILE_URL;?>all.php">С˵���</a>-<a href="<?=$MOBILE_URL;?>">��ҳ</a><br />
    <?php
		$dsql->SetQuery("select * from dede_arctype where topid=0 and id!=45 and id!=375 and id!=376 order by sortrank asc limit 6");
		$dsql->Execute();
		while($row=$dsql->GetObject())
		{
			$ca_top_i++;	
			$ca_top_id=$row->id;
			$ca_top_typename=str_replace('��','',$row->typename);
			if($ca_top_i%3==0){
				$fen='<br />';
			}else{
				$fen='|';
			}
			$ca_top_list.='<a href="'.$MOBILE_URL.'?caid='.$ca_top_id.'">'.$ca_top_typename.'</a>'.$fen;
		}
		echo $ca_top_list;
		?>
  </div>
</div>
<div class="search">
  <form action="<?=$MOBILE_URL;?>search.php" method="post">
    <input type="text" name="searchword" maxlength="15" style="width:135px" />
    <input type="submit" name="searchsubmit" value="����" />
  </form>
</div>
<div class="kind">
  <h1>���ư�<span><a href="<?=$MOBILE_URL;?>paihang.php">����&gt;&gt;</a></span></h1>
</div>
<div class="list tj">
  <?php
		$dsql->SetQuery("select * from dede_arctype where topid!=0 and topid!=45 and booksize!=0 order by bookclick desc limit 5");
		$dsql->Execute();
		while($sbyou_net=$dsql->GetObject())
		{
			$fy_i++;
			$typeimg=ltrim($sbyou_net->typeimg,'/');
			if(!$typeimg){
					$randPICID=rand(1,50);
					$typeimg="uploads/empty/".$randPICID.".jpg";
			}
			if($fy_i=='1'){
				$LIST_STR.='
				<a href="'.$MOBILE_URL.'page.php?aid='.$sbyou_net->id.'"><img src="'.$BOOK_URL.$typeimg.'" width="84" height="112" /></a>
				<div class="text">
				  <h2><a href="'.$MOBILE_URL.'page.php?aid='.$sbyou_net->id.'">'.$sbyou_net->typename.'</a></h2>
				  <span class="fs fs16"> ���ߣ�'.$sbyou_net->zuozhe.'<br>
				  �����'.$sbyou_net->booksize.' </span>
				  <p class="fs">���:'.$sbyou_net->description.'</p>
				</div>
				<div class="cl"></div>
				';
			}else{
				$LIST_STR.='
				<a href="'.$MOBILE_URL.'page.php?aid='.$sbyou_net->id.'">'.$sbyou_net->typename.'</a>��'.$sbyou_net->zuozhe.'<br />
				';
			}
		}
		echo $LIST_STR;
		$LIST_STR='';
  ?>
</div>
<div class="kind">
  <h1>�����Ƽ���<span><a href="<?=$MOBILE_URL;?>?caid=4">����</a>|<a href="<?=$MOBILE_URL;?>?caid=3">����</a>|<a href="<?=$MOBILE_URL;?>?caid=2">����</a></span></h1>
</div>
<div class="list">
  <?php
		$dsql->SetQuery("select * from dede_arctype where topid!=0 and topid!=45 and booksize!=0 order by lastupdate desc limit 5");
		$dsql->Execute();
		while($sbyou_net=$dsql->GetObject())
		{
			$LIST_STR.='
			��<a href="'.$MOBILE_URL.'?caid='.$sbyou_net->topid.'">'.str_replace('��','',SBYOU_NET_catalog($sbyou_net->topid,'typename')).'</a>|<a href="'.$MOBILE_URL.'page.php?aid='.$sbyou_net->id.'">'.$sbyou_net->typename.'</a>��'.$sbyou_net->zuozhe.'<br />
			';
		}
		echo $LIST_STR;
		$LIST_STR='';
  ?>
</div>
<div class="kind">
  <h1>�����Ƽ���</h1>
</div>
<div class="list">
  <?php
		$dsql->SetQuery("select * from dede_arctype where topid!=0 and topid!=45 and booksize!=0 order by booksize desc limit 5");
		$dsql->Execute();
		while($sbyou_net=$dsql->GetObject())
		{
			$LIST_STR.='
			��<a href="'.$MOBILE_URL.'?caid='.$sbyou_net->topid.'">'.str_replace('��','',SBYOU_NET_catalog($sbyou_net->topid,'typename')).'</a>|<a href="'.$MOBILE_URL.'page.php?aid='.$sbyou_net->id.'">'.$sbyou_net->typename.'</a>����'.$sbyou_net->booksize.'��<br />
			';
		}
		echo $LIST_STR;
		$LIST_STR='';
  ?>
</div>

<script type="text/javascript" src="<?=$BOOK_URL;?>plus/ad_js.php?aid=18"></script> 

<!--��� ��ʼ-->
<?=SByou_NET_caBlock('11');?>
<!--��� ����--> 

<!--���� ��ʼ-->
<?=SByou_NET_caBlock('22');?>
<!--���� ����--> 

<!--���� ��ʼ-->
<?=SByou_NET_caBlock('33');?>
<!--���� ����--> 

<script type="text/javascript" src="<?=$BOOK_URL;?>plus/ad_js.php?aid=19"></script> 

<!--��ʷ ��ʼ-->
<?=SByou_NET_caBlock('44');?>
<!--��ʷ ����--> 

<!--��Ϸ ��ʼ-->
<?=SByou_NET_caBlock('55');?>
<!--��Ϸ ����--> 

<!--�ƻ� ��ʼ-->
<?=SByou_NET_caBlock('66');?>
<!--�ƻ� ����--> 

