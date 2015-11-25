<?php
/**
 * 用户动态ajax显示页
 *
 * @version        $Id: feed.php 1 17:55 2010年7月6日Z tianya $
 * @package        DedeCMS.Helpers
 * @copyright      Copyright (c) 2007 - 2010, DesDev, Inc.
 * @license        http://help.dedecms.com/usersguide/license.html
 * @link           http://www.dedecms.com
 */
require_once(dirname(__FILE__)."/config.php");
CheckRank(0,0);
$menutype = 'config';
AjaxHead();

function quoteReplace($quote)
{
    $quote = str_replace('{quote}','',$quote);
    $quote = str_replace('{title}','',$quote);
    $quote = str_replace('{/title}','',$quote);
    $quote = str_replace('&lt;br/&gt;','',$quote);
    $quote = str_replace('&lt;', '', $quote);
    $quote = str_replace('&gt;', '', $quote);
    $quote = str_replace('{content}','',$quote);
    $quote = str_replace('{/content}','',$quote);
    $quote = str_replace('{/quote}','',$quote);
    return $quote;
}

//选择数据库
$feeds = array();
$type=(empty($type))? "" : $type;
if($type=="allfeed")
{
    $sql="SELECT * FROM `#@__member_feed` ORDER BY dtime DESC LIMIT 8";
    $dsql->SetQuery($sql);
    $dsql->Execute();
    while ($row = $dsql->GetArray()) {
        if($cfg_soft_lang == 'gb2312') {
            $row['uname'] = gb2utf8($row['uname']);
            $row['title'] = gb2utf8(htmlspecialchars_decode($row['title'],ENT_QUOTES));
            $row['note'] = gb2utf8(quoteReplace($row['note']));
            $row['dtime']= gb2utf8(FloorTime(time()- $row['dtime']));
        }else{
            $row['title'] = htmlspecialchars_decode($row['title'],ENT_QUOTES);
            $row['dtime']= FloorTime(time()- $row['dtime']);
        }
        $feeds[] = $row;
    }
} else if ($type=="myfeed"){    
    $sql="SELECT * FROM `#@__member_feed`  where mid='".$cfg_ml->M_ID."' ORDER BY dtime DESC limit 8";
    $dsql->SetQuery($sql);
    $dsql->Execute();
    while ($row = $dsql->GetArray()) {
        if($cfg_soft_lang == 'gb2312') {
            $row['uname'] = gb2utf8($row['uname']);
            $row['title'] = gb2utf8(htmlspecialchars_decode($row['title'],ENT_QUOTES));
            $row['note'] = gb2utf8(quoteReplace($row['note']));
            $row['dtime']= gb2utf8(FloorTime(time()- $row['dtime']));
        }else{
            $row['title'] = htmlspecialchars_decode($row['title'],ENT_QUOTES);
            $row['dtime']= FloorTime(time()- $row['dtime']);
        }
        $feeds[] = $row;
    }
} else {
    require_once(DEDEINC.'/channelunit.func.php');
		
		//sbYOu.net xiu改 官网：wWw.6 6 9 9 7 7.nEt
		
		$dsql->SetQuery("select * from #@__arctype where topid!=0 and topid!=45 and booksize!=0 order by id desc limit 8");
		$dsql->Execute();
		while($sbyou_net=$dsql->GetObject())
		{
				$row['ca_typename'] = gb2utf8(SBYOU_NET_catalog($sbyou_net->topid,'typename'));
				$row['ca_url'] = $cfg_indexurl.SBYOU_NET_catalog($sbyou_net->topid,'typedir').'.html';
				$row['htmlurl'] = $cfg_indexurl.ltrim($sbyou_net->typedir,'/').'/';
				$row['typename'] = gb2utf8($sbyou_net->typename);
				$row['zuozhe'] = gb2utf8($sbyou_net->zuozhe);
				$row['lastupdate'] = gb2utf8(MyDate('Y-m-d H:i',$sbyou_net->lastupdate));
				$row['booksize'] = $sbyou_net->booksize;
				
				$feeds[] = $row;
		}
 
}

$output = json_encode($feeds);
print($output);