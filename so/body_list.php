<link rel="stylesheet" href="<?=$SEARCH_URL;?>css/so.css" />
<link rel="stylesheet" href="<?=$SEARCH_URL;?>css/list.css" />
<div class="SO">
  <div id="hd">
    <div class="has-layout">
      <div id="hd-inner">
        <div id="hd-nav"> <span class="hd-logo"> <a target="_self" href="<?=$SEARCH_URL;?>"><img title="����������ҳ" alt="����������ҳ" src="<?=$SEARCH_URL;?>images/search_list.gif"></a> </span> <span class="fuck-tabs <?=$fuck;?>"> <a<?=($fuck=='author'?' class="cur"':(' href="'.$SEARCH_URL.'?fuck=author&searchword='.$searchword).'"');?> title="������">������</a> <a<?=($fuck=='subject'?' class="cur"':(' href="'.$SEARCH_URL.'?fuck=subject&searchword='.$searchword).'"');?> title="��С˵">��С˵</a>
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
          <span class="ly"></span> </span> </div>
        <div id="hd-tools">
          <script>document.write("<script src='<?=$BOOK_URL;?>sb.login.php?entry=search&t="+(new Date).getTime()+"'></s"+"cript>")</script>
        </div>
      </div>
    </div>
  </div>
  <div id="warper">
    <div id="head" style="position:relative;z-index:888;">
      <form class="form" method="get" action="<?=$SEARCH_URL;?>" onsubmit="check(1,2)">
        <span id="suggest-align" class="round">
        <input type="hidden" name="fuck" value="<?=$fuck;?>" />
        <input id="keyword1" name="searchword" tabindex="1" class="input_key" value="<?=$searchword;?>" />
        </span> <span class="button">
        <input type="submit" tabindex="2" value="����һ��" class="s_btn" />
        </span>
        <div class="ac_wrap" style="display:none;">
          <ul class="ac_menu">
            <li>sdfsd<b>f</b></li>
          </ul>
        </div>
      </form>
    </div>
    <div id="container">
      <?php
	  include_once dirname(__FILE__).'/fun/list.inc.php';
      ?>
    </div>
    <div id="rs_bg">
      <?php
	  include_once dirname(__FILE__).'/fun/same.inc.php';
      ?>
    </div>
    <div id="search">
      <form method="get" action="<?=$SEARCH_URL;?>" onsubmit="check(2,1)">
        <span class="round">
        <input type="hidden" name="fuck" value="<?=$fuck;?>" />
        <input id="keyword2" name="searchword" class="input_key" value="<?=$searchword;?>" />
        </span> <span class="button">
        <input type="submit" value="����һ��" class="s_btn" />
        </span>
      </form>
    </div>
  </div>
  <div class="footer-wrap">
    <div id="footer"> <em>�걾С˵������������ô�򵥣�</em><a href="<?=$FULL_URL;?>" target="_blank">���������С˵���ṩ</a></div>
  </div>
</div>
<script>function check(a,b){$id("keyword1").className=$id("keyword2").className="input_key on";$id("keyword"+b).value=$id("keyword"+a).value;return true;}</script>
