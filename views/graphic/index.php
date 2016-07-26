<?=$temp['header_up']?>
<script>
$(function(){
	$(window).resize(function(){
		$(document).scrollTop(0);
		location.href = 'graphic';
	});
	var window_width = $(window).width();
	var window_height = $(window).height();
			
		if(window_width < 500){	
			$('.content1').css('height', window_height);
			$('.content1 .area').css('height', '400');
			$(window).resize(function(){
			var window_height = $(window).height();
			$('.content1').css('height', window_height);

			});	
		}
		else if	(window_width > 500){
			$('.content1').css('height', window_height);
			$('.content1 .area').css('height', window_height);
			$(window).resize(function(){
			var window_height = $(window).height();
			$('.content1').css('height', window_height);
			$('.content1 .area').css('height', window_height);	
			
			});
			
		}
		$(document).on('click', '.content9 .choose_box , .content9 .circle', function(){
			var bgname = $(this).data('bgname');
			$('.content9 .choose_box').removeClass('clicked');
			$(this).addClass('clicked');
			//新增的
			$('.content9 .choose_box').removeClass('hover');
			$('.content9 h4').removeClass('hover');
			$('.content9 .choose_box[data-bgname=' + bgname + '] ').addClass('hover');
			$('.content9 .choose_box[data-bgname=' + bgname + '] input').attr('name', 'money');
			$('.content9 h4[data-bgname=' + bgname + ']').addClass('hover');	
		});
	$(document).scroll(function(){
		var window_width = $(window).width();
		var scroll_top = $(document).scrollTop();

			if(window_width >= 1400){
				
			if(scroll_top > 1080){
			$('.content1 .arrow').css('display' , 'none');
			}
			else if(scroll_top < 1080){
				$('.content1 .arrow').css('display' , 'block');
			}	
			
			if(scroll_top == 0){
				$('.content2 #text_arae_one , .content2 #text_arae_two , .content2 .hand_box , .content2 .house ' ).removeClass('hover');
				$(' .content3 , .content4 , .content5 ' ).removeClass('hover');
			}
			else if(scroll_top >= 400 && scroll_top < 950){
				$('.content2 #text_arae_one ').addClass('hover');
			}
			else if(scroll_top >= 950 && scroll_top < 1700){
				$('.content2 #text_arae_two').addClass('hover');
				$('.content2 .hand_box ').addClass('hover');
				$('.content2 .house ').addClass('hover');
			}
			else if(scroll_top >= 1700 && scroll_top < 2600){
				$('.content3').addClass('hover');
			}
			else if(scroll_top >= 2600 && scroll_top < 3500){
				$('.content4').addClass('hover');
			}
			else if(scroll_top >= 3500 && scroll_top < 6000){
				if($('.content5').hasClass('hover'))
				{
				}
				else
				{
					$('.content5 .border').addClass('hover');
					$('.content5').addClass('hover');
					
				}
			}
		}	
		if(window_width > 1024 && window_width <= 1400){
			if(scroll_top > 500){
			$('.content1 .arrow').css('display' , 'none');
			}
			else if(scroll_top < 500){
				$('.content1 .arrow').css('display' , 'block');
			}	
			if(scroll_top == 0){
				$('.content2 #text_arae_one , .content2 #text_arae_two , .content2 .hand_box , .content2 .house ' ).removeClass('hover');
				$(' .content3 , .content4 , .content5 ' ).removeClass('hover');
			}
			else if(scroll_top >= 400 && scroll_top < 950){
				$('.content2 #text_arae_one ').addClass('hover');
			}
			else if(scroll_top >= 950 && scroll_top < 1600){
				$('.content2 #text_arae_two').addClass('hover');
				$('.content2 .hand_box ').addClass('hover');
				$('.content2 .house ').addClass('hover');
			}
			else if(scroll_top >= 1600 && scroll_top < 2400){
				$('.content3').addClass('hover');
			}
			else if(scroll_top >= 2400 && scroll_top < 3200){
				$('.content4').addClass('hover');
			}
			else if(scroll_top >= 3200 && scroll_top < 6000){
				if($('.content5').hasClass('hover'))
				{
				}
				else
				{
					$('.content5 .border').addClass('hover');
					$('.content5').addClass('hover');
					
				}
			}
		}	
		else if(window_width > 500 && window_width < 1024){
			if(scroll_top > 500){
			$('.content1 .arrow').css('display' , 'none');
			}
			else if(scroll_top < 500){
				$('.content1 .arrow').css('display' , 'block');
			}	
			
			if(scroll_top == 0){
				$('.content2 #text_arae_one , .content2 #text_arae_two , .content2 .hand_box , .content2 .house ' ).removeClass('hover');
				$(' .content3 , .content4 , .content5 ' ).removeClass('hover');
			}
			else if(scroll_top >= 400 && scroll_top < 1300){
				$('.content2 #text_arae_one ').addClass('hover');
				$('.content2 #text_arae_two').addClass('hover');
			}
			else if(scroll_top >= 1300 && scroll_top < 2000){
				$('.content2 .hand_box ').addClass('hover');
				$('.content2 .house ').addClass('hover');
			}
			else if(scroll_top >= 2000 && scroll_top < 2400){
				$('.content3').addClass('hover');
			}
			else if(scroll_top >= 2400 && scroll_top < 3200){
				$('.content4').addClass('hover');
			}
			else if(scroll_top >= 3200 && scroll_top < 6000){
				if($('.content5').hasClass('hover'))
				{
				}
				else
				{
					$('.content5 .border').addClass('hover');
					$('.content5').addClass('hover');
					
				}
			}
		}
		if(window_width > 1400){
			if(scroll_top > 1080){
			$('.content1 .arrow').css('display' , 'none');
			}
			else if(scroll_top < 1080){
				$('.content1 .arrow').css('display' , 'block');
			}	
		}
	});	

	$(document).scroll(function(){
		
		var scroll_top = $(document).scrollTop();
        var scroll_top_height = scroll_top + $(window).height();
		var window_width = $(window).width();
		if(window_width > 500){
			var content_portfolio_top = $('.content2').offset().top;
			var content_portfolio_height_all = $('.content2').heightAll();	
			
			if(scroll_top_height >= content_portfolio_top && scroll_top < content_portfolio_top + content_portfolio_height_all)
			{
				var s1 = (scroll_top_height - content_portfolio_top) / 1.5;
				$('.content2 .bird').css('transform', 'translateY(+' + s1 + 'px) translateX(+' + s1 + 'px)');


			}
		}
	});	
	$(document).on('mouseenter', '.content5 .border', function(){
	
		$(this).addClass('hover');
	});
	$(document).on('mouseleave', '.content5 .border', function(){
		$(this).removeClass('hover');
	});
			
	$(document).on('click', "a[href^='#']", function(){
		var speed = 500;
		var href = $(this).attr("href");
		var target = $(href == "#" || href == "" ? 'html' : href);
		var position = target.offset().top;
		$("html, body").animate({scrollTop: position}, speed, "swing");
			return false;
	});

	$(document).on('mouseenter', '.textContactForm', function(){
		$('.textContactForm').addClass('hover');
		$('.textContact').addClass('hidden');
	});
	$(document).on('focus', '.textContactForm.hover .need, .textContactForm.hover .need_child, .textContactForm.hover .money', function(){
		$(this).find("option[value='']").remove();
	});
	
	$(document).on('focus', '.textContactForm.hover .need', function(){
		$('.textContactForm.hover .need').change();
	});
		
	$(document).on('change', '.textContactForm.hover .need', function(){
		var selected = $(this).val();
		$('.need_child').css('display', 'none');
		$('.need_child').addClass('displaynone');
		$('.need_child[data-selected=' + selected + ']').css('display', 'block');
		$('.need_child[data-selected=' + selected + ']').attr('name', 'classtype2');
		$('.need_child option').removeAttr('selected');
		$('.need_child[data-selected=' + selected + '] option:first').attr('selected', true);
	});

	
});
</script>
<?=$temp['header_down']?>
<?=$temp['header_bar']?>
<div class="content1">
	<div class="area">
		<div class="pic1">
			<img src="img/graphic/content1/pic1.png">
		</div>
		<div class="text">
			<h2>讓經驗豐富的設計團隊</h2>
			<h2>以不同凡響的姿態注入生命力</h2>	
			<h2>創造印象深刻的視覺饗宴</h2>	
		</div>
		<a href="#content2" class="arrow">
			<img src="img/index/arrow_down.png">	
		</a>
	</div>
</div>

<div class="content2" id="content2">
<div class="bird">
	<img src="img/graphic/content2/bird.png">
</div>
<div class="phone_bird">
	<img src="img/graphic/content2/bird.png">
</div>
	<div class="area">
		<div class="text_arae one" id="text_arae_one">
			<div class="title">
				<h1>設計之根</h1>
				<h2>
					為什麼環保產業要用綠色作為主色？
					<br>
					為什麼選用紅燈作交通警示燈？
				</h2>
			</div>
			<div class="text">
				<p>設計的根本並非一張好看的圖或是漂亮的包裝，更應該融入產品本身，但現有的設計風氣卻時常忽略產品本身的特性，導致設計方向的錯誤。</p>
				<br>
				<p>我們<span class="red">以科學化的分析作為設計根據</span>，利用人性對顏色的暗示、對形狀的印象為基礎，令產品更加符合業主的需求，以達到設計之所以需要設計的真正意義。</p>
			</div>
		</div>
		<div class="text_arae two" id="text_arae_two">
			<div class="title">
				<h1>企業的命脈，由此開始</h1>
				<h2>CIS企業識別設計、LOGO設計</h2>
			</div>
			<div class="text"> 
				<p>一套好的CIS企業識別系統能夠帶給目標族群深刻的印象，錯誤的企業識別則會令目標族群產生疑惑。</p>
				<br>
				<p>許多企業主懂得製造產品、懂得洽談通路，卻忽略了對產品包裝的重要性，產品包裝是消費者的第一印象，而建立企業識別系統的首要目標，便是為企業主打造這條企業的命脈。</p>
			</div>
		</div>
		<div class="hand_box">
			<div class="pic_card_box">
				<img src="img/graphic/content2/pic_card.png" class="card_01">
			</div>
			<img src="img/graphic/content2/hand.png" class="pic_hand">
		</div>
		<div class="phone_hand_box">
			<div class="pic_card_box">
				<img src="img/graphic/content2/pic_card.png" class="card_01">
			</div>
			<img src="img/graphic/content2/mobile/hand.png" class="pic_hand">
		</div>			
		<div class="house">
			<img src="img/graphic/content2/house.png">
		</div>
	</div>
	
</div>
<div class="content3">
	<div class="area">
		<div class=" left_pic">
			<img src="img/graphic/content3/pic.png">
		</div>
		<div class="text_box">
			<h1>以不凡的姿態<br>
			接近你的消費族群</h1>
			<p>網站設計、手機APP設計、美術文宣設計</p>
			<p>電商時代來臨，網站設計風格直接主宰客戶在網站上的停留時間和跳出率，更間接影響產品銷售價及銷售量。我們知道要幫助企業突破激烈的競爭，唯有透過客製化，才能滿足您每一位悉心照護的客戶，創造您獨有的顧客價值。</p>
			<p>網站及手機APP是您與客戶的初見面，直接影響客戶對企業的好感度，正因如此，設計絕對不能苟且。好好打點企業門面，把企業想傳遞的溫度，直接傳到客戶的手上，讓客戶感受到您的真誠。</p>
		</div>
		<div class="bg01"></div>
		<div class="bg02"></div>
	</div>
	<div class="phone_area">
		<div class=" left_pic">
			<img src="img/graphic/content3/mobile/pic.png">
		</div>
		<div class="text_box">
			<h1>以不凡的姿態<br>
			接近你的消費族群</h1>
			<h2>網站設計、手機APP設計、美術文宣設計</h2>
			<p>電商時代來臨，網站設計風格直接主宰客戶在網站上的停留時間和跳出率，更間接影響產品銷售價及銷售量。我們知道要幫助企業突破激烈的競爭，唯有透過客製化，才能滿足您每一位悉心照護的客戶，創造您獨有的顧客價值。</p>
			<p>網站及手機APP是您與客戶的初見面，直接影響客戶對企業的好感度，正因如此，設計絕對不能苟且。好好打點企業門面，把企業想傳遞的溫度，直接傳到客戶的手上，讓客戶感受到您的真誠。</p>
		</div>
	</div>		
</div>
<div class="content4">
	<div class="area">
		<div class="text_box">
			<h1>為你的產品注入生命力</h1>
			<h2>產品包裝設計 公司形象logo發想</h2>
			<p>可口可樂以獨有的曲線瓶設計，傳頌百年，驕傲地說出：在黑暗中靠著觸覺就能辨別可口可樂。一個成功的產品設計，能區隔產品地位，讓商品歷久不衰，從同質的競爭對手中脫穎而出。</p>
			<p>產品設計如同人的外衣，最容易被與品牌精神串聯一線，創造出強健、受喜愛、獨特的品牌聯想差異點，才能提高產品價值，成功區隔市場。(為產品打造一個獨一無二、誰也學不來的產品包裝設計吧。)</p>
		</div>
		<div class="pic_hand">
			<img src="img/graphic/content4/hand.png">
		</div>
		<div class="pic_white">
			<img src="img/graphic/content4/bg2.png">
		</div>
		<div class="pic_color">
			<img src="img/graphic/content4/ddd.png" class="ddd">
			<img src="img/graphic/content4/bg.png" class="color">
		</div>
		<div class="phone_pic_color">
			<img src="img/graphic/content4/mobile/bg.png">
		</div>
	</div>	
</div>
<div class="content5">
	<div class="area">
		<div class="text_box">
			<h1>創造獨一無二的形象</h1>
			<p>插畫設計、主視覺設計</p>
			<p>大腦內的海馬體，讓視覺成為最直接影響大腦的感官，想讓網站成功在客戶腦中留下印象？首要應以大量、有意義的圖像代替文字，讓訊息能夠更長時間停留在客戶的腦海裡。</p>
			<p>我們透過插畫設計、主視覺設計，針對您的企業風格打造企業形象，輔以量身訂做的素材豐富網頁，讓官網頁面不再濫竽充數，而能體現企業精神。</p>
		</div>
		<div class="bg2">
			<img src="img/graphic/content5/bg2.png">
		</div>
		<div class="bg3">
			<img src="img/graphic/content5/bg3.png">
		</div>
		<div class="glass">
			<img src="img/graphic/content5/glass.png">
		</div>
		<div class="watch">
			<img src="img/graphic/content5/watch.png">
		</div>
		<div class="border">
			<img src="img/graphic/content5/border.png">
		</div>
	</div>	
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
				<?php echo form_open("Contact/contact_post/")?>
				<div class="leftBox">
					<div class="area">
						<p>您的姓名</p><input type="text" class="name" name="username" placeholder="請填寫您的姓名" required>
					</div>
					<div class="area">
						<p>公司名稱</p><input type="text" class="company" name="company" placeholder="請填寫公司名稱" required>
					</div>	
					<div class="area">
						<p>聯繫電話</p><input type="text" class="telphone" name="phone" placeholder="請填寫聯繫電話" required>
					</div>
					<div class="area">	
						<p>電子郵件</p><input type="text" class="email" name="email" placeholder="請填寫電子郵件" required>
					</div>
					<div class="area">		
						<p>公司地址</p><input type="text" class="address" name="address" placeholder="請填寫公司地址" required>
					</div>
					<div class="area">
						<p>詢問項目</p>
						<select class="need" name="classtype" required>
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
						<select class="need_child">
							<option value="先選擇主要項目">先選擇主要項目</option>
						</select>
						<select class="need_child" data-selected="網站開發" style="display:none;">
							<option value="形象網站設計">形象網站設計</option>
							<option value="0元套版網站">0元套版網站</option>
							<option value="購物網站開發">購物網站開發</option>
							<option value="網路平台開發">網路平台開發</option>
						</select>
						<select class="need_child" data-selected="程式系統開發" style="display:none;">
							<option value="程式系統開發">程式系統開發</option>
							<option value="手機App開發">手機App開發</option>
						</select>
						<select class="need_child" data-selected="美術設計" style="display:none;">
							<option value="LOGO/CIS 設計">LOGO/CIS 設計</option>
							<option value="平面設計">平面設計</option>
							<option value="產品包裝設計">產品包裝設計</option>
						</select>
						<select class="need_child" data-selected="網路行銷" style="display:none;">
							<option value="facebook 粉絲團">facebook 粉絲團</option>
							<option value="Google Adwords">Google Adwords</option>
							<option value="網路行銷企劃">網路行銷企劃</option>
						</select>
						<select class="need_child" data-selected="伺服器租賃" style="display:none;">
							<option value="虛擬伺服器租賃">虛擬伺服器租賃</option>
							<option value="雲端主機租賃">雲端主機租賃</option>
							<option value="電子信箱主機租賃">電子信箱主機租賃</option>
							<option value="Google Apps設定">Google Apps設定</option>
						</select>
						<select class="need_child" data-selected="其它問題" style="display:none;">
							<option value="其它問題">其它問題</option>
						</select>
					</div>
					<div class="area phone">
						<span>您的預算：</span>
						<select class="money" name="money">
							<option value="">請選擇預算</option>
							<option value="15萬以下">15萬以下</option>
							<option value="15~25萬">15~25萬</option>
							<option value="25~50萬">25~50萬</option>
							<option value="50~100萬">50~100萬</option>
						</select>
						<div class="textContactFormMoneyFixed">
							預算欄位僅供參考，每個客製化專案皆可依客戶需求給予報價
						</div>
					</div>
				</div>
				<div class="rightBox">
					<textarea name="content" placeholder="我還想補充..."></textarea>
				</div>
				<div class="price_choose">
					<p>預算選擇</p>
					<div class="choose_area">
						<div class="choose_box" data-bgname="text1">
							<h3>15萬以下</h3>
							<div class="circle"><input type="hidden" value="15萬以下"></div>
							<h4 data-bgname="text1">普通或可能導致負面形象</h4>
						</div>
						<div class="line"></div>
						<div class="choose_box" data-bgname="text2">
							<h3>15~25萬</h3>
							<div class="circle"><input type="hidden" value="15~25萬"></div>
							<h4 data-bgname="text2">感到耳目一新</h4>
						</div>
						<div class="line"></div>
						<div class="choose_box" data-bgname="text3">
							<h3>25~50萬</h3>
							<div class="circle"><input type="hidden" value="25~50萬"></div>
							<h4 data-bgname="text3">印象非常深刻的網站</h4>
						</div>
						<div class="line"></div>
						<div class="choose_box" data-bgname="text4">
							<h3>50~100萬</h3>
							<div class="circle"><input type="hidden" value="50~100萬"></div>
							<h4 data-bgname="text4">最極致的設計</h4>
						</div>
					</div>
				</div>
					<input type="submit" value="送出" class="contactSubmit" name="contactSubmit">
					<input type="hidden" name="previous_url" value="<?=$previous_url?>">
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