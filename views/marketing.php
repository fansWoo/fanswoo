<?=$temp['header_up']?>
<script>
$(function(){
	// $(window).resize(function(){
	// 	$(document).scrollTop(0);
	// 	location.href = 'marketing';
	// });
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
	
	$(document).on('click', "a[href^='#']", function(){
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
	
});
</script>
<?=$temp['header_down']?>
<?=$temp['header_bar']?>
<div class="content1">
	<div class="area">
		<div class="pic1">
			<img src="img/marketing/content1/pic1.png">
		</div>
		<div class="text">
			<h2>提供世界一流的Google雲端伺服器</h2>
			<h2>為企業網站、購物網站和網路平台</h2>	
			<h2>找到完美解決方案！</h2>	
		</div>
		<a href="#content2" class="arrow">
			<img src="img/index/arrow_down.png">	
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
				<p>藍海戰略當道，企業以品牌及專業為盾，將價值創新作為行銷策略。但同時，網際網路加快了企業在藍<br>海裡的淘金速度，要避免在洪流中被快速汰替，<br>唯有快、狠、準的鎖定目標眾，才能以有限的<br>廣告預算創造無限商機。
			</div>
			<div class="text short">
				<p>Big Data將使用者行為匯流，透過分析及後台雲端計算，洞察用戶行為，預測商品、金流及物流，透過會說話的數據，讓您永遠走在使用者前端，精準滿足使用者需求，創造<br>2倍以上的收益，再寫如Amazon及Mint.com的傳奇。</p>
			</div>
		</div>
		<div class="bg">
			<img src="img/marketing/content2/bg1.png" class="one">
			<img src="img/marketing/content2/bg2.png" class="two">
			<img src="img/marketing/content2/bg3.png" class="three">
			<img src="img/marketing/content2/bg4.png" class="four">
			<img src="img/marketing/content2/bg5.png" class="five">
			<img src="img/marketing/content2/bg6.png" class="six">
			<img src="img/marketing/content2/bg7.png" class="seven">
			<img src="img/marketing/content2/bg8.png" class="eight">
			<img src="img/marketing/content2/bg9.png" class="nine">
			<img src="img/marketing/content2/bg10.png" class="ten">
			<img src="img/marketing/content2/bg11.png" class="eleven">
			<img src="img/marketing/content2/bg12.png" class="twelve">
			<img src="img/marketing/content2/bg13.png" class="thirteen">
		</div>
	</div>
	<div class="phone_area">
		<div class="text_arae">
			<div class="title">
				<h1>同樣的廣告預算<br>
				如何透過Big Data創造2倍收益？</h1>
			</div>
			<div class="text">
				<p>藍海戰略當道，企業以品牌及專業為盾，將價值創新作為行銷策略。但同時，網際網路加快了企業在藍海裡的淘金速度，要避免在洪流中被快速汰替，唯有快、狠、準的鎖定目標眾，才能以有限的廣告預算創造無限商機。
				</p>
				<p>Big Data將使用者行為匯流，透過分析及後台雲端計算，洞察用戶行為，預測商品、金流及物流，透過會說話的數據，讓您永遠走在使用者前端，精準滿足使用者需求，創造2倍以上的收益，再寫如Amazon及Mint.com的傳奇。
				</p>
			</div>
		</div>
		<div class="bg">
			<img src="img/marketing/content2/bg.png">
		</div>
	</div>
</div>
<div class="content3">
	<div class="area">
		<div class="title_box">
			<img src="img/marketing/content3/title.png">
			<div class="right_text">	
				<h1>Facebook<br> 
				社群行銷的時代！</h1>
			</div>
			<p>全球Facebook用戶量已達16億，單日造訪數更突破十億大關，沒有門檻的大餅人人爭，造成臉書廣告費用日益升高。但，只要用對方法，就能夠以最低廉的成本，在 Facebook上滾出源源不絕的訂單。</p>
		</div>
	
	<div class="item_area">
		<div class="line_box1">
			<img src="img/marketing/content3/line_box.png">
		</div>
		<div class="line_box2">
			<img src="img/marketing/content3/line_box.png">
		</div>
		<div class="line_box3">
			<img src="img/marketing/content3/line_long.png">
		</div>
		<div class="item_box one">
			<div class="pic_box">
				<img src="img/marketing/content3/icon01.png">
			</div>
			<div class="text_box">
				<img src="img/marketing/content3/text01.png">
				<div class="text">
					<p>Facebook能達到91%的目標設定精準度，遠高於其他業者的27%，幫助您精準找出高轉換的目標群眾。</p>
				</div>
			</div>
		</div>
		<div class="item_box two">
			<div class="pic_box">
				<img src="img/marketing/content3/icon02.png">
			</div>
			<div class="text_box">
				<img src="img/marketing/content3/text02.png">
				<div class="text">
					<p>47%的媒體互動發生在行動裝置上，行動上網人口更高達20億。Facebook 的廣告在任何螢幕尺寸上都以全螢幕展示，讓您走在跨螢時代尖端，掌握所有商機。</p>
				</div>
			</div>
		</div>
		<div class="item_box three">
			<div class="pic_box">
				<img src="img/marketing/content3/icon03.png">
			</div>
			<div class="text_box">
				<img src="img/marketing/content3/text03.png">
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
			<img src="img/marketing/content4/line.png">
		</div>
		<div class="hover_area01">
			<div class="start01">
				<img src="img/marketing/content4/pic02.png">
			</div>
			<div class="start02">
				<img src="img/marketing/content4/pic02.png">
			</div>
			<div class="pic01">
				<img src="img/marketing/content4/pic01.png">
			</div>
			<div class="dialog_box one" id="dialog_box_one">
				<div class="number">
					<h3><span data-count="56">0</span>%</h3>
					<p>的用戶表示</p>
				</div>
				<img src="img/marketing/content4/pic03.png">
			</div>
			<div class="window01">
				<img src="img/marketing/content4/window01.png">
			</div>
			<div class="text_area one">
				<h1>貼文廣告</h1>
				<p>不論以行動裝置或電腦瀏覽，全版的貼文廣告，閱讀動線絕對是視覺焦點，讓您100%抓緊使用者目光。</p>
				<img src="img/marketing/content4/icon01.png">
			</div>
		</div>
		<div class="hover_area02">	
			<div class="window02">
				<img src="img/marketing/content4/window02.png">
			</div>
			<div class="hand">
				<img src="img/marketing/content4/hand.png">
			</div>
			<div class="text_area two">
				<h1>讚廣告</h1>
				<p>最多只需要6個人，你就能認識世界上任何一個人。知道朋友跟朋友的朋友在Facebook上關注什麼，能讓企業得到更多人的青睞跟信任，讓更多人為你的企業說讚！</p>
				<img src="img/marketing/content4/icon02.png">
			</div>
			<div class="dialog_box two" id="dialog_box_two">
				<div class="number">
					<h3><span data-count="42">0</span>%</h3>
					<p>的用戶表示</p>
				</div>
				<img src="img/marketing/content4/pic04.png">
			</div>
			<div class="dialog_box three" id="dialog_box_three">
				<div class="number">
					<h3><span data-count="36">0</span>%</h3>
					<p>的用戶表示</p>
				</div>
				<img src="img/marketing/content4/pic05.png">
			</div>
		</div>
	</div>	
	<div class="phone_area">
		<div class="dialog_box01">
			<img src="img/marketing/content4/mobile/dialog_box01.png">
		</div>
		<div class="dialog_box02">
			<img src="img/marketing/content4/mobile/dialog_box02.png">
		</div>
		<div class="dialog_box03">
			<img src="img/marketing/content4/mobile/dialog_box03.png">
		</div>
		<div class="line01">
			<img src="img/marketing/content4/mobile/line01.png">
		</div>
		<div class="line02">
			<img src="img/marketing/content4/mobile/line02.png">
		</div>
		<div class="window01">
			<img src="img/marketing/content4/window01.png">
		</div>
		<div class="window02">
			<img src="img/marketing/content4/window02.png">
		</div>
		<div class="hand">
			<img src="img/marketing/content4/mobile/hand.png">
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
			<img src="img/marketing/content4/icon01.png">
		</div>
		<div class="pic02">
			<img src="img/marketing/content4/icon02.png">
		</div>
	</div>
</div>
<div class="content5">
	<div class="area">
		<div class="title_box">
			<img src="img/marketing/content5/title.png" class="pc_title">
			<img src="img/marketing/content5/title2.png" class="phone_title">
			<div class="right_text">	
				<h1>Google<br> 
				全方位精準行銷</h1>
			</div>
			<p>Google每個月有1080萬位不重複的訪客，單日搜尋次數更高達10億次以上，要在網海戰脫穎而出，絕對不是狂投廣告預算就能達標！</p>
		</div>
		<div class="item_area">
			<div class="line_box1">
				<img src="img/marketing/content3/line_box.png">
			</div>
			<div class="line_box2">
				<img src="img/marketing/content3/line_box.png">
			</div>
			<div class="line_box3">
				<img src="img/marketing/content5/line_long.png">
			</div>
			<div class="item_box one">
				<div class="pic_box">
					<img src="img/marketing/content3/icon04.png">
				</div>
				<div class="text_box ">
					<img src="img/marketing/content5/text01.png">
					<p>要怎麼樣才能在Google搜尋上讓客戶印象深刻？精準投放網頁關鍵字，讓搜尋引擎最佳化，買主不自動上門都很難！</p>
				</div>
			</div>
			<div class="item_box two">
				<div class="pic_box">
					<img src="img/marketing/content3/icon05.png">
				</div>
				<div class="text_box">
					<img src="img/marketing/content5/text02.png">
					<p>您知道對您的企業最有興趣的消費者是哪群人嗎？Google依據消費者搜尋行為和歷史軌跡，針對不同屬性的用戶派送合適的廣告。找到目標客群，把廣告預算花在刀口上，讓您不再虛耗廣告預算！</p>
				</div>
			</div>
			<div class="item_box three">
				<div class="pic_box">
					<img src="img/marketing/content3/icon06.png">
				</div>
				<div class="text_box">
					<img src="img/marketing/content5/text03.png">
					<p>96%的使用者第一次到訪「任何」網站都不會當次轉換，我們記錄曾到訪網站的來客，針對潛在客戶再行銷，讓您的廣告無時無刻、如影隨形出現在客戶身旁，加深品牌印象，提高轉換率！</p>
				</div>
			</div>
		</div>
	</div>	
</div>
<div class="content6">
	<div class="area">
		<div class="text_area">
			<h1>全球的網站都幫您的<br>品牌做廣告</h1>
			<p>您常在YouTube 看影片嗎？常在蘋果日報看新聞嗎？這些熟悉的網站，全都是Google內容聯播網的一員。Google內容聯播網，涵蓋了全台超過兩萬個網站、接觸90%以上的網路使用者，一天曝光超過兩億次！透過廣告聯播，一網打盡不同領域、不同性質的的潛在客戶。</p>
		</div>
		<div class="earth">
			<img src="img/marketing/content6/earth.png">
		</div>
		<div class="computer">
			<img src="img/marketing/content6/computer.png">
		</div>
		<div class="start">
			<img src="img/marketing/content6/start.png">
		</div>
		<div class="bottom_line01">
			<img src="img/marketing/content6/bottom_line01.png">
		</div>
		<div class="bottom_line02">
			<img src="img/marketing/content6/bottom_line02.png">
		</div>
		<div class="bottom_line03">
			<img src="img/marketing/content6/bottom_line03.png">
		</div>
		<div class="bottom_line04">
			<img src="img/marketing/content6/bottom_line04.png">
		</div>
		<div class="phone_line">
			<img src="img/marketing/content6/mobile/line.png">
		</div>
		<div class="phone_line2">
			<img src="img/marketing/content6/mobile/line2.png">
		</div>
		<div class="circle_box one">
			<img src="img/marketing/content6/icon.png">
			<div class="text">
				<h4>鎖定目標客群</h4>
				<p>根據企業需求，把廣告送到你想送的客人面前，直擊目標客群。</p>
			</div>
		</div>
		<div class="circle_box two">
			<img src="img/marketing/content6/icon1.png">
			<div class="text">	
				<h4>廣告形式多元</h4>
				<p>廣告可以文字、圖像、影片、互動式多媒體格式呈現，滿足客戶的新鮮感。</p>
			</div>
		</div>
		<div class="circle_box three">
			<img src="img/marketing/content6/icon2.png">
			<div class="text">		
				<h4>評估廣告效益</h4>
				<p>查看哪些廣告獲得最多點擊，隨時調整，發揮廣告最大效益。</p>
			</div>
		</div>
		<div class="circle_box four">
			<img src="img/marketing/content6/icon3.png">
			<div class="text">		
				<h4>依照成效收費</h4>
				<p>海量曝光完全免費，只有在消費者點擊廣告時您才需要付費。</p>
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
					<img src="img/marketing/content7/icon01.png" class="pic">
					<img src="img/marketing/content7/pic01.png" class="pic_hover">
					<img src="img/marketing/content7/border.png" class="border">
				</div>
				<div class="text">
					<h2>有效的網路行銷</h2>
					<p>網路行銷並不是把商品放上官網，就會有源源不絕的客戶，必須使用對的行銷策略，將有效流量導進網站，為企業創造更多機會。</p>
				</div>
			</div>
			<div class="box two">
				<div class="pic_box">
					<img src="img/marketing/content7/icon02.png" class="pic">
					<img src="img/marketing/content7/pic02.png" class="pic_hover">
					<img src="img/marketing/content7/border.png" class="border">
					<div class="line01">
						<img src="img/marketing/content7/line.png">
					</div>
					<div class="line02">
						<img src="img/marketing/content7/line.png">
					</div>
				</div>
				<p class="p">導入人潮</p>
				<p class="p">轉換成訂單</p>
				<div class="text">
					<h2>網站UI/UX設計</h2>
					<p>網站設計的好壞直接影響跳出率，在意使用者介面、注重使用者體驗的網站，能讓消費者瀏覽時為您在網站中打造的貼心設計驚呼連連，因為這是他們操作過最人性化的網站。</p>
				</div>
			</div>
			<div class="box">
				<div class="pic_box">
					<img src="img/marketing/content7/icon03.png" class="pic">
					<img src="img/marketing/content7/pic03.png" class="pic_hover">
					<img src="img/marketing/content7/border.png" class="border">
				</div>
				<div class="text">
					<h2>創造正面循環</h2>
					<p>量身打造的客製化網頁及行銷策略，能提升企業知名度，吸引更多人流及金流，為企業帶來前所未有的效益。</p>
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
						<img src="img/marketing/content7/mobile/pic01.png">
						<h2>有效的網路行銷</h2>
						<p>網路行銷並不是把商品放上官網，就會有源源不絕的客戶，必須使用對的行銷策略，將有效流量導進網站，為企業創造更多機會。</p>
					</div>
					<div class="slide_pic_href one">
						<img src="img/marketing/content7/mobile/pic02.png">
						<h2>網站UI/UX設計</h2>
						<p>網站設計的好壞直接影響跳出率，在意使用者介面、注重使用者體驗的網站，能讓消費者瀏覽時為您在網站中打造的貼心設計驚呼連連，因為這是他們操作過最人性化的網站。</p>
					</div>
					<div class="slide_pic_href one">
						<img src="img/marketing/content7/mobile/pic03.png">
						<h2>創造正面循環</h2>
						<p>量身打造的客製化網頁及行銷策略，能提升企業知名度，吸引更多人流及金流，為企業帶來前所未有的效益。</p>
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
<?=$temp['contact_content_area']?>
</div>
<?=$temp['footer_bar']?>
<?=$temp['body_end']?>