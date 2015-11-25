<?php
/**-----------------------
使用说明
第三方账号快速登陆插件
包括：数据表members_qc_loader及文件夹QC_Loader
步骤：获取第三方账号的ID及名称=>将ID及名称写入members_qc_loader=>结合网站程序写入新的会员信息=>重置当前账号登陆状态

开发者：枯叶天（旺旺ID）
淘宝店铺：669977.taobao.com
官方网站：www.669977.net
QQ：1981255858
-----------------------**/

define('NOROBOT',TRUE);
include_once dirname(__FILE__).'/base.inc.php';
include_once dirname(__FILE__).'/../include/common.inc.php';

//用户名
$name=$_GET['sbyou_NET_name'];
//头像
$thumb=$_GET['sbyou_NET_thumb'];
//QQ登陆
$openid=$_GET['sbyou_NET_openid'];
//微博登陆
$id=$_GET['sbyou_NET_id'];

if($openid){
	sbyou_Net_Login('openid',$openid,$name,$thumb);
}else if($id){
	sbyou_Net_Login('id',$id,$name,$thumb);
}
?>