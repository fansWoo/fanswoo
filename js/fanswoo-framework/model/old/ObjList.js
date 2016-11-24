$(function(){

ObjList = function(arg){
	var _this = this;
	var obj_var = '';
	var obj_class = '';
	var obj_arr = [];
	var deferred;

	this.__construct = function(arg)
	{
		// arg.obj_var = arg.obj_var.replace(/\./g, "-");
		// arg.obj_var = arg.obj_var.replace(/\[/g, "-");
		// arg.obj_var = arg.obj_var.replace(/\]/g, "-");

		_this.obj_var = arg.obj_var;
		_this.obj_class = arg.obj_class;
		_this.uniqueids_arr = arg.uniqueids_arr;

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
		delete arg.uniqueids_arr;

		if(
			arg.db_where_arr != undefined
		)
		{
			_this.construct_db(arg);
		}
		else if( typeof(arg) == 'object' )
		{
			_this.construct(arg);
		}
		else
		{
			// console.log(arg);
			// _this.construct(arg);
		}

	}

	this.construct = function(arg)
	{
		var construct_arr = arg.construct_arr;
		var obj;
		var obj_arr = [];

		if( construct_arr.length == 0)
		{
			obj_arr[0] = {};
		}
		else
		{
			for(var i = 0; i < construct_arr.length; i++)
			{
				obj_arr[i] = {};
				var obj_var = _this.obj_var + '.obj_arr[' + i + ']';
				obj = new ObjDbBase({
					obj_var: obj_var,
					obj_class: _this.obj_class
				});
				for (key in construct_arr[i]) {
					eval('var value = construct_arr[i].' + key);

					obj.set(key, value);
				}
				obj_arr[i] = obj;
			}
		}

		_this.obj_arr = obj_arr;

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
            db_where_arr: arg.db_where_arr,
            db_orderby_arr: arg.db_orderby_arr,
            db_delete_all_null: arg.db_delete_all_null,
            long_polling_reloadtime: arg.long_polling_reloadtime,
            limitstart: arg.limitstart,
            limitcount: arg.limitcount
        };

	    _this.deferred = $.Deferred();

        if( typeof(ajax_timeout) !== 'undefined' )
        {
            clearTimeout(ajax_timeout);
        }
        ajax_timeout = setTimeout(function(){

			$.ajax({
            	url: $('base').attr('href')+'api/objlist/construct_db/',
	            type: 'POST',
	            data: data
		    })
        	.done(function(response){
	            eval(response);
                _this.deferred.resolve();
            });
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

		if ( fanswoo.is_json( value ) ) {
			console.log('hey');
			value = JSON.parse(value);
		}

		eval('_this.' + name + ' = value');
	}

	this.get = function(arg)
	{
		var name = arg;

		return _this.name;
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