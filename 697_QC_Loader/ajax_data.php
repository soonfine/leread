<?php
/**-----------------------
ʹ��˵��
�������˺ſ��ٵ�½���
���������ݱ�members_qc_loader���ļ���QC_Loader
���裺��ȡ�������˺ŵ�ID������=>��ID������д��members_qc_loader=>�����վ����д���µĻ�Ա��Ϣ=>���õ�ǰ�˺ŵ�½״̬

�����ߣ���Ҷ�죨����ID��
�Ա����̣�669977.taobao.com
�ٷ���վ��www.669977.net
QQ��1981255858
-----------------------**/

define('NOROBOT',TRUE);
include_once dirname(__FILE__).'/base.inc.php';
include_once dirname(__FILE__).'/../include/common.inc.php';

//�û���
$name=$_GET['sbyou_NET_name'];
//ͷ��
$thumb=$_GET['sbyou_NET_thumb'];
//QQ��½
$openid=$_GET['sbyou_NET_openid'];
//΢����½
$id=$_GET['sbyou_NET_id'];

if($openid){
	sbyou_Net_Login('openid',$openid,$name,$thumb);
}else if($id){
	sbyou_Net_Login('id',$id,$name,$thumb);
}
?>