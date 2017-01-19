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
    font-size: 50px;
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

/* .circle{
    display: block;
    background: black;
    border-radius: 50%;
    height: 300px;
    width: 300px;
    margin: 0;
} */

/* .choose_number{
	border: solid 1px black;
    width: 99%;
    height: 25%;
    position: absolute;
    top: 10%;
} */
.outbox{
	border: solid 1px gold;
    position: absolute;
    width: 97%;
    height: 49%;
    top: 36%;
    left: 2%;

}
/* .numberbox{
    position: absolute;
    top: 20%;
    left: 2%;
} */

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
/* .circle{
     display: block;
     background: black;
     border-radius: 50%;
     height: 300px;
     width: 300px;
     margin: 0;
     z-index:-1;
    border: solid 1px black;
    text-align: center;
    font-size: 71px;
    font-family: fantasy;
    line-height: 171px;
    height: 170px;
    width: 184px;
    display: inline-block;
     background: radial-gradient(circle at 100px 100px, #5cabff, #000);
        } */

/* .select_button{
	border: solid 1px black;
    width: 100%;
    height: 13%;
    top: 87%;
    position: absolute;
   
} */
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
    width: 100px;
    height: 100px;
    position: absolute;
    left: 14%;
}


.btn-success{
	top: 78%;
    left: 22%;
	font-size: 25px;
	text-align: center;
	position:absolute;
}
.btn-danger{
	top: 78%;
    left: 58%;
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
.special_box { 
    position: absolute;
    left: 52%;
    margin-top: 15%;
    margin-left: 114px;
}
.box1{
    background-image: -moz-radial-gradient(40% 40%,circle,rgba(0,0,0,.1) 40%, rgba(0,0,0,1) 100%), -moz-linear-gradient(-90deg,rgba(0,0,0,0) 45%, #333 45%, #3f3f3f 50%, #333 55%, #FFF 55%),-moz-linear-gradient(0deg,#F79905 45%, #333 45%, #3f3f3f 50%, #333 55%, #F79905 55%);
    background-image: -webkit-radial-gradient(40% 40%,circle,rgba(0,0,0,.1) 40%, rgba(0,0,0,1) 100%), -webkit-linear-gradient(-90deg,rgba(0,0,0,0) 45%, #333 45%, #3f3f3f 50%, #333 55%, #FFF 55%),-webkit-linear-gradient(0deg,#F79905 45%, #333 45%, #3f3f3f 50%, #333 55%, #F79905 55%);
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
		<div class="choiceword2">10</div>
		<div class="choiceword2">10</div>
		<div class="choiceword2">10</div>
		<div class="choiceword2">10</div>
		<div class="choiceword2">10</div>
		<div class="choiceword2">10</div>
		<div class="choiceword2">10</div>
		<div class="choiceword2">10</div>
		<div class="choiceword2">10</div>
		<div class="choiceword2">10</div>		
	</div>
	<div class="container">
		<div class="box">
			<div class="word">01</div>
		</div>
		<div class="box">
			<div class="word">02</div>
		</div>
		<div class="box">
			<div class="word">03</div>
		</div>
		<div class="box">
			<div class="word">04</div>
		</div>
		<div class="box">
			<div class="word">05</div>
		</div>
		<div class="box">
			<div class="word">06</div>
		</div>
		<div class="box">
			<div class="word">07</div>
		</div>
		<div class="box">
			<div class="word">08</div>
		</div>
		<div class="box">
			<div class="word">09</div>
		</div>
		<div class="box">
			<div class="word">10</div>
		</div>
		<div class="box">
			<div class="word">11</div>
		</div>
		<div class="box">
			<div class="word">12</div>
		</div>
		<div class="box">
			<div class="word1">瘋</div>
		</div>
		<div class="box">
			<div class="word">14</div>
		</div>
		<div class="box">
			<div class="word">15</div>
		</div>
		<div class="box">
			<div class="word">16</div>
		</div>
		<div class="box">
			<div class="word">17</div>
		</div>
		<div class="box">
			<div class="word">18</div>
		</div>
		<div class="box">
			<div class="word">19</div>
		</div>
		<div class="box">
			<div class="word">20</div>
		</div>
		<div class="box">
			<div class="word">21</div>
		</div>
		<div class="box">
			<div class="word">22</div>
		</div>
		<div class="box">
			<div class="word">23</div>
		</div>
		<div class="box">
			<div class="word">24</div>
		</div>
		<div class="box">
			<div class="word">25</div>
		</div>
	</div>
<div class="container1">xxx抽了XX數字你想要投票重新抽這個數字嗎?

	<div class="picture"><img src="img/bingo/final/yi.jpg" alt=""></div>
	<div class="box special_box"><div class="word">25</div></div>
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