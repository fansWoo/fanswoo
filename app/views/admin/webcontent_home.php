<?=$temp['header_up']?>
<?=$temp['admin_header_down']?>
<h2>內容管理 - 首頁內容</h2>
<div class="contentBox allWidth">
	<h3>首頁背景圖片</h3>
	<h4>請填寫首頁背景圖片之連結</h4>
	<?php echo form_open('admin/websiteset/set/title') ?>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                展示藝廊背景圖
            </div>
            <div class="spanLineLeft width300">
                <input type="text" class="text" name="website_title_name" placeholder="請輸入超連結，http://" value="">
            </div>
        </div>
	</div>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                優惠活動背景圖
            </div>
            <div class="spanLineLeft width300">
                <input type="text" class="text" name="website_title_name" placeholder="請輸入超連結，http://" value="">
            </div>
        </div>
	</div>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                最新消息背景圖
            </div>
            <div class="spanLineLeft width300">
                <input type="text" class="text" name="website_title_name" placeholder="請輸入超連結，http://" value="">
            </div>
        </div>
	</div>
	<div class="spanLine spanSubmit">
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <input type="submit" class="submit" value="儲存設置">
            </div>
        </div>
	</div>
	</form>
</div>
<?=$temp['admin_footer']?>