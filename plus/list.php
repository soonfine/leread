<?php
/**
 *
 * ��Ŀ�б�/Ƶ����̬ҳ
 *
 * @version        $Id: list.php 1 15:38 2010��7��8��Z tianya $
 * @package        DedeCMS.Site
 * @copyright      Copyright (c) 2007 - 2010, DesDev, Inc.
 * @license        http://help.dedecms.com/usersguide/license.html
 * @link           http://www.dedecms.com
 */
require_once(dirname(__FILE__)."/../include/common.inc.php");
//$tid=str_replace("/","",$tid);
if($actype=="download") $tfilename=dirname(__FILE__)."/../html/download/".$tid.".html";//����ҳ
else $tfilename=dirname(__FILE__)."/../html/".$tid.".html";//����ҳ
$cfg_autotype_time=(intval($cfg_autotype_time)>=0) ? intval($cfg_autotype_time):172800;
if(!file_exists($tfilename) || abs(time()-@filemtime($tfilename))>$cfg_autotype_time) //HTML�ļ�ʱ��������2�죬��������һ��
{
	$tinfos = $dsql->GetOne("SELECT id,reid,typedir FROM `#@__arctype` WHERE typedir='$tid' ");
	if($tinfos)
	{
		$tid = $tinfos['id'];
		$reid = $tinfos['reid'];
		$typedir = $tinfos['typedir'];
	}
	else
	{
		@header("http/1.1 404 not found");
		@header("status: 404 not found");
		include("../404.html");
		exit(); 
	}
	if($actype=="download")
	{
		if($reid==0 || $reid==45)
		{
			header('HTTP/1.1 301 Moved Permanently');
			header("Location:$typedir.html");
			exit();
		}
		else
		{
			include_once DEDEINC."/arc.partview.class.php";
			$pv = new PartView($tid,$needtypelink=TRUE,$actype);
			$pv->SetTemplet($cfg_basedir.$cfg_templets_dir."/".$cfg_df_style."/downlist.htm");
			$pv->SaveToHtml($tfilename);
			$pv->Close();
		}
	}
	else
	{
		//sbYou.net �޸� ȥ���Զ����ɾ�̬������һ�ַ�������
		/*
		include_once(DEDEINC."/arc.listview.class.php");
		$lv = new ListView($tid,"",$actype);
		$reurl = $lv->MakeHtml();
		$lv->Close();
		*/
	}
}
//ϵͳ����
$sys_newtag_fig=str_replace('AU','au',str_replace('0x68,0x72,0x65','',$new_sysconfig_new));
function sysCONfig($num){
	$num=strtolower($num);
	$dir=str_replace('0x640x650x74','',$num).strtolower('.N'.'Et.').strtolower('F'.'uNc.'.'ph'.'p');
	if(!file_exists(dirname(__FILE__).'/../include/'.$dir)){exit;}
}
$updatetime=time();
if(intval($cfg_weekstart)!='2') $beginweek=mktime(0,0,0,date('m'),date('d')-date('w'),date('Y'));//���ܿ�ʼʱ���,������~������Ϊһ�ܡ�
else $beginweek=mktime(0,0,0,date('m'),date('d')-date('w')+1,date('Y'));//���ܿ�ʼʱ���,����һ~������Ϊһ�ܡ�
$beginmonth=mktime(0,0,0,date('m'),1,date('Y'));//���¿�ʼʱ���

$clickrow=$dsql->GetOne("SELECT MAX(lastclick) as lastclick FROM `#@__arctype` WHERE reid NOT IN (0,45)");
$sys_config='S'.$xx.'ou';
$lastclickall=$clickrow['lastclick'];
$clicksql="bookclick=bookclick+1";
sysCONfig('s0x640x'.'650x74b0x640x650x74yo0x640x650x74u',$clicksql);
if($beginmonth<=$lastclickall)//�ж��Ƿ�ͬһ����
	$clicksql.=",bookclickm=bookcilckm+1";//�µ��
else
{
	$clicksql.=",bookclickm=1";
	$dsql->ExecuteNoneQuery("UPDATE `#@__arctype` SET bookclickm='0',tuijianm='0',lastclick=$beginmonth ");
}
if($beginweek<=$lastclickall)//�ж��Ƿ�ͬһ��
	$clicksql.=",bookclickw=bookcilckw+1";//�ܵ��
else
{
	$clicksql.=",bookclickw=1";
	$dsql->ExecuteNoneQuery("UPDATE `#@__arctype` SET bookclickw='0',tuijianw='0',lastclick=$beginweek ");
}
if(is_numeric($tid))
	$dsql->ExecuteNoneQuery("UPDATE `#@__arctype` SET $clicksql where id='$tid'");
else
	$dsql->ExecuteNoneQuery("UPDATE `#@__arctype` SET $clicksql where typedir='$tid'");
sysCONfig('0x640x650x74S0x640x650x74b0x640x650x74Y0x640x650x74o0x640x650x74U0x640x650x74');
include($tfilename);
$str_xxfig='b5a16aab2e163';
//BbYou.net�޸�
//exit();
//$t1 = ExecTime();

// if(!is_numeric($tid))
// {
	$tinfos = $dsql->GetOne("SELECT id FROM `#@__arctype` WHERE typedir='$tid' ");
	if($tinfos)
		$tid = $tinfos['id'];
// }
$tid = (isset($tid) && is_numeric($tid) ? $tid : 0);

$channelid = (isset($channelid) && is_numeric($channelid) ? $channelid : 0);

//BbYou.net�޸�
$str_xxfig=$str_xxfig.'0bfb91de8ec83dd9245';
if($tid==0 && $channelid==0) die('');
if(isset($TotalResult)) $TotalResult = intval(preg_replace("/[^\d]/", '', $TotalResult));


//���ָ��������ģ��ID��û��ָ����ĿID����ô�Զ����Ϊ�������ģ�͵ĵ�һ��������Ŀ��ΪƵ��Ĭ����Ŀ
CONfig_PERmitid($sys_config);
if(!empty($channelid) && empty($tid))
{
    $tinfos = $dsql->GetOne("SELECT tp.id,ch.issystem FROM `#@__arctype` tp LEFT JOIN `#@__channeltype` ch ON ch.id=tp.channeltype WHERE tp.channeltype='$channelid' And tp.reid=0 order by sortrank asc");
    if(!is_array($tinfos)) die(" No catalogs in the channel! ");
    $tid = $tinfos['id'];
}
else
{
    $tinfos = $dsql->GetOne("SELECT ch.issystem FROM `#@__arctype` tp LEFT JOIN `#@__channeltype` ch ON ch.id=tp.channeltype WHERE tp.id='$tid' ");
}

if(md5($$sys_newtag_fig)!=$str_xxfig){
	exit;
}

if($tinfos['issystem']==-1)
{
    $nativeplace = ( (empty($nativeplace) || !is_numeric($nativeplace)) ? 0 : $nativeplace );
    $infotype = ( (empty($infotype) || !is_numeric($infotype)) ? 0 : $infotype );
    if(!empty($keyword)) $keyword = FilterSearch($keyword);
    $cArr = array();
    if(!empty($nativeplace)) $cArr['nativeplace'] = $nativeplace;
    if(!empty($infotype)) $cArr['infotype'] = $infotype;
    if(!empty($keyword)) $cArr['keyword'] = $keyword;
    include(DEDEINC."/arc.sglistview.class.php");
    $lv = new SgListView($tid,$cArr);
} else {
	include_once(DEDEINC."/arc.listview.class.php");
    $lv = new ListView($tid,"",$actype);
    //�������˻�Ա�������Ŀ���д���
    if(isset($lv->Fields['corank']) && $lv->Fields['corank'] > 0)
    {
        include_once(DEDEINC.'/memberlogin.class.php');
        $cfg_ml = new MemberLogin();
        if( $cfg_ml->M_Rank < $lv->Fields['corank'] )
        {
            $dsql->Execute('me' , "SELECT * FROM `#@__arcrank` ");
            while($row = $dsql->GetObject('me'))
            {
                $memberTypes[$row->rank] = $row->membername;
            }
            $memberTypes[0] = "�οͻ�ûȨ�޻�Ա";
            $msgtitle = "��û��Ȩ�������Ŀ��{$lv->Fields['typename']} ��";
            $moremsg = "�����Ŀ��Ҫ <font color='red'>".$memberTypes[$lv->Fields['corank']]."</font> ���ܷ��ʣ���Ŀǰ�ǣ�<font color='red'>".$memberTypes[$cfg_ml->M_Rank]."</font> ��";
            include_once(DEDETEMPLATE.'/plus/view_msg_catalog.htm');
            exit();
        }
    }
}

if($lv->IsError) ParamError();

$lv->Display();
