$(function(){

PollingWatching = function(arg){

	var _this = this;
	var obj_class;
	var watching_ids_arr = [];
	var comply_function;
	var ajax_construct;
	var ajax_pending;
	var ajax_abort = false;

	this.__construct = function(arg)
	{
		_this.obj_class = arg.obj_class;
		_this.watching_ids_arr = arg.watching_ids_arr;
		_this.comply_function = arg.comply_function;
		_this.construct(arg);
	}

	this.construct = function()
	{

		_this.ajax_construct = $.ajax({
            url: $('base').attr('href') + 'api/polling_watching/construct',
            type: 'POST',
            data: {
            	watching_ids_arr: _this.watching_ids_arr,
            	obj_class: _this.obj_class
            },
            async: true
        })
    	.done(function(response){

    		var pollingid = response;

			_this.ajax_pending = $.ajax({
	            url: $('base').attr('href') + 'api/polling_watching/pending',
	            type: 'POST',
	            data: {
	            	pollingid: pollingid
	            },
            	async: true
	        })
	    	.done(function(response2){

	    		if( response2 == '' )
	    		{
					_this.construct();
	    		}
	    		else
	    		{
		    		var change_ids_arr = response2.split(',');
					_this.comply_function(change_ids_arr);
	    		}

	        })
	    　　.fail(function(response){
	    		if( _this.ajax_abort === false)
	    		{
		            fanswoo.message_show(
		                '連線斷線，將在 5 秒後重新連線...',
		                2
		            );
		    		setTimeout(function(){
						_this.construct();
		    		}, 5000);
	    		}
	        });

        })
    　　.fail(function(response){
    		if( _this.ajax_abort === false)
    		{
	            fanswoo.message_show(
	                '連線斷線，將在 5 秒後重新連線...',
	                2
	            );
	    		setTimeout(function(){
					_this.construct();
	    		}, 5000);
    		}
        });
	}

	this.stop = function(){
		_this.comply_function = function(){};
		_this.ajax_abort = true;
		_this.ajax_construct.abort();
		if( _this.ajax_pending )
		{
			_this.ajax_pending.abort();
		}
	}

	this.__construct(arg);
};

});