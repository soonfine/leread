<?php
/**
 * ������վ��ͼ
 *
 * @version        $Id: makehtml_map.php 1 11:17 2010��7��19��Z tianya $
 * @package        DedeCMS.Administrator
 * @copyright      Copyright (c) 2007 - 2010, DesDev, Inc.
 * @license        http://help.dedecms.com/usersguide/license.html
 * @link           http://www.dedecms.com
 */
require_once(dirname(__FILE__)."/config.php");
require_once(DEDEINC."/sitemap.class.php");
require_once(DEDEINC."/dedetag.class.php");

if(empty($dopost))
{
    ShowMsg("��������!","-1");
    exit();
}
$isremote = empty($isremote)? 0 : $isremote;
$serviterm=empty($serviterm)? "" : $serviterm;
$sm = new SiteMap();
$maplist = $sm->GetSiteMap($dopost);
if($dopost=="site")
{
    $murl = $cfg_cmspath."/sitemap.html";
    include_once(DEDEINC."/arc.partview.class.php");
    //����sitemap by QISIP 2014-04-01
    $sitemaptemplet=$cfg_df_style."/sitemap.htm";
    $pv2 = new PartView();
    $pv2->SetTemplet($cfg_basedir.$cfg_templets_dir."/".$sitemaptemplet);
    $sitemapFile ="../sitemap.html";
    $pv2->SaveToHtml($sitemapFile);
    echo "<a href='$murl' target='_blank'>�ɹ������ļ�: $murl ���...</a>";
    exit();
}
else
{
    $murl = $cfg_cmspath."/rssmap.html";
    $tmpfile = $cfg_basedir.$cfg_templets_dir."/plus/rssmap.htm";
}
$dtp = new DedeTagParse();
$dtp->LoadTemplet($tmpfile);
$dtp->SaveTo($cfg_basedir.$murl);
if($cfg_remote_site=='Y' && $isremote == 1)
{
    if($serviterm!="")
    {
        list($servurl, $servuser, $servpwd) = explode(',', $serviterm);
        $config=array( 'hostname' => $servurl, 'username' => $servuser, 
                   'password' => $servpwd,'debug' => 'TRUE');
    } else {
        $config=array();
    }
    if( $ftp->connect($config) )
    {
        //����Զ���ļ�·��
        $remotefile = $murl;
        $localfile = '..'.$remotefile;
        $remotedir = preg_replace('#[^\/]*\.html#', '', $remotefile);
        $ftp->rmkdir($remotedir);
        if($ftp->upload($localfile, $remotefile, 'acii')) echo "Զ�̷����ɹ�!"."<br />";
    }
}
$dtp->Clear();
echo "<a href='$murl' target='_blank'>�ɹ������ļ�: $murl ���...</a>";
exit();