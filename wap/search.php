<?php
$page_id='search';
include_once dirname(__FILE__).'/header.php';
$searchword=$_POST['searchword'];
?>

<div class="seach">
  <form name="searchForm1" action="<?=$MOBILE_URL;?>search.php" method="post">
    <input type="hidden" name="forward" value="<?=$forward;?>" />
    <input type="text" name="searchword" id="searchword" value="<?=$searchword;?>" class="text">
    <input type="submit" class="button" value="����">
  </form>
</div>
<div class="list dashline">
  <p>����"
    <?=$searchword;?>
    "�����</p>
  <div id="search_box"><br />
    <img src="<?=$MOBILE_URL;?>images/loading_data.gif" />&nbsp;���ڼ�������...<br />
    <br />
    <!--�����--> 
    <script type="text/javascript">call_search("<?=$searchword;?>",1,'');</script> 
  </div>
</div>
<?php include_once dirname(__FILE__).'/footer.php';?>
