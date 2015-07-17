<?=$temp['header_up']?>
<script src="app/js/smooth_scrollerator.js"></script>
<script>
$(function(){
	
	$(document).scroll(function(){
		var window_width = $(window).width();
		var scroll_top = $(document).scrollTop();
		if(scroll_top == 0){
			$('.content2 , .content3' ).removeClass('hover');
		}
		else if(scroll_top >= 700 && scroll_top < 2000){
			$('.content2').addClass('hover');
		}
		else if(scroll_top >= 2000 && scroll_top < 2000){
			$('.content3').addClass('hover');
		}
		else if(scroll_top >= 2000 && scroll_top < 2800){
			$('.content4').addClass('hover');
		}
		else if(scroll_top >= 2800 && scroll_top < 3600){
			$('.content5').addClass('hover');
		}
		else if(scroll_top >= 3400 && scroll_top < 4200){
			$('.content6').addClass('hover');
		}
		else if(scroll_top >=4200 && scroll_top <5000){
			$('.content7').addClass('hover');
		}

	});	
	$('a[href^=#]').click(function () {
		var speed = 500;
		var href = $(this).attr("href");
		var target = $(href == "#" || href == "" ? 'html' : href);
		var position = target.offset().top;
		$("html, body").animate({scrollTop: position}, speed, "swing");
			return false;
	});
	$(document).scroll(function(){
		
		var scroll_top = $(document).scrollTop();
        var scroll_top_height = scroll_top + $(window).height();
		console.log(scroll_top);
		var window_width = $(window).width();
		if(window_width > 700){
			var content_portfolio_top = $('.content1').offset().top;
			var content_portfolio_height_all = $('.content1').heightAll();
			
			if(scroll_top_height >= content_portfolio_top && scroll_top < content_portfolio_top + content_portfolio_height_all)
			{
				var s1 = (scroll_top_height - content_portfolio_top) / 12;
				var s2 = (scroll_top_height - content_portfolio_top) / 3;
				var s3 = (scroll_top_height - content_portfolio_top) / 6;

				$('.content1 .bg1').css('transform', 'translateY(-' + s1 + 'px)');
				$('.content1 .bg2').css('transform', 'translateY(+' + s2 + 'px)');
				$('.content1 .bg3').css('transform', 'translateY(+' + s3 + 'px)');

			}
		}
	});	
	var window_height = $(window).height();
		$('.content1').css('height', window_height);
		$('.content1 .area').css('height', window_height);
		$(window).resize(function(){
			var window_height = $(window).height();
			$('.content1').css('height', window_height);
			$('.content1 .area').css('height', window_height);
		
	});
});
</script>
<?=$temp['header_down']?>
<?=$temp['topheader']?>
<div class="content1">
	<div class="bg1">
		<img src="app/img/server/content1/bg3.png">
	</div>
	<div class="bg2">
		<img src="app/img/server/content1/bg4.png">
	</div>
	<div class="bg3">
		<img src="app/img/server/content1/bg3.png">
	</div>
	<div class="mobile_bg">
		<img src="app/img/server/mobile/bg1.png">
	</div>
	<div class="area">
		<div class="pic1">
			<img src="app/img/server/content1/pic1.png">
		</div>
		<div class="text">
			<h2>提供世界一流的Google雲端伺服器</h2>
			<h2>為企業網站、購物網站和網路平台</h2>	
			<h2>找到完美解決方案！</h2>	
		</div>
		<a href="#content2">
			<div class="arrow">
				<img src="app/img/index/arrow_down.png">	
			</div>
		</a>
	</div>
</div>
<div class="content2" id="content2">
	<div class="area">
		<div class="text_arae">
			<div class="title_pic">
				<img src="app/img/server/content2/text.png">
			</div>
			<img src="app/img/server/content2/mobile/text1.png" class="phone_text1">
			<img src="app/img/server/content2/mobile/text2.png" class="phone_text2">
			<img src="app/img/server/content2/mobile/map.png" class="phone_map">
			<div class="text">
				<p>伺服器最令人擔憂的就是伺服器當機問題，為此我們特別選用全世界前三名的Google Cloud Platform伺服器主機，保證98.8%的不斷線率，伺服器由數萬台雲端伺服器虛擬化而成，任何伺服器發生當機，立刻有其它伺服器即時備援，讓用戶無需擔憂。</p>
				<p>核心架構採Linux作業系統+Apache伺服器+MySQL資料庫+PHP程式語言，具有70%以上的高市佔率不管企業用戶、個人用戶都能感受到穩定的速度與效能。</p>
			</div>
		</div>
		<div class="server">
			<img src="app/img/index/fixed_table/pic5.png">
		</div>
	</div>
</div>
<div class="content3">
	<div class="area">
		<div class="left_box">
			<img src="app/img/server/content3/text.png" class="pc_title">
			<img src="app/img/server/content3/pad_title.png" class="pad_title">
		</div>
		<div class="right_box">
			<div class="box short">
				<div class="item_box">
					<div class="price">
						<p>費用</p>
					</div>
					<div class="item"><p>硬碟容量</p></div>
					<div class="item"><p>流量</p></div>
					<div class="item"><p>共用頻寬</p></div>
					<div class="item"><p>XXXX</p></div>
					<div class="item"><p>XXXX</p></div>
				</div>
			</div>
			<div class="box">
				<img src="app/img/server/content3/pic1.png" class="type">
				<div class="item_box">
					<div class="price">
						<p>NT$<span>8,000</span>/年</p>
					</div>
					<div class="item"><p>40G / 400G</p></div>
					<div class="item"><p>2M / 1T</p></div>
					<div class="item"><p>XXX</p></div>
					<div class="item"><p>XXX</p></div>
					<div class="item"><p>XXX</p></div>
				</div>
			</div>
			<div class="box">
				<img src="app/img/server/content3/pic1.png" class="type">
				<div class="item_box">
					<div class="price">
						<p>NT$<span>8,000</span>/年</p>
					</div>
					<div class="item"><p>40G / 400G</p></div>
					<div class="item"><p>2M / 1T</p></div>
					<div class="item"><p>XXX</p></div>
					<div class="item"><p>XXX</p></div>
					<div class="item"><p>XXX</p></div>
				</div>
			</div>
			<div class="box">
				<img src="app/img/server/content3/pic1.png" class="type">
				<div class="item_box">
					<div class="price">
						<p>NT$<span>8,000</span>/年</p>
					</div>
					<div class="item"><p>40G / 400G</p></div>
					<div class="item"><p>2M / 1T</p></div>
					<div class="item"><p>XXX</p></div>
					<div class="item"><p>XXX</p></div>
					<div class="item"><p>XXX</p></div>
				</div>
			</div>
		</div>
	</div>

</div>
<div class="content4">
	<div class="area">
		<div class="title">
			<img src="app/img/server/content4/text.png">
		</div>
		<img src="app/img/server/content4/pic1.png" class="pic1">
	</div>
</div>
<div class="content5">
	<div class="black_bg">
		<img src="app/img/server/content5/bg2.png" class="bg2">
	</div>
	<div class="area">
		

	</div>
</div>
<div class="content6">
	<div class="area">
		

	</div>
</div>
<div class="content7">
	<div class="area">
		

	</div>
</div>
<?=$temp['footer']?>