<?php

/*-----------------
��������PHP����
�����ߣ���Ҷ��
�Ա����̣�669977.TaoBao.com
��ʾվ��www.SBYOU.net
������www.669977.net
QQ��1981255858
-----------------*/

//�������
$dsql->SetQuery("select * from dede_search_keywords where keyword like '%".$searchword."%' order by count desc limit 10");
$dsql->Execute();
while($row=$dsql->GetObject())
{
	$keyword=$row->keyword;
	if($keyword!=$searchword){
		$same_i++;
		if($same_i<=5){
			$th01.='<th><a href="'.$SEARCH_URL.'?searchword='.urlencode($keyword).'">'.$keyword.'</a></th><td></td>';
		}else{
			$th02.='<th><a href="'.$SEARCH_URL.'?searchword='.urlencode($keyword).'">'.$keyword.'</a></th><td></td>';
		}
	}
}
$same_i>=1?($th01='<tr><th rowspan="2" class="tt">�������</th>'.$th01.'</tr>'):$th01='';
$same_i>=6?($th02='<tr>'.$th02.'</tr>'):$th02='';
$same_i>=1?($str='<div id="rs"><table><tbody>'.$th01.$th02.'</tbody></table></div>'):$str='';
echo $str;
?>