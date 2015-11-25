<?php
$page_id='search';
include_once dirname(__FILE__).'/header.php';
$searchword=$_POST['searchword'];
?>

<div class="seach">
  <form name="searchForm1" action="<?=$TOUCH_URL;?>search.php" method="post">
    <input type="hidden" name="forward" value="<?=$forward;?>" />
    <input type="text" name="searchword" id="searchword" value="<?=$searchword;?>" class="text">
    <input type="submit" class="button" value="">
  </form>
</div>
<div id="search_box">
  <p class="ss_str">
    <!--结果数-->
  </p>
  <div class="goodsBody s">
    <!--搜索结果-->
  </div>
  <p class="page">
    <!--页码-->
  </p>
  <script type="text/javascript">call_search("<?=$searchword;?>",1,'');</script>
</div>
<?php include_once dirname(__FILE__).'/footer.php';?>