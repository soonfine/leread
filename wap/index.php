<?php
$caid=isset($_GET['caid']);
if($caid){
	//ภธฤฟาณ
	$page_id='catalog';
	$index_body='body_catalog.php';
}else{
	//สืาณ
	$page_id='index';
	$index_body='body_index.php';
}
include_once 'header.php';
include_once $index_body;
include_once 'footer.php';
?>