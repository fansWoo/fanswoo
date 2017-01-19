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

	// 投票統計
	var vote_count = 0;
	var vote_number = 0;

	var number_arr = [];
	var number_get_arr = [];
	for( var i = 1; i <= 30; i ++ )
	{
		number_arr.push(i);
	}

	number_arr_view();

    bingo_Pusher.event('vote_reset', function(response) {

    	if( response.vote == 'reset' )
    	{
			$('.vote_history').append('<p>' + response.name + ' 建議重抽 ' + vote_number + ' 號數字</p>');
			vote_count = vote_count + 1;
    	}
    	else if( response.vote == 'no_reset' )
    	{
			$('.vote_history').append('<p>' + response.name + ' 說不要重抽 ' + vote_number + ' 號數字</p>');
    	}

		$('.vote_history').scrollTop(9999999);
		$('.vote_count').text(vote_count);

		if(vote_count >= 2)
		{
    		console.log(number_get_arr);

			alert('超過 2 個人說要重抽數字');

			for( value in number_get_arr)
			{
				if( number_get_arr[value] == vote_number )
				{
					number_get_arr.splice(value, 1);
				}
			}
			number_arr.push(vote_number);

     		$('.lettory_history').append('<p>數字 ' + vote_number + ' 被大家投票取消重抽了</p>'); 
     		$('.lettory_history').scrollTop(9999999);

			// 送出推播
		    bingo_Pusher.send('lettory_update', {
				number_get_arr: number_get_arr
			});

			number_arr_view();
		}
    });
	
	// 當使用者點擊送出按鈕，則將訊息發送給該頻道下的使用者
	$(document).on('click', '#send', function(){

		var name = $('#name').val();
		var maxNum = 30;
		var minNum = 1;

		vote_count = 0;
		vote_number = 0;
		$('.vote_history').text('');
		$('.vote_count').text(vote_count);

		do {
			break_bln = false;
			var number = Math.floor(Math.random() * (maxNum - minNum + 1)) + minNum;
			vote_number = number;

			if( $.inArray(number, number_arr) > -1 )
			{

				for( value in number_arr)
				{
					if( number_arr[value] == number )
					{
						number_arr.splice(value, 1);
					}
				}
				number_get_arr.push(number);

				number_arr_view();

     			$('.lettory_history').append('<p>' + name + ' 抽到了數字 ' + number + '</p>'); 
     			$('.lettory_history').scrollTop(9999999);

				// 送出推播
			    bingo_Pusher.send('lettory_update', {
					name: name,
					number_new: number,
					number_get_arr: number_get_arr
				});
			}
			else if( number_arr.length == 0 )
			{
				alert('就沒有數字了還抽什麼抽？！');
				break_bln = false;
			}
			else
			{
				break_bln = true;
			}
		}
		while ( break_bln );

	});

	function number_arr_view()
	{
		// 顯示尚未收到的數字
		var number_text = '';
		for( value in number_arr )
		{
			if( number_text == '' )
			{
				number_text = number_arr[value];
			}
			else
			{
				number_text = number_text + ',' + number_arr[value];
			}
		}
		$('.number_arr').text(number_text);

		// 顯示已經抽到的數字
		var number_get_text = '';
		for( value in number_get_arr )
		{
			if( number_get_text == '' )
			{
				number_get_text = number_get_arr[value];
			}
			else
			{
				number_get_text = number_get_text + ',' + number_get_arr[value];
			}
		}
		$('.number_get_arr').text(number_get_text);
	}

});
</script>
<?=$temp['header_down']?>
<div>
	<select id="name" name="name">
		<option value="沛沛">沛沛</option>
		<option value="廖哲賢">廖哲賢</option>
	</select>
	<input id="send" type="button" value="抽數字">
	<h3>還剩這些沒抽到</h3>
	<div class="number_arr" style="background: #EEE; min-height: 30px;">
	</div>
	<h3>這些是被抽到的數字</h3>
	<div class="number_get_arr" style="background: #EEE; min-height: 30px;">
	</div>
	<h3>抽獎歷史紀錄</h3>
	<div class="lettory_history" style="background: #EEE; height: 100px; overflow-y:scroll;">
	</div>
	<h3>投票歷史紀錄，目前有 <span class="vote_count">0</span> 人說要重抽，滿 5 人說要重抽就會重抽剛剛的數字</h3>
	<div class="vote_history" style="background: #EEE; height: 100px; overflow-y:scroll;">
	</div>
</div>
<?=$temp['body_end']?>