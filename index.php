<?php
/*-----------------
独立功能PHP程序
开发者：枯叶天
淘宝店铺：669977
淘宝店铺：669977.TaoBao.COm
演示站：WWw.SbYOU.NET
官网：WwW.669977.NeT
QQ：1981255858
-----------------*/

if(!file_exists(dirname(__FILE__).'/data/common.inc.php'))
{
    header('Location:install/index.php');
    exit();
}

require_once (dirname(__FILE__) . "/include/common.inc.php");

include_once DEDEINC."/arc.partview.class.php";

//自动生成首页
$GLOBALS['_arclistEnv'] = 'index';
$row = $dsql->GetOne("Select * From `#@__homepageset`");
$row['templet'] = MfTemplet($row['templet']);
$pv = new PartView();
$pv->SetTemplet($cfg_basedir . $cfg_templets_dir . "/" . $row['templet']);
$pv->SaveToHtml(dirname(__FILE__).'/index.html');

$indexfile=dirname(__FILE__).'/index.html';
include($indexfile);
?>