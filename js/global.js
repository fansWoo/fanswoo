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

	//表單預算取得的程式
	$.ajax({ //使用 AJAX 取得 JSON 格式的資料檔
        url: $('base').attr('href') + 'js/contact_select_json.js', //JSON 格式的設定檔的位置
        type: 'GET', // 取得方式使用 GET
        dataType: 'json' // 取得以後的型別為 JSON
    })
	.done(function(response){ // 如果成功使用 AJAX 取得檔案以後即執行裡面的程式

		var contact_selector_arr = response;

		// need_html 定義為 <select> 內的 HTML 內文
		var need_html = '<option value="">請先選擇主要詢問項目</option>';
		// 將 contact_selector_arr 內的 JSON 印出來，轉換成 <option>
		for( key in contact_selector_arr )
		{
			var need_html = need_html + '<option value="' + key + '"' + '>' + contact_selector_arr[key].name + '</option>';
		}
		// 將 need_html 寫到 <select> 裡面
		$('.need').html( need_html );
		
		// 當 select.need 的值發生變化的時候，執行以下內容
		$(document).on('change', 'select.need', function(){

			// 把預算欄位暫時隱藏
			$('.price_choose').css('display', 'none');

			//建立 need_child_html 變數作為暫時的 HTML 內文
			var need_child_html = '<option value="">請選擇次要詢問項目</option>';

			//迴圈 contact_selector_arr 
			for( key in contact_selector_arr )
			{
				// 如果 key 等於使用者選擇的內容的話，就將指定的內容抓到 need_child_html 內
				if( $('select.need').val() == key )
				{
					for( key2 in contact_selector_arr[key].child )
					{
						var need_child_html = need_child_html + '<option value="' + key2 + '"' + '>' + contact_selector_arr[key].child[key2].name + '</option>';
					}
				}
			}
			// 將 need_child_html 寫到 <select> 裡面
			$('.need_child').html( need_child_html );

		});
		
		// 當 select.need_child 的值發生變化的時候，執行以下內容
		$(document).on('change', 'select.need_child', function(){

			//首先清空 .price_choose
			$('.price_choose').html("");

			//迴圈 contact_selector_arr 
			for( key in contact_selector_arr )
			{
				if( $('select.need').val() == key )
				{
					//迴圈 contact_selector_arr[key].child
					for( key2 in contact_selector_arr[key].child )
					{
						if( $('select.need_child').val() == key2 )
						{
							//迴圈 contact_selector_arr[key].child[key2].budget
							for( key3 in contact_selector_arr[key].child[key2].budget )
							{
								// 複製 .choose_box_copy 作為模板
								$clone = $('.choose_box_copy').clone();

								$clone.css('display', 'block');
								$clone.removeClass('choose_box_copy');
								$clone.addClass('choose_box');
								
								$clone.find('h3').text( contact_selector_arr[key].child[key2].budget[key3].range );
								$clone.find('h4').text( contact_selector_arr[key].child[key2].budget[key3].text );
								$clone.find("input[name='budget_range']").val( contact_selector_arr[key].child[key2].budget[key3].text );

								//複製 $clone 插入 price_choose
								$clone.appendTo(".price_choose");

								if( key3 < 3)
								{
									$("<div class='line'></div>").appendTo(".price_choose");
								}
							}
						}
					}
				}
			}

			$('.price_choose').css('display', 'block');
			$('.price_choose').prepend('<p>預算選擇</p>');
		});
	})
　　.fail(function(response){ // 如果 AJAX 取值錯誤的話，執行此行
        fanswoo.message_show(
            'AJAX傳輸錯誤...',
            2
        );
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