<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
$each = (isset($each) && is_numeric($each)) ? $each : 1;
$make = (isset($make) && is_numeric($make)) ? $make : 1;
$only = (isset($only) && is_numeric($only)) ? $only : 1;

$maketime = 30;

$spider = array();
array_push($spider,array(3,36)); 

require_once(dirname(__FILE__)."/../include/dedecollection.spider.php");
?>