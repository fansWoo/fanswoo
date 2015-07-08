<?=$temp['header_up']?>
<script src="app/js/smooth_scrollerator.js"></script>
<script>
$(function(){
	var window_height = $(window).height();
	$('.content_start').css('height', window_height);
	$(window).resize(function(){
		var window_height = $(window).height();
		$('.content_start').css('height', window_height);
	});
	$('a[href^=#]').click(function () {
		var speed = 500;
		var href = $(this).attr("href");
		var target = $(href == "#" || href == "" ? 'html' : href);
		var position = target.offset().top;
		$("html, body").animate({scrollTop: position}, speed, "swing");
			return false;
	});
	if($(document).scrollTop() !== 0)
	{
		$(document).scrollTop(0);
		location.href = 'page/index2';
	}
	$(window).resize(function(){
		$(document).scrollTop(0);
		location.href = 'page/index2';
	});
	$(document).scroll(function(){
        var scroll_top = $(document).scrollTop();
        var scroll_top_height = scroll_top + $(window).height();
		console.log(scroll_top);

        if(scroll_top == 0 )
        {

			$('.content_plan .plan').css('display', 'none');
			$('.content_plan .content').css('display', 'none');

			$('.content_title1').removeClass('hover1s hover2s');
			$('.content_title1').addClass('unhover');
			setTimeout(function(){
				$('.content_start').removeClass('unhover');
				$('.content_start').addClass('hover');
			}, 500);
        }
        else if(scroll_top > 0 && scroll_top < 500)
        {
			$('.content_title1').removeClass('unhover');
			$('.content_title1').addClass('hover');
			$('.content_start').removeClass('hover');
			$('.content_start').addClass('unhover');
        }

   //      var content_plan_top = $('.content_plan').offset().top;
   //      var content_plan_height_all = $('.content_plan').heightAll();
        
   //      if(scroll_top_height >= content_plan_top && scroll_top < content_plan_top + content_plan_height_all)
   //      {

			// $('.content_plan .plan').css('display', 'block');
			// $('.content_plan .content').css('display', 'block');

			// var s1 = (scroll_top_height - content_plan_top) / 3;
			// var s2 = (scroll_top_height - content_plan_top) / 2;
			// var s3 = (scroll_top_height - content_plan_top) / 8;

			// $('.content_plan .plan').css('transform', 'translate(-' + s2 + 'px, ' + s1 + 'px)');
			// $('.content_plan .content').css('transform', 'translate(0, -' + s3 + 'px)');

   //      }

   //      var content_color_top = $('.content_color').offset().top;
   //      var content_color_height_all = $('.content_color').heightAll();
        
   //      if(scroll_top_height >= content_color_top && scroll_top < content_color_top + content_color_height_all)
   //      {

			// $('.content_plan .plan').css('display', 'none');
			// $('.content_plan .content').css('display', 'none');

			// var s1 = (scroll_top_height - content_color_top) / 3;
			// var s2 = (scroll_top_height - content_color_top) / 2;
			// var s3 = (scroll_top_height - content_color_top) / 8;

			// $('.content_color .plan').css('transform', 'translate(-' + s2 + 'px, ' + s1 + 'px)');
			// $('.content_color .content').css('transform', 'translate(0, -' + s3 + 'px)');

   //      }

        var content_portfolio_top = $('.content_portfolio').offset().top;
        var content_portfolio_height_all = $('.content_portfolio').heightAll();
        
        if(scroll_top_height >= content_portfolio_top && scroll_top < content_portfolio_top + content_portfolio_height_all)
        {
			var s1 = (scroll_top_height - content_portfolio_top) / 5;
			var s2 = (scroll_top_height - content_portfolio_top) / 5;

			$('.content_portfolio .bg1').css('transform', 'translate(0, ' + s1 + 'px)');
			$('.content_portfolio .portfolio_box3').css('transform', 'translate(0, ' + s1 + 'px)');

        }

        var content_bottom_top = $('.content_bottom').offset().top;
        var content_bottom_height_all = $('.content_bottom').heightAll();

        if(scroll_top_height >= content_bottom_top)
        {
			var s1 = (scroll_top_height - content_bottom_top) / 2;

			$('.content_bottom').addClass('hover');
			$('.content_bottom .service').css('transform', 'translate(-' + s1 + 'px, 0)');
			$('.content_bottom .contact').css('transform', 'translate(-' + s1 + 'px, 0)');

			$('.content_bottom .pic_move').css('transform', 'translate(-' + s1 + 'px, 0)');
        }
        else
        {
			$('.content_bottom').removeClass('hover');
        }
    });
});
</script>
<?=$temp['header_down']?>
	<div class="content_start">
		<div class="logo"></div>
		<div class="bg2">fansWoo</div>
		<div class="brush">fansWoo</div>
		<div class="textHome">
			<h2>品牌故事 <b>S</b>tory</h2>
			<p>我們堅持服務有品味的頂級客戶，以獨家研發的<b class="blue">fanScript</b>技術，以質感超脫的設計感融入<b class="orange">網頁設計</b>作品，幫助客戶打造一百分的品牌形象！</p>
		</div>
		<div class="textContactBg"></div>
		<div class="oneRightBox">
			<div class="box">
				<img src="<?=base_url("app/img/homePicOne.jpg")?>">
			</div>
			<div class="box">
				<img src="app/img/homePicTwo.jpg">
			</div>
		</div>
		<div class="wrapper">
			<nav>
				<div class="menu">
					<span class="li"><span class="title2">關於我們</span><span class="title1">About</span></span>
					<span class="li"><span class="title2">經典作品</span><span class="title1">Portfolio</span></span>
					<span class="li"><span class="title2">服務項目</span><span class="title1">Service</span></span>
				</div>
				<a href="#wrapMarketing"><img src="app/img/index/arrow.png" class="arrow"></a>	
			</nav>
		</div>
	</div>
	<div class="wrapMarketing" id="wrapMarketing">
		<div class="wrapContent">
			<h4>Notice</h4>
			<h2>客製網站 VS 套版網站</h2>
			<h3>MATTERS NEED ATTENTION</h3>
			<div class="leftContent">
				<div class="textArea">
					<p>預算不足的企業<span class="orange">千萬別相信數萬元的客製化網站</span>！真正的客製化網站是由美術設計師、網頁設計師、程式設計師共同設計的，一個月下來的設計成本最少十萬元以上，而幾萬元的專案連設計師的薪水都不夠付，只能拿套版軟體換幾張圖片充當客製化網站。</p>
					<p>為杜絕黑心設計公司欺騙消費者，我們不僅為企業設計<span class="blue">真正的客製化網站</span>，而且還<span class="red">免費提供擁有數十萬種版型的套版軟體</span>供小型企業使用，使用者僅需負擔主機費用，不需支付任何設計費，讓小型企業得以用最低成本擁有簡易網站。</p>
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
			<h2>真正為企業客製化的網站</h2>
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
					<p>您知道嗎？全世界有78%的網站都是賠錢貨！因為設計不良的網站不只無法帶動業績提升，還會造成揮之不去的負面形象！</p>
					<p>想要透過網路贏得消費者的青睞，除了<span class="orange">高質感的網站</span>，還需要專業的<span class="red">網路行銷</span>作推廣，我們提供一條龍式的服務，舉凡網頁設計、LOGO設計、產品包裝設計、海報設計、程式設計、手機程式設計、伺服器租賃、網路行銷皆可無縫接軌，幫助企業獲得成功的品牌形象。</p>
				</div>
			</div>
		</div>
	</div>
	<div class="content_portfolio">
		<img class="top_title" src="app/img/index/title.png">
		<div class="portfolio_box1">
			<img class="cloudy" src="app/img/index/cloudy.png">
			<img class="bg1" src="app/img/index/bg1.png">
		</div>
		<div class="portfolio_box2">
			<div class="text_box">
				<img class="title" src="app/img/index/portfolio_box2/index4-08.png">
				<div class="button"></div>
			</div>
			<img class="title2" src="app/img/index/portfolio_box2/index4-09.png">
			<img class="pc" src="app/img/index/portfolio_box2/pc.png">
			<img class="sun" src="app/img/index/portfolio_box2/sun.png">
			<img class="cloudy" src="app/img/index/portfolio_box2/cloudy.png">
		</div>
		<div class="portfolio_box3">
			<img src="app/img/index/bg2.jpg" class="bg2">
			<img src="app/img/index/portfolio_box3/bg2_pic.png" class="title">
			<img src="app/img/index/portfolio_box3/title2.png" class="title2">
		</div>
		<div class="portfolio_box4">
			<img src="app/img/index/index4-13.png" class="bg3">
		</div>
	</div>
	<div class="content_bottom">
		<div class="bg1">
			<img src="app/img/index/fixed_bg1_1.png">
		</div>
		<div class="bg2">
			<img src="app/img/index/fixed_bg2.png">
		</div>
		<div class="service">
			<img src="app/img/index/content_question_pic3.png">
		</div>
		<div class="pic_move pic1">
			<img src="app/img/index/content_question_pic2.png">
		</div>
		<div class="pic_move pic2">
			<img src="app/img/index/content_question_pic1.png">
		</div>
		<div class="pic_move pic3">
			<img src="app/img/index/content_question_pic2.png">
		</div>
		<div class="contact">
			<img src="app/img/index/content_question_pic3.png">
		</div>
	</div>
</div>
</body>
</html>