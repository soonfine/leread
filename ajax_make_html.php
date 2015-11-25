<?php
/*-----------------
独立功能PHP程序
开发者：枯叶天
淘宝店铺：66 9977
淘宝店铺：6 6 9 9 7 7.TAOBAO.COM
演示站：WWW.SBYOU.NET
官网：WWW.669977.NET
QQ：1981255858
-----------------*/

$sbyou_net='ajax_make_html';

require_once(dirname(__FILE__)."/include/common.inc.php");

$entry=htmlspecialchars($_GET['entry']);
$id1=htmlspecialchars($_GET['id1']);
$id2=htmlspecialchars($_GET['id2']);
$id3=htmlspecialchars($_GET['id3']);
$id4=htmlspecialchars($_GET['id4']);
$id5=htmlspecialchars($_GET['id5']);

$auto=$_GET['auto'];
$list=$_GET['list'];

if($auto){
	//配置后台路径，默认为“697_admin”
	$dir_admin=dirname(__FILE__).'/697_admin/';
	if(is_dir($dir_admin)){
		require_once($dir_admin."config.php");
	}else{
		echo '<center>抱歉，由于您修改了默认后台路径，请您在当前页面文件中配置后台路径！</center>';
		exit;
	}
}




//数据库转存+++++++++++++++++++++++++++++++++++

if($entry=='mysql2disk'){

	$dsql->SetQuery("select * from dede_arctiny as a left join dede_addonarticle as b on a.id=b.aid where a.typeid2='0' and a.typeid=b.typeid limit 1");
	$dsql->Execute();
	while($www_669977_net=$dsql->GetObject())
	{
		$id=$www_669977_net->id;
	}
	
	if($id){
		//数据本地化
		SByou_net_mysql2disk();
		echo '<p style="color:red">处理中，请您稍后...</p>';
		echo '<script>location.reload();</script>';
	}else{
		$dsql->ExecuteNoneQuery("OPTIMIZE TABLE dede_addonarticle");
		echo '
		<p><a style="color:blue" href="?auto=done">返回首页</a></p>
		<p style="color:red">恭喜您，数据库转存操作已经全部完成！</p>
		';
	}

	exit;
}

//++++++++++++++++++++++++++++++++++++++++++++



if($auto && !$entry){
	echo '
	<p><b>强制手动生成静态页面，包括：首页、栏目页、栏目列表页、排行榜、书库</b></p>
	<p>适合以下情况使用：</p>
	<p style="color:red">1、采集或修改页面后，希望立即看到页面更新效果；</p>
	<p style="color:red">2、某些情况下，上述页面为空白页面，此时需要手动强制重新生成静态页面。</p>
	<p>[数据库转存]：</p>
	<p>1、<a style="color:blue" href="?entry=mysql2disk">开始转存</a> —— 自动将mysql中的数据转存到硬盘，以php文件形式存放于/dynamic/htmltxt/，避免数据库过大导致网站崩溃。可定期转存。</p>
	<p>[完全自动生成静态]：</p>
	<p>1、<a style="color:blue" href="?entry=index&auto=yes">开始生成</a></p>
	<p>[逐个栏目生成静态]：</p>
	<p>1、<a style="color:blue" href="?entry=index&auto=single">首页</a></p>
	<p>2、<a style="color:blue" href="?entry=paihang&auto=single">排行榜</a></p>
	<p>2、<a style="color:blue" href="?entry=shuku&auto=single&list=yes">小说书库</a></p>
	<p>2、<a style="color:blue" href="?entry=quanben&auto=single&list=yes">全本小说</a></p>
	<p>2、<a style="color:blue" href="?entry=qihuan&auto=single">奇幻·玄幻</a></p>
	<p>3、<a style="color:blue" href="?entry=wuxia&auto=single">武侠·仙侠</a></p>
	<p>4、<a style="color:blue" href="?entry=dushi&auto=single">都市·言情</a></p>
	<p>5、<a style="color:blue" href="?entry=lishi&auto=single">历史·穿越</a></p>
	<p>6、<a style="color:blue" href="?entry=youxi&auto=single">游戏·竞技</a></p>
	<p>7、<a style="color:blue" href="?entry=kehuan&auto=single">科幻·灵异</a></p>
	';
}

if(!$entry){
	exit;
}

if(!$id3){
	$id3=1;
}

//当前时间
$time=time();
//隔X小时自动静态
$time_x=$MAKE_HTML_TIME;
//过期判断
if(($id4+$time_x)<$time || !$id4){
	$time_up=1;
}else{
	$time_up='';
}


//完整链接
$BOOK_URL=$cfg_basehost.$cfg_indexurl;
//设置前几页静态
$make_pages=5;


//首页
if($entry=='index'){
	if(!$time_up){
		exit;
	}
	$url=$BOOK_URL.'index.php';
	$dir=$entry.'.html';
	
}
//排行榜
if($entry=='paihang'){
	SByou_net_mysql2disk();
	if(!$time_up){
		exit;
	}
	$url=$BOOK_URL.'paihang.php';
	sbyou_Net_createdir($entry);
	$dir=$entry.'/index.html';
	
}
//书库
if($entry=='shuku'){
	SByou_net_mysql2disk();
	if(!$id3 || $id3>$make_pages || !$time_up){
		exit;
	}
	$url=$BOOK_URL.'shuku.php?pages='.$id2.'&page='.$id3;
	sbyou_Net_createdir($entry);
	$dir=$entry.'/list_'.$id3.'.html';
	
}
//全本
if($entry=='quanben'){
	SByou_net_mysql2disk();
	if(!$id3 || $id3>$make_pages || !$time_up){
		exit;
	}
	$url=$BOOK_URL.'quanben.php?pages='.$id2.'&page='.$id3;
	sbyou_Net_createdir($entry);
	$dir=$entry.'/list_'.$id3.'.html';
	
}
//栏目列表页
if($id1=='catalog_list'){
	SByou_net_mysql2disk();
	if(!$id3 || $id3>$make_pages || !$time_up){
		exit;
	}
	$url=$BOOK_URL.'catalog_list.php?id='.$entry.'&pages='.$id2.'&page='.$id3;
	sbyou_Net_createdir($entry);
	$dir=$entry.'/list_'.$id3.'.html';
	
}
//栏目首页
if(!$dir){
	SByou_net_mysql2disk();
	if(!$time_up){
		exit;
	}
	$SByou_Net=$dsql->GetOne("select id from dede_arctype where typedir='$entry' limit 1");
	$exist=$SByou_Net['id'];
	if($exist){
		$url=$BOOK_URL.'plus/list.php?tid='.$entry;
	}else{
		exit;
	}
	sbyou_Net_createdir($entry);
	$dir=$entry.'/index.html';
}

//提取内容
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); 
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,10);
$html=curl_exec($ch);

if($html){
  //生成静态
  $ok=file_put_contents(dirname(__FILE__).'/'.$dir,$html);
}

//每页处理时间间隔
$perTime=1000;

if($auto){
	echo '
	<p><a style="color:blue" href="?auto=done">返回首页</a></p>
	';
	if(!$list){
	  if($ok){
		  $ca_array=array('index','paihang','qihuan','wuxia','dushi','lishi','youxi','kehuan');
		  $key_array=array_keys($ca_array,$entry);
		  $key_next=$key_array[0]+1;
		  
		  $now_entry=$entry;
		  $entry=$ca_array[$key_next];
		  
		  if($auto=='yes'){
			  
			  if($key_next==count($ca_array)){
				  $perTime=3000;				  
				  echo '
				  <p>恭喜您，所有“栏目首页”已经处理成功！</p>
				  <p style="color:red">3秒后进行“书库及栏目列表页”的处理！</p>
				  <script>setTimeout(function(){document.location="'.$BOOK_URL.'ajax_make_html.php?entry=shuku&auto=yes&list=yes";},'.$perTime.');</script>
				  ';
				  exit;
			  }
			  
			  $hou='<p>后续处理：1秒后进行下一个栏目（'.$entry.'）处理！</p>';
		  }else{
			  
			  if($key_next>count($ca_array)){
				  echo '
				  <p>处理栏目：'.$ca_array[($key_next-1)].'</p>
				  <p>处理结果：<span style="color:red">成功！</span></p>
				  ';
				  exit;
			  }
			  
			  if($ca_array[($key_next-1)]=='paihang'){
				  $hou='
				  <p style="color:red">恭喜您，排行榜已经处理！</p>
				  ';
			  }else if($ca_array[($key_next-1)]=='index'){
				  $hou='
				  <p style="color:red">恭喜您，首页已经处理！</p>
				  ';
			  }else{
				  
				  $perTime=3000;
				  
				  $hou='
				  <p style="color:red">3秒后进行“'.$ca_array[($key_next-1)].'列表页”的处理！</p>
				  <script>setTimeout(function(){document.location="'.$BOOK_URL.'ajax_make_html.php?entry='.$ca_array[($key_next-1)].'&id1=catalog_list&auto=single&list=yes";},'.$perTime.');</script>
				  ';
			  }
		  }
		  echo '
		  <p>处理栏目：'.$ca_array[($key_next-1)].'</p>
		  <p>处理结果：<span style="color:red">成功！</span></p>
		  '.$hou.'
		  ';
	  }else{
		echo '
		<p>处理栏目：'.$entry.'</p>
		<p>处理结果：<span style="color:red">失败..</span></p>
		<p>后续处理：5秒后再次处理（'.$entry.'）！</p>
		';
		$perTime=5000;
	  }
	  if($auto=='yes' || !$ok){
		echo '<script>setTimeout(function(){document.location="'.$BOOK_URL.'ajax_make_html.php?entry='.$entry.'&auto=yes";},'.$perTime.');</script>';
	  }
	}else{
	  if($ok){

		  $ca_array=array('shuku','quanben','qihuan','wuxia','dushi','lishi','youxi','kehuan');
		  $key_array=array_keys($ca_array,$entry);
		  $key_next=$key_array[0]+1;
		  
		  $now_page=$id3;
		  $now_entry=$entry;
		  
		  if($now_entry!='shuku' && $now_entry!='quanben'){
			  $id1='catalog_list';
		  }

		  $id3++;
		  if($id3>5){
			  
			  if($auto=='single'){
				  echo '
				  <p style="color:red">恭喜您，所有栏目已经处理成功！</p>
				  ';
				  exit;
			  }
			  
			  if($key_next>=count($ca_array)){
				  echo '
				  <p style="color:red">恭喜您，所有栏目已经处理成功！</p>
				  ';
				  exit;
			  }
			  
			  $id3='1';
			  $entry=$ca_array[$key_next];
		  }

		  echo '
		  <p>处理栏目：'.$now_entry.'/第'.$now_page.'页</p>
		  <p>处理结果：<span style="color:red">成功！</span></p>
		  <p>后续处理：1秒后进行下一页（'.$entry.'/第'.$id3.'页）处理！</p>
		  ';
	  }else{
		  echo '
		  <p>处理栏目：'.$entry.$id1.'（第'.$id3.'页）</p>
		  <p>处理结果：<span style="color:red">失败..</span></p>
		  <p>后续处理：5秒后再次处理！</p>
		  ';
		  $perTime=5000;
	  }
	  if($auto=='yes' || !$ok || $id3<=5){
		echo '<script>setTimeout(function(){document.location="'.$BOOK_URL.'ajax_make_html.php?entry='.$entry.'&id1='.$id1.'&id3='.$id3.'&auto='.$auto.'&list='.$list.'";},'.$perTime.');</script>';
	  }
	}
}
?>