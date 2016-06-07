<h3>專案基本資訊</h3>
<div>專案單號：<?=$Project->projectid?></div>
<div>專案名稱：<?=$Project->name?></div>
<div>專案分類：<?=$Project->class_ClassMetaList->obj_arr[0]->classname?></div>
<div>專案管理人：<?=$admin_User->email?></div>
<div>專案開始日期：<?=$Project->setuptime_DateTimeObj->datetime?></div>
<div>專案所需時程：<?=$Project->working_days?> 天</div>
<div>訂購會員：<?=$project_User->email?></div>

<?if(!empty($Project->DesignList->obj_arr)):?>
<h3>設計項目列表</h3>
<div>設計項目 / 報價 / 時程 / 內容</div>       
<?foreach($Project->DesignList->obj_arr as $key => $value_Design):?>
<div>
<?=$key+1?> . <?=$value_Design->title?> / NT$ <?=$value_Design->price?> / <?=$value_Design->days?> days / <?=$value_Design->synopsis?>
</div>
<?endforeach?>
<?endif?>

<h3>付款資訊</h3>
<div>專案總金額 (NT$)：<?=$Project->pay_price_total?></div>
<div>專案已收款項 (NT$)：<?=$Project->pay_price_receive?></div>
<div>專案付款進度：<?=$Project->pay_price_schedule?> %</div>
<div>專案應支付款：<?=$Project->pay_price_schedule2?> %</div>  
<?if($Project->pay_status == 1):?>
<div>轉帳帳號：<?=$Project->pay_account?></div>
<div>轉帳人姓名：<?=$Project->pay_name?></div>
<div>轉帳時間：<?=$Project->pay_paytime_DateTimeObj->datetime?></div>
<div>付款備註：<?=$Project->pay_remark?></div> 
<?endif?>
<div>付款狀態：<?if($Project->pay_status == 0):?>會員尚未填寫付款資訊<?elseif($Project->pay_status == 1):?>會員已填寫付款資訊<?endif?></div> 
<div>款項確認狀態：<?if($Project->paycheck_status == 0):?>款項待確認<?elseif($Project->paycheck_status == 1):?>款項已確認<?endif?></div>    

<?if(!empty($SuggestList->obj_arr)):?>
<h3>專案修改建議列表</h3>
<div>修改建議標題 / 處理狀態 / 提出時間</div>
<?foreach($SuggestList->obj_arr as $key => $value_Suggest):?>
<div><?=$key+1?> . <?=$value_Suggest->title?> / <?if($value_Suggest->answer_status == 1):?><span>評估中</span><?elseif($value_Suggest->answer_status == 2):?><span>修改中</span><?elseif($value_Suggest->answer_status == 3):?><span>已完成</span><?endif?> / <?=$value_Suggest->suggest_time_DateTime->datetime?></div>
<?endforeach?>
<?endif?>

<h3>專案資訊</h3>
<div>專案進行狀態：<?if($Project->project_status == 1):?>估價中<?elseif($Project->project_status == 2):?>開發中<?elseif($Project->project_status == 3):?>維護<?elseif($Project->project_status == 4):?>結案<?endif?></div>
<div>最後更新時間：<?=$Project->updatetime_DateTimeObj->datetime?></div>