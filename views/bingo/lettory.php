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

        $('.container_window_get_history').html('');
        $('.container .box img').remove();
        $('.container .box').removeClass('box_face');

        for( key in response.number_get_arr )
        {
            console.log(response.number_get_arr[key].number);
            $('.container_window_get_history').append('<div class="choiceword2">' + response.number_get_arr[key].number + '</div>');
            $(".container .box[value='" + response.number_get_arr[key].number + "']").addClass('box_face');
            $(".container .box[value='" + response.number_get_arr[key].number + "']").append('<img src="img/bingo/'+  response.number_get_arr[key].english_name + '.jpg">');
        }

        if( response.number_new == undefined )
        {
            return false;
        }

        // 處理詢問投票的彈跳視窗
        $('.container_window_get_history').css('display','none');
        $('.container_window_vote_ask').css('display','block');
        $('.container_window_vote_ask .word').text(response.number_new);
        $('.container_window_vote_ask .picture img').attr('src','img/bingo/'+response.english_name+'.jpg');
        $('.container_window_vote_ask #show_choose_title').html(response.name + ' 抽到數字 <b style="font-size:20px;">' + response.number_new + '</b>，你想要投票重新抽這個數字嗎?');

    	if( response.number_new )
    	{
			var ask_text = response.name + "抽到的數字是" + response.number_new + "，你想要投票重抽這個數字嗎？";
			$('.ask_text').text(ask_text);
    	}
    });

    $(document).on('click', '.btn-danger', function(){

    	bingo_Pusher.send('vote_reset', {
    		name: $('#name').val(),
    		vote: 'reset'
    	});

        $('.container_window_get_history').css('display','block');
        $('.container_window_vote_ask').css('display','none');
    });

    $(document).on('click', '.btn-success', function(){

    	bingo_Pusher.send('vote_reset', {
    		name: $('#name').val(),
    		vote: 'no_reset'
    	});

        $('.container_window_get_history').css('display','block');
        $('.container_window_vote_ask').css('display','none');
    });

    $(document).on('touchstart', 'body', function(){
        $('body').addClass('touching');
    });

    $(document).on('touchend', 'body', function(){
        $('body').removeClass('touching');
    });

    $('.container').css('height', $('.container').width() );

    bingo_Pusher.send('get_number_arr');
    $(document).disableSelection();

});
</script>
<link href="https://fonts.googleapis.com/css?family=Raleway:100,500,900" rel="stylesheet" type="text/css">
<style>
body{ padding: 0; margin: 0;overflow-y: scroll; overflow-x: hidden; background-color: #ffd624;font-family: 'Raleway';  font-weight: 500;}

.fansbingo_title { width: 100%; height: 80px; padding-left: 10px; line-height: 80px; font-size: 20px; letter-spacing: 10px; text-align: center; color: #802105; }

.container_window{ border: solid 2px #802105; width: calc(100% - 74px); margin-left: 15px; height: 200px; margin-bottom: 20px; font-size: 14px; background-color: #777; letter-spacing: 3px; color: #FFF; padding: 20px; font-size: 16px; }
.container_window_vote_ask{ height: 100%; position: relative; }
.container_window_vote_ask .picture{ width: 120px; height: 120px; float: left; margin-right: 30px;}
.container_window_vote_ask .btn-success{ border-radius: 10px; border: none; width: 100px; height: 40px; bottom: 0; left: 50%; margin-left: -120px; margin-bottom: 10px; font-size: 16px; text-align: center; position:absolute; background-color:#EF8200; }
.container_window_vote_ask .btn-danger{ border-radius:10px; border: none; width: 100px; height: 40px; bottom: 0;  left: 50%;  margin-left: 20px ; margin-bottom: 10px; font-size: 16px; text-align: center; position:absolute; background-color:#EF8200;}

.box{
    float: left;
    width: 18% ;
    margin: 1%;
    height: 18%;
    display: block;
    position: relative;
    border-radius: 50%; 
    background-image: -moz-radial-gradient(40% 40%,circle,rgba(0,0,0,.1) 40%, rgba(0,0,0,1) 100%), -moz-linear-gradient(-90deg, #f33 45%, #333 45%, #3f3f3f 50%, #333 55%, #FFF 55%);
    background-image: -webkit-radial-gradient(40% 40%,circle,rgba(0,0,0,.1) 40%, rgba(0,0,0,1) 100%), -webkit-linear-gradient(-90deg, #f33 45%, #333 45%, #3f3f3f 50%, #333 55%, #FFF 55%);
}

.box .before{
    display: block;
    position: absolute;
    z-index: 6;
    width: 35%;
    left: 5px;
    top: 6px;
    height: 35%;
    background-color: #FFF;
    border-radius: 50%;
    box-shadow: 0 0 0 1px #BBB, 0 0 0 5px #fff, 0 0 0 8px #3f3f3f;
    margin: 24.5%;
}
/*.box:after{ content: "";display: block; position: absolute; z-index: 1; width: -12%; left: 50px; height: 10%; background-color:rgba(0,0,0,0); margin: 45% 3%; box-shadow: 12px 0 0 #FFF, -12px 0 0 #FFF;}*/
.box .word{ z-index: 8; font-size: 16px; width: 30px; height: 30px; text-align: center; line-height: 30px; position: absolute; left: 50%; top: 50%; margin-left: -15px; margin-top: -15px; letter-spacing: 0px; color: #000; }
.box .word.word_fanswoo{ font-size: 20PX; }

body.touching .box.box_face .before,
body.touching .box.box_face .word { display: block; }

.box.box_face .before { display: none; }
.box.box_face .word { display: none; }
.box.box_face img{ width: 100%; height: 100%; overflow: hidden; float: left; border-radius: 100%; box-shadow: 1px 1px 2px #000;}

.container{ position: relative; display: block; overflow: hidden; width: calc(100% - 40px); padding: 0 20px 20px; }
.choiceword{
    left: 28%;
    top: 0%;
    color: red;
    font-size: 30px;
    text-align: center;
}

.choiceword2{
    margin: 0 2px 2px 0;
    letter-spacing: 0px;
	font-size: 14px;
    text-align: center;
    line-height: 35px;
    width: 35px;
    height: 35px;
    background-color: orange;
    border-radius: 50px;
    display: block;
    float: left;
    
}
.choiceword_box{
    position: absolute;
    left: 52%;
    margin-top: 15%;
    margin-left: 114px;
    width:25%;
    height:25%;
}
.picture img{
	width: 100%;
    height: 100%;
}
/* .containerBig{
    background-color: black;
    position: absolute;
    width: 100%;
    height: 100%;

} */
.big{
    z-index: 9;
}
</style>
<?=$temp['header_down']?>
    <div class="fansbingo_title">fansBingo</div>
    <div class="container_window">
        <div class="container_window_get_history">
        </div>  
        <div class="container_window_vote_ask" style="display:none;">
            <div class="picture"><img src="img/bingo/yi.jpg" alt=""></div>
            <span id="show_choose_title"></span>

            <button type="button" class="btn-success">
                確定
            </button>
            <button type="button" class="btn-danger">
                重抽
            </button>
        </div>
    </div>
    <div class="container">
        <?foreach($number_arr  as  $key=>$value):?>
        <?if($key !== 12):?>
        <div class="box" value="<?=$value?>">
            <div class="before"></div>
            <div class="word"><?=$value?></div>
        </div>
        <?else :?>  
        <div class="box">
            <div class="before"></div>
            <div class="word word_fanswoo">瘋</div>
        </div>
        <?endif;?>      
        <?endforeach;?>
    </div>
	
	<input type="hidden" id="name" value="<?=$name?>">
<?=$temp['body_end']?>