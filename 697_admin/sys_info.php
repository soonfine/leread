<?php
/**
 * 系统配置
 *
 * @version        $Id: sys_info.php 1 22:28 2010年7月20日Z tianya $
 * @package        DedeCMS.Administrator
 * @copyright      Copyright (c) 2007 - 2010, DesDev, Inc.
 * @license        http://help.dedecms.com/usersguide/license.html
 * @link           http://www.dedecms.com
 */
require_once(dirname(__FILE__)."/config.php");
CheckPurview('sys_Edit');
if(empty($dopost)) $dopost = "";

$configfile = DEDEDATA.'/config.cache.inc.php';

//更新配置函数
function ReWriteConfig()
{
    global $dsql,$configfile;
    if(!is_writeable($configfile))
    {
        echo "配置文件'{$configfile}'不支持写入，无法修改系统配置参数！";
        exit();
    }
    $fp = fopen($configfile,'w');
    flock($fp,3);
    fwrite($fp,"<"."?php\r\n");
    $dsql->SetQuery("SELECT `varname`,`type`,`value`,`groupid` FROM `#@__sysconfig` ORDER BY aid ASC ");
    $dsql->Execute();
    while($row = $dsql->GetArray())
    {
        if($row['type']=='number')
        {
            if($row['value']=='') $row['value'] = 0;
            fwrite($fp,"\${$row['varname']} = ".$row['value'].";\r\n");
        }
        else
        {
            fwrite($fp,"\${$row['varname']} = '".str_replace("'",'',$row['value'])."';\r\n");
        }
    }
    fwrite($fp,"?".">");
    fclose($fp);
}

//保存配置的改动
if($dopost=="save")
{
    $bookrulerow = $dsql->GetOne("SELECT value FROM `#@__sysconfig` WHERE varname LIKE 'bookrule' ");
	$oldbookrule=$bookrulerow['value'];
	$zuozherulerow = $dsql->GetOne("SELECT value FROM `#@__sysconfig` WHERE varname LIKE 'zuozherule' ");
	$oldzuozherule=$zuozherulerow['value'];
	foreach($_POST as $k=>$v)
    {
        if(preg_match("#^edit___#", $k))
        {
            $v = cn_substrR(${$k}, 10240);
        }
        else
        {
            continue;
        }
        $k = preg_replace("#^edit___#", "", $k);
		if($k=='bookrule') $newbookrule=$v;
		if($k=='zuozherule') $newzuozherule=$v;
		if($k=='cbookurl') $cbookurl=$v;
		if($k=='czuozheurl') $czuozheurl=$v;
        $dsql->ExecuteNoneQuery("UPDATE `#@__sysconfig` SET `value`='$v' WHERE varname='$k' ");
    }
    ReWriteConfig();
	if($oldbookrule!=$newbookrule && $cbookurl=='Y')
	{
		$dsql->SetQuery("SELECT * FROM `#@__arctype` where reid not in(0,45)");
		$dsql->Execute();
		while($row = $dsql->GetArray())
		{
			$pinyindir=GetPinyin(stripslashes($row['typename']));
			$pydir=GetPinyin(stripslashes($row['typename']),1);
			$iddir=$row['id'];
			$typedir=str_replace('[拼音首字母]',$pydir,str_replace('[ID]',$iddir,str_replace('[拼音]',$pinyindir,$newbookrule)));
			$typedir=preg_replace("#\/{1,}#", "/", $typedir);
			//检查是否有重名的小说目录，如果有则目录拼音后自动添加数字区别
			$typedirrow = $dsql->GetOne("SELECT `typedir` FROM `#@__arctype` WHERE `typedir`='/$typedir'");
			if($typedirrow)
			{
				for($ti=1;$ti<100;$ti++)
				{
					$typedirsql="SELECT `typedir` FROM `#@__arctype` WHERE `typedir`='/".$typedir.$ti."'";
					$typedirrow = $dsql->GetOne($typedirsql);
					if(!$typedirrow)
					{
						$typedir = $typedir.$ti;
						break;
					}
				}
			}
			$typedir="/".$typedir;
			$dsql->ExecuteNoneQuery("UPDATE `#@__arctype` SET `typedir`='$typedir' WHERE id='$iddir' ");
		}
	}
	if($oldzuozherule!=$newzuozherule && $czuozheurl=='Y')
	{
		$dsql->SetQuery("SELECT * FROM `#@__arctype` where reid=45");
		$dsql->Execute();
		while($row = $dsql->GetArray())
		{
			$pinyindir=GetPinyin(stripslashes($row['typename']));
			$pydir=GetPinyin(stripslashes($row['typename']),1);
			$iddir=$row['id'];
			$typedir=str_replace('[拼音首字母]',$pydir,str_replace('[ID]',$iddir,str_replace('[拼音]',$pinyindir,$newzuozherule)));
			$typedir=preg_replace("#\/{1,}#", "/", $typedir);
			//检查是否有重名的小说目录，如果有则目录拼音后自动添加数字区别
			$typedirrow = $dsql->GetOne("SELECT `typedir` FROM `#@__arctype` WHERE `typedir`='/$typedir'");
			if($typedirrow)
			{
				for($ti=1;$ti<100;$ti++)
				{
					$typedirsql="SELECT `typedir` FROM `#@__arctype` WHERE `typedir`='/".$typedir.$ti."'";
					$typedirrow = $dsql->GetOne($typedirsql);
					if(!$typedirrow)
					{
						$typedir = $typedir.$ti;
						break;
					}
				}
			}
			$typedir="/".$typedir;
			$dsql->ExecuteNoneQuery("UPDATE `#@__arctype` SET `typedir`='$typedir' WHERE id='$iddir' ");
		}
	}
    ShowMsg("成功更改站点配置！", "sys_info.php");
    exit();
}
//增加新变量
else if($dopost=='add')
{
    if($vartype=='bool' && ($nvarvalue!='Y' && $nvarvalue!='N'))
    {
        ShowMsg("布尔变量值必须为'Y'或'N'!","-1");
        exit();
    }
    if(trim($nvarname)=='' || preg_match("#[^a-z_]#i", $nvarname) )
    {
        ShowMsg("变量名不能为空并且必须为[a-z_]组成!","-1");
        exit();
    }
    $row = $dsql->GetOne("SELECT varname FROM `#@__sysconfig` WHERE varname LIKE '$nvarname' ");
    if(is_array($row))
    {
        ShowMsg("该变量名称已经存在!","-1");
        exit();
    }
    $row = $dsql->GetOne("SELECT aid FROM `#@__sysconfig` ORDER BY aid DESC ");
    $aid = $row['aid'] + 1;
    $inquery = "INSERT INTO `#@__sysconfig`(`aid`,`varname`,`info`,`value`,`type`,`groupid`)
    VALUES ('$aid','$nvarname','$varmsg','$nvarvalue','$vartype','$vargroup')";
    $rs = $dsql->ExecuteNoneQuery($inquery);
    if(!$rs)
    {
        ShowMsg("新增变量失败，可能有非法字符！", "sys_info.php?gp=$vargroup");
        exit();
    }
    if(!is_writeable($configfile))
    {
        ShowMsg("成功保存变量，但由于 $configfile 无法写入，因此不能更新配置文件！","sys_info.php?gp=$vargroup");
        exit();
    }else
    {
        ReWriteConfig();
        ShowMsg("成功保存变量并更新配置文件！","sys_info.php?gp=$vargroup");
        exit();
    }
}
// 搜索配置
else if ($dopost=='search')
{
    $keywords = isset($keywords)? strip_tags($keywords) : '';
    $i = 1;
    $configstr = <<<EOT
 <table width="100%" cellspacing="1" cellpadding="1" border="0" bgcolor="#cfcfcf" id="tdSearch" style="">
  <tbody>
   <tr height="25" bgcolor="#fbfce2" align="center">
    <td width="300">参数说明</td>
    <td>参数值</td>
    <td width="220">变量名</td>
   </tr>
EOT;
    echo $configstr;
    if ($keywords)
    {

        $dsql->SetQuery("SELECT * FROM `#@__sysconfig` WHERE info LIKE '%$keywords%' order by aid asc");
        $dsql->Execute();
       
        while ($row = $dsql->GetArray()) {
            $bgcolor = ($i++%2==0)? "#F9FCEF" : "#ffffff";
            $row['info'] = preg_replace("#{$keywords}#", '<font color="red">'.$keywords.'</font>', $row['info']);
?>
      <tr align="center" height="25" bgcolor="<?php echo $bgcolor?>">
       <td width="300"><?php echo $row['info']; ?>： </td>
       <td align="left" style="padding:3px;">
<?php
    if($row['type']=='bool')
    {
        $c1='';
        $c2 = '';
        $row['value']=='Y' ? $c1=" checked" : $c2=" checked";
        echo "<input type='radio' class='np' name='edit___{$row['varname']}' value='Y'$c1>是 ";
        echo "<input type='radio' class='np' name='edit___{$row['varname']}' value='N'$c2>否 ";
    }else if($row['type']=='bstring')
    {
        echo "<textarea name='edit___{$row['varname']}' row='4' id='edit___{$row['varname']}' class='textarea_info' style='width:98%;height:50px'>".htmlspecialchars($row['value'])."</textarea>";
    }else if($row['type']=='number')
    {
        echo "<input type='text' name='edit___{$row['varname']}' id='edit___{$row['varname']}' value='{$row['value']}' style='width:30%'>";
    }else
    {
        echo "<input type='text' name='edit___{$row['varname']}' id='edit___{$row['varname']}' value=\"".htmlspecialchars($row['value'])."\" style='width:80%'>";
    }
    ?>
</td>
       <td><?php echo $row['varname']?></td>
      </tr>
      <?php
}
?>
     </table>
      <?php
        exit;
    }
    if ($i == 1)
    {
        echo '      <tr align="center" bgcolor="#F9FCEF" height="25">
           <td colspan="3">没有找到搜索的内容</td>
          </tr></table>';
    }
    exit;
}

include DedeInclude('templets/sys_info.htm');