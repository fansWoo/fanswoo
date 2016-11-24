$(function(){

ObjDbBase = function(arg){
	var _this = this;
	var obj_var = '';
	var obj_class = '';
	var deferred;

	this.__construct = function(arg)
	{
		// arg.obj_var = arg.obj_var.replace(/\./g, "-");
		// arg.obj_var = arg.obj_var.replace(/\[/g, "-");
		// arg.obj_var = arg.obj_var.replace(/\]/g, "-");

		_this.obj_var = arg.obj_var;
		_this.obj_class = arg.obj_class;

		if(
			_this.obj_var == undefined ||
			_this.obj_class == undefined
		)
		{
			console.log(' obj_var 及 obj_class 為必填欄位');
			return false;
		}

		delete arg.obj_var;
		delete arg.obj_class;

		if(
			arg.db_where_arr != undefined
		)
		{
			_this.construct_db(arg);
			return true;
		}
		else if( typeof(arg) == 'object' )
		{
			_this.construct(arg);
			return true;
		}
		else
		{
			// console.log(arg);
			// _this.construct(arg);
			return true;
		}
	}

	this.construct = function(arg)
	{
		var obj = arg;

		for (key in obj) {
			eval('var value = obj.' + key);

			if(
				typeof( value ) == 'number' ||
				typeof( value ) == 'string'
			)
			{
				_this.set( key, value );
			}
		}

		var num = _this.obj_var.split('.');
		if( num.length == 1 )
		{
			eval('Temp.' + _this.obj_var + ' = _this');
		}

	}

	this.construct_db = function(arg)
	{
		var arg;
        var data = {
        	obj_var: _this.obj_var,
            obj_class: _this.obj_class,
            long_polling_reloadtime: arg.long_polling_reloadtime,
            db_where_arr: arg.db_where_arr
        };

        _this.deferred = $.Deferred();

        if( typeof(ajax_timeout) !== 'undefined' )
        {
            clearTimeout(ajax_timeout);
        }

        ajax_timeout = setTimeout(function(){

			$.ajax({
	            url: $('base').attr('href')+'api/objdbbase/construct_db/',
	            type: 'POST',
	            data: data
	        })
        	.done(function(response){
	            eval(response);
                _this.deferred.resolve();
            })
        // 　　.fail(function(response){
        //         fanswoo.message_show(
        //             'AJAX傳輸錯誤...',
        //             2
        //         );
        //         _this.deferred.reject();
        //     });

			var num = _this.obj_var.split('.');
			if( num.length == 1 )
			{
				eval('Temp.' + _this.obj_var + ' = _this');
			}

	        _this.deferred.promise();

	        // if( arg.temp_ajax_selector )
	        // {
		       //  $.when( _this.deferred ).
		       //      done(function(){
		       //      	if( arg.temp_ajax_obj )
		       //      	{
		       //          	Temp.ajax(arg.temp_ajax_selector, arg.temp_ajax_obj, arg.temp_ajax_insert_path);
		       //      	}
		       //      	else
		       //      	{
		       //          	Temp.ajax(arg.temp_ajax_selector, '', arg.temp_ajax_insert_path);
		       //      	}
		       //      }).
		       //      fail(function(){
		       //          alert('AJAX 傳輸發生錯誤');
		       //      }
		       //  );
	        // }

        }, 200);
	}

	this.set = function(arg, arg2)
	{
		var name = arg;
		var value = arg2;

		eval('_this.' + name + ' = value');

		if ( fanswoo.is_json( value ) ) {
			console.log('hey');
			value = JSON.parse(value);
		}

		if(
			typeof(value) == 'array' ||
			typeof(value) == 'object'
		)
		{
			_this.set_array({name: name, value: value});
		}
	}

	this.get = function(arg)
	{
		var name = arg;

		return _this.name;
	}

	this.set_array = function(arg)
	{
		var name = arg.name;
		var value = arg.value;

		if(
			typeof(value) == 'object' ||
			typeof(value) == 'array'
		)
		{
			var i = 0;
			for(key in value)
			{
				if( isNaN( key ) )
				{
					if( key.indexOf(".") !== -1 )
					{
						break;
					}

					var value_key;
					eval('value_key = value.' + key);
					if(
						typeof(value_key) == 'array' ||
						typeof(value_key) == 'object'
					)
					{
						_this.set_array({ name: name, value: value_key });
					}
					i++;
				}
				else
				{
				}
			}
		}

	}

	//未完成
	// this.update = function(arg)
	// {
	// 	var arg;
 //        var data = {
 //            obj_class: _this.obj_class,
 //            db_update_arr: arg.db_update_arr
 //        };

	// 	for (key in _this) {
	// 		eval('var value = _this.' + key);

	// 		if(
	// 			typeof( value ) == 'number' ||
	// 			typeof( value ) == 'string'
	// 		)
	// 		{
 //        		eval('var data.' + key + ' = ' + value);
	// 		}
	// 	}

	// 	$.ajax({
 //            url: $('base').attr('href')+'api/objdbbase/update/',
 //            type: 'POST',
 //            data: data,
 //            error: function(xhr){
 //                fanswoo.message_show(
 //                    'AJAX傳輸錯誤...',
 //                    2
 //                );
 //                return false;
 //            },
 //            success: function(response){
 //            }
 //        });
	// }

	this.__construct(arg);
};

});