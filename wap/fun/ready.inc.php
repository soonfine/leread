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

//��ҳ
if(!$caid && !$paihang && !$tuwen && !$all && !$archive && !$search){
	
	$title=$HOSTNAME.$CMSNAME;
	$keywords=$HOSTNAME.',�걾С˵,�����걾С˵,���С˵,�������С˵,����Ķ�,�����Ƽ�,���������걾С˵';
	$description=$HOSTNAME.'���ٻ�۸�����վ�����걾С˵���ṩ���С˵�Ķ�������С˵�Ƽ���ʵʱ���������걾С˵����¼�������������걾С˵��';
	
	$laca='';
}
//��Ŀҳ
if($caid && !$paihang){
	$typename=str_replace('��','',SBYOU_NET_catalog($caid,'typename'));
	
	$title=SBYOU_NET_catalog($caid,'typename').' - '.$HOSTNAME;
	$keywords=$typename.',����'.$typename.'С˵,����'.$typename.'�걾С˵,'.$typename.'�걾С˵�Ƽ�';
	$description=$HOSTNAME.$typename.'Ƶ�����ٻ�۸�����վ����'.$typename.'�걾С˵���ṩ���С˵�Ķ�������С˵�Ƽ���ʵʱ���������걾С˵����¼����'.$typename.'�����걾С˵��';
	
	$laca='&nbsp;&gt;&nbsp;<a href="'.$MOBILE_URL.'?caid='.$caid.'">'.str_replace('��','',SBYOU_NET_catalog($caid,'typename')).'</a>';
}
//���а�
if($paihang){

	$title=str_replace('��','',SBYOU_NET_catalog($caid,'typename')).'���а� - '.$HOSTNAME;
	$keywords=str_replace('��','',SBYOU_NET_catalog($caid,'typename')).'���а�,����С˵���а�,��ȫС˵���а�,����ȫ��С˵���а�';
	$description='С˵���ṩÿ�����������ŵĸ���С˵���а񣬰�������,����,����,��Խ,�����С˵���а�����ṩ�걾С˵���С�����ȫ��С˵���У�';
	
	$laca='&nbsp;&gt;&nbsp;<a href="'.$MOBILE_URL.'paihang.php?caid='.$caid.'">'.str_replace('��','',SBYOU_NET_catalog($caid,'typename')).'���а�</a>';
}
//ȫ������
if($all){

	$title='С˵��� - '.$HOSTNAME;
	$keywords='С˵���,����С˵,�����걾С˵,�걾С˵�б�';
	$description='С˵��⣬��վ���걾С˵���б�������������������ݵ��ҵ�����վ�ڵ��걾С˵��';
	
	$laca='&nbsp;&gt;&nbsp;<a href="'.$MOBILE_URL.'all.php">С˵���</a>';
}
//ͼ���Ƽ�
if($tuwen){

	$title='ͼ���Ƽ� - '.$HOSTNAME;
	$keywords='�Ƽ�С˵,����С˵�Ƽ�,�Ƽ������걾С˵,ͼ���Ƽ���������С˵';
	$description=$HOSTNAME.'ͼ���Ƽ�Ƶ��Ϊ��������Ƽ���ǰ�����ŵ�С˵��ͼ���Ƽ�������𱬵�С˵��';
	
	$laca='&nbsp;&gt;&nbsp;<a href="'.$MOBILE_URL.'tuwen.php">ͼ���Ƽ�</a>';
}
//���ҳ
if($aid && !$list && !$archive){
	$caid=SBYOU_NET_catalog($aid,'topid');
	$typename=str_replace('��','',SBYOU_NET_catalog($caid,'typename'));
	
	$title=SBYOU_NET_catalog($aid,'typename').' - '.SBYOU_NET_catalog($caid,'typename').' - '.$HOSTNAME;
	$keywords=SBYOU_NET_catalog($aid,'typename').'���,'.SBYOU_NET_catalog($aid,'typename').'�����½�,'.SBYOU_NET_catalog($aid,'typename').'�걾С˵,ȫ���Ķ�,txt����,'.$typename.',����'.$typename.'�걾С˵';
	$description='��'.$typename.'����'.SBYOU_NET_catalog($aid,'zuozhe').'����������'.SBYOU_NET_catalog($aid,'booksize').'�֣�����'.$typename.'С˵��������'.SBYOU_NET_catalog($aid,'description');
	
	$laca='&nbsp;&gt;&nbsp;<a href="'.$MOBILE_URL.'?caid='.$caid.'">'.$typename.'</a>';
}
//Ŀ¼ҳ
if($aid && $list){
	$caid=SBYOU_NET_catalog($aid,'topid');
	$typename=str_replace('��','',SBYOU_NET_catalog($caid,'typename'));
	
	$title=SBYOU_NET_catalog($aid,'typename').'�½��б� - '.SBYOU_NET_catalog($caid,'typename').' - '.$HOSTNAME;
	$keywords=SBYOU_NET_catalog($aid,'typename').'�½��б�ҳ,'.SBYOU_NET_catalog($aid,'typename').'�����½�,���¸���,�½��Ķ�,'.$typename.',����'.$typename.'�걾С˵';
	$description='��'.$typename.'����'.SBYOU_NET_catalog($aid,'zuozhe').'����������'.SBYOU_NET_catalog($aid,'booksize').'�֣�����'.$typename.'С˵��������'.SBYOU_NET_catalog($aid,'description');
	
	$laca='&nbsp;&gt;&nbsp;<a href="'.$MOBILE_URL.'?caid='.$caid.'">'.$typename.'</a>';
}
//����ҳ
if($aid && $archive){
	$SbYoU_Net=$dsql->GetOne("select * from dede_archives where id=$aid limit 1");
	$typeid=$SbYoU_Net['typeid'];
	$caid=SBYOU_NET_catalog($typeid,'topid');
	
	$title=$SbYoU_Net['title'].' - '.SBYOU_NET_catalog($typeid,'typename').' - '.SBYOU_NET_catalog($caid,'typename').' - '.$HOSTNAME;
	$keywords=$SbYoU_Net['title'].','.SBYOU_NET_catalog($typeid,'typename').'�½�,'.SBYOU_NET_catalog($caid,'typename').'С˵';
	$description=$SbYoU_Net['title'].'�ǡ�'.SBYOU_NET_catalog($typeid,'typename').'��С˵�½ڡ���'.SBYOU_NET_catalog($typeid,'typename').'�����¸��£���С˵��վ����ṩ�˱�С˵�����½ڡ�';
	
	$laca='&nbsp;&gt;&nbsp;<a href="'.$MOBILE_URL.'?caid='.$caid.'">'.str_replace('��','',SBYOU_NET_catalog($caid,'typename')).'</a>';
}
//����ҳ
if($search){
	$title='������� - '.$HOSTNAME;
	$keywords='�ֻ�С˵����,'.$HOSTNAME;
	$description=$HOSTNAME.'������������������������ŵ�С˵��';
	
	$laca='&nbsp;&gt;&nbsp;�������';
}

//��ǰλ��
$laca='��ǰλ�ã�<a href="'.$MOBILE_URL.'">��ҳ</a>'.$laca;
?>