<div class="yd">
  <?='<a href="'.$MOBILE_URL.'page.php?aid='.$id.'">��'.$arc_row['typename'].'��</a><span class="fred fs">��'.($arc_row['overdate']?'���':'����').'��</span>';?>
</div>
<div class="kind">
  <h1>������Ŀ</h1>
</div>
<div id="page_list">
  <div class="list"><br />
    <img src="<?=$MOBILE_URL;?>images/loading_data.gif" />&nbsp;���ڼ�������...<br />
    <br />
    <!--�½��б�--> 
  </div>
  <p class="page"> 
    <!--ҳ��--> 
  </p>
</div>
<script type="text/javascript">call_page_list("<?=$arc_row['id'];?>",1);</script>
<div id="msg_box"></div>
<div class="pl"><a href="javascript:add_favorite(mid,mname,regdate,'<?=$arc_row['id'];?>','1','');">�����ղ�</a>|<a href="<?=$MOBILE_URL;?>adminm.php?action=favorites">�����</a> </div>
