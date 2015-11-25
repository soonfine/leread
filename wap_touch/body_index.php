<div class="body">
<p class="menu">
  <?php
	$dsql->SetQuery("select * from dede_arctype where topid=0 and id!=45 and id!=375 and id!=376 order by sortrank asc limit 6");
	$dsql->Execute();
	while($row=$dsql->GetObject())
	{
		$ca_i++;	
		$id=$row->id;
		$typename=$row->typename;
		$ca_list.='<a href="'.$TOUCH_URL.'?caid='.$id.'"><span class="span1 span1'.$ca_i.'"></span><span class="span2">'.$typename.'</span></a>';
	}
	echo $ca_list;
	?>
  <a href="<?=$TOUCH_URL;?>paihang.php"><span class="span1 span17"></span><span class="span2">排行榜</span></a> <a href="<?=$TOUCH_URL;?>all.php"><span class="span1 span18"></span><span class="span2">全部分类</span></a> </p>
<div id="gallery">
  <div id="slider" class="slider">
    <ul>
      <?php
				$dsql->SetQuery("select * from dede_arctype where topid!=0 and topid!=45 and booksize!=0 order by id desc limit 15");
				$dsql->Execute();
				while($sbyou_net=$dsql->GetObject())
				{
						$hd_i++;
						$typeimg=ltrim($sbyou_net->typeimg,'/');
						if(!$typeimg){
								$randPICID=rand(1,50);
								$typeimg="uploads/empty/".$randPICID.".jpg";
						}
						if($hd_i%3==0 && $hd_i!=15){$m_str='</li><li>';}
						$LIST_STR.='<a href="'.$TOUCH_URL.'page.php?aid='.$sbyou_net->id.'"><img src="'.$BOOK_URL.$typeimg.'"></a>'.$m_str;
						$m_str='';
				}
        echo '<li>'.$LIST_STR.'</li>';
        $LIST_STR='';
        ?>
    </ul>
  </div>
  <p> <a href="javascript:(0)" id="prev" onClick="slider.prev();return false;"><em>prev</em></a> <span id="position"><em class="on">1</em><em>2</em><em>3</em><em>4</em><em>5</em></span> <a href="javascript:(0)" id="next" onClick="slider.next();return false;"><em>next</em></a> </p>
</div>
<center>
  <script type="text/javascript" src="<?=$BOOK_URL;?>plus/ad_js.php?aid=18"></script>
</center>

<!--奇幻 开始-->
<div class="floor_head" style="margin-top:20px;">
  <?=SByou_NET_caBlock('11','1');?>
</div>
<div class="goodsBody ca">
  <?=SByou_NET_caBlock('11','2');?>
  <p class="line"></p>
</div>
<p class="nvyong_m" id="box_nav1">
  <?=SByou_NET_caBlock('11','3');?>
</p>
<script type="text/javascript">class_set('box_nav1','a11','1_3_5_10');</script>
<?=SByou_NET_caBlock('11','4');?>
<!--奇幻 结束--> 

<!--武侠 开始-->
<div class="floor_head" style="margin-top:20px;">
  <?=SByou_NET_caBlock('22','1');?>
</div>
<div class="goodsBody ca">
  <?=SByou_NET_caBlock('22','2');?>
  <p class="line"></p>
</div>
<p class="nvyong_m" id="box_nav2">
  <?=SByou_NET_caBlock('22','3');?>
</p>
<script type="text/javascript">class_set('box_nav2','a22','1_4_6_8_9');</script>
<?=SByou_NET_caBlock('22','4');?>
<!--武侠 结束--> 

<!--都市 开始-->
<div class="floor_head" style="margin-top:20px;">
  <?=SByou_NET_caBlock('33','1');?>
</div>
<div class="goodsBody ca">
  <?=SByou_NET_caBlock('33','2');?>
  <p class="line"></p>
</div>
<p class="nvyong_m" id="box_nav3">
  <?=SByou_NET_caBlock('33','3');?>
</p>
<script type="text/javascript">class_set('box_nav3','a33','1_3_7_8_10');</script>
<?=SByou_NET_caBlock('33','4');?>
<!--都市 结束--> 

<center>
  <script type="text/javascript" src="<?=$BOOK_URL;?>plus/ad_js.php?aid=19"></script>
</center>

<!--历史 开始-->
<div class="floor_head" style="margin-top:20px;">
  <?=SByou_NET_caBlock('44','1');?>
</div>
<div class="goodsBody ca">
  <?=SByou_NET_caBlock('44','2');?>
  <p class="line"></p>
</div>
<p class="nvyong_m" id="box_nav4">
  <?=SByou_NET_caBlock('44','3');?>
</p>
<script type="text/javascript">class_set('box_nav4','a44','1_3_7_8_10');</script>
<?=SByou_NET_caBlock('44','4');?>
<!--历史 结束--> 

<!--游戏 开始-->
<div class="floor_head" style="margin-top:20px;">
  <?=SByou_NET_caBlock('55','1');?>
</div>
<div class="goodsBody ca">
  <?=SByou_NET_caBlock('55','2');?>
  <p class="line"></p>
</div>
<p class="nvyong_m" id="box_nav4">
  <?=SByou_NET_caBlock('55','3');?>
</p>
<script type="text/javascript">class_set('box_nav5','a55','1_3_7_8_10');</script>
<?=SByou_NET_caBlock('55','4');?>
<!--游戏 结束--> 

<!--科幻 开始-->
<div class="floor_head" style="margin-top:20px;">
  <?=SByou_NET_caBlock('66','1');?>
</div>
<div class="goodsBody ca">
  <?=SByou_NET_caBlock('66','2');?>
  <p class="line"></p>
</div>
<p class="nvyong_m" id="box_nav4">
  <?=SByou_NET_caBlock('66','3');?>
</p>
<script type="text/javascript">class_set('box_nav6','a66','1_3_7_8_10');</script>
<?=SByou_NET_caBlock('66','4');?>
<!--科幻 结束--> 

<script>
  window.Swipe = function(element, options) {
  if (!element) return null;
  var _this = this;
  this.options = options || {};
  this.index = this.options.startSlide || 0;
  this.speed = this.options.speed || 300;
  this.callback = this.options.callback || function() {};
  this.delay = this.options.auto || 0;
  this.container = element;
  this.element = this.container.children[0];
  this.container.style.overflow = 'hidden';
  this.element.style.listStyle = 'none';
  this.element.style.margin = 0;
  this.setup();
  this.begin();
  if (this.element.addEventListener) {
  this.element.addEventListener('touchstart', this, false);
  this.element.addEventListener('touchmove', this, false);
  this.element.addEventListener('touchend', this, false);
  this.element.addEventListener('webkitTransitionEnd', this, false);
  this.element.addEventListener('msTransitionEnd', this, false);
  this.element.addEventListener('oTransitionEnd', this, false);
  this.element.addEventListener('transitionend', this, false);
  window.addEventListener('resize', this, false);
  }
  };
  Swipe.prototype = {
  setup: function() {
  this.slides = this.element.children;
  this.length = this.slides.length;
  if (this.length < 0) return null;
  this.width = ("getBoundingClientRect" in this.container) ? this.container.getBoundingClientRect().width : this.container.offsetWidth;
  if (!this.width) return null;
  this.container.style.visibility = 'hidden';
  this.element.style.width = (this.slides.length * this.width) + 'px';
  var index = this.slides.length;
  while (index--) {
  var el = this.slides[index];
  el.style.width = this.width + 'px';
  }
  this.slide(this.index, 0);
  this.container.style.visibility = 'visible';
  },
  slide: function(index, duration) {
  var style = this.element.style;
  if (duration == undefined) {
  duration = this.speed;
  }
  style.webkitTransitionDuration = style.MozTransitionDuration = style.msTransitionDuration = style.OTransitionDuration = style.transitionDuration = duration + 'ms';
  style.MozTransform = style.webkitTransform = 'translate3d(' + -(index * this.width) + 'px,0,0)';
  style.msTransform = style.OTransform = 'translateX(' + -(index * this.width) + 'px)';
  this.index = index;
  },
  getPos: function() {
  return this.index;
  },
  prev: function(delay) {
  this.delay = delay || 0;
  clearTimeout(this.interval);
  if (this.index) this.slide(this.index-1, this.speed);
  else this.slide(this.length - 1, this.speed);
  },
  next: function(delay) {
  this.delay = delay || 0;
  clearTimeout(this.interval);
  if (this.index < this.length - 1) this.slide(this.index+1, this.speed);
  else this.slide(0, this.speed);
  },
  begin: function() {
  var _this = this;
  this.interval = (this.delay)
  ? setTimeout(function() { 
  _this.next(_this.delay);
  }, this.delay)
  : 0;
  },
  stop: function() {
  this.delay = 0;
  clearTimeout(this.interval);
  },
  resume: function() {
  this.delay = this.options.auto || 0;
  this.begin();
  },
  handleEvent: function(e) {
  switch (e.type) {
  case 'touchstart': this.onTouchStart(e); break;
  case 'touchmove': this.onTouchMove(e); break;
  case 'touchend': this.onTouchEnd(e); break;
  case 'webkitTransitionEnd':
  case 'msTransitionEnd':
  case 'oTransitionEnd':
  case 'transitionend': this.transitionEnd(e); break;
  case 'resize': this.setup(); break;
  }
  },
  transitionEnd: function(e) {
  if (this.delay) this.begin();
  this.callback(e, this.index, this.slides[this.index]);
  },
  onTouchStart: function(e) {
  this.start = {
  pageX: e.touches[0].pageX,
  pageY: e.touches[0].pageY,
  time: Number(new Date())
  };
  this.isScrolling = undefined;
  this.deltaX = 0;
  this.element.style.MozTransitionDuration = this.element.style.webkitTransitionDuration = 0;
  e.stopPropagation();
  },
  onTouchMove: function(e) {
  if(e.touches.length > 1 || e.scale && e.scale !== 1) return;
  this.deltaX = e.touches[0].pageX - this.start.pageX;
  if ( typeof this.isScrolling == 'undefined') {
  this.isScrolling = !!( this.isScrolling || Math.abs(this.deltaX) < Math.abs(e.touches[0].pageY - this.start.pageY) );
  }
  if (!this.isScrolling) {
  e.preventDefault();
  clearTimeout(this.interval);
  this.deltaX = 
  this.deltaX / 
  ( (!this.index && this.deltaX > 0
  || this.index == this.length - 1
  && this.deltaX < 0
  ) ?                      
  ( Math.abs(this.deltaX) / this.width + 1 )
  : 1 );
  this.element.style.MozTransform = this.element.style.webkitTransform = 'translate3d(' + (this.deltaX - this.index * this.width) + 'px,0,0)';
  e.stopPropagation();
  }
  },
  onTouchEnd: function(e) {
  var isValidSlide = 
  Number(new Date()) - this.start.time < 250
  && Math.abs(this.deltaX) > 20
  || Math.abs(this.deltaX) > this.width/2,
  isPastBounds = 
  !this.index && this.deltaX > 0
  || this.index == this.length - 1 && this.deltaX < 0;
  if (!this.isScrolling) {
  this.slide( this.index + ( isValidSlide && !isPastBounds ? (this.deltaX < 0 ? 1 : -1) : 0 ), this.speed );
  }
  e.stopPropagation();
  }
  };
  var slider = new Swipe(document.getElementById('slider'), {
  callback: function(e, pos) {
  var i = bullets.length;
  while (i--) {
  bullets[i].className = ' ';
  }
  bullets[pos].className = 'on';
  }
  }),
  bullets = document.getElementById('position').getElementsByTagName('em'),
  tabs = new Swipe(document.getElementById('tabs'), {
  callback: function(event,index,elem) {
  setTab(selectors[index]);
  }
  })
  function setTab(elem) {
  for (var i = 0; i < selectors.length; i++) {
  selectors[i].className = selectors[i].className.replace('on',' ');
  }
  elem.className += ' on';
  }
  (function() {
  var win = window,
  doc = win.document;
  if ( !location.hash || !win.addEventListener ) {
  window.scrollTo( 0, 1 );
  var scrollTop = 1,
  bodycheck = setInterval(function(){
  if( doc.body ){
  clearInterval( bodycheck );
  scrollTop = "scrollTop" in doc.body ? doc.body.scrollTop : 1;
  win.scrollTo( 0, scrollTop === 1 ? 0 : 1 );
  } 
  }, 15 );
  if (win.addEventListener) {
  win.addEventListener("load", function(){
  setTimeout(function(){
  win.scrollTo( 0, scrollTop === 1 ? 0 : 1 );
  }, 0);
  }, false );
  }
  }
  })();
</script> 
<script type="text/javascript">
  function ccc(){slider.next();}
  var t = setInterval(ccc,5000);
</script> 
