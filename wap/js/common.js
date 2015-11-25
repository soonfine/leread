//获取id元素
function $id(id){return document.getElementById(id);}
//设置cookie
function getcookie(name){
	var cookie_start=document.cookie.indexOf(name);
	var cookie_end=document.cookie.indexOf(";",cookie_start);
	return cookie_start == -1?'':unescape(document.cookie.substring(cookie_start+name.length+1,(cookie_end > cookie_start?cookie_end:document.cookie.length)));
}
//获取cookie
function setcookie(cookieName,cookieValue,seconds,path,domain,secure){
	var expires=new Date();
	expires.setTime(expires.getTime()+seconds);
	document.cookie=escape(cookieName)+'='+escape(cookieValue)+(expires?';expires='+expires.toGMTString():'')+(path?';path='+path:'/')+(domain?';domain='+domain:'')+(secure?';secure':'');
}
//收藏夹
function addBookmark(){
	var urler=window.location.href;
	var titler=document.title;
	try{  
		window.external.AddFavorite(urler,titler);  
	}catch(e){  
		try{  
			window.sidebar.addPanel(titler,urler,"");  
		}catch(e){  
			alert("360等浏览器不支持自动添加收藏夹。关闭本对话框后，请您使用快捷键 Ctrl+D 进行添加。");  
		}  
	}
}
//右侧工具条
window.onscroll=function(){
	var top = (document.documentElement.scrollTop || document.body.scrollTop);
	if (top>170){
		$(".topbox").addClass("topFLOAT");$(".UD").fadeIn();
	}else{
		$(".topbox").removeClass("topFLOAT");$(".UD").fadeOut();
	}
};
//返回顶部
function Top(){$('html,body').animate({scrollTop:0});}
//小分类设置class值，控制样式
function class_set(id,str,num){
	var aSTR=document.getElementById(id).getElementsByTagName('a');
	var numSTR=num.split('_');
	for(i=0;i<numSTR.length;i++){
		aSTR.item(numSTR[i]-1).className=str;
	}
}