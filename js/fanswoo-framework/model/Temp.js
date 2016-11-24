
Temp = function(arg){
	var _this = this;
	_this.ready_function = [];

	this._construct = function(arg)
	{
		_this.ready(arg);
	}

	//Temp.ready裡面放的是完成 Temp 繪製之後要做的事情，若放在 dom 本文內，每次 load 新頁面時都會重複讀取
	this.ready = function(arg)
	{
		if (self != top)
		{
			return false;
		}

		$(function(){

			if(typeof(arg) !== 'object')
			{
				_this.ready_function.push(function(){
					arg();
				});
			}

		});
	}

	this.construct = function()
	{
		if (self != top)
		{
			return false;
		}

		for( var i = 0; i < _this.ready_function.length; i++)
		{
			_this.ready_function[i]();
		}
	}

	this._construct(arg);

}

Temp = new Temp(function(){});