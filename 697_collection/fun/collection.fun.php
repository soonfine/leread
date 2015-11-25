<?php
error_reporting(E_ALL);
class runtime
{ 
    var $StartTime = 0; 
    var $StopTime = 0; 
 
    function get_microtime() 
    { 
        list($usec, $sec) = explode(' ', microtime()); 
        return ((float)$usec + (float)$sec); 
    } 
 
    function start() 
    { 
        $this->StartTime = $this->get_microtime(); 
    } 
 
    function stop() 
    { 
        $this->StopTime = $this->get_microtime(); 
    } 
 
    function spent() 
    { 
        return round(($this->StopTime - $this->StartTime) * 1000, 1); 
    } 
}
//例子 
$runtime= new runtime;
$runtime->start();

require_once (dirname(__FILE__) . "/../../include/common.inc.php");
$dsql->safeCheck = FALSE;
$nidurl="";
$autosql="";
$page=$_GET['page']+1;
if(isset($_GET['nid']))
{
	if(strstr($_GET['nid'],",")) $autosql="and typeid>0 ";
	$row =$dsql->getone("SELECT * FROM `#@__co_note` where nid in (".$_GET['nid'].") ".$autosql."order by cotime"); //循环采集特定的规则
	if(!is_array($row))
	{
		echo "没有符合条件的采集规则，请检查您的设置！";
		exit();
	}
	$nidurl="nid=".$_GET['nid']."&";
}
elseif($co_type!=2) $row =$dsql->getone("SELECT * FROM `#@__co_note` where typeid>0 and typeid<>3 order by cotime"); //按采集时间循环采集所有规则
else $row =$dsql->getone("SELECT * FROM `#@__co_note` where typeid>0 and typeid<>3 order by new,cotime");//先采集新入库的小说
if(($row['cotime']+$co_oldpertime)<time() || isset($_GET['nid']))
{
	if(isset($_GET['page']))
	{
		$nid = $row['nid'];
		$cotype=$row['typeid'];
		$new=$row['new'];
		$channelid=$row['channelid'];
		$cotime=$row['cotime'];
		$renid2=$row['renid'];
		$booksum2=$row['booksum'];
		$notename2=$row['notename'];
		$listconfig2=$row['listconfig'];
		$renid1=substr($row['renid'],-1);
		$renid3=substr($row['renid'],0,4);
		$lasttag=substr($row['remark'],0,4);
		$lasttitle=substr($row['remark'],5);
		$coretag=substr($row['remark'],-4,2);
		$coretimes=substr($row['remark'],-1);
		$coretime=($coretag=="re") ? ($coretimes+1):1;
		echo "<html>\r\n<head>\r\n<title>提示信息</title>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\" />\r\n<meta http-equiv=\"refresh\" content=\"160\">第".$page."条规则：【".$nid."】【".$notename2."】-".$channelid."-".$renid1."<br />";
		$each = (isset($each) && is_numeric($each)) ? $each : 1;
		$make = (isset($make) && is_numeric($make)) ? $make : 0;
		$only = (isset($only) && is_numeric($only)) ? $only : 1;
		$eorid=0;
		$dsql->ExecuteNoneQuery("Update `#@__co_note` set cotime='".time()."' where nid='$nid'; ");
		include_once (dirname(__FILE__) . "/../../include/dedecollection.spider.php");

		//剔除已经20天没有采集到内容的规则
		if($nidcon=='0' and $channelid==1 and $booksum2>1 and $$cotype>0)
		{
			preg_match_all('/typeid=>([0-9]+)]/', $listconfig2, $tidarr);
			$co_stopnonupdate=(intval($co_stopnonupdate)>=0) ? intval($co_stopnonupdate):20;
			$curtime=time()-($co_stopnonupdate*86400);//长时间没有更新的小说自动停止采集
			for($a=0;$a<count($tidarr[1]);$a++)
			{
				$endrow = $dsql->GetOne("SELECT a.id,a.typename,FROM_UNIXTIME(a.lastupdate) AS lastt FROM dede_arctype a WHERE a.id=".$tidarr[1][$a]." and a.lastupdate<$curtime");
				if(is_array($endrow))
				{
					echo "【<font color='red'>".$endrow['typename']."[".$endrow['id']."]->".$endrow['lastt']."</font>】->";
					$tid2=reveser_c('=>'.$tidarr[1][$a].']');
					$tidlen=strlen($tid2);
					$listconfig3=reveser_c($listconfig2);
					$addco_note=reveser_c(substr($listconfig3,stripos($listconfig3,$tid2),stripos($listconfig3,'[',stripos($listconfig3,$tid2))-stripos($listconfig3,$tid2)+1));
					$row = $dsql->GetOne("Select * From `#@__co_note` where nid='$nid' and booksum>1");
					if($row)
					{
						foreach($row as $k=>$v)
						{
							$$k = addslashes($v);
						}
						//有完本字眼的就删除这条规则
						$newbooksum=$booksum-1;
						$replacetname="+".$endrow['typename'];
						$newnotename=str_replace($replacetname,'',$notename);
						$newlistconfig=str_replace($replacetname,'',str_replace($addco_note,'',$listconfig));
						$updatesql="update `#@__co_note` set notename='$newnotename',listconfig='$newlistconfig',booksum=$newbooksum where nid=$nid";
						if($dsql->ExecuteNoneQuery($updatesql))
						{
							$renid=str_replace('-2','-1',$renid);
							if(strstr($notename,'+')) $nidtype="+";
							else $nidtype="-";
							$rowlist=explode($nidtype, $notename);
							$addnotename=$rowlist[0]."-".$endrow['typename'];
							$co_note="{dede:batchrule}".$addco_note."{/dede:batchrule}";
							$listconfig1 = str_replace($notename,$addnotename,str_replace(substr($listconfig,stripos($listconfig,'{dede:batchrule}'),stripos($listconfig,'{/dede:batchrule}')-stripos($listconfig,'{dede:batchrule}')+17),$co_note,$listconfig));
							$cosql = " INSERT INTO `#@__co_note`(`channelid`,`notename`,`sourcelang`,`uptime`,`cotime`,`pnum`,`isok`,`listconfig`,`itemconfig`,`usemore`,booksum,renid,typeid)
							   VALUES ('1','$addnotename','$sourcelang','".time()."','0','0','1','$listconfig1','$itemconfig','1','1','$renid','1'); ";
							if($dsql->ExecuteNoneQuery($cosql))
							{
								$cnid = $dsql->GetLastID();
								$dsql->ExecuteNoneQuery("update `#@__arctype` set copynid='$cnid' where id='".$tidarr[1][$a]."' ");
								echo '处理完毕<br/>';
							}
						}
					}
				}
			}
		}
	}
}
else
{
	echo "没有符合条件的采集规则，请检查您的设置！<br />";
}
	
$runtime->stop();
if(isset($_GET['page']))
	echo "页面执行时间: ".$runtime->spent()." 毫秒（".date("Y-m-d H:i:s",time()+1)."）<br />";
else
	$co_time=3;
?>