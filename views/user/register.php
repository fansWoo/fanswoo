<?=$temp['header_up']?>
<?=$temp['header_down']?>
<div class="userBox">
	<h2>會員註冊</h2>
	<div class="userBoxContent">
		<div class="message">
			<p>請填寫您的註冊資料，或<a href="user/login">登入</a>您的帳號</p>
			<?=$validation_errors?>
		</div>
		<?=form_open('user/register_post')?>
			<div class="paragraph">
				<p>會員電子郵件：</p>
				<p><input type="text" name="email" placeholder="請輸入您的電子郵件"></p>
			</div>
			<div class="paragraph">
				<p>會員密碼：</p>
				<p><input type="password" name="password" placeholder="請輸入您的密碼"></p>
			</div>
			<div class="paragraph">
				<p>確認密碼：</p>
				<p><input type="password" name="password2" placeholder="請再次輸入密碼"></p>
			</div>
			<?if( !empty($google_recaptcha_Setting->value) ):?>
			<div class="paragraph" style=" margin-bottom: 20px;">
				<script src='https://www.google.com/recaptcha/api.js'></script>
				<div class="g-recaptcha" style=" transform:scale(1.12); transform-origin:0 0;" data-sitekey="6LfvihsTAAAAAITvx4rzebY3WfyWjDbUfMyBBTMQ"></div>
			</div>
			<?endif?>
			<div class="paragraph">
				<input type="submit" value="確認送出">
			</div>
		</form>
	</div>
	<div class="userBoxOther">
		<p><a href="user/login">會員登入</a></p>
		<p><a href="user/forgetpsw">忘記密碼？</a></p>
		<p><a href="<?=base_url()?>">回到首頁</a></p>
	</div>
</div>
<?=$temp['body_end']?>