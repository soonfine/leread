<?php
$caid=isset($_GET['caid']);
if($caid){
	//��Ŀҳ
	$page_id='catalog';
	$index_body='body_catalog.php';
}else{
	//��ҳ
	$page_id='index';
	$index_body='body_index.php';
}
include_once 'header.php';
include_once $index_body;
include_once 'footer.php';
?>