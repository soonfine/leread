<?php

/*-----------------
��������PHP����
�����ߣ���Ҷ��
�Ա����̣�669977.TaoBao.com
��ʾվ��www.SBYOU.net
������www.669977.net
QQ��1981255858
-----------------*/

$num='10';//ÿҳ����

//��Ŀ�б�ҳ
if($entry=='catalog_list'){
	$where_sql='select * from dede_arctype where topid='.$caid.' and booksize!=0';
	$fun_str='call_ca_list';
}
//���а�
if($entry=='paihang'){
	$where_sql='select * from dede_arctype where'.$cstr;
	$fun_str='call_ph_list';
}
//���а�
if($entry=='tuwen'){
	$where_sql='select * from dede_arctype where topid!=0 and topid!=45 and booksize!=0 and typeimg!=""';
	$fun_str='call_tuwen';
	$num='5';
}
//Ŀ¼ҳ
if($entry=='list'){
	$where_sql='select * from dede_archives where typeid='.$id;
	$fun_str='call_page_list';
	$num='20';
	$caid=$id;
}
//����ҳ
if($entry=='search'){
	$where_sql='select * from dede_arctype where topid!=0 and topid!=45 and booksize!=0 and typename'." like '%".$searchword."%'";
	$fun_str='call_search';
	$num='5';
	$caid=$searchword;
}

//������ҳ��
$dsql->SetQuery($where_sql);
$dsql->Execute();
while($total_row=$dsql->GetObject())
{
	$total++;
}
!$total?$total='0':'';

//ҳ��
$pagenum=ceil($total/$num);
$page=min($pagenum,$page);
$prepg=$page-1;
$nextpg=($page==$pagenum?0:$page+1);
$offset=($page-1)*$num;
//���ҳ��
!$pagenum?$prepg="":"";
if($prepg){
	$pre='<a href="javascript:'.$fun_str.'(\''.$caid.'\',\''.$prepg.'\',\'yes\')" class="left">��һҳ</a>';
}else{
	$pre='<a href="javascript:(0)" class="left none">����һҳ</a>';
}
if($nextpg){
	$next='<a href="javascript:'.$fun_str.'(\''.$caid.'\',\''.$nextpg.'\',\'yes\')" class="left right">��һҳ</a>';
}else{
	$next='<a href="javascript:(0)" class="left right none">����һҳ</a>';
}
//ҳ���ַ���
$pageNav='<p class="page ca"><span><font>'.$page.'</font>/'.$pagenum.'</span>'.$pre.$next.'</p>';
?>