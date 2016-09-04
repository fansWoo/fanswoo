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
			var need_html = need_html + '<option value="' + contact_selector_arr[key].name + '"' + '>' + contact_selector_arr[key].name + '</option>';
		}
		// 將 need_html 寫到 <select> 裡面
		$('.need').html( need_html );
		
		// 當 select.need 的值發生變化的時候，執行以下內容
		$(document).on('change', 'select.need', function(){

			$('select.need').val($(this).val());

			//建立 need_child_html 變數作為暫時的 HTML 內文
			var need_child_html = '<option value="" style="color:#CCC;">請先選擇次要詢問項目</option>';
			var need_child_money = '<option value="" style="color:#CCC;">請選擇預算金額</option>';

			//迴圈 contact_selector_arr 
			for( key in contact_selector_arr )
			{
				// 如果 key 等於使用者選擇的內容的話，就將指定的內容抓到 need_child_html 內
				if( $('select.need').val() == contact_selector_arr[key].name )
				{
					for( key2 in contact_selector_arr[key].child )
					{
						var need_child_html = need_child_html + '<option value="' + contact_selector_arr[key].child[key2].name + '"' + '>' + contact_selector_arr[key].child[key2].name + '</option>';
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
			
			var need_child_money = '<option value="" style="color:#CCC;">請選擇預算金額</option>';

			//迴圈 contact_selector_arr 
			for( key in contact_selector_arr )
			{
				if( $('select.need').val() == contact_selector_arr[key].name )
				{
					//迴圈 contact_selector_arr[key].child
					for( key2 in contact_selector_arr[key].child )
					{
						if( $('select.need_child').val() == contact_selector_arr[key].child[key2].name )
						{
							//迴圈 contact_selector_arr[key].child[key2].budget
							for( key3 in contact_selector_arr[key].child[key2].budget )
							{
								var need_child_money = need_child_money + '<option value="' + contact_selector_arr[key].child[key2].budget[key3].range + '"' + '>' + contact_selector_arr[key].child[key2].budget[key3].range + '</option>';
							}
						}
					}
				}
				// 將 need_child_html 寫到 <select> 裡面
				$('.money').html( need_child_money );
			}
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