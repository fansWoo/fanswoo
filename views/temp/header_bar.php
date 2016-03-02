<script>(function() {
	var _fbq = window._fbq || (window._fbq = []);
	if (!_fbq.loaded) {
	var fbds = document.createElement('script');
	fbds.async = true;
	fbds.src = '//connect.facebook.net/en_US/fbds.js';
	var s = document.getElementsByTagName('script')[0];
	s.parentNode.insertBefore(fbds, s);
	_fbq.loaded = true;
	}
	_fbq.push(['addPixelId', '694153537333853']);
	})();
	window._fbq = window._fbq || [];
	window._fbq.push(['track', 'PixelInitialized', {}]);
	</script>
	<noscript>
		<img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=694153537333853&amp;ev=PixelInitialized" />
	</noscript>
<script type="text/javascript">
		$(document).ready(function() {
			$(".toggle").click(function() {
				$(this).toggleClass("active");
				$(" .phone_topHeader .navBar").slideToggle();
			});
			
		});
		//$(document).on('click', '.toggle', function() {
				//if($('..phone_topHeader .navBar').hasClass('active') == true)
				//{
				//	$('..phone_topHeader .navBar').removeClass("active");
				//}
				//else
				//{
				//	$('..phone_topHeader .navBar').addClass("active");
				//}
				
				//});
</script>
<div class="body">
	<div class="logoStart"></div>
	<div class="picLoadingList">
		<img src="img/bg5.jpg">
        <?if( isset($page) ):?>
		<?if($page == 'index'):?>
		<img src="img/bg1.png">
		<img src="img/bg1Black.png">
		<img src="img/boxBg.png">
		<?elseif($page == 'news'):?>
		<img src="img/bg1.png">
		<img src="img/bg1Black.png">
		<?elseif($page == 'about'):?>
		<img src="img/line.png">
		<img src="img/bulb.png">
		<img src="img/bulb2.png">
		<img src="img/inhale.png">
		<img src="img/brush.png">
		<img src="img/bg6.jpg">
		<img src="img/bg7.jpg">
		<img src="img/bg8.jpg">
		<img src="img/bg13.jpg">
		<img src="img/bg18.jpg">
		<?elseif($page == 'portfolio'):?>
		<img src="img/bg10.jpg">
		<img src="img/bg13.jpg">
		<img src="img/bg14.jpg">
		<?elseif($page == 'contact'):?>
		<img src="img/bg3p1color.png">
		<img src="img/bg3p1.png">
		<img src="img/bg3p2_1.png">
		<img src="img/plane.png">
		<?endif?>
		<?endif?>
	</div>
	<div class="picLoading"></div>
	<div class="wrap">
		<span data-hrefto="<?=base_url()?>" class="logoFixed"></span>
		<div data-hrefto="contact" class="contactFormHover">
			線<br>上<br>諮<br>詢<br>/<br>索<br>取<br>報<br>價
		</div>
		<div class="index_topHeader">
			<div class="center">
				<div class="navBar">
					<div class="box down">
						<a href="<?=base_url()?>" class="nav<?if($page == 'about'):?> hover<?endif?>">About</a>
						<a class="nav2" href="<?=base_url()?>">關於我們</a>
						<div class="downbox">
							<div class="downbox1">
								<a href="webdesign">客製化網站</a>
							</div>
							<div class="downbox1">
								<a href="wordpress">套版網站</a>
							</div>
							<div class="downbox1">
								<a href="graphic">美術設計</a>
							</div>
							<div class="downbox1">
								<a href="marketing">網路行銷</a>
							</div>
							<div class="downbox1" style="border:none;">
								<a href="server">伺服器主機</a>
							</div>
						</div>
					</div>
					<div class="box">
						<a href="note" class="nav<?if($page == 'note'):?> hover<?endif?>">News</a>
						<a class="nav2" href="note">最新趨勢</a>
					</div>
					<div class="box">
						<a href="page/portfolio" class="nav<?if($page == 'portfolio'):?> hover<?endif?>">Portfoilo</a>
						<a class="nav2" href="page/portfolio">作品集</a>
					</div>
					<div class="box">
						<a href="contact" class="nav<?if($page == 'contact'):?> hover<?endif?>">Contact</a>
						<a class="nav2" href="contact">聯繫我們</a>
					</div>
				</div>
			</div>
		</div>
		<div class="phone_topHeader">
			<a href="<?=base_url()?>" class="logo_box">
				<img src="img/fanswoo-logo.svg">
			</a>
			<div class="toggle">
				<img src="img/phone_toggle.png">
			</div>
			<div class="navBar">
				<a href="<?=base_url()?>" class="box">
					<div class="item">
						<p class="nav<?if($page == 'about'):?> hover<?endif?>"><span>A</span>bout</p>
						<p class="nav2">關於我們</p>
					</div>
				</a>
				<a href="webdesign" class="box">
					<div  class="item">
						<p class="nav hover"><span>W</span>ebdesign</p>
						<p class="nav2">客製化網站</p>
					</div>
				</a>
				<a href="wordpress"  class="box">
					<div class="item">
						<p class="nav hover"><span>W</span>ordpress</p>
						<p class="nav2">套版網站</p>
					</div>
				</a>
				<a href="graphic" class="box">
					<div  class="item">
						<p class="nav hover"><span>G</span>raphic</p>
						<p class="nav2">美術設計</p>
					</div>
				</a>
				<a href="marketing"  class="box">
					<div class="item">
						<p class="nav hover"><span>M</span>arketing</p>
						<p class="nav2">網路行銷</p>
					</div>
				</a>
				<a href="server" class="box">
					<div class="item">
						<p class="nav hover"><span>S</span>erver</p>
						<p class="nav2">伺服器主機</p>
					</div>
				</a>
				<a href="note" class="box">
					<div class="item">
						<p class="nav hover"><span>N</span>ews</p>
						<p class="nav2">最新趨勢</p>
					</div>
				</a>
				<a href="page/portfolio" class="box">
					<div class="item">
						<p href="page/portfolio" class="nav<?if($page == 'portfolio'):?> hover<?endif?>"><span>P</span>ortfoilo</p>
						<p class="nav2" href="page/portfolio">作品集</p>
					</div>
				</a>
				<a href="contact" class="box">
					<div class="item">
						<p href="contact" class="nav<?if($page == 'contact'):?> hover<?endif?>"><span>C</span>ontact</p>
						<p class="nav2" href="contact">聯繫我們</p>
					</div>
				</a>
			</div>
		</div>