$(function(){

	window.addEventListener('popstate', function(event) {
		//檢查是否有已經載入的模板，如果有模板就用模板，否則改用超連結
		// if()
		// {

		// }
		// else
		// {
			// location.reload();
		// }
	});
	
	Handlebars.registerHelper('when', function(v1, v2, v3, v4) {
		var v2 = v2.replace(/&gt;/ig, ">");
		var v2 = v2.replace(/&lt;/ig, "<");
		if( eval('v1 ' + v2 + ' v3' ) ) {
			return v4.fn(this);
		}
		else
		{
			return v4.inverse(this);
		}
	});
});

Temp = function(){
	var _this = this;
	_this.before_function = [];
	_this.before_repeat_function = [];
	_this.ready_function = [];
	_this.ready_repeat_function = [];
	_this.now_temp_body = 1;
	_this.interval = [];

	//Temp.before裡面放的是完成 Temp 繪製之前要做的事情，若放在 dom 本文內，每次 load 新頁面時都會重複讀取
	this.before = function(arg)
	{
		if (self != top)
		{
			return false;
		}

		$(function(){

			if(typeof(arg) == 'object')
			{
				_this.before_repeat_function.push(function(){
					arg.func();
				});
			}
			else
			{
				_this.before_function.push(function(){
					arg();
				});
			}

		});
	}

	//Temp.ready裡面放的是完成 Temp 繪製之後要做的事情，若放在 dom 本文內，每次 load 新頁面時都會重複讀取
	this.ready = function(arg)
	{
		if (self != top)
		{
			return false;
		}

		$(function(){

			if(typeof(arg) == 'object')
			{
				_this.ready_repeat_function.push(function(){
					arg.func();
				});
			}
			else
			{
				_this.ready_function.push(function(){
					arg();
				});
			}

		});
	}

	this.template = function(arg, arg2)
	{
		var html = arg;
		var obj = arg2;
		var template = Handlebars.compile( html );

		return template( obj );
	}

	//本方法為呼叫模板進行AJAX變化，第一個參數為fs-temp-ajax的模板編號的選擇器，第二個值為用於模板內的附帶的物件變數
	this.ajax = function(temp_selector, obj, insert_path)
	{
		$(function(){
			var global_var = _this;
			if( obj )
			{
				for( key in obj )
				{
					eval('global_var.' + key + ' = obj.' + key);
				}
			}

			//把存在 script#body 的 HTML 抓出來
			var html_body = $("script[type='text/html']#" + _this.now_temp_body).html();
			$("<div fs-temp-temp_selector_body>" + html_body + "</div>").appendTo('body');
			var temp_selector_html = $("[fs-temp-temp_selector_body]").find( temp_selector ).html();

			var script_meta = document.createElement("script");
			document.getElementsByTagName("head")[0].appendChild(script_meta);
			$('head > script:last').attr('type', "text/html");
			$('head > script:last').html( temp_selector_html );

			if( insert_path == undefined)
			{
				$( temp_selector ).html( _this.template( $('head > script:last').html(), global_var) );
			}
			else if( insert_path == 'prepend')
			{
				$( temp_selector ).prepend( _this.template( $('head > script:last').html(), global_var) );
			}
			else if( insert_path == 'append')
			{
				$( temp_selector ).append( _this.template( $('head > script:last').html(), global_var) );
			}

			$("[fs-temp-temp_selector_body]").remove();
			$('head > script:last').remove();
		});
	}

	this.input = function(arg, arg2)
	{
		var url = arg;
		var type = arg2;
		if( type == 'script' )
		{
			input_script(url);
		}
		else
		{
			input_html(url);
		}
	}

	input_script = function(arg)
	{
		var url = arg;
		var temp_number = 1;
		var script_meta = document.createElement("script");
		document.getElementsByTagName("head")[0].appendChild(script_meta);
		script_meta.src = url;
		$('head > script:last').attr('fs-temp-number', temp_number);
	}

	input_html = function(arg)
	{

	}

	this.set_js_temp = function()
	{
		//所有 HTML 模板寫在 script#body 裡面
		var script_meta = document.createElement("script");
		document.getElementsByTagName("head")[0].appendChild(script_meta);
		$('head > script:last').attr('type', "text/html");
		$('[fs-temp-body]').find('script').remove();
		$('head > script:last').html( $('[fs-temp-body]').html() );
		$('head > script:last').attr('fs-temp-number', _this.now_temp_body);
		$('head > script:last').attr('id', _this.now_temp_body);

		$("[fs-temp-body]").html( _this.template( $('head > script:last').html(), _this) );
		$("[fs-temp-body]").css( 'display', 'block' );
	}

	this.construct = function()
	{
		if (self != top)
		{
			return false;
		}

		$(function(){

			for( var i = 0; i < _this.before_function.length; i++)
			{
				_this.before_function[i]();
			}

			for( var i = 0; i < _this.before_repeat_function.length; i++)
			{
				_this.before_repeat_function[i]();
			}

			_this.set_js_temp();

			for( var i = 0; i < _this.ready_function.length; i++)
			{
				_this.ready_function[i]();
			}

			for( var i = 0; i < _this.ready_repeat_function.length; i++)
			{
				_this.ready_repeat_function[i]();
			}
		});
	}
}
Temp = new Temp();


Temp.before(function(){

	$.fn.temp_ajax = function(data) {
	    Temp.ajax( $(this).selector, data);
	};

	$.fn.temp_ajax_prepend = function(data) {
	    Temp.ajax( $(this).selector, data, 'prepend');
	};

	$.fn.temp_ajax_append = function(data) {
	    Temp.ajax( $(this).selector, data, 'append');
	};

	$.fn.temp_load_page = function(arg) {
		if (self != top)
		{
			return false;
		}
		var url = arg.url;
		var _this = this;
		var now_body_animate = arg.now_body_animate || '';
		var next_body_animate = arg.next_body_animate || '';
		var $this = $(this);
		var data = {};

		var temp_number = Math.floor(Math.random() * (99999999 - 10000000 + 1)) + 10000000;

		var $click_Deferred = $.Deferred();
		var $iframe_contents;
		var time2;

		this.load_iframe = function()
		{
			var $http_load_Deferred = $.Deferred();

			//所有 HTML 模板寫在 script#body 裡面
			var iframe_meta = document.createElement("iframe");
			document.getElementsByTagName("body")[0].appendChild(iframe_meta);
			var $iframe = $('body > iframe:last');
			$iframe.css('display', 'none');
			$iframe.attr('src', url);

			$iframe.load(function(){
				$iframe_contents = $iframe.contents();

	    		time2 = setInterval(function(){
	    			if( $iframe_contents.find("[fs-temp-body]").size() > 0 )
	    			{
	    				$http_load_Deferred.resolve();
	    			}
	    			if( $iframe_contents.find("head > meta[httpstate]").attr('httpstate') !== '200' )
	    			{
	    				$http_load_Deferred.reject();
	    			}
	    		}, 100);
			});

			$.when( $http_load_Deferred ).done(function(){
				clearInterval(time2);
				var script_meta = document.createElement("script");
				document.getElementsByTagName("head")[0].appendChild(script_meta);
				$('head > script:last').attr('type', "text/html");
				$('head > script:last').attr('fs-temp-number', temp_number);
				$('head > script:last').attr('id', temp_number);
				$('head > script:last').html( $iframe_contents.find("[fs-temp-body]").html() );

				$iframe.remove();
			})
			.fail(function(){
				clearInterval(time2);
				console.log( 'HTTP state: ' + $iframe_contents.find("head > meta[httpstate]").attr('httpstate') );
				$iframe.remove();
				_this.load_iframe();
			});
		}
		this.load_iframe();

		$(document).on('click', $this.selector, function(event){
			event.preventDefault();
			if( Temp.implementation )
			{
				return false;
			}
			else
			{
				Temp.implementation = true;
			}

    		var time = setInterval(function(){
    			if( $('head > script#' + temp_number).size() > 0 )
    			{
    				$click_Deferred.resolve();
    			}
    		}, 100);
			$.when( $click_Deferred ).done(function(){
    			clearInterval(time);

				Temp.now_temp_body = temp_number;
				Temp.before_function = [];
				Temp.ready_function = [];

				$iframe_contents.find("link[rel='stylesheet'][type='text/css']").each(function(key, value){
					$('<link rel="stylesheet" type="text/css" href="' + $(this).attr('href') + '"></link>').appendTo('head');
				});

				if( typeof(arg.func) !== undefined )
				{
					arg.func();
				}

				var src_arr = [];
				$iframe_contents.find("script[type!='text/html']").each(function(key, value){
					if(
						$(this).attr('src') !== undefined
						&& $("script[src='" + $(this).attr('src') + "']").size() == 0
					)
					{
						src_arr.push( $(this).attr('src') );
					}
				});

				for( var i = 0; i < src_arr.length; i++)
				{
					$('<script src="' + src_arr[i] + '"></script>').appendTo('head');
				}

				$iframe_contents.find("script[type!='text/html']").each(function(key, value){
					if(
						$(this).attr('src') == undefined &&
						$(this).is('[fs-temp-script-construct]') == false
					)
					{
						$('<script>' + $(this).html() + '</script>').appendTo('head');
					}
				});

				setTimeout(function(){
					for( var i = 0; i < Temp.before_function.length; i++)
					{
						Temp.before_function[i]();
					}

					for( var i = 0; i < Temp.before_repeat_function.length; i++)
					{
						Temp.before_repeat_function[i]();
					}
					$(document).off();

					$temp_body = $('[fs-temp-body]');
					$temp_body.html( Temp.template( $('head > script#' + temp_number).html(), Temp ) );
					$temp_body.addClass( now_body_animate );

					for( var i = 0; i < Temp.ready_function.length; i++)
					{
						Temp.ready_function[i]();
					}

					for( var i = 0; i < Temp.ready_repeat_function.length; i++)
					{
						Temp.ready_repeat_function[i]();
					}

					//將載入的模板透過該網址重新載入 AJAX 變數
					//
					//

					var stateObject = {
						url: url
					};
					var title;
					history.pushState(stateObject, title, url);

					Temp.implementation = false;

					setTimeout(function(){
						$temp_body.removeClass(now_body_animate);
					}, 100);

				}, 1);
			})
			.fail(function(){
    			clearInterval(time);
				console.log('error');
			});
		});
	};
});

// $(function(){

// Template = function(arg){
// 	_this = this;

// 	this.__construct = function(arg)
// 	{
// 	}

// 	this.run = function(arg)
// 	{
// 		this.temp_each(arg);
// 		this.translate(arg);
// 	}

// 	this.translate = function(arg)
// 	{
// 		var arg = arg || {};
// 		var var_name = arg.var_name;
// 		if( var_name == undefined )
// 		{
// 			var_name = "{{";
// 		}
// 		else
// 		{
// 			var_name = "{{" + var_name;
// 		}

// 		if( arg.var_name_after == undefined )
// 		{
// 			arg.var_name_after = undefined;
// 		}
// 		else
// 		{
// 			arg.var_name_after = arg.var_name_after;
// 		}

// 		if( arg.selector == undefined )
// 		{
// 			arg.selector = '*';
// 		}

// 		$( arg.selector ).filter(function(index){
// 			$this = $(this);
// 			if( $this.is('script') )
// 			{
// 				return false;
// 			}
// 			for( key in $this.context.attributes )
// 			{
// 				if( ! isNaN(key) )
// 				{
// 					if( $this.context.attributes[key].nodeValue.indexOf(var_name) > -1 )
// 					{
// 						return true;
// 					}
// 				}
// 			}
// 			if( $this.children().html() == undefined )
// 			{
// 				if( $this.html().indexOf(var_name) > -1 )
// 				{
// 					return true;
// 				}
// 				var var_cache = $this.data('fs-temp-text-var_cache');
// 				if( var_cache !== undefined && var_cache.indexOf(var_name) > -1 )
// 				{
// 					return true;
// 				}
// 			}
// 		}).each(function(key, value){
// 			$this = $(this);

// 			var var_cache = $this.data('fs-temp-text-var_cache');
// 			if(
// 				$this.html().indexOf(var_name) > -1 ||
// 				var_cache !== undefined && var_cache.indexOf(var_name) > -1
// 			)
// 			{
// 				if( $this.data('fs-temp-text-var_cache') == undefined )
// 				{
// 					$this.data('fs-temp-text-var_cache', $this.text() );
// 				}
// 				var var_cache = $this.data('fs-temp-text-var_cache');
// 				var var_num = var_cache.split(var_name);
// 				if( var_num.length > 0 )
// 				{
// 					var_num_i = var_num.length / 2;

// 					for(var i = 0; i < var_num_i; i++)
// 					{
// 						var start_str_num = var_cache.indexOf(var_name);
// 						var end_str_num = var_cache.indexOf("}}");

// 						if( start_str_num > -1)
// 						{
// 							var var_str = var_cache.substring(start_str_num + 2, end_str_num);
// 							var var_str2 = var_str;
// 							if( var_str.indexOf("[") > -1 )
// 							{
// 								var_str = var_str.replace(/\[/ig, '\\[');
// 								var_str = var_str.replace(/\]/ig, '\\]');
// 							}
// 							if( var_str.indexOf("$") > -1 )
// 							{
// 								var_str = var_str.replace(/\$/ig, '\\$');
// 							}

// 							var var_str2_arr = var_str2.split(".");
// 							var name = var_str2_arr[0];
// 							var go_ok = true;
// 							for(var i = 0; i < var_str2_arr.length; i++)
// 							{
// 								if( var_str2_arr[i].indexOf("[") > -1 )
// 								{
// 									var var_str2_arr_split = var_str2_arr[i].split("[");
// 									var name2 = name.split( '.' + var_str2_arr_split[0] );
// 									name2 = name2[0];
// 									if(
// 										eval( 'typeof(' + var_str2_arr_split[0] + ') == \'undefined\'')
// 									)
// 									{
// 										var name2 = name2 + '.' + var_str2_arr_split[0];
// 									}

// 									if(
// 										eval( 'typeof(' + name2 + ') == \'undefined\'')
// 									)
// 									{
// 										var go_ok = false;
// 										break;
// 									}
// 								}

// 								if(
// 									eval( 'typeof(' + name + ') == \'undefined\'')
// 								)
// 								{
// 									var go_ok = false;
// 									break;
// 								}

// 								if( i < var_str2_arr.length - 1)
// 								{
// 									var name = name + '.' + var_str2_arr[ i + 1 ];
// 								}
// 							}

// 							if( go_ok )
// 							{
// 								if( arg.var_name_after )
// 								{
// 									eval('var_cache = var_cache.replace(/{{' + var_str + '}}/ig, ' + arg.var_name_after + ');')
// 								}
// 								else
// 								{
// 									eval('var_cache = var_cache.replace(/{{' + var_str + '}}/ig, ' + var_str2 + ');');
// 								}
// 							}
// 							else
// 							{
// 								eval('var_cache = var_cache.replace(/{{' + var_str + '}}/ig, \'\');');
// 							}
// 						}
// 					}
// 				}
// 				eval('$this.text(\'' + var_cache + '\');');
// 			}

// 			for( key in $this.context.attributes )
// 			{
// 				if( ! isNaN(key) )
// 				{
// 					if( $this.context.attributes[key].nodeValue.indexOf(var_name) > -1 )
// 					{
// 						$this.data('fs-temp-' + $this.context.attributes[key].nodeName + '-var_cache', $this.context.attributes[key].nodeValue );
// 						var var_cache = $this.data('fs-temp-' + $this.context.attributes[key].nodeName + '-var_cache');
// 						var var_num = var_cache.split(var_name);
// 						if( var_num.length > 0 )
// 						{
// 							var_num_i = var_num.length / 2;

// 							for(var i = 0; i < var_num_i; i++)
// 							{
// 								var start_str_num = var_cache.indexOf(var_name);
// 								var end_str_num = var_cache.indexOf("}}");

// 								if( start_str_num > -1)
// 								{
// 									var var_str = var_cache.substring(start_str_num + 2, end_str_num);
// 									if( var_str[0] == '$' )
// 									{
// 										eval('var_cache = var_cache.replace(/{{\\' + var_str + '}}/ig, ' + var_str + ');');
// 									}
// 									else
// 									{
// 										eval('var_cache = var_cache.replace(/{{' + var_str + '}}/ig, ' + var_str + ');');
// 									}
// 								}
// 							}
// 						}
// 						eval('$this.attr(\'' + $this.context.attributes[key].nodeName + '\', \'' + var_cache + '\');');
// 					}
// 				}
// 			}
// 		});
// 	}

// 	this.temp_each = function()
// 	{
// 		$('i[each]').each(function(key, value){
// 			$this = $(this);
// 			eval('var each_arr = ' + $this.attr('each') );

// 			if( typeof(each_arr) !== 'object' )
// 			{
// 				return false;
// 			}
// 			// var each_arr = each_arr.reverse();
// 			var each_arr_name = $this.attr('each');

// 			if( $this.filter('i[data-fs-temp-i-number]').size() > 0 )
// 			{
// 				var temp_number = $this.attr('data-fs-temp-i-number');
// 				$('[data-fs-temp-number=\'' + temp_number + '\']').remove();
// 			}
// 			else
// 			{
// 				var temp_number = Math.floor(Math.random() * (99999999 - 10000000 + 1)) + 10000000;
// 				$this.attr('data-fs-temp-i-number', temp_number);
// 			}

// 			var $clone = $this.clone();
// 			$this.css('display', 'none');
// 			var obj_value = $this.attr('value');

// 			for(var i = 0; i < each_arr.length; i++)
// 			{
// 				$clone2 = $clone;
// 				$clone2.find('*').attr("data-fs-temp-number", temp_number);

// 				for (key in each_arr[i])
// 				{
// 					// console.log(obj_value + '.' + key);
// 					// console.log(each_arr_name + '[' + i + ']' + '.' + key);
// 					eval( 'var html = $clone2.html().replace(/{{\\' + obj_value + '/ig, \'{{' + each_arr_name + '[' + i + ']\' );' );
// 				}
// 				if( i == 0 )
// 				{
// 					$( html ).insertAfter("i[data-fs-temp-i-number='" + temp_number + "']");
// 				}
// 				else
// 				{
// 					$( html ).insertAfter("[data-fs-temp-number='" + temp_number + "']:last");
// 				}

// 				// _this.translate({
// 				// 	selector: "[data-fs-temp-number=" + temp_number + "]:eq(" + i + ")",
// 				// 	var_name: obj_value,
// 				// 	var_name_after: each_arr_name
// 				// });

// 				$clone = $clone.clone();
// 				$clone2.remove();
// 			}
// 		});
// 	}

// 	this.__construct(arg);
// }
// Template = new Template();


// });