			<div class="footer">
					<div class="area">
						<div class="boxRight">
							<h1>
								<span class="floatright">service@fanswoo.com</span>
								連繫資訊
							</h1>
							<div class="text">
								<div class="textArea">
									<p>070-1018-1068</p>
									<p>業務部 #333</p>
									<p>設計部 #331</p>
									<p>企劃部 #330</p>
								</div>
								<div class="textArea">
									<p>上班時間：</p>
									<p>09:30 - 12:30</p>
									<p>13:30 - 18:30</p>
								</div>
								<div class="textArea">
									<a href="contact" class="request">索取報價</a>
								</div>
							</div>
							<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
							<script type="text/javascript">
							google.maps.event.addDomListener(window, 'load', function() {
								var mapdiv = document.getElementById('user_gmap');
								var myOptions = {
									zoom: 13,
									center: new google.maps.LatLng(25.08662,121.511402),
									mapTypeId: google.maps.MapTypeId.ROADMAP,
									scaleControl: true
								};
								var map = new google.maps.Map(mapdiv, myOptions);
								var marker = new google.maps.Marker({
									position: new google.maps.LatLng(25.08662,121.511402),
									map: map, 
									title: '瘋沃科技'
								});
								var infowindow = new google.maps.InfoWindow({
									content: '<strong>瘋沃科技</strong><br />',
									size: new google.maps.Size(200, 300)
								});
								google.maps.event.addListener(marker, 'click', function() {
									infowindow.open(map,marker);
								});
							});
							</script>
							<div class="map">
								<div id="user_gmap"></div>
							</div>
						</div>
						<div class="boxAbout">
							<div class="text">
								<h1>關於fansWoo</h1>
								<a href="page/about">關於我們 <span class="black">ABOUT</span></a>
								<a href="page/webdesign">客製化網站 <span class="black">WEB DESIGN</span></a>
								<a href="page/wordpress">0元套版網站 <span class="black">WORDPRESS</span></a>
								<a href="page/server">伺服器租賃 <span class="black">SERVER</span></a>
								<a href="note">最新趨勢 <span class="black">NEWS</span></a>
								<a href="page/portfolio">作品集 <span class="black">PORTFOILO</span></a>
								<a href="contact">聯繫我們 <span class="black">CONTACT</span></a>
								<a href="contact">索取報價 <span class="black">REQUEST</span></a>
							</div>
						</div>
						<div class="boxNews">
							<div class="text">
								<h1>最新趨勢</h1>
								<a href="">誰說投資一定要花錢？不花錢的投資才是真正的投資</a>
								<a href="">網路開店很簡單？探討架設購物網站常見的迷思</a>
								<a href="">網頁設計的價差為什麼這麼大？</a>
								<a href="">誰說投資一定要花錢？不花錢的投資才是真正的投資</a>
								<a href="">網路開店很簡單？探討架設購物網站常見的迷思</a>
							</div>
						</div>
					</div>
				<div class="footerBottom">
					© 2016 <a href="">fansWoo</a> All Rights Reserved. Design By <a href="">瘋沃科技</a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>