<?=$temp['header_up']?>
<script src="app/js/smooth_scrollerator.js"></script>
<script src="app/js/cycle2.js"></script>
<script>
$(function(){
		$(document).on('click', '.content9 .choose_box , .content9 .circle', function(){
			var bgname = $(this).data('bgname');
			$('.content9 .choose_box').removeClass('clicked');
			$(this).addClass('clicked');
			//新增的
			$('.content9 .choose_box').removeClass('hover');
			$('.content9 h4').removeClass('hover');
			$('.content9 .choose_box[data-bgname=' + bgname + '] ').addClass('hover');
			$('.content9 .choose_box[data-bgname=' + bgname + '] input').attr('name', 'money_Str');
			$('.content9 h4[data-bgname=' + bgname + ']').addClass('hover');	
		});
		$(".content8 .slide_pic > .square1").cycle({
				fx      :       "fade", 
				//fade
				//scrollHorz
				timeout: 0 ,
				speed: 500,
				manualSpeed: 600,
				slides: ' > .slide_bg_href',
				next: '.content8 .next',
				prev: '.content8 .prev',
				pager: '.content5 .cycle-pager '
		});
		$(".content8 .slide_pic > .square2").cycle({
				fx      :       "scrollHorz", 
				//fade
				//scrollHorz
				timeout: 0 ,
				speed: 3000,
				manualSpeed: 600,
				slides: ' > .slide_pic_href',
				next: '.content8 .next',
				prev: '.content8 .prev',
				pager: '.content1 .cycle-pager '
		});
	$(document).scroll(function(){
		var window_width = $(window).width();
		var scroll_top = $(document).scrollTop();
		if(scroll_top == 0){
			$('.content2 , .content3 , .content4 , .content5 , .content6 , .content7 , .content8' ).removeClass('hover');
		}
		else if(scroll_top >= 850 && scroll_top < 1200){
			$('.content2').addClass('hover');
		}
		else if(scroll_top >= 1200 && scroll_top < 2000){
			$('.content3').addClass('hover');
		}
		else if(scroll_top >= 2000 && scroll_top < 2900){
			$('.content4').addClass('hover');
		}
		else if(scroll_top >= 2900 && scroll_top < 3600){
			$('.content5').addClass('hover');
		}
		else if(scroll_top >= 3600 && scroll_top < 4350){
			$('.content6').addClass('hover');
		}
		else if(scroll_top >=4350 && scroll_top <5000){
			$('.content7').addClass('hover');
		}
		
		if(window_width > 700 && window_width <= 1400){
			if(scroll_top >= 0 && scroll_top < 300){
				$('.content1 .area').addClass('fixed');
				$('.content1 .area').removeClass('stop');
			}
			else if(scroll_top > 300){
				$('.content1 .area').addClass('stop');
				$('.content1 .area').removeClass('fixed');			
			}
			if(scroll_top > 500){
				$('.content1 .arrow').css('display' , 'none');
			}
			else if(scroll_top < 500){
				$('.content1 .arrow').css('display' , 'block');
			}
		}
		if(window_width > 1400){
			if(scroll_top >= 0 && scroll_top < 200){
				
				$('.content1 .area').addClass('fixed');
				$('.content1 .area').removeClass('stop');
			}
			else if(scroll_top > 200){
				$('.content1 .area').addClass('stop');
				$('.content1 .area').removeClass('fixed');	
						
			}	
			if(scroll_top > 1080){
				$('.content1 .arrow').addClass('display' , 'none');
			}
			else if(scroll_top < 1080){
				$('.content1 .arrow').css('display' , 'block');
			}	
		}
	});	
	$('a[href^=#]').click(function () {
		var speed = 500;
		var href = $(this).attr("href");
		var target = $(href == "#" || href == "" ? 'html' : href);
		var position = target.offset().top;
		$("html, body").animate({scrollTop: position}, speed, "swing");
			return false;
	});
	$(document).scroll(function(){
		
		var scroll_top = $(document).scrollTop();
        var scroll_top_height = scroll_top + $(window).height();
		console.log(scroll_top);
		var window_width = $(window).width();
		if(window_width > 700){
			var content_portfolio_top = $('.content1').offset().top;
			var content_portfolio_height_all = $('.content1').heightAll();	
			
			if(scroll_top_height >= content_portfolio_top && scroll_top < content_portfolio_top + content_portfolio_height_all)
			{
				var s1 = (scroll_top_height - content_portfolio_top) / 12;
				var s2 = (scroll_top_height - content_portfolio_top) / 3;
				var s3 = (scroll_top_height - content_portfolio_top) / 6;
				var s4 = (scroll_top_height - content_portfolio_top) / 4;

				$('.content1 .bg1').css('transform', 'translateY(-' + s1 + 'px)');
				$('.content1 .bg2').css('transform', 'translateY(' + s2 + 'px)');
				//$('.content1 .arrow').css('transform', 'translateY(' + s4 + 'px)');
				//$('.content1 .area').css('transform', 'translateY(' + s4 + 'px)');

			}
		}
	});	
	//var window_height = $(window).height();
		//$('.content1').css('height', window_height  * 2);
		//$('.content1 .area').css('height', window_height  * 2);
		//$(window).resize(function(){
			//var window_height = $(window).height();
			//$('.content1').css('height', window_height);
			//$('.content1 .area').css('height', window_height);
		
	//});
	$(document).on('mouseenter', '.textContactForm', function(){
		$('.textContactForm').addClass('hover');
		$('.textContact').addClass('hidden');
	});
	$(document).on('focus', '.textContactForm.hover .need, .textContactForm.hover .need_child, .textContactForm.hover .money', function(){
		$(this).find("option[value='']").remove();
	});
	
	$(document).on('focus', '.textContactForm.hover .need', function(){
		$('.textContactForm.hover .need').change();
	});
		
	$(document).on('change', '.textContactForm.hover .need', function(){
		var selected = $(this).val();
		$('.need_child').css('display', 'none');
		$('.need_child').addClass('displaynone');
		$('.need_child[data-selected=' + selected + ']').css('display', 'block');
		$('.need_child[data-selected=' + selected + ']').attr('name', 'classtype2_Str');
		$('.need_child option').removeAttr('selected');
		$('.need_child[data-selected=' + selected + '] option:first').attr('selected', true);
	});
});
</script>
<?=$temp['header_down']?>
<?=$temp['header_bar']?>
<div class="content1">
	<div class="bg1">
		<img src="app/img/server/content1/bg3.png">
	</div>
	<div class="bg2">
		<img src="app/img/server/content1/bg4.png">
	</div>
	<div class="mobile_bg">
		<img src="app/img/server/mobile/bg1.png">
	</div>
	<div class="area">
		<div class="pic1">
			<img src="app/img/server/content1/pic1.png">
		</div>
		<div class="text">
			<h2>提供世界一流的Google雲端伺服器</h2>
			<h2>為企業網站、購物網站和網路平台</h2>	
			<h2>找到完美解決方案！</h2>	
		</div>
		<a href="#content2" class="arrow">
			<img src="app/img/index/arrow_down.png">	
		</a>
	</div>
</div>
<div class="content2" id="content2">
	<div class="area">
		<div class="text_arae">
			<div class="title_pic">
				<img src="app/img/server/content2/text.png">
			</div>
			<img src="app/img/server/content2/mobile/text1.png" class="phone_text1">
			<img src="app/img/server/content2/mobile/text2.png" class="phone_text2">
			<img src="app/img/server/content2/mobile/map.png" class="phone_map">
			<div class="text">
				<p>伺服器最令人擔憂的就是伺服器當機問題，為此我們特別選用全世界前三名的Google Cloud Platform伺服器主機，保證98.8%的不斷線率，伺服器由數萬台雲端伺服器虛擬化而成，任何伺服器發生當機，立刻有其它伺服器即時備援，讓用戶無需擔憂。</p>
				<p>核心架構採Linux作業系統+Apache伺服器+MySQL資料庫+PHP程式語言，具有70%以上的高市佔率不管企業用戶、個人用戶都能感受到穩定的速度與效能。</p>
			</div>
		</div>
		<div class="server">
			<img src="app/img/index/fixed_table/pic5.png">
		</div>
	</div>
</div>
<div class="content3">
	<div class="area">
		<div class="left_box">
			<img src="app/img/server/content3/text.png" class="pc_title">
			<img src="app/img/server/content3/pad_title.png" class="pad_title">
		</div>
		<div class="right_box">
			<div class="box short">
				<div class="item_box">
					<div class="price">
						<p>費用</p>
					</div>
					<div class="item"><p>硬碟容量</p></div>
					<div class="item"><p>流量</p></div>
					<div class="item"><p>共用頻寬</p></div>
					<div class="item"><p>XXXX</p></div>
					<div class="item"><p>XXXX</p></div>
				</div>
			</div>
			<div class="box">
				<img src="app/img/server/content3/pic1.png" class="type">
				<div class="item_box">
					<div class="price">
						<p>NT$<span>8,000</span>/年</p>
					</div>
					<div class="item"><p>10G SSD </p></div>
					<div class="item"><p>40G / 400G</p></div>
					<div class="item"><p>2M / 1T</p></div>
					<div class="item"><p>XXX</p></div>
					<div class="item"><p>XXX</p></div>
				</div>
			</div>
			<div class="box">
				<img src="app/img/server/content3/pic1.png" class="type">
				<div class="item_box">
					<div class="price">
						<p>NT$<span>18,000 </span>/年</p>
					</div>
					<div class="item"><p>20G SSD </p></div>
					<div class="item"><p>80G / 800G</p></div>
					<div class="item"><p>5M / 1T</p></div>
					<div class="item"><p>XXX</p></div>
					<div class="item"><p>XXX</p></div>
				</div>
			</div>
			<div class="box">
				<img src="app/img/server/content3/pic1.png" class="type">
				<div class="item_box">
					<div class="price">
						<p>NT$<span>38,000 </span>/年</p>
					</div>
					<div class="item"><p>40G SSD</p></div>
					<div class="item"><p>120G / 1200G</p></div>
					<div class="item"><p>10M / 1T</p></div>
					<div class="item"><p>XXX</p></div>
					<div class="item"><p>XXX</p></div>
				</div>
			</div>
		</div>
	</div>
	<div class="phone_area">
		<div class="title_box">
			<img src="app/img/server/content3/mobile/text.png" class="phone_title">
			<h2>提供三種主機專案，滿足小型用戶的需求</h2>
			<p>我們特別為小型用戶提供三種SSD高速硬碟的主機專案，依照客戶對網站的需求調整高流量或高頻寬專案，提供用戶選擇最適合的需求與規格。</p>
		</div>
		<div class="box">
			<div class="type_price_box">
				<img src="app/img/server/content3/mobile/pic1.png">
				<p>NT$<span>8,000</span>/年</p>
			</div>
			<div class="item_box">
				<div class="item one">
					<p>容量</p>
					<p>10G</p> 
				</div>
				<div class="item">
					<p>流量</p>
					<p>40G/400G</p> 
				</div>
				<div class="item">
					<p>頻寬</p>
					<p>2M/1T</p> 
				</div>
				<div class="item">
					<p>XXXX</p>
					<p>XXX</p> 	
				</div>
				<div class="item">
					<p>XXXX</p>
					<p>XXX</p> 	
				</div>
			</div>
		</div>
		<div class="box">
			<div class="type_price_box">
				<img src="app/img/server/content3/mobile/pic2.png">
				<p>NT$<span>18,000</span>/年</p>
			</div>
			<div class="item_box">
				<div class="item one">
					<p>容量</p>
					<p>10G</p> 
				</div>
				<div class="item">
					<p>流量</p>
					<p>40G/400G</p> 
				</div>
				<div class="item">
					<p>頻寬</p>
					<p>2M/1T</p> 
				</div>
				<div class="item">
					<p>XXXX</p>
					<p>XXX</p> 	
				</div>
				<div class="item">
					<p>XXXX</p>
					<p>XXX</p> 	
				</div>
			</div>
		</div>
		<div class="box">
			<div class="type_price_box">
				<img src="app/img/server/content3/mobile/pic3.png">
				<p>NT$<span>38,000</span>/年</p>
			</div>
			<div class="item_box">
				<div class="item one">
					<p>容量</p>
					<p>10G</p> 
				</div>
				<div class="item">
					<p>流量</p>
					<p>40G/400G</p> 
				</div>
				<div class="item">
					<p>頻寬</p>
					<p>2M/1T</p> 
				</div>
				<div class="item">
					<p>XXXX</p>
					<p>XXX</p> 	
				</div>
				<div class="item">
					<p>XXXX</p>
					<p>XXX</p> 	
				</div>
			</div>
		</div>
	</div>
</div>
<div class="content4">
	<div class="area">
		<div class="title">
			<img src="app/img/server/content4/text.png">
		</div>
		<img src="app/img/server/content4/pic1.png" class="pic1">
	</div>
</div>
<div class="content5">
	<div class="area">
		<div class="black_bg">
			<img src="app/img/server/content5/bg2.png" class="bg2">
			<img src="app/img/server/content5/text1.png" class="text1">
			<img src="app/img/server/content5/text2.png" class="text2">
			<img src="app/img/server/content5/text3.png" class="text3">
		</div>
		<div class="phone_black_bg">
			<img src="app/img/server/content5/mobile/bg.png" class="bg2">
			<div class="text_box">	
				<h1>Google SSD<br>
					極速雲端主機</h1>
				<h2>提供無上限的頻寬，無論網站瀏覽速度及穩定性、安全性皆是最高等級的選擇。</h2>
				<p>Google極速雲端為獨立的雲端虛擬化主機，由Google頂級機房中建置數萬台伺服器串接，並將數萬台伺服器做虛擬化而成，此種先進的伺服器技術，可保障使用者所租用的主機，在發生故障時，即時由其它主機備援，保障伺服器隨時維持上線狀態。</p>
				<p>Google極速雲端最大的特點在於一台虛擬化主機只放置一個網站，而非傳統一台主機分享給上百個網站共用，而且提供無上限的頻寬，無論網站瀏覽速度及穩定性、安全性皆是最高等級的選擇。</p>
			</div>
		</div>
	</div>
</div>
<div class="content6">
	<div class="area">
		<div class="left_box">
			<img src="app/img/server/content6/text1.png" class="pc_title">
			<img src="app/img/server/content3/pad_title.png" class="pad_title">
		</div>
		<div class="right_box">
			<div class="box short">
				<div class="item_box">
					<div class="price">
						<p>費用</p>
					</div>
					<div class="item"><p>硬碟容量</p></div>
					<div class="item"><p>流量</p></div>
					<div class="item"><p>頻寬</p></div>
					<div class="item"><p>XXXX</p></div>
					<div class="item"><p>XXXX</p></div>
				</div>
			</div>
			<div class="box">
				<img src="app/img/server/content6/pic1.png" class="type">
				<div class="item_box">
					<div class="price">
						<p>NT$<span>8,000</span>/年</p>
					</div>
					<div class="item"><p>200G SSD </p></div>
					<div class="item"><p>2T</p></div>
					<div class="item"><p>頻寬</p></div>
					<div class="item"><p>XXX</p></div>
					<div class="item"><p>XXX</p></div>
				</div>
			</div>
			<div class="box">
				<img src="app/img/server/content6/pic1.png" class="type">
				<div class="item_box">
					<div class="price">
						<p>NT$<span>15,800</span>/年</p>
					</div>
					<div class="item"><p>400G SSD </p></div>
					<div class="item"><p>4T</p></div>
					<div class="item"><p>無限頻寬</p></div>
					<div class="item"><p>XXX</p></div>
					<div class="item"><p>XXX</p></div>
				</div>
			</div>
			<div class="box">
				<img src="app/img/server/content6/pic1.png" class="type">
				<div class="item_box">
					<div class="price">
						<p>NT$<span>31,800</span>/年</p>
					</div>
					<div class="item"><p>800G SSD</p></div>
					<div class="item"><p>8T</p></div>
					<div class="item"><p>無限頻寬</p></div>
					<div class="item"><p>XXX</p></div>
					<div class="item"><p>XXX</p></div>
				</div>
			</div>
		</div>
	</div>
	<div class="phone_area">
		<div class="title_box">
			<img src="app/img/server/content6/mobile/text.png" class="phone_title">
			<h2>為企業提供頻寬無上限的雲端伺服器，不論有多少使用者，皆可享有極速的瀏覽速度。</h2>
			<p>我們特別為小型用戶提供三種SSD高速硬碟的主機專案，依照客戶對網站的需</p>
		</div>
		<div class="box">
			<div class="type_price_box">
				<img src="app/img/server/content6/mobile/pic1.png">
				<p>NT$<span>8,000</span>/年</p>
			</div>
			<div class="item_box">
				<div class="item one">
					<p>容量</p>
					<p>200G</p> 
				</div>
				<div class="item">
					<p>流量</p>
					<p>2T</p> 
				</div>
				<div class="item">
					<p>頻寬</p>
					<p>無限頻寬</p> 
				</div>
				<div class="item">
					<p>XXXX</p>
					<p>XXX</p> 	
				</div>
				<div class="item">
					<p>XXXX</p>
					<p>XXX</p> 	
				</div>
			</div>
		</div>
		<div class="box">
			<div class="type_price_box">
				<img src="app/img/server/content6/mobile/pic2.png">
				<p>NT$<span>15,800</span>/年</p>
			</div>
			<div class="item_box">
				<div class="item one">
					<p>容量</p>
					<p>400G </p> 
				</div>
				<div class="item">
					<p>流量</p>
					<p>4T</p> 
				</div>
				<div class="item">
					<p>頻寬</p>
					<p>無限頻寬</p> 
				</div>
				<div class="item">
					<p>XXXX</p>
					<p>XXX</p> 	
				</div>
				<div class="item">
					<p>XXXX</p>
					<p>XXX</p> 	
				</div>
			</div>
		</div>
		<div class="box">
			<div class="type_price_box">
				<img src="app/img/server/content6/mobile/pic3.png">
				<p>NT$<span>31,800</span>/年</p>
			</div>
			<div class="item_box">
				<div class="item one">
					<p>容量</p>
					<p>800G</p> 
				</div>
				<div class="item">
					<p>流量</p>
					<p>8T</p> 
				</div>
				<div class="item">
					<p>頻寬</p>
					<p>無限頻寬</p> 
				</div>
				<div class="item">
					<p>XXXX</p>
					<p>XXX</p> 	
				</div>
				<div class="item">
					<p>XXXX</p>
					<p>XXX</p> 	
				</div>
			</div>
		</div>
	</div>
</div>
<div class="content7">
	<div class="area">
		<img src="app/img/server/content7/title.png" class="title">
		<div class="item_area">
			<div class="box">
				<div class="pic">
					<img src="app/img/server/content7/pic1.png" >
				</div>
				<h2>高成本Google主機</h2>
				<p>選用Google高品質主機，無論安全還是穩定性均是世界第一品質保證。</p>
			</div>
			<div class="box">
				<div class="pic">
					<img src="app/img/server/content7/pic2.png" >
				</div>
				<h2>超大容量空間</h2>
				<p>提供遠比同業同價格伺服器更大的容量空間，讓使用者放置檔案輕鬆無負擔</p>
			</div>
			<div class="box">
				<div class="pic">
					<img src="app/img/server/content7/pic3.png" >
				</div>
				<h2>超大流量上限</h2>
				<p>提供遠比同業同價格伺服器更大的流量上限，經營網站再也不必受到流量束縛。 </p>
			</div>
			<div class="box">
				<div class="pic">
					<img src="app/img/server/content7/pic4.png" >
				</div>
				<h2>99.8%在線率保證</h2>
				<p>高上線率保證，即時偵測伺服器運作狀態，讓伺服器運作再也不需人工監督。  </p>
			</div>
			<div class="box">
				<div class="pic">
					<img src="app/img/server/content7/pic5.png" >
				</div>
				<h2>24小時不斷電機房</h2>
				<p>伺服器位於Google重金打造之機房，享有24小時、365天不斷電系統的服務。</p>
			</div>
			<div class="box">
				<div class="pic">
					<img src="app/img/server/content7/pic6.png" >
				</div>
				<h2>即時備援服務</h2>
				<p>數萬台伺服器共同組成的雲端即時備援，任何主機發生問題，立刻有其它主機支援。</p>
			</div>
		</div>	
	</div>
</div>
<div class="content8">
	<div class="area">
		<div class="title_box">
			<div class="text_box">
				<h1>多元加值服務</h1>
				<p>我們特別選用全世界前三名的，Google Cloud Platform伺服器主機，保證98.8%的不斷線率。</p>	
			</div>
		</div>
		<div class="slide_pic_box" >
			<div class="slide_pic" >
				<div class="square1">
					<div class="slide_bg_href one">
						<img src="app/img/server/content8/bg1.png">
					</div>
					<div class="slide_bg_href two">
						<img src="app/img/server/content8/bg3.png">
					</div>
					<div class="slide_bg_href three">
						<img src="app/img/server/content8/bg2.png">
					</div>
				</div>
				<div class="square2">
					<div class="slide_pic_href">
						<div class="item">
							<img src="app/img/server/content8/pic1.png">
							<h1>提供付費網頁設計服務</h1>
							<p>數萬台伺服器共同組成的雲端即時備援，任何主機發生問題，立刻有其它主機支援。任何主機發生問題，立刻有其。</p>
						</div>
					</div>
					<div class="slide_pic_href">
						<div class="item">
							<img src="app/img/server/content8/pic3.png">
							<h1>提供免費網站模板</h1>
							<p>數萬台伺服器共同組成的雲端即時備援，任何主機發生問題，立刻有其它主機支援。任何主機發生問題，立刻有其。</p>
						</div>
					</div>
					<div class="slide_pic_href">
						<div class="item">
							<img src="app/img/server/content8/pic2.png">
							<h1>協助客戶搬遷主機</h1>
							<p>數萬台伺服器共同組成的雲端即時備援，任何主機發生問題，立刻有其它主機支援。任何主機發生問題，立刻有其。</p>
						</div>
					</div>
				</div>
					<img src="app/img/server/content8/arrow.png" class="next">
					<img src="app/img/server/content8/arrow.png" class="prev">	
			</div>
			<!--<div class="cycle-pager"></div>-->
		</div>
		<div class="black_bg"></div>
		<div class="line_box">
			
		</div>
	</div>
</div>
<div class="content9">
	<div class="content_area">
		<h1>聯繫我們</h1>
		<div class="title_box">
			<div class="line1"></div>
			<p>本公司設計案件較多，為盡早處理您的專案，請提前詢問或索取估價資訊。</p>
			<div class="line2"></div>
		</div>
		<div class="textContactForm">
			<div class="textContactFormContent">
				<?php echo form_open("Contact/contact_post/")?>
				<div class="leftBox">
					<div class="area">
						<p>您的姓名</p><input type="text" class="name" name="username_Str" placeholder="請填寫您的姓名" required>
					</div>
					<div class="area">
						<p>公司名稱</p><input type="text" class="company" name="company_Str" placeholder="請填寫公司名稱" required>
					</div>	
					<div class="area">
						<p>聯繫電話</p><input type="text" class="telphone" name="phone_Str" placeholder="請填寫聯繫電話" required>
					</div>
					<div class="area">	
						<p>電子郵件</p><input type="text" class="email" name="email_Str" placeholder="請填寫電子郵件" required>
					</div>
					<div class="area">		
						<p>公司地址</p><input type="text" class="address" name="address_Str" placeholder="請填寫公司地址" required>
					</div>
					<div class="area">
						<p>詢問項目</p>
						<select class="need" name="classtype_Str" required>
							<option value="">請選擇詢問項目</option>
							<option value="網站開發">網站開發</option>
							<option value="程式系統開發">程式系統開發</option>
							<option value="美術設計">美術設計</option>
							<option value="網路行銷">網路行銷</option>
							<option value="伺服器租賃">伺服器租賃</option>
							<option value="其它問題">其它問題</option>
						</select>
					</div>
					<div class="area">
						<p>項目細節</p>
						<select class="need_child">
							<option value="先選擇主要項目">先選擇主要項目</option>
						</select>
						<select class="need_child" data-selected="網站開發" style="display:none;">
							<option value="形象網站設計">形象網站設計</option>
							<option value="0元套版網站">0元套版網站</option>
							<option value="購物網站開發">購物網站開發</option>
							<option value="網路平台開發">網路平台開發</option>
						</select>
						<select class="need_child" data-selected="程式系統開發" style="display:none;">
							<option value="程式系統開發">程式系統開發</option>
							<option value="手機App開發">手機App開發</option>
						</select>
						<select class="need_child" data-selected="美術設計" style="display:none;">
							<option value="LOGO/CIS 設計">LOGO/CIS 設計</option>
							<option value="平面設計">平面設計</option>
							<option value="產品包裝設計">產品包裝設計</option>
						</select>
						<select class="need_child" data-selected="網路行銷" style="display:none;">
							<option value="facebook 粉絲團">facebook 粉絲團</option>
							<option value="Google Adwords">Google Adwords</option>
							<option value="網路行銷企劃">網路行銷企劃</option>
						</select>
						<select class="need_child" data-selected="伺服器租賃" style="display:none;">
							<option value="虛擬伺服器租賃">虛擬伺服器租賃</option>
							<option value="雲端主機租賃">雲端主機租賃</option>
							<option value="電子信箱主機租賃">電子信箱主機租賃</option>
							<option value="Google Apps設定">Google Apps設定</option>
						</select>
						<select class="need_child" data-selected="其它問題" style="display:none;">
							<option value="其它問題">其它問題</option>
						</select>
					</div>
					<div class="area phone">
						<span>您的預算：</span>
						<select class="money">
							<option value="">請選擇預算</option>
							<option value="15萬元以下">15萬元以下</option>
							<option value="15萬元~30萬元">15萬元~30萬元</option>
							<option value="30萬元~50萬元">30萬元~50萬元</option>
							<option value="50萬元~100萬元">50萬元~100萬元</option>
							<option value="100萬元~200萬元">100萬元~200萬元</option>
							<option value="200萬元以上">200萬元以上</option>
						</select>
						<div class="textContactFormMoneyFixed">
							預算欄位僅供參考，每個客製化專案皆可依客戶需求給予報價
						</div>
					</div>
				</div>
				<div class="rightBox">
					<textarea name="content_Str" placeholder="我還想補充..."></textarea>
				</div>
				<div class="price_choose">
					<p>預算選擇</p>
					<div class="choose_area">
						<div class="choose_box" data-bgname="text1">
							<h3>15萬以下</h3>
							<div class="circle"><input type="hidden" value="15萬以下"></div>
							<h4 data-bgname="text1">普通或可能導致負面形象</h4>
						</div>
						<div class="line"></div>
						<div class="choose_box" data-bgname="text2">
							<h3>15~25萬</h3>
							<div class="circle"><input type="hidden" value="15~25萬"></div>
							<h4 data-bgname="text2">感到耳目一新</h4>
						</div>
						<div class="line"></div>
						<div class="choose_box" data-bgname="text3">
							<h3>25~50萬</h3>
							<div class="circle"><input type="hidden" value="25~50萬"></div>
							<h4 data-bgname="text3">印象非常深刻的網站</h4>
						</div>
						<div class="line"></div>
						<div class="choose_box" data-bgname="text4">
							<h3>50~100萬</h3>
							<div class="circle"><input type="hidden" value="50~100萬"></div>
							<h4 data-bgname="text4">最極致的設計</h4>
						</div>
					</div>
				</div>
					<input type="submit" value="送出" class="contactSubmit" name="contactSubmit">
					<input type="hidden" name="previous_url_Str" value="<?=$previous_url_Str?>">
				</form>
			</div>
			<!-- Google Code for &#33287;&#25105;&#20497;&#32879;&#32097; Conversion Page -->
			<script type="text/javascript">
			/* <![CDATA[ */
			var google_conversion_id = 1037100439;
			var google_conversion_language = "en";
			var google_conversion_format = "3";
			var google_conversion_color = "ffffff";
			var google_conversion_label = "54GrCKiolVYQl8vD7gM";
			var google_remarketing_only = false;
			/* ]]> */
			</script>
			<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js"></script>
			<noscript style="display:none;"><img style="display:none;" height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1037100439/?label=54GrCKiolVYQl8vD7gM&amp;guid=ON&amp;script=0"/></noscript>
		</div>
	</div>
</div>

<?=$temp['footer_bar']?>
<?=$temp['body_end']?>