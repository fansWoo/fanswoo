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
			$('.content9 .choose_box[data-bgname=' + bgname + '] input').attr('name', 'money_Str');
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
		console.log(scroll_top);
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
			
	$('a[href^=#]').click(function () {
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
		$('.need_child[data-selected=' + selected + ']').attr('name', 'classtype2_Str');
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
			<h2>提供世界一流的Google雲端伺服器</h2>
			<h2>為企業網站、購物網站和網路平台</h2>	
			<h2>找到完美解決方案！</h2>	
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
				<h1>設計緣起</h1>
				<h2>為什麼環保產業要用綠色作為主色？<br>
				為什麼XXXXXX？</h2>
			</div>
			<div class="text">
				<p>全球Facebook用戶數已達12億，台灣覆蓋高達一千四百萬。Facebook的廣告能夠用更低的成本滾出源源不絕的訂單。全球Facebook用戶數已達12億，台灣覆蓋高達一千四百萬。Facebook的廣告能夠用更低的成本滾出源源不絕的訂單。</p>
				<p>全球Facebook用戶數已達12億，台灣覆蓋高達一千四百萬。Facebook的廣告能夠用更低的成本滾出源源不絕。</p>
			</div>
		</div>
		<div class="text_arae two" id="text_arae_two">
			<div class="title">
				<h1>企業的命脈，由此開始</h1>
				<h2>CIS企業識別設計、LOGO設計</h2>
			</div>
			<div class="text">
				<p>全球Facebook用戶數已達12億，台灣覆蓋高達一千四百萬。Facebook的廣告能夠用更低的成本滾出源源不絕的訂單。全球Facebook用戶數已達12億，台灣覆蓋高達一千四百萬。Facebook的廣告能夠用更低的成本滾出源源不絕的訂單。</p>
				<p>全球Facebook用戶數已達12億，台灣覆蓋高達一千四百萬。Facebook的廣告能夠用更低的成本滾出源源不絕。</p>
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
			<p>文宣設計、文宣設計、文宣設計</p>
			<p>全球Facebook用戶數已達12億，台灣覆蓋高達一千四百萬。Facebook的廣告能夠用更低的成本滾出源源不絕的訂單。全球Facebook用戶數已達12億，台灣覆蓋高達一千四百萬。Facebook的廣告能夠用更低的成本滾出源源不絕的訂單。</p>
			<p>全球Facebook用戶數已達12億，台灣覆蓋高達一千四百萬。Faceb。</p>
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
			<h2>文宣設計、文宣設計、文宣設計</h2>
			<p>全球Facebook用戶數已達12億，台灣覆蓋高達一千四百萬。Facebook的廣告能夠用更低的成本滾出源源不絕的訂單。全球Facebook用戶數已達12億，台灣覆蓋高達一千四百萬。Facebook的廣告能夠用更低的成本滾出源源不絕的訂單。</p>
			<p>全球Facebook用戶數已達12億，台灣覆蓋高達一千四百萬。Faceb。</p>
		</div>
	</div>		
</div>
<div class="content4">
	<div class="area">
		<div class="text_box">
			<h1>為你的產品注入生命力</h1>
			<h2>產品包裝設計、產品包裝設計</h2>
			<p>全球Facebook用戶數已達12億，台灣覆蓋高達一千四百萬。Facebook的廣告能夠用更低的成本滾出源源不絕的訂單。全球Facebook用戶數已達12億全球Facebook用戶數已達12億，台灣覆蓋高達一千四百萬。Facebook的廣告能夠用更低的成本滾出</p>
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
			<p>全球Facebook用戶數已達12億，台灣覆蓋高達一千四百萬。Facebook的廣告能夠用更低的成本滾出源源不絕的訂單。Facebook的廣告能夠用更低的成本滾出源源不絕的訂單。</p>
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
						<p>詢問項目</p>
						<select class="need" name="classtype_Str" required>
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
						<select class="money" name="money_Str">
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
					<textarea name="content_Str" placeholder="我還想補充..."></textarea>
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