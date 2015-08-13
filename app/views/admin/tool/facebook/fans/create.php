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

	var base_url = $('base').attr('src');

	(function(d, s, id) {
	    var js, fjs = d.getElementsByTagName(s)[0];
	    if (d.getElementById(id)) return;
	    js = d.createElement(s); js.id = id;
	    js.src = "http://connect.facebook.net/zh_TW/sdk.js";
	    fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));

	window.fbAsyncInit = function() {
		FB.init({
		    appId      : '106479666351295',
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
	    return parseInt(now.getTime()/1000);
	}

	function get_facebook_likes(id, after)
	{
		var id = id || 0;
		var after = after || '';
		if(after == '')
		{
			var url = '/' + id + '/likes?limit=1000';
		}
		else
		{
			var url = '/' + id + '/likes?limit=1000&after=' + after;
			// console.log(after);
		}
		FB.api(url, function(response_likes) {
			// console.log(response_likes);
			if(response_likes.data.length == 0)
			{
				get_facebook_likes_ok = true;
			}
			if(response_likes.data.length > 0)
			{
				for(var key2 = 0; key2 < response_likes.data.length; key2++)
				{
					var facebook_likes_id = response_likes.data[key2].id;
					//這邊寫錯了
					var facebook_id = facebook_likes_id;
					ids.push(facebook_id);
				}
				if(response_likes.paging.cursors.after)
				{
					get_facebook_likes(id, response_likes.paging.cursors.after);
				}
				else
				{
					get_facebook_likes_ok = true;
				}
			}
		});
	}

	$(document).on('click', '.send', function(){
		facebook_get_ok = false;
		ids = [];
		var facebook_url = $('.facebook_url').val();
		var feed_number = $('.feed_number').val();
		var date_value = $('.date_value').val();
		var time = datetime_to_unix(date_value);
		var sleep = $('.sleep_value').val();

		var uri = facebook_url.split('://www.facebook.com/pages/');
		if(uri[1])
		{
			var uri = uri[1].split('/');
			var uri = uri[1].split('?');
			var facebook_id = uri[0];
		}
		else
		{
			var uri = facebook_url.split('://www.facebook.com/');
			var uri = uri[1].split('?');
			var facebook_id = uri[0];
		}
		// console.log(facebook_id);

		$('.loading span').text('正在取得動態...');
		FB.api('/' + facebook_id + '/feed?fields=id&since=' + time + '&limit=' + feed_number, function(response_feeds) {

			var key = 0;
			$('.loading span').text('正在取得按讚數... ' + parseInt(key + 1) + '/' + response_feeds.data.length);
			get_facebook_likes(response_feeds.data[key].id, '');
			delayExecute(
				function(){
					key++;
					if(key >= response_feeds.data.length)
					{
						return true;
					}
					else
					{
						$('.loading span').text('正在取得按讚數... ' + parseInt(key + 1) + '/' + response_feeds.data.length);
						// console.log('取得按讚數' + parseInt(key + 1) + '/' + response_feeds.data.length);
						get_facebook_likes(response_feeds.data[key].id, '');

						return false;
					}

				} ,
				function(){
					facebook_get_ok = true;
				},
				sleep
			);
			delayExecute(
				function(){
					return key >= response_feeds.data.length;
				} ,
				function(){
					facebook_get_ok = true;
				},
				500
			);
		});

		delayExecute(
			function(){
				return facebook_get_ok == true;
			} ,
			function(){
				var uniqueid = Math.floor(Math.random()*(9999999999999999-1000000000000000+1)+1000000000000000);

				var facebook_like_ids = '';
				for(var key = 0; key < ids.length; key++)
				{
					if(key == 0)
					{
						facebook_like_ids = ids[key];
					}
					else
					{
						facebook_like_ids = facebook_like_ids + ',' + ids[key];
					}
				}

				console.log(facebook_like_ids);

	            $.ajax({
	                url: base_url + 'facebook/facebook_like_ids_post',
	                data: {uniqueid: uniqueid, facebook_like_ids: facebook_like_ids, facebook_fans_id: facebook_id},
	                type: "POST",
	                dataType:'text',

	                success: function(msg){
						location.href = base_url + 'facebook/get_mail/?uniqueid=' + uniqueid;
	                },

	                error:function(xhr, ajaxOptions, thrownError){ 
	                    alert(xhr.status); 
	                    alert(thrownError); 
	                }
	            });

			},
			500
		);
	});
</script>
<style>
.box { width:305px; height:160px; padding: 10px; float:left; margin:0 10px 10px 0; background: #CCC; overflow: hidden; }
.box h4 { display: block; height: 20px; line-height: 20px; font-size:12px; overflow: hidden; margin: 0; }
.box textarea { display:block; float: left; width:135px; height:130px; overflow: hidden; overflow-y: scroll; font-size: 12px; padding:5px; }
.box .echoHtmlDiv { background: #FFF; padding:5px; border: 1px solid #DDD; float: left; display:block; width:135px; height:130px; overflow-x: hidden; overflow-y: scroll; font-size: 12px; }
</style>
<div style="margin-bottom:150px;">
	<input type="text" class="facebook_url" value="https://www.facebook.com/fanswoo.my" style="width:300px;" placeholder="粉絲團ID">
	<input type="date" class="date_value" style="width:130px;" value="2014-01-01">
	<input type="number" class="feed_number" max="250" value="10" style="width:100px;" placeholder="動態數">
	<input type="number" class="sleep_value" min="1000" value="1000" style="width:100px;" placeholder="精準度">
	<input type="submit" class="send">
	<span class="loading">分析進度： <span id="loading_value">等候指示</span></span>
	<fb:login-button scope="public_profile,email,read_page_mailboxes,read_stream" onlogin="checkLoginState();" style="float:right;">
	</fb:login-button>
	<p>開始日期：此值為分析值開始計算的開始日期</p>
	<p>動態數：此值為取得動態的總數，人數龐大的粉絲團，建議將動態數調小</p>
	<p>等候時間：建議填寫該粉絲團每則動態平均粉絲按讚數的兩倍，此值為每則動態所抓取的微秒數，粉絲團按讚數越高此值也越高，網路速度緩慢者也應調高此值</p>
</div>

</body>
</html>