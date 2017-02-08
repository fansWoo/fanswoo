<?=$temp['header_up']?>
<script>
Temp.ready(function(){

	// 新增一個 Pusher 並指定頻道為 chat_test ，可以同時開啟多個不同頻道的不同 Pusher
	// 只要頻道名稱相同，就算在不同頁面仍然可以接收
	// 一個域名只能有一個 websocket ，不同域名之伺服器不能互相溝通
	// 需先開啟該連結之 websocket 伺服器 fanswoo-framework/libraries/ratchet/bin/server.php
	var chat_test_Pusher = new Pusher({
		channel: 'chat_test'
	});
	
	// 當使用者點擊送出按鈕，則將訊息發送給該頻道下的使用者
	$(document).on('click', '#send', function(){
	  	send_message();
	});

	$("#message").keypress(function(e){
	  code = (e.keyCode ? e.keyCode : e.which);
	  if (code == 13)
	  {
	  	send_message();
	  }
	});

	function send_message()
	{
		if(
			$('#message').val() !== '' &&
			$.inArray( $('#name').val(), ['jason','william','shaun','adam','esther','mimi','paypay','vivian','wenyi'] ) > -1
		)
		{
	     	$('.message_content').append('<div class="post_my"><p>' + $('#message').val() + '</p></div>'); 

		    chat_test_Pusher.send_other('catch_message', {
				name: $('#name').val(),
				message: $('#message').val()
			});
			$('#message').val('');
    		$('.message_content').scrollTop(99999);
		}
		else
		{
			alert('請輸入正確的姓名與訊息內容');
		}
	}

	// 如果使用者送出訊息，則接收訊息並將該訊息放置聊天視窗
    chat_test_Pusher.event('catch_message', function(response) {
    	if( response.name == 'jason' )
    	{
    		var name = '一騰';
    	}
    	else if( response.name == 'william' )
    	{
    		var name = '哲賢';
    	}
    	else if( response.name == 'shaun' )
    	{
    		var name = '尚恩';
    	}
    	else if( response.name == 'adam' )
    	{
    		var name = '青龍';
    	}
    	else if( response.name == 'esther' )
    	{
    		var name = '時婷';
    	}
    	else if( response.name == 'mimi' )
    	{
    		var name = '咪咪';
    	}
    	else if( response.name == 'paypay' )
    	{
    		var name = '沛沛';
    	}
    	else if( response.name == 'vivian' )
    	{
    		var name = '郁文';
    	}
    	else if( response.name == 'wenyi' )
    	{
    		var name = '文憶';
    	}
    	else
    	{
    		return false;
    	}
     	$('.message_content').append('<div class="post"><img src="http://fanswoo.com/img/bingo/' + response.name + '.jpg"><p><b>' + name + ' : </b>' + response.message + '</p></div>'); 
    	$('.message_content').scrollTop(99999);
    });
	
	// 推播訊息告訴使用者有人上線了
	// chat_test_Pusher.send('online_push');

	// 接收使用者上線的訊息
    // chat_test_Pusher.event('online_push', function(response) {
    //  	$('.message').append('<p style="color:#333;">===== 有人上線囉 =====</p>'); 
    // });

    $('.message_content').height( $(window).height() - 100 - 20 );
    $('.chat_bar #message').width( $(window).width() - 50 - 20 );

});
</script>
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
<style>
html, body, * { font-family: 'Raleway', sans-serif !important; font-weight: 600; }
.title_bar { position: fixed; top: 0; display: block; background: #333; color: #FFF; line-height: 30px; height: 30px; font-size: 20px; width: 100%; padding: 10px 20px; }
.message_content { margin-top: 50px; margin-bottom: 50px; background: #F5F5F5; height: 100%; padding: 10px 10px; overflow-y: scroll; overflow-x: hidden; }

.message_content .post { margin-bottom: 10px; overflow: hidden; min-height: 50px; }
.message_content .post p{ font-family: 'Noto Sans CJK TC', LiHei Pro, "儷黑體", sans-serif, 'Microsoft JhengHei' !important; display: block; float: right; background: #FFF; width: calc(100% - 130px); margin-right: 60px; padding: 10px; line-height: 20px; font-size: 14px; color: #333; border: #DDD 1px solid; overflow: hidden; border-radius: 10px; word-break: break-all; font-weight: 500; }
.message_content .post p b { font-family: 'Noto Sans CJK TC', LiHei Pro, "儷黑體", sans-serif, 'Microsoft JhengHei' !important; font-weight:900;  }
.message_content .post img { height: 40px; width: 40px; float: left; border-radius: 100px; }

.message_content .post_my { margin-bottom: 10px; overflow: hidden; min-height: 50px; }
.message_content .post_my p{ font-family: 'Noto Sans CJK TC', LiHei Pro, "儷黑體", sans-serif, 'Microsoft JhengHei' !important; display: block; float: right; width: calc(100% - 120px); padding: 10px; line-height: 20px; font-size: 14px; color: #333; border: #AAA 1px solid; overflow: hidden; border-radius: 10px; word-break: break-all; font-weight: 500; background: #EEE; }

.chat_bar { position: fixed; background: #DDD; width: 100%; bottom: 0; height: 50px; padding: 0; }
.chat_bar #message { height: 30px; line-height: 30px; font-size: 16px;  padding: 10px; border:none; background: none; }
.chat_bar #send { height: 50px; width: 50px; font-size: 16px; position: absolute; right: 0; background: #777; color: #FFF; border: none; }
</style>
<?=$temp['header_down']?>
<div class="title_bar">fansWoo IM</div>
<div class="message_content">
</div>
<div class="chat_bar">
	<input type="hidden" id="name" value="<?=$username?>">
	<input type="text" id="message" name="message">
	<input id="send" type="button" value="Send">
</div>
<?=$temp['body_end']?>