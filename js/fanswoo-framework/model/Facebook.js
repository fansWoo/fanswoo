Temp.ready(function(){

Facebook = function()
{
	_this = this;

	this.__construct = function()
	{
		
		// Load the SDK asynchronously
		(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/zh_TW/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));

		window.fbAsyncInit = function() {

			var data = {};
			$.ajax({
	            url: $('base').attr('href')+'api/facebook/get_config',
	            type: 'GET',
	            data: data
	        })
        	.done(function(response){
        		var response_Json = $.parseJSON(response);
				var appid = response_Json.facebook_appid;
				var version = response_Json.facebook_version;
				FB.init({
					appId      : appid,
					cookie     : true,  // enable cookies to allow the server to access 
					xfbml      : true,  // parse social plugins on this page
					version    : version // use version 2.2
				});

				_this.get_login_status();
            })
        　　.fail(function(response){
                fanswoo.message_show(
                    'AJAX傳輸錯誤...',
                    2
                );
            });

		};
	}

	this.login = function()
	{
		FB.login(function(response) {
			if (response.status === 'connected') {

				var fb_id = response.authResponse.userID;
				var fb_token = response.authResponse.accessToken;

				FB.api('/me?fields=email', function(response) {
					
					var fb_email = response.email;
					var url = '';

					var data = {url: url, fb_id: fb_id, fb_token: fb_token, fb_email: fb_email};
					//console.log(data);
					$.ajax({					
			            url: $('base').attr('href') + 'user/login_facebook',
			            type: 'POST',
			            data: data
			        })
		        	.done(function(response){
		        		
		        		var response_Json = $.parseJSON(response);
						var login_status = response_Json.login_status;
						var url = response_Json.url;
						//console.log(response_Json);
		        		if(login_status){
		        			fanswoo.message_show(
				                    '登入成功',
				                    2,
				                    url
				            );
		        			
		        			
		        		}else{
		        			fanswoo.message_show(
		        					login_status,
				                    2
				                );
		        		}
//		        		document.location.href="product";
		            })
		        　　.fail(function(response){
		                fanswoo.message_show(
		                    'AJAX傳輸錯誤...',
		                    2
		                );
		            });
				});
			} else if (response.status === 'not_authorized') {
				alert('已經登入 facebook 但是未與 facebook 取得授權');
			} else {
				alert('未與 facebook 取得授權');
			}
		},
		{
		 	scope: 'public_profile,email'
		});
	}

	this.logout = function()
	{
		
		FB.getLoginStatus(function(response) {
			if (response.status=='connected') {
				FB.logout();
				console.log('facebook logout');
				document.location.href='user/logout';
			}
			else
			{
				console.log('facebook alreay logout');
				document.location.href='user/logout';
			}
		});
	}

	this.get_login_status = function() {

		FB.getLoginStatus(function(response) {
			if (response.status === 'connected') {
				console.log(response.authResponse.userID);
				console.log(response.authResponse.accessToken);
				FB.api('/me?fields=email', function(response) {
					console.log(response.email);
				});
			} else if (response.status === 'not_authorized') {

			} else {

			}
		});
	}
	this.__construct();
}
Facebook = new Facebook();

});