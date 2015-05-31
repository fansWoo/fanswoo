<!DOCTYPE html>
<html>
<head>
<title>Facebook Login JavaScript Example</title>
<meta charset="UTF-8">
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
$(function(){

	var key = prompt('請輸入金鑰');
	if(key == 'test')
	{
		$('body').addClass('hover');
	}
	else
	{
		$('body').remove();
	}

	var http_url = 'http://web.fanswoo.com/fanswoo/facebook2/';
	$(document).on('click', '.searchid_view', function(){
		var searchid = $('.searchid').val();
		location.href = http_url + 'mail/?searchid=' + searchid;
	});

	$(document).on('click', '.set_mail_count', function(){
		var searchid = $('.searchid').val();
		var limitstart = $('.limitstart').val();
		var limitover = $('.limitover').val();

		var dlLink = http_url + 'download_mail/?searchid=' + searchid + '&limitstart=' + limitstart + '&limitover=' + limitover;
		var $ifrm = $("<iframe style='display:none' />");
        $ifrm.attr("src", dlLink);
        $ifrm.appendTo("body");
        $ifrm.load(function () {
        	$("body").append("請輸入正確的參數");
    	});

	    // $.ajax({
	    //     url: http_url + 'download_mail/',
	    //     data: {searchid: searchid, limitstart: limitstart, limitover: limitover},
	    //     type: "POST",
	    //     dataType:'json',
	    //     cache: false,
	    //     success: function(request){
	    //        	console.log(request);
	    //         alert('成功');
	    //     },
	    //     error:function(request, ajaxOptions, thrownError){
	    //        	console.log(request);
	    //         alert('失敗');
	    //     }
	    // });
	});

	$(document).on('click', '.delete_search', function(){
		if(!confirm('確定永久銷毀這個搜尋嗎'))
		{
			return false;
		}
		var searchid = $(this).data('searchid');

	    $.ajax({
	        url: http_url + 'delete_facebook_search',
	        data: {searchid: searchid},
	        type: "POST",
	        dataType:'json',
	        cache: false,
	        success: function(request){
	           	console.log(request);
	            alert('成功');
	            location.href = 'http://web.fanswoo.com/fanswoo/facebook2';
	        },
	        error:function(request, ajaxOptions, thrownError){
	           	console.log(request);
	            alert('失敗');
	        }
	    });
	});
});
</script>
<style>
body { display:none; opacity:0; transition: all 1s; }
body.hover { display:block; opacity:1; }
div { margin-bottom: 30px; }
</style>
</head>
<body>
<div>
	<h2>粉絲團Big Data搜尋系統</h2>
	<a href="http://web.fanswoo.com/fanswoo/facebook2/feedid">選擇粉絲團</a>
	<a href="http://web.fanswoo.com/fanswoo/facebook2/mail">粉絲團名單列表</a>
</div>
<div>
	<h2>搜尋條件</h2>
	粉絲團名稱：<?=$FacebookSearch->facebookid_fans_Str?>，搜尋ID：<input type="text" class="searchid" value="<?=$searchid_Num?>">
	<input type="submit" class="searchid_view" value="變更識別ID">
	<input type="submit" data-searchid="<?=$searchid_Num?>" class="delete_search" value="永久銷毀這個粉絲團">
</div>
<?if(empty($people_total)):?>
<div>
	<h2>搜尋結果</h2>
	<p>尚未完成粉絲團郵件搜尋，請先使用google plugin外掛進行搜尋</p>
	<p>搜尋進度：<?=$schedule_get?> / <?=$schedule_total?></p>
</div>
<?else:?>
<div>
	<h2>搜尋結果</h2>
	共有 <?=$people_total?> 組名單，其中
	<select class="mail_count">
		<?for($i = 0; $i < $max_count_Num; $i++):?>
		<option value="<?=$i + 1?>">按讚<?=$i + 1?>次，共搜尋到<?=$select_count_Num[$i]?>組</option>
		<?endfor?>
	</select>
</div>
<div>
	取出按讚<input type="text" class="limitstart" style="width:50px" value="<?=$limitstart_Num?>">次到<input type="text" class="limitover" style="width:50px" value="<?=$limitover_Num?>">次的電子郵件<input type="submit" class="set_mail_count" value="下載郵件名單">
	<p>本識別碼將於產生的7天後自動刪除</p>
</div>
<?endif?>

</body>
</html>