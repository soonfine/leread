function $id(id){return document.getElementById(id);}
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
			  if(XID=='SByou_NET_QC_Loader'){
				  document.location='../';
			  }
		  }else{
			  if(XID=='SByou_NET_QC_Loader'){
				  document.location='../';
			  }
		  }
	  }
	}
	xmlHttp.open('GET',URL,true);
	xmlHttp.send(null);
}
//以上是公共
function SByou_NET_QC_Loader(sbyou_NET_name,sbyou_NET_thumb,sbyou_NET_openid,sbyou_NET_id){
	if(!sbyou_NET_openid && !sbyou_NET_id){
		return false;
	}
	var url='ajax_data.php?sbyou_NET_name='+sbyou_NET_name+'&sbyou_NET_thumb='+sbyou_NET_thumb+'&sbyou_NET_openid='+sbyou_NET_openid+'&sbyou_NET_id='+sbyou_NET_id;
	x_get(url,'','SByou_NET_QC_Loader');
}