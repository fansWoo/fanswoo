<!DOCTYPE html>
<html>
<head>
<title>Facebook Login JavaScript Example</title>
<meta charset="UTF-8">
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
$(function(){
	var http_url = 'http://web.fanswoo.com/fanswoo/';
	$(document).on('click', '.uniqueid_view', function(){
		var uniqueid = $('.uniqueid').val();
		location.href = http_url + 'facebook/get_mail/?uniqueid=' + uniqueid;
	});
	$(document).on('click', '.set_mail_count', function(){
		var uniqueid = $('.uniqueid').val();
		var limitstart = $('.limitstart').val();
		var limitover = $('.limitover').val();
		location.href = http_url + 'facebook/get_mail/?uniqueid=' + uniqueid + '&limitstart=' + limitstart + '&limitover=' + limitover;
	});
});
</script>
<style>
</style>
</head>
<body>
<div style="margin-bottom:10px;">
	識別ID：<input type="text" class="uniqueid" value="<?=$uniqueid_Num?>">
	<input type="submit" class="uniqueid_view" value="變更識別ID">
</div>
<div style="margin-bottom:10px;">
	<select class="mail_count">
		<?for($i = 0; $i < 100; $i++):?>
		<option value="<?=$i + 1?>">按讚<?=$i + 1?>次，共搜尋到<?=$select_count_Num[$i]?>人，已轉成郵件<?=$select_count_mail_Num[$i]?>人</option>
		<?endfor?>
	</select>
</div>
<div style="margin-bottom:100px;">
	取出按讚<input type="text" class="limitstart" style="width:50px" value="<?=$limitstart_Num?>">次到<input type="text" class="limitover" style="width:50px" value="<?=$limitover_Num?>">次的電子郵件<input type="submit" class="set_mail_count" value="取得mail">
	<p>本識別碼將於產生的7天後自動刪除</p>
</div>
<?if(!empty($limitstart_Num) && !empty($limitover_Num)):?>
<div>
	<p>按讚<?=$limitstart_Num?>次到按讚<?=$limitover_Num?>次的mail清單，共搜尋到<?=$select_count_total_Num?>人，已轉成郵件<?=count($FacebookLikeList->obj_Arr)?>人：</p>
	<textarea class="mail_list" style="width:300px;height:400px;">
<?if(!empty($FacebookLikeList->obj_Arr)):?><?foreach($FacebookLikeList->obj_Arr as $key => $value_FacebookLike):?>
<?=$value_FacebookLike->facebook_id_Str?>@facebook.com
<?endforeach?><?endif?></textarea>
</div>
<?endif?>

</body>
</html>