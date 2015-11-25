function $id(id){return document.getElementById(id);}
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
			  $id(OBJ)?$id(OBJ).innerHTML=cDATA:'';//公共
			  //以下为区别对待
				if(XID=='ajax_caiji'){
					sbyou_Net_result='ok';
				}
		  }else{
				if(XID=='ajax_caiji'){
					sbyou_Net_result='';
				}
			}
	  }
	}
	xmlHttp.open('GET',URL,true);
	xmlHttp.send(null);
}
//定时采集
function ajax_caiji(page){
	var url='fun/collection.fun.php?page='+page;
	x_get(url,'ajax_caiji','ajax_caiji');
}