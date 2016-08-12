<?=$temp['header_up']?>
<script src="js/tool/cycle2.js"></script>
<script>
Temp.ready(function(){

	$(window).resize(function(){
		location.href = '';
	});

	$(document).scroll(function(){
		var window_width = $(window).width();
		var scroll_top = $(document).scrollTop();
		if(window_width >= 960 && window_width <= 1400){
			if(scroll_top == 0){
				$('.wrapMarketing, .wrapGraphic, .wrapProgram , .portfolio_box1 , .portfolio_box2 , .portfolio_box3 , .portfolio_box4 , #pic_move_pic1 , #pic_move_pic2 , #pic_move_pic3 , #pic_move_pic4' ).removeClass('hover');
					$('.content1').addClass('hover');

			}
			if(scroll_top > 4500 && scroll_top < 6700){
				$('.videoFixed').addClass('hover');
			}
			else if(scroll_top  < 4500)
			{
				$('.videoFixed').removeClass('hover');
			}
			else if(scroll_top  > 6700)
			{
				$('.videoFixed').removeClass('hover');
			}
				
			if(scroll_top >= 1000 && scroll_top < 2000)
			{
				$('.wrapMarketing').addClass('hover');
			}
			else if(scroll_top >= 2000 && scroll_top < 2500)
			{
				$('.wrapGraphic').addClass('hover');
			}
			else if(scroll_top >= 2500 && scroll_top < 3100)
			{
				$('.wrapProgram').addClass('hover');
			}
			else if(scroll_top >= 3100 && scroll_top < 4500)
			{
				$('.portfolio_box1').addClass('hover');
			}
			else if(scroll_top >= 4500 && scroll_top < 5500 )
			{
				$('.portfolio_box2').addClass('hover'); 
			}
			else if(scroll_top >= 5500 && scroll_top < 6500 )
			{
				$('.portfolio_box3').addClass('hover');
			}
			else if(scroll_top >= 6500 && scroll_top < 7200 )
			{
				$('.portfolio_box4').addClass('hover');
			}
			else if(scroll_top >= 7200 && scroll_top < 8000 )
			{
				$('#pic_move_pic1').addClass('hover');
			}
			else if(scroll_top >= 8000 && scroll_top < 8600 )
			{
				$('#pic_move_pic2').addClass('hover');
			}
			// else if(scroll_top >= 8600 && scroll_top < 9000 )
			// {
			// 	$('#pic_move_pic3').addClass('hover');
			// }
			else if(scroll_top >= 8600)
			{
				$('#pic_move_pic4').addClass('hover');
			}
		}
	
		if(window_width > 1400){
				
			if(scroll_top > 4500 && scroll_top < 8500){
				$('.videoFixed').addClass('hover');
			}
			else if(scroll_top  <= 4500){
				$('.videoFixed').removeClass('hover');
			}
			else if(scroll_top  >= 8500){
				$('.videoFixed').removeClass('hover');
			}

			if(scroll_top == 0){
				$('.wrapMarketing, .wrapGraphic, .wrapProgram , .portfolio_box1 , .portfolio_box2 , .portfolio_box3 , .portfolio_box4 , #pic_move_pic1 , #pic_move_pic2 , #pic_move_pic3 , #pic_move_pic4' ).removeClass('hover');
				$('.content1').addClass('hover');

			}

			if(scroll_top >= 1000 && scroll_top < 2000){
				$('.wrapMarketing').addClass('hover');
			}
			else if(scroll_top >= 2000 && scroll_top < 2500){
				$('.wrapGraphic').addClass('hover');
			}
			else if(scroll_top >= 2500 && scroll_top < 3100){
				$('.wrapProgram').addClass('hover');
			}
			else if(scroll_top >= 3100 && scroll_top < 4500){
				$('.portfolio_box1').addClass('hover');
			}
			else if(scroll_top >= 4500 && scroll_top < 5500 ){
				$('.portfolio_box2').addClass('hover');			   
			}
			else if(scroll_top >= 5500 && scroll_top < 6500 ){
				$('.portfolio_box3').addClass('hover');				   
			}
			else if(scroll_top >= 6500 && scroll_top < 8000 ){
				$('.portfolio_box4').addClass('hover'); 
			}
			else if(scroll_top >= 8000 && scroll_top < 9300 ){
				$('#pic_move_pic1').addClass('hover');
			}
			else if(scroll_top >= 9300 && scroll_top < 10000 ){
				$('#pic_move_pic2').addClass('hover');
			}
			else if(scroll_top >= 10000 && scroll_top < 11000 ){
				$('#pic_move_pic3').addClass('hover');
			}
			else if(scroll_top >= 11000){
				$('#pic_move_pic4').addClass('hover');
				   
			}
		}
	});

	var window_height = $(window).height();
	$('.content_start').css('height', window_height);
	
	$(window).resize(function(){
		var window_height = $(window).height();
		$('.content_start').css('height', window_height);
	});

	$(document).on('click', "a[href^='#']", function(){
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

        if(scroll_top == 0 )
        {

			$('.content_title1').removeClass('hover1s hover2s');
			$('.content_title1').addClass('unhover');
			$('.content_start .arrow').css('display' , 'block');
			setTimeout(function(){
				$('.content_start').removeClass('unhover');
				$('.content_start').addClass('hover');
				
			}, 500);
        }
        else if(scroll_top > 0 )
        {
			$('.content_title1').removeClass('unhover');
			$('.content_title1').addClass('hover');
			$('.content_start').removeClass('hover');
			$('.content_start').addClass('unhover');
			$('.content_start .arrow').css('display' , 'none');
        }
		if(scroll_top > 0 )
		{
			$('.index_topHeader').addClass('hover');
			$('.logoFixed').addClass('hover');
			$('.index_topHeader').removeClass('unhover');
			$('.logoFixed').removeClass('unhover');
			$('.scroll_top').addClass('hover');
			$('.scroll_top').removeClass('unhover');

		}
		else if(scroll_top <= 500)
		{

			$('.index_topHeader').addClass('unhover');
			$('.logoFixed').addClass('unhover');
			$('.logoFixed').addClass('hover');
			$('.scroll_top').addClass('unhover');
			
        }	
		
		var window_width = $(window).width();
		if(window_width >= 960){
			var content_portfolio_top = $('.content_portfolio').offset().top;
			var content_portfolio_height_all = $('.content_portfolio').heightAll();
			var cloudy = $('.content_portfolio').heightAll();
			var scroll_top_height = scroll_top + $(window).height();
			 var scroll_top = $(document).scrollTop();

			 //cloudy
			
			if(scroll_top_height >= content_portfolio_top && scroll_top < content_portfolio_top + content_portfolio_height_all)
			{
				var s1 = (scroll_top_height - content_portfolio_top) / 5;
				var s2 = (scroll_top_height - content_portfolio_top) / 5;
				var s3 = (scroll_top_height - content_portfolio_top) / 5;

				$('.content_portfolio .bg1').css('transform', 'translate(0, ' + s1 + 'px)');
				$('.content_portfolio .cloudy').css('transform', 'translate(0, ' + s3 + 'px)');
				/* $('.content_portfolio .portfolio_box3').css('transform', 'translate(0, ' + s1 + 'px)'); */

			}

			//最下方的橫移
			var content_bottom_top = $('.content_bottom').offset().top;
			var content_bottom_height_all = $('.content_bottom').heightAll();

			if(scroll_top_height >= content_bottom_top)
			{
				var s1 = (scroll_top_height - content_bottom_top) * 1.5;
				var s2 = (scroll_top_height - content_bottom_top) / 30;

				$('.content_bottom').addClass('hover');
				$('.content_bottom .service').css('transform', 'translate(-' + s1 + 'px, 0)');

				$('.content_bottom .pic_move').css('transform', 'translate(-' + s1 + 'px, 0)');
				$('.content_bottom .bg1 img').css('transform', 'translate(+' + s2 + 'px, 0)');
				
			}
			else
			{
				$('.content_bottom').removeClass('hover');
			}
		}
    });

	setTimeout(function(){
		if( $(document).scrollTop() !== 0 )
		{
			$(document).scrollTop(0);
			location.href = '';
		}
	}, 500);

	$('a[href=scrollnote]').click(function () {
		var speed = 500;
		var position = $('.wrapContent').offset().top;
	  	$("html, body").animate({scrollTop: position}, speed, "swing");
	});
	$('a[href=scrollportfolio]').click(function () {
		var speed = 1000;
		var position = $('.content_portfolio').offset().top;
	  	$("html, body").animate({scrollTop: position}, speed, "swing");
	});
	$('a[href=scrollcontact]').click(function () {
		var speed = 1500;
		var position = $('.content_bottom').offset().top;
	  	$("html, body").animate({scrollTop: position}, speed, "swing");
	});
	$('a[href=scrollabout]').click(function () {
		var speed = 1500;
		var position = $('.phone_content_bottom').offset().top;
	  	$("html, body").animate({scrollTop: position}, speed, "swing");
	});
	$('a[href=scroll_top]').click(function () {
		var speed = 1000;
		var position = $('.wrap').offset().top;
	  	$("html, body").animate({scrollTop: position}, speed, "swing");
	});

});
</script>
<?=$temp['header_down']?>
<?=$temp['header_bar']?>
<div class="videoFixed">
	<video src="img/goproVideo.mp4" autoplay loop muted>
	</video>
</div>
	<div class="content_start">
		<div class="logo"></div>
		<div class="bg2">fansWoo</div>
		<div class="brush">fansWoo</div>
		<div class="textHome">
			<h2>品牌故事 <b>S</b>tory</h2>
			<p>我們堅持服務有品味的頂級客戶，建立質感超脫的<b class="orange">網站、APP</b>，並以獨家研發的<b class="blue">fansWoo-framework</b>技術，幫助客戶打造一百分的品牌形象！</p>
		</div>
		<div class="textContactBg"></div>
		<div class="oneRightBox">
			<div class="box">
				<img src="img/homePicOne.jpg">
			</div>
			<div class="box">
				<img src="img/homePicTwo.jpg">
			</div>
		</div>
		<div class="wrapper">
			<nav>
				<div class="menu">
					<span class="li">
						<span class="title2">
							<a href="scrollnote" fanswoo-hrefNone>最新趨勢</a>
						</span>
						<a href="scrollnote" fanswoo-hrefNone class="title1">News</a>
					</span>
					<span class="li">
						<span class="title2">
							<a href="scrollportfolio" fanswoo-hrefNone>經典作品</a>
						</span>
						<a href="scrollportfolio" fanswoo-hrefNone class="title1">Portfolio</a>
					</span>
					<span class="li">
						<span class="title2">
							<a href="scrollcontact" fanswoo-hrefNone>服務項目</a>
						</span>
						<a href="scrollcontact" fanswoo-hrefNone class="title1">Service</a>
					</span>
				</div>
				<a href="#wrapMarketing"><img src="img/index/arrow_down.png" class="arrow"></a>	
			</nav>
		</div>
	</div>
	<div class="phone_content_start">
		<div class="bg2"></div>
		<div class="wrapper">
			<div class="logo"></div>
			<div class="nav">
				<div class="menu">
					<span class="li"><span class="title2"><a href="scrollnote" fanswoo-hrefNone>最新趨勢</a></span><span class="title1">About</span></span>
					<span class="li"><span class="title2"><a href="scrollportfolio" fanswoo-hrefNone>經典作品</a></span><span class="title1">Portfolio</span></span>
					<span class="li"><span class="title2"><a href="scrollabout" fanswoo-hrefNone>服務項目</a></span><span class="title1">Service</span></span>
				</div>
				<a href="#wrapMarketing">
					<div class="arrow">
						<img src="img/index/arrow_down.png">	
					</div>
				</a>
			</div>
		</div>
	</div>
	<div class="wrapMarketing" id="wrapMarketing">
		<div class="wrapContent">
			<h4>Notice</h4>
			<h2>客製網站 VS 套版網站</h2>
			<h3>MATTERS NEED ATTENTION</h3>
			<div class="leftContent">
				<div class="textArea">
					<p>預算不足的企業<span class="red">千萬別相信數萬元的客製化網站</span>！真正的客製化網站是由美術設計師、網頁設計師、程式設計師共同設計的，一個月下來的設計成本最少<span class="blue">十萬元以上</span>，而幾萬元的專案連設計師的薪水都不夠付，只能使用套版軟體換幾張圖片充當客製化網站。</p>
				</div>
				<div class="textArea en">
					<h3>架設網站前一定要問清楚的事項！</h3>
					<p>1.黑心公司以數萬元的設計名目出售成本不到一千元的套版軟體</p>
					<p>2.黑心公司通常不提供PHP原始碼，導致其它設計師無法補救與修改</p>
					<p>3.黑心公司鎖住FTP、MySQL帳號不讓使用者使用，網站無法搬移</p>
				</div>
			</div>
		</div>
	</div>
	<div class="wrapGraphic">
		<div class="wrapContent">
			<h4>Customized</h4>
			<h2>真正客製化的網站及APP</h2>
			<h3>TRULY CUSTOMIZED FOR THE ENTERPRISE</h3>
			<div class="leftContent">
				<div class="textArea">
					<p>依客戶預算及需求做客製化設計</p>
					<p>由心出發的UI/UX設計</p>
					<p>堅持7:2:1的黃金比例設計原則</p>
					<p>以使用者體驗為最主要的設計重點</p>
				</div>
				<div class="textArea en">
					<p>According to customer demand guest system design</p>
					<p>Starting from the heart of UI / UX Design</p>
					<p>Adhere 7: design principles golden ratio 1: 2</p>
					<p>To the user experience as the most important design focus</p>
				</div>
			</div>
		</div>
	</div>
	<div class="wrapProgram">
		<div class="wrapContent">
			<h4>Service</h4>
			<h2>為企業提供完整的服務</h2>
			<h3>IN THE CENTER OF THE SYSTEM DEVELOPMENT LIFE</h3>
			<div class="leftContent">
				<div class="textArea">
					<p>您知道嗎？<span class="red">全世界有78%的網站都是賠錢貨</span>！因為設計不良的網站不只無法帶動業績提升，還會造成揮之不去的負面形象！</p>
					<p>想要贏得消費者的青睞，除了<span class="blue">高質感的網站和APP</span>，還需要專業的<span class="orange">網路行銷</span>作推廣，我們提供一條龍式的服務，舉凡網頁設計、CIS設計、LOGO設計、程式設計、手機APP開發、伺服器租賃、網路行銷皆可無縫接軌，幫助企業獲得成功的品牌形象。</p>
				</div>
			</div>
		</div>
	</div>
	<div class="content_portfolio">
		<div class="portfolio_box1">
			<img class="top_title" src="img/index/title.png">
			<img class="cloudy" src="img/index/cloudy.png">
			<img class="bg1" src="img/index/bg1.png">
		</div>
		<div class="phone_portfolio_box1">
			<img class="top_title" src="img/index/mobile/title.png">
			<div class="text">
				<p>我們已成功為這些知名品牌建立高品質的網站，相信我們也能讓你的粉絲驚艷不已！</p>
			</div>
			<img class="cloudy" src="img/index/cloudy.png">
			<img class="bg" src="img/index/bg1.png">
		</div>
		<div class="portfolio_box2">
			<div class="text_box">
				<img class="title" src="img/index/portfolio_box2/index4-08.png">
				<a href="http://web.fanswoo.com/million_roof/  "  target="_blank" class="portfolio_more">
					<p>立即前往</p>
					<img src="img/index/arrow.png">
					<div class="light"></div>
				</a>
			</div>
			<img class="title2" src="img/index/portfolio_box2/index4-09.png">
			<img class="pc" src="img/index/portfolio_box2/pc.png">
			<img class="sun" src="img/index/portfolio_box2/sun.png">
			<img class="cloudy" src="img/index/portfolio_box2/cloudy.png">
		</div>
		<div class="phone_portfolio_box2">
			<div class="text_box">
				<img class="title" src="img/index/portfolio_box2/index4-08.png">
			</div>
			<img class="pc" src="img/index/mobile/pc.png">
			<img class="sun" src="img/index/portfolio_box2/sun.png">
			<a href="http://web.fanswoo.com/million_roof/ "  target="_blank" class="portfolio_more">
				<p>立即前往</p>
				<img src="img/index/arrow.png">
			</a>
		</div>
		<div class="portfolio_box3">
			<img src="img/index/bg2.png" class="bg2">
			<div class="white_bg02"></div>
			<img src="img/index/portfolio_box2/pad_bg.png" class="pad_bg2">
			<img src="img/index/portfolio_box3/title2.png" class="title2">
			<div class="text_box">
				<img src="img/index/portfolio_box3/bg2_pic.png" class="title">
				<a href="http://web.fanswoo.com/ipix/"  target="_blank" class="portfolio_more">
					<p>立即前往</p>
					<img src="img/index/arrow.png">
				</a>
			</div>
		</div>
		<div class="phone_portfolio_box3">
			<img src="img/index/mobile/index_mobile-10.png" class="bg">
			<a href="http://web.fanswoo.com/ipix/"  target="_blank"  class="portfolio_more">
				<p>立即前往</p>
				<img src="img/index/arrow.png">
			</a>
		</div>
		<div class="portfolio_box4">
			<img src="img/index/portfolio_box4/bg4.jpg" class="bg9">
			<img src="img/index/portfolio_box4/people.png" class="people">
			<img src="img/index/portfolio_box4/pad.png" class="pad">
			<img src="img/index/portfolio_box4/text1.png" class="text1">
			<img src="img/index/portfolio_box4/text2.png" class="text2">
			<a href="http://web.fanswoo.com/candace/" target="_blank"  class="portfolio_more">
				<p>立即前往</p>
				<img src="img/index/arrow.png">
			</a>
		</div>
		<div class="phone_portfolio_box4">
			<img src="img/index/mobile/bg2.png" class="bg">
			<a href="http://web.fanswoo.com/candace/" target="_blank"  class="portfolio_more">
				<p>立即前往</p>
				<img src="img/index/arrow.png">
			</a>
		</div>
	</div>
	<div class="content_bottom">
		<div class="bg1">
			<img src="img/index/fixed_table/fixed_bg1_1.png">
		</div>
		<div class="bg2">
			<img src="img/index/fixed_table/fixed_bg3.png">
		</div>
		<div class="service">
			<div class="text_box">
				<h1>RWD客製化網站</h1>
				<h2>打造一個真正能提升業績的網站</h2>
				<p>迅速提升企業形象及產品銷售量
				<br>避免製作導致負面形象的網站！</p>
				<a href="webdesign" target="_blank" class="more">
					<p>了解更多</p>
					<img src="img/index/arrow.png">
					<div class="light"></div>
				</a>
			</div>
			<img src="img/index/fixed_table/pic1.png" class="pic">
		</div>
		<div class="pic_move pic1" id="pic_move_pic1">
			<div class="text_box">
				<h1>美術設計</h1>
				<h2>CIS企業識別、LOGO設計</h2>
				<p>經驗豐富的設計團隊
					<br>以不凡的設計注入非凡的生命</p>
				<a href="graphic" target="_blank" class="more">
					<p>了解更多</p>
					<img src="img/index/arrow.png">
					<div class="light"></div>
				</a>
			</div>
			<img src="img/index/fixed_table/pic2.png" class="pic">
		</div>
		<div class="pic_move pic2" id="pic_move_pic2">
			<div class="text_box">
				<h1>網路行銷</h1>
				<h2>Facebook、Google、Instagram</h2>
				<p>透過Big Data建立行銷大數據
				<br>幫助網站及APP增加來客數</p>
				<a href="marketing" target="_blank" class="more">
					<p>了解更多</p>
					<img src="img/index/arrow.png">
					<div class="light"></div>
				</a>
			</div>
			<img src="img/index/fixed_table/pic3.png" class="pic">
		</div>
		<div class="pic_move pic3" id="pic_move_pic3" style="display:none;">
			<div class="text_box">
				<h1>手機APP</h1>
				<h2>Facebook、Google、Instagram</h2>
				<p>透過Big Data建立行銷大數據
				<br>幫助網站及APP增加來客數</p>
				<a href="marketing" target="_blank" class="more">
					<p>了解更多</p>
					<img src="img/index/arrow.png">
					<div class="light"></div>
				</a>
			</div>
			<img src="img/index/fixed_table/pic4.png" class="pic">
		</div>
		<div class="pic_move pic4" id="pic_move_pic4">
			<div class="text_box">
				<h1>伺服器租賃</h1>
				<h2>Google SSD雲端主機</h2>
				<p>交由專業程式設計團隊開發
				<br>無論iOS、android、webapp皆可製作</p>
				<a href="server" target="_blank" class="more">
					<p>了解更多</p>
					<img src="img/index/arrow.png">
					<div class="light"></div>
				</a>
			</div>
			<img src="img/index/fixed_table/pic5.png" class="pic">
		</div>
	</div>
	<div class="phone_content_bottom">
		<div class="bg1">
			<img src="img/index/fixed_table/fixed_bg1_1.png">
		</div>
		<div class="bg2">
			<img src="img/index/fixed_table/fixed_bg3.png">
		</div>
		<div class="phone_slide_pic_box" >
			<div class="slide_pic" >
				<div class="square">

					<div class="ad_s">			
						<div class="cycle-slideshow"
							data-cycle-slides="> .slide_pic_href" 
							data-cycle-swipe=true
							data-cycle-swipe-fx=scrollHorz
							data-cycle-fx=scrollHorz
							data-cycle-timeout=6000
							data-cycle-prev="img.prev "
							data-cycle-next="img.next "
							data-cycle-pause-on-hover="true"
							>
							<div class="slide_pic_href one">
								<div class="text">
									<h1>RWD客製化網站</h1>
									<h2>打造一個真正能提升業績的網站</h2>
									<p class="in_p">迅速提升企業形象及產品銷售量
										<br>避免製作導致負面形象的網站！</p>
									<a href="graphic"  class="more">
										<p>了解更多</p>
										<img src="img/index/arrow.png">
										<div class="light"></div>
									</a>	
								</div>	
								<img src="img/index/fixed_table/pic1.png" class="pic">	
							</div>
							<div class="slide_pic_href two">
								<div class="text">
									<h1>美術設計</h1>
									<h2>CIS企業識別、LOGO設計</h2>
									<p class="in_p">經驗豐富的設計團隊<br>以不凡的設計注入非凡的生命</p>
									<a href="marketing"  class="more">
										<p>了解更多</p>
										<img src="img/index/arrow.png">
										<div class="light"></div>
									</a>
								</div>
								<img src="img/index/fixed_table/pic2.png" class="pic">
							</div>
							<div class="slide_pic_href three">
								<div class="text">
									<h1>網路行銷</h1>
									<h2>Facebook、Google、Instagram</h2>
									<p class="in_p">透過Big Data建立行銷大數據<br>幫助網站及APP增加來客數</p>
									<a href="graphic"  class="more">
										<p>了解更多</p>
										<img src="img/index/arrow.png">
										<div class="light"></div>
									</a>
								</div>
								<img src="img/index/fixed_table/pic3.png" class="pic">
							</div>
							<div class="slide_pic_href four">
								<div class="text">
									<h1>網路行銷</h1>
									<h2>Facebook、Google、Instagram</h2>
									<p class="in_p">透過Big Data建立行銷大數據<br>幫助網站及APP增加來客數</p>
									<a href="wordpress"  class="more">
										<p>了解更多</p>
										<img src="img/index/arrow.png">
										<div class="light"></div>
									</a>
								</div>
								<img src="img/index/fixed_table/pic4.png" class="pic">
							</div>
							<div class="slide_pic_href five">
								<div class="text">
									<h1>伺服器租賃</h1>
									<h2>Google SSD雲端主機</h2>
									<p class="in_p">交由專業程式設計團隊開發<br>無論iOS、android、webapp皆可製作</p>
									<a href="server"  class="more">
										<p>了解更多</p>
										<img src="img/index/arrow.png">
										<div class="light"></div>
									</a>
								</div>
								<img src="img/index/fixed_table/pic5.png" class="pic">
							</div>
						</div>	
					</div>
				</div>	
			</div>
			<div class="cycle-pager"></div>
			<img src="img/index/mobile/mobile_arrow.png" class="next">
			<img src="img/index/mobile/mobile_arrow.png" class="prev">
		</div>
	</div>

</div>
<?=$temp['footer_bar']?>
<?=$temp['body_end']?>