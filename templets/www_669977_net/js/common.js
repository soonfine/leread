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
//首屏改版
function ShowNewBox(id){
	for(i=1;i<=8;i++){
		$id('Tab_0'+i)?$id('Tab_0'+i).className='':'';
		$id('Box_0'+i)?$id('Box_0'+i).className='Box':'';
	}
	$id('Tab_0'+id)?$id('Tab_0'+id).className='cur':'';
	$id('Box_0'+id)?$id('Box_0'+id).className='Box cur':'';
}
function ShowListBox(id,obj){
	for(i=1;i<=5;i++){
		$id('Btn_'+obj+'_'+i)?$id('Btn_'+obj+'_'+i).className='':'';
		$id('PiC_'+obj+'_'+i)?$id('PiC_'+obj+'_'+i).className='PiC':'';
		$id('WorD_'+obj+'_'+i)?$id('WorD_'+obj+'_'+i).className='WorD':'';
	}
	document.getElementById('Btn_'+obj+'_'+id).className='cur';
		$id('PiC_'+obj+'_'+id)?$id('PiC_'+obj+'_'+id).className='PiC cur':'';
		$id('WorD_'+obj+'_'+id)?$id('WorD_'+obj+'_'+id).className='WorD cur':'';
}
//提示信息
function TIP(msg){$('.TIP').html('<div class="h">温馨提示：</div><span class="MSG">'+msg+'</span>');$('.TIP,.MAK').show();setTimeout(function(){$('.TIP,.MAK').fadeOut();$('.TIP,.MAK').removeClass('on');},1500);}