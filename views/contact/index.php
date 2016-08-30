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

	$(window).resize(function(){
		location.href = ' contact ';
	});
	//聯繫頁變更
	$(document).on('mouseenter', '.textContactForm', function(){
		$('.textContactForm').addClass('hover');
		$('.textContact').addClass('hidden');
	});
	$(document).on('click', '.textContactFormClose', function(){
		$('.textContactForm').removeClass('hover');
		$('.textContact').removeClass('hidden');
	});
	
	//聯繫頁預算欄位
	// $(document).on('focus', '.textContactForm.hover .money', function(){
	// 	$('.textContactFormMoneyFixed').addClass('hover');
	// });
	// $(document).on('blur', '.textContactForm.hover .money', function(){
	// 	$('.textContactFormMoneyFixed').removeClass('hover');
	// });
	// $(document).on('change', '.textContactForm.hover .money', function(){
	// 	$('.textContactForm.hover .money').blur();
	// });
	
	// //
	// $(document).on('focus', '.textContactForm.hover .need, .textContactForm.hover .need_child, .textContactForm.hover .money', function(){
	// 	$(this).find("option[value='']").remove();
	// });
	
	// $(document).on('focus', '.textContactForm.hover .need', function(){
	// 	$('.textContactForm.hover .need').change();
	// });
		
	// $(document).on('change', '.textContactForm.hover .need', function(){
	// 	var selected = $(this).val();

	// 	$('.need_child').css('display', 'none');
	// 	$('.need_child').addClass('displaynone');
	// 	$(".need_child[data-selected='" + selected + "']").css('display', 'block');
	// 	$(".need_child[data-selected='" + selected + "']").attr('name', 'classtype2');
	// 	$('.need_child option').removeAttr('selected');
	// 	$(".need_child[data-selected='" + selected + "'] option:first").attr('selected', true);

	// 	$('.money').css('display', 'none');
	// 	$('.money').addClass('displaynone');
	// 	$(".money[data-selected='" + selected + "']").css('display', 'block');
	// 	$(".money[data-selected='" + selected + "']").attr('name', 'classtype2');
	// 	$('.money option').removeAttr('selected');
	// 	$(".money[data-selected='" + selected + "'] option:first").attr('selected', true);
	// });



	/* <![CDATA[ */
	var google_conversion_id = 1037100439;
	var google_conversion_language = "en";
	var google_conversion_format = "3";
	var google_conversion_color = "ffffff";
	var google_conversion_label = "54GrCKiolVYQl8vD7gM";
	var google_remarketing_only = false;
	/* ]]> */
});
$(function(){

	//表單預算取得的程式
	$.ajax({ //使用 AJAX 取得 JSON 格式的資料檔
        url: $('base').attr('href') + 'js/contact_form_json.js', //JSON 格式的設定檔的位置
        type: 'GET', // 取得方式使用 GET
        dataType: 'json' // 取得以後的型別為 JSON
    })
	.done(function(response){ // 如果成功使用 AJAX 取得檔案以後即執行裡面的程式

		var contact_selector_arr = response;

		// need_html 定義為 <select> 內的 HTML 內文
		var need_html = '<option value="" style="color:#CCC;">請先選擇主要詢問項目</option>';
		// 將 contact_selector_arr 內的 JSON 印出來，轉換成 <option>
		for( key in contact_selector_arr )
		{
			var need_html = need_html + '<option value="' + key + '"' + '>' + contact_selector_arr[key].name + '</option>';
		}
		// 將 need_html 寫到 <select> 裡面
		$('.need').html( need_html );
		
		// 當 select.need 的值發生變化的時候，執行以下內容
		$(document).on('change', 'select.need', function(){

			$('select.need').val($(this).val());
			// 把預算欄位暫時隱藏
			//$('.money').css('display', 'none');

			//建立 need_child_html 變數作為暫時的 HTML 內文
			var need_child_html = '<option value="" style="color:#CCC;">請選擇次要詢問項目</option>';
			var need_child_money = '<option value="" style="color:#CCC;">請先選擇預算金額</option>';

			//迴圈 contact_selector_arr 
			for( key in contact_selector_arr )
			{
				// 如果 key 等於使用者選擇的內容的話，就將指定的內容抓到 need_child_html 內
				if( $('select.need').val() == key )
				{
					for( key2 in contact_selector_arr[key].child )
					{
						var need_child_html = need_child_html + '<option value="' + key2 + '"' + '>' + contact_selector_arr[key].child[key2].name + '</option>';
					}
				}

				if( $('select.need.phone').val() == key )
				{
					for( key2 in contact_selector_arr[key].child )
					{
						var need_child_html = need_child_html + '<option value="' + key2 + '"' + '>' + contact_selector_arr[key].child[key2].name + '</option>';
					}
				}
			}

			

			// 將 need_child_html 寫到 <select> 裡面
			$('.need_child').html( need_child_html );
			$('.money').html( need_child_money );

		});
		
		// 當 select.need_child 的值發生變化的時候，執行以下內容
		$(document).on('change', 'select.need_child', function(){

			$('select.need_child').val($(this).val());
			
			var need_child_money = '<option value="" style="color:#CCC;">請先選擇預算金額</option>';
			//迴圈 contact_selector_arr 
			for( key in contact_selector_arr )
			{
				if( $('select.need').val() == key )
				{
					//迴圈 contact_selector_arr[key].child
					for( key2 in contact_selector_arr[key].child )
					{
						if( $('select.need_child').val() == key2 )
						{
							//迴圈 contact_selector_arr[key].child[key2].budget
							for( key3 in contact_selector_arr[key].child[key2].budget )
							{
								// 複製 .choose_box_copy 作為模板
								// $clone = $('.area.PHO').clone();

								//$clone.css('display', 'block');
								// $clone.removeClass('choose_box_copy');
								// $clone.addClass('choose_box');

								// $clone.find('h3').text( contact_selector_arr[key].child[key2].budget[key3].range );
								// $clone.find('h4').text( contact_selector_arr[key].child[key2].budget[key3].text );
								// $clone.find("input[name='budget_range']").val( contact_selector_arr[key].child[key2].budget[key3].text );

								//複製 $clone 插入 money
								//$clone.appendTo(".money");
								var need_child_money = need_child_money + '<option value="' + key3 + '"' + '>' + contact_selector_arr[key].child[key2].budget[key3].range + '</option>';
							}
						}
					}
				}
				// 將 need_child_html 寫到 <select> 裡面
				$('.money').html( need_child_money );
			}

			// $('.money').css('display', 'block');
			// $('.money').prepend('<p>預算選擇</p>');

			//點選第一個預算選項
			// $('.money .choose_box:eq(0)').click();
		});
	})
　　.fail(function(response){ // 如果 AJAX 取值錯誤的話，執行此行
        fanswoo.message_show(
            'AJAX傳輸錯誤...',
            2
        );
    });

	//選擇預算
	$(document).on('click', '.choose_box', function(){
		$('.choose_box').removeClass('hover');
		$('.choose_box').find("h4").removeClass('hover');
		$('.choose_box').find("[name='budget_range']").attr('disabled', 'disabled');
		$(this).addClass('hover');
		$(this).find("h4").addClass('hover');
		$(this).find("[name='budget_range']").removeAttr('disabled');
	});

});
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js"></script>
<noscript style="display:none;"><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6020797556140&amp;cd[value]=0.00&amp;cd[currency]=TWD&amp;noscript=1" /></noscript>
<?=$temp['header_down']?>
	<div class="pencil">fansWoo</div>
	<div class="plane">fansWoo</div>
	<div class="bg1">fansWoo</div>
	<div class="bg2"></div>
<?=$temp['header_bar']?>
	
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
					<!--<?=validation_errors()?>-->
					<p>您的姓名：<input type="text" class="name" name="username" placeholder="請填寫您的姓名" required></p>
					<p>公司名稱：<input type="text" class="company" name="company" placeholder="請填寫公司名稱" required></p>
					<p>聯繫電話：<input type="tel" class="telphone" name="phone" placeholder="請填寫聯繫電話" required></p>
					<p>電子郵件：<input type="email" class="email" name="email" placeholder="請填寫電子郵件" required></p>
					<p>公司地址：<input type="text" class="address" name="address" placeholder="請填寫公司地址" required></p>
					<textarea name="content"></textarea>
					<p>本公司設計案件較多，為盡早處理您的專案，請提前詢問及索取報價資訊。</p>
					<input type="submit" value="送出" class="contactSubmit" name="contactSubmit">
					<input type="hidden" name="previous_url" value="<?=$previous_url?>">
				</div>
				<div class="leftBox">
					<h2>線上諮詢 / 索取報價</h2>
					<!-- <div class="area">
						<span>詢問項目：</span>
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
						<span>項目細節：</span>
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
					<div class="area">
						<div class="textContactFormMoneyFixed">
							預算欄位僅供參考，每個客製化專案皆可依客戶需求給予報價
						</div>
						<span>您的預算：</span>
						<select class="money">
							<option value="先選擇主要項目">先選擇主要項目</option>
						</select>
						<select class="money one" data-selected="網站開發" name="money"  style="display:none;" > 
							<option value="">請選擇預算</option>
							<option value="25 萬元 ~ 50 萬元">25~50萬</option>
							<option value="50 萬元 ~ 100 萬元">50~100萬</option>
							<option value="100 萬元 ~ 150 萬元">100~200萬</option>
							<option value="150 萬元 ~ 200 萬元">200萬以上</option>
						</select>
						<select class="money three" data-selected="程式系統開發" name="money"  style="display:none;"> 
							<option value="">請選擇預算</option>
							<option value="25 萬元 ~ 50 萬元">50~100萬</option>
							<option value="50 萬元 ~ 100 萬元">100~200萬</option>
							<option value="100 萬元 ~ 150 萬元">200~300萬</option>
							<option value="150 萬元 ~ 200 萬元">300萬以上</option>
						</select>
						<select class="money two" data-selected="美術設計" name="money"  style="display:none;">
							<option value="">請選擇預算</option>
							<option value="25 萬元 ~ 50 萬元">35~70萬</option>
							<option value="50 萬元 ~ 100 萬元">70~150萬</option>
							<option value="100 萬元 ~ 150 萬元">150~300萬</option>
							<option value="150 萬元 ~ 200 萬元">300萬以上</option>
						</select>
						<select class="money four" data-selected="網路行銷" name="money"  style="display:none;">
							<option value="">請選擇預算</option>
							<option value="25 萬元 ~ 50 萬元">10萬/月</option>
							<option value="50 萬元 ~ 100 萬元">20萬/月</option>
							<option value="100 萬元 ~ 150 萬元">50萬/月</option>
							<option value="150 萬元 ~ 200 萬元">100萬/月</option>
						</select>
						<select class="money five" data-selected="伺服器租賃" name="money"  style="display:none;">
							<option value="">請選擇預算</option>
							<option value="25 萬元 ~ 50 萬元">8000/月</option>
							<option value="50 萬元 ~ 100 萬元">18000/月</option>
							<option value="100 萬元 ~ 150 萬元">38000/月</option>
							<option value="150 萬元 ~ 200 萬元">依流量代管</option>
						</select>
					</div> -->
					<div class="area">
						<p>詢問項目</p>
						<select class="need" name="classtype">
							<option value="請先選擇主要詢問項目">請先選擇主要詢問項目</option>
						</select>
					</div>
					<div class="area">
						<p>項目細節</p>
						<select class="need_child" name="classtype2">
							<option value="請先選擇主要詢問項目">請先選擇主要詢問項目</option>
						</select>
					</div>
					<div class="area phone">
						<p>您的預算</p>
						<select class="money" name="money">
							<option value="請先選擇預算金額">請先選擇預算金額</option>
						</select>
						<div class="textContactFormMoneyFixed">
							<span>預算欄位僅供參考，每個客製化專案皆可依客戶需求給予報價</span>
						</div>
					</div>
					<!-- <div class="area phone">
						<span>您的預算：</span>
						<select class="money">
						</select>
						<div class="textContactFormMoneyFixed">
							<span>預算欄位僅供參考，每個客製化專案皆可依客戶需求給予報價</span>
						</div>
					</div> -->
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
					 <p class="p">台北市重慶北路四段 248 號 4 樓</p>
					 <p>3F., No.248, Sec. 4, Chongqing N. Rd., Shilin Dist., Taipei City 111, Taiwan (R.O.C.)</p>
				</div>
			</div>
		</div>
		<div class="textContactForm">
			<div class="textContactFormContent">
				<div class="textContactFormClose"></div>
				<?php echo form_open('contact/contact_post') ?>
				<div class="leftBox">
					<h2>線上諮詢 / 索取報價</h2>
					<!-- <div class="area">
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
						<div class="textContactFormMoneyFixed">
							預算欄位僅供參考，每個客製化專案皆可依客戶需求給予報價
						</div>
						<span>您的預算：</span>
						<select class="money">
							<option value="先選擇主要項目">先選擇主要項目</option>
						</select>
						<select class="money one" data-selected="網站開發" name="money"  style="display:none;" > 
							<option value="">請選擇預算</option>
							<option value="25 萬元 ~ 50 萬元">25~50萬 >>> 感到耳目一新</option>
							<option value="50 萬元 ~ 100 萬元">50~100萬 >>> 印象非常深刻</option>
							<option value="100 萬元 ~ 150 萬元">100~200萬 >>> 加上多種功能</option>
							<option value="150 萬元 ~ 200 萬元">200萬以上 >>> 前所未見的設計</option>
						</select>
						<select class="money three" data-selected="程式系統開發" name="money"  style="display:none;"> 
							<option value="">請選擇預算</option>
							<option value="25 萬元 ~ 50 萬元">50~100萬 >>> 簡易客製化 Web App</option>
							<option value="50 萬元 ~ 100 萬元">100~200萬 >>> 簡易客製化 Hybrid App</option>
							<option value="100 萬元 ~ 150 萬元">200~300萬 >>> 簡易客製化 Native App</option>
							<option value="150 萬元 ~ 200 萬元">300萬以上 >>> 高難度客製化 Native App</option>
						</select>
						<select class="money two" data-selected="美術設計" name="money"  style="display:none;">
							<option value="">請選擇預算</option>
							<option value="25 萬元 ~ 50 萬元">35~70萬 >>> 客製化風格設計</option>
							<option value="50 萬元 ~ 100 萬元">70~150萬 >>> 少量客製化系統</option>
							<option value="100 萬元 ~ 150 萬元">150~300萬 >>> 大量客製化系統</option>
							<option value="150 萬元 ~ 200 萬元">300萬以上 >>> 高難度的系統</option>
						</select>
						<select class="money four" data-selected="網路行銷" name="money"  style="display:none;"> 
							<option value="">請選擇預算</option>
							<option value="25 萬元 ~ 50 萬元">10萬/月 >>> 一般曝光</option>
							<option value="50 萬元 ~ 100 萬元">20萬/月 >>> 精準曝光</option>
							<option value="100 萬元 ~ 150 萬元">50萬/月 >>> 高強度曝光</option>
							<option value="150 萬元 ~ 200 萬元">100萬/月 >>> 包覆性曝光</option>
						</select>
						<select class="money five" data-selected="伺服器租賃" name="money"  style="display:none;">
							<option value="">請選擇預算</option>
							<option value="25 萬元 ~ 50 萬元">8000/年 >>> 微型主機</option>
							<option value="50 萬元 ~ 100 萬元">18000/年 >>> 一般主機</option>
							<option value="100 萬元 ~ 150 萬元">38000/年 >>> 商務主機</option>
							<option value="150 萬元 ~ 200 萬元">依流量代管 >>> 客製化主機</option>
						</select>
					</div> -->
					<div class="area">
						<span>詢問項目：</span>
						<select class="need" name="classtype">
							<option value="請先選擇主要詢問項目">請先選擇主要詢問項目</option>
						</select>
					</div>
					<div class="area">
						<span>項目細節：</span>
						<select class="need_child" name="classtype2">
							<option value="請先選擇主要詢問項目">請先選擇主要詢問項目</option>
						</select>
					</div>
					<div class="area phone" >
						<div class="textContactFormMoneyFixed">
							<span>預算欄位僅供參考，每個客製化專案皆可依客戶需求給予報價</span>
						</div>
						<span>您的預算：</span>
						<select class="money" name="money">
							<option value="請先選擇預算金額">請先選擇預算金額</option>
						</select>
						
					</div>
				</div>
				<div class="rightBox">
					<?=validation_errors()?>
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