<?php

/*-----------------
��������PHP����
�����ߣ���Ҷ��
�Ա����̣�669977.TaoBao.com
��ʾվ��www.SBYOU.net
������www.669977.net
QQ��1981255858
-----------------*/

//��ȡ����
if($fuck=='subject'){
	$fuck='topid!=0 and topid!=45 and booksize!=0 and typename';
}else if($fuck=='author'){
	$fuck='topid!=0 and topid!=45 and booksize!=0 and zuozhe';	
}else{
	$sbyou_NET=$dsql->GetOne("select id from dede_arctype where typedir='$fuck' limit 1");
	$topid=$sbyou_NET['id'];
	if($topid){
		$fuck='topid='.$topid.' and typename';
	}else{
		$fuck='topid=4 and typename';
	}
}


$code_searchword=urlencode($searchword);//�����

empty($page)?$page=1:"";

//ҳ��
include_once dirname(__FILE__).'/pageNav.php';

//�б�
if($total){
	$dsql->SetQuery($where_sql." order by bookclick desc limit $offset,$num");
	$dsql->Execute();
	while($row=$dsql->GetObject())
	{
		//����ͼ
		$typeimg=$row->typeimg;
		if($typeimg){
			$typeimg=ltrim($typeimg,'/');
		}else{
			$randNUM=rand(1,50);
			$typeimg='uploads/empty/'.$randNUM.'.jpg';
		}
	
		$topid=$row->topid;
		$typename=$row->typename;
		$typedir=trim($row->typedir,'/');
		
		$bookclick=$row->bookclick;
		$bookclickm=$row->bookclickm;
		$bookclickw=$row->bookclickw;
		
		$tuijian=$row->tuijian;
		$tuijianm=$row->tuijianm;
		$tuijianw=$row->tuijianw;
		
		$zuozhe=$row->zuozhe;
		$booksize=$row->booksize;
		$lastupdate=$row->lastupdate;
		
		//���
		$description=$row->description.'����';
		if($description=="����"){$description='��Ǹ���������޼�飬����Ϊ���ռ���';}
		
		$arcURL=$BOOK_URL.$typedir.'/';
	
		//��Ŀ
		$liSTR.='
		<li>
		  <h2><span><a href="'.$BOOK_URL.SBYOU_NET_catalog($topid,'typedir').'.html" target="'.SBYOU_NET_catalog($topid,'typename').'">'.SBYOU_NET_catalog($topid,'typename').'</a></span><a href="'.$arcURL.'" target="_blank">'.str_replace($searchword,('<font>'.$searchword.'</font>'),$typename).'</a></h2>
		  <div class="pic">
			<a rel="nofollow" href="'.$arcURL.'" target="_blank"><img src="'.$BOOK_URL.$typeimg.'" /></a>
			<span class="eSpan"></span><a href="'.$arcURL.'" class="eA" target="_blank">'.$typename.'</a>
		  </div>
		  <div class="words">
			<p class="state">
			���ߣ�<a href="'.$BOOK_URL.'author/?'.$row->id.'.html" target="_blank" title="'.$zuozhe.'">'.$zuozhe.'</a>&nbsp;&nbsp;&nbsp;&nbsp;
			���ͣ�<a href="'.$BOOK_URL.SBYOU_NET_catalog($topid,'typedir').'.html" target="'.SBYOU_NET_catalog($topid,'typename').'">'.SBYOU_NET_catalog($topid,'typename').'</a>&nbsp;&nbsp;&nbsp;&nbsp;
			������'.$booksize.'<br />
			�ܵ����'.$bookclick.'&nbsp;&nbsp;&nbsp;&nbsp;
			�µ����'.$bookclickm.'&nbsp;&nbsp;&nbsp;&nbsp;
			�ܵ����'.$bookclickw.'&nbsp;&nbsp;&nbsp;&nbsp;
			���Ƽ���'.$tuijian.'&nbsp;&nbsp;&nbsp;&nbsp;
			���Ƽ���'.$tuijianm.'&nbsp;&nbsp;&nbsp;&nbsp;
			���Ƽ���'.$tuijianw.'
			</p>
			<p class="jianjie">��飺'.$description.'</p>
			<p class="arcurl">'.str_replace('http://','',$arcURL).'&nbsp;'.date('Y-m-d',$lastupdate).'
			<span class="more">&nbsp;-&nbsp;<a href="'.$arcURL.'" target="_blank">�����Ķ�</a>&nbsp;-&nbsp;<a href="'.$arcURL.'chapter.html" target="_blank">�鿴��Ŀ</a>&nbsp;-&nbsp;<a href="'.$TXT_URL.'?topid='.$topid.'&id='.$row->id.'&date='.$lastupdate.'" target="_blank">����TXTС˵</a>'.'</span>
			</p>
		  </div>
		</li>
		';
	}
	
	//�����ؼ���
	$keyAid=$dsql->GetOne("select aid from dede_search_keywords where keyword='$searchword' limit 1");
	$keyAid=$keyAid['aid'];
	if($keyAid){
		//��������
		$dsql->ExecuteNoneQuery("update dede_search_keywords set count=count+1 where aid=$keyAid limit 1");
	}else{
		//��������
		$dsql->ExecuteNoneQuery("insert into dede_search_keywords (keyword) values ('$searchword')");
	}
}else{
	$liSTR='
	<br />
	<br />
	&nbsp;:&nbsp;:&nbsp;��Ǹ������������ݣ�����Ϊ���ռ���
	<br />
	<br />
	';
}
echo '<div id="main"><ul class="ul_b_list">'.$liSTR.$setSDATA.'</ul></div>'.$pageNav;
?>