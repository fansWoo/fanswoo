<?=$temp['header_up']?>
<script>
Temp.ready(function(){

	// 新增一個 Pusher 並指定頻道為 chat_test ，可以同時開啟多個不同頻道的不同 Pusher
	// 只要頻道名稱相同，就算在不同頁面仍然可以接收
	// 一個域名只能有一個 websocket ，不同域名之伺服器不能互相溝通
	// 需先開啟該連結之 websocket 伺服器 fanswoo-framework/libraries/ratchet/bin/server.php
	var bingo_Pusher = new Pusher({
		channel: 'bingo'
	});

    bingo_Pusher.event('lettory_update', function(response) {

     	$(".lettory_table [number]").css('color', 'black');
     	$(".lettory_table [number]").attr('title', '');
    	for( key in response.number_get_arr)
    	{
	     	$(".lettory_table [number='" + response.number_get_arr[key] + "']").css('color', 'red');
	     	$(".lettory_table [number='" + response.number_get_arr[key] + "']").attr('title', response.name);
    	}

    	if( response.number_new )
    	{
			var ask_text = response.name + "抽到的數字是" + response.number_new + "，你想要投票重抽這個數字嗎？";
			$('.ask_text').text(ask_text);
			$('.ask_window').css('display', 'block');
    	}
    });

    $(document).on('click', '.vote_reset', function(){

    	bingo_Pusher.send('vote_reset', {
    		name: $('#username').val(),
    		vote: 'reset'
    	});

		$('.ask_window').css('display', 'none');
    });

    $(document).on('click', '.vote_no_reset', function(){

    	bingo_Pusher.send('vote_reset', {
    		name: $('#username').val(),
    		vote: 'no_reset'
    	});

		$('.ask_window').css('display', 'none');
    });

});
</script>
<?=$temp['header_down']?>
<div class="lettory_table">
	<?foreach( $number_arr as $key => $value ):?>
	<div number="<?=$value?>"><?=$value?></div>
	<?endforeach?>
</div>
<div class="ask_window" style=" background: #EEE; display: none;">
	<h2 class="ask_text"></h2>
	<div class="vote_reset">我要重抽數字</div>
	<div class="vote_no_reset">不要重抽</div>
</div>
<input type="hidden" id="username" value="<?=$username?>">
<?=$temp['body_end']?>