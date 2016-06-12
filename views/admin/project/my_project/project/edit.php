<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title?> - 專案資訊</h2>
<div class="contentBox allWidth">
    <?php echo form_open("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
	<h3>專案資訊</h3>
	<h4>請確認專案內容與款項資訊</h4>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                專案編號
            </div>
            <div class="spanLineLeft width500">
                <?=$Project->projectid?>
		    </div>
		</div>
	</div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案管理人
            </div>
            <div class="spanLineLeft width500">
                <?=$admin_User->email?>
            </div>
        </div>
    </div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                訂購會員
            </div>
            <div class="spanLineLeft width500">
                <?=$project_User->email?>（會員編號：<?=$project_User->uid?>）
		    </div>
		</div>
	</div>
</div>
<div class="contentBox allWidth">
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
                應付款金額
            </div>
            <div class="spanLineRight">
                NT$ <?=$Project->pay_price_total?>
		    </div>
		</div>
	</div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                已收款金額
            </div>
            <div class="spanLineRight">
                NT$ <?=$Project->pay_price_receive?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案付款進度
            </div>
            <div class="spanLineRight">
                <?if($Project->pay_price_schedule == 100):?>
                    <span class="green"><?=$Project->pay_price_schedule?> %</span>
                <?else:?>
                    <span class="red"><?=$Project->pay_price_schedule?> %</span>
                <?endif?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                收款資訊
            </div>
            <div class="spanLineLeft width400">
                收款銀行： <?=$transfer_SettingList->obj_arr['bank_code']->value?>
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineLeft width400">
                收款帳號： <?=$transfer_SettingList->obj_arr['bank_account']->value?>
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineLeft width400">
                銀行戶名： <?=$transfer_SettingList->obj_arr['bank_account_name']->value?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                轉帳帳號
            </div>
            <div class="spanLineLeft">
                <?if($Project->paycheck_status == 0):?>
                    <input type="text" class="text" name="pay_account" value="<?=$Project->pay_account?>" required>
                <?else:?>
                    <?=$Project->pay_account?>
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
                <?if($Project->paycheck_status == 0):?>
                    <input type="text" class="text" name="pay_name" value="<?=$Project->pay_name?>" required>
                <?else:?>
                    <?=$Project->pay_name?>
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
                <?if($Project->paycheck_status == 0):?>
                    <script src="js/fanswoo-framework/tool/jquery-ui-timepicker-addon/script.js"></script>
                        <link rel="stylesheet" type="text/css" href="js/fanswoo-framework/tool/jquery-ui-timepicker-addon/style.css"></link>
                        <script>
                        $(function(){
                            $('#pay_paytime').datetimepicker({
                                dateFormat: 'yy-mm-dd',
                                timeFormat: 'HH:mm:ss'
                            });
                        });
                    </script>
                    <input type="text" class="text" id="pay_paytime" name="pay_paytime" value="<?=$Project->pay_paytime_DateTimeObj->datetime?>" required>
                <?else:?>
                    <?=$Project->pay_paytime_DateTimeObj->datetime?>
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
                <?if($Project->paycheck_status == 0):?>
                    <textarea name="pay_remark"><?=$Project->pay_remark?></textarea>
                <?else:?>
                    <?=$Project->pay_remark?>
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
                <?if($Project->pay_status == 0):?>
                <span class="red">會員尚未填寫付款資訊</span>
                <?elseif($Project->pay_status == 1):?>
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
                <span class="<?if($Project->paycheck_status == 0):?>red<?elseif($Project->paycheck_status == 1):?>green<?endif?>">
                    <?if($Project->paycheck_status == 0):?>款項待確認<?endif?>
                    <?if($Project->paycheck_status == 1):?>款項已確認<?endif?>
                </span>
		    </div>
		</div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <p class="gray">款項經確認後，便無法再修改付款資料</p>
            </div>
        </div>
	</div>
    <?if($Project->paycheck_status == 0):?>
    <div class="spanLine spanSubmit">
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <?if(!empty($Project->projectid)):?><input type="hidden" name="projectid" value="<?=$Project->projectid?>"><?endif?>
                <input type="submit" class="submit" value="儲存變更">
            </div>
        </div>
    </div>
    <?endif?>
    </form>
</div>
<?if(!empty($DesignList->obj_arr)):?>
<div class="contentBox allWidth">
	<h3>設計項目列表</h3>
	<h4>請確認設計項目列表</h4>
	<div class="spanLineTable">
        <div class="spanLineTableContent">
            <div class="spanLine order tablelist tableTitle">
                <div class="spanLineLeft width200">
                    設計項目
    		    </div>
                <div class="spanLineLeft width300">
                    設計項目簡介
                </div>
                <div class="spanLineLeft width100">
                    單價
                </div>
                <div class="spanLineLeft width100">
                    工作時程
                </div>
    		</div>
            <?foreach($DesignList->obj_arr as $key => $value_Design):?>
            <div class="spanLine order tablelist">
                <div class="spanLineLeft width200">
                    <a href="admin/<?=$child1_name?>/user/design/edit?designid=<?=$value_Design->designid?>" target="_blank">
                        <?=$value_Design->title?>
                    </a>
                </div>
                <div class="spanLineLeft width300">
                    <?=$value_Design->synopsis?>
                </div>
                <div class="spanLineLeft width100">
                    NT$ <?=$value_Design->price?>
                </div>
                <div class="spanLineLeft width100">
                    <?=$value_Design->days?> days
                </div>
            </div>
            <?endforeach?>
        </div>
    </div>
</div>
<?endif?>
<?if($Project->project_status == 1):?>
<?else:?>
<div class="contentBox allWidth">
    <h3>專案修改建議列表</h3>
    <h4>請確認專案修改建議</h4>
    <div class="spanLineTable">
        <?if($Project->project_status == 4):?>
        <?else:?>
        <div class="spanLine noneBg">
            <div class="spanLineLeft">
                <a href="admin/project/user/suggest/edit?projectid=<?=$Project->projectid?>" class="button">新增修改建議</a>
            </div>
        </div>
        <?endif?>
        <div class="spanLineTableContent">
            <div class="spanLine order tablelist tableTitle">
                <div class="spanLineLeft text width300">
                    修改建議標題
                </div>
                <div class="spanLineLeft text width100">
                    處理狀態
                </div>
                <div class="spanLineLeft text width150">
                    提出時間
                </div>
            </div>
            <?foreach($SuggestList->obj_arr as $key => $value_Suggest):?>
            <div class="spanLine order tablelist" style="border-bottom: 0px solid #EEE;">
                <div class="spanLineLeft text width300">
                    <a href="admin/<?=$child1_name?>/user/suggest/edit/?suggestid=<?=$value_Suggest->suggestid?>&projectid=<?=$Project->projectid?>" target="_blank">
                        <?=$value_Suggest->title?>
                    </a>
                </div>
                <div class="spanLineLeft text width100">
                    <?if($value_Suggest->answer_status == 1):?>
                    <span class="green">評估中</span>
                    <?elseif($value_Suggest->answer_status == 2):?>
                    <span class="green">修改中</span>
                    <?elseif($value_Suggest->answer_status == 3):?>
                    <span>已完成</span>
                    <?endif?>
                </div>
                <div class="spanLineLeft text width150">
                    <?=$value_Suggest->suggest_time_DateTime->datetime?>
                </div>
            </div>
            <?endforeach?>
        </div>
    </div>
</div>
<?endif?>
<div class="contentBox allWidth">
    <h3>專案時程及進度</h3>
    <h4>請確認案時程及進度</h4>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案開始時間
            </div>
            <div class="spanLineLeft width500">
                <?=$Project->setuptime_DateTimeObj->datetime?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案所需時程
            </div>
            <div class="spanLineLeft width500">
                <?=$Project->working_days?> 天
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                最後更新時間
            </div>
            <div class="spanLineLeft width500">
                <?=$Project->updatetime_DateTimeObj->datetime?>
            </div>
        </div>
    </div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                專案進行狀態
            </div>
            <div class="spanLineLeft width500" style="color:#027de5">
                <?if($Project->project_status == 1):?>
                估價中
                <?elseif($Project->project_status == 2):?>
                開發中
                <?elseif($Project->project_status == 3):?>
                維護
                <?elseif($Project->project_status == 4):?>
                結案
                <?endif?>
		    </div>
        </div>
	</div>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>