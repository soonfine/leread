<?php
require_once (dirname(__FILE__) . "/../include/dedecollection.class.php");
function clean_cachefiles( $path )
{
	$list = array();
	foreach( glob( $path . '/*') as $item )
	{
		if( is_dir( $item ) )
		{
			$list = array_merge( $list , clean_cachefiles( $item ) );
		}
		else
		{
			$list[] = $item;
		}
	}
	foreach( $list as $tmpfile )
	{
		if($tmpfile!="../data/tplcache/index.html") @unlink( $tmpfile );
	}
	return true;
}

$co = new DedeCollection();
$co->LoadNote($nid);
$orderway = "desc";
$noco=0;
$treid='a';
$treid2='b';
$pretid='c';
$replacearray=array(" ","!","?","��","��","��","(",")","��","��",".",":","��","��","��","��","[","]");
if($channelid==99) $con1=(intval($co_novelcount)==0) ? 0:1;//ÿ�βɼ�С˵��������
elseif($channelid==98) $con1=(intval($co_novelcount)==0) ? 0:2;//ÿ�βɼ�С˵��������(��վ)
else $con1=(intval($co_artcount)==0) ? 0:3;//ÿ�βɼ�С˵�½�����
$con=($con1==0) ? $con1+1:$con1;
//if($channelid>10 && $con1==0 && $cm==1) $co->GetSourceUrl(1,1,50);
$bscon=(intval($co_bscon)>0) ? intval($co_bscon):6;//һ�����������ϲ��ɼ���С˵����
$co_retime=(intval($co_retime)>0) ? intval($co_retime):3;//�������Դ���
for($n=0;$n<$con;$n++)
{
	if($con1>0 || $eorid!=0)
	{
		if($noco==1) break;
		//echo "eorid:".$eorid."-aid:";
		if($eorid!=0)
		{
			$row = $dsql->GetOne("Select * From `#@__co_htmls` where aid=$eorid");
		}
		else
		{
			$row = $dsql->GetOne("Select MAX(aid) AS aid From `#@__co_htmls` where nid=$nid and isdown='0'");
			$raid=$row['aid'];
			$row = $dsql->GetOne("Select * From `#@__co_htmls` where aid='$raid'");
		}
		if(trim($co_nontitle)!="")
			$paichuarray=explode(",",$co_nontitle);//ǰ����������Щ���۵��½����ƶ����˵�
		else
			$paichuarray=array("a");
		if(is_array($row))
		{
			if($lasttag=="LAST")
			{
				$lasttitle=str_replace($replacearray,'',$lasttitle);
				$lastsql="select aid,title from `#@__co_htmls` where nid='$nid' order by aid";
				$dsql->Execute('c2',$lastsql);
				while ($lastidrow=$dsql->getarray('c2'))
				{
					$last_title=str_replace($replacearray,'',$lastidrow['title']);
					$last_aid=$lastidrow['aid'];
					similar_text($last_title,$lasttitle, $similarity_pst); //�Ƚ����ƶ�
					if(stripos("ok".$lasttitle,$last_title)>0 || stripos("ok".$last_title,$lasttitle)>0 || number_format($similarity_pst, 0)>86)
					{
						$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isdown=1,isexport=1 where nid='$nid' and aid>=$last_aid ");
						$dsql->ExecuteNoneQuery("update `#@__co_note` set remark='' where `nid`=$nid ");
						break;
					}
				}
			}
			$a_title=$row['title'];
			$c_title=reveser_c(str_replace($replacearray,'',$row['title']));
			$cc_title=substr($row['title'],0,4);
			$c_typeid=$row['typeid'];
			$aids=$row['aid'];
			//echo $aids."-".$row['title'];
			if($channelid<10)
			{
				if(in_array($cc_title,$paichuarray))
				{
					$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isexport=1,isdown=1 where aid='$aids' ");
					//echo " ��<font color='red'>$a_title-������Ҫ��-2</font>��<br>";
					continue;
				}
				$crow = $dsql->GetOne("Select count(a.id) as dd From `#@__archives` a left join `#@__addonarticle` b on(b.aid=a.id) where REVERSE(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(a.title,' ',''),'!',''),'��',''),'��',''),'?',''),'(',''),')',''),'��',''),'��',''),'��',''),'��',''),'��',''),':',''),'.',''),'[',''),']',''),'��',''),'��','')) like '$c_title%' and a.typeid='$c_typeid' and b.body<>''");
				if($crow['dd']>0)
				{
					$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isexport=1,isdown=1 where aid='$aids' ");
					//echo " ��<font color='red'>�ظ�1-1-$c_typeid</font>��<br>";
					continue;
				}
			}
			else if($channelid==99)
			{
				$crow = $dsql->GetOne("Select * From `#@__arctype`  where typename='$a_title' and reid not in(0,45)");
				if(is_array($crow))
				{
					$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isexport=1,isdown=1 where aid='$aids' ");
					continue;
				}	
			}
			$co->DownUrl($row['aid'],$row['url'],$row['litpic']);
			$row = $dsql->GetOne("Select * From `#@__co_htmls` where aid='$aids'");
			if($row['isdown']=='1' && $row['result']!='')
			{
				//echo "-�ɹ�������ַ����".$row['url'];
				//if($channelid==98) echo "<br />";
			}
			else if($channelid<10)
			{
				$suc="no";
				$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isdown=0,result='' where aid='$aids' ");
				for($m=0;$m<$co_retime;$m++)
				{
					$co->DownUrl($row['aid'],$row['url'],$row['litpic']);
					$row = $dsql->GetOne("Select * From `#@__co_htmls` where aid='$aids'");
					if($row['isdown']=='1' && $row['result']!='')
					{
						$suc="ok";
						//echo "-�ɹ�������ַ����".$row['url'];
						break;
					}
					else
					{
						$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isdown=0,result='' where aid='$aids' ");
						//echo "-��<font color='red'>��ַ����".$row['url']."�ɼ�ʧ�ܣ����²ɼ�</font>��<br>";
					}
				}
				if($suc=="no")
				{				
					if($co_eorctr!='2' && $cotype!='2')//$co_eorctrֵ�Ƿ�����Ĭ��ʱ���ɼ�������Զ�ֹͣ�ɼ�
					{
						if($coretag=="re" && $coretimes==$co_retime)
						{
							$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isdown=0,result='' where aid='$aids' ");
							$dsql->ExecuteNoneQuery("update `#@__co_note` set remark= CONCAT(remark,'���ʴ���ID��','$aids'),typeid='0' where `nid`=$nid ");
							//echo "-��<font color='red'>��ַ����".$row['url']."����".$co_retime."�βɼ�ʧ�ܣ�ȡ��������Ĳɼ�</font>��<br>";	
						}
						else
						{
							
							$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isdown=0,result='' where aid='$aids' ");
							$dsql->ExecuteNoneQuery("update `#@__co_note` set remark= CONCAT('re:','$coretime'),cotime=cotime+3600  where `nid`=$nid ");
							//echo "-��<font color='red'>��ַ����".$row['url']."����".$co_retime."�βɼ�ʧ�ܣ��ȴ�����</font>��<br>";	
						}
						break;
					}
					else
					{
						$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isdown=1,isexport=1 where aid='$aids' ");
						//echo "-��<font color='red'>��ַ����".$row['url']."����".$co_retime."�βɼ�ʧ�ܣ���������ַ�����ɼ�</font>��<br>";
					}
				}
			}
			else
			{
				$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isexport=1,isdown=1 where aid='$aids' ");
				//echo "-��<font color='red'>��ַ����".$row['url']."�ɼ�ʧ��</font>��<br>";
			}
		}
		else
		{
			if($new=="1" && $cotime!=0) $dsql->ExecuteNoneQuery("update `#@__co_note` set new=2 where `nid`=$nid ");
			//echo "û�п�����ַ�ˣ���ץ��ַ<br>";
			$co->GetSourceUrl(1,0,50);
			if($lasttag=="LAST")
			{
				$lasttitle=str_replace($replacearray,'',$lasttitle);
				$lastsql="select aid,title from `#@__co_htmls` where nid='$nid' order by aid";
				$dsql->Execute('c2',$lastsql);
				while ($lastidrow=$dsql->getarray('c2'))
				{
					$last_title=str_replace($replacearray,'',$lastidrow['title']);
					$last_aid=$lastidrow['aid'];
					similar_text($last_title,$lasttitle, $similarity_pst); //�Ƚ����ƶ�
					if(stripos("ok".$lasttitle,$last_title)>0 || stripos("ok".$last_title,$lasttitle)>0 || number_format($similarity_pst, 0)>86)
					{
						$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isdown=1,isexport=1 where nid='$nid' and aid>=$last_aid ");
						$dsql->ExecuteNoneQuery("update `#@__co_note` set remark='' where `nid`=$nid ");
						break;
					}
				}
			}
			$row = $dsql->GetOne("Select MAX(aid) AS aid From `#@__co_htmls` where nid=$nid and isdown='0'");
			$raid=$row['aid'];
			$row = $dsql->GetOne("Select * From `#@__co_htmls` where aid='$raid'");
			if(is_array($row))//����û�ɼ�������
			{
				$a_title=$row['title'];
				$c_title=reveser_c(str_replace($replacearray,'',$row['title']));
				$cc_title=substr($row['title'],0,4);
				$c_typeid=$row['typeid'];
				$aids=$row['aid'];
				//echo $aids."-".$row['title'];
				if($channelid<10)
				{
					if(in_array($cc_title,$paichuarray))
					{
						$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isexport=1,isdown=1 where aid='$aids' ");
						//echo " ��<font color='red'>$a_title-������Ҫ��-2</font>��<br>";
						continue;
					}
					$crow = $dsql->GetOne("Select count(a.id) as dd From `#@__archives` a left join `#@__addonarticle` b on(b.aid=a.id) where REVERSE(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(a.title,' ',''),'!',''),'��',''),'��',''),'?',''),'(',''),')',''),'��',''),'��',''),'��',''),'��',''),'��',''),':',''),'.',''),'[',''),']',''),'��',''),'��','')) like '$c_title%' and a.typeid='$c_typeid' and b.body<>''");
					if($crow['dd']>0)
					{
						$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isexport=1,isdown=1 where aid='$aids' ");
						//echo " ��<font color='red'>�ظ�1-1-$c_typeid</font>��<br>";
						continue;
					}
				}
				else if($channelid==99)
				{
					$crow = $dsql->GetOne("Select * From `#@__arctype`  where typename='$a_title' and reid not in(0,45)");
					if(is_array($crow))
					{
						$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isexport=1,isdown=1 where aid='$aids' ");
						continue;
					}	
				}
				$co->DownUrl($row['aid'],$row['url'],$row['litpic']);
				$row = $dsql->GetOne("Select * From `#@__co_htmls` where aid='$aids'");
				if($row['isdown']=='1' && $row['result']!='')
				{
					//echo "-�ɹ�������ַ����".$row['url'];
					//if($channelid==98) //echo "<br />";
				}
				else if($channelid<10)
				{
					$suc="no";
					$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isdown=0,result='' where aid='$aids' ");
					for($m=0;$m<$co_retime;$m++)
					{
						$co->DownUrl($row['aid'],$row['url'],$row['litpic']);
						$row = $dsql->GetOne("Select * From `#@__co_htmls` where aid='$aids'");
						if($row['isdown']=='1' && $row['result']!='')
						{
							$suc="ok";
							//echo "-�ɹ�������ַ����".$row['url'];
							break;
						}
						else
						{
							$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isdown=0,result='' where aid='$aids' ");
							//echo "-��<font color='red'>��ַ����".$row['url']."�ɼ�ʧ�ܣ����²ɼ�</font>��<br>";
						}
					}
					if($suc=="no")
					{				
						if($co_eorctr!='2' && $cotype!='2')//$co_eorctrֵ�Ƿ�����Ĭ��ʱ���ɼ�������Զ�ֹͣ�ɼ�
						{
							if($coretag=="re" && $coretimes==$co_retime)
							{
								$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isdown=0,result='' where aid='$aids' ");
								$dsql->ExecuteNoneQuery("update `#@__co_note` set remark= CONCAT(remark,'���ʴ���ID��','$aids'),typeid='0' where `nid`=$nid ");
								//echo "-��<font color='red'>��ַ����".$row['url']."����".$co_retime."�βɼ�ʧ�ܣ�ȡ��������Ĳɼ�</font>��<br>";	
							}
							else
							{
								
								$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isdown=0,result='' where aid='$aids' ");
								$dsql->ExecuteNoneQuery("update `#@__co_note` set remark= CONCAT('re:','$coretime'),cotime=cotime+3600  where `nid`=$nid ");
								//echo "-��<font color='red'>��ַ����".$row['url']."����".$co_retime."�βɼ�ʧ�ܣ��ȴ�����</font>��<br>";	
							}
							break;
						}
						else
						{
							$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isdown=1,isexport=1 where aid='$aids' ");
							//echo "-��<font color='red'>��ַ����".$row['url']."����".$co_retime."�βɼ�ʧ�ܣ���������ַ�����ɼ�</font>��<br>";
						}
					}
				}
				else
				{
					$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isexport=1,isdown=1 where aid='$aids' ");
					//echo "-��<font color='red'>��ַ����".$row['url']."����ʧ��</font>��<br>";
				}
			}
			else if($renid1=="1")//û�пɲɼ������ݣ������Ľ����ɼ�
			{
				$dsql->ExecuteNoneQuery("update `#@__co_note` set remark='NULL-END',typeid='0' where `nid`=$nid ");	
				//�����ж��ǲ��ǿ���ɾ���������
				$typeidstart= (strpos($listconfig2,"typeid=>"));
				$typeidend= (strpos($listconfig2,"]{/dede:batchrule}"));
				$overtypeid=substr($listconfig2,$typeidstart+8,$typeidend-$typeidstart-8); 
				if(is_numeric($overtypeid))
				{
					$endid='';
					$endidsql="select id from `#@__archives` where typeid='$overtypeid' order by id desc limit 0,10";
					$dsql->Execute('c1',$endidsql);
					while ($endidrow=$dsql->getarray('c1'))
					{
						$endid .= ($endid=='' ? $endidrow['id'] : ','.$endidrow['id']);//�������10�µ�ID
					}
					$endkey=array("����","ȫ��","���","����","���","�걾","����","ȫ����","ȫ����","����","����","���","β��");
					for($m=0;$m<count($endkey);$m++)
					{
						$endrow = $dsql->GetOne("Select count(id) as dd From `#@__archives` where id in($endid) and title like '%$endkey[$m]%'");
						if($endrow['dd']>0)
						{
							//���걾���۵ľ�ɾ����������
							$dsql->ExecuteNoneQuery("Delete From `#@__co_htmls` where nid=$nid");
							$dsql->ExecuteNoneQuery("Delete From `#@__co_urls` where nid=$nid");
							$dsql->ExecuteNoneQuery("Delete From `#@__co_mediaurls` where nid=$nid");
							$dsql->ExecuteNoneQuery("Delete From `#@__co_note` where nid=$nid");
							$dsql->ExecuteNoneQuery("Delete From `dede_co_listurls` where nid in=$nid");
							//echo "��<font color='red'>�����걾��������ɾ����������</font>��";
							break 2;
						}
					}
				}
				break;
			}
			else //û�пɲɼ�������
			{
				if($channelid==98)
				{
					$noco=1;
				}
				$rowa = $dsql->GetOne("Select * From `#@__co_htmls` where nid=$nid and isdown='1' and isexport='0'");
				if(!is_array($rowa))
				{
					if($channelid>10)
					{
						break;
					}
					elseif($booksum2<$bscon && $renid2!="0" && $nidurl=="")
					{
						if(strstr($notename2,'+')) $nidtype="+";
						else $nidtype="-";
						$bsm=$bscon-$booksum2+1;
						$rowlist=explode($nidtype, $notename2);
						$addnotename=str_replace($rowlist[0],"",$notename2);//Ҫ��ӵĹ�����
						$addco_note=substr($listconfig2,stripos($listconfig2,'[(#)=>'),stripos($listconfig2,'{/dede:batchrule}')-stripos($listconfig2,'[(#)=>')+17);//Ҫ��ӵ��б�Դ��ַ
						
						$row2 =$dsql->getone("SELECT * FROM `#@__co_note` where `renid`='$renid2' and booksum<$bsm and typeid<>'0' and nid<>'$nid' and cotime<>0 and con<5 order by booksum desc");
						if(is_array($row2))
						{
							$addnotename=$row2['notename'].$addnotename;
							$tonid=$row2['nid'];
							$booksum2=$row2['booksum']+$booksum2;
							$updatesql="update `#@__co_note` set `listconfig`=replace(replace(listconfig,'{/dede:batchrule}','".$addco_note."'),'".$row2['notename']."','".$addnotename."'),booksum='$booksum2',notename='$addnotename',typeid='1' where nid='$tonid'";
							if($dsql->ExecuteNoneQuery($updatesql))
							{
								$dsql->ExecuteNoneQuery("Update `#@__co_htmls` set nid='$tonid' where nid='$nid'; ");
								$dsql->ExecuteNoneQuery("Update `#@__co_urls` set nid='$tonid' where nid='$nid'; ");
								$dsql->ExecuteNoneQuery("Update `dede_co_listurls` set nid='$tonid' where nid='$nid'; ");
								$dsql->ExecuteNoneQuery("Update `#@__co_mediaurls` set nid='$tonid' where nid='$nid'; ");
								$dsql->ExecuteNoneQuery("Update `#@__arctype` set copynid='$tonid' where copynid='$nid'; ");
								$dsql->ExecuteNoneQuery("delete from `#@__co_note` where nid='$nid'; ");
							}
						}
					}
					break;
				}
			}
		}
	}
	$row = $dsql->GetOne("Select ct.id,ct.maintable,ct.addtable,ct.fieldset,cn.cotime From `#@__channeltype` ct left join `#@__co_note` cn on cn.channelid = ct.id where cn.nid='$nid' ");
	if(!is_array($row))
	{
		//echo "�Ҳ���Ƶ������ģ����Ϣ���޷���ɲ�����";
		exit();
	}
	$channelid = $row['id'];
	$uptime = $row['cotime'];
	$Maitable  = $row['maintable'];
	$Addtable  = $row['addtable'];
	if(empty($Maitable))
	{
		$Maitable = '#@__archives';
	}
	if(empty($Addtable))
	{
		//echo "�Ҳ�����������Ϣ���޷���ɲ�����";
		exit();
	}
	$IndSqlTemplate = "INSERT INTO `#@__arctiny`(`arcrank`,`typeid`,`channel`,`senddate`,`sortrank`) VALUES ('$arcrank','@typeid@' ,'$channelid','@senddate@', '@sortrank@'); ";
	$MaiSqlTemplate  = "INSERT INTO `$Maitable`(id,typeid,sortrank,flag,ismake,channel,arcrank,click,money,title,shorttitle,color,writer,source,litpic,pubdate,senddate,mid,description,keywords) VALUES ('@aid@','@typeid@','@sortrank@','@flag@','-1','$channelid','$arcrank','@click@','0','@title@','','','@writer@','@source@','@litpic@','@pubdate@','@senddate@','1','@description@','@keywords@'); ";
	$inadd_f = $inadd_v = '';
	$dtp = new DedeTagParse();
	$dtp->SetNameSpace('field','<','>');
	$dtp->LoadString($row['fieldset']);
	foreach($dtp->CTags as $ctag)
	{
		$tname = $ctag->GetTagName();
		$inadd_f .= ",`$tname`";
		$notsend = $ctag->GetAtt('notsend');
		$fieldtype = $ctag->GetAtt('type');
		if($notsend==1)
		{
			if($ctag->GetAtt('default')!='')
			{
				$dfvalue = $ctag->GetAtt('default');
			}
			else if($fieldtype=='int'||$fieldtype=='float'||$fieldtype=='number')
			{
				$dfvalue = '0';
			}
			else if($fieldtype=='dtime')
			{
				$dfvalue = time();
			}
			else
			{
				$dfvalue = '';
			}
			$inadd_v .= ",'$dfvalue'";
		}
		else
		{
			$inadd_v .= ",'@$tname@'";
		}
	}
	$AddSqlTemplate = "INSERT INTO `{$Addtable}`(`aid`,`typeid`{$inadd_f}) Values('@aid@','@typeid@'{$inadd_v})";
	$dtp = new DedeTagParse();
	$dsql->SetQuery("Select * From `#@__co_htmls` where isdown='1' and isexport='0' and nid=$nid ORDER BY aid desc");
	$dsql->Execute();
	while($row = $dsql->GetObject())
	{
		$makeindex='yes';
		$nidd=$row->nid;
		$title = $row->title;
		$exid = $row->aid;
		if($channelid>10)
		{
			$dtp->LoadString($row->result);
			if(!is_array($dtp->CTags)) continue;

			//��ȡʱ��ͱ���
			$title = $row->title;
			$exid = $row->aid;
			$overdate="0";
			$isover="no";
			foreach ($dtp->CTags as $ctag)
			{
				$itemName = $ctag->GetAtt('name');
				if($itemName == 'title' && $usetitle==0)
				{
					$title = trim($ctag->GetInnerText());
					if($title=='')
					{
						$title = $row->title;
					}
				}
				else if($itemName == 'source')
				{
					$source = trim($ctag->GetInnerText());
				}
				else if($itemName == 'writer')
				{
					$writer = trim($ctag->GetInnerText());
				}
				else if($itemName == 'body')
				{
					$body = trim($ctag->GetInnerText());
				}
				else if($itemName == 'bookimg')
				{
					$bookimg = trim($ctag->GetInnerText());
					$bookimg = substr($bookimg,stripos($bookimg,'/uploads'),stripos($bookimg,'{/dede:img}')-stripos($bookimg,'/uploads'));
				}
				else if($itemName == 'pubdate')
				{
					$pubdate = trim($ctag->GetInnerText());
					if($pubdate=="") $pubdate=date("Y-m-d H:i:s",time());
				}
				else if($itemName == 'bookurl')
				{
					$bookurl = trim($ctag->GetInnerText());
				}
				else if($itemName == 'copynid')
				{
					$copynid = trim($ctag->GetInnerText());
				}
				else if($itemName == 'overtag')
				{
					$overtag = trim($ctag->GetInnerText());
					$days=(time()-strtotime($pubdate))/86400;
					if($co_overbooktag!="")
					{
						$co_overbooktag=explode("||",$co_overbooktag);
						if(in_array($overtag,$co_overbooktag) || $days>30)
						{
							$overdate=$pubdate;
							$isover="yes";
						}						
					}
					elseif(in_array($overtag,array("�����","�����","���걾","�����","���","�걾","���","ȫ��","��ȫ��")) || $days>30)
					{
						$overdate=$pubdate;
						$isover="yes";
					}
				}
			}
			if(($title=="" || $writer=="" || $bookurl=="") && ($channelid==98 || ($channelid==99 && $source=="")))
			{
				if($eorid!=$exid)
				{
					$nn=$n;
					$n=$n-$co_retime;
					$eorid=$exid;
					$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isdown=0,result='' where aid='$exid' ");
					break;
				}		
				else if($n==$nn)//����$co_retime������δ�ɹ�����ֹ������Ĳɼ�������������ʾ
				{
					if($co_eorctr!='2' && $cotype!='2')//$co_eorctrֵ�Ƿ�����Ĭ��ʱ���ɼ�������Զ�ֹͣ�ɼ�
					{
						if($coretag=="re" && $coretimes==$co_retime)
						{
							$dsql->ExecuteNoneQuery("Update `#@__co_htmls` set isdown=1,isexport=1 where aid='$exid' ");
							echo "-��<font color='red'>С˵��".$title."������3�ζ��ɼ��������ݣ������ɼ�</font>��<br>";
							continue;
						}
						else
						{
							$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isdown=0,result='' where aid='$exid' ");
							$dsql->ExecuteNoneQuery("update `#@__co_note` set remark= CONCAT('re:','$coretime') where `nid`=$nid ");
							echo "-��<font color='red'>С˵��".$title."������3�ζ��ɼ��������ݣ��ȴ�����</font>��<br>";	
						}
						break 2;
					}
					else
					{
						$eorid=0;
					}
				}
				else
				{
					$dsql->ExecuteNoneQuery("Update `#@__co_htmls` set isdown=0,isexport=0,result='' where aid='$exid' ");
					echo "-��<font color='red'>С˵��".$title."�������ǿյģ����²ɼ�</font>��<br>";
					break;
				}
			}
			if($nn>0)
			{
				$n=$nn;
				$nn=0;
			}
			if($channelid==98)
			{
				$renidarray=array("133-1","133-2");
				$testrow = $dsql->GetOne("SELECT a.id,b.notename,b.listconfig,b.booksum,b.nid,b.renid,b.typeid FROM `#@__arctype` a left join `#@__co_note` b ON(b.nid=a.copynid) WHERE a.typename='$title' and a.zuozhe='$writer' and ((a.lastupdate+86400)<UNIX_TIMESTAMP() or a.booksize>200000 or b.typeid=3) and b.renid not like '$copynid-%'");
				if(is_array($testrow))
				{
					$bookid = $testrow['id'];
					$oldnotename = addslashes($testrow['notename']);
					$oldlistconfig = addslashes($testrow['listconfig']);
					$oldbooksum = $testrow['booksum'];
					$oldnid = $testrow['nid'];
					$oldrenid = $testrow['renid'];
					$oldtype=$testrow['typeid'];
					if(in_array($oldrenid,$renidarray) || $oldtype=='3')//ԭ���Ĳɼ��������������滻
					{
						$row = $dsql->GetOne("Select * From `#@__co_note` where nid='$copynid'");
						if($row)
						{
							foreach($row as $k=>$v)
							{
								$$k = addslashes($v);
							}
							$itemconfig=addslashes($row['itemconfig']);
							$usemore = (empty($usemore) ? '0' : $usemore);
							//���ұ������ڵ����һ��
							$lastaidrow = $dsql->GetOne("SELECT title FROM `dede_archives` WHERE id=(SELECT MAX(id) AS id FROM `dede_archives` WHERE typeid='$bookid')");
							$lasttitle="LAST:".$lastaidrow['title'];
							//�Ѿ��걾��
							if($isover=="yes")
							{
								$renid=$copynid."-1";
								$notename=str_replace("�½ڲɼ�ģ�棨��Ҫɾ����","",$row['notename'])."-".$title;
								$listconfig=addslashes($row['listconfig']);
								$co_note="{dede:batchrule}[(#)=>".$bookurl."; (*)=>1-1; typeid=>".$bookid."]{/dede:batchrule}";
								$listconfig = str_replace($row['notename'],$notename,str_replace(substr($listconfig,stripos($listconfig,'{dede:batchrule}'),stripos($listconfig,'{/dede:batchrule}')-stripos($listconfig,'{dede:batchrule}')+17),$co_note,$listconfig));
								$cosql = " INSERT INTO `#@__co_note`(`channelid`,`notename`,`sourcelang`,`uptime`,`cotime`,`pnum`,`isok`,`listconfig`,`itemconfig`,`usemore`,booksum,renid,typeid,remark)
								   VALUES ('1','$notename','$sourcelang','".time()."','0','0','1','$listconfig','$itemconfig','1','1','$renid','1','$lasttitle'); ";
							}
							else
							{
								$renid=$copynid."-2";
								$notename=str_replace("�½ڲɼ�ģ�棨��Ҫɾ����","",$row['notename'])."+".$title;
								$listconfig=addslashes($row['listconfig']);
								$co_note="{dede:batchrule}[(#)=>".$bookurl."; (*)=>1-1; typeid=>".$bookid."]{/dede:batchrule}";
								$listconfig = str_replace($row['notename'],$notename,str_replace(substr($listconfig,stripos($listconfig,'{dede:batchrule}'),stripos($listconfig,'{/dede:batchrule}')-stripos($listconfig,'{dede:batchrule}')+17),$co_note,$listconfig));
								$cosql = " INSERT INTO `#@__co_note`(`channelid`,`notename`,`sourcelang`,`uptime`,`cotime`,`pnum`,`isok`,`listconfig`,`itemconfig`,`usemore`,booksum,renid,typeid,remark)
								   VALUES ('1','$notename','$sourcelang','".time()."','0','0','1','$listconfig','$itemconfig','1','1','$renid','1','$lasttitle'); ";
							}
							$dsql->ExecuteNoneQuery($cosql);
							$cnid = $dsql->GetLastID();
							$dsql->ExecuteNoneQuery("update `#@__arctype` set copynid='$cnid' where id=$bookid");
							//ɾ��ԭ���Ĺ���
							if($oldbooksum>1)
							{
								$replacetname="+".$title;
								$newbooksum=$oldbooksum-1;
								$newnotename=str_replace($replacetname,"",$oldnotename);
								$newlistconfig=str_replace($replacetname,"",preg_replace('/\[\(#\)=>http:\/\/readbook.qidian.com\/bookreader\/[0-9]+\.html; \(\*\)=>1-1; typeid=>'.$bookid.'\]/i', '', $testrow['listconfig']));
								$dsql->ExecuteNoneQuery("update `#@__co_note` set notename='$newnotename',listconfig='$newlistconfig',booksum=$newbooksum where nid=$oldnid ");
								$dsql->ExecuteNoneQuery("Delete From `#@__co_htmls` where nid=$oldnid and typeid=$bookid");
							}
							else
							{
								$dsql->ExecuteNoneQuery("Delete From `#@__co_htmls` where nid=$oldnid");
								$dsql->ExecuteNoneQuery("Delete From `#@__co_urls` where nid=$oldnid");
								$dsql->ExecuteNoneQuery("Delete From `#@__co_mediaurls` where nid=$oldnid");
								$dsql->ExecuteNoneQuery("Delete From `#@__co_note` where nid=$oldnid");
								$dsql->ExecuteNoneQuery("Delete From `dede_co_listurls` where nid in=$oldnid");
							}
							//echo $title."-�����滻�ɹ�<br />";
						}
						else
						{
							$dsql->ExecuteNoneQuery("update `#@__co_note` set remark='eor:�½ڲɼ�ģ��ID���ò���ȷ',typeid='0' where `nid`=$nidd ");
							break 2;//�½ڹ��򲻴��ڣ��������βɼ�
						}
					}
					$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isexport=1 where aid='$exid' ");
				}
				continue;
			}

			//����ظ�С˵
			$testrow = $dsql->GetOne("SELECT COUNT(ID) AS dd FROM `#@__arctype` WHERE typename='$title' and zuozhe='$writer'");
			if($testrow['dd']>0)
			{
				$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isexport=1 where aid='$exid' ");
				//echo " ��<font color='red'>С˵�Ѵ���</font>��<br>";
				continue;
			}
			$reidrow = $dsql->GetOne("SELECT * FROM `#@__arctype` WHERE reid=0 and content like '%$source%'");
			if(is_array($reidrow))
			{
				$retypeid=$reidrow['id'];
				$retypedir=$reidrow['typedir'];//С˵�����dir
			}
			else
			{
				$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isexport=1 where aid='$exid' ");
				continue;
			}
			
			$typepinyin = GetPinyin(stripslashes($title));
			$typepinyin = preg_replace("#\/{1,}#", "/", $typepinyin);
			//����Ƿ���������С˵Ŀ¼���������Ŀ¼ƴ�����Զ������������
			$typedirrow = $dsql->GetOne("SELECT `typedir` FROM `#@__arctype` WHERE `typedir`='/$typepinyin'");
			if($typedirrow)
			{
				for($ti=1;$ti<100;$ti++)
				{
					$typedirsql="SELECT `typedir` FROM `#@__arctype` WHERE `typedir`='/".$typepinyin.$ti."'";
					$typedirrow = $dsql->GetOne($typedirsql);
					if(!$typedirrow)
					{
						$typepinyin = $typepinyin.$ti;
						break;
					}
				}
			}
			$typedir="/".$typepinyin;
			$addSqlType = "insert into `dede_arctype` (`reid`, `topid`, `sortrank`, `typename`, `typedir`, `isdefault`, `defaultname`, `issend`, `channeltype`, `maxpage`, `ispart`, `corank`, `tempindex`, `templist`, `temparticle`, `namerule`, `namerule2`, `modname`, `keywords`, `seotitle`, `moresite`, `sitepath`, `siteurl`, `ishidden`, `cross`, `crossid`, `content`, `smalltypes`, `bookclick`, `zuozhe`, `startdate`, `overdate`, `booksize`, `downloadurl`,`description`,`typeimg`) values('$retypeid','$retypeid','50','$title ','$typedir','-1','index.html','1','1','-1','0','0','{style}/catalog.htm','{style}/page.htm','{style}/article.htm','{typedir}/{aid}.html','/html{typedir}.html','default','','','0','$retypedir','','0','0','','','','0','$writer','0','$overdate','0','','$body','$bookimg')";
			if(!$dsql->ExecuteNoneQuery($addSqlType))
			{
				$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isexport=1 where aid='$exid' ");
				continue;
			}
			$bookid = $dsql->GetLastID();
			//���С˵URL��ʽ
			if($bookrule != '' && $bookrule!="[ƴ��]" )
			{
				$pydir=GetPinyin(stripslashes($title),1);
				$typedir=str_replace('[ƴ������ĸ]',$pydir,str_replace('[ID]',$bookid,str_replace('[ƴ��]',$typepinyin,$bookrule)));
				$typedir = preg_replace("#\/{1,}#", "/", $typedir);
				//����Ƿ���������С˵Ŀ¼���������Ŀ¼ƴ�����Զ������������
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
				$dsql->ExecuteNoneQuery("UPDATE `#@__arctype` SET `typedir`='$typedir' WHERE id='$bookid' ");
			}
						
			//����С˵�½ڲɼ�����
			$row = $dsql->GetOne("Select * From `#@__co_note` where nid='$copynid'");
			if($row)
			{
				foreach($row as $k=>$v)
				{
					if(!isset($$k))
					{
						$$k = addslashes($v);
					}
				}
				$itemconfig=addslashes($row['itemconfig']);
				$listconfig=addslashes($row['listconfig']);
				$usemore = (empty($usemore) ? '0' : $usemore);
				//�Ѿ��걾��
				if($isover=="yes")
				{
					$renid=$copynid."-1";
					$notename=str_replace("�½ڲɼ�ģ�棨��Ҫɾ����","",$row['notename'])."-".$title;					
					$co_note="{dede:batchrule}[(#)=>".$bookurl."; (*)=>1-1; typeid=>".$bookid."]{/dede:batchrule}";
					$listconfig = str_replace($row['notename'],$notename,str_replace(substr($listconfig,stripos($listconfig,'{dede:batchrule}'),stripos($listconfig,'{/dede:batchrule}')-stripos($listconfig,'{dede:batchrule}')+17),$co_note,$listconfig));
					$cosql = " INSERT INTO `#@__co_note`(`channelid`,`notename`,`sourcelang`,`uptime`,`cotime`,`pnum`,`isok`,`listconfig`,`itemconfig`,`usemore`,booksum,renid,typeid)
					   VALUES ('1','$notename','$sourcelang','".time()."','0','0','1','$listconfig','$itemconfig','1','1','$renid','1'); ";
				}
				else
				{
					$renid=$copynid."-2";
					$notename=str_replace("�½ڲɼ�ģ�棨��Ҫɾ����","",$row['notename'])."+".$title;
					$co_note="{dede:batchrule}[(#)=>".$bookurl."; (*)=>1-1; typeid=>".$bookid."]{/dede:batchrule}";
					$listconfig = str_replace($row['notename'],$notename,str_replace(substr($listconfig,stripos($listconfig,'{dede:batchrule}'),stripos($listconfig,'{/dede:batchrule}')-stripos($listconfig,'{dede:batchrule}')+17),$co_note,$listconfig));
					$cosql = " INSERT INTO `#@__co_note`(`channelid`,`notename`,`sourcelang`,`uptime`,`cotime`,`pnum`,`isok`,`listconfig`,`itemconfig`,`usemore`,booksum,renid,typeid)
					   VALUES ('1','$notename','$sourcelang','".time()."','0','0','1','$listconfig','$itemconfig','1','1','$renid','1'); ";
				}
				$dsql->ExecuteNoneQuery($cosql);
				$cnid = $dsql->GetLastID();
				$dsql->ExecuteNoneQuery("update `#@__arctype` set copynid='$cnid' where id='".$bookid."' ");
			}
			else
			{
				$dsql->ExecuteNoneQuery("Delete From `#@__arctype` where id='".$bookid."'");
				$dsql->ExecuteNoneQuery("update `#@__co_note` set remark='eor:�½ڲɼ�ģ��ID���ò���ȷ',typeid='0' where `nid`=$nidd ");
				exit();
			}
			
			//������С˵Ŀ¼ʱ���û�ж�Ӧ��������Ʒ�������Զ�����һ��������reid��topidҪ����ʵ������趨��Ŀǰ����45
			$row = $dsql->GetOne("SELECT `typedir` FROM `#@__arctype` WHERE reid=45 and `typename`='$writer'");
			if(!$row)
			{
				$zuozhedir = GetPinyin(stripslashes($writer));
				$zuozhedir = "/".$zuozhedir;
				$zuozhedir = preg_replace("#\/{1,}#", "/", $zuozhedir);
				$row = $dsql->GetOne("SELECT `typedir` FROM `#@__arctype` WHERE `typedir`='$zuozhedir'");
				if($row)
				{
					for($ti=1;$ti<100;$ti++)
					{
						$tsql="SELECT `typedir` FROM `#@__arctype` WHERE `typedir`='".$zuozhedir.$ti."'";
						$row = $dsql->GetOne($tsql);
						if(!$row)
						{
							$zuozhedir = $zuozhedir.$ti;
							break;
						}
					}
				}
				$zuozhe_in_query = "insert into `#@__arctype` (`reid`, `topid`, `sortrank`, `typename`, `typedir`, `isdefault`, `defaultname`, `issend`, `channeltype`, `maxpage`, `ispart`, `corank`, `tempindex`, `templist`, `temparticle`, `namerule`, `namerule2`, `modname`, `description`, `keywords`, `seotitle`, `moresite`, `sitepath`, `siteurl`, `ishidden`, `cross`, `crossid`, `content`, `smalltypes`, `bookclick`, `typeimg`, `zuozhe`, `startdate`, `overdate`, `booksize`, `downloadurl`) values('45','45','50','$writer','$zuozhedir','-1','index.html','0','1','-1','1','0','{style}/catalog45.htm','{style}/page45.htm','{style}/article.htm','{typedir}/{Y}/{M}{D}/{aid}.html','/html{typedir}.html','default','�������������".$writer."��С˵��Ʒ����������Ķ��Ĺ����з������ǵ�ת�������⣬�뼰ʱ��������ϵ���ر����ѵ��ǣ�С˵��Ʒһ�㶼�Ǹ�������д����ʱ��˼����ʽ��������ģ�������鹹�ĳɷݱȽ϶࣬����ģ�£�','','','0','/zuopinji','','1','0','','�������������".$writer."��С˵��Ʒ����������Ķ��Ĺ����з������ǵ�ת�������⣬�뼰ʱ��������ϵ���ر����ѵ��ǣ�С˵��Ʒһ�㶼�Ǹ�������д����ʱ��˼����ʽ��������ģ�������鹹�ĳɷݱȽ϶࣬����ģ�£�','','0','/images/jipin-default.jpg','','','0','0','')";
				$dsql->ExecuteNoneQuery($zuozhe_in_query);
				$zuozheid = $dsql->GetLastID();
				//�������URL��ʽ
				if($zuozherule != '' && $zuozherule!="[ƴ��]" )
				{
					$pinyindir=substr($zuozhedir,1);
					$pydir=GetPinyin(stripslashes($writer),1);
					$zuozhedir=str_replace('[ƴ������ĸ]',$pydir,str_replace('[ID]',$zuozheid,str_replace('[ƴ��]',$pinyindir,$zuozherule)));
					$zuozhedir = preg_replace("#\/{1,}#", "/", $zuozhedir);
					//����Ƿ���������Ŀ¼������о�������Զ������������
					$typedirrow = $dsql->GetOne("SELECT `typedir` FROM `#@__arctype` WHERE `typedir`='/$zuozhedir'");
					if($typedirrow)
					{
						for($ti=1;$ti<100;$ti++)
						{
							$typedirsql="SELECT `typedir` FROM `#@__arctype` WHERE `typedir`='/".$zuozhedir.$ti."'";
							$typedirrow = $dsql->GetOne($typedirsql);
							if(!$typedirrow)
							{
								$zuozhedir = $zuozhedir.$ti;
								break;
							}
						}
					}
					$zuozhedir="/".$zuozhedir;
					$dsql->ExecuteNoneQuery("UPDATE `#@__arctype` SET `typedir`='$zuozhedir' WHERE id='$zuozheid' ");
				}
				//�����߲����ĵ��ؼ�����
				$zuozheurl = $zuozhedir.".html";
				if($co_autokeytype==1 || $co_autokeytype=3)
				{
					$row = $dsql->GetOne("SELECT `keyword` FROM `#@__keywords` WHERE `keyword`='$writer'");
					if(!$row && strlen($writer)>2)
					{
						$dsql->ExecuteNoneQuery("insert into `#@__keywords` (`keyword`, `rank`, `sta`, `rpurl`) values('$writer','30','1','$zuozheurl')");
					}
				}
			}
			//��С˵�����ĵ��ؼ�����
			if($co_autokeytype==2 || $co_autokeytype=3)
			{
				$row = $dsql->GetOne("SELECT `keyword` FROM `#@__keywords` WHERE `keyword`='$title'");
				if(!$row && strlen($title)>2)
				{
					$typeurl=$typedir."/";
					$dsql->ExecuteNoneQuery("insert into `#@__keywords` (`keyword`, `rank`, `sta`, `rpurl`) values('$title','30','1','$typeurl')");
				}
			}
			$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isexport=1 where aid='$exid' ");
			$dsql->ExecuteNoneQuery("update `#@__co_note` set remark='' where nid='$nid' ");
		}
		else
		{
			$clickstart=mt_rand(1,intval($co_addread));//����������
			$booktuijian=mt_rand(0,intval($co_addpraise));//�Ƽ��������
			$gett=0;
			$body="";
			$typeid = $row->typeid != 0 ? $row->typeid : $typeid;
			$IndSql = str_replace('@typeid@',$typeid,$IndSqlTemplate);
			$MaiSql = str_replace('@typeid@',$typeid,$MaiSqlTemplate);
			$MaiSql = str_replace('@click@',$clickstart,$MaiSql);
			if($channelid!=1)
				$AddSql = str_replace('@typeid@',$typeid,$AddSql);
			else
				$AddSql = "INSERT INTO `#@__addonarticle`(`aid`,`typeid`,`body`) Values('@aid@',$typeid,'@body@')";
			$dtp->LoadString($row->result);
			$exid = $row->aid;
			if(!is_array($dtp->CTags)) continue;
			$pubdate = $sortrank = time();
			$title = $row->title;
			$litpic = '';
			foreach ($dtp->CTags as $ctag)
			{
				$itemName = $ctag->GetAtt('name');
				if($itemName == 'title')
				{
					$title = trim($ctag->GetInnerText());
					if($title=='') $title = $row->title;
				}
				else if($itemName == 'pubdate')
				{
					$pubdate = trim($ctag->GetInnerText());
					if(ereg("[^0-9]",$pubdate))
					{
						$pubdate = $sortrank = GetMkTime($pubdate);
						$gett=1;
					}
					else
					{
						$pubdate = $sortrank = time();
					}
				}
				else if($itemName == 'bookimg')
				{
					$bookimg = trim($ctag->GetInnerText());
					$bookimg = substr($bookimg,stripos($bookimg,'/uploads'),stripos($bookimg,'{/dede:img}')-stripos($bookimg,'/uploads'));
				}
				else if($itemName == 'litpic')
				{
					$litpic = trim($ctag->GetInnerText());
				}
				else if($itemName == 'body')
				{
					$body = trim($ctag->GetInnerText());
					$body = mb_decode_numericentity($body,array(0,0xffffff,0,0xffffff),'GBK');
					$body = str_replace('&amp;nbsp;','',$body);
				}
			}
			
			if($body=="" || strlen($body)-mb_strlen($body,'UTF8')<1)
			{
				if($eorid!=$exid)
				{
					$n=0;
					$eorid=$exid;
					$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isdown=0,result='' where aid='$exid' ");
					break;
				}		
				else if($n==$co_retime)//����$co_retime������δ�ɹ�����ֹ������Ĳɼ�������������ʾ
				{
					if($co_eorctr!='2' && $cotype!='2')//$co_eorctrֵ�Ƿ�����Ĭ��ʱ���ɼ�������Զ�ֹͣ�ɼ�
					{
						if($coretag=="re" && $coretimes==$co_retime)
						{
							$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isdown=0,result='' where aid='$exid' ");
							$dsql->ExecuteNoneQuery("update `#@__co_note` set remark= CONCAT(remark,'����Ϊ��ID��','$exid'),typeid='0' where `nid`=$nid ");
							//echo "-��<font color='red'>�½ڡ�".$title."������3�ζ��ɼ��������ݣ�ȡ��������Ĳɼ�</font>��<br>";
						}
						else
						{
							$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isdown=0,result='' where aid='$exid' ");
							$dsql->ExecuteNoneQuery("update `#@__co_note` set remark= CONCAT('re:','$coretime'),cotime=cotime+3600 where `nid`=$nid ");
							//echo "-��<font color='red'>�½ڡ�".$title."������3�ζ��ɼ��������ݣ��ȴ�����</font>��<br>";	
						}
						$treid2='b';
						break 2;
					}
					else
					{
						$eorid=0;
					}
				}
				else
				{
					$dsql->ExecuteNoneQuery("Update `#@__co_htmls` set isdown=0,isexport=0,result='' where aid='$exid' ");
					//echo "-��<font color='red'>�½ڡ�".$title."�������ǿյģ����²ɼ�</font>��<br>";
					break;
				}
			}
			
			$title = addslashes($title);
			$title1=str_replace($replacearray,'',reveser_c($title));
			if($only)
			{
				$testrow = $dsql->GetOne("Select a.id,b.body From `#@__archives` a left join `#@__addonarticle` b on(b.aid=a.id) where REVERSE(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(a.title,' ',''),'!',''),'��',''),'��',''),'?',''),'(',''),')',''),'��',''),'��',''),'��',''),'��',''),'��',''),':',''),'.',''),'[',''),']',''),'��',''),'��','')) like '$title1%' and a.typeid='$typeid'");
				if(is_array($testrow))
				{
					$taid=$testrow['id'];
					$tbody=$testrow['body'];
					if($tbody!="")
					{
						$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isexport=1 where aid='$exid' ");
						//echo " ��<font color='red'>�ظ�2</font>��<br>";
						continue;
					}
					else
					{
						$dsql->ExecuteNoneQuery("update `#@__addonarticle` set body='$body' where aid='$taid' ");
						$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isexport=1 where aid='$exid' ");
						//echo " ��<font color='green'>�Ѹ���</font>��<br>";
						continue;
					}
				}
			}
			$senddate = time();
			$flag = '';
			$IndSql = str_replace('@senddate@',$senddate,$IndSql);
			$IndSql = str_replace('@sortrank@',$sortrank,$IndSql);
			$MaiSql = str_replace('@flag@',$flag,$MaiSql);
			$MaiSql = str_replace('@sortrank@',$sortrank,$MaiSql);
			$MaiSql = str_replace('@pubdate@',$pubdate,$MaiSql);
			$MaiSql = str_replace('@senddate@',$senddate,$MaiSql);
			$MaiSql = str_replace('@title@',cn_substr($title, 100),$MaiSql);
			$AddSql = str_replace('@body@',$body,$AddSql);
			foreach($dtp->CTags as $ctag)
			{
				
				if($ctag->GetName()!='field') continue;
				$itemname = $ctag->GetAtt('name');
				$itemvalue = addslashes(trim($ctag->GetInnerText()));
				$MaiSql = str_replace("@$itemname@",$itemvalue,$MaiSql);
				if($co_nontext!="")
				{
					$co_nontext=explode("\r\n",$co_nontext);//��̨���õ��滻��Ϊһ��һ��������Ҫ��˫���ţ������Ų�������
					$AddSql = str_replace($co_nontext,"",str_replace("@$itemname@",$itemvalue,$AddSql));
				}
				else
					$AddSql = str_replace("@$itemname@",$itemvalue,$AddSql);
			}
			if($dsql->ExecuteNoneQuery($IndSql))
			{
				$aid = $dsql->GetLastID();
				$MaiSql= str_replace('@aid@',$aid,$MaiSql);
				$AddSql = str_replace('@aid@',$aid,$AddSql);
				$MaiSql= ereg_replace('@([a-z0-9]{1,})@','',$MaiSql);
				$AddSql = ereg_replace('@([a-z0-9]{1,})@','',$AddSql);
				if(!$dsql->ExecuteNoneQuery($MaiSql))
				{
					$dsql->ExecuteNoneQuery("Delete From `#@__arctiny` where id='$aid' ");
				}
				else
				{
					if(!$dsql->ExecuteNoneQuery($AddSql))
					{
						$dsql->ExecuteNoneQuery("Delete From `#@__arctiny` where id='$aid' ");
						$dsql->ExecuteNoneQuery("Delete From `$Maitable` where id='$aid' ");
					}
					else
					{
						/* $row =$dsql->getone( "select id as aid,arcrank,typeid,description,keywords from `#@__archives` where id=$aid");
						if($row)//�Զ��������µ�ժҪ�͹ؼ���
						{
							$aid = $row['aid'];
							$typeid = $row['typeid'];
							$arcrank = $row['arcrank'];
							$row['keywords'] = trim($row['keywords']);
							$row['description'] = trim($row['description']);
							if(strlen($row['description'])<3)
							{
								$arcrow= $dsql->getone("Select  body From {$Addtable}  where aid={$aid}");
								if($arcrow)
								{
									$body = $arcrow['body'];
									$bodytext = preg_replace("/#p#|#e#|������|��ҳ����/isU","",Html2Text($body));
									if(strlen($bodytext) > 1)
									{
										$des = trim(addslashes(cn_substr($bodytext,240)));
										if(strlen($des)<3)
										{
											$des = "-";
										}
										$dsql->ExecuteNoneQuery("Update #@__archives set description='{$des}' where id='{$aid}';");
									}
								}
							}
							if($row['keywords']!='' && !ereg(',',$row['keywords']))
							{
								$keyarr = explode(' ', $row['keywords']);
							}
							else
							{
								$keyarr = explode(',', $row['keywords']);
							}
							foreach($keyarr as $keyword)
							{
								$keyword = trim($keyword);
								if($keyword != '' && strlen($keyword)<13 )
								{
									$keyword = addslashes($keyword);
									$row = $dsql->getone("select id from `#@__tagindex` where tag='$keyword'");
									if(is_array($row))
									{
										$tid = $row['id'];
										$query = "update `#@__tagindex` set `total`=`total`+1 where id='$tid' ";
										$dsql->ExecuteNoneQuery($query);
									}
									else
									{
										$query = " Insert Into `#@__tagindex`(`tag`,`count`,`total`,`weekcc`,`monthcc`,`weekup`,`monthup`,`addtime`) values('$keyword','0','1','0','0','$timestamp','$timestamp','$timestamp');";
										$dsql->ExecuteNoneQuery($query);
										$tid = $dsql->GetLastID();
									}
									$query = "replace into `#@__taglist`(`tid`,`aid`,`typeid`,`arcrank`,`tag`) values ('$tid', '$aid', '$typeid','$arcrank','$keyword'); ";
									$dsql->ExecuteNoneQuery($query);
								}
							}
						} */
						if($make)
						{
							require_once(DEDEINC."/arc.archives.class.php");
							$ac=new Archives($aid);
							$rurl=$ac->MakeHtml();
							$ac->Close();
							$ac=new Archives($aid-1);
							$rurl=$ac->MakeHtml();
							$ac->Close();
							$dsql->ExecuteNoneQuery("Update `#@__co_note` set cotime='".time()."' where nid='$nid'; ");
						}
						
						//���µ������½�
						$row = $dsql->GetOne("SELECT a.id,a.title,a.click,a.typeid,b.body,c.typename,c.zuozhe,c.bookclick,c.bookclickm,c.bookclickw,c.tuijian,c.tuijianm,c.tuijianw,c.booksize,c.lastclick,c.lasttuijian,c.startdate,c.reid,d.typename as retypename FROM `$Maitable` a left join `{$Addtable}` b on(a.id=b.aid) left join `#@__arctype` c on(a.typeid=c.id) left join `#@__arctype` d on(c.reid=d.id) WHERE a.id='$aid'");
						if($row)
						{
							$txt_filename=$row['zuozhe']."-".$row['typename'];
							$typename=$row['typename'];
							$txt_comtens="";
							$startdatesql="";
							$txt_title=$row['title'];
							$treid=$row['reid'];
							$tretypename=$row['retypename'];
							$updatetime=time();
							$lastclick=$row['lastclick'];
							$lasttuijian=$row['lasttuijian'];
							if(intval($cfg_weekstart)!='2') $beginweek=mktime(0,0,0,date('m'),date('d')-date('w'),date('Y'));//���ܿ�ʼʱ���,������~������Ϊһ�ܡ�
							else $beginweek=mktime(0,0,0,date('m'),date('d')-date('w')+1,date('Y'));//���ܿ�ʼʱ���,����һ~������Ϊһ�ܡ�
							$beginmonth=mktime(0,0,0,date('m'),1,date('Y'));//���¿�ʼʱ���
							$txt_body=$txt_title."\r\n".$row['body'];
							$txt_click=$row['click']+$row['bookclick'];
							$tuijian=$booktuijian+$row['tuijian'];
							$clickrow=$dsql->GetOne("SELECT MAX(lastclick) as lastclick FROM `#@__arctype` WHERE reid NOT IN (0,45)");
							$lastclickall=$clickrow['lastclick'];
							if($beginmonth<=$lastclick)//�ж��Ƿ�ͬһ����
								$txt_clickm=$row['click']+$row['bookclickm'];//�µ��
							else
							{
								$txt_clickm=$row['click'];
								if($row['bookclickm']!=0 && $beginmonth>$lastclickall)
									$dsql->ExecuteNoneQuery("UPDATE `#@__arctype` SET bookclickm='0',tuijianm='0',lastclick=$beginmonth ");
							}
							if($beginweek<=$lastclick)//�ж��Ƿ�ͬһ��
								$txt_clickw=$row['click']+$row['bookclickw'];//�ܵ��
							else
							{
								$txt_clickw=$row['click'];
								if($row['bookclickw']!=0 && $beginmonth>$lastclickall)
									$dsql->ExecuteNoneQuery("UPDATE `#@__arctype` SET bookclickw='0',tuijianw='0',lastclick=$beginweek ");
							}
								
							if($beginmonth<=$lasttuijian)//�ж��Ƿ�ͬһ����
								$tuijianm=$booktuijian+$row['tuijianm'];//���Ƽ�
							else
								$tuijianm=$booktuijian;
								
							if($beginweek<=$lasttuijian)//�ж��Ƿ�ͬһ��
								$tuijianw=$booktuijian+$row['tuijianw'];//���Ƽ�
							else
								$tuijianw=$booktuijian;
								
							if($gett==1&&$row['booksize']=='0'&&$row['startdate']=='0')
							{
								$startdate=date("Y-m-d",$pubdate);
								$startdatesql=",startdate='".$startdate."'";
							}
							$a=array('��','��','��','��','�C','��',' ','��','��','��','��','|','��','��','��','��','��','��','2','3','1','�','��','��','"','&','<','>','��','��','<','>','��','��','��','��','-','��','��','��','��','��');
							$b=array('&lsquo;','&rsquo;','&ldquo;','&rdquo;','&ndash;','&mdash;','&nbsp;','&cent;','&pound;','&curren;','&yen;','&brvbar;','&sect;','&copy;','&raquo;','&laquo;','&deg;','&plusmn;','&sup2;','&sup3;','&sup1;','&euro;','&times;','&divide;','&quot;','&amp;','&lt;','&gt;','&hellip;','&permil;','&lsaquo;','&rsaquo;','&larr;','&uarr;','&rarr;','&darr;','&minus;','&radic;','&infin;','&ne;','&le;','&ge;');
							$txt_body=str_replace($b,$a,str_replace("<br />","\r\n",str_replace("<br>","\r\n",trim($txt_body))));
							$txt_body=str_replace("<p>","\r\n",str_replace("</p>","\r\n",trim($txt_body)));
							$txt_body=str_replace("\r\n\r\n","\r\n",str_replace("\r\n\r\n\r\n","\r\n",str_replace("\r\n\r\n\r\n\r\n","\r\n",$txt_body)));
							$acrlen=round(strlen($txt_body)/2.05);
							$booksize=$acrlen+$row['booksize'];							
							if(floor($row['booksize']/$co_addtxtpsize)<floor($booksize/$co_addtxtpsize) || $row['booksize']=='0')
							{
								$txt_comtens=str_replace("http://","",str_replace(array("[��վ����]","[վ�����ַ]"),array($cfg_webname,$cfg_basehost),$co_addtxttext))."\r\n\r\n";
							}
							$dsql->ExecuteNoneQuery("UPDATE `#@__arctype` SET bookclick='$txt_click',bookclickm='$txt_clickm',bookclickw='$txt_clickw',tuijian='$tuijian',tuijianm='$tuijianm',tuijianw='$tuijianw',booksize='$booksize',lastupdate='$updatetime',lastclick='$updatetime',lasttuijian='$updatetime'$startdatesql WHERE id='$typeid' ");
							$txt_comtens.=$txt_body."\r\n"."\r\n";
							if($co_autotxt!='2' && $channelid==1)
							{
								$file = fopen("$txt_filename.txt","ab");
								fwrite($file,$txt_comtens);
								fclose($file);
							}
							
							//����С˵����id
							$startrow = $dsql->GetOne("SELECT COUNT(id) as dd FROM `#@__archives` WHERE typeid='$typeid' ");
							if($startrow['dd']=='1')
							{
								$dsql->ExecuteNoneQuery("UPDATE `#@__arctype` SET startaid='$aid',bookclick='".$row['click']."',bookclickm='".$row['click']."',bookclickw='".$row['click']."',tuijian='$booktuijian',tuijianm='$booktuijian',tuijianw='$booktuijian',booksize='$acrlen',lastupdate='$updatetime',lastclick='$updatetime',lasttuijian='$updatetime',downloadurl='/download/".$txt_filename.".txt' WHERE id='$typeid' ");
							}
							if($pretid!=$typeid && $pretid!='c')//ֻ�е��ɼ��������������½ڲ���ͬһ�����ʱ�򣬲Ÿ�����һ���飬�ɼ�����ʱ�������һ����
							{
								$tid=$pretid;
								include_once(DEDEINC."/arc.listview.class.php");
								//echo '<br/>��ʼ���¡�'.$ptypename.'��-ID��'.$pretid;
								$lv = new ListView($tid);
								$reurl = $lv->MakeHtml();
								$lv->Close();
								if($treid2!=$treid && $treid2!='b')//ֻ�е��ɼ��������������½ڲ���ͬһ�������ʱ�򣬲Ÿ�����һ�����࣬�ɼ�����ʱ���һ������
								{
									$tid=$treid2;
									$lv = new ListView($tid);
									$reurl = $lv->MakeHtml();
									$lv->Close();
									//echo '�����·��ࣺ'.$tretypename2;
								}
								//echo '-�ɹ�';
							}
							$treid2=$row['reid'];//��Ϊ��һ����¼����һ������
							$tretypename2=$row['retypename'];
							$pretid=$typeid;//��Ϊ��һ����¼����һ����ID
							$ptypename=$row['typename'];//��Ϊ��һ����¼����һ��������
						}
					}
				}
				$dsql->ExecuteNoneQuery("update `#@__co_htmls` set isexport=1 where aid='$exid' ");
				$dsql->ExecuteNoneQuery("update `#@__co_note` set remark='' where nid='$nid' ");
			}
		}
		//echo " ����ɡ�<br>";
		$eorid=0;
	}
}
//���µ�ǰ�ɼ�����ʣ������û�вɼ����Ա��ڹ����Զ��ϲ�ʱ�жϣ�ʣ�����5���ľͲ�Ҫ�ϲ���ȥ�����Ӱ��ɼ�Ч�� by QISIP 2014-04-04
$conrow = $dsql->GetOne("Select count(aid) as dd From `#@__co_htmls` where nid='$nid' and isdown=0");
$nidcon=$conrow['dd'];
$dsql->ExecuteNoneQuery("update `#@__co_note` set con='$nidcon' where nid='$nid' ");

//�����Ҫ�������html
if($makeindex=='yes' && $treid2!='b')
{
	$tid=$typeid;
	include_once(DEDEINC."/arc.listview.class.php");
	//echo '��ʼ���¡�'.$typename.'��-ID��'.$typeid;
	$lv = new ListView($typeid);
	$reurl = $lv->MakeHtml();
	$lv->Close();
	$tid=$treid;
	$lv = new ListView($treid);
	$reurl = $lv->MakeHtml();
	$lv->Close();
	//echo '�����·��ࣺ'.$tretypename.'-�ɹ�<br/>';
	clean_cachefiles( "../data/tplcache" );//ɾ��ģ�滺�棬�����ļ�����
	//������ҳ by QISIP 2014-04-01
	$homeFile =dirname(__FILE__)."/../html/index.html";
	$cfg_autoindex_time=(intval($cfg_autoindex_time)>=0) ? intval($cfg_autoindex_time):600;
	if(abs(time()-@filemtime($homeFile))>$cfg_autoindex_time)//��ҳ����վ��ͼ�����а�10���Ӹ���һ�Σ���Щҳ����Ҫ����������������У����Ѳ��������Щ̫��
	{
		//������ҳ by QISIP 2014-04-01
		$tid='';
		$dsql->ExecuteNoneQuery("Delete From `#@__arccache`");
		include_once(DEDEINC."/arc.partview.class.php");
		$row = $dsql->GetOne("Select * From `#@__homepageset`");
		$row['templet'] = MfTemplet($row['templet']);
		$pv = new PartView();
		$pv->SetTemplet($cfg_basedir . $cfg_templets_dir . "/" . $row['templet']);
		$pv->SaveToHtml('../html/index.html');
		$dsql->Close();
		//����sitemap by QISIP 2014-04-01
		$sitemaptemplet=$cfg_df_style."/sitemap.htm";
		$pv2 = new PartView();
		$pv2->SetTemplet($cfg_basedir.$cfg_templets_dir."/".$sitemaptemplet);
		$sitemapFile ="../sitemap.html";
		$pv2->SaveToHtml($sitemapFile);
		//�������а� by QISIP 2014-04-03
		$tid='375';
		$paihangbangtemplet=$cfg_df_style."/paihang.htm";
		$paihangbangtemplet = $cfg_basedir.$cfg_templets_dir."/".$paihangbangtemplet;
		if(file_exists($paihangbangtemplet))
		{
			$lv = new ListView($tid);
			$reurl = $lv->MakeHtml();
			$lv->Close();
		}
	}
}
setcookie("upflag",'1',(time()+$co_oldpertime));
?>