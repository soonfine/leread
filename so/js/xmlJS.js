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
		  }
	  }
	}
	xmlHttp.open('GET',URL,true);
	xmlHttp.send(null);
}
//以上是公共
function callSAME(searchword){
	//url=BOOK_URL+'callSAME.php?searchword='+searchword;
	//x_get(url,"rs_bg");
}