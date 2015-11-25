function $id(id){return document.getElementById(id);}
function GetXmlHttpObject(){
	var xmlHttp;
	if(window.ActiveXObject){try{xmlHttp=new ActiveXObject("Microsoft.XMLHttp");}catch(e){xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");}}else if(window.XMLHttpRequest){xmlHttp=new XMLHttpRequest();}  
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
			  $id(OBJ)?$id(OBJ).innerHTML=cDATA:'';//公共
			  //以下为区别对待
			  if((XID=='ca_list' || XID=='ph_list' || XID=='tuwen' || XID=='fav_list' || XID=='page_list') && ELSE=='yes'){
				  $('html,body').animate({scrollTop:95});
			  }else if(XID=='search_box' && ELSE=='yes'){
				  $('html,body').animate({scrollTop:52});
			  }else if(XID=='del_favorite'){
				  setTimeout(function(){window.location.reload();},1000)
			  }
		  }
	  }
	}
	xmlHttp.open('GET',URL,true);
	xmlHttp.send(null);
}
//以上是公共
function call_search(searchword,page,to){
	url=MOBILE_URL+'fun/call_search.php?searchword='+searchword+'&page='+page;
	x_get(url,"search_box","search_box",to);
}
function call_page_list(aid,page,to){
	url=MOBILE_URL+'fun/call_page_list.php?aid='+aid+'&page='+page;
	x_get(url,"page_list","page_list",to);
}
function add_favorite(mid,mname,regdate,aid,chid,msg_box_id){
	url=MOBILE_URL+'fun/add_favorite.php?mid='+mid+'&mname='+mname+'&regdate='+regdate+'&aid='+aid+'&chid='+chid;
	x_get(url,"msg_box"+msg_box_id);
}
function del_favorite(mid,mname,regdate,entry,aid,msg_box_id){
	url=MOBILE_URL+'fun/add_favorite.php?mid='+mid+'&mname='+mname+'&regdate='+regdate+'&entry='+entry+'&aid='+aid;
	x_get(url,"msg_box"+msg_box_id,"del_favorite");
}
function call_ca_list(caid,page,to){
	url=MOBILE_URL+'fun/call_ca_list.php?caid='+caid+'&page='+page;
	x_get(url,"ca_list","ca_list",to);
}
function call_ph_list(caid,page,to){
	url=MOBILE_URL+'fun/call_ph_list.php?caid='+caid+'&page='+page;
	x_get(url,"ph_list","ph_list",to);
}
function call_tuwen(caid,page,to){
	url=MOBILE_URL+'fun/call_tuwen.php?page='+page;
	x_get(url,"tuwen","tuwen",to);
}
function call_fav_list(mid,mname,regdate,page,to){
	url=MOBILE_URL+'fun/call_fav_list.php?mid='+mid+'&mname='+mname+'&regdate='+regdate+'&page='+page;
	x_get(url,"fav_list","fav_list",to);
}