$(function(){
	//解析度調整
	smallWindowWidth();
	$(window).resize(function(){
		smallWindowWidth();
	});
	
	//回到最上層
	$(document).on('click', '.pageGoTop', function(){
		$("html,body").animate({scrollTop: 0}, 1000, 'swing');
	});
	
	//連結動畫
	$(document).on('click', '[data-hrefto]', function(){
		var href = $(this).data('hrefto');
		$('.wrap').addClass('opacity0');
		setTimeout(function(){
			$('.wrap').remove();
			location.href = href;
		}, 0);
	});
	
	//imgLoading
	$(".picLoadingList").imgLoading({
		obj: '.picLoading',
		callback: function(){
			$(".logoStart").addClass('opacity0');
			$(".picLoading").addClass("opacity0");
			setTimeout(function(){
				$(".logoStart").css('display', 'none');
				$(".picLoading").css('display', 'none');
				$("body").addClass("start");
				setTimeout(function(){
					$("body").addClass("forever");
				}, 3000);
			}, 1000);
		}
	});

	//選擇預算
	var contact_selector_arr = {
		'graphic': {
			'name': '美術設計',
			'child': {
				'cislogo': {
					'name': 'CIS/LOGO 設計',
					'budget': [
						{
							'range': '25~50萬',
							'text': '感到耳目一新'
						},
						{
							'range': '50~100萬',
							'text': '印象非常深刻'
						}
					]
				},
				'cislogo2': {
					'name': 'CIS/LOGO 設計2',
					'budget': [
						{
							'range': '25~50萬',
							'text': '感到耳目一新'
						},
						{
							'range': '50~100萬',
							'text': '印象非常深刻'
						}
					]
				}
			}
		},
		'marketing': {
			'name': '網路行銷',
			'child': {
				'facebook_website': {
					'name': 'facebook 網站廣告',
					'budget': [
						{
							'range': '5萬/月',
							'text': '微型曝光'
						},
						{
							'range': '10萬/月',
							'text': '一般曝光'
						}
					]
				}
			}
		}
	};

	var need_html = '<option value="">請先選擇主要詢問項目</option>';
	for( key in contact_selector_arr )
	{
		var need_html = need_html + '<option value="' + key + '"' + '>' + contact_selector_arr[key].name + '</option>';
	}
	$('.need').html( need_html );
	
	$(document).on('change', 'select.need', function(){

		var need_child_html = '<option value="">請選擇次要詢問項目</option>';
		for( key in contact_selector_arr )
		{
			if( $('select.need').val() == key )
			{
				for( key2 in contact_selector_arr[key].child )
				{
					var need_child_html = need_child_html + '<option value="' + key2 + '"' + '>' + contact_selector_arr[key].child[key2].name + '</option>';
				}
			}
		}
		$('.need_child').html( need_child_html );

	});
	
	$(document).on('change', 'select.need_child', function(){

		$('.price_choose').html("");

		for( key in contact_selector_arr )
		{
			if( $('select.need').val() == key )
			{
				for( key2 in contact_selector_arr[key].child )
				{
					if( $('select.need_child').val() == key2 )
					{
						for( key3 in contact_selector_arr[key].child[key2].budget )
						{
							console.log( contact_selector_arr[key].child[key2].budget[key3].range );
							$clone = $('.choose_box_copy').clone();
							$clone.css('display', 'block');

							//複製 $clone 插入 price_choose
						}
					}
				}
			}
		}

		$('.price_choose').css('display', 'block');
		//插入  "<p>預算選擇</p>"
	});
	
	//去除虛線
	$("a").focus(function(){
		$(this).blur();
	});
});

//調整解析度
function smallWindowWidth(){
	if($(window).width() < 1250){
		$("body").addClass("smallWindowWidth");
	}
	else{
		$("body").removeClass("smallWindowWidth");
	}
}


function check_action(message, url){
    var message;
    var url;
    var answer = confirm(message);
    if (answer){
        location.href = url;
    }
}