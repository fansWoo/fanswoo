<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title?> - <?=$child3_title?></h2>
<?if(empty($user_UserFieldShop->uid)):?>
<div class="contentBox allWidth">
    <h3><?=$child3_title?> > <?if(!empty($user_UserFieldShop->uid)):?>編輯<?else:?>新增<?endif?></h3>
    <h4>請填寫<?=$child3_title?>之詳細資訊</h4>
    <?php echo form_open_multipart("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_adduser_post/") ?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                會員電子郵件
            </div>
            <div class="spanLineLeft width200">
                <input type="text" name="email" class="text" placeholder="請輸入會員的電子郵件" required>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                會員密碼
            </div>
            <div class="spanLineLeft width200">
                <input type="password" name="password" class="text" placeholder="請輸入8-16字元的密碼" required>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                確認密碼
            </div>
            <div class="spanLineLeft width200">
                <input type="password" name="password2" class="text" placeholder="請再次輸入8-16字元的密碼" required>
            </div>
        </div>
    </div>
    <div class="spanLine spanSubmit">
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <input type="submit" class="submit" value="新增會員">
            </div>
        </div>
    </div>
    </form>
</div>
<?endif?>
<?if(!empty($user_UserFieldShop->uid)):?>
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
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                會員群組
            </div>
            <div class="spanLineLeft width300">
                <?if(!empty($user_UserFieldShop->group_UserGroupList->obj_arr)):?>
                <div>
                    <select name="groupids_arr[]">
                        <option value="">沒有分類標籤</option>
                        <?foreach($UserGroupList->obj_arr as $key2 => $value2_UserGroup):?>
                        <option value="<?=$value2_UserGroup->groupid?>"<?if($user_UserFieldShop->group_UserGroupList->obj_arr[0]->groupid == $value2_UserGroup->groupid):?> selected<?endif?>><?=$value2_UserGroup->groupname?></option>
                        <?endforeach?>
                    </select>
                </div>
                <?else:?>
                <div>
                    <select name="groupids_arr[]">
                        <option value="">沒有分類標籤</option>
                        <?foreach($UserGroupList->obj_arr as $key => $value_UserGroup):?>
                        <option value="<?=$value_UserGroup->groupid?>"><?=$value_UserGroup->groupname?></option>
                        <?endforeach?>
                    </select>
                </div>
                <?endif?>
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
                <?if(!empty($user_UserFieldShop->uid)):?><span class="submit gray" onClick="fanswoo.check_href_action('刪除後將進入回收空間，確定要刪除嗎？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?uid=<?=$user_UserFieldShop->uid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除<?=$child3_title?></span><?endif?>
            </div>
        </div>
	</div>
	</form>
</div>
<?endif?>
<?if(!empty($user_UserFieldShop->uid)):?>
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
<div class="contentBox allWidth">
    <h3><?=$child3_title?> > 商店資料編輯</h3>
    <h4>請填寫<?=$child3_title?>商店資料編輯之詳細資訊</h4>
    <?php echo form_open_multipart("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_userfieldshop_post/") ?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                會員折扣金
            </div>
            <div class="spanLineLeft width200">
                <input type="text" class="text" name="coupon_count" placeholder="請輸入會員折扣金" value="<?=$user_UserFieldShop->coupon_count?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                常用收件人姓名
            </div>
            <div class="spanLineLeft width200">
                <input type="text" class="text" name="receive_name" placeholder="請輸入收件人姓名" value="<?=$user_UserFieldShop->receive_name?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                常用收件人電話
            </div>
            <div class="spanLineLeft width200">
                <input type="text" class="text" name="receive_phone" placeholder="請輸入收件人電話" value="<?=$user_UserFieldShop->receive_phone?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                常用收件人地址
            </div>
            <div class="spanLineLeft width200">
                <input type="text" class="text" name="receive_address" placeholder="請輸入收件人地址" value="<?=$user_UserFieldShop->receive_address?>">
            </div>
        </div>
    </div>
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
<?endif?>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>