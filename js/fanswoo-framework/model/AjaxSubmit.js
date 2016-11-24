Temp.ready(function(){

AjaxSubmit = function(){

	var _this = this;
	_this.ajax_response_Deferred = $.Deferred();
	_this.selectorid_arr = [];
	_this.ajax_before_function = [];
	_this.ajax_response_function = [];

	$.fn.ajax_submit = function(arg)
	{
		$this = $(this);
		if( _this.selectorid_arr.length == 0)
		{
			$this.attr('ajax_submit_selectorid', 0);
			_this.selectorid_arr.push( 0 );
		}
		else
		{
			$this.attr('ajax_submit_selectorid', _this.selectorid_arr.length);
			_this.selectorid_arr.push( _this.selectorid_arr[ _this.selectorid_arr.length ] );
		}

		if( arg.ajax_before_function == undefined )
		{
			_this.ajax_before_function.push( function(){} );
		}
		else
		{
			_this.ajax_before_function.push( arg.ajax_before_function );
		}

		if( arg.ajax_response_function == undefined )
		{
			_this.ajax_response_function.push( function(){} );
		}
		else
		{
			_this.ajax_response_function.push( arg.ajax_response_function );
		}

	}

	//admin點選送出
	$(document).on('click', "[fs-submit-send-type!='post']:submit", function(event){
		event.preventDefault();
	    var $this = $(this);
	    var $this_form = $this.parents("form");
	    var url = $this_form.attr("action");
	    var data = {};

	    //針對 fs_ajax_submit event 的函數
		var ajax_submit_selectorid = $this.attr('ajax_submit_selectorid');
		if(
			ajax_submit_selectorid > -1 &&
			_this.ajax_before_function[ajax_submit_selectorid] !== undefined
		)
		{
			_this.ajax_before_function[ajax_submit_selectorid]();
		}
		//結束

	    $this_form.find("input").each(function(key, value){

	        var data_name = $(value).attr("name");
	        var data_value = $(value).val();
	        var data_attr = $(value).attr('type');

	        if(
	        	data_name == undefined ||
	        	data_value == undefined ||
	        	$(value).attr("disabled") !== undefined
	        )
	        {
	        	return true;
	        }

	    	if( data_attr == 'radio' )
	    	{
	    		if($(value).is(':checked') == false)
	    		{
	            	return true;
	    		}
	    	}
	    	else if( data_attr == 'checkbox' )
	    	{
	    		if($(value).is(':checked') == false)
	    		{
	            	return true;
	    		}
	    	}
	    	else if( data_attr == 'submit' )
	    	{
	    		if( data_name !== $this.attr('name') )
	    		{
	            	return true;
	    		}
	    	}

	    	if(data_name.indexOf("[]") > -1)
	    	{
	    		if( data[data_name] == undefined )
	    		{
	    			data[data_name] = [];
	    		}
	    		data[data_name].push( data_value );
	    	}
	    	else
	    	{
	    		data[data_name] = data_value;
	    	}
	    });

	    $this_form.find("select").each(function(key, value){
	        var data_name = $(value).attr("name");
	        var data_value = $(value).val();

	        if(
	        	data_name == undefined ||
	        	data_value == undefined ||
	        	$(value).attr("disabled") !== undefined
	        )
	        {
	        	return true;
	        }

	    	if(data_name.indexOf("[]") > -1)
	    	{
	    		if( data[data_name] == undefined )
	    		{
	    			data[data_name] = [];
	    		}
	    		data[data_name].push( data_value );
	    	}
	    	else
	    	{
	    		data[data_name] = data_value;
	    	}
	    });

	    if( typeof(CKEDITOR) !== 'undefined' )
	    {
	        for(instance in CKEDITOR.instances)
	        {
	            CKEDITOR.instances[instance].updateElement();
	        }
	    }
	    $this_form.find("textarea").each(function(key, value){

	    	$(value).serialize();
	        var data_name = $(value).attr("name");
	        var data_value = $(value).val();

	        if(
	        	data_name == undefined ||
	        	data_value == undefined ||
	        	$(value).attr("disabled") !== undefined
	        )
	        {
	        	return true;
	        }

	    	if(data_name.indexOf("[]") > -1)
	    	{
	    		if( data[data_name] == undefined )
	    		{
	    			data[data_name] = [];
	    		}
	    		data[data_name].push( data_value );
	    	}
	    	else
	    	{
	    		data[data_name] = data_value;
	    	}
	    });

	    data['fs_ajax_post'] = 'true';

	    //按鈕變灰色，增加旋轉標誌
	    $this.wrap("<div fanswoo-ajax_submit_wrap></div>");
	    $("<span fanswoo-ajax_submit_loading></span>").prependTo("[fanswoo-ajax_submit_wrap]");
	    $("[fanswoo-ajax_submit_wrap]").width( parseInt( $this.widthAll() ) + ( parseInt( $this.css('border-width') ) * 2 ));
	    $("[fanswoo-ajax_submit_wrap]").height( parseInt( $this.heightAll() ) + parseInt( $this.css('border-width') * 2 ) );
	    var this_margin_top = $this.css( 'margin-top' );
	    var this_margin_right = $this.css( 'margin-right' );
	    var this_margin_bottom = $this.css( 'margin-bottom' );
	    var this_margin_left = $this.css( 'margin-left' );
	    var this_float = $this.css( 'float' );
	    $this.css( 'margin', '0' );
	    $this.css( 'float', '' );
	    $("[fanswoo-ajax_submit_wrap]").css( 'margin-top', this_margin_top );
	    $("[fanswoo-ajax_submit_wrap]").css( 'margin-right', this_margin_right );
	    $("[fanswoo-ajax_submit_wrap]").css( 'margin-bottom', this_margin_bottom );
	    $("[fanswoo-ajax_submit_wrap]").css( 'margin-left', this_margin_left );
	    if( this_margin_right == '0px' && this_margin_left == '0px')
	    {
	    	$("[fanswoo-ajax_submit_wrap]").css( 'margin-right', 'auto' );
	    	$("[fanswoo-ajax_submit_wrap]").css( 'margin-left', 'auto' );
	    }
	    $("[fanswoo-ajax_submit_wrap]").css( 'float', this_float );
	    $("[fanswoo-ajax_submit_wrap]").css( 'clear', $this.css( 'clear' ) );
	    $("[fanswoo-ajax_submit_loading]").css('position', 'absolute');
	    $("[fanswoo-ajax_submit_loading]").css('width', parseInt( $this.heightAll() - 15  ));
	    $("[fanswoo-ajax_submit_loading]").css('height', parseInt( $this.heightAll() - 15 ) );
	    $("[fanswoo-ajax_submit_loading]").css('margin-left', parseInt( - $("[fanswoo-ajax_submit_loading]").widthAll() / 2) -5 );
	    $("[fanswoo-ajax_submit_loading]").css('margin-top', parseInt( - $("[fanswoo-ajax_submit_loading]").heightAll() / 2) -5 );
	    $this.attr('disabled', 'disabled');

	    $.ajax({
	        url: url,
	        type: 'POST',
	        data: data,
	        error: function(xhr){
	            fanswoo.message_show(
	                'AJAX傳輸錯誤，改用POST傳輸中...',
	                2
	            );
	            setTimeout(function(){
	                $this_form.append("<input type='hidden' name=" + $this.attr('name') + " value=" + $this.val() + ">");
	           		$this_form.submit();
	            }, 2000);
				_this.ajax_response_Deferred.reject();
	            return false;
	        },
	        success: function(response){
	            if( fanswoo.is_json(response) )
	            {
	                var response_Json = $.parseJSON(response);
	                fanswoo.message_show(
	                	response_Json.message,
	                	response_Json.second,
	                	response_Json.url,
	                	response_Json.js
	                );

					if( ajax_submit_selectorid !== undefined )
					{
				        $.when( _this.ajax_response_Deferred ).
				            done(function(){
								_this.ajax_response_function[ajax_submit_selectorid](response_Json.response);
				            }).
				            fail(function(){
				                alert('AJAX 傳輸發生錯誤');
				            }
				        );
				    }
	            }
	            else
	            {
	            	$('html').html(response);
	              //   fanswoo.message_show(
	              //   	'未獲取標準fansWoo Message JSON，改用POST傳輸中...',
	              //   	2
	              //   );
	              //   setTimeout(function(){
	              //   	$this_form.append("<input type='hidden' name=" + $this.attr('name') + " value=" + $this.val() + ">");
	           			// $this_form.submit();
	              //   }, 2000);
	                return false;
	            }

	            if( response_Json.message !== '' )
	            {

	                //按鈕變正常顏色，移除旋轉標誌
	                //送出回傳的訊息
	                if( response_Json.second >= 2 )
	                {
	                    var second = response_Json.second * 1000;
	                }
	                else
	                {
	                    var second = 2000;
	                }

	                $('[fanswoo-ajax_submit_loading]').fadeOut( second, function(){
	                    $this.removeAttr('disabled');
	                    $this_form.find("input, select, textarea").removeAttr('disabled');
	                    $this.unwrap();
				        $this.css( 'margin-top', this_margin_top );
				        $this.css( 'margin-right', this_margin_right );
				        $this.css( 'margin-bottom', this_margin_bottom );
				        $this.css( 'margin-left', this_margin_left );
				        if( this_margin_right == '0px' && this_margin_left == '0px')
				        {
				        	$this.css( 'margin-left', 'auto' );
				        	$this.css( 'margin-right', 'auto' );
				        }
				        $this.css( 'float', this_float );
	                    $('[fanswoo-ajax_submit_loading]').remove();
	                });
					_this.ajax_response_Deferred.resolve();
	            }
	            else
	            {
	            	$('html').html(response);
	              //   fanswoo.message_show(
	              //   	'未獲取標準fansWoo Message JSON，改用POST傳輸中...',
	              //   	2
	              //   );
	              //   setTimeout(function(){
	              //   	$this_form.append("<input type='hidden' name=" + $this.attr('name') + " value=" + $this.val() + ">");
	            		// $this_form.submit();
	              //   }, 2000);
	                return false;
	            }
	        }
	    });
	});

};
AjaxSubmit = new AjaxSubmit();

});