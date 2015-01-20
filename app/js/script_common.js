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
	if($.browser.msie && $.browser.version < 9){
		$('body').append("您的瀏覽器版本過舊，請使用支援CSS3之瀏覽器").css({'position':'fixed', 'left':'50%', 'top': '50%', 'margin-top': '80px', 'margin-left': '-125px'});
	}
	else{
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
	}
	
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