<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
//��������
$pageID=$_POST['pageID'];
$www_669977_net='<p><a href="./?name='.$name.'&pwd='.$pwd.'">������ҳ</a></p>';
if(!$pageID){
	$www_669977_net='
	<p><a href="./?name='.$name.'&pwd='.$pwd.'">������ҳ</a></p>
	<p><b>[��������]</b></p>
	<form id="form" method="post" action="?entry=article&name='.$name.'&pwd='.$pwd.'">
	  <input type="hidden" name="pageID" value="article" />
	  <p>������<br>
		<input type="text" id="subject_669977_net" name="subject_669977_net" value="�������� - ��669977.net���ҿ���" style="width:720px;" />
	  </p>
	  <p>����/����/����/��᣺<br>
		<input type="text" id="caid" name="caid" value="���Է���" />
		<input type="text" id="author" name="author" value="��������" />
		<input type="text" id="ready_1" name="ready_1" value="580000" />
		<input type="text" id="abover" name="abover" value="�������" />
	  </p>
	  <p>���棺<br>
		<input type="text" id="thumb" name="thumb" value="http://static.zongheng.com/upload/cover/2014/12/1418482699674.jpg" style="width:720px;" />
	  </p>
	  <p>��飺<br>
		<textarea id="content" name="content" rows="3" cols="100">���Լ��</textarea>
	  </p>
	  <p>�½ڱ��⣺<br>
		<input type="text" id="title_669977_net" name="title_669977_net" value="�����½ڱ���" style="width:720px;" />
	  </p>
	  <p>�½����ݣ�<br>
		<textarea id="article" name="article" rows="10" cols="100">�����½�����</textarea>
	  </p>
	  <p>
		<input type="submit" value="�ύ" style="width:100px; height:30px;" />
	  </p>
	</form>
	<p><b>[��ע]</b></p>
	<p>1.���ݡ�С˵���⡱�Զ����½���ӽ���Ӧ��С˵</p>
	<p>2.���ݡ�С˵���ࡱ�Զ���С˵���ൽ��Ӧ��Ŀ</p>
	<p style="color:red">3.����������ͷ�ɼ�������վ����������ϣ�ʵ�ֻ�ͷ�Զ��ɼ����Զ����ࡢ�Զ���⣡�ɰ������ɼ���Ҳ���԰��б���վ�ɼ��������൱��ǿ����</p>
	<p>4.�����www.669977.net��дԭ����������Ȩ��www.669977.net���У�</p>
	';
}
if($pageID=='article'){
	$subject=trim($_POST['subject_669977_net']);
	$caid=trim($_POST['caid']);
	$author=trim($_POST['author']);
	$ready_1=$_POST['ready_1'];
	$abover=trim($_POST['abover']);
	$thumb=$_POST['thumb'];
	$content=$_POST['content'];
	$title=trim($_POST['title_669977_net']);
	$article=$_POST['article'];
	$chapter_no=$_POST['chapter_no'];
	$source=$_POST['source'];

    if($source!==NULL&&$sourcei!==""){
        $source="http://".array_pop(split("http://",$source));
    }
	
	$aid='';
	
	if(!$subject || !$caid || !$title || !$article){
		$www_669977_net.='<p class="red">��Ǹ�����ݲ�����...</p>';
	}
	//�������
	foreach($caid_Array as $key=>$value){
		$c_I++;
		if($c_I=='1'){
			$caid_First=$key;
		}
		if(strpos($value,$caid)>-1){
			$caid_result=$key;
			break;
		}
	}
	if(!$caid_result){
		foreach($caid_Array as $key=>$value){
			if(strpos($value,mb_substr($caid,0,2,'utf-8'))>-1){
				$caid_result=$key;
				break;
			}
		}
	}
	if(!$caid_result){
		$caid_result=$caid_First;
	}
	//�������
	if($abover){
		foreach($abover_Array as $key=>$value){
			if(strpos($abover,$value)>-1){
				$abover_result=time();
				break;
			}
		}
	}else{
		foreach($abover_Array as $key=>$value){
			if(strpos($title,$value)>-1){
				$abover_result=time();
				break;
			}
		}
	}
	if(!$abover_result){
		$abover_result='';
	}
	//С˵����Ϣ
	$do_subject=sbyou_NET_subject($subject,$author,$ready_1,$thumb,$content);
	if(!$do_subject || $do_subject=='����ʧ��'){
		$www_669977_net.='<p class="red">��Ǹ������ʧ�ܣ������Ժ�����...</p>';
	}else{
		if($do_subject=='�����𳵲ɼ�'){
			$www_669977_net.='<p class="red">��ϲ���������ɹ������ǲ�δ��⣬��Ϊ��С˵�Ѿ�����Ϊ���������ͷ�ɼ�����</p>';
		}else{
			//С˵����Ϣ
			$do_article=sbyou_NET_title($subject,$title,$article);
			if($do_article=='�½��Ѿ�����'){
				$www_669977_net.='<p class="red">��ϲ���������ɹ������ǲ�δ��⣬��Ϊ���½��Ѿ����ڣ�</p>';
			}else if($do_article=='�����ɹ�'){
				$www_669977_net.='<p class="red">��ϲ���������ɹ���</p>';
			}else{
				$www_669977_net.='<p class="red">��Ǹ������ʧ�ܣ������Ժ�����...</p>';
			}
            if(isset($source)&&$source!==""){
                $dsql->ExecuteNoneQuery("UPDATE dede_arctype SET source='$source' where typename='$subject' and zuozhe='$author' and topid!=45");
            }
            if(isset($chapter_no)&&($do_article=='�����ɹ�'||$do_article=='�½��Ѿ�����')){
                $id_row=$dsql->GetOne("select id from dede_arctype where typename='$subject' and zuozhe='$author' and topid!=45 order by id desc limit 1");
                if($id_row['id']){
                    $tid=$id_row['id'];
                    $dsql->ExecuteNoneQuery("UPDATE dede_archives SET chapter_no='$chapter_no' WHERE typeid='$tid' AND title='$title'");
				    $www_669977_net.='<p class="red">��ϲ������ŷ����ɹ���</p>';
                }   
            }

        }
    }
}
echo $www_669977_net;
?>
