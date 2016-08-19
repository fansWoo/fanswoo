<?=$temp['header_up']?>
<script>
$(function(){
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
		// else if(scroll_top >= 2000 && scroll_top < 2900){
		// 	$('.content4').addClass('hover');
		// }
		else if(scroll_top >= 2000 && scroll_top < 2700){
			$('.content5').addClass('hover');
		}
		else if(scroll_top >= 2700 && scroll_top < 3450){
			$('.content6').addClass('hover');
		}
		else if(scroll_top >=3450 && scroll_top <4100){
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
	$(document).on('click', "a[href^='#']", function(){
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
});
</script>
<?=$temp['header_down']?>
<?=$temp['header_bar']?>
<div class="content1">
	<div class="bg1">
		<img src="img/server/content1/bg3.png">
	</div>
	<div class="bg2">
		<img src="img/server/content1/bg4.png">
	</div>
	<div class="mobile_bg">
		<img src="img/server/mobile/bg1.png">
	</div>
	<div class="area">
		<div class="pic1">
			<img src="img/server/content1/pic1.png">
		</div>
		<div class="text">
			<h2>提供世界一流的Google雲端伺服器</h2>
			<h2>為企業網站、購物網站和網路平台</h2>	
			<h2>找到完美解決方案！</h2>	
		</div>
		<a href="#content2" class="arrow">
			<img src="img/index/arrow_down.png">	
		</a>
	</div>
</div>
<div class="content2" id="content2">
	<div class="area">
		<div class="text_arae">
			<div class="title_pic">
				<img src="img/server/content2/text.png">
			</div>
			<img src="img/server/content2/mobile/text1.png" class="phone_text1">
			<img src="img/server/content2/mobile/text2.png" class="phone_text2">
			<img src="img/server/content2/mobile/map.png" class="phone_map">
			<div class="text">
				<p>伺服器最令人擔憂的就是伺服器當機問題，為此我們特別選用全世界前三名的Google Cloud Platform伺服器主機，保證98.8%的不斷線率，伺服器由數萬台雲端伺服器虛擬化而成，任何伺服器發生當機，立刻有其它伺服器即時備援，讓用戶無需擔憂。</p>
				<p>核心架構採Linux作業系統+Apache伺服器+MySQL資料庫+PHP程式語言，具有70%以上的高市佔率不管企業用戶、個人用戶都能感受到穩定的速度與效能。</p>
			</div>
		</div>
		<div class="server">
			<img src="img/index/fixed_table/pic5.png">
		</div>
	</div>
</div>
<div class="content3">
	<div class="area">
		<div class="left_box">
			<img src="img/server/content3/text.png" class="pc_title">
			<img src="img/server/content3/pad_title.png" class="pad_title">
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
				</div>
			</div>
			<div class="box">
				<img src="img/server/content3/pic1.png" class="type">
				<div class="item_box">
					<div class="price">
						<p>NT$<span>8,000</span>/年</p>
					</div>
					<div class="item"><p>10G SSD </p></div>
					<div class="item"><p>40G / 400G</p></div>
					<div class="item"><p>2M / 1T</p></div>
				</div>
			</div>
			<div class="box">
				<img src="img/server/content3/pic2.png" class="type">
				<div class="item_box">
					<div class="price">
						<p>NT$<span>18,000 </span>/年</p>
					</div>
					<div class="item"><p>20G SSD </p></div>
					<div class="item"><p>80G / 800G</p></div>
					<div class="item"><p>5M / 1T</p></div>
				</div>
			</div>
			<div class="box">
				<img src="img/server/content3/pic3.png" class="type">
				<div class="item_box">
					<div class="price">
						<p>NT$<span>38,000 </span>/年</p>
					</div>
					<div class="item"><p>40G SSD</p></div>
					<div class="item"><p>120G / 1200G</p></div>
					<div class="item"><p>10M / 1T</p></div>
				</div>
			</div>
		</div>
	</div>
	<div class="phone_area">
		<div class="title_box">
			<img src="img/server/content3/mobile/text.png" class="phone_title">
			<h2>提供三種主機專案，滿足小型用戶的需求</h2>
			<p>我們特別為小型用戶提供三種SSD高速硬碟的主機專案，依照客戶對網站的需求調整高流量或高頻寬專案，提供用戶選擇最適合的需求與規格。</p>
		</div>
		<div class="box">
			<div class="type_price_box">
				<img src="img/server/content3/mobile/pic1.png">
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
			</div>
		</div>
		<div class="box">
			<div class="type_price_box">
				<img src="img/server/content3/mobile/pic2.png">
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
			</div>
		</div>
		<div class="box">
			<div class="type_price_box">
				<img src="img/server/content3/mobile/pic3.png">
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
			</div>
		</div>
	</div>
</div>
<div class="content4" style="display:none;">
	<div class="area">
		<div class="title">
			<img src="img/server/content4/text.png">
		</div>
		<img src="img/server/content4/pic1.png" class="pic1">
	</div>
</div>
<div class="content5">
	<div class="area">
		<div class="black_bg">
			<img src="img/server/content5/bg2.png" class="bg2">
			<img src="img/server/content5/text1.png" class="text1">
			<img src="img/server/content5/text2.png" class="text2">
			<img src="img/server/content5/text3.png" class="text3">
		</div>
		<div class="phone_black_bg">
			<img src="img/server/content5/mobile/bg.png" class="bg2">
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
			<img src="img/server/content6/text1.png" class="pc_title">
			<img src="img/server/content3/pad_title.png" class="pad_title">
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
				</div>
			</div>
			<div class="box">
				<img src="img/server/content6/pic1.png" class="type">
				<div class="item_box">
					<div class="price">
						<p>NT$<span>8,000</span>/年</p>
					</div>
					<div class="item"><p>200G SSD </p></div>
					<div class="item"><p>2T</p></div>
					<div class="item"><p>頻寬</p></div>
				</div>
			</div>
			<div class="box">
				<img src="img/server/content6/pic2.png" class="type">
				<div class="item_box">
					<div class="price">
						<p>NT$<span>15,800</span>/年</p>
					</div>
					<div class="item"><p>400G SSD </p></div>
					<div class="item"><p>4T</p></div>
					<div class="item"><p>無限頻寬</p></div>
				</div>
			</div>
			<div class="box">
				<img src="img/server/content6/pic3.png" class="type">
				<div class="item_box">
					<div class="price">
						<p>NT$<span>31,800</span>/年</p>
					</div>
					<div class="item"><p>800G SSD</p></div>
					<div class="item"><p>8T</p></div>
					<div class="item"><p>無限頻寬</p></div>
				</div>
			</div>
		</div>
	</div>
	<div class="phone_area">
		<div class="title_box">
			<img src="img/server/content6/mobile/text.png" class="phone_title">
			<h2>為企業提供頻寬無上限的雲端伺服器，不論有多少使用者，皆可享有極速的瀏覽速度。</h2>
			<p>我們特別為小型用戶提供三種SSD高速硬碟的主機專案，依照客戶對網站的需</p>
		</div>
		<div class="box">
			<div class="type_price_box">
				<img src="img/server/content6/mobile/pic1.png">
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
			</div>
		</div>
		<div class="box">
			<div class="type_price_box">
				<img src="img/server/content6/mobile/pic2.png">
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
			</div>
		</div>
		<div class="box">
			<div class="type_price_box">
				<img src="img/server/content6/mobile/pic3.png">
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
			</div>
		</div>
	</div>
</div>
<div class="content7">
	<div class="area">
		<img src="img/server/content7/title.png" class="title">
		<div class="item_area">
			<div class="box">
				<div class="pic">
					<img src="img/server/content7/pic1.png" >
				</div>
				<h2>高成本Google主機</h2>
				<p>選用Google高品質主機，無論安全還是穩定性均是世界第一品質保證。</p>
			</div>
			<div class="box">
				<div class="pic">
					<img src="img/server/content7/pic2.png" >
				</div>
				<h2>超大容量空間</h2>
				<p>提供遠比同業同價格伺服器更大的容量空間，讓使用者放置檔案輕鬆無負擔</p>
			</div>
			<div class="box">
				<div class="pic">
					<img src="img/server/content7/pic3.png" >
				</div>
				<h2>超大流量上限</h2>
				<p>提供遠比同業同價格伺服器更大的流量上限，經營網站再也不必受到流量束縛。 </p>
			</div>
			<div class="box">
				<div class="pic">
					<img src="img/server/content7/pic4.png" >
				</div>
				<h2>99.8%在線率保證</h2>
				<p>高上線率保證，即時偵測伺服器運作狀態，讓伺服器運作再也不需人工監督。  </p>
			</div>
			<div class="box">
				<div class="pic">
					<img src="img/server/content7/pic5.png" >
				</div>
				<h2>24小時不斷電機房</h2>
				<p>伺服器位於Google重金打造之機房，享有24小時、365天不斷電系統的服務。</p>
			</div>
			<div class="box">
				<div class="pic">
					<img src="img/server/content7/pic6.png" >
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
						<img src="img/server/content8/bg1.png">
					</div>
					<div class="slide_bg_href two">
						<img src="img/server/content8/bg3.png">
					</div>
					<div class="slide_bg_href three">
						<img src="img/server/content8/bg2.png">
					</div>
				</div>
				<div class="square2">
					<div class="slide_pic_href">
						<div class="item">
							<img src="img/server/content8/pic1.png">
							<h1>提供付費網頁設計服務</h1>
							<p>數萬台伺服器共同組成的雲端即時備援，任何主機發生問題，立刻有其它主機支援。任何主機發生問題，立刻有其。</p>
						</div>
					</div>
					<div class="slide_pic_href">
						<div class="item">
							<img src="img/server/content8/pic3.png">
							<h1>提供免費網站模板</h1>
							<p>數萬台伺服器共同組成的雲端即時備援，任何主機發生問題，立刻有其它主機支援。任何主機發生問題，立刻有其。</p>
						</div>
					</div>
					<div class="slide_pic_href">
						<div class="item">
							<img src="img/server/content8/pic2.png">
							<h1>協助客戶搬遷主機</h1>
							<p>數萬台伺服器共同組成的雲端即時備援，任何主機發生問題，立刻有其它主機支援。任何主機發生問題，立刻有其。</p>
						</div>
					</div>
				</div>
					<img src="img/server/content8/arrow.png" class="next">
					<img src="img/server/content8/arrow.png" class="prev">	
			</div>
			<!--<div class="cycle-pager"></div>-->
		</div>
		<div class="black_bg"></div>
		<div class="line_box">
			
		</div>
	</div>
</div>
<div class="content9">
<?=$temp['contact_content_area']?>
</div>

<?=$temp['footer_bar']?>
<?=$temp['body_end']?>