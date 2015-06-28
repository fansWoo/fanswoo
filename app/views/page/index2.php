<?=$temp['header_up']?>
<script src="app/js/smooth_scrollerator.js"></script>
<script>
$(function(){
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

        var content_question1_top = $('.content_question1').offset().top;
        var content_question1_height_all = $('.content_question1').heightAll();
        
        if(scroll_top_height >= content_question1_top && scroll_top < content_question1_top + content_question1_height_all)
        {
			var s1 = (scroll_top_height - content_question1_top) * 1.65;
			var s2 = (scroll_top_height - content_question1_top) / 5;
			var s3 = (scroll_top_height - content_question1_top) / 1.2;
			var s4 = (scroll_top_height - content_question1_top) / 1.3;
			var s5 = (scroll_top_height - content_question1_top) / 1.4;

			$('.content_question1 .pic_move').css('transform', 'translate(0, ' + s1 + 'px) scale(1.5)');

			$('.content_question1 .title_move').css('transform', 'translate(0, -' + s2 + 'px)');

			$('.content_question1 .star1').css('transform', 'translate(0, ' + s3 + 'px)');
			$('.content_question1 .star3').css('transform', 'translate(0, ' + s4 + 'px)');
			$('.content_question1 .star2').css('transform', 'translate(0, ' + s5 + 'px)');
			$('.content_question1 .star4').css('transform', 'translate(0, ' + s3 + 'px)');
			$('.content_question1 .star5').css('transform', 'translate(0, ' + s4 + 'px)');
			$('.content_question1 .star6').css('transform', 'translate(0, ' + s5 + 'px)');
			$('.content_question1 .star7').css('transform', 'translate(0, ' + s3 + 'px)');

        }

        var content_bottom_top = $('.content_bottom').offset().top;
        var content_bottom_height_all = $('.content_bottom').heightAll();

        if(scroll_top >= content_bottom_top)
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
		<div class="bg1">fansWoo</div>
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
			</nav>
		</div>
	</div>
	<div class="content_question1">
		<div class="star1">
			<img src="app/img/index/star1.png">
		</div>
		<div class="star2">
			<img src="app/img/index/star2.png">
		</div>
		<div class="star3">
			<img src="app/img/index/star3.png">
		</div>
		<div class="star4">
			<img src="app/img/index/star4.png">
		</div>
		<div class="star5">
			<img src="app/img/index/star1.png">
		</div>
		<div class="star6">
			<img src="app/img/index/star2.png">
		</div>
		<div class="star7">
			<img src="app/img/index/star3.png">
		</div>
		<div class="pic_move pic1">
			<img src="app/img/index/content_question_pic1.png">
		</div>
		<div class="pic_move pic2">
			<img src="app/img/index/content_question_pic2.png">
		</div>
		<div class="pic_move pic3">
			<img src="app/img/index/content_question_pic3.png">
		</div>
		<div class="title_move title1">
			<p>你正在煩惱這些問題嗎？</p>
			<p>想要避免客源繼續流失？</p>
			<p>找了好幾間設計公司？</p>
			<p>重做了無數個網站都不滿意？</p>
		</div>
		<div class="title_move title2">
			<p>你正在煩惱這些問題嗎？</p>
			<p>想要避免客源繼續流失？</p>
			<p>找了好幾間設計公司？</p>
			<p>重做了無數個網站都不滿意？</p>
		</div>
		<div class="title_move title3">
			<p>你正在煩惱這些問題嗎？</p>
			<p>想要避免客源繼續流失？</p>
			<p>找了好幾間設計公司？</p>
			<p>重做了無數個網站都不滿意？</p>
		</div>
	</div>
	<div class="content_question2">
		<div class="title">fansWoo是你解決問題的好幫手</div>
	</div>
	<div class="content_color">
		<div class="title">fansWoo將為你的品牌填上色彩</div>
	</div>
	<div class="content_woo">
		<div class="title">fansWoo將為你的品牌填上色彩</div>
	</div>
	<div class="content_portfolio">
		<h2 style="display: block; width: 200px; margin: 100px auto; font-size: 30px;">合作案例</h2>
		<div class="million_roof">
			<img src="app/img/index/browser1.jpg">
		</div>
		<div class="gopro">
			<img src="app/img/index/browser2.jpg">
		</div>
		<div class="candace">
			<img src="app/img/index/browser1.jpg">
		</div>
	</div>
	<div class="content_bottom">
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