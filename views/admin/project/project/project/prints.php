<h3>專案基本資訊</h3>
<div>專案單號：<?=$Project->projectid_Num?></div>
<div>專案名稱：<?=$Project->name_Str?></div>
<div>專案分類：<?=$Project->class_ClassMetaList->obj_Arr[0]->classname_Str?></div>
<div>專案管理人：<?=$admin_User->email_Str?></div>
<div>專案開始日期：<?=$Project->setuptime_DateTimeObj->datetime_Str?></div>
<div>專案所需時程：<?=$Project->working_days_Num?> 天</div>
<div>訂購會員：<?=$project_User->email_Str?></div>

<?if(!empty($Project->DesignList->obj_Arr)):?>
<h3>設計項目列表</h3>
<div>設計項目 / 報價 / 時程 / 內容</div>       
<?foreach($Project->DesignList->obj_Arr as $key => $value_Design):?>
<div>
<?=$key+1?> . <?=$value_Design->title_Str?> / NT$ <?=$value_Design->price_Num?> / <?=$value_Design->days_Num?> days / <?=$value_Design->synopsis_Str?>
</div>
<?endforeach?>
<?endif?>

<h3>付款資訊</h3>
<div>專案總金額 (NT$)：<?=$Project->pay_price_total_Num?></div>
<div>專案已收款項 (NT$)：<?=$Project->pay_price_receive_Num?></div>
<div>專案付款進度：<?=$Project->pay_price_schedule_Num?> %</div>
<div>專案應支付款：<?=$Project->pay_price_schedule2_Num?> %</div>  
<?if($Project->pay_status_Num == 1):?>
<div>轉帳帳號：<?=$Project->pay_account_Str?></div>
<div>轉帳人姓名：<?=$Project->pay_name_Str?></div>
<div>轉帳時間：<?=$Project->pay_paytime_DateTimeObj->datetime_Str?></div>
<div>付款備註：<?=$Project->pay_remark_Str?></div> 
<?endif?>
<div>付款狀態：<?if($Project->pay_status_Num == 0):?>會員尚未填寫付款資訊<?elseif($Project->pay_status_Num == 1):?>會員已填寫付款資訊<?endif?></div> 
<div>款項確認狀態：<?if($Project->paycheck_status_Num == 0):?>款項待確認<?elseif($Project->paycheck_status_Num == 1):?>款項已確認<?endif?></div>    

<?if(!empty($SuggestList->obj_Arr)):?>
<h3>專案修改建議列表</h3>
<div>修改建議標題 / 處理狀態 / 提出時間</div>
<?foreach($SuggestList->obj_Arr as $key => $value_Suggest):?>
<div><?=$key+1?> . <?=$value_Suggest->title_Str?> / <?if($value_Suggest->answer_status_Num == 1):?><span>評估中</span><?elseif($value_Suggest->answer_status_Num == 2):?><span>修改中</span><?elseif($value_Suggest->answer_status_Num == 3):?><span>已完成</span><?endif?> / <?=$value_Suggest->suggest_time_DateTime->datetime_Str?></div>
<?endforeach?>
<?endif?>

<h3>專案資訊</h3>
<div>專案進行狀態：<?if($Project->project_status_Num == 1):?>估價中<?elseif($Project->project_status_Num == 2):?>開發中<?elseif($Project->project_status_Num == 3):?>維護<?elseif($Project->project_status_Num == 4):?>結案<?endif?></div>
<div>最後更新時間：<?=$Project->updatetime_DateTimeObj->datetime_Str?></div>