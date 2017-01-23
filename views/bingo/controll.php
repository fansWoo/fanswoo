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

	number_arr = [];
	number_get_arr = [];
	$.ajax({
        url: $('base').attr('href')+'bingo/get_bingo_get_number_arr',
        type: 'POST'
    })
    .done(function(response){

    	if( response !== '' )
    	{
    		var response_JSON = $.parseJSON(response);
    		number_get_arr = response_JSON;
    	}

		for( var i = 1; i <= 50; i ++ )
		{
			number_arr.push(i);
		}

		for( key in number_get_arr )
		{
			if( ! isNaN(number_get_arr[key].number) )
			{
				number_arr.remove( number_get_arr[key].number );
			}
		}
    	console.log(number_arr);

		number_arr_view();
    });

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

		if(vote_count >= 5)
		{

			alert('超過 5 個人說要重抽數字');

			for( key in number_get_arr)
			{
				if( number_get_arr[key].number == vote_number )
				{
					number_get_arr.splice(key, 1);
				}
			}
			number_arr.push(vote_number);

     		$('.lettory_history').append('<p>數字 ' + vote_number + ' 被大家投票取消重抽了</p>'); 
     		$('.lettory_history').scrollTop(9999999);
     		$.ajax({
		        url: $('base').attr('href') + 'bingo/save_bingo_get_number_arr',
		        type: 'POST',
		        data: {
		        	number_get_arr: JSON.stringify(number_get_arr)
		        }
     		})
     		.done(function(response){
     			console.log(response);

				// 送出推播
			    bingo_Pusher.send('lettory_update', {
					number_get_arr: number_get_arr
				});
				number_arr_view();
     		});
		}
    });
	
	// 當使用者點擊送出按鈕，則將訊息發送給該頻道下的使用者
	$(document).on('click', '#send', function(){

		var english_name = $('#name').val();
		var name = $('#name > option:selected').text();
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

				for( key in number_arr)
				{
					if( number_arr[key] == number )
					{
						number_arr.splice(key, 1);
					}
				}
				var get_arr = {
					number: number,
					name: name,
					english_name: english_name
				};
				number_get_arr.push(get_arr);

     			$('.lettory_history').append('<p>' + name + ' 抽到了數字 ' + number + '</p>'); 
     			$('.lettory_history').scrollTop(9999999);

	     		$.ajax({
			        url: $('base').attr('href') + 'bingo/save_bingo_get_number_arr',
			        type: 'POST',
			        data: {
			        	number_get_arr: JSON.stringify(number_get_arr)
			        }
	     		})
	     		.done(function(response){
	     			console.log(response);

					// 送出推播
				    bingo_Pusher.send('lettory_update', {
						name: name,
						english_name: english_name,
						number_new: number,
						number_get_arr: number_get_arr
					});
					number_arr_view();
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

    bingo_Pusher.event('get_number_arr', function(response) {
	    bingo_Pusher.send('lettory_update', {
			number_get_arr: number_get_arr
		});
    });

	function number_arr_view()
	{
		// 顯示尚未收到的數字
		var number_text = '';
		for( key in number_arr )
		{
			if( number_text == '' )
			{
				number_text = number_arr[key];
			}
			else if( ! isNaN(number_arr[key]) )
			{
				number_text = number_text + ',' + number_arr[key];
			}
		}
		console.log(number_text);
		$('.number_arr').text(number_text);

		// 顯示已經抽到的數字
		var number_get_text = '';
		for( key in number_get_arr )
		{
			if( number_get_text == '' )
			{
				number_get_text = number_get_arr[key].number;
			}
			else if( ! isNaN(number_get_arr[key].number) )
			{
				number_get_text = number_get_text + ',' + number_get_arr[key].number;
			}
		}
		$('.number_get_arr').text(number_get_text);
	}

	Array.prototype.remove = function(val) {
		var index = this.indexOf(val);
		if (index > -1) {
			this.splice(index, 1);
		}
	};

});
</script>
<link href="https://fonts.googleapis.com/css?family=Raleway:100,500,900" rel="stylesheet" type="text/css">
<style>

body{ padding: 0; margin: 0; overflow: hidden;background-color: #ffd624; color: #802105; font-family: 'Raleway';  font-weight: 500;}

</style>
<?=$temp['header_down']?>
<div>
	<select id="name" name="name">
		<option value="paypay">沛沛</option>
		<option value="william">哲賢</option>
		<option value="vivian">郁文</option>
		<option value="wenyi">文憶</option>
		<option value="mimi">婉君</option>
		<option value="yi">楊翊</option>
		<option value="esther">時婷</option>
		<option value="shaun">尚恩</option>
		<option value="admn">楊青龍</option>
		<option value="husky">羅一騰</option>
		<option value="ken">偉祥</option>
		<option value="abby">邱皮兒</option>
		<option value="tsao">甜點師</option>
		<option value="abby_sister">邱皮妹</option>
		<option value="yeh">葉老闆</option>
		<option value="mouse">江老鼠</option>
		<option value="tsai">蔡經理</option>
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