<?=$temp['header_up']?>
<?=$temp['header_down']?>
<div class="body">
<div class="wrap">
<div class="content">
<h2><?=$child2_title_Str?> - <?=$child3_title_Str?></h2>
<div class="contentBox allWidth">
    <h3>專案基本資訊</h3>
    <h4></h4>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案名稱
            </div>
            <div class="spanLineLeft width400">
                <?=$Project->name_Str?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案分類
            </div>
            <div class="spanLineLeft width500">
                <?=$Project->class_ClassMetaList->obj_Arr[0]->classname_Str?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                設計項目類別
            </div>
            <div class="spanLineRight">
                <?foreach($ProjectDesignList->obj_Arr as $key => $value_Design):?>
                <div class="checkbox_item">
                    <?=$key+1?> . <?=$value_Design->title_Str?>
                </div>
                <?endforeach?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                訂購會員
            </div>
            <div class="spanLineLeft width300">
                <?=$project_User->email_Str?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案總金額 (NT$)
            </div>
            <div class="spanLineLeft">
                <?=$Project->pay_price_total_Num?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案已收款項 (NT$)
            </div>
            <div class="spanLineLeft">
                <?=$Project->pay_price_receive_Num?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案付款進度
            </div>
            <div class="spanLineLeft">
                <?=$Project->pay_price_schedule_Num?> %
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案開始日期
            </div>
            <div class="spanLineLeft">
                <?=$Project->setuptime_DateTimeObj->datetime_Str?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案所需時程(天)
            </div>
            <div class="spanLineLeft">
                <?=$Project->working_days_Num?>
            </div>
        </div>
    </div>
</div>
<div class="contentBox allWidth">
    <h3>付款資訊</h3>
    <h4></h4>
    <?if($Project->pay_status_Num == 1):?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                轉帳帳號
            </div>
            <div class="spanLineLeft">
                <?=$Project->pay_account_Str?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                轉帳人姓名
            </div>
            <div class="spanLineLeft">
                <?=$Project->pay_name_Str?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                轉帳時間
            </div>
            <div class="spanLineLeft width500">
                <?=$Project->pay_paytime_DateTimeObj->datetime_Str?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                付款備註
            </div>
            <div class="spanLineLeft width500">
                <?=$Project->pay_remark_Str?>
            </div>
        </div>
    </div>
    <?endif?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                付款狀態
            </div>
            <div class="spanLineLeft width500">
                <?if($Project->pay_status_Num == 0):?>
                    會員尚未填寫付款資訊
                <?elseif($Project->pay_status_Num == 1):?>
                    會員已填寫付款資訊
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
                <?if($Project->paycheck_status_Num == 0):?>
                    款項待確認
                <?elseif($Project->paycheck_status_Num == 1):?>
                    款項已確認
                <?endif?>
            </div>
        </div>
    </div>
</div>
<?if(!empty($projectid_Num)):?>
<?if(!empty($SuggestList->obj_Arr)):?>
<div class="contentBox allWidth">
    <h3>專案修改建議列表</h3>
    <h4></h4>
    <div class="spanLine">
        <div class="spanLine tableTitle">
            <div class="spanLineLeft text width100">
                修改建議ID
            </div>
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
        <?foreach($SuggestList->obj_Arr as $key => $value_Suggest):?>
        <div class="spanLine" style="border-bottom: 0px solid #EEE;">
            <div class="spanLineLeft text width100">
                <?=$value_Suggest->suggestid_Num?>
            </div>
            <div class="spanLineLeft text width300">
                <?=$value_Suggest->title_Str?>
            </div>
            <div class="spanLineLeft text width100">
                <?if($value_Suggest->answer_status_Num == 1):?>
                    評估中
                <?elseif($value_Suggest->answer_status_Num == 2):?>
                    修改中
                <?elseif($value_Suggest->answer_status_Num == 3):?>
                    已完成
                <?endif?>
            </div>
            <div class="spanLineLeft text width150">
                <?=$value_Suggest->suggest_time_DateTime->datetime_Str?>
            </div>
        </div>
        <?endforeach?>
    </div>
</div>
<?endif?>
<?endif?>
<div class="contentBox allWidth">
    <h3>專案資訊</h3>
    <h4></h4>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案進行狀態
            </div>
            <div class="spanLineLeft width500">
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
</div>
<?=$temp['body_end']?>