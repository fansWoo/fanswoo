<div class="contact_content_area">
	<h1>聯繫我們</h1>
	<div class="title_box">
		<div class="line1"></div>
		<p>本公司設計案件較多，為盡早處理您的專案，請提前詢問或索取估價資訊</p>
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
							<option value="請先選擇主要詢問項目">請先選擇主要詢問項目</option>
						</select>
					</div>
					<div class="area">
						<p>項目細節</p>
						<select class="need_child" name="classtype2">
							<option value="請先選擇次要詢問項目">請先選擇次要詢問項目</option>
						</select>
					</div>
					<div class="area phone">
						<p>您的預算</p>
						<select class="money" name="budget_range">
							<option value="請選擇預算金額">請選擇預算金額</option>
						</select>
						<div class="textContactFormMoneyFixed">
							<span>預算欄位僅供參考，每個客製化專案皆可依客戶需求給予報價</span>
						</div>
					</div>
				</div>
				<div class="rightBox">
					<textarea name="content" placeholder="我還想補充..."></textarea>
				</div>
				<div class="price_choose" style="display: none;">
				</div>
				<div class="choose_box_copy" style=" display: none;">
					<h3>預算</h3>
					<div class="circle"><input type="hidden" name="budget_range" value="" disabled></div>
					<h4>文字</h4>
				</div>
				<input type="submit" value="立即聯繫" class="contactSubmit" name="contactSubmit">
			</form>
		</div>
	</div>
</div>