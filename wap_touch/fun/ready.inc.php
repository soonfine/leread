<?php
//��ǰ��������
$cur_url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

//�������
$caid=$_GET['caid'];
$aid=$_GET['aid'];
$list=$_GET['list'];
$paihang=strpos($cur_url,'paihang');
$tuwen=strpos($cur_url,'tuwen');
$all=strpos($cur_url,'all');
$archive=strpos($cur_url,'archive');
$search=strpos($cur_url,'search');
$adminm=strpos($cur_url,'adminm');

//��ҳ
if(!$caid && !$paihang && !$tuwen && !$all && !$archive && !$search && !$adminm){
	
	$log_index=' log_index';
	
	$title=$HOSTNAME.$CMSNAME;
	$keywords=$HOSTNAME.',�걾С˵,�����걾С˵,���С˵,�������С˵,����Ķ�,�����Ƽ�,���������걾С˵';
	$description=$HOSTNAME.'���ٻ�۸�����վ�����걾С˵���ṩ���С˵�Ķ�������С˵�Ƽ���ʵʱ���������걾С˵����¼�������������걾С˵��';
	
	$laca='';
	$header_str='
	<dl>
	  <dt><span class="span2"></span><span class="span3 s1">'.$HOSTNAME.'</span><span class="span3 s2">��PCվͬ������</span></dt>
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
//��Ŀҳ
if($caid && !$paihang){
	$typename=str_replace('��','',SBYOU_NET_catalog($caid,'typename'));
	
	$title=SBYOU_NET_catalog($caid,'typename').' - '.$HOSTNAME;
	$keywords=$typename.',����'.$typename.'С˵,����'.$typename.'�걾С˵,'.$typename.'�걾С˵�Ƽ�';
	$description=$HOSTNAME.$typename.'Ƶ�����ٻ�۸�����վ����'.$typename.'�걾С˵���ṩ���С˵�Ķ�������С˵�Ƽ���ʵʱ���������걾С˵����¼����'.$typename.'�����걾С˵��';
	
	$laca='&nbsp;&gt;&nbsp;<a href="'.$TOUCH_URL.'?caid='.$caid.'">'.str_replace('��','',SBYOU_NET_catalog($caid,'typename')).'</a>';
	$header_str='
	<p><b>'.$t_str.'</b><a href="'.$TOUCH_URL.'" class="left">������ҳ</a><a href="'.$TOUCH_URL.'" class="right">��ҳ</a><a href="paihang.php?caid='.$caid.'" class="right">���а�</a></p>
	';
	$header_class=' INner';
}
//���а�
if($paihang){

	$title=str_replace('��','',SBYOU_NET_catalog($caid,'typename')).'���а� - '.$HOSTNAME;
	$keywords=str_replace('��','',SBYOU_NET_catalog($caid,'typename')).'���а�,����С˵���а�,��ȫС˵���а�,����ȫ��С˵���а�';
	$description='С˵���ṩÿ�����������ŵĸ���С˵���а񣬰�������,����,����,��Խ,�����С˵���а�����ṩ�걾С˵���С�����ȫ��С˵���У�';
	
	$laca='&nbsp;&gt;&nbsp;<a href="'.$TOUCH_URL.'paihang.php?caid='.$caid.'">'.str_replace('��','',SBYOU_NET_catalog($caid,'typename')).'���а�</a>';
	$header_str='
	<p><b>'.$t_str.'</b><a href="'.$TOUCH_URL.'" class="left">������ҳ</a><a href="'.$TOUCH_URL.'" class="right">��ҳ</a><a href="'.$TOUCH_URL.'paihang.php" class="right">�����ܰ�</a></p>
	';
	$header_class=' INner';
}
//ȫ������
if($all){

	$title='ȫ������ - '.$HOSTNAME;
	$keywords='ȫ������,����С˵,�����걾С˵,�걾С˵�б�';
	$description='ȫ�����࣬��վ���걾С˵���б�������������������ݵ��ҵ�����վ�ڵ��걾С˵��';
	
	$laca='&nbsp;&gt;&nbsp;<a href="'.$TOUCH_URL.'all.php">ȫ������</a>';
	$header_str='
	<p><b>'.$t_str.'</b><a href="'.$TOUCH_URL.'" class="left">������ҳ</a><a href="'.$TOUCH_URL.'" class="right">��ҳ</a><a href="'.$TOUCH_URL.'paihang.php" class="right">�����ܰ�</a></p>
	';
	$header_class=' INner';
}
//ͼ���Ƽ�
if($tuwen){

	$title='ͼ���Ƽ� - '.$HOSTNAME;
	$keywords='�Ƽ�С˵,����С˵�Ƽ�,�Ƽ������걾С˵,ͼ���Ƽ���������С˵';
	$description=$HOSTNAME.'ͼ���Ƽ�Ƶ��Ϊ��������Ƽ���ǰ�����ŵ�С˵��ͼ���Ƽ�������𱬵�С˵��';
	
	$laca='&nbsp;&gt;&nbsp;<a href="'.$TOUCH_URL.'tuwen.php">ͼ���Ƽ�</a>';
	$header_str='
	<p><b>'.$t_str.'</b><a href="'.$TOUCH_URL.'" class="left">������ҳ</a><a href="'.$TOUCH_URL.'" class="right">��ҳ</a><a href="'.$TOUCH_URL.'paihang.php" class="right">�����ܰ�</a></p>
	';
	$header_class=' INner';
}
//���ҳ
if($aid && !$list && !$archive){
	$caid=SBYOU_NET_catalog($aid,'topid');
	$typename=str_replace('��','',SBYOU_NET_catalog($caid,'typename'));
	
	$title=SBYOU_NET_catalog($aid,'typename').' - '.SBYOU_NET_catalog($caid,'typename').' - '.$HOSTNAME;
	$keywords=SBYOU_NET_catalog($aid,'typename').'���,'.SBYOU_NET_catalog($aid,'typename').'�����½�,'.SBYOU_NET_catalog($aid,'typename').'�걾С˵,ȫ���Ķ�,txt����,'.$typename.',����'.$typename.'�걾С˵';
	$description='��'.$typename.'����'.SBYOU_NET_catalog($aid,'zuozhe').'����������'.SBYOU_NET_catalog($aid,'booksize').'�֣�����'.$typename.'С˵��������'.SBYOU_NET_catalog($aid,'description');
	
	$laca='&nbsp;&gt;&nbsp;<a href="'.$TOUCH_URL.'?caid='.$caid.'">'.$typename.'</a>&nbsp;&gt;&nbsp;<a href="'.$TOUCH_URL.'page.php?aid='.$aid.'">'.SBYOU_NET_catalog($aid,'typename').'</a>';
	$header_str='
	<p><b>'.$t_str.'</b><a id="h_page" href="javascript:(0)" class="left">������Ŀ</a><a href="'.$TOUCH_URL.'" class="right">��ҳ</a><a href="'.$TOUCH_URL.'all.php" class="right">ȫ������</a><a id="h_list" href="javascript:(0)" class="right">Ŀ¼</a></p>
	';
	$header_class=' INner';
}
//Ŀ¼ҳ
if($aid && $list){
	$caid=SBYOU_NET_catalog($aid,'topid');
	$typename=str_replace('��','',SBYOU_NET_catalog($caid,'typename'));
	
	$title=SBYOU_NET_catalog($aid,'typename').'�½��б� - '.SBYOU_NET_catalog($caid,'typename').' - '.$HOSTNAME;
	$keywords=SBYOU_NET_catalog($aid,'typename').'�½��б�ҳ,'.SBYOU_NET_catalog($aid,'typename').'�����½�,���¸���,�½��Ķ�,'.$typename.',����'.$typename.'�걾С˵';
	$description='��'.$typename.'����'.SBYOU_NET_catalog($aid,'zuozhe').'����������'.SBYOU_NET_catalog($aid,'booksize').'�֣�����'.$typename.'С˵��������'.SBYOU_NET_catalog($aid,'description');
	
	$laca='&nbsp;&gt;&nbsp;<a href="'.$TOUCH_URL.'?caid='.$caid.'">'.$typename.'</a>&nbsp;&gt;&nbsp;<a href="'.$TOUCH_URL.'page.php?aid='.$aid.'">'.SBYOU_NET_catalog($aid,'typename').'�½��б�</a>';
	$header_str='
	<p><b>'.$t_str.'</b><a id="h_page" href="javascript:(0)" class="left">������ҳ</a><a href="'.$TOUCH_URL.'" class="right">��ҳ</a><a href="javascript:add_favorite(mid,mname,regdate,\''.$aid.'\',\'1\',\'1\');" class="right">����ղ�</a></p>
	';
	$header_class=' INner';
}
//����ҳ
if($aid && $archive){
	$SbYoU_Net=$dsql->GetOne("select * from dede_archives where id=$aid limit 1");
	$typeid=$SbYoU_Net['typeid'];
	$caid=SBYOU_NET_catalog($typeid,'topid');
	
	$title=$SbYoU_Net['title'].' - '.SBYOU_NET_catalog($typeid,'typename').' - '.SBYOU_NET_catalog($caid,'typename').' - '.$HOSTNAME;
	$keywords=$SbYoU_Net['title'].','.SBYOU_NET_catalog($typeid,'typename').'�½�,'.SBYOU_NET_catalog($caid,'typename').'С˵';
	$description=$SbYoU_Net['title'].'�ǡ�'.SBYOU_NET_catalog($typeid,'typename').'��С˵�½ڡ���'.SBYOU_NET_catalog($typeid,'typename').'�����¸��£���С˵��վ����ṩ�˱�С˵�����½ڡ�';
	
	$laca='&nbsp;&gt;&nbsp;<a href="'.$TOUCH_URL.'?caid='.$caid.'">'.str_replace('��','',SBYOU_NET_catalog($caid,'typename')).'</a>&nbsp;&gt;&nbsp;<a href="'.$TOUCH_URL.'page.php?aid='.$typeid.'">'.SBYOU_NET_catalog($typeid,'typename').'</a>';
	$header_str='
	<p><b>'.$t_str.'</b><a id="h_page" href="javascript:(0)" class="left">������ҳ</a><a href="'.$TOUCH_URL.'" class="right">��ҳ</a><a href="javascript:add_favorite(mid,mname,regdate,\''.$aid.'\',\'2\',\'1\');" class="right">������ǩ</a><a id="h_list" href="javascript:(0)" class="right">Ŀ¼</a></p>
	';
	$header_class=' INner';
}
//����ҳ
if($search){
	$title=$searchword.'������� - '.$HOSTNAME;
	$keywords=$searchword.',�������,'.$HOSTNAME.'�ֻ�����С˵';
	$description=$HOSTNAME.'�ṩ��'.$searchword.'�������������Ķ�����'.$searchword.'�����¸��£���С˵��վ����ṩ�˱�С˵�����½ڡ�';
	
	$laca='&nbsp;&gt;&nbsp;����&nbsp;&gt;&nbsp;'.$searchword;
	$header_str='
	<p><b>'.$t_str.'</b><a href="'.$TOUCH_URL.'" class="left">������ҳ</a><a href="'.$TOUCH_URL.'" class="right">��ҳ</a><a href="'.$TOUCH_URL.'all.php" class="right">ȫ������</a></p>
	';
	$header_class=' INner';
}
//��Ա����
if($adminm){
	$title='��Ա���� - '.$HOSTNAME;
	$keywords='��Ա����,'.$HOSTNAME;
	$description=$HOSTNAME.'��Ա�����ṩ�ղؼеȹ��ܣ�';
	
	$laca='&nbsp;&gt;&nbsp;��Ա����&nbsp;&gt;&nbsp;�ղؼ�';
	$header_str='
	<p><b>'.$t_str.'</b><a href="'.$TOUCH_URL.'" class="left">������ҳ</a><a href="'.$TOUCH_URL.'" class="right">��ҳ</a><a href="'.$TOUCH_URL.'all.php" class="right">ȫ������</a></p>
	';
	$header_class=' INner';
}

//��ǰλ��
$laca='��ǰλ�ã�<a href="'.$TOUCH_URL.'">��ҳ</a>'.$laca;
?>