<?=$temp['header_up']?>
<script>
$(function(){
});
</script>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2>專案管理 - 確認專案</h2>
<div class="contentBox allWidth">
    <?php echo form_open("admin/$child1_name_Str/$child2_name_Str/$child3_name_Str/{$child4_name_Str}_post/") ?>
	<h3>專案資訊</h3>
	<h4>請確認專案內容與款項資訊</h4>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                專案編號
            </div>
            <div class="spanLineLeft width500">
                <?if(!empty($Project->projectid_Num)):?><?=$Project->projectid_Num?><?endif?>
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                訂購會員
            </div>
            <div class="spanLineLeft width500">
                <?if(!empty($Project->uid_User->email_Str)):?><?=$Project->uid_User->email_Str?><?endif?>
                （會員編號：<?if(!empty($Project->uid_Num)):?><?=$Project->uid_Num?><?endif?>）
		    </div>
		</div>
	</div>
    <div style="border-top: 2px #AAA dashed;margin:30px 0;"></div>
	<h3>付款資訊</h3>
	<h4>請確認本訂單之付款資訊</h4>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                付款方式
            </div>
            <div class="spanLineLeft">
                ATM轉帳
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                付款總金額
            </div>
            <div class="spanLineRight">
                NT$ <?=$Project->pay_price_total_Num?>
		    </div>
		</div>
	</div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                收款資訊
            </div>
            <div class="spanLineLeft width400">
                收款銀行： <?=$transfer_SettingList->obj_Arr['bank_code']->value_Str?>
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineLeft width400">
                收款帳號： <?=$transfer_SettingList->obj_Arr['bank_account']->value_Str?>
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineLeft width400">
                銀行戶名： <?=$transfer_SettingList->obj_Arr['bank_account_name']->value_Str?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                轉帳帳號
            </div>
            <div class="spanLineLeft">
                <?if($Project->pay_status_Num == 1):?>
                <?=$Project->pay_account_Str?>
                <?else:?>
                <input type="text" class="text" name="pay_account_Str">
                <?endif?>
            </div>
        </div>
    </div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                轉帳人姓名
            </div>
            <div class="spanLineLeft">
                <?if($Project->pay_status_Num == 1):?>
                <?=$Project->pay_name_Str?>
                <?else:?>
                <input type="text" class="text" name="pay_name_Str">
                <?endif?>
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                轉帳時間
            </div>
            <div class="spanLineLeft">
                <?if($Project->pay_status_Num == 1):?>
                <?=$Project->pay_paytime_DateTimeObj->datetime_Str?>
                <?else:?>
                <script src="fanswoo-framework/js/jquery-ui-timepicker-addon/script.js"></script>
                <link rel="stylesheet" type="text/css" href="fanswoo-framework/js/jquery-ui-timepicker-addon/style.css"></link>
                <script>
                $(function(){
                    $('#pay_paytime_Str').datetimepicker({
                        dateFormat: 'yy-mm-dd',
                        timeFormat: 'HH:mm:ss'
                    });
                });
                </script>
                <input type="text" class="text" id="pay_paytime_Str" name="pay_paytime_Str">
                <?endif?>
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                付款備註
            </div>
            <div class="spanLineLeft width500">
                <?if($Project->pay_status_Num == 1):?>
                <?=$Project->pay_remark_Str?>
                <?else:?>
                <textarea name="pay_remark_Str"></textarea>
                <?endif?>
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                付款狀態
            </div>
            <div class="spanLineLeft width500">
                <?if($Project->pay_status_Num == 0):?>
                <span class="red">會員尚未填寫付款資訊</span>
                <?elseif($Project->pay_status_Num == 1):?>
                <span class="green">會員已填寫付款資訊</span>
                <?endif?>
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                款項確認狀態
            </div>
            <div class="spanLineLeft width500">
                <span class="<?if($Project->paycheck_status_Num == 0):?>red<?elseif($Project->paycheck_status_Num == 1):?>green<?endif?>">
                    <?if($Project->paycheck_status_Num == 0):?>款項待確認<?endif?>
                    <?if($Project->paycheck_status_Num == 1):?>款項已確認<?endif?>
                </span>
		    </div>
		</div>
	</div>
    <div style="border-top: 2px #AAA dashed;margin:30px 0;"></div>
	<h3>設計項目列表</h3>
	<h4>請確認設計項目列表</h4>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                設計項目列表
            </div>
            <div class="spanLineLeft width300">
                設計項目
		    </div>
            <div class="spanLineLeft width100 aligncenter">
                單價
            </div>
		</div>
	</div>
    <?if(!empty($Project->designids_Str)):?>
    <?foreach($DesignPriceList->obj_Arr as $key => $value_DesignPrice):?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineLeft width300" style="color:#027de5">
                <?=$value_DesignPrice->title_Str?>
            </div>
            <div class="spanLineLeft width100 aligncenter">
                <?=$value_DesignPrice->price_Num?>
            </div>
        </div>
    </div>
    <?endforeach?>
    <?else:?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineLeft width300" style="color:#027de5">
            </div>
            <div class="spanLineLeft width100 aligncenter">
            </div>
        </div>
    </div>
    <?endif?>
    <div style="border-top: 2px #AAA dashed;margin:30px 0;"></div>
    <h3>專案修改建議</h3>
    <h4>請確認專案修改建議</h4>
    <div class="spanLine">
        <?if( !empty($Project->comment_CommentList->obj_Arr) ):?>
        <div class="spanStage">
            <div class="spanLineLeft">
                專案修改建議
            </div>
            <div class="spanLineLeft width500">
                <?foreach($Project->comment_CommentList->obj_Arr as $key => $value_Comment):?>
                <p><?=$value_Comment->uid_User->username_Str?> <span class="gray"><?=$value_Comment->updatetime_DateTime->datetime_Str?></span></p>
                <div style="word-wrap:break-word;"><?=$value_Comment->content_Html?></div>
                <div style="border-top: 1px #CCC dashed;margin:10px 0;"></div>
                <?endforeach?>
            </div>
        </div>
        <?endif?>
        <div class="spanStage">
            <div class="spanLineLeft">
                <?if( empty($Project->comment_CommentList->obj_Arr) ):?>
                專案修改建議
                <?endif?>
            </div>
            <div class="spanLineLeft width500">
                <textarea cols="80" name="content_Str" rows="10" placeholder="請填寫新的專案修改建議..."></textarea>
            </div>
        </div>
    </div>
    <div style="border-top: 2px #AAA dashed;margin:30px 0;"></div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案開始時間
            </div>
            <div class="spanLineLeft width500">
                <?=$Project->setuptime_DateTimeObj->datetime_Str?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案所需時程
            </div>
            <div class="spanLineLeft width500">
                <?=$Project->working_days_Num?> 天
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                最後更新時間
            </div>
            <div class="spanLineLeft width500">
                <?=$Project->updatetime_DateTimeObj->datetime_Str?>
            </div>
        </div>
    </div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                專案進行狀態
            </div>
            <div class="spanLineLeft width500" style="color:#027de5">
                <?if($Project->project_status_Num == 1):?>
                估價中
                <?elseif($Project->project_status_Num == 2):?>
                開發中
                <?elseif($Project->project_status_Num == 3):?>
                維護
                <?elseif($Project->project_status_Num == 4):?>
                結案
                <?endif?>
		    </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <p class="gray">訂單確認狀態選項經確認送出後，便無法再修改本訂單所有資料</p>
            </div>
		</div>
	</div>
	<div class="spanLine spanSubmit">
	    <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <?if(!empty($Project->projectid_Num)):?><input type="hidden" name="projectid_Num" value="<?=$Project->projectid_Num?>"><?endif?>
                <input type="submit" class="submit" value="儲存變更">
            </div>
        </div>
	</div>
	</form>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>