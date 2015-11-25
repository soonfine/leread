//ajax功能
function GetXmlHttpObject(){
	var xmlHttp=null;
	if(window.ActiveXObject){try{xmlHttp=new ActiveXObject('Microsoft.XMLHttp');}catch(e){xmlHttp=new ActiveXObject('Msxml2.XMLHTTP');}}else if(window.XMLHttpRequest){xmlHttp=new XMLHttpRequest();}
	return xmlHttp;
}
function x_get(URL,OBJ,XID,ELSE,OTHER){
	var xmlHttp=null;
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null){alert ('Browser does not support HTTP Request!');return false;}
	xmlHttp.onreadystatechange=function(){
	  if(xmlHttp.readyState==4 && xmlHttp.status==200)  
	  {
		  var cDATA=xmlHttp.responseText;
		  if(cDATA){
			  if(XID.indexOf('score')>0){
				  $id(OBJ)?$id(OBJ).innerHTML=parseInt($id(OBJ).innerHTML)+parseInt(cDATA):'';//公共
			  }else{
				  $id(OBJ)?$id(OBJ).innerHTML=cDATA:'';//公共
			  }
			  //以下为区别对待
				if(XID=='bwjp'){
					$id('reFRESH')?$id('reFRESH').className='':'';
				}
				if(XID.indexOf('score')>0){
					if(cDATA=='1'){
						TIP('恭喜您，评价成功！');
						setcookie('sbyou_net_score_'+ELSE,'1');
					}else{
						TIP('抱歉，暂时不能评价，请您稍后再试！');
					}
				}
				if(XID=='com_box' && OTHER=='yes'){
					$('html,body').animate({scrollTop:645});
				}
				if(XID=='logout'){
					TIP('安全退出！');relog();
					if($('.LogBox')){
						relog2();
					}
				}
				if(XID=='relog'){
					$('.left_con').html(cDATA);
				}
				if(XID=='relog2'){
					$('.LogBox').html(cDATA);
				}
				if(XID=='look'){
					if(OTHER){
						setcookie('look_'+OTHER+'_'+ELSE,'1');
					}else{
						setcookie('look_'+ELSE,'1');
					}
				}
				if(XID=='good' || XID=='bad'){
					setcookie('good_'+ELSE,'1');
					setcookie('bad_'+ELSE,'1');
				}
		  }
	  }
	}
	xmlHttp.open('GET',URL,true);
	xmlHttp.send(null);
}
//生成静态
function ajax_make_html(entry,id1,id2,id3,id4,id5){
	var url=BOOK_URL+'ajax_make_html.php?entry='+entry+'&id1='+id1+'&id2='+id2+'&id3='+id3+'&id4='+id4+'&id5='+id5;
	x_get(url,'','');
}
//动态数据
function ajax_data(entry,id1,id2,id3,id4,id5){
	if(entry=='bwjp'){
		$id('reFRESH')?$id('reFRESH').className='on':'';
	}
	if(entry=='randBOX'){
		$id('btn_img')?$id('btn_img').className='btn_img':'';
	}
	if(entry=='score'){
		if(getcookie('sbyou_net_score_'+id1)){
			TIP('抱歉，24小时之内只能评价一次！');
			return false;
		}
		entry='sbyou_'+entry+'_'+id2;
	}
	var url=BOOK_URL+'ajax_data.php?entry='+entry+'&id1='+id1+'&id2='+id2+'&id3='+id3+'&id4='+id4+'&id5='+id5+'&t='+(new Date).getTime();
	x_get(url,entry,entry,id1,id3);
}
//统计会员浏览数据
function sbyou_NeT_ArticleInfo(aid,mid,mname,regdate,chapter){
	if(chapter){
		if(getcookie('look_'+chapter+'_'+aid)){
			return false;
		}
	}else{
		if(getcookie('look_'+aid)){
			return false;
		}
	}
	var url=BOOK_URL+'ajax_data.php?entry=look&aid='+aid+'&mid='+mid+'&mname='+mname+'&regdate='+regdate+'&t='+(new Date).getTime();
	x_get(url,'','look',aid,chapter);
}
//统计会员点赞数据
function sbyou_NET_addGood(aid,mid,mname,regdate){
	if(getcookie('good_'+aid) || getcookie('bad_'+aid)){
		return false;
	}
	var url=BOOK_URL+'ajax_data.php?entry=good&aid='+aid+'&mid='+mid+'&mname='+mname+'&regdate='+regdate+'&t='+(new Date).getTime();
	x_get(url,'','good',aid);
}
//统计会员鄙视数据
function sbyou_NET_addBad(aid,mid,mname,regdate){
	if(getcookie('good_'+aid) || getcookie('bad_'+aid)){
		return false;
	}
	var url=BOOK_URL+'ajax_data.php?entry=bad&aid='+aid+'&mid='+mid+'&mname='+mname+'&regdate='+regdate+'&t='+(new Date).getTime();
	x_get(url,'','bad',aid);
}

function logout(){
	var url=BOOK_URL+'member/index_do.php?fmdo=login&dopost=exit';
	x_get(url,'','logout');
}
function relog(){
	var url=BOOK_URL+'sb.login.php?entry=relog';
	x_get(url,'','relog');
}
function relog2(){
	var url=BOOK_URL+'sb.login.php?entry=relog2';
	x_get(url,'','relog2');
}