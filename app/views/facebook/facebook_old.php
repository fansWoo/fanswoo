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
			console.log(after);
		}
		FB.api(url, function(response_likes) {
			console.log(response_likes);
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

				var ids_list = new Array(10);
				for (i = 0 ; i < 10 ; i++) {
					ids_list[i] = new Array();
				}
				for(var i = 0; i < ids.length; i++)
				{
					if(ids_list[0].indexOf(ids[i]) > -1)
					{
						if(ids_list[1].indexOf(ids[i]) > -1)
						{
							if(ids_list[2].indexOf(ids[i]) > -1)
							{
								if(ids_list[3].indexOf(ids[i]) > -1)
								{
									if(ids_list[4].indexOf(ids[i]) > -1)
									{
										if(ids_list[5].indexOf(ids[i]) > -1)
										{
											if(ids_list[6].indexOf(ids[i]) > -1)
											{
												if(ids_list[7].indexOf(ids[i]) > -1)
												{
													if(ids_list[8].indexOf(ids[i]) > -1)
													{
														if(ids_list[9].indexOf(ids[i]) > -1)
														{
														}
														else
														{
															ids_list[9].push(ids[i]);
														}
													}
													else
													{
														ids_list[8].push(ids[i]);
													}
												}
												else
												{
													ids_list[7].push(ids[i]);
												}
											}
											else
											{
												ids_list[6].push(ids[i]);
											}
										}
										else
										{
											ids_list[5].push(ids[i]);
										}
									}
									else
									{
										ids_list[4].push(ids[i]);
									}
								}
								else
								{
									ids_list[3].push(ids[i]);
								}
							}
							else
							{
								ids_list[2].push(ids[i]);
							}
						}
						else
						{
							ids_list[1].push(ids[i]);
						}
					}
					else
					{
						ids_list[0].push(ids[i]);
					}
				}
				console.log(ids_list);

				for(var i = 0; i < ids_list.length; i++)
				{
					var echo_textarea = '';
					var echo_html = '';
					for(var i2 = 0; i2 < ids_list[i].length; i2++)
					{
						echo_textarea = echo_textarea + ids_list[i][i2] + '\n';
						echo_html = echo_html + '<a href="http://facebook.com/' + ids_list[i][i2] + '" target="_blank">' + ids_list[i][i2] + '</a><br>';
					}
					$('.box[data-number=' + i + '] textarea').html(echo_textarea);
					$('.box[data-number=' + i + '] .echoHtmlDiv').html(echo_html);
					$('.box[data-number=' + i + '] span').text(ids_list[i].length);
				}

				$('.loading span').text('分析完成');
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
<div style="margin-bottom:10px;">
	<input type="text" class="facebook_url" value="https://www.facebook.com/fanswoo.my" style="width:300px;" placeholder="粉絲團ID">
	<input type="date" class="date_value" style="width:130px;" value="2014-01-01">
	<input type="number" class="feed_number" max="250" value="100" style="width:100px;" placeholder="動態數">
	<input type="number" class="sleep_value" min="10" value="100" style="width:100px;" placeholder="精準度">
	<input type="submit" class="send">
	<span class="loading">分析進度： <span id="loading_value">等候指示</span></span>
	<fb:login-button scope="public_profile,email,read_page_mailboxes,read_stream" onlogin="checkLoginState();" style="float:right;">
	</fb:login-button>
	<p>開始日期：此值為分析值開始計算的開始日期</p>
	<p>動態數：此值為取得動態的總數，人數龐大的粉絲團，建議將動態數調小</p>
	<p>等候時間：建議填寫該粉絲團每則動態平均粉絲按讚數的兩倍，此值為每則動態所抓取的微秒數，粉絲團按讚數越高此值也越高，網路速度緩慢者也應調高此值</p>
</div>

<div class="box" data-number="0">
	<h4>按讚1次共<span>0</span>人</h4>
	<textarea class="echoTextarea"></textarea>
	<div class="echoHtmlDiv"></div>
</div>
<div class="box" data-number="1">
	<h4>按讚2次共<span>0</span>人</h4>
	<textarea class="echoTextarea"></textarea>
	<div class="echoHtmlDiv"></div>
</div>
<div class="box" data-number="2">
	<h4>按讚3次共<span>0</span>人</h4>
	<textarea class="echoTextarea"></textarea>
	<div class="echoHtmlDiv"></div>
</div>
<div class="box" data-number="3">
	<h4>按讚4次共<span>0</span>人</h4>
	<textarea class="echoTextarea"></textarea>
	<div class="echoHtmlDiv"></div>
</div>
<div class="box" data-number="4">
	<h4>按讚5次共<span>0</span>人</h4>
	<textarea class="echoTextarea"></textarea>
	<div class="echoHtmlDiv"></div>
</div>
<div class="box" data-number="5">
	<h4>按讚6次共<span>0</span>人</h4>
	<textarea class="echoTextarea"></textarea>
	<div class="echoHtmlDiv"></div>
</div>
<div class="box" data-number="6">
	<h4>按讚7次共<span>0</span>人</h4>
	<textarea class="echoTextarea"></textarea>
	<div class="echoHtmlDiv"></div>
</div>
<div class="box" data-number="7">
	<h4>按讚8次共<span>0</span>人</h4>
	<textarea class="echoTextarea"></textarea>
	<div class="echoHtmlDiv"></div>
</div>
<div class="box" data-number="8">
	<h4>按讚9次共<span>0</span>人</h4>
	<textarea class="echoTextarea"></textarea>
	<div class="echoHtmlDiv"></div>
</div>
<div class="box" data-number="9">
	<h4>按讚10次以上共<span>0</span>人</h4>
	<textarea class="echoTextarea"></textarea>
	<div class="echoHtmlDiv"></div>
</div>

</body>
</html>