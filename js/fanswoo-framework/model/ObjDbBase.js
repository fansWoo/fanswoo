$(function(){

ObjDbBase = function(arg){
	var _this = this;
	var obj_class = '';
	var deferred;
	var comply_function;
	var ajax_construct_db;
	var ajax_abort = false;

	this.__construct = function(arg)
	{
		_this.obj_class = arg.obj_class;
		_this.comply_function = arg.comply_function;

		if( ! _this.comply_function )
		{
			_this.comply_function = function(){};
		}

		if(
			_this.obj_class == undefined
		)
		{
			console.log('obj_class 為必填欄位');
			return false;
		}

		delete arg.obj_class;

		if(
			arg.db_where_arr != undefined
		)
		{
			_this.construct_db(arg);
			return true;
		}
	}

	this.construct_db = function(arg)
	{
		var arg;
        var data = {
            obj_class: _this.obj_class,
            long_polling_reloadtime: arg.long_polling_reloadtime,
            long_polling_overtime: arg.long_polling_overtime,
            db_where_arr: arg.db_where_arr,
            db_search_all_status: arg.db_search_all_status,
            db_delete_all_null: arg.db_delete_all_null,
            autoload: arg.autoload
        };

        _this.deferred = $.Deferred();

		_this.ajax_construct_db = $.ajax({
            url: $('base').attr('href')+'api/objdbbase/construct_db/',
            type: 'POST',
            data: data,
        	async: true
        })
    	.done(function(response){
    		if( fanswoo.is_json( response ) )
    		{
        		var json = JSON.parse(response);
	            _this.comply_function(json);
                _this.deferred.resolve();
    		}
        })
    　　.fail(function(response){
    		if( _this.ajax_abort === false)
    		{
	            fanswoo.message_show(
	                '連線斷線，將在 5 秒後重新連線...',
	                2
	            );
            	_this.deferred.reject();
	    		setTimeout(function(){
					_this.construct_db(arg);
	    		}, 5000);
    		}
        });

        _this.deferred.promise();

	}

	this.set = function(arg, arg2)
	{
		var name = arg;
		var value = arg2;

		eval('_this.' + name + ' = value');

		if ( fanswoo.is_json( value ) ) {
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

	this.stop = function(){
		_this.comply_function = function(){};
		_this.ajax_abort = true;
		_this.ajax_construct_db.abort();
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