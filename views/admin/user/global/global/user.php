<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title?> - <?=$child3_title?></h2>
<div class="contentBox allWidth">
    <h3><?=$child3_title?> > 基本資料<?if(!empty($user_UserFieldShop->uid)):?>編輯<?else:?>新增<?endif?></h3>
	<h4>請填寫<?=$child3_title?>之詳細資訊</h4>
	<?php echo form_open_multipart("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                電子郵件帳號
            </div>
            <div class="spanLineLeft width200">
                <?=$user_UserFieldShop->email?>
            </div>
        </div>
    </div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                會員名稱
            </div>
            <div class="spanLineLeft width200">
                <input type="text" class="text" name="username" placeholder="請輸入會員名稱" value="<?=$user_UserFieldShop->username?>" required>
		    </div>
		</div>
	</div>
    <?if(!empty($user_UserFieldShop->uid)):?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                更新日期
            </div>
            <div class="spanLineLeft">
                <?=$user_UserFieldShop->updatetime_DateTime->datetime?>
            </div>
        </div>
    </div>
    <?endif?>
	<div class="spanLine spanSubmit">
	    <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <?if(!empty($user_UserFieldShop->uid)):?><input type="hidden" name="uid" value="<?=$user_UserFieldShop->uid?>"><?endif?>
                <input type="submit" class="submit" value="<?if(!empty($user_UserFieldShop->uid)):?>儲存變更<?else:?>新增會員<?endif?>">
            </div>
        </div>
	</div>
	</form>
</div>
<div class="contentBox allWidth">
    <h3><?=$child3_title?> > 變更密碼</h3>
    <h4>請填寫新的<?=$child3_title?>會員密碼</h4>
    <?php echo form_open_multipart("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_changepassword_post/") ?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                電子郵件帳號
            </div>
            <div class="spanLineLeft width200">
                <?=$user_UserFieldShop->email?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                變更密碼
            </div>
            <div class="spanLineLeft width200">
                <input type="password" class="text" name="password" placeholder="請輸入欲變更的會員密碼" required>
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
                
            </div>
            <div class="spanLineRight">
                <span class="gray">請輸入英文與數字結合之8-16個字元的密碼</span>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                確認密碼
            </div>
            <div class="spanLineLeft width200">
                <input type="password" class="text" name="password2" placeholder="請再次輸入欲變更的會員密碼" required>
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
                
            </div>
            <div class="spanLineRight">
                <span class="gray">請確認兩次輸入的密碼一致</span>
            </div>
        </div>
    </div>
    <?if(!empty($user_UserFieldShop->uid)):?>
    <div class="spanLine spanSubmit">
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <?if(!empty($user_UserFieldShop->uid)):?><input type="hidden" name="uid" value="<?=$user_UserFieldShop->uid?>"><?endif?>
                <input type="submit" class="submit" value="<?if(!empty($user_UserFieldShop->uid)):?>儲存變更<?else:?>新增會員<?endif?>">
            </div>
        </div>
    </div>
    <?endif?>
    </form>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>