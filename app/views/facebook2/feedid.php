<!DOCTYPE html>
<html>
<head>
<title>Facebook Login JavaScript Example</title>
<meta charset="UTF-8">
</head>
<body>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<div id="fb-root"></div>
<script>

	var http_url = 'http://web.fanswoo.com/fanswoo/facebook2/';

	(function(d, s, id) {
	    var js, fjs = d.getElementsByTagName(s)[0];
	    if (d.getElementById(id)) return;
	    js = d.createElement(s); js.id = id;
	    js.src = "http://connect.facebook.net/zh_TW/sdk.js";
	    fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));

	window.fbAsyncInit = function() {
		FB.init({
		    appId      : '861472647259085',
		    cookie     : true,  // enable cookies to allow the server to access 
		    xfbml      : true,  // parse social plugins on this page
		    version    : 'v2.3' // use version 2.2
		});
		FB.getLoginStatus(function(response) {
			statusChangeCallback(response);
		});
	};

	function statusChangeCallback(response) {
		console.log('statusChangeCallback');
		console.log(response);
	    if (response.status === 'connected') {
	    // Logged into your app and Facebook.
		    console.log('Welcome!  Fetching your information.... ');
		    FB.api('/me', function(response) {
				console.log('Successful login for: ' + response.name);
				console.log('Thanks for logging in, ' + response.name + '!');
			});
	    }
	    else if (response.status === 'not_authorized') {
			console.log('Please log ' + 'into this app.');
	    } else {
			console.log('Please log ' + 'into Facebook.');
	    }
	}

	function checkLoginState() {
		FB.getLoginStatus(function(response) {
			statusChangeCallback(response);
		});
	}

	function delayExecute(check, proc, chkInterval) {
		//default interval = 500ms
		var x = chkInterval || 500;
		var hnd = window.setInterval(function (){
			//if check() return true, 
			//stop timer and execute proc()
			if (check()) {
				window.clearInterval(hnd);
				proc();
			}
		}, x);
	}

	function datetime_to_unix(datetime){
	    var tmp_datetime = datetime.replace(/:/g,'-');
	    tmp_datetime = tmp_datetime.replace(/ /g,'-');
	    var arr = tmp_datetime.split("-");
	    var now = new Date(Date.UTC(arr[0],arr[1]-1,arr[2],0-8));
	    return parseInt(now.getTime() / 1000);
	}

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

	$(document).on('click', '.send', function(){
		facebook_get_ok = false;
		ids = [];
		var facebook_url = $('.facebook_url').val();
		// var feed_number = $('.feed_number').val();
		var feed_number = 250;
		// var date_value = $('.date_value').val();
		// var time = datetime_to_unix(date_value);
		var time = 0;

		var uri = facebook_url.split('://www.facebook.com/pages/');
		if(uri[1])
		{
			var uri = uri[1].split('/');
			var uri = uri[1].split('?');
			var facebookid_Str = uri[0];
		}
		else
		{
			var uri = facebook_url.split('://www.facebook.com/');
			var uri = uri[1].split('?');
			var facebookid_Str = uri[0];
		}

		$('.loading span').text('正在取得動態...');
		FB.api('/' + facebookid_Str + '/feed?fields=id,type,object_id&since=' + time + '&limit=' + feed_number, function(response_feeds) {

			var feedids_Str = '';
			for(var i = 0; i < response_feeds.data.length; i++)
			{
				if(response_feeds.data[i].type == 'photo')
				{
					var feedid_Num = response_feeds.data[i].object_id;
				}
				else
				{
					var feedid_Arr = response_feeds.data[i].id;
					var feedid_Arr = feedid_Arr.split('_');
					var feedid_Num = feedid_Arr[1];
				}
				if(i == 0)
				{
					var feedids_Str = feedid_Num;
				}
				else
				{
					var feedids_Str = feedids_Str + ',' + feedid_Num;
				}
			}

	        $.ajax({
	            url: http_url + 'post_facebook_feedids',
	            data: {feedids_Str: feedids_Str, facebookid_Str: facebookid_Str},
	            type: "POST",
	            dataType:'json',
	            cache: false,
	            success: function(request){
	            	// console.log(request);
	            	if(request.status == 'already repeat')
	            	{
	            		alert('這個粉絲團已經搜尋過');
	            	}
	            	else
	            	{
	            		alert('搜尋成功');
	            	}
					location.href = http_url + 'mail/?searchid=' + request.searchid;
	            },

	            error:function(xhr, ajaxOptions, thrownError){
	            	console.log(xhr);
	            	if(xhr.responseText.status == 'already repeat')
	            	{
	            		alert('這個粉絲團已經搜尋過');
						location.href = http_url + 'mail/?searchid=' + request.searchid;
	            	}
	            	else
	            	{
	            		alert('未知的問題');
	            	}
	            }
	        });
		});
	});
});
</script>
<style>
body { display:none; opacity:0; transition: all 1s; }
body.hover { display:block; opacity:1; }
.box { width:305px; height:160px; padding: 10px; float:left; margin:0 10px 10px 0; background: #CCC; overflow: hidden; }
.box h4 { display: block; height: 20px; line-height: 20px; font-size:12px; overflow: hidden; margin: 0; }
.box textarea { display:block; float: left; width:135px; height:130px; overflow: hidden; overflow-y: scroll; font-size: 12px; padding:5px; }
.box .echoHtmlDiv { background: #FFF; padding:5px; border: 1px solid #DDD; float: left; display:block; width:135px; height:130px; overflow-x: hidden; overflow-y: scroll; font-size: 12px; }
div { margin-bottom: 30px; }
</style>
<div>
	<h2>粉絲團Big Data搜尋系統</h2>
	<a href="http://web.fanswoo.com/fanswoo/facebook2/feedid">選擇粉絲團</a>
	<a href="http://web.fanswoo.com/fanswoo/facebook2/mail">粉絲團名單列表</a>
</div>
<div>
	<h2>粉絲團列表</h2>
	<?foreach($FacebookSearchList->obj_Arr as $key => $value_FacebookSearch):?>
	<a href="http://web.fanswoo.com/fanswoo/facebook2/mail/?searchid=<?=$value_FacebookSearch->searchid_Num?>"><?=$value_FacebookSearch->facebookid_fans_Str?></a>
	<?endforeach?>
</div>
<div>
	<h2>搜尋粉絲團</h2>
	<input type="text" class="facebook_url" style="width:300px;" placeholder="粉絲團首頁網址">
	<!-- <input type="date" class="date_value" style="width:130px;" value="2014-01-01">
	<input type="number" class="feed_number" max="250" value="10" style="width:100px;" placeholder="動態數"> -->
	<input type="submit" class="send">
	<fb:login-button scope="public_profile,email,read_page_mailboxes,read_stream" onlogin="checkLoginState();">
	</fb:login-button>
	<p>
		<span class="loading">分析進度： <span id="loading_value">等候指示</span></span>
	</p>
	<!-- <p>開始日期：此值為分析值開始計算的開始日期</p>
	<p>動態數：此值為取得動態的總數，人數龐大的粉絲團，建議將動態數調小</p> -->
</div>
</html>