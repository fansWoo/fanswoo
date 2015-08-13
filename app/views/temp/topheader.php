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

<div class="index_topHeader">
	<div class="center">
		<div class="navBar">
			<div class="box down">
				<a href="page/about" class="nav<?if($page == 'about'):?> hover<?endif?>">About</a>
				<a class="nav2" href="page/about">關於我們</a>
				<div class="downbox">
					<div class="downbox1">
						<a href="page/webdesign">客製化網站</a>
					</div>
					<div class="downbox1">
						<a href="page/wordpress">0元套版網站</a>
					</div>
					
					<div class="downbox1" style="border:none;">
						<a href="page/server">伺服器主機</a>
					</div>
					
				</div>
			</div>
			<div class="box">
				<a href="news" class="nav<?if($page == 'note'):?> hover<?endif?>">News</a>
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
	<a href="" class="logo_box">
		<img src="app/img/fanswoo-logo.svg">
	</a>
	<div class="toggle">
		<img src="app/img/phone_toggle.png">
	</div>
	<div class="navBar">
		<a href="page/about" class="box">
			<div class="item">
				<p class="nav<?if($page == 'about'):?> hover<?endif?>"><span>A</span>bout</p>
				<p class="nav2" href="page/about">關於我們</p>
			</div>
		</a>
		<a href="page/webdesign" class="box">
			<div  class="item">
				<p href="page/webdesign" class="nav hover"><span>w</span>ebdesign</p>
				<p class="nav2" href="note">客製化網站</p>
			</div>
		</a>
		<a href="page/wordpress"  class="box">
			<div class="item">
				<p href="page/wordpress" class="nav hover"><span>w</span>ordpress</p>
				<p class="nav2" href="note">0元套版網站</p>
			</div>
		</a>
		<a href="page/server" class="box">
			<div class="item">
				<p href="page/server" class="nav hover"><span>s</span>erver</p>
				<p class="nav2" href="note">伺服器主機</p>
			</div>
		</a>
		<a href="page/news" class="box">
			<div href="news" class="item">
				<p href="page/news" class="nav  hover"><span>N</span>ews</p>
				<p class="nav2" href="note">最新趨勢</p>
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