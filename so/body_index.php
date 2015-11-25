<link rel="stylesheet" href="<?=$SEARCH_URL;?>css/so.css" />
<div class="SO">
  <div id="hd">
    <div class="has-layout">
      <div id="hd-inner">
        <div id="hd-nav"><span class="fuck-tabs <?=$fuck;?>"> <a<?=($fuck=='author'?' class="cur"':(' href="'.$SEARCH_URL.'?fuck=author&searchword='.$searchword).'"');?> title="搜作者">搜作者</a> <a<?=($fuck=='subject'?' class="cur"':(' href="'.$SEARCH_URL.'?fuck=subject&searchword='.$searchword).'"');?> title="搜小说">搜小说</a>
          <?php
		  $dsql->SetQuery("select * from dede_arctype where topid=0 and id!=45 and id!=375 and id!=376 order by sortrank asc limit 6");
		  $dsql->Execute();
		  while($row=$dsql->GetObject())
		  {
			  $id=$row->id;
			  $typename=$row->typename;
			  $typedir=$row->typedir;
			  
			  if($fuck==$typedir){
				  $href=' class="cur"';
			  }else{
				  $href=' href="'.$SEARCH_URL.'?fuck='.$typedir.'&searchword='.$searchword.'"';
			  }
			  $ca_list.='<a'.$href.' title="'.$typename.'">'.$typename.'</a>';
		  }
		  echo $ca_list;
		  ?>
          <span class="ly"></span> </span></div>
        <div id="hd-tools">
          <script>document.write("<script src='<?=$BOOK_URL;?>sb.login.php?entry=search&t="+(new Date).getTime()+"'></s"+"cript>")</script>
        </div>
      </div>
    </div>
  </div>
  <div id="main">
    <p id="logo"><img src="<?=$SEARCH_URL;?>images/search.gif" width="260" height="43"> </p>
    <div id="search-box">
      <form target="_self">
        <span id="input-container">
        <div id="input-inner">
          <div id="suggest-align">
            <input type="hidden" name="fuck" value="<?=$fuck;?>" />
            <input type="text" name="searchword" id="input" />
          </div>
        </div>
        </span>
        <input type="submit" id="search-button" value="搜 索" onmouseover="this.className='hover'" onmousedown="this.className='mousedown'" onmouseout="this.className=''" />
      </form>
    </div>
  </div>
  <div class="footer-wrap">
    <div id="footer"> <em>完本小说搜索，就是这么简单！</em><a href="<?=$FULL_URL;?>" target="_blank">数据由免费小说网提供</a></div>
  </div>
</div>
