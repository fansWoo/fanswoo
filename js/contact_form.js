$(function(){

	//表單預算取得的程式
	$.ajax({ //使用 AJAX 取得 JSON 格式的資料檔
        url: $('base').attr('href') + 'js/contact_form_json.js', //JSON 格式的設定檔的位置
        type: 'GET', // 取得方式使用 GET
        dataType: 'json' // 取得以後的型別為 JSON
    })
	.done(function(response){ // 如果成功使用 AJAX 取得檔案以後即執行裡面的程式

		var contact_selector_arr = response;

		// need_html 定義為 <select> 內的 HTML 內文
		var need_html = '<option value="" style="color:#CCC;">請先選擇主要詢問項目</option>';
		// 將 contact_selector_arr 內的 JSON 印出來，轉換成 <option>
		for( key in contact_selector_arr )
		{
			var need_html = need_html + '<option value="' + contact_selector_arr[key].name + '"' + '>' + contact_selector_arr[key].name + '</option>';
		}
		// 將 need_html 寫到 <select> 裡面
		$('.need').html( need_html );
		
		// 當 select.need 的值發生變化的時候，執行以下內容
		$(document).on('change', 'select.need', function(){

			$('select.need').val($(this).val());

			// 把預算欄位暫時隱藏
			$('.price_choose').css('display', 'none');

			//建立 need_child_html 變數作為暫時的 HTML 內文
			var need_child_html = '<option value="" style="color:#CCC;">請先選擇次要詢問項目</option>';
			var need_child_money = '<option value="" style="color:#CCC;">請選擇預算金額</option>';


			//迴圈 contact_selector_arr 
			for( key in contact_selector_arr )
			{
				// 如果 key 等於使用者選擇的內容的話，就將指定的內容抓到 need_child_html 內
				if( $('select.need').val() == contact_selector_arr[key].name )
				{
					for( key2 in contact_selector_arr[key].child )
					{
						var need_child_html = need_child_html + '<option value="' + contact_selector_arr[key].child[key2].name + '"' + '>' + contact_selector_arr[key].child[key2].name + '</option>';
					}
				}
			}
			// 將 need_child_html 寫到 <select> 裡面
			$('.need_child').html( need_child_html );
			$('.money').html( need_child_money );

		});
		
		// 當 select.need_child 的值發生變化的時候，執行以下內容
		$(document).on('change', 'select.need_child', function(){

			var window_width = $(window).width();

			$('select.need_child').val($(this).val());

			var need_child_money = '<option value="" style="color:#CCC;">請選擇預算金額</option>';

			if(window_width > 700)
			{
				//如果沒有選擇次要選項的話，就隱藏預算區塊
				if( $('select.need_child').val() == '' )
				{
					$('.price_choose').css('display', 'none');
					return false;
				}

				//首先清空 .price_choose
				$('.price_choose').html("");
			}
		
			//迴圈 contact_selector_arr 
			for( key in contact_selector_arr )
			{
				if( $('select.need').val() == contact_selector_arr[key].name )
				{
					//迴圈 contact_selector_arr[key].child
					for( key2 in contact_selector_arr[key].child )
					{
						if( $('select.need_child').val() == contact_selector_arr[key].child[key2].name )
						{
							//迴圈 contact_selector_arr[key].child[key2].budget
							for( key3 in contact_selector_arr[key].child[key2].budget )
							{
								var need_child_money = need_child_money + '<option value="' + contact_selector_arr[key].child[key2].budget[key3].range + '"' + '>' + contact_selector_arr[key].child[key2].budget[key3].range + '</option>';

								// 複製 .choose_box_copy 作為模板
								$clone = $('.choose_box_copy').clone();

								$clone.css('display', 'block');
								$clone.removeClass('choose_box_copy');
								$clone.addClass('choose_box');

								$clone.find('h3').text( contact_selector_arr[key].child[key2].budget[key3].range );
								$clone.find('h4').text( contact_selector_arr[key].child[key2].budget[key3].text );
								$clone.find("input[name='budget_range']").val( contact_selector_arr[key].child[key2].budget[key3].range );

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

				// 將 need_child_html 寫到 <select> 裡面
				$('.money').html( need_child_money );
			}

			$('.price_choose').css('display', 'block');
			$('.price_choose').prepend('<p>預算選擇</p>');

			//點選第一個預算選項
			$('.price_choose .choose_box:eq(0)').click();

			if(window_width <= 700){
				$('.price_choose').css('display','none');
			}
		});
	})
　　.fail(function(response){ // 如果 AJAX 取值錯誤的話，執行此行
        fanswoo.message_show(
            'AJAX傳輸錯誤...',
            2
        );
    });

	//選擇預算
	$(document).on('click', '.choose_box', function(){
		$('.choose_box').removeClass('hover');
		$('.choose_box').find("h4").removeClass('hover');
		$('.choose_box').find("[name='budget_range']").attr('disabled', 'disabled');
		$(this).addClass('hover');
		$(this).find("h4").addClass('hover');
		$(this).find("[name='budget_range']").removeAttr('disabled');
	});

});