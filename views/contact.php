<?=$temp['header_up']?>
<script>
Temp.ready(function(){
	(function() {
	  var _fbq = window._fbq || (window._fbq = []);
	  if (!_fbq.loaded) {
	    var fbds = document.createElement('script');
	    fbds.async = true;
	    fbds.src = '//connect.facebook.net/en_US/fbds.js';
	    var s = document.getElementsByTagName('script')[0];
	    s.parentNode.insertBefore(fbds, s);
	    _fbq.loaded = true;
	  }
	})();
	window._fbq = window._fbq || [];
	window._fbq.push(['track', '6020797556140', {'value':'0.00','currency':'TWD'}]);

	//聯繫頁變更
	$(document).on('mouseenter', '.textContactForm', function(){
		$('.textContactForm').addClass('hover');
		$('.textContact').addClass('hidden');
	});
	$(document).on('click', '.textContactFormClose', function(){
		$('.textContactForm').removeClass('hover');
		$('.textContact').removeClass('hidden');
	});

	/* <![CDATA[ */
	var google_conversion_id = 1037100439;
	var google_conversion_language = "en";
	var google_conversion_format = "3";
	var google_conversion_color = "ffffff";
	var google_conversion_label = "54GrCKiolVYQl8vD7gM";
	var google_remarketing_only = false;
	/* ]]> */
});
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js"></script>
<noscript style="display:none;"><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6020797556140&amp;cd[value]=0.00&amp;cd[currency]=TWD&amp;noscript=1" /></noscript>
<?=$temp['header_down']?>
<?=$temp['header_bar']?>
	<div class="pencil">fansWoo</div>
	<div class="plane">fansWoo</div>
	<div class="bg1">fansWoo</div>
	<div class="bg2"></div>
	<div class="pc_content">
		<div class="textContact">
			<div class="textContactContent">
				<h2>聯繫 <b>C</b>ontact</h2>
				<p style="margin-bottom:10px;"><b>立即聯繫我們，讓我們為客戶打造一流品牌形象</b></p>
				<div class="stage">
					<img class="pic" src="img/time.png">
					<p>早上 09:30 - 12:30</p>
					<p>下午 13:30 - 18:30</p>
				</div>
				<div class="stage">
					<img class="pic" src="img/tel.png">
					<p>070-1018-1068</p>
					<p>業務部 #888</p>
					<p>設計部 #333</p>
				</div>
				<div class="stage">
					<img class="pic" src="img/email.png">
					<p><a href="mailto:service@fanswoo.com">service@fanswoo.com</a></p>
					<p><a href="mailto:yi@fanswoo.com">yi@fanswoo.com</a></p>
				</div>
				<div class="stage">
					<img class="pic" src="img/add.png">
					 <p>台北市大南路 419 號 6 樓</p>
					 <p>6F., No.419, Danan Rd., Shilin Dist., Taipei City 111, Taiwan (R.O.C.)</p>
				</div>
			</div>
		</div>
		<div class="textContactForm">
			<div class="textContactFormContent">
				<div class="textContactFormClose"></div>
				<?=form_open("contact/contact_post")?>
				<div class="rightBox">
					<p>您的姓名：<input type="text" class="name" name="username" placeholder="請填寫您的姓名" required></p>
					<p>公司名稱：<input type="text" class="company" name="company" placeholder="請填寫公司名稱" required></p>
					<p>聯繫電話：<input type="tel" class="telphone" name="phone" placeholder="請填寫聯繫電話" required></p>
					<p>電子郵件：<input type="email" class="email" name="email" placeholder="請填寫電子郵件" required></p>
					<p>公司地址：<input type="text" class="address" name="address" placeholder="請填寫公司地址" required></p>
					<textarea name="content"></textarea>
					<p>本公司設計案件較多，為盡早處理您的專案，請提前詢問及索取報價資訊。</p>
					<input type="submit" value="送出" class="contactSubmit" name="contactSubmit">
				</div>
				<div class="leftBox">
					<h2>線上諮詢 / 索取報價</h2>
					<div class="area">
						<span>詢問項目</span>
						<select class="need" name="classtype">
							<option value="請先選擇主要詢問項目">請先選擇主要詢問項目</option>
						</select>
					</div>
					<div class="area">
						<span>項目細節</span>
						<select class="need_child" name="classtype2">
							<option value="請先選擇次要詢問項目">請先選擇次要詢問項目</option>
						</select>
					</div>
					<div class="area phone">
						<span>您的預算</span>
						<select class="money" name="budget_range">
							<option value="請選擇預算金額">請選擇預算金額</option>
						</select>
						<div class="textContactFormMoneyFixed">
							<span>預算欄位僅供參考，每個客製化專案皆可依客戶需求給予報價</span>
						</div>
					</div>
				</div>
				</form>
			</div>
			<noscript style="display:none;"><img style="display:none;" height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1037100439/?label=54GrCKiolVYQl8vD7gM&amp;guid=ON&amp;script=0"/></noscript>
		</div>
	</div>
	<div class="phone_content">
		<div class="textContact">
			<div class="textContactContent">
				<h2>聯繫 <b>C</b>ontact</h2>
				<p  class="title_p"><b>立即聯繫我們，讓我們為客戶打造一流品牌形象</b></p>
				<div class="stage">
					<img class="pic" src="img/time.png">
					<p>早上 09:00 - 12:30</p>
					<p>下午 13:30 - 18:20</p>
				</div>
				<div class="stage">
					<img class="pic" src="img/tel.png">
					<p>業務部 (02)2816-4533 #333</p>
					<p>傳真機 (02)2816-4538</p>
				</div>
				<div class="stage">
					<img class="pic" src="img/email.png">
					<p><a href="mailto:service@fanswoo.com">service@fanswoo.com</a></p>
					<p><a href="mailto:yi@fanswoo.com">yi@fanswoo.com</a></p>
				</div>
				<div class="stage">
					<img class="pic" src="img/add.png">
					 <p>台北市大南路 419 號 6 樓</p>
					 <p>6F., No.419, Danan Rd., Shilin Dist., Taipei City 111, Taiwan (R.O.C.)</p>
				</div>
			</div>
		</div>
		<div class="textContactForm">
			<div class="textContactFormContent">
				<div class="textContactFormClose"></div>
				<?=form_open("contact/contact_post")?>
				<div class="leftBox">
					<h2>線上諮詢 / 索取報價</h2>
					<div class="area">
						<span>詢問項目：</span>
						<select class="need" name="classtype">
							<option value="請先選擇主要詢問項目">請先選擇主要詢問項目</option>
						</select>
					</div>
					<div class="area">
						<span>項目細節：</span>
						<select class="need_child" name="classtype2">
							<option value="請先選擇次要詢問項目">請先選擇次要詢問項目</option>
						</select>
					</div>
					<div class="area phone" >
						<span>您的預算：</span>
						<select class="money" name="budget_range">
							<option value="請選擇預算金額">請選擇預算金額</option>
						</select>
						<div class="textContactFormMoneyFixed">
							<span>預算欄位僅供參考，每個客製化專案皆可依客戶需求給予報價</span>
						</div>
					</div>
				</div>
				<div class="rightBox">
					<p>您的姓名：<input type="text" class="name" name="name" placeholder="請填寫您的姓名"></p>
					<p>公司名稱：<input type="text" class="company" name="company" placeholder="請填寫公司名稱"></p>
					<p>聯繫電話：<input type="text" class="telphone" name="phone" placeholder="請填寫聯繫電話"></p>
					<p>電子郵件：<input type="text" class="email" name="email" placeholder="請填寫電子郵件"></p>
					<p>公司地址：<input type="text" class="address" name="address" placeholder="請填寫公司地址"></p>
					<textarea name="text"></textarea>
					<p style="text-align:center;">本公司設計案件較多，為盡早處理您的專案，請提前詢問及索取報價資訊。</p>
					<input type="submit" value="送出" class="contactSubmit" name="contactSubmit">
				</div>
				</form>
			</div>
			<noscript style="display:none;"><img style="display:none;" height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1037100439/?label=54GrCKiolVYQl8vD7gM&amp;guid=ON&amp;script=0"/></noscript>
		</div>
	</div>
<?=$temp['footer_bar']?>
<?=$temp['body_end']?>