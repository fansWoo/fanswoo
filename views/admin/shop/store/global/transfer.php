<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title?> - <?=$child3_title?></h2>
<div class="contentBox allWidth">
    <h3>轉帳帳號管理</h3>
    <h4>請填寫轉帳帳號資訊，將顯示於使用者結帳畫面</h4>
    <?php echo form_open_multipart("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                銀行代號
            </div>
            <div class="spanLineLeft width300">
                <input type="text" class="text" name="bank_code" placeholder="請填寫銀行代號" value="<?=$transfer_SettingList->obj_arr['bank_code']->value?>" required>
            </div>
        </div>
	</div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                銀行帳號
            </div>
            <div class="spanLineLeft width300">
                <input type="text" class="text" name="bank_account" placeholder="請填寫銀行帳號" value="<?=$transfer_SettingList->obj_arr['bank_account']->value?>" required>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                銀行戶名
            </div>
            <div class="spanLineLeft width300">
                <input type="text" class="text" name="bank_account_name" placeholder="請填寫銀行戶名" value="<?=$transfer_SettingList->obj_arr['bank_account_name']->value?>" required>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                備註
            </div>
            <div class="spanLineLeft width300">
                <textarea name="bank_account_remark" placeholder="請填寫備註"><?=$transfer_SettingList->obj_arr['bank_account_remark']->value?></textarea>
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
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>