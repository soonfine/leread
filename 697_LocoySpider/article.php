<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
//发布内容
$pageID=$_POST['pageID'];
$www_669977_net='<p><a href="./?name='.$name.'&pwd='.$pwd.'">返回首页</a></p>';
if(!$pageID){
	$www_669977_net='
	<p><a href="./?name='.$name.'&pwd='.$pwd.'">返回首页</a></p>
	<p><b>[发布内容]</b></p>
	<form id="form" method="post" action="?entry=article&name='.$name.'&pwd='.$pwd.'">
	  <input type="hidden" name="pageID" value="article" />
	  <p>书名：<br>
		<input type="text" id="subject_669977_net" name="subject_669977_net" value="测试书名 - 由669977.net独家开发" style="width:720px;" />
	  </p>
	  <p>分类/作者/字数/完结：<br>
		<input type="text" id="caid" name="caid" value="测试分类" />
		<input type="text" id="author" name="author" value="测试作者" />
		<input type="text" id="ready_1" name="ready_1" value="580000" />
		<input type="text" id="abover" name="abover" value="测试完结" />
	  </p>
	  <p>封面：<br>
		<input type="text" id="thumb" name="thumb" value="http://static.zongheng.com/upload/cover/2014/12/1418482699674.jpg" style="width:720px;" />
	  </p>
	  <p>简介：<br>
		<textarea id="content" name="content" rows="3" cols="100">测试简介</textarea>
	  </p>
	  <p>章节标题：<br>
		<input type="text" id="title_669977_net" name="title_669977_net" value="测试章节标题" style="width:720px;" />
	  </p>
	  <p>章节内容：<br>
		<textarea id="article" name="article" rows="10" cols="100">测试章节内容</textarea>
	  </p>
	  <p>
		<input type="submit" value="提交" style="width:100px; height:30px;" />
	  </p>
	</form>
	<p><b>[备注]</b></p>
	<p>1.根据“小说标题”自动将章节添加进对应的小说</p>
	<p>2.根据“小说分类”自动将小说归类到对应栏目</p>
	<p style="color:red">3.这个组件将火车头采集器与网站程序深度整合，实现火车头自动采集、自动归类、自动入库！可按单本采集，也可以按列表整站采集，功能相当的强悍！</p>
	<p>4.组件由www.669977.net手写原创开发，版权归www.669977.net所有！</p>
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
		$www_669977_net.='<p class="red">抱歉，数据不完整...</p>';
	}
	//处理分类
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
	//处理完结
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
	//小说主信息
	$do_subject=sbyou_NET_subject($subject,$author,$ready_1,$thumb,$content);
	if(!$do_subject || $do_subject=='发布失败'){
		$www_669977_net.='<p class="red">抱歉，发布失败，请您稍后重试...</p>';
	}else{
		if($do_subject=='跳过火车采集'){
			$www_669977_net.='<p class="red">恭喜您，发布成功！但是并未入库，因为此小说已经设置为“不参与火车头采集”！</p>';
		}else{
			//小说副信息
			$do_article=sbyou_NET_title($subject,$title,$article);
			if($do_article=='章节已经存在'){
				$www_669977_net.='<p class="red">恭喜您，发布成功！但是并未入库，因为此章节已经存在！</p>';
			}else if($do_article=='发布成功'){
				$www_669977_net.='<p class="red">恭喜您，发布成功！</p>';
			}else{
				$www_669977_net.='<p class="red">抱歉，发布失败，请您稍后重试...</p>';
			}
            if(isset($source)&&$source!==""){
                $dsql->ExecuteNoneQuery("UPDATE dede_arctype SET source='$source' where typename='$subject' and zuozhe='$author' and topid!=45");
            }
            if(isset($chapter_no)&&($do_article=='发布成功'||$do_article=='章节已经存在')){
                $id_row=$dsql->GetOne("select id from dede_arctype where typename='$subject' and zuozhe='$author' and topid!=45 order by id desc limit 1");
                if($id_row['id']){
                    $tid=$id_row['id'];
                    $dsql->ExecuteNoneQuery("UPDATE dede_archives SET chapter_no='$chapter_no' WHERE typeid='$tid' AND title='$title'");
				    $www_669977_net.='<p class="red">恭喜您，编号发布成功！</p>';
                }   
            }

        }
    }
}
echo $www_669977_net;
?>
