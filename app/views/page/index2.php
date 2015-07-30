<?=$temp['header_up']?>
<script src="app/js/smooth_scrollerator.js"></script>
<script src="app/js/cycle2.js"></script>

<script>
$(function(){
		$(" .slide_pic > .square").cycle({
				fx      :       "scrollHorz", 
				//fade
				//scrollHorz
				timeout: 0 ,
				speed: 2000,
				manualSpeed: 600,
				slides: ' > .slide_pic_href',
				next: '.next',
				prev: ' .prev',
				
		});
		$(document).scroll(function(){
			var window_width = $(window).width();

			var scroll_top = $(document).scrollTop();
			if(scroll_top == 0){
				$('.wrapMarketing, .wrapGraphic, .wrapProgram , .portfolio_box1 , .portfolio_box2 , .portfolio_box3 , .portfolio_box4 , #pic_move_pic1' ).removeClass('hover');
				$('.content1').addClass('hover');

			}
			if(window_width > 1024 && window_width <= 1400){
				if(scroll_top > 4500 && scroll_top < 6500){
					$('.videoFixed').addClass('hover');
				}
				else if(scroll_top  < 4500){
					$('.videoFixed').removeClass('hover');
				}
				else if(scroll_top  > 6800){
					$('.videoFixed').removeClass('hover');
				}
				
				else if(scroll_top >= 1000 && scroll_top < 2000){
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
				else if(scroll_top >= 4500 && scroll_top < 5000 ){
					$('.portfolio_box2').addClass('hover');
				   
				}
				else if(scroll_top >= 5000 && scroll_top < 7500 ){
					$('.portfolio_box3').addClass('hover');
				   
				}
				else if(scroll_top >= 7500 && scroll_top < 8450 ){
					$('.portfolio_box4').addClass('hover');
				   
				}
				else if(scroll_top >= 8450 && scroll_top < 9400 ){
					$('#pic_move_pic1').addClass('hover');
				   
				}
				else if(scroll_top >= 9400 && scroll_top < 9900 ){
					$('#pic_move_pic2').addClass('hover');
				   
				}
				else if(scroll_top >= 9900 && scroll_top < 10400 ){
					$('#pic_move_pic3').addClass('hover');
				   
				}
				else if(scroll_top >= 10400 && scroll_top < 14050 ){
					$('#pic_move_pic4').addClass('hover');
				   
				}
			}
			if(window_width > 1400){
				if(scroll_top > 5000 && scroll_top < 8500){
					$('.videoFixed').addClass('hover');
				}
				else if(scroll_top  < 5000){
					$('.videoFixed').removeClass('hover');
				}
				else if(scroll_top  > 8500){
					$('.videoFixed').removeClass('hover');
				}
				
				else if(scroll_top >= 1000 && scroll_top < 2000){
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
				else if(scroll_top >= 4500 && scroll_top < 5000 ){
					$('.portfolio_box2').addClass('hover');
				   
				}
				else if(scroll_top >= 5000 && scroll_top < 7500 ){
					$('.portfolio_box3').addClass('hover');
				   
				}
				else if(scroll_top >= 7500 && scroll_top < 8450 ){
					$('.portfolio_box4').addClass('hover');
				   
				}
				else if(scroll_top >= 8450 && scroll_top < 9400 ){
					$('#pic_move_pic1').addClass('hover');
				   
				}
				else if(scroll_top >= 9400 && scroll_top < 9900 ){
					$('#pic_move_pic2').addClass('hover');
				   
				}
				else if(scroll_top >= 9900 && scroll_top < 10400 ){
					$('#pic_move_pic3').addClass('hover');
				   
				}
				else if(scroll_top >= 10400 && scroll_top < 14050 ){
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
	//$(window).resize(function(){
		//$(document).scrollTop(0);
		//location.href = 'page/index2';
	//});
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
		if(scroll_top > 0 )
		{
			$('.index_topHeader').addClass('hover');
			$('.logoFixed').addClass('hover');
			$('.index_topHeader').removeClass('unhover');
			$('.logoFixed').removeClass('unhover');
		}
		else if(scroll_top <= 500)
		{

			$('.index_topHeader').addClass('unhover');
			$('.logoFixed').addClass('unhover');
			$('.logoFixed').addClass('hover');
			
        }	
		
		var window_width = $(window).width();
		if(window_width > 1024){
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
				var s1 = (scroll_top_height - content_bottom_top) * 1.5;
				var s2 = (scroll_top_height - content_bottom_top) / 30;

				$('.content_bottom').addClass('hover');
				$('.content_bottom .service').css('transform', 'translate(-' + s1 + 'px, 0)');
				$('.content_bottom .contact').css('transform', 'translate(-' + s1 + 'px, 0)');

				$('.content_bottom .pic_move').css('transform', 'translate(-' + s1 + 'px, 0)');
				$('.content_bottom .bg1 img').css('transform', 'translate(+' + s2 + 'px, 0)');
				$('.content_bottom .content9').css('transform', 'translate(-' + s1 + 'px, 0)');
			}
			else
			{
				$('.content_bottom').removeClass('hover');
			}
		}
    });
});
</script>
<?=$temp['header_down']?>
<?=$temp['topheader']?>
<div class="videoFixed">
	<video src="app/img/goproVideo.mp4" autoplay loop muted>
	</video>
</div>
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
				<a href="#wrapMarketing"><img src="app/img/index/arrow_down.png" class="arrow"></a>	
			</nav>
		</div>
	</div>
	<div class="phone_content_start">
		<div class="bg2"></div>
		<div class="wrapper">
			<div class="logo"></div>
			<div class="nav">
				<div class="menu">
					<span class="li"><span class="title2">關於我們</span><span class="title1">About</span></span>
					<span class="li"><span class="title2">經典作品</span><span class="title1">Portfolio</span></span>
					<span class="li"><span class="title2">服務項目</span><span class="title1">Service</span></span>
				</div>
				<a href="#wrapMarketing">
					<div class="arrow">
						<img src="app/img/index/arrow_down.png">	
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
		<div class="portfolio_box1">
			<img class="top_title" src="app/img/index/title.png">
			<img class="cloudy" src="app/img/index/cloudy.png">
			<img class="bg1" src="app/img/index/bg1.png">
			<div class="white_bg_out"></div>
		</div>
		<div class="phone_portfolio_box1">
			<img class="top_title" src="app/img/index/mobile/title.png">
			<div class="text">
				<p>我們已成功為這些知名品牌建立高品質的網站，相信我們也能讓你的粉絲驚艷不已！</p>
			</div>
			<img class="cloudy" src="app/img/index/cloudy.png">
			<img class="bg" src="app/img/index/bg1.png">
		</div>
		<div class="portfolio_box2">
			<div class="text_box">
				<img class="title" src="app/img/index/portfolio_box2/index4-08.png">
				<a href=""  class="portfolio_more">
					<p>立即前往</p>
					<img src="app/img/index/arrow.png">
					<div class="light"></div>
				</a>
			</div>
			<img class="title2" src="app/img/index/portfolio_box2/index4-09.png">
			<img class="pc" src="app/img/index/portfolio_box2/pc.png">
			<img class="sun" src="app/img/index/portfolio_box2/sun.png">
			<img class="cloudy" src="app/img/index/portfolio_box2/cloudy.png">
			<div class="white_bg01"></div>
		</div>
		<div class="phone_portfolio_box2">
			<div class="text_box">
				<img class="title" src="app/img/index/portfolio_box2/index4-08.png">
			</div>
			<img class="pc" src="app/img/index/mobile/pc.png">
			<img class="sun" src="app/img/index/portfolio_box2/sun.png">
			<a href=""  class="portfolio_more">
				<p>立即前往</p>
				<img src="app/img/index/arrow.png">
			</a>
		</div>
		<div class="portfolio_box3">
			<div class="white_bg01"></div>
			<img src="app/img/index/bg2.png" class="bg2">
			<div class="white_bg02"></div>
			<img src="app/img/index/portfolio_box2/pad_bg.png" class="pad_bg2">
			<img src="app/img/index/portfolio_box3/title2.png" class="title2">
			<div class="text_box">
				<img src="app/img/index/portfolio_box3/bg2_pic.png" class="title">
				<a href=""  class="portfolio_more">
					<p>立即前往</p>
					<img src="app/img/index/arrow.png">
				</a>
			</div>
		</div>
		<div class="phone_portfolio_box3">
			<img src="app/img/index/mobile/index_mobile-10.png" class="bg">
			<a href=""  class="portfolio_more">
				<p>立即前往</p>
				<img src="app/img/index/arrow.png">
			</a>
		</div>
		<div class="portfolio_box4">
			<img src="app/img/index/portfolio_box4/bg4.jpg" class="bg9">
			<img src="app/img/index/portfolio_box4/people.png" class="people">
			<img src="app/img/index/portfolio_box4/pad.png" class="pad">
			<img src="app/img/index/portfolio_box4/text1.png" class="text1">
			<img src="app/img/index/portfolio_box4/text2.png" class="text2">
			<a href=""  class="portfolio_more">
				<p>立即前往</p>
				<img src="app/img/index/arrow.png">
			</a>
		</div>
		<div class="phone_portfolio_box4">
			<img src="app/img/index/mobile/bg2.png" class="bg">
			<a href=""  class="portfolio_more">
				<p>立即前往</p>
				<img src="app/img/index/arrow.png">
			</a>
		</div>
	</div>
	<div class="content_bottom">
		<div class="bg1">
			<img src="app/img/index/fixed_table/fixed_bg1_1.png">
		</div>
		<div class="bg2">
			<img src="app/img/index/fixed_table/fixed_bg3.png">
		</div>
		<div class="service">
			<div class="text_box">
				<img src="app/img/index/fixed_table/text1.png" class="text">
			</div>
			<img src="app/img/index/fixed_table/pic1.png" class="pic">
		</div>
		<div class="pic_move pic1" id="pic_move_pic1">
			<div class="text_box">
				<img src="app/img/index/fixed_table/text2.png" class="text">
				<a href=""  class="more">
					<p>了解更多</p>
					<img src="app/img/index/arrow.png">
					<div class="light"></div>
				</a>
			</div>
			<img src="app/img/index/fixed_table/pic2.png" class="pic">
		</div>
		<div class="pic_move pic2" id="pic_move_pic2">
			<div class="text_box">
				<img src="app/img/index/fixed_table/text3.png" class="text">
				<a href=""  class="more">
					<p>了解更多</p>
					<img src="app/img/index/arrow.png">
					<div class="light"></div>
				</a>
			</div>
			<img src="app/img/index/fixed_table/pic3.png" class="pic">
		</div>
		<div class="pic_move pic3" id="pic_move_pic3">
			<div class="text_box">
				<img src="app/img/index/fixed_table/text4.png" class="text">
				<a href=""  class="more">
					<p>了解更多</p>
					<img src="app/img/index/arrow.png">
					<div class="light"></div>
				</a>
			</div>
			<img src="app/img/index/fixed_table/pic4.png" class="pic">
		</div>
		<div class="pic_move pic4" id="pic_move_pic4">
			<div class="text_box">
				<img src="app/img/index/fixed_table/text5.png" class="text">
				<a href=""  class="more">
					<p>了解更多</p>
					<img src="app/img/index/arrow.png">
					<div class="light"></div>
				</a>
			</div>
			<img src="app/img/index/fixed_table/pic5.png" class="pic">
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
						<div class="leftBox">
							<div class="area">
								<p>您的姓名</p><input type="text" class="name" name="name" placeholder="請填寫您的姓名">
							</div>
							<div class="area">
								<p>公司名稱</p><input type="text" class="company" name="company" placeholder="請填寫公司名稱">
							</div>	
							<div class="area">
								<p>聯繫電話</p><input type="text" class="telphone" name="telphone" placeholder="請填寫聯繫電話">
							</div>
							<div class="area">	
								<p>電子郵件</p><input type="text" class="email" name="email" placeholder="請填寫電子郵件">
							</div>
							<div class="area">		
								<p>公司地址</p><input type="text" class="address" name="address" placeholder="請填寫公司地址">
							</div>
							<div class="area">
								<p>詢問項目</p>
								<select class="need" name="need">
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
								<select class="need_child" name="need_child">
									<option value="先選擇主要項目">先選擇主要項目</option>
								</select>
								<select class="need_child" name="need_child" data-selected="網站開發" style="display:none;">
									<option value="形象網站設計">形象網站設計</option>
									<option value="0元套版網站">0元套版網站</option>
									<option value="購物網站開發">購物網站開發</option>
									<option value="網路平台開發">網路平台開發</option>
								</select>
								<select class="need_child" name="need_child" data-selected="程式系統開發" style="display:none;">
									<option value="程式系統開發">程式系統開發</option>
									<option value="手機App開發">手機App開發</option>
								</select>
								<select class="need_child" name="need_child" data-selected="美術設計" style="display:none;">
									<option value="LOGO/CIS 設計">LOGO/CIS 設計</option>
									<option value="平面設計">平面設計</option>
									<option value="產品包裝設計">產品包裝設計</option>
								</select>
								<select class="need_child" name="need_child" data-selected="網路行銷" style="display:none;">
									<option value="facebook 粉絲團">facebook 粉絲團</option>
									<option value="Google Adwords">Google Adwords</option>
									<option value="網路行銷企劃">網路行銷企劃</option>
								</select>
								<select class="need_child" name="need_child" data-selected="伺服器租賃" style="display:none;">
									<option value="虛擬伺服器租賃">虛擬伺服器租賃</option>
									<option value="雲端主機租賃">雲端主機租賃</option>
									<option value="電子信箱主機租賃">電子信箱主機租賃</option>
									<option value="Google Apps設定">Google Apps設定</option>
								</select>
								<select class="need_child" name="need_child" data-selected="其它問題" style="display:none;">
									<option value="其它問題">其它問題</option>
								</select>
							</div>
							<div class="area phone">
								<span>您的預算：</span>
								<select class="money" name="money">
									<option value="">請選擇預算</option>
									<option value="15萬元以下">15萬元以下</option>
									<option value="15萬元~30萬元">15萬元~30萬元</option>
									<option value="30萬元~50萬元">30萬元~50萬元</option>
									<option value="50萬元~100萬元">50萬元~100萬元</option>
									<option value="100萬元~200萬元">100萬元~200萬元</option>
									<option value="200萬元以上">200萬元以上</option>
								</select>
								<div class="textContactFormMoneyFixed">
									預算欄位僅供參考，每個客製化專案皆可依客戶需求給予報價
								</div>
							</div>
						</div>
						<div class="rightBox">
							<textarea name="text" placeholder="我還想補充..."></textarea>
						</div>
						<div class="price_choose">
							<p>預算選擇</p>
							<div class="choose_area">
								<div class="choose_box" data-bgname="text1">
									<h3>15萬以下</h3>
									<div class="circle"></div>
									<h4 data-bgname="text1">普通或可能導致負面形象</h4>
								</div>
								<div class="line"></div>
								<div class="choose_box" data-bgname="text2">
									<h3>15~25萬</h3>
									<div class="circle"></div>
									<h4 data-bgname="text2">感到耳目一新</h4>
								</div>
								<div class="line"></div>
								<div class="choose_box" data-bgname="text3">
									<h3>25~50萬</h3>
									<div class="circle"></div>
									<h4 data-bgname="text3">印象非常深刻的網站</h4>
								</div>
								<div class="line"></div>
								<div class="choose_box" data-bgname="text4">
									<h3>50~100萬</h3>
									<div class="circle"></div>
									<h4 data-bgname="text4">最極致的設計</h4>
								</div>
							</div>
						</div>
						<input type="submit" value="送出" class="contactSubmit" name="contactSubmit">
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
	</div>
	<div class="phone_content_bottom">
		<div class="bg1">
			<img src="app/img/index/fixed_table/fixed_bg1_1.png">
		</div>
		<div class="bg2">
			<img src="app/img/index/fixed_table/fixed_bg3.png">
		</div>
		<div class="phone_slide_pic_box" >
			<div class="slide_pic" >
				<div class="square">
					<div class="slide_pic_href one">
						<div class="text">
							<h1>客製化服務<br>打造專屬於您的網站</h1>
							<p>完全客製化設計及系統，量身訂做獨一無二的風格網頁。完全客製化、設計及系統，量身訂做獨。完全客製化、設計及系統，量身訂做獨。</p>
						</div>
						<img src="app/img/index/fixed_table/pic1.png" class="pic">
						
					</div>
					<div class="slide_pic_href two">
						<div class="text">
							<h1>美術設計</h1>
							<p>我們受邀協助設計中華民國經濟部能源局與工研院合作的太陽能推廣專。源局與工研院合作的。</p>
						</div>
						<img src="app/img/index/fixed_table/pic2.png" class="pic">
					</div>
					<div class="slide_pic_href three">
						<div class="text">
							<h1>客製化網站</h1>
							<p>我們受邀協助設計中華民國經濟部能源局與工研院合作的太陽能推廣專。源局與工研院合作的。</p>
						</div>
						<img src="app/img/index/fixed_table/pic3.png" class="pic">
					</div>
					<div class="slide_pic_href four">
						<div class="text">
							<h1>0元套版網站<br>打造專屬於您的網站</h1>
							<p>我們受邀協助設計中華民國經濟部能源局與工研院合作的太陽能推廣專。源局與工研院合作的。</p>
						</div>
						<img src="app/img/index/fixed_table/pic4.png" class="pic">
					</div>
					<div class="slide_pic_href five">
						<div class="text">
							<h1>客製化服務<br>打造專屬於您的網站</h1>
							<p>我們受邀協助設計中華民國經濟部能源局與工研院合作的太陽能推廣專。源局與工研院合作的。</p>
						</div>
						<img src="app/img/index/fixed_table/pic5.png" class="pic">
					</div>
				</div>	
			</div>
			<div class="cycle-pager"></div>
			<img src="app/img/index/mobile/mobile_arrow.png" class="next">
			<img src="app/img/index/mobile/mobile_arrow.png" class="prev">
		</div>
	</div>
	<!--<div class="phone_contact">
		<div class="title">
			<h1>請提早聯繫我們</h1>
			<p>本公司設計案件較多</p>
			<p>為盡早處理您的專案，請提前詢問或索取估價資訊</p>
		</div>
		<div class="textContactForm">
			<div class="textContactFormContent">
				<div class="leftBox">
					<div class="area">
						<span>詢問項目：</span>
						<select class="need" name="need">
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
						<span>項目細節：</span>
						<select class="need_child" name="need_child">
							<option value="先選擇主要項目">先選擇主要項目</option>
						</select>
						<select class="need_child" name="need_child" data-selected="網站開發" style="display:none;">
							<option value="形象網站設計">形象網站設計</option>
							<option value="0元套版網站">0元套版網站</option>
							<option value="購物網站開發">購物網站開發</option>
							<option value="網路平台開發">網路平台開發</option>
						</select>
						<select class="need_child" name="need_child" data-selected="程式系統開發" style="display:none;">
							<option value="程式系統開發">程式系統開發</option>
							<option value="手機App開發">手機App開發</option>
						</select>
						<select class="need_child" name="need_child" data-selected="美術設計" style="display:none;">
							<option value="LOGO/CIS 設計">LOGO/CIS 設計</option>
							<option value="平面設計">平面設計</option>
							<option value="產品包裝設計">產品包裝設計</option>
						</select>
						<select class="need_child" name="need_child" data-selected="網路行銷" style="display:none;">
							<option value="facebook 粉絲團">facebook 粉絲團</option>
							<option value="Google Adwords">Google Adwords</option>
							<option value="網路行銷企劃">網路行銷企劃</option>
						</select>
						<select class="need_child" name="need_child" data-selected="伺服器租賃" style="display:none;">
							<option value="虛擬伺服器租賃">虛擬伺服器租賃</option>
							<option value="雲端主機租賃">雲端主機租賃</option>
							<option value="電子信箱主機租賃">電子信箱主機租賃</option>
							<option value="Google Apps設定">Google Apps設定</option>
						</select>
						<select class="need_child" name="need_child" data-selected="其它問題" style="display:none;">
							<option value="其它問題">其它問題</option>
						</select>
					</div>
					<div class="area">
						<span>您的預算：</span>
						<select class="money" name="money">
							<option value="">請選擇預算</option>
							<option value="15萬元以下">15萬元以下</option>
							<option value="15萬元~30萬元">15萬元~30萬元</option>
							<option value="30萬元~50萬元">30萬元~50萬元</option>
							<option value="50萬元~100萬元">50萬元~100萬元</option>
							<option value="100萬元~200萬元">100萬元~200萬元</option>
							<option value="200萬元以上">200萬元以上</option>
						</select>
						<div class="textContactFormMoneyFixed">
							預算欄位僅供參考，每個客製化專案皆可依客戶需求給予報價
						</div>
					</div>
				</div>
				<div class="rightBox">
					
					<p>您的姓名：<input type="text" class="name" name="name" placeholder="請填寫您的姓名"></p>
					<p>公司名稱：<input type="text" class="company" name="company" placeholder="請填寫公司名稱"></p>
					<p>聯繫電話：<input type="text" class="telphone" name="telphone" placeholder="請填寫聯繫電話"></p>
					<p>電子郵件：<input type="text" class="email" name="email" placeholder="請填寫電子郵件"></p>
					<p>公司地址：<input type="text" class="address" name="address" placeholder="請填寫公司地址"></p>
					<textarea name="text"></textarea>
					<p style="text-align:center;">本公司設計案件較多，為盡早處理您的專案，請提前詢問及索取報價資訊。</p>
					<input type="submit" value="送出" class="contactSubmit" name="contactSubmit">
				</div>
				</form>
			</div>
			<!-- Google Code for &#33287;&#25105;&#20497;&#32879;&#32097; Conversion Page 
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
	</div>-->
</div>
<?=$temp['footer']?>