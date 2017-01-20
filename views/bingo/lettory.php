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

// 	$('#show_choose_title').text('111');
	
	
	
	
	
	

    bingo_Pusher.event('lettory_update', function(response) {
        
		//console.log(response);
		$('.container1').css('display','block');//彈跳視窗
		$('#show_choose_title').text(response.name+'抽了:'+response.number_new+'數字你想要投票重新抽這個數字嗎?');//改文字

		//改圖片
		$('.picture img').attr('src','img/bingo/final/'+response.name+'.jpg')

		//改球的數字
		$('.container1 .word').text(response.number_new);

		//長數字球
		$('.container2').append('<div class="choiceword2">'+response.number_new+'</div>');

		//改下面的圖片
		$('.container .box').each(function(key, value){

			var ball_number=parseInt($(this).text());

			if(response.number_new == ball_number){

				$(this).children().remove();
				$(this).removeClass('box');
				$(this).addClass('box123');
				$(this).append('<img src="img/bingo/final/'+response.name+'.jpg">');
				console.log(ball_number);
			}
		});
     	$(".lettory_table [number]").css('color', 'black');
     	$(".lettory_table [number]").attr('title', '');
    	for( key in response.number_get_arr)
    	{
	     	$(".cover [number='" + response.number_get_arr[key] + "']").attr('src','img/bingo/final/'+response.name+'.jpg');
	     	$(".lettory_table [number='" + response.number_get_arr[key] + "']").attr('title', response.name);
    	}

    	if( response.number_new )
    	{
			var ask_text = response.name + "抽到的數字是" + response.number_new + "，你想要投票重抽這個數字嗎？";
			$('.ask_text').text(ask_text);
			$('.ask_window').css('display', 'block');
    	}
        //BINGO球改圖片

        
    });

    $(document).on('click', '.btn.btn-danger', function(){

    	
    	bingo_Pusher.send('vote_reset', {
    		name: $('#username').val(),
    		vote: 'reset'
    	});

		$('.container1').css('display', 'none');
    });

    $(document).on('click', '.btn.btn-success', function(){

    	bingo_Pusher.send('vote_reset', {
    		name: $('#username').val(),
    		vote: 'no_reset'
    	});

		$('.container1').css('display', 'none');
    });


    bingo_Pusher.send('get_number_arr');

});
</script>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
<style>
body{
overflow: hidden;
    background-color: yellow;
}
#outbox{

    background: -webkit-linear-gradient(white,#30E802);
    background: -o-linear-gradient(white,#30E802);
    background: -moz-linear-gradient(white,#30E802);
    background: linear-gradient(white,#30E802);
}

.title{
    width: 100%;
    height: 10%;
    position: absolute;
    display: flex;
    text-align: center;
}
.title1{
	width: 16%;
    height: 92%;
    font-size: 38px;
    text-align: center;
    color: white;
    background: -webkit-linear-gradient(white,#30E802);
    background: -o-linear-gradient(white,#30E802);
    background: -moz-linear-gradient(white,#30E802);
    background: linear-gradient(white,#30E802);
}
.title2{
	width: 17%;
    height: 92%;
    font-size: 50px;
    text-align: center;
    background-color: #FF5C3E;
    color: white;
    background: -webkit-linear-gradient(white,#FF5C3E);
    background: -o-linear-gradient(white,#FF5C3E);
    background: -moz-linear-gradient(white,#FF5C3E);
    background: linear-gradient(white,#FF5C3E);

}

.title3{
	width: 17%;
    height: 92%;
    font-size: 50px;
    text-align: center;
    background-color: #00BAFF;
	color: white;
	background: -webkit-linear-gradient(white,#00BAFF);
    background: -o-linear-gradient(white,#00BAFF);
    background: -moz-linear-gradient(white,#00BAFF);
    background: linear-gradient(white,#00BAFF);
}
.title4{
	width: 17%;
    height: 92%;
    font-size: 50px;
    text-align: center;
    background-color: #DA29ED;
    color: white;
    background: -webkit-linear-gradient(white,#DA29ED);
    background: -o-linear-gradient(white,#DA29ED);
    background: -moz-linear-gradient(white,#DA29ED);
    background: linear-gradient(white,#DA29ED);

}
.title5{
	width: 17%;
    height: 92%;
    font-size: 50px;
    text-align: center;
    background-color: #FFFF00;
    color: white;
    background: -webkit-linear-gradient(white,#FFFF00);
    background: -o-linear-gradient(white,#FFFF00);
    background: -moz-linear-gradient(white,#FFFF00);
    background: linear-gradient(white,#FFFF00);

}
.title6{
	width: 17%;
    height: 92%;
    font-size: 50px;
    text-align: center;
    background-color: #30E802;
    color: white;
    background: -webkit-linear-gradient(white,#30E802);
    background: -o-linear-gradient(white,#30E802);
    background: -moz-linear-gradient(white,#30E802);
    background: linear-gradient(white,#30E802);

}


.outbox{
	border: solid 1px gold;
    position: absolute;
    width: 97%;
    height: 49%;
    top: 36%;
    left: 2%;

}

.choicebox{
    border: solid 2px black ;
    position: absolute;
    width: 100%;
    height: 33%;
    top: 10%;
    background-color: red;

}

h1{
    font-size: 100px;
    font-weight: bolder;

}

.container1{
	z-index: 10;
    border: solid 2px black;
    width: 97%;
    height: 39%;
    top: 5%;
    left: 2%;
    position: absolute;
	font-size: 23px;
    font-weight: bold;
	background: -webkit-linear-gradient(white,#E8B236);
    background: -o-linear-gradient(white,#E8B236);
    background: -moz-linear-gradient(white,#E8B236);
    background: linear-gradient(white,#E8B236);
}
.picture{
    width: 120px;
    height: 120px;
    position: absolute;
    left: 11%;
}


.btn-success{
	top: 78%;
    left: 14%;
	font-size: 25px;
	text-align: center;
	position:absolute;
}
.btn-danger{
	top: 78%;
    left: 55%;
	font-size: 25px;
	text-align: center;
	position:absolute;
}

.box{
/*    float: left;*/
    width: 18% ;
 /*   margin: 1%;*/
    margin:0px;
    height: 18%;
    display: inline-block;
    position: relative;
    border-radius: 50%; 
    background-image: -moz-radial-gradient(40% 40%,circle,rgba(0,0,0,.1) 40%, rgba(0,0,0,1) 100%), -moz-linear-gradient(-90deg, #f33 45%, #333 45%, #3f3f3f 50%, #333 55%, #FFF 55%);
    background-image: -webkit-radial-gradient(40% 40%,circle,rgba(0,0,0,.1) 40%, rgba(0,0,0,1) 100%), -webkit-linear-gradient(-90deg, #f33 45%, #333 45%, #3f3f3f 50%, #333 55%, #FFF 55%);
}

.box123{
    /*    float: left;*/
    width: 18% ;
 /*   margin: 1%;*/
    margin:0px;
    height: 18%;
    display: inline-block;
    position: relative;
    border-radius: 50%; 
  
}
.box123 img{
	width: 100%;
    height: 100%;
    overflow: hidden;
    float: left;
    border-radius: 100%;
    box-shadow: 1px 1px 2px #000;
	
	
}
.special_box { 
    position: absolute;
    width: 37%;
    height: 37%;
    right: 0;
    top: 30%;
    margin-right: 27px;
}

.box:before{
    content: "";
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
.box:after{
    content: "";
    display: block;
    position: absolute;
    z-index: 1;
    width: -12%;
    left: 50px;
    height: 10%;
    background-color:rgba(0,0,0,0);
    margin: 45% 3%;
    box-shadow: 12px 0 0 #FFF, -12px 0 0 #FFF;
}
.word{
    z-index: 8;
    font-size: 25px;
    position: absolute;
    margin-left: 26%;
    margin-top: 22%;
    
}
.word1{
    z-index: 8;
    font-size: 33PX;
    position: absolute;
    left: 23%;
    top: 14%;
    font-weight: bolder;
}
.container{
    display: inline-block;
    position: absolute;
    width: 100%;
    height: 53%;
    bottom: 0;
}
.container2{
    border: solid 20px blue;
    width: 100%;
    height: 37%;
    position: absolute;
    top: 9%;
    background-color: #5B5B5B;
}
.choiceword{
    left: 28%;
    top: 0%;
    color: red;
    font-size: 30px;
    text-align: center;
}

.choiceword2{
	font-size: 14px;
    text-align: center;
    line-height: 35px;
    width: 35px;
    height: 35px;
    background-color: orange;
    border-radius: 50px;
    display: inline-block;
    
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
.cover{
    width: 18%;
    height: 18%;
    display: inline-block;
}
.cover img { 
    width: 100%;
    height: 100%;


}
</style>
<?=$temp['header_down']?>
<div class="outoutbox">
			<div class="title">
				<div class="title1">瘋</div>
				<div class="title2">B</div>
				<div class="title3">I</div>
				<div class="title4">N</div>
				<div class="title5">G</div>
				<div class="title6">O</div>
			</div>
		</div>
		<!-- <div class=choicebox>
			<h1>已抽出的號碼</h1> -->
	<div class="container2">
		<div class="choiceword">已抽出的號碼</div>				
	</div>  
    <div class="container">
    	<?foreach($number_arr  as  $key=>$value):?>
    	<?if($key !=12):?>
    	<div class="box" value="<?=$value?>">
    		<div class="word"><?=$value?></div>
    	</div>
    	<?else :?>	
    	<div class="box">
       		<div class="word1">瘋</div>
      	</div>
    	<?endif;?>		
    	<?endforeach;?>
    </div>
	<div class="container1" style="display:none;"><span id="show_choose_title">xxx抽了XX數字你想要投票重新抽這個數字嗎?</span>

	<div class="picture"><img src="img/bingo/final/yi.jpg" alt=""></div>
	<div class="box special_box">
		<div class="word" style=" left: 11px;top: 10px;">25</div>
    </div>
	<button type="button" class="btn btn-success">
		Bingo!
		</button>
	<button type="button" class="btn btn-danger">
		Canceled
		</button>
</div>  


	<script src="https://code.jquery.com/jquery-3.1.1.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
	<input type="hidden" id="username" value="<?=$username?>">
<?=$temp['body_end']?>