/*-----------------
��������PHP����
�����ߣ���Ҷ��
�Ա����̣�669977.tAoBao.cOm
��ʾվ��www.SbYOu.net
������www.6 6997 7.net
QQ��1981 25 58 58
-----------------*/

function FeedDel()
{
  if(confirm("��ȷ��ɾ���ö�̬��Ϣ?"))
	  return true;
  else
	  return false;
}
$(function(){
	  $('#arcticle').click(function() {
		  $.ajax({
			type: "GET",
			url: "feed.php",
			dataType: "json",
			success : function(data){
				   $('#FeedText').empty();
					var html = '<div class="newarticlelist"><ul>';
					$.each( data  , function(commentIndex, comment) {
						html += '<li><span>' + comment['lastupdate'] + '</span><span>'+ comment['zuozhe'] +'</span>[<a href="' + comment['ca_url'] + '" target="_blank">'+comment['ca_typename']+'</a>]&nbsp;<a href="' + comment['htmlurl'] + '" target="_blank">' + comment['typename'] + '</a>&nbsp;/&nbsp;'+ comment['booksize'] +'��</li>';
					})
				   html +="</ul></div>";
				   $('#FeedText').html(html);
				   $("#arcticle").addClass("thisTab");
				   $("#myfeed").removeClass("thisTab");
				   $("#allfeed").removeClass("thisTab");
				   $("#score").removeClass("thisTab");
				   $("#mood").removeClass("thisTab");
			}
		  }); 
	  });
 })
 $(function(){
	  $('#allfeed').click(function() {
		  $.ajax({
			type: "GET",
			url: "feed.php?type=allfeed",
			dataType: "json",
			success : function(data){
				   $('#FeedText').empty();
					var html = '';
					$.each( data  , function(commentIndex, comment) {
						html += '<div class="feeds_title ico' + comment['type'] + '"><span><a href="/member/index.php?uid='+ comment['uname'] +'">'+ comment['uname'] +'</a>' + comment['title'] + ' <em>' + comment['dtime'] + '</em></span><p>' + comment['note'] + '</p></div>';
					})
				   $('#FeedText').html(html);
				   $("#allfeed").addClass("thisTab");
				   $("#myfeed").removeClass("thisTab");
				   $("#arcticle").removeClass("thisTab");
				   $("#score").removeClass("thisTab");
				   $("#mood").removeClass("thisTab");
			}
		  }); 
	  });
 })
 //
 $(function(){
	  $('#myfeed').click(function() {
		  $.ajax({
			type: "GET",
			url: "feed.php?type=myfeed",
			dataType: "json",
			success : function(data){
				   $('#FeedText').empty();
					var html = '';
					$.each( data  , function(commentIndex, comment) {
						html += '<div class="feeds_title ico' + comment['type'] + '"><span><a href="index.php?uid='+ comment['uname'] +'&action=feeddel&fid=' + comment['fid'] + '" onclick="return FeedDel()" class="act">ɾ��</a><a href="/member/index.php?uid='+ comment['uname'] +'">'+ comment['uname'] +'</a>' + comment['title'] + ' <em>' + comment['dtime'] + '</em></span><p>' + comment['note'] + '</p></div>';
					})
				   $('#FeedText').html(html);
				   $("#myfeed").addClass("thisTab");
				   $("#allfeed").removeClass("thisTab");
				   $("#arcticle").removeClass("thisTab");
				   $("#score").removeClass("thisTab");
				   $("#mood").removeClass("thisTab");
			}
		  }); 
	  });
 })
 //�ҵĶ�̬
$(function(){
	  $.ajax({
		type: "GET",
		url: "feed.php",
		dataType: "json",
		success : function(data){
			   $('#FeedText').empty();
				var html = '<div class="newarticlelist"><ul>';
				$.each( data  , function(commentIndex, comment) {
					html += '<li><span>' + comment['lastupdate'] + '</span><span>'+ comment['zuozhe'] +'</span>[<a href="' + comment['ca_url'] + '" target="_blank">'+comment['ca_typename']+'</a>]&nbsp;<a href="' + comment['htmlurl'] + '" target="_blank">' + comment['typename'] + '</a>&nbsp;/&nbsp;'+ comment['booksize'] +'��</li>';
				})
			   html +="</ul></div>";
			   $('#FeedText').html(html);
			   $("#arcticle").addClass("thisTab");
			   $("#myfeed").removeClass("thisTab");
			   $("#allfeed").removeClass("thisTab");
			   $("#score").removeClass("thisTab");
			   $("#mood").removeClass("thisTab");
		}
	  }); 
 })
  