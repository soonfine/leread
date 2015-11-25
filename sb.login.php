<?php
/*-----------------
独立功能PHP程序
开发者：枯叶天
淘宝店铺：669977.TaoBao.com
演示站：www.SbYou.net
官网：www.669977.net
QQ：1981255858
-----------------*/

require_once(dirname(__FILE__)."/member/config.php");
AjaxHead();

$entry=$_GET['entry'];
$uid=$cfg_ml->M_ID;
$uname=$cfg_ml->M_UserName;
$utime=$cfg_ml->M_JoinTime_time;
$scores=$cfg_ml->M_Scores;
$referer=$_SERVER[ 'HTTP_REFERER' ];
$reurls=parse_url($referer);
$furl="";

if($reurls['host']=='www.qmnovel.com'||$reurls['host']=='m.qmnovel.com'){
    if(preg_match("/^\/(qihuan|wuxia|dushi|lishi|youxi|kehuan)/",$reurls['path'],$res)==1){
        $res[0]=trim($res[0],'/');
        $caid=0;
        switch($res[0]){
        case 'qihuan':
            $caid=11;
            break;
        case 'wuxia':
            $caid=22;
            break;
        case 'dushi':
            $caid=33;
            break;
        case 'lishi':
            $caid=44;
            break;
        case 'youxi':
            $caid=55;
            break;
        case 'kexuan':
            $caid=66;
            break;
        }
        $furl="http://www.qmnovel.com/wap_touch/?caid=".$caid;
    }
    else if(preg_match("/^\/(697_admin|so|wap|wap_touch|txt|697_LocoySpider|697_QC_Loader|697_collection|member|author|shuku|paihang|paihangbang|quanben|page)/",$reurls['path'])==0){
    
        $match=preg_match("/^\/[^\/]*\//",$reurls['path'],$res);
        if($match){
            $res[0]=rtrim($res[0],'/');
            $sbyou_net=$dsql->GetOne("select id from dede_arctype where typedir='$res[0]' limit 1");
            $bookid=$sbyou_net['id'];
        }
        if($bookid){
            if(substr($reurls['path'], -strlen("chapter.html")) === "chapter.html"){
                $furl="http://www.qmnovel.com/wap_touch/page.php?aid=".$bookid."&list=1";
            }
            else if(preg_match("/[0-9]*\.html$/",$reurls['path'],$res)){
                $pageid=substr($res[0],0, -5);
                $furl="http://www.qmnovel.com/wap_touch/archive.php?aid=".$pageid;
            }
            else {
                $furl="http://www.qmnovel.com/wap_touch/page.php?aid=".$bookid;
            }
        }
    }
}

if(!$uid){
	$login_xx_tpl='login_none.htm';
}else{
	//数据
	$sbyou_net=$dsql->GetOne("select sbyou_net_lookTotal,sbyou_net_goodTotal,sbyou_net_badTotal from dede_member_data where mid='$uid' limit 1");
	$sbyou_net_lookTotal=$sbyou_net['sbyou_net_lookTotal'];
	$sbyou_net_goodTotal=$sbyou_net['sbyou_net_goodTotal'];
	$sbyou_net_badTotal=$sbyou_net['sbyou_net_badTotal'];
	if(!$sbyou_net_lookTotal){
		$sbyou_net_lookTotal='0';
	}
	if(!$sbyou_net_goodTotal){
		$sbyou_net_goodTotal='0';
	}
	if(!$sbyou_net_badTotal){
		$sbyou_net_badTotal='0';
	}
	//头像
	$face=$cfg_ml->M_Face;
	if($face){
		if(strpos($face,'http://')>-1){
			$face=$face;
		}else{
			$face=$BOOK_URL.ltrim($face,'/');
		}
	}else{
		$imgID=rand(1,100);
		$face=$BOOK_URL.'uploads/empty/'.$imgID.'.gif';
	}
	//会员等级
	$urank=$cfg_ml->M_Rank;
	$sbyou_net=$dsql->GetOne("select membername from dede_arcrank where rank='$urank' limit 1");
	$sbyou_net_memberRANK=$sbyou_net['membername'];
	//重置会员等级
	sbyou_net_memberRANK($scores,$uid);
	//模板
	$login_xx_tpl='login_ok.htm';
}

//加载模板
require_once(DEDEINC."/datalistcp.class.php");
$dlist = new DataListCP();
$dlist->SetTemplet($cfg_basedir.$cfg_templets_dir."/".$cfg_df_style.'/'.$login_xx_tpl);
$dlist->Display();
?>
