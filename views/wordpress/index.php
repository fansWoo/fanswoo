<?=$temp['header_up']?>
<script src="js/smooth_scrollerator.js"></script>
<script src="js/cycle2.js"></script>
<script>
$(function(){
	$(".content3 .slide_pic > .square").cycle({
		fx      :       "scrollHorz", 
		//fade
		//scrollHorz
		timeout: 4000 ,
		speed: 1000,
		manualSpeed: 600,
		slides: ' > .slide_pic_href',
		pager: '.content3 .cycle-pager '
    });
	$('.content3').on('swiperight', function(event){
		$('.content3 .slide_pic > .square .prev').click();
	});
	$('.content3').on('swipeleft', function(event){
		$('.content3 .slide_pic > .square .next').click();
	});
	
});
</script>
<script>
$(function(){
	
	
	
	var window_width = $(window).width();
	var window_height = $(window).height();
			
		if(window_width > 700){	
			$('.content1').css('height', window_height);
			$(window).resize(function(){
			var window_height = $(window).height();
			$('.content1').css('height', window_height);

			});	
	}
	$(document).scroll(function(){
		var scroll_top = $(document).scrollTop();
		if(scroll_top == 0){
			$('.content2, .content3, .content4, .content5, .content6, .content7, .content8,' ).removeClass('hover');
		}
		else if(scroll_top >= 300 && scroll_top < 1100){
			$('.content2').addClass('hover');
		}
		else if(scroll_top >= 1100 && scroll_top < 1900){
			$('.content3').addClass('hover');
		}
		else if(scroll_top >= 1900 && scroll_top < 2600){
			$('.content4').addClass('hover');
		}
		else if(scroll_top >= 2600 && scroll_top < 3800){
			$('.content5').addClass('hover');
		}
		else if(scroll_top >= 3800 && scroll_top < 4500){
			$('.content6').addClass('hover');
		}
		else if(scroll_top >= 4500 && scroll_top < 5500){
			$('.content7').addClass('hover');
		}
		else if(scroll_top >= 5500){
			$('.content8').addClass('hover');
		}
	});
	//計算總金額
	$(document).ready(function() {

        $("#classtype").change(function(){
            var a1 = $("#classtype").val();
            if(a1=="0"){var a1 = 0;}
            if(a1=="微型主機"){var a1 = 700;}
            if(a1=="標準主機"){var a1 = 1500;}
            if(a1=="專業主機"){var a1 = 3200;}
            var a2 = $("#years").val() * 12;
            v1 = a1 * a2;
			$("#price").val(v1);
        });

        $("#years").change(function(){
        	var a1 = $("#classtype").val();
        	if(a1=="0"){var a1 = 0;}
            if(a1=="微型主機"){var a1 = 700;}
            if(a1=="標準主機"){var a1 = 1500;}
            if(a1=="專業主機"){var a1 = 3200;}
            var a2 = $("#years").val() * 12;
            v1 = a1 * a2;
			$("#price").val(v1);
        });
        $("#years").keyup(function(){
        	var a1 = $("#classtype").val();
        	if(a1=="0"){var a1 = 0;}
            if(a1=="微型主機"){var a1 = 700;}
            if(a1=="標準主機"){var a1 = 1500;}
            if(a1=="專業主機"){var a1 = 3200;}
            var a2 = $("#years").val() * 12;
            v1 = a1 * a2;
			$("#price").val(v1);
        });
	});
});
</script>
<?=$temp['header_down']?>
<?=$temp['header_bar']?>
        
		<div class="content1">
			<div class="area">
				<img src="img/wordpress/wordpress.png">
				<h1></h1>
				<h2>為預算有限的微型企業，提供35萬種套版網站！</h2>
				<h3>0元設計費、0元開發費、0元安裝費</h3>
			</div>
		</div>
		<div class="content2">
			<div class="area">
				<h1>35萬種版型隨時更換</h1>
				<p class="in_p">無論部落客、攝影師、工作室、微型企業，均可從35萬種版型裡面挑選到喜歡的設計</p>
				<div class="box1">
						<div class="contantbox">
							<div class="box" style="background-image:url(img/wordpress/contant3_box.png);background-position:center; background-size:cover;">
								<div class="hoverbox">
									<p class="pc_p">餐廳 | 旅遊 | 音樂 | 娛樂</p>
									<p class="phone_p">餐廳 ･ 旅遊 <br> 音樂 ･ 娛樂</p>
								</div>
							</div>
						</div>	
						
						<div class="contantbox">
							<div class="box" style="background-image:url(img/wordpress/contant3_box2.png);background-position:center; background-size:cover;">
								<div class="hoverbox">
									<p class="pc_p">運動 | 休閒 | 醫療 | 美容</p>
									<p class="phone_p">運動 ･ 休閒 <br> 醫療 ･ 美容</p>
								</div>
							</div>
						</div>
						
						<div class="contantbox" >
							<div class="box" style="background-image:url(img/wordpress/contant3_box3.png);background-position:center; background-size:cover;">
								<div class="hoverbox">
									<p class="pc_p">攝影 | 藝術 | 設計 | 時尚</p>
									<p class="phone_p">攝影 ･ 藝術 <br> 設計 ･ 時尚</p>
								</div>
							</div>
						</div>
				</div>

			</div>
			<div class="contant">
					<a href="http://collectivedemo.wordpress.com/"><img src="img/wordpress/contant6_demo6.jpg"></a>
					<a href="http://twentyfourteendemo.wordpress.com/"><img src="img/wordpress/contant6_demo5.jpg"></a>	
					<a href="http://travelerdemo.wordpress.com/"><img src="img/wordpress/contant6_demo3.jpg"></a>	
					<a href="http://clearnewsdemo.wordpress.com/"><img src="img/wordpress/contant6_demo4.jpg"></a>
					<a href="http://herodemo.wordpress.com/"><img src="img/wordpress/contant6_demo2.jpg"></a>
					<a href="http://bridgerdemo.wordpress.com/"><img src="img/wordpress/contant6_demo1.jpg"></a>
					<a href="http://arcadedemo.wordpress.com/"><img src="img/wordpress/contant6_demo7.jpg"></a>	
					<a href="http://connectdemo.wordpress.com/"><img src="img/wordpress/contant6_demo8.jpg"></a>
					<a href="http://singldemo.wordpress.com/"><img src="img/wordpress/contant6_demo9.jpg"></a>	
					<a href="http://fullframedemo.wordpress.com/"><img src="img/wordpress/contant6_demo10.jpg"></a>
			</div>
		</div>
		<div class="content3">
			<div class="area">
				<div class="box">
					<img src="img/wordpress/contant2_icon.png" >
					<h2>0元設計費</h2>
					<p>針對微型企業，不需任何設計費、開發費、安裝費</p>
				</div>
				<div class="box">
				<img src="img/wordpress/contant2_icon4.png">
					<h2>5天快速交件</h2>
					<p>不需客製化設計時間，付款後五天之內即可快速交件</p>
				</div>
				<div class="box">
					<img src="img/wordpress/contant2_icon2.png" >
					<h2>365天客服</h2>
					<p>由設計師為客戶服務，即時解決使用或設計疑問</p>
				</div>
				<div class="box">
					<img src="img/wordpress/contant2_icon3.png">
					<h2>35萬種版型</h2>
					<p>為客戶安裝35萬種網站版型，隨時隨地皆可更換</p>
				</div>
			</div>
			<div class="phone_area">
				<div class="slide_pic_box" >
					<div class="slide_pic" >
						<div class="square">
							<div class="slide_pic_href">
								<div class="box">
									<img src="img/wordpress/contant2_icon.png" >
									<h2>0元設計費</h2>
									<p>針對微型企業，不需任何設計費、開發費、安裝費</p>
								</div>
							</div>
							<div class="slide_pic_href">
								<div class="box">
								<img src="img/wordpress/contant2_icon4.png">
									<h2>5天快速交件</h2>
									<p>不需客製化設計時間，付款後五天之內即可快速交件</p>
								</div>
							</div>
							<div class="slide_pic_href">
								<div class="box">
									<img src="img/wordpress/contant2_icon2.png" >
									<h2>365天客服</h2>
									<p>由設計師為客戶服務，即時解決使用或設計疑問</p>
								</div>
							</div>
							<div class="slide_pic_href">
								<div class="box">
									<img src="img/wordpress/contant2_icon3.png">
									<h2>35萬種版型</h2>
									<p>為客戶安裝35萬種網站版型，隨時隨地皆可更換</p>
								</div>
							</div>
						</div>	
					</div>
					<div class="cycle-pager"></div>
				</div>
			</div>
		</div>
		<div class="content4">
			<div class="area">
				<h1>WordPress最佳套版網站</h1>
				<p>全世界 <span class="red">78% 市佔率</span>的 CMS 系統</p>
				<p><span class="orange">35 萬種</span>來自全世界頂尖設計師設計的模板</p>
				<p><span class="green">6500 萬下載數</span>的使用者支持</p>
				<p>2003 年成立至今，系統成熟穩定度高</p>
				<p>24 小時任意更改風格</p>
				<p>100% 使用者自由度</p>
				<p>0 元架站免收設計費</p>
				<p>最低每月只需 500 元主機費</p>
				<p>.</p>
				<p>.</p>
				<p>.</p>
				<p>.</p>
				<p>.</p>
				<p>.</p>
				<div class="svg svg1">
					<svg viewBox="0 0 220 220">
						<path d="M 110 10 A 100 100 0, 1 1 109 10" style="fill:none;stroke:#EEE;" />
						<path class="line" d="M 110 10 A 100 100 0, 1 1 10 110" style="fill:none;stroke:#8bb01c;stroke-width:10;" />
					</svg>
					<div class="text">
						<h2><span class="big">6500</span>萬</h2>
						<p>使用者支持</p>
					</div>
				</div>
				<div class="svg svg2">
					<svg viewBox="0 0 220 220">
						<path d="M 110 10 A 100 100 0, 1 1 109 10" style="fill:none;stroke:#EEE;" />
						<path class="line" d="M 110 10 A 100 100 0, 1 1 10 110" style="fill:none;stroke:#eb3d82;stroke-width:10;" />
					</svg>
					<div class="text">
						<h2><span class="big">78%</span></h2>
						<p>系統市佔率</p>
					</div>
				</div>
				<div class="svg svg3">
					<svg viewBox="0 0 220 220">
						<path d="M 110 10 A 100 100 0, 1 1 109 10" style="fill:none;stroke:#EEE;" />
						<path class="line" d="M 110 10 A 100 100 0, 1 1 10 110" style="fill:none;stroke:#ffdd24;stroke-width:10;" />
					</svg>
					<div class="text">
						<h2><span class="big">35</span>萬</h2>
						<p>萬用版型</p>
					</div>
				</div>
			</div>
		</div>	
		<div class="content5">
			<div class="area">
				<h1>PC、Mobile無障礙瀏覽</h1>
				<p>響應式網頁設計版型，不同尺寸或解析度的設備及螢幕，網站均會根據使用者的裝置，顯示符合版面大小的樣式</p>
				<div class="contant">
					
					<img src="img/wordpress/contant5_pic1.png" class="pic1">
					<img src="img/wordpress/contant5_pic2.png" class="pic2">
					<img src="img/wordpress/contant5_pic3.png" class="pic3">
			
				</div>
				
			</div>
		</div>
		<div class="content6">
			<div class="area">
				<div class="leftbox">
					<img src="img/wordpress/contant6_text1.png" class="title1">
					<img src="img/wordpress/contant6_text2.png" class="vs">
					<img src="img/wordpress/contant6_text3.png" class="title2">
					<img src="img/wordpress/contant6_text5.png" class="line">
				</div>
				
				 <img src="img/wordpress/contant6_bg.png" class="keyboard">
					<p class="p1">
						<img src="img/wordpress/contant6_dot.png" class="dot1">	預算不足的企業千萬別相信數萬元的客製化網站！真正的客製化網站是由美術設計師、網頁設計師、程式設計師共同設計的，一個月下來的設計成本最少十萬元以上，而幾萬元的專案連設計師的薪水都不夠付，只能拿套版軟體換幾張圖片充當客製化網站。
					</p>
					<p class="p2">
						<img src="img/wordpress/contant6_dot.png" class="dot2">	為杜絕黑心設計公司欺騙消費者，我們不僅為企業設計真正的客製化網站，還免費提供擁有 35 萬種版型的套版軟體供微型企業使用，僅需負擔主機費，不需支付任何設計費，讓微型企業得以用最低成本擁有簡易網站。
					</p>
			</div>
		</div>
		<div class="content7">
			<div class="area">
				<h1>WordPress專用主機</h1>
				
				<div class="box">
					<img src="img/wordpress/contant7_pic1.png" class="pic">
					<div class="itemDiv">
						<div class="item" style="height:70px; line-height:80px;font-size:30px;font-weight:500;letter-spacing:5px;color:#f7911d; border:none;">微型主機</div>
						<img src="img/wordpress/contant7_line1.png" class="line">
						<div class="item">35萬種版型</div>
						<div class="item">圖文頁數無限頁</div>
						<div class="item">40G或<span class="big">400G</span>流量</div>
						<div class="item"><span class="big">10G</span>SSD容量</div>
						<div class="item"><span class="big">2M</span>或<span class="big">1T</span>共用頻寬</div>
						<div class="item"><span class="big">無限</span>IP</div>
						<div class="item">0元設計費</div>
						<h3>NT$ <span class="big">700元</span> /月</h3>
					</div>
				</div>
				<div class="box box2">
					<img src="img/wordpress/contant7_pic2.png" class="pic">
					<div class="itemDiv">
						<div class="item" style="height:70px; line-height:80px;font-size:30px;font-weight:500;letter-spacing:5px;color:#f7911d; border:none;">標準主機</div>
						<img src="img/wordpress/contant7_line2.png" class="line">
						<div class="item">35萬種版型</div>
						<div class="item">圖文頁數無限頁</div>
						<div class="item">80G或<span class="big">800G</span>流量</div>
						<div class="item"><span class="big">20G</span>SSD容量</div>
						<div class="item"><span class="big">5M</span>或<span class="big">1T</span>共用頻寬</div>
						<div class="item"><span class="big">無限</span>IP</div>
						<div class="item">0元設計費</div>
						<h3>NT$ <span class="big">1500元</span> /月</h3>
					</div>
				</div>
				<div class="box">
					<img src="img/wordpress/contant7_pic3.png" class="pic">
					<div class="itemDiv">
						<div class="item" style="height:70px; line-height:80px;font-size:30px;font-weight:500;letter-spacing:5px;color:#f7911d; border:none;">專業主機</div>
						<img src="img/wordpress/contant7_line3.png" class="line">
						<div class="item">35萬種版型</div>
						<div class="item">圖文頁數無限頁</div>
						<div class="item">120G或<span class="big">1200G</span>流量</div>
						<div class="item"><span class="big">40G</span>SSD容量</div>
						<div class="item"><span class="big">10M</span>或<span class="big">1T</span>共用頻寬</div>
						<div class="item"><span class="big">無限</span>IP</div>
						<div class="item">0元設計費</div>
						<h3>NT$ <span class="big">3200元</span> /月</h3>
					</div>
				</div>
			</div>
		</div>
		<div class="content8">
			<div class="boxContant">
				<h4>各方案基本內容</h4>
				<p></p>
				<div class="boxarea">
					<div class="box">
						<img src="img/wordpress/contant8_icon1.png">
					    <h2>獨立網域</h2>
						<h3>使用自己的獨立網域，不需要使用別人的網址<h3>
					</div>
					<div class="box">
						<img src="img/wordpress/contant8_icon2.png">
						<h2>流量無限制</h2>
						<h3>不限制流量大小，經營網站不需擔心流量問題</h3>
					</div>
					<div class="box">
						<img src="img/wordpress/contant8_icon3.png">
						<h2>35萬種版型</h2>
						<h3>提供多種版型供客戶選擇，各行各業都有適合的版型</h3>
					</div>
					<div class="box">
						<img src="img/wordpress/contant8_icon4.png">
						<h2 style="font-size:16px;letter-spacing:2px;">Google Analytics</h2>
						<h3>整合目前最強大的統計系統，提供網站統計資料</h3>
					</div>
					<div class="box">
						<img src="img/wordpress/contant8_icon5.png">
						<h2>專人客服</h2>
						<h3>任何問題撥打客服專線，皆有專人為您服務</h3>
					</div>
					<div class="box">
						<img src="img/wordpress/contant8_icon6.png">
						<h2>多螢幕顯示</h2>
						<h3>響應式網站設計，讓不同的設備皆可達到最佳視覺效果</h3>
					</div>
					<div class="box">
						<img src="img/wordpress/contant8_icon7.png">
						<h2>WordPress</h2>
						<h3>使用WordPress套版軟體，提供多種免費附加功能</h3>
					</div>
					<div class="box">
						<img src="img/wordpress/contant8_icon8.png">
						<h2>基本SEO</h2>
						<h3>SEO搜尋引擎最佳化，讓使用者快速搜尋到目標網站</h3>
					</div>
				
				</div>	
			</div>
		</div>			
</div>		
<div class="content9">
	<div class="content_area">
		<h1>申請套版網站</h1>
		<div class="title_box">
			<div class="line1"></div>
			<p>請填寫以下資訊，並選擇WordPress專用主機及訂購期限來申請套版網站。</p>
			<div class="line2"></div>
		</div>
		<div class="textContactForm">
			<div class="textContactFormContent">
				<?php echo form_open("Wordpress/order_submit/")?>
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
						<p>主機類型</p>
						<select class="need" id="classtype" name="classtype_Str" required>
							<option value="0">請選擇wordpress主機類型</option>
							<option value="微型主機">微型主機</option>
							<option value="標準主機">標準主機</option>
							<option value="專業主機">專業主機</option>
						</select>
					</div>
					<div class="area">
						<p>訂購期限</p><input type="number" min="1" max="80" id="years" class="address" name="years_Num" placeholder="請填寫訂購期限(年)" required>
					</div>
					<div class="area">
						<p>總金額</p><input id="price" name="price_Num" readonly>
					</div>
				</div>
				<div class="rightBox">
					<textarea name="content_Str" placeholder="我還想補充..."></textarea>
				</div>
				<input type="submit" value="申請" class="contactSubmit" name="contactSubmit">
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
