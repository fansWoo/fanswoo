<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title?> - <?=$child3_title?></h2>
<div class="contentBox allWidth">
    <h3><?=$this->lang->line('common_website_title_management')?></h3>
    <h4>請填寫標題之詳細資訊</h4>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                網站標題名稱
            </div>
            <div class="spanLineLeft">
                <input type="text" class="text" name="website_title_name" placeholder="請輸入網站標題名稱" value="<?=$global['website_title_name']?>" required>
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <p class="gray">本網站標題名稱將於網站標題最前端顯示</p>
            </div>
        </div>
	</div>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>