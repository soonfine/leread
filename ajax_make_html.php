<?php
/*-----------------
��������PHP����
�����ߣ���Ҷ��
�Ա����̣�66 9977
�Ա����̣�6 6 9 9 7 7.TAOBAO.COM
��ʾվ��WWW.SBYOU.NET
������WWW.669977.NET
QQ��1981255858
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
	//���ú�̨·����Ĭ��Ϊ��697_admin��
	$dir_admin=dirname(__FILE__).'/697_admin/';
	if(is_dir($dir_admin)){
		require_once($dir_admin."config.php");
	}else{
		echo '<center>��Ǹ���������޸���Ĭ�Ϻ�̨·���������ڵ�ǰҳ���ļ������ú�̨·����</center>';
		exit;
	}
}




//���ݿ�ת��+++++++++++++++++++++++++++++++++++

if($entry=='mysql2disk'){

	$dsql->SetQuery("select * from dede_arctiny as a left join dede_addonarticle as b on a.id=b.aid where a.typeid2='0' and a.typeid=b.typeid limit 1");
	$dsql->Execute();
	while($www_669977_net=$dsql->GetObject())
	{
		$id=$www_669977_net->id;
	}
	
	if($id){
		//���ݱ��ػ�
		SByou_net_mysql2disk();
		echo '<p style="color:red">�����У������Ժ�...</p>';
		echo '<script>location.reload();</script>';
	}else{
		$dsql->ExecuteNoneQuery("OPTIMIZE TABLE dede_addonarticle");
		echo '
		<p><a style="color:blue" href="?auto=done">������ҳ</a></p>
		<p style="color:red">��ϲ�������ݿ�ת������Ѿ�ȫ����ɣ�</p>
		';
	}

	exit;
}

//++++++++++++++++++++++++++++++++++++++++++++



if($auto && !$entry){
	echo '
	<p><b>ǿ���ֶ����ɾ�̬ҳ�棬��������ҳ����Ŀҳ����Ŀ�б�ҳ�����а����</b></p>
	<p>�ʺ��������ʹ�ã�</p>
	<p style="color:red">1���ɼ����޸�ҳ���ϣ����������ҳ�����Ч����</p>
	<p style="color:red">2��ĳЩ����£�����ҳ��Ϊ�հ�ҳ�棬��ʱ��Ҫ�ֶ�ǿ���������ɾ�̬ҳ�档</p>
	<p>[���ݿ�ת��]��</p>
	<p>1��<a style="color:blue" href="?entry=mysql2disk">��ʼת��</a> ���� �Զ���mysql�е�����ת�浽Ӳ�̣���php�ļ���ʽ�����/dynamic/htmltxt/���������ݿ��������վ�������ɶ���ת�档</p>
	<p>[��ȫ�Զ����ɾ�̬]��</p>
	<p>1��<a style="color:blue" href="?entry=index&auto=yes">��ʼ����</a></p>
	<p>[�����Ŀ���ɾ�̬]��</p>
	<p>1��<a style="color:blue" href="?entry=index&auto=single">��ҳ</a></p>
	<p>2��<a style="color:blue" href="?entry=paihang&auto=single">���а�</a></p>
	<p>2��<a style="color:blue" href="?entry=shuku&auto=single&list=yes">С˵���</a></p>
	<p>2��<a style="color:blue" href="?entry=quanben&auto=single&list=yes">ȫ��С˵</a></p>
	<p>2��<a style="color:blue" href="?entry=qihuan&auto=single">��á�����</a></p>
	<p>3��<a style="color:blue" href="?entry=wuxia&auto=single">����������</a></p>
	<p>4��<a style="color:blue" href="?entry=dushi&auto=single">���С�����</a></p>
	<p>5��<a style="color:blue" href="?entry=lishi&auto=single">��ʷ����Խ</a></p>
	<p>6��<a style="color:blue" href="?entry=youxi&auto=single">��Ϸ������</a></p>
	<p>7��<a style="color:blue" href="?entry=kehuan&auto=single">�ƻá�����</a></p>
	';
}

if(!$entry){
	exit;
}

if(!$id3){
	$id3=1;
}

//��ǰʱ��
$time=time();
//��XСʱ�Զ���̬
$time_x=$MAKE_HTML_TIME;
//�����ж�
if(($id4+$time_x)<$time || !$id4){
	$time_up=1;
}else{
	$time_up='';
}


//��������
$BOOK_URL=$cfg_basehost.$cfg_indexurl;
//����ǰ��ҳ��̬
$make_pages=5;


//��ҳ
if($entry=='index'){
	if(!$time_up){
		exit;
	}
	$url=$BOOK_URL.'index.php';
	$dir=$entry.'.html';
	
}
//���а�
if($entry=='paihang'){
	SByou_net_mysql2disk();
	if(!$time_up){
		exit;
	}
	$url=$BOOK_URL.'paihang.php';
	sbyou_Net_createdir($entry);
	$dir=$entry.'/index.html';
	
}
//���
if($entry=='shuku'){
	SByou_net_mysql2disk();
	if(!$id3 || $id3>$make_pages || !$time_up){
		exit;
	}
	$url=$BOOK_URL.'shuku.php?pages='.$id2.'&page='.$id3;
	sbyou_Net_createdir($entry);
	$dir=$entry.'/list_'.$id3.'.html';
	
}
//ȫ��
if($entry=='quanben'){
	SByou_net_mysql2disk();
	if(!$id3 || $id3>$make_pages || !$time_up){
		exit;
	}
	$url=$BOOK_URL.'quanben.php?pages='.$id2.'&page='.$id3;
	sbyou_Net_createdir($entry);
	$dir=$entry.'/list_'.$id3.'.html';
	
}
//��Ŀ�б�ҳ
if($id1=='catalog_list'){
	SByou_net_mysql2disk();
	if(!$id3 || $id3>$make_pages || !$time_up){
		exit;
	}
	$url=$BOOK_URL.'catalog_list.php?id='.$entry.'&pages='.$id2.'&page='.$id3;
	sbyou_Net_createdir($entry);
	$dir=$entry.'/list_'.$id3.'.html';
	
}
//��Ŀ��ҳ
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

//��ȡ����
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); 
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,10);
$html=curl_exec($ch);

if($html){
  //���ɾ�̬
  $ok=file_put_contents(dirname(__FILE__).'/'.$dir,$html);
}

//ÿҳ����ʱ����
$perTime=1000;

if($auto){
	echo '
	<p><a style="color:blue" href="?auto=done">������ҳ</a></p>
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
				  <p>��ϲ�������С���Ŀ��ҳ���Ѿ�����ɹ���</p>
				  <p style="color:red">3�����С���⼰��Ŀ�б�ҳ���Ĵ���</p>
				  <script>setTimeout(function(){document.location="'.$BOOK_URL.'ajax_make_html.php?entry=shuku&auto=yes&list=yes";},'.$perTime.');</script>
				  ';
				  exit;
			  }
			  
			  $hou='<p>��������1��������һ����Ŀ��'.$entry.'������</p>';
		  }else{
			  
			  if($key_next>count($ca_array)){
				  echo '
				  <p>������Ŀ��'.$ca_array[($key_next-1)].'</p>
				  <p>��������<span style="color:red">�ɹ���</span></p>
				  ';
				  exit;
			  }
			  
			  if($ca_array[($key_next-1)]=='paihang'){
				  $hou='
				  <p style="color:red">��ϲ�������а��Ѿ�����</p>
				  ';
			  }else if($ca_array[($key_next-1)]=='index'){
				  $hou='
				  <p style="color:red">��ϲ������ҳ�Ѿ�����</p>
				  ';
			  }else{
				  
				  $perTime=3000;
				  
				  $hou='
				  <p style="color:red">3�����С�'.$ca_array[($key_next-1)].'�б�ҳ���Ĵ���</p>
				  <script>setTimeout(function(){document.location="'.$BOOK_URL.'ajax_make_html.php?entry='.$ca_array[($key_next-1)].'&id1=catalog_list&auto=single&list=yes";},'.$perTime.');</script>
				  ';
			  }
		  }
		  echo '
		  <p>������Ŀ��'.$ca_array[($key_next-1)].'</p>
		  <p>��������<span style="color:red">�ɹ���</span></p>
		  '.$hou.'
		  ';
	  }else{
		echo '
		<p>������Ŀ��'.$entry.'</p>
		<p>��������<span style="color:red">ʧ��..</span></p>
		<p>��������5����ٴδ���'.$entry.'����</p>
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
				  <p style="color:red">��ϲ����������Ŀ�Ѿ�����ɹ���</p>
				  ';
				  exit;
			  }
			  
			  if($key_next>=count($ca_array)){
				  echo '
				  <p style="color:red">��ϲ����������Ŀ�Ѿ�����ɹ���</p>
				  ';
				  exit;
			  }
			  
			  $id3='1';
			  $entry=$ca_array[$key_next];
		  }

		  echo '
		  <p>������Ŀ��'.$now_entry.'/��'.$now_page.'ҳ</p>
		  <p>��������<span style="color:red">�ɹ���</span></p>
		  <p>��������1��������һҳ��'.$entry.'/��'.$id3.'ҳ������</p>
		  ';
	  }else{
		  echo '
		  <p>������Ŀ��'.$entry.$id1.'����'.$id3.'ҳ��</p>
		  <p>��������<span style="color:red">ʧ��..</span></p>
		  <p>��������5����ٴδ���</p>
		  ';
		  $perTime=5000;
	  }
	  if($auto=='yes' || !$ok || $id3<=5){
		echo '<script>setTimeout(function(){document.location="'.$BOOK_URL.'ajax_make_html.php?entry='.$entry.'&id1='.$id1.'&id3='.$id3.'&auto='.$auto.'&list='.$list.'";},'.$perTime.');</script>';
	  }
	}
}
?>