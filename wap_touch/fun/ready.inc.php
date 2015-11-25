<?php
//当前完整链接
$cur_url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

//各项参数
$caid=$_GET['caid'];
$aid=$_GET['aid'];
$list=$_GET['list'];
$paihang=strpos($cur_url,'paihang');
$tuwen=strpos($cur_url,'tuwen');
$all=strpos($cur_url,'all');
$archive=strpos($cur_url,'archive');
$search=strpos($cur_url,'search');
$adminm=strpos($cur_url,'adminm');

//首页
if(!$caid && !$paihang && !$tuwen && !$all && !$archive && !$search && !$adminm){
	
	$log_index=' log_index';
	
	$title=$HOSTNAME.$CMSNAME;
	$keywords=$HOSTNAME.',完本小说,热门完本小说,完结小说,热门完结小说,免费阅读,热门推荐,最新热门完本小说';
	$description=$HOSTNAME.'快速汇聚各大网站热门完本小说，提供免费小说阅读，热门小说推荐，实时更新最新完本小说，收录所有类型热门完本小说。';
	
	$laca='';
	$header_str='
	<dl>
	  <dt><span class="span2"></span><span class="span3 s1">'.$HOSTNAME.'</span><span class="span3 s2">与PC站同步更新</span></dt>
	  <dd>
		<form action="'.$TOUCH_URL.'search.php" method="post">
		  <input type="hidden" name="forward" value="'.$forward.'" />
		  <input type="text" name="searchword" id="searchword" value="" class="text">
		  <input type="submit" class="button" value="">
		</form>
	  </dd>
	</dl>
	';
	$header_class='';
}
//栏目页
if($caid && !$paihang){
	$typename=str_replace('·','',SBYOU_NET_catalog($caid,'typename'));
	
	$title=SBYOU_NET_catalog($caid,'typename').' - '.$HOSTNAME;
	$keywords=$typename.',热门'.$typename.'小说,最新'.$typename.'完本小说,'.$typename.'完本小说推荐';
	$description=$HOSTNAME.$typename.'频道快速汇聚各大网站热门'.$typename.'完本小说，提供免费小说阅读，热门小说推荐，实时更新最新完本小说，收录所有'.$typename.'热门完本小说。';
	
	$laca='&nbsp;&gt;&nbsp;<a href="'.$TOUCH_URL.'?caid='.$caid.'">'.str_replace('·','',SBYOU_NET_catalog($caid,'typename')).'</a>';
	$header_str='
	<p><b>'.$t_str.'</b><a href="'.$TOUCH_URL.'" class="left">返回首页</a><a href="'.$TOUCH_URL.'" class="right">首页</a><a href="paihang.php?caid='.$caid.'" class="right">排行榜</a></p>
	';
	$header_class=' INner';
}
//排行榜
if($paihang){

	$title=str_replace('·','',SBYOU_NET_catalog($caid,'typename')).'排行榜 - '.$HOSTNAME;
	$keywords=str_replace('·','',SBYOU_NET_catalog($caid,'typename')).'排行榜,热门小说排行榜,完全小说排行榜,最新全本小说排行榜';
	$description='小说网提供每天最新最热门的各类小说排行榜，包含玄幻,都市,仙侠,穿越,言情等小说排行榜。免费提供完本小说排行、最新全本小说排行！';
	
	$laca='&nbsp;&gt;&nbsp;<a href="'.$TOUCH_URL.'paihang.php?caid='.$caid.'">'.str_replace('·','',SBYOU_NET_catalog($caid,'typename')).'排行榜</a>';
	$header_str='
	<p><b>'.$t_str.'</b><a href="'.$TOUCH_URL.'" class="left">返回首页</a><a href="'.$TOUCH_URL.'" class="right">首页</a><a href="'.$TOUCH_URL.'paihang.php" class="right">排行总榜</a></p>
	';
	$header_class=' INner';
}
//全部分类
if($all){

	$title='全部分类 - '.$HOSTNAME;
	$keywords='全部分类,热门小说,最新完本小说,完本小说列表';
	$description='全部分类，是站内完本小说大列表，在这里您可以清晰快捷的找到所有站内的完本小说。';
	
	$laca='&nbsp;&gt;&nbsp;<a href="'.$TOUCH_URL.'all.php">全部分类</a>';
	$header_str='
	<p><b>'.$t_str.'</b><a href="'.$TOUCH_URL.'" class="left">返回首页</a><a href="'.$TOUCH_URL.'" class="right">首页</a><a href="'.$TOUCH_URL.'paihang.php" class="right">排行总榜</a></p>
	';
	$header_class=' INner';
}
//图文推荐
if($tuwen){

	$title='图文推荐 - '.$HOSTNAME;
	$keywords='推荐小说,热门小说推荐,推荐最新完本小说,图文推荐最新热门小说';
	$description=$HOSTNAME.'图文推荐频道为广大网友推荐当前最热门的小说，图文推荐最新最火爆的小说！';
	
	$laca='&nbsp;&gt;&nbsp;<a href="'.$TOUCH_URL.'tuwen.php">图文推荐</a>';
	$header_str='
	<p><b>'.$t_str.'</b><a href="'.$TOUCH_URL.'" class="left">返回首页</a><a href="'.$TOUCH_URL.'" class="right">首页</a><a href="'.$TOUCH_URL.'paihang.php" class="right">排行总榜</a></p>
	';
	$header_class=' INner';
}
//简介页
if($aid && !$list && !$archive){
	$caid=SBYOU_NET_catalog($aid,'topid');
	$typename=str_replace('·','',SBYOU_NET_catalog($caid,'typename'));
	
	$title=SBYOU_NET_catalog($aid,'typename').' - '.SBYOU_NET_catalog($caid,'typename').' - '.$HOSTNAME;
	$keywords=SBYOU_NET_catalog($aid,'typename').'简介,'.SBYOU_NET_catalog($aid,'typename').'最新章节,'.SBYOU_NET_catalog($aid,'typename').'完本小说,全文阅读,txt下载,'.$typename.',热门'.$typename.'完本小说';
	$description='《'.$typename.'》由'.SBYOU_NET_catalog($aid,'zuozhe').'所著，共计'.SBYOU_NET_catalog($aid,'booksize').'字，属于'.$typename.'小说，讲述：'.SBYOU_NET_catalog($aid,'description');
	
	$laca='&nbsp;&gt;&nbsp;<a href="'.$TOUCH_URL.'?caid='.$caid.'">'.$typename.'</a>&nbsp;&gt;&nbsp;<a href="'.$TOUCH_URL.'page.php?aid='.$aid.'">'.SBYOU_NET_catalog($aid,'typename').'</a>';
	$header_str='
	<p><b>'.$t_str.'</b><a id="h_page" href="javascript:(0)" class="left">返回栏目</a><a href="'.$TOUCH_URL.'" class="right">首页</a><a href="'.$TOUCH_URL.'all.php" class="right">全部分类</a><a id="h_list" href="javascript:(0)" class="right">目录</a></p>
	';
	$header_class=' INner';
}
//目录页
if($aid && $list){
	$caid=SBYOU_NET_catalog($aid,'topid');
	$typename=str_replace('·','',SBYOU_NET_catalog($caid,'typename'));
	
	$title=SBYOU_NET_catalog($aid,'typename').'章节列表 - '.SBYOU_NET_catalog($caid,'typename').' - '.$HOSTNAME;
	$keywords=SBYOU_NET_catalog($aid,'typename').'章节列表页,'.SBYOU_NET_catalog($aid,'typename').'最新章节,最新更新,章节阅读,'.$typename.',热门'.$typename.'完本小说';
	$description='《'.$typename.'》由'.SBYOU_NET_catalog($aid,'zuozhe').'所著，共计'.SBYOU_NET_catalog($aid,'booksize').'字，属于'.$typename.'小说，讲述：'.SBYOU_NET_catalog($aid,'description');
	
	$laca='&nbsp;&gt;&nbsp;<a href="'.$TOUCH_URL.'?caid='.$caid.'">'.$typename.'</a>&nbsp;&gt;&nbsp;<a href="'.$TOUCH_URL.'page.php?aid='.$aid.'">'.SBYOU_NET_catalog($aid,'typename').'章节列表</a>';
	$header_str='
	<p><b>'.$t_str.'</b><a id="h_page" href="javascript:(0)" class="left">返回书页</a><a href="'.$TOUCH_URL.'" class="right">首页</a><a href="javascript:add_favorite(mid,mname,regdate,\''.$aid.'\',\'1\',\'1\');" class="right">添加收藏</a></p>
	';
	$header_class=' INner';
}
//内容页
if($aid && $archive){
	$SbYoU_Net=$dsql->GetOne("select * from dede_archives where id=$aid limit 1");
	$typeid=$SbYoU_Net['typeid'];
	$caid=SBYOU_NET_catalog($typeid,'topid');
	
	$title=$SbYoU_Net['title'].' - '.SBYOU_NET_catalog($typeid,'typename').' - '.SBYOU_NET_catalog($caid,'typename').' - '.$HOSTNAME;
	$keywords=$SbYoU_Net['title'].','.SBYOU_NET_catalog($typeid,'typename').'章节,'.SBYOU_NET_catalog($caid,'typename').'小说';
	$description=$SbYoU_Net['title'].'是《'.SBYOU_NET_catalog($typeid,'typename').'》小说章节。《'.SBYOU_NET_catalog($typeid,'typename').'》最新更新，本小说网站免费提供此本小说所有章节。';
	
	$laca='&nbsp;&gt;&nbsp;<a href="'.$TOUCH_URL.'?caid='.$caid.'">'.str_replace('·','',SBYOU_NET_catalog($caid,'typename')).'</a>&nbsp;&gt;&nbsp;<a href="'.$TOUCH_URL.'page.php?aid='.$typeid.'">'.SBYOU_NET_catalog($typeid,'typename').'</a>';
	$header_str='
	<p><b>'.$t_str.'</b><a id="h_page" href="javascript:(0)" class="left">返回书页</a><a href="'.$TOUCH_URL.'" class="right">首页</a><a href="javascript:add_favorite(mid,mname,regdate,\''.$aid.'\',\'2\',\'1\');" class="right">加入书签</a><a id="h_list" href="javascript:(0)" class="right">目录</a></p>
	';
	$header_class=' INner';
}
//搜索页
if($search){
	$title=$searchword.'搜索结果 - '.$HOSTNAME;
	$keywords=$searchword.',搜索结果,'.$HOSTNAME.'手机搜索小说';
	$description=$HOSTNAME.'提供《'.$searchword.'》免费搜索免费阅读。《'.$searchword.'》最新更新，本小说网站免费提供此本小说所有章节。';
	
	$laca='&nbsp;&gt;&nbsp;搜索&nbsp;&gt;&nbsp;'.$searchword;
	$header_str='
	<p><b>'.$t_str.'</b><a href="'.$TOUCH_URL.'" class="left">返回首页</a><a href="'.$TOUCH_URL.'" class="right">首页</a><a href="'.$TOUCH_URL.'all.php" class="right">全部分类</a></p>
	';
	$header_class=' INner';
}
//会员中心
if($adminm){
	$title='会员中心 - '.$HOSTNAME;
	$keywords='会员中心,'.$HOSTNAME;
	$description=$HOSTNAME.'会员中心提供收藏夹等功能！';
	
	$laca='&nbsp;&gt;&nbsp;会员中心&nbsp;&gt;&nbsp;收藏夹';
	$header_str='
	<p><b>'.$t_str.'</b><a href="'.$TOUCH_URL.'" class="left">返回首页</a><a href="'.$TOUCH_URL.'" class="right">首页</a><a href="'.$TOUCH_URL.'all.php" class="right">全部分类</a></p>
	';
	$header_class=' INner';
}

//当前位置
$laca='当前位置：<a href="'.$TOUCH_URL.'">首页</a>'.$laca;
?>