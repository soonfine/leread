<?php
include_once dirname(__FILE__).'/base.inc.php';
$fuck=htmlspecialchars($_GET['fuck']);
empty($fuck)?$fuck='subject':'';
$searchword=trim(strip_tags(htmlspecialchars($_GET['searchword'])));
$searchword=="请输入您要搜索的内容"?$searchword='':'';
$page=htmlspecialchars($_GET['page']);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>搜索网 - 我们有一大堆热门小说</title>
<meta http-equiv="Cache-Control" content="no-siteapp" />
<base href="<?=$BOOK_URL;?>" />
<script>var FIRST_URL="<?=$SEARCH_URL;?>",BOOK_URL="<?=$SEARCH_URL;?>",fuck="<?=$fuck;?>",searchword="<?=urlencode($searchword);?>",page="<?=$page;?>";</script>
<script type="text/javascript" src="<?=$SEARCH_URL;?>js/xmlJS.js"></script>
<style>.floatQQbox,.YUAN{display:none;}</style>
</head>
<body class="<?=$searchword?'list':'index';?>">
<script type="text/javascript" src="<?=$BOOK_URL;?>plus/ad_js.php?aid=15"></script>
<?php
if($searchword){
	include_once dirname(__FILE__).'/body_list.php';
}else{
	include_once dirname(__FILE__).'/body_index.php';
}
?>
</body>
</html>
