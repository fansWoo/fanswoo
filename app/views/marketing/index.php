<?=$temp['header_up']?>
<script src="app/js/smooth_scrollerator.js"></script>
<script src="app/js/cycle2.js"></script>
<script>
$(function(){
	$(window).resize(function(){
		$(document).scrollTop(0);
		location.href = 'marketing';
	});
	$(" .slide_pic > .square").cycle({
		fx      :       "scrollHorz", 
		//fade
		//scrollHorz
		timeout: 0 ,
		speed: 2000,
		manualSpeed: 600,
		slides: ' > .slide_pic_href',
		next: ' .content7  .next',
		prev: ' .content7  .prev',
		pager: ' .cycle-pager '
		
	});
	var window_width = $(window).width();
	var window_height = $(window).height();
			
		if(window_width < 550){	
			$('.content1').css('height', window_height);
			$('.content1 .area').css('height', '400');
			$(window).resize(function(){
			var window_height = $(window).height();
			$('.content1').css('height', window_height);

			});	
		}
		else if	(window_width > 550){
			$('.content1').css('height', window_height);
			$('.content1 .area').css('height', window_height);
			$(window).resize(function(){
			var window_height = $(window).height();
			$('.content1').css('height', window_height);
			$('.content1 .area').css('height', window_height);	
			
			});
			
		}
		$(document).on('click', '.content9 .choose_box , .content9 .circle', function(){
			var bgname = $(this).data('bgname');
			$('.content9 .choose_box').removeClass('clicked');
			$(this).addClass('clicked');
			//新增的
			$('.content9 .choose_box').removeClass('hover');
			$('.content9 h4').removeClass('hover');
			$('.content9 .choose_box[data-bgname=' + bgname + '] ').addClass('hover');
			$('.content9 .choose_box[data-bgname=' + bgname + '] input').attr('name', 'money_Str');
			$('.content9 h4[data-bgname=' + bgname + ']').addClass('hover');	
		});
		if(window_width > 500 && window_width <= 1400){			
			$(document).scroll(function(){
				var window_width = $(window).width();
				var scroll_top = $(document).scrollTop();
				if(scroll_top > 500){
				$('.content1 .arrow').css('display' , 'none');
				}
				else if(scroll_top < 500){
					$('.content1 .arrow').css('display' , 'block');
				}	
				if(scroll_top == 0){
					$('.content2 , .content3 , .content5 , .content6 , .content7 , .content8' ).removeClass('hover');
					$(' .content4 .hover_area01 , .content4 .hover_area02' ).removeClass('hover');
					$('.content6 .bottom_line01 , .content6 .bottom_line02 , .content6 .bottom_line03 , .content6 .bottom_line04 , .content6 .circle_box , .content6 .earth' ).removeClass('hover');
					$('.content4 #dialog_box_one span , #dialog_box_two span , #dialog_box_three span').text('0');
					
				}
				else if(scroll_top >= 300 && scroll_top < 1000){
					$('.content2').addClass('hover');
				}
				else if(scroll_top >= 1000 && scroll_top < 1900){
					$('.content3').addClass('hover');
				}
				else if(scroll_top >= 1900 && scroll_top < 2400){
					$('.content4 .hover_area01').addClass('hover');
					timer('.content4 #dialog_box_one:eq(0) span');
					setTimeout(function(){
						timer('.content4 #dialog_box_one:eq(1) span');
					}, 3000);
				}
				else if(scroll_top >= 2400 && scroll_top < 2900){
					$('.content4 .hover_area02').addClass('hover');
					timer('.content4 #dialog_box_two:eq(0) span ');
					setTimeout(function(){
						timer('.content4 #dialog_box_two:eq(1) span ');
					}, 3000);
					timer('.content4 #dialog_box_three:eq(0) span ');
					setTimeout(function(){
						timer('.content4 #dialog_box_three:eq(1) span');
					}, 3000);
				}
				else if(scroll_top >= 2900 && scroll_top < 3900){
					$('.content5').addClass('hover');
				}
				else if(scroll_top >= 3900 && scroll_top < 4200){
					$('.content6').addClass('hover');
				}
				else if(scroll_top >= 4200 && scroll_top < 5000){
					$('.content6 .bottom_line01').addClass('hover');
					$('.content6 .bottom_line02').addClass('hover');
					$('.content6 .bottom_line03').addClass('hover');
					$('.content6 .bottom_line04').addClass('hover');
					$('.content6 .earth').addClass('hover');
					$('.content6 .circle_box').addClass('hover');
				}
				else if(scroll_top >=5000 && scroll_top <6000){
					$('.content7').addClass('hover');
				}
				//線條動畫
				if(scroll_top < 1600)
				{
					$('.content3 .line_box3').css('height', 1 + 'px');
				}
				else if(scroll_top >= 1600 && scroll_top < 2200)
				{
					var line_dash_height = 1600 * ( (scroll_top - 1580) / 1600);
					$('.content3 .line_box3').css('height', line_dash_height + 'px');
				}
				else if(scroll_top >= 2200)
				{
					$('.content3 .line_box3').css('height', 1600 + 'px');
				}
				if(scroll_top < 2250)
				{
					$('.content4 .line').css('height', 1 + 'px');
				}
				else if(scroll_top >= 2250 && scroll_top < 2750)
				{
					var line_dash_height = 1600 * ( (scroll_top - 2200) / 2250);
					$('.content4 .line').css('height', line_dash_height + 'px');
				}
				else if(scroll_top >= 2750)
				{
					$('.content4 .line').css('height', 550 + 'px');
				}
				
				if(scroll_top < 3500)
				{
					$('.content5 .line_box3').css('height', 1 + 'px');
				}
				else if(scroll_top >= 3500 && scroll_top < 4550)
				{
					var line_dash_height = 1600 * ( (scroll_top - 3400) / 3500);
					$('.content5 .line_box3').css('height', line_dash_height + 'px');
				}
				else if(scroll_top >= 4550)
				{
					$('.content5 .line_box3').css('height', 1500 + 'px');
				}
			});		
		}	
		if(window_width > 1400 ){			
			$(document).scroll(function(){
				var window_width = $(window).width();
				var scroll_top = $(document).scrollTop();
				if(scroll_top > 1080){
				$('.content1 .arrow').css('display' , 'none');
				}
				else if(scroll_top < 1080){
					$('.content1 .arrow').css('display' , 'block');
				}	
				if(scroll_top == 0){
					$('.content2 , .content3 , .content5 , .content6 , .content7 , .content8' ).removeClass('hover');
					$(' .content4 .hover_area01 , .content4 .hover_area02' ).removeClass('hover');
					$('.content6 .bottom_line01 , .content6 .bottom_line02 , .content6 .bottom_line03 , .content6 .bottom_line04 , .content6 .circle_box , .content6 .earth' ).removeClass('hover');
					$('.content4 #dialog_box_one span , #dialog_box_two span , #dialog_box_three span').text('0');
				}
				else if(scroll_top >= 500 && scroll_top < 1500){
					$('.content2').addClass('hover');
				}
				else if(scroll_top >= 1500 && scroll_top < 2500){
					$('.content3').addClass('hover');
				}
				else if(scroll_top >= 1500 && scroll_top < 2500){
					$('.content3').addClass('hover');
				}
				else if(scroll_top >= 2500 && scroll_top < 2800){
					$('.content4 .hover_area01').addClass('hover');
					timer('.content4 #dialog_box_one:eq(0) span');
					setTimeout(function(){
						timer('.content4 #dialog_box_one:eq(1) span');
					}, 3000);
				}
				else if(scroll_top >= 2800 && scroll_top < 3400){
					$('.content4 .hover_area02').addClass('hover');
					timer('.content4 #dialog_box_two:eq(0) span ');
					setTimeout(function(){
						timer('.content4 #dialog_box_two:eq(1) span ');
					}, 3000);
					timer('.content4 #dialog_box_three:eq(0) span ');
					setTimeout(function(){
						timer('.content4 #dialog_box_three:eq(1) span');
					}, 3000);
				}
				else if(scroll_top >= 3400 && scroll_top < 4100){
					$('.content5').addClass('hover');
				}
				else if(scroll_top >= 4100 && scroll_top < 5000){
					$('.content6').addClass('hover');
				}
				else if(scroll_top >= 5000 && scroll_top < 5550){
					$('.content6 .bottom_line01').addClass('hover');
					$('.content6 .bottom_line02').addClass('hover');
					$('.content6 .bottom_line03').addClass('hover');
					$('.content6 .bottom_line04').addClass('hover');
					$('.content6 .earth').addClass('hover');
					$('.content6 .circle_box').addClass('hover');
				}
				else if(scroll_top >=5550 && scroll_top <7000){
					$('.content7').addClass('hover');
				}
				//線條動畫
				if(scroll_top < 2000)
				{
					$('.content3 .line_box3').css('height', 1 + 'px');
				}
				else if(scroll_top >= 2000 && scroll_top < 2500)
				{
					var line_dash_height = 2000 * ( (scroll_top - 1950) / 2000);
					$('.content3 .line_box3').css('height', line_dash_height + 'px');
				}
				else if(scroll_top >= 2500)
				{
					$('.content3 .line_box3').css('height', 2000 + 'px');
				}
				if(scroll_top < 2650)
				{
					$('.content4 .line').css('height', 1 + 'px');
				}
				else if(scroll_top >= 2650 && scroll_top < 3000)
				{
					var line_dash_height = 1600 * ( (scroll_top - 2600) / 2650);
					$('.content4 .line').css('height', line_dash_height + 'px');
				}
				else if(scroll_top >= 3000)
				{
					$('.content4 .line').css('height', 2650 + 'px');
				}
				
				if(scroll_top < 4000)
				{
					$('.content5 .line_box3').css('height', 1 + 'px');
				}
				else if(scroll_top >= 4000 && scroll_top < 4750)
				{
					var line_dash_height = 1400 * ( (scroll_top - 3950) / 4000);
					$('.content5 .line_box3').css('height', line_dash_height + 'px');
				}
				else if(scroll_top >= 4750)
				{
					$('.content5 .line_box3').css('height', 1000 + 'px');
				}
			});		
		}
	
	$('a[href^=#]').click(function () {
		var speed = 500;
		var href = $(this).attr("href");
		var target = $(href == "#" || href == "" ? 'html' : href);
		var position = target.offset().top;
		$("html, body").animate({scrollTop: position}, speed, "swing");
			return false;
	});
	function timer(jquery_selector){
		var time = parseInt($(jquery_selector).text());
		if(time < $(jquery_selector).data('count') )
		{
			$(jquery_selector).text(time + 1);
			setTimeout(function(){
				timer(jquery_selector);
			}, 90);
		}
	}

	$(document).on('mouseenter', '.textContactForm', function(){
		$('.textContactForm').addClass('hover');
		$('.textContact').addClass('hidden');
	});
	$(document).on('focus', '.textContactForm.hover .need, .textContactForm.hover .need_child, .textContactForm.hover .money', function(){
		$(this).find("option[value='']").remove();
	});
	
	$(document).on('focus', '.textContactForm.hover .need', function(){
		$('.textContactForm.hover .need').change();
	});
		
	$(document).on('change', '.textContactForm.hover .need', function(){
		var selected = $(this).val();
		$('.need_child').css('display', 'none');
		$('.need_child').addClass('displaynone');
		$('.need_child[data-selected=' + selected + ']').css('display', 'block');
		$('.need_child[data-selected=' + selected + ']').attr('name', 'classtype2_Str');
		$('.need_child option').removeAttr('selected');
		$('.need_child[data-selected=' + selected + '] option:first').attr('selected', true);
	});
	
});
</script>
<?=$temp['header_down']?>
<?=$temp['header_bar']?>
<div class="content1">
	<div class="area">
		<div class="pic1">
			<img src="app/img/marketing/content1/pic1.png">
		</div>
		<div class="text">
			<h2>提供世界一流的Google雲端伺服器</h2>
			<h2>為企業網站、購物網站和網路平台</h2>	
			<h2>找到完美解決方案！</h2>	
		</div>
		<a href="#content2" class="arrow">
			<img src="app/img/index/arrow_down.png">	
		</a>
	</div>
</div>
<div class="content2" id="content2">
	<div class="area">
		<div class="text_arae">
			<div class="title">
				<h1>同樣的廣告預算<br>
				如何透過Big Data創造2倍收益？</h1>
			</div>
			<div class="text">
				<p>全球Facebook用戶數已達12億，台灣覆蓋高達一</p>
				<p>千四百萬。Facebook的廣告能夠用更低的成</p>
				<p>本滾出源源不絕的訂單。全球Facebook</p>
				<p>用戶數已達12億，台灣覆蓋高達一</p>
				<p>全球Facebook用戶數已達12億，</p>
				<p>千四百萬。Facebook的廣告能</p>
				<p>夠用更低的成本滾的訂單。</p>
			</div>
			<div class="text short">
				<p>全球Facebook用戶數已達12億，台灣覆蓋高達一千四百萬。Facebook的廣告能夠用更低的成本滾出源源不絕的訂單。</p>
			</div>
		</div>
		<div class="bg">
			<img src="app/img/marketing/content2/bg1.png" class="one">
			<img src="app/img/marketing/content2/bg2.png" class="two">
			<img src="app/img/marketing/content2/bg3.png" class="three">
			<img src="app/img/marketing/content2/bg4.png" class="four">
			<img src="app/img/marketing/content2/bg5.png" class="five">
			<img src="app/img/marketing/content2/bg6.png" class="six">
			<img src="app/img/marketing/content2/bg7.png" class="seven">
			<img src="app/img/marketing/content2/bg8.png" class="eight">
			<img src="app/img/marketing/content2/bg9.png" class="nine">
			<img src="app/img/marketing/content2/bg10.png" class="ten">
			<img src="app/img/marketing/content2/bg11.png" class="eleven">
			<img src="app/img/marketing/content2/bg12.png" class="twelve">
			<img src="app/img/marketing/content2/bg13.png" class="thirteen">
		</div>
	</div>
	<div class="phone_area">
		<div class="text_arae">
			<div class="title">
				<h1>同樣的廣告預算<br>
				如何透過Big Data創造2倍收益？</h1>
			</div>
			<div class="text">
				<p>全球Facebook用戶數已達12億，台灣覆蓋高達一千四百萬。Facebook的廣告能夠用更低的成本滾出源源不絕的訂單。全球Facebook用戶數已達12億，台灣覆蓋高達一千四百萬。Facebook的廣告能夠用更低的成本滾的訂單。
				</p>
				<p>全球Facebook用戶數已達12億，台灣覆蓋高達一千四百萬。Facebook的廣告能夠用更低的成本滾出源源不絕的訂單。
				</p>
			</div>
		</div>
		<div class="bg">
			<img src="app/img/marketing/content2/bg.png">
		</div>
	</div>
</div>
<div class="content3">
	<div class="area">
		<div class="title_box">
			<img src="app/img/marketing/content3/title.png">
			<div class="right_text">	
				<h1>Facebook<br> 
				社群行銷的時代！</h1>
			</div>
			<p>全球Facebook用戶數已達12億，台灣覆蓋高達一千四百萬。Facebook的廣告能夠用更低的成本滾出源源不絕的訂單。</p>
		</div>
	
	<div class="item_area">
		<div class="line_box1">
			<img src="app/img/marketing/content3/line_box.png">
		</div>
		<div class="line_box2">
			<img src="app/img/marketing/content3/line_box.png">
		</div>
		<div class="line_box3">
			<img src="app/img/marketing/content3/line_long.png">
		</div>
		<div class="item_box one">
			<div class="pic_box">
				<img src="app/img/marketing/content3/icon01.png">
			</div>
			<div class="text_box">
				<img src="app/img/marketing/content3/text01.png">
				<div class="text">
					<p>Facebook能達到91%的目標設定精準度，遠高於其他業者的27%，幫助您精準找出高轉換的目標群眾。</p>
				</div>
			</div>
		</div>
		<div class="item_box two">
			<div class="pic_box">
				<img src="app/img/marketing/content3/icon02.png">
			</div>
			<div class="text_box">
				<img src="app/img/marketing/content3/text02.png">
				<div class="text">
					<p>47%的媒體互動發生在行動裝置上，Facebook 的廣告在任何螢幕尺寸上都是全螢幕展示。</p>
				</div>
			</div>
		</div>
		<div class="item_box three">
			<div class="pic_box">
				<img src="app/img/marketing/content3/icon03.png">
			</div>
			<div class="text_box">
				<img src="app/img/marketing/content3/text03.png">
				<div class="text">
					<p>Facebook多樣的廣告格式可以滿足各種行銷訴求，替您的產品找到最佳效益的廣告配置。</p>
				</div>
			</div>
		</div>
	</div>
</div>	
</div>
<div class="content4">
	<div class="area">
		<div class="line">
			<img src="app/img/marketing/content4/line.png">
		</div>
		<div class="hover_area01">
			<div class="start01">
				<img src="app/img/marketing/content4/pic02.png">
			</div>
			<div class="start02">
				<img src="app/img/marketing/content4/pic02.png">
			</div>
			<div class="pic01">
				<img src="app/img/marketing/content4/pic01.png">
			</div>
			<div class="dialog_box one" id="dialog_box_one">
				<div class="number">
					<h3><span data-count="56">0</span>%</h3>
					<p>的用戶表示</p>
				</div>
				<img src="app/img/marketing/content4/pic03.png">
			</div>
			<div class="window01">
				<img src="app/img/marketing/content4/window01.png">
			</div>
			<div class="text_area one">
				<h1>貼文廣告</h1>
				<p>Facebook多樣的廣告格式可以滿足各種行銷訴求，一定能替您的產品找到最佳效益的廣告配置。</p>
				<img src="app/img/marketing/content4/icon01.png">
			</div>
		</div>
		<div class="hover_area02">	
			<div class="window02">
				<img src="app/img/marketing/content4/window02.png">
			</div>
			<div class="hand">
				<img src="app/img/marketing/content4/hand.png">
			</div>
			<div class="text_area two">
				<h1>讚廣告</h1>
				<p>Facebook多樣的廣告格式可以滿足各種行銷訴求，一定能替您的產品找到最佳效益的廣告配置。</p>
				<img src="app/img/marketing/content4/icon02.png">
			</div>
			<div class="dialog_box two" id="dialog_box_two">
				<div class="number">
					<h3><span data-count="42">0</span>%</h3>
					<p>的用戶表示</p>
				</div>
				<img src="app/img/marketing/content4/pic04.png">
			</div>
			<div class="dialog_box three" id="dialog_box_three">
				<div class="number">
					<h3><span data-count="36">0</span>%</h3>
					<p>的用戶表示</p>
				</div>
				<img src="app/img/marketing/content4/pic05.png">
			</div>
		</div>
	</div>	
	<div class="phone_area">
		<div class="dialog_box01">
			<img src="app/img/marketing/content4/mobile/dialog_box01.png">
		</div>
		<div class="dialog_box02">
			<img src="app/img/marketing/content4/mobile/dialog_box02.png">
		</div>
		<div class="dialog_box03">
			<img src="app/img/marketing/content4/mobile/dialog_box03.png">
		</div>
		<div class="line01">
			<img src="app/img/marketing/content4/mobile/line01.png">
		</div>
		<div class="line02">
			<img src="app/img/marketing/content4/mobile/line02.png">
		</div>
		<div class="window01">
			<img src="app/img/marketing/content4/window01.png">
		</div>
		<div class="window02">
			<img src="app/img/marketing/content4/window02.png">
		</div>
		<div class="hand">
			<img src="app/img/marketing/content4/mobile/hand.png">
		</div>
		<div class="text_box01">
			<h1>貼文廣告</h1>
			<p>Facebook多樣的廣告格式可以滿足各種行銷訴求，一定能替您的產品找到最佳效益的廣告配置。</p>
		</div>
		<div class="text_box02">
			<h1>讚廣告</h1>
			<p>Facebook多樣的廣告格式可以滿足各種行銷訴求，一定能替您的產品找到最佳效益的廣告配置。</p>
		</div>
		<div class="pic01">
			<img src="app/img/marketing/content4/icon01.png">
		</div>
		<div class="pic02">
			<img src="app/img/marketing/content4/icon02.png">
		</div>
	</div>
</div>
<div class="content5">
	<div class="area">
		<div class="title_box">
			<img src="app/img/marketing/content5/title.png" class="pc_title">
			<img src="app/img/marketing/content5/title2.png" class="phone_title">
			<div class="right_text">	
				<h1>Google<br> 
				全方位精準行銷</h1>
			</div>
			<p>Facebook多樣的廣告格式可以滿足各種行銷訴求，一定能替您的產品找到最佳效益。</p>
		</div>
		<div class="item_area">
			<div class="line_box1">
				<img src="app/img/marketing/content3/line_box.png">
			</div>
			<div class="line_box2">
				<img src="app/img/marketing/content3/line_box.png">
			</div>
			<div class="line_box3">
				<img src="app/img/marketing/content5/line_long.png">
			</div>
			<div class="item_box one">
				<div class="pic_box">
					<img src="app/img/marketing/content3/icon01.png">
				</div>
				<div class="text_box ">
					<img src="app/img/marketing/content5/text01.png">
					<p>Facebook能達到91%的目標設定精準度，遠高於其他業者的27%，幫助您精準找出高轉換的目標群眾。</p>
				</div>
			</div>
			<div class="item_box two">
				<div class="pic_box">
					<img src="app/img/marketing/content3/icon02.png">
				</div>
				<div class="text_box">
					<img src="app/img/marketing/content5/text02.png">
					<p>47%的媒體互動發生在行動裝置上，Facebook 的廣告在任何螢幕尺寸上都是全螢幕展示。</p>
				</div>
			</div>
			<div class="item_box three">
				<div class="pic_box">
					<img src="app/img/marketing/content3/icon03.png">
				</div>
				<div class="text_box">
					<img src="app/img/marketing/content5/text03.png">
					<p>Facebook多樣的廣告格式可以滿足各種行銷訴求，替您的產品找到最佳效益的廣告配置。</p>
				</div>
			</div>
		</div>
	</div>	
</div>
<div class="content6">
	<div class="area">
		<div class="text_area">
			<h1>全球的網站都幫您打品牌</h1>
			<p>您使用YouTube觀賞影片嗎？您上天下的網站看新聞嗎？您上露天拍賣找商品嗎？</p>
			<p>
			這些網站其實都是Google多媒體聯播網的一員。Google在台灣有超過兩萬個合作網站，是台灣最大網路廣告播送平台，每天曝光超過2億次！</p>
			<p>只要把廣告放上Google聯播網，就會在全台最熱門的網站上曝光，幫您打響知名度幫您打響知名度。</p>
		</div>
		<div class="earth">
			<img src="app/img/marketing/content6/earth.png">
		</div>
		<div class="computer">
			<img src="app/img/marketing/content6/computer.png">
		</div>
		<div class="start">
			<img src="app/img/marketing/content6/start.png">
		</div>
		<div class="bottom_line01">
			<img src="app/img/marketing/content6/bottom_line01.png">
		</div>
		<div class="bottom_line02">
			<img src="app/img/marketing/content6/bottom_line02.png">
		</div>
		<div class="bottom_line03">
			<img src="app/img/marketing/content6/bottom_line03.png">
		</div>
		<div class="bottom_line04">
			<img src="app/img/marketing/content6/bottom_line04.png">
		</div>
		<div class="phone_line">
			<img src="app/img/marketing/content6/mobile/line.png">
		</div>
		<div class="phone_line2">
			<img src="app/img/marketing/content6/mobile/line2.png">
		</div>
		<div class="circle_box one">
			<img src="app/img/marketing/content6/icon.png">
			<div class="text">
				<p>Google的廣告格式</p>
				<p>可以滿足各種行銷訴求</p>
			</div>
		</div>
		<div class="circle_box two">
			<img src="app/img/marketing/content6/icon.png">
			<div class="text">	
				<p>Google的廣告格式</p>
				<p>可以滿足各種行銷訴求</p>
			</div>
		</div>
		<div class="circle_box three">
			<img src="app/img/marketing/content6/icon.png">
			<div class="text">		
				<p>Google的廣告格式</p>
				<p>可以滿足各種行銷訴求</p>
			</div>
		</div>
		<div class="circle_box four">
			<img src="app/img/marketing/content6/icon.png">
			<div class="text">		
				<p>Google的廣告格式</p>
				<p>可以滿足各種行銷訴求</p>
			</div>
		</div>
	</div>	
</div>
<div class="content7">
	<div class="area">
		<h1>當網路行銷結合網站UI/UX<br>
		會發生什麼事？</h1>
		<div class="center_box">
			<div class="box">
				<div class="pic_box">
					<img src="app/img/marketing/content7/icon01.png" class="pic">
					<img src="app/img/marketing/content7/pic01.png" class="pic_hover">
					<img src="app/img/marketing/content7/border.png" class="border">
				</div>
				<div class="text">
					<h2>有效的網路行銷</h2>
					<p>完全客製化設計及系統，量身訂做獨一無二的風格網頁。完全客製化、設計及系統，量身訂做獨。完全客製化、設計及系統，量身訂做獨。</p>
				</div>
			</div>
			<div class="box two">
				<div class="pic_box">
					<img src="app/img/marketing/content7/icon02.png" class="pic">
					<img src="app/img/marketing/content7/pic02.png" class="pic_hover">
					<img src="app/img/marketing/content7/border.png" class="border">
					<div class="line01">
						<img src="app/img/marketing/content7/line.png">
					</div>
					<div class="line02">
						<img src="app/img/marketing/content7/line.png">
					</div>
				</div>
				<p class="p">導入人潮</p>
				<p class="p">轉換成訂單</p>
				<div class="text">
					<h2>網站UI/UX設計</h2>
					<p>完全客製化設計及系統，量身訂做獨一無二的風格網頁。完全客製化、設計及系統，量身訂做獨。完全客製化、設計及系統，量身訂做獨。</p>
				</div>
			</div>
			<div class="box">
				<div class="pic_box">
					<img src="app/img/marketing/content7/icon03.png" class="pic">
					<img src="app/img/marketing/content7/pic03.png" class="pic_hover">
					<img src="app/img/marketing/content7/border.png" class="border">
				</div>
				<div class="text">
					<h2>創造正面循環</h2>
					<p>完全客製化設計及系統，量身訂做獨一無二的風格網頁。完全客製化、設計及系統，量身訂做獨。完全客製化、設計及系統，量身訂做獨。</p>
				</div>	
			</div>
		</div>
	</div>
	<div class="phone_area">
		<h1>當網路行銷結合網站UI/UX<br>
		會發生什麼事？</h1>
		<div class="phone_slide_pic_box" >
			<div class="slide_pic" >
				<div class="square">
					<div class="slide_pic_href one">
						<img src="app/img/marketing/content7/mobile/pic01.png">
						<h2>有效的網路行銷</h2>
						<p>完全客製化設計及系統，量身訂做獨一無二的風格網頁。完全客製化、設計及系統，量身訂做獨。完全客製化、設計及系統，量身訂做獨。</p>
					</div>
					<div class="slide_pic_href one">
						<img src="app/img/marketing/content7/mobile/pic02.png">
						<h2>有效的網路行銷</h2>
						<p>完全客製化設計及系統，量身訂做獨一無二的風格網頁。完全客製化、設計及系統，量身訂做獨。完全客製化、設計及系統，量身訂做獨。</p>
					</div>
					<div class="slide_pic_href one">
						<img src="app/img/marketing/content7/mobile/pic03.png">
						<h2>有效的網路行銷</h2>
						<p>完全客製化設計及系統，量身訂做獨一無二的風格網頁。完全客製化、設計及系統，量身訂做獨。完全客製化、設計及系統，量身訂做獨。</p>
					</div>
				</div>	
			</div>
			<div class="cycle-pager"></div>
			<div class="next"></div>
			<div class="prev"></div>
		</div>
	</div>
</div>
<div class="content9">
	<div class="content_area">
		<h1>聯繫我們</h1>
		<div class="title_box">
			<div class="line1"></div>
			<p>本公司設計案件較多，為盡早處理您的專案，請提前詢問或索取估價資訊。</p>
			<div class="line2"></div>
		</div>
		<div class="textContactForm">
			<div class="textContactFormContent">
				<?php echo form_open("Contact/contact_post/")?>
				<div class="leftBox">
					<div class="area">
						<p>您的姓名</p><input type="text" class="name" name="username_Str" placeholder="請填寫您的姓名" required>
					</div>
					<div class="area">
						<p>公司名稱</p><input type="text" class="company" name="company_Str" placeholder="請填寫公司名稱" required>
					</div>	
					<div class="area">
						<p>聯繫電話</p><input type="text" class="telphone" name="phone_Str" placeholder="請填寫聯繫電話" required>
					</div>
					<div class="area">	
						<p>電子郵件</p><input type="text" class="email" name="email_Str" placeholder="請填寫電子郵件" required>
					</div>
					<div class="area">		
						<p>公司地址</p><input type="text" class="address" name="address_Str" placeholder="請填寫公司地址" required>
					</div>
					<div class="area">
						<p>詢問項目</p>
						<select class="need" name="classtype_Str" required>
							<option value="">請選擇詢問項目</option>
							<option value="網站開發">網站開發</option>
							<option value="程式系統開發">程式系統開發</option>
							<option value="美術設計">美術設計</option>
							<option value="網路行銷">網路行銷</option>
							<option value="伺服器租賃">伺服器租賃</option>
							<option value="其它問題">其它問題</option>
						</select>
					</div>
					<div class="area">
						<p>項目細節</p>
						<select class="need_child">
							<option value="先選擇主要項目">先選擇主要項目</option>
						</select>
						<select class="need_child" data-selected="網站開發" style="display:none;">
							<option value="形象網站設計">形象網站設計</option>
							<option value="0元套版網站">0元套版網站</option>
							<option value="購物網站開發">購物網站開發</option>
							<option value="網路平台開發">網路平台開發</option>
						</select>
						<select class="need_child" data-selected="程式系統開發" style="display:none;">
							<option value="程式系統開發">程式系統開發</option>
							<option value="手機App開發">手機App開發</option>
						</select>
						<select class="need_child" data-selected="美術設計" style="display:none;">
							<option value="LOGO/CIS 設計">LOGO/CIS 設計</option>
							<option value="平面設計">平面設計</option>
							<option value="產品包裝設計">產品包裝設計</option>
						</select>
						<select class="need_child" data-selected="網路行銷" style="display:none;">
							<option value="facebook 粉絲團">facebook 粉絲團</option>
							<option value="Google Adwords">Google Adwords</option>
							<option value="網路行銷企劃">網路行銷企劃</option>
						</select>
						<select class="need_child" data-selected="伺服器租賃" style="display:none;">
							<option value="虛擬伺服器租賃">虛擬伺服器租賃</option>
							<option value="雲端主機租賃">雲端主機租賃</option>
							<option value="電子信箱主機租賃">電子信箱主機租賃</option>
							<option value="Google Apps設定">Google Apps設定</option>
						</select>
						<select class="need_child" data-selected="其它問題" style="display:none;">
							<option value="其它問題">其它問題</option>
						</select>
					</div>
					<div class="area phone">
						<span>您的預算：</span>
						<select class="money" name="money_Str">
							<option value="">請選擇預算</option>
							<option value="15萬以下">15萬以下</option>
							<option value="15~25萬">15~25萬</option>
							<option value="25~50萬">25~50萬</option>
							<option value="50~100萬">50~100萬</option>
						</select>
						<div class="textContactFormMoneyFixed">
							預算欄位僅供參考，每個客製化專案皆可依客戶需求給予報價
						</div>
					</div>
				</div>
				<div class="rightBox">
					<textarea name="content_Str" placeholder="我還想補充..."></textarea>
				</div>
				<div class="price_choose">
					<p>預算選擇</p>
					<div class="choose_area">
						<div class="choose_box" data-bgname="text1">
							<h3>15萬以下</h3>
							<div class="circle"><input type="hidden" value="15萬以下"></div>
							<h4 data-bgname="text1">普通或可能導致負面形象</h4>
						</div>
						<div class="line"></div>
						<div class="choose_box" data-bgname="text2">
							<h3>15~25萬</h3>
							<div class="circle"><input type="hidden" value="15~25萬"></div>
							<h4 data-bgname="text2">感到耳目一新</h4>
						</div>
						<div class="line"></div>
						<div class="choose_box" data-bgname="text3">
							<h3>25~50萬</h3>
							<div class="circle"><input type="hidden" value="25~50萬"></div>
							<h4 data-bgname="text3">印象非常深刻的網站</h4>
						</div>
						<div class="line"></div>
						<div class="choose_box" data-bgname="text4">
							<h3>50~100萬</h3>
							<div class="circle"><input type="hidden" value="50~100萬"></div>
							<h4 data-bgname="text4">最極致的設計</h4>
						</div>
					</div>
				</div>
					<input type="submit" value="送出" class="contactSubmit" name="contactSubmit">
					<input type="hidden" name="previous_url_Str" value="<?=$previous_url_Str?>">
				</form>
			</div>
			<!-- Google Code for &#33287;&#25105;&#20497;&#32879;&#32097; Conversion Page -->
			<script type="text/javascript">
			/* <![CDATA[ */
			var google_conversion_id = 1037100439;
			var google_conversion_language = "en";
			var google_conversion_format = "3";
			var google_conversion_color = "ffffff";
			var google_conversion_label = "54GrCKiolVYQl8vD7gM";
			var google_remarketing_only = false;
			/* ]]> */
			</script>
			<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js"></script>
			<noscript style="display:none;"><img style="display:none;" height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1037100439/?label=54GrCKiolVYQl8vD7gM&amp;guid=ON&amp;script=0"/></noscript>
		</div>
	</div>
</div>
<?=$temp['footer_bar']?>
<?=$temp['body_end']?>