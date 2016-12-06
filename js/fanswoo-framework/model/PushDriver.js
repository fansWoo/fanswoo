function PushDriver(arg){

	var $ = jQuery;
	var _this = this;
	_this.pollingid;
	_this.channel;
	_this.event_name;
	_this.event_function = [];

	this.__construct = function(arg)
	{
		_this.channel = arg.channel;
		_this.construct(arg);
	}

	this.construct = function()
	{
	}

	this.event = function(event_name, func){
		var event_name;
		_this.event_name = event_name;
		_this.event_function[event_name] = func;

		_this.ajax_pending = $.ajax({
            url: $('base').attr('href') + 'api/long_polling/pending',
            type: 'POST',
            data: {
            	pollingid: _this.pollingid,
            	channel: _this.channel,
            	event: _this.event_name
            },
        	async: true
        })
    	.done(function(response){

    		if( response == '' )
    		{
    			// console.log(response);
				_this.event(event_name, func);
    		}
    		else
    		{
    			if( fanswoo.is_json(response) )
    			{
    				response_json = JSON.parse(response);
    				if( response_json.pollingid )
    				{
    					_this.pollingid = response_json.pollingid;
    				}
    				if( response_json.push_message )
    				{
    					func(response_json.push_message);
    				}
    			}
    			else
    			{
    				console.log(response);
    			}
				_this.event(event_name, func);
    		}

        })
    　　.fail(function(response){
    		setTimeout(function(){
				_this.pollingid = undefined;
				_this.event(event_name, func);
    		}, 5000);
        });
	}

	// this.stop = function(){
	// 	_this.comply_function = function(){};
	// 	_this.ajax_abort = true;
	// 	_this.ajax_construct.abort();
	// 	if( _this.ajax_pending )
	// 	{
	// 		_this.ajax_pending.abort();
	// 	}
	// }

	this.__construct(arg);
};