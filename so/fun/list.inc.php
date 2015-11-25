<?php

/*-----------------
独立功能PHP程序
开发者：枯叶天
淘宝店铺：669977.TaoBao.com
演示站：www.SBYOU.net
官网：www.669977.net
QQ：1981255858
-----------------*/

//获取变量
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


$code_searchword=urlencode($searchword);//编码后

empty($page)?$page=1:"";

//页码
include_once dirname(__FILE__).'/pageNav.php';

//列表
if($total){
	$dsql->SetQuery($where_sql." order by bookclick desc limit $offset,$num");
	$dsql->Execute();
	while($row=$dsql->GetObject())
	{
		//缩略图
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
		
		//简介
		$description=$row->description.'……';
		if($description=="……"){$description='抱歉，本书暂无简介，立马为您收集！';}
		
		$arcURL=$BOOK_URL.$typedir.'/';
	
		//条目
		$liSTR.='
		<li>
		  <h2><span><a href="'.$BOOK_URL.SBYOU_NET_catalog($topid,'typedir').'.html" target="'.SBYOU_NET_catalog($topid,'typename').'">'.SBYOU_NET_catalog($topid,'typename').'</a></span><a href="'.$arcURL.'" target="_blank">'.str_replace($searchword,('<font>'.$searchword.'</font>'),$typename).'</a></h2>
		  <div class="pic">
			<a rel="nofollow" href="'.$arcURL.'" target="_blank"><img src="'.$BOOK_URL.$typeimg.'" /></a>
			<span class="eSpan"></span><a href="'.$arcURL.'" class="eA" target="_blank">'.$typename.'</a>
		  </div>
		  <div class="words">
			<p class="state">
			作者：<a href="'.$BOOK_URL.'author/?'.$row->id.'.html" target="_blank" title="'.$zuozhe.'">'.$zuozhe.'</a>&nbsp;&nbsp;&nbsp;&nbsp;
			类型：<a href="'.$BOOK_URL.SBYOU_NET_catalog($topid,'typedir').'.html" target="'.SBYOU_NET_catalog($topid,'typename').'">'.SBYOU_NET_catalog($topid,'typename').'</a>&nbsp;&nbsp;&nbsp;&nbsp;
			字数：'.$booksize.'<br />
			总点击：'.$bookclick.'&nbsp;&nbsp;&nbsp;&nbsp;
			月点击：'.$bookclickm.'&nbsp;&nbsp;&nbsp;&nbsp;
			周点击：'.$bookclickw.'&nbsp;&nbsp;&nbsp;&nbsp;
			总推荐：'.$tuijian.'&nbsp;&nbsp;&nbsp;&nbsp;
			月推荐：'.$tuijianm.'&nbsp;&nbsp;&nbsp;&nbsp;
			周推荐：'.$tuijianw.'
			</p>
			<p class="jianjie">简介：'.$description.'</p>
			<p class="arcurl">'.str_replace('http://','',$arcURL).'&nbsp;'.date('Y-m-d',$lastupdate).'
			<span class="more">&nbsp;-&nbsp;<a href="'.$arcURL.'" target="_blank">立即阅读</a>&nbsp;-&nbsp;<a href="'.$arcURL.'chapter.html" target="_blank">查看书目</a>&nbsp;-&nbsp;<a href="'.$TXT_URL.'?topid='.$topid.'&id='.$row->id.'&date='.$lastupdate.'" target="_blank">下载TXT小说</a>'.'</span>
			</p>
		  </div>
		</li>
		';
	}
	
	//搜索关键词
	$keyAid=$dsql->GetOne("select aid from dede_search_keywords where keyword='$searchword' limit 1");
	$keyAid=$keyAid['aid'];
	if($keyAid){
		//更新数据
		$dsql->ExecuteNoneQuery("update dede_search_keywords set count=count+1 where aid=$keyAid limit 1");
	}else{
		//插入数据
		$dsql->ExecuteNoneQuery("insert into dede_search_keywords (keyword) values ('$searchword')");
	}
}else{
	$liSTR='
	<br />
	<br />
	&nbsp;:&nbsp;:&nbsp;抱歉，暂无相关内容，立马为您收集！
	<br />
	<br />
	';
}
echo '<div id="main"><ul class="ul_b_list">'.$liSTR.$setSDATA.'</ul></div>'.$pageNav;
?>