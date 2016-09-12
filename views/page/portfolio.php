<?=$temp['header_up']?>
<script>
$(function(){
	$(window).scroll(function(){
		if($("body").hasClass("portfolio") && $('.portfolioPageBg').hasClass('hover') == false){
			var window_height_half = $(window).height() / 2;
			$("body.portfolio .topHeader .navBar .nav").removeClass('hover');
			if($(window).scrollTop() < 1200 - window_height_half){
				$("body.portfolio .topHeader .navBar .nav[data-nav='website']").addClass('hover');
			}
			else if($(window).scrollTop() < 2400 - window_height_half){
				$("body.portfolio .topHeader .navBar .nav[data-nav='cis']").addClass('hover');
			}
			else if($(window).scrollTop() < 3600 - window_height_half){
				$("body.portfolio .topHeader .navBar .nav[data-nav='graphic']").addClass('hover');
			}
			else if($(window).scrollTop() < 4800 - window_height_half){
				$("body.portfolio .topHeader .navBar .nav[data-nav='marketing']").addClass('hover');
			}
		}
	});
	
	
	//作品頁變更 portfolie
	$(document).on('click', '.bodyPagePortfolio .portfolioDiv', function(){
		var window_width = $(window).width();
		 if(window_width <= 700){
			
			 
		 }
		else if(window_width >=700){	
			 $('.bodyPagePortfolio').css('display', 'block');
			 $('.portfolioDiv').css('display', 'block');
		$this = $(this);
		var chref = $this.data('chref');
		var csrc = $this.data('csrc');
		$('.fixedPortfolioContent .content .pic').attr('href', chref);
		$('.fixedPortfolioContent .content .ahref').attr('href', chref);
		$('.fixedPortfolioContent .content .pic img').attr('src', csrc);
		if($this.parents('.portfolioPageBg').hasClass('portfolioPageWebsiteBg') == true){
			$("html,body").animate({scrollTop: 0}, 500, 'swing');
			$('.fixedPortfolioContent').css({'color':'#222', 'background-image':'url(img/bg14.jpg)'});
		}
		else if($this.parents('.portfolioPageBg').hasClass('portfolioPageCISBg') == true){
			$("html,body").animate({scrollTop: 1200}, 500, 'swing');
			$('.fixedPortfolioContent').css({'color':'#222', 'background-image':'url(img/bg14.jpg)'});
		}
		else if($this.parents('.portfolioPageBg').hasClass('portfolioPageGraphicDesignBg') == true){
			$("html,body").animate({scrollTop: 2400}, 500, 'swing');
			$('.fixedPortfolioContent').css({'color':'#222', 'background-image':'url(img/bg14.jpg)'});
		}
		else if($this.parents('.portfolioPageBg').hasClass('portfolioPageMarketingBg') == true){
			$("html,body").animate({scrollTop: 3600}, 500, 'swing');
			$('.fixedPortfolioContent').css({'color':'#222', 'background-image':'url(img/bg14.jpg)'});
		}
		setTimeout(function(){
			$('.portfolioPageBg').addClass('hover');
			$('.fixedNoClick').addClass('displayblock');
			$('.fixedPortfolioContent').addClass('opacity1');
			setTimeout(function(){
				$('.fixedNoClickLeft, .fixedNoClickRight').addClass('opacity1');
				$('.fixedNoClick').removeClass('displayblock');
				
				bodyScrollTop = $(window).scrollTop();
				var windowHeight = $(window).height();
				var windowWidth = $(window).width();
				$(".body").css({"overflow-y":"hidden", "position":"fixed", "width":windowWidth, "height":windowHeight});
				$(".body").scrollTop(bodyScrollTop);
			},2000);
		}, 500);
		
		}
		
	});
	$(document).on('click', '.fixedNoClickLeft, .fixedNoClickRight', function(){
		if($('.portfolioPageBg').hasClass('hover') == true){
			$('.portfolioPageBg').removeClass('hover');
			$('.fixedPortfolioContent').removeClass('opacity1');
			$('.portfolioPageBg').addClass('nohover');
			$('.fixedNoClickLeft, .fixedNoClickRight').removeClass('opacity1');
			
			$(".body").css({"overflow-y":"visible","position":"static","height":"auto"});
			$(window).scrollTop(bodyScrollTop);
			
			setTimeout(function(){
				$('.portfolioPageBg').removeClass('nohover');
			},2000);
		}
	});
	$(document).scroll(function(){
		var window_width = $(window).width();
		if(window_width <= 700){
			$('div[id="no_rwd"]').css('display','none');
		}
	});
});
</script>
<?=$temp['header_down']?>
<?=$temp['header_bar']?>
		<div class="fixedNoClickLeft"></div>
		<div class="fixedNoClickRight"></div>
		<div class="fixedNoClick"></div>
		<div class="fixedPortfolioContent">
			<div class="content">
				<a href="" class="pic" target="_blank">
					<img src="">
				</a>
				<a href="" class="ahref" target="_blank">設計成品：http://fanswoo.com</a>
			</div>
		</div>
		<div class="bodyPagePortfolio">
			<div class="portfolioPageBg portfolioPageWebsiteBg">
				<div class="portfolioPage portfolioPageWebsite">
					<div class="portfolioLeft">
						<h2 class="portfolioTitle">Website Design<br> <span class="zhtw">RWD形象網站</span></h2>
						<div class="portfolioDiv" data-chref="http://web.fanswoo.com/yensgroup.com/" data-csrc="img/portfolio/Yens.jpg">
							<div class="pic showOriginal">
								<a href="http://web.fanswoo.com/yensgroup.com/"><img src="img/portfolio/1-yens.png"></a>
							</div>
							<div class="pic showBlur">
								<img src="img/portfolio/1-yens.png">
							</div>
							<div class="bg"></div>
							<div class="text">
								Yens 元家水產食品集
							</div>
							<div class="logo">
								<img src="img/portfolio/yens_logo.png">
							</div>
						</div>
						<div class="portfolioDiv" data-chref="http://web.fanswoo.com/hcmedi.de/" data-csrc="img/portfolio/HCMedi.jpg">
							<div class="pic showOriginal">
								<a href="http://web.fanswoo.com/hcmedi.de/"><img src="img/portfolio/3-hcmedi.png"></a>
							</div>
							<div class="pic showBlur">
								<img src="img/portfolio/3-hcmedi.png">
							</div>
							<div class="bg"></div>
							<div class="text">
								HCMedi 心誠美行動醫療
							</div>
							<div class="logo">
								<img src="img/portfolio/hcmedi_logo.png">
							</div>
						</div>
						<div class="portfolioDiv" data-chref="http://web.fanswoo.com/bazu-beer.com" data-csrc="img/portfolio/web_7.jpg">
							<div class="pic showOriginal">
								<a href="http://web.fanswoo.com/bazu-beer.com"><img src="img/portfolio/5-beer.jpg"></a>
							</div>
							<div class="pic showBlur">
								<img src="img/portfolio/5-beer.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								Basilai 原住民手工鮮釀啤酒
							</div>
							<div class="logo">
								<img src="img/portfolio/beer_logo.png">
							</div>
						</div>
						<div class="portfolioDiv" data-chref="http://web.fanswoo.com/ruok.com.tw/" data-csrc="img/portfolio/tomato.jpg">
							<div class="pic showOriginal">
								<a href="http://web.fanswoo.com/ruok.com.tw/"><img src="img/portfolio/7-tomato.png"></a>
							</div>
							<div class="pic showBlur">
								<img src="img/portfolio/7-tomato.png">
							</div>
							<div class="bg"></div>
							<div class="text">
								Tomato 番茄娛樂
							</div>
							<div class="logo">
								<img src="img/portfolio/tomato_logo.png">
							</div>
						</div>
					</div>
					<div class="portfolioContent">
					</div>
					<div class="portfolioRight">
						<div class="portfolioDiv" data-chref="http://web.fanswoo.com/mrpv.org.tw" data-csrc="img/portfolio/sun_roof_web.jpg">
							<div class="pic showOriginal">
								<a href="http://web.fanswoo.com/mrpv.org.tw"><img src="img/portfolio/2-million-roof.png"></a>
							</div>
							<div class="pic showBlur">
								<img src="img/portfolio/sun_roof.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								 工研院 陽光屋頂百萬座
							</div>
							<div class="logo">
								<img src="img/portfolio/sun_roof_logo.png">
							</div>
						</div>
						<div class="portfolioDiv" data-chref="http://web.fanswoo.com/alchema.com/" data-csrc="img/portfolio/Alchema.jpg">
							<div class="pic showOriginal">
								<a href="http://web.fanswoo.com/alchema.com/"><img src="img/portfolio/4-alchema.png"></a>
							</div>
							<div class="pic showBlur">
								<img src="img/portfolio/4-alchema.png">
							</div>
							<div class="bg"></div>
							<div class="text">
								 Alchema 專業釀酒機
							</div>
							<div class="logo">
								<img src="img/portfolio/alchema_logo.png">
							</div>
						</div>
						<div class="portfolioDiv" data-chref="http://web.fanswoo.com/candace.asia" data-csrc="img/portfolio/web_1.jpg" id="no_rwd">
							<div class="pic showOriginal">
								<a href="http://web.fanswoo.com/candace.asia"><img src="img/portfolio/6-designSampleCandace.jpg"></a>
							</div>
							<div class="pic showBlur">
								<img src="img/portfolio/6-designSampleCandace.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								Candace 洪秀女名品服飾設計
							</div>
							<div class="logo">
								<img src="img/portfolio/designSampleLogoCandace.png">
							</div>
						</div>
						<div class="portfolioDiv" data-chref="http://web.fanswoo.com/customer.ktb.com.tw" data-csrc="img/portfolio/kingtownbank.png">
							<div class="pic showOriginal">
								<a href="http://web.fanswoo.com/customer.ktb.com.tw"><img src="img/portfolio/8-kingtownbank1.png"></a>
							</div>
							<div class="pic showBlur">
								<img src="img/portfolio/8-kingtownbank1.png">
							</div>
							<div class="bg"></div>
							<div class="text">
								 KingTownBank 京城銀行
							</div>
							<div class="logo">
								<img src="img/portfolio/kingtownbank_logo.png">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="portfolioPageBg portfolioPageCISBg">
				<div class="portfolioPage portfolioPageCIS">
					<div class="portfolioLeft">
						<h2 class="portfolioTitle">Electronic Commerce <span class="zhtw">購物網站、ERP</span></h2>
						<div class="portfolioDiv" data-chref="http://web.fanswoo.com/dobbysoven.com/" data-csrc="img/portfolio/Dobby.jpg">
							<div class="pic showOriginal">
								<a href="http://web.fanswoo.com/dobbysoven.com/"><img src="img/portfolio/1-dobby.png"></a>
							</div>
							<div class="pic showBlur">
								<img src="img/portfolio/1-dobby.png">
							</div>
							<div class="bg"></div>
							<div class="text">
								Dobby 精緻糕點
							</div>
							<div class="logo">
								<img src="img/portfolio/dobby_logo.png">
							</div>
						</div>
						<div class="portfolioDiv" data-chref="http://web.fanswoo.com/ipixcc.com.tw/" data-csrc="img/portfolio/ipix.jpg" id="no_rwd">
							<div class="pic showOriginal">
								<a href="http://web.fanswoo.com/ipixcc.com.tw/"><img src="img/portfolio/3-ipix.jpg"></a>
							</div>
							<div class="pic showBlur">
								<img src="img/portfolio/3-ipix.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								IPIX鏡花園
							</div>
							<div class="logo">
								<img src="img/portfolio/ipix_logo.png">
							</div>
						</div>
						<div class="portfolioDiv" data-chref="http://web.fanswoo.com/huanyi331.com/" data-csrc="img/portfolio/Huanyi.jpg">
							<div class="pic showOriginal">
								<a href="http://web.fanswoo.com/huanyi331.com/"><img src="img/portfolio/5-whenyi.jpg"></a>
							</div>
							<div class="pic showBlur">
								<img src="img/portfolio/5-whenyi.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								WhenYi 寰藝美容藥妝
							</div>
							<div class="logo">
								<img src="img/portfolio/Huanyi_logo.png">
							</div>
						</div>
						<div class="portfolioDiv" data-chref="http://web.fanswoo.com/assari.com.tw/" data-csrc="img/portfolio/assari.png">
							<div class="pic showOriginal">
								<a href="http://web.fanswoo.com/assari.com.tw/"><img src="img/portfolio/assari_pic.jpg"></a>
							</div>
							<div class="pic showBlur">
								<img src="img/portfolio/assari_pic.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								Assari 鑫億家俱
							</div>
							<div class="logo">
								<img src="img/portfolio/assari_logo.png">
							</div>
						</div>
						<div class="portfolioDiv" data-chref="http://web.fanswoo.com/solnine/" data-csrc="img/portfolio/solnine.jpg" id="no_rwd">
							<div class="pic showOriginal">
								<img src="img/portfolio/7-solnine.png">
							</div>
							<div class="pic showBlur">
								<img src="img/portfolio/7-solnine.png">
							</div>
							<div class="bg"></div>
							<div class="text">
								Solnine 旭浩科技
							</div>
							<div class="logo">
								<img src="img/portfolio/solnine_logo.png">
							</div>
						</div>
					</div>
					<div class="portfolioContent"  >
					</div>
					<div class="portfolioRight">
						<div class="portfolioDiv" data-chref="http://web.fanswoo.com/paris-strawberry.cn/" data-csrc="img/portfolio/Paris.jpg" id="no_rwd">
							<div class="pic showOriginal">
								<a href="http://web.fanswoo.com/paris-strawberry.cn/"><img src="img/portfolio/2-paris-strawberry.png"></a>
							</div>
							<div class="pic showBlur">
								<img src="img/portfolio/2-paris-strawberry.png">
							</div>
							<div class="bg"></div>
							<div class="text">
								Paris Strawberry 巴黎草莓國際彩妝
							</div>
							<div class="logo">
								<img src="img/portfolio/paris_logo.png">
							</div>
						</div>
						<div class="portfolioDiv" data-chref="http://web.fanswoo.com/nxstgirl/" data-csrc="img/portfolio/nxstgirl.jpg">
							<div class="pic showOriginal">
								<a href="http://web.fanswoo.com/nxstgirl/"><img src="img/portfolio/4-nxstgirl.png"></a>
							</div>
							<div class="pic showBlur">
								<img src="img/portfolio/4-nxstgirl.png">
							</div>
							<div class="bg"></div>
							<div class="text">
								NxstGirl
							</div>
							<div class="logo">
								<img src="img/portfolio/nxstgirl_logo.png">
							</div>
						</div>
						<div class="portfolioDiv" data-chref="http://web.fanswoo.com/www.taiwanbaseball.com.tw/" data-csrc="img/portfolio/tb_web.png">
							<div class="pic showOriginal">
								<a href="http://web.fanswoo.com/www.taiwanbaseball.com.tw/"><img src="img/portfolio/tb.png"></a>
							</div>
							<div class="pic showBlur">
								<img src="img/portfolio/tb.png">
							</div>
							<div class="bg"></div>
							<div class="text">
								Taiwan Baseball
							</div>
							<div class="logo">
								<img src="img/portfolio/tb_logo.png">
							</div>
						</div>
						<div class="portfolioDiv" data-chref="http://web.fanswoo.com/petkit/" data-csrc="img/portfolio/petkit.jpg">
							<div class="pic showOriginal">
								<a href="http://web.fanswoo.com/petkit/"><img src="img/portfolio/6-petkit.jpg"></a>
							</div>
							<div class="pic showBlur">
								<img src="img/portfolio/6-petkit.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								PetKit 寵物智能管家
							</div>
							<div class="logo">
								<img src="img/portfolio/petkit_logo.png">
							</div>
						</div>
						<div class="portfolioDiv" data-chref="http://web.fanswoo.com/wu_ice/" data-csrc="img/portfolio/wuice.png">
							<div class="pic showOriginal">
								<a href="http://web.fanswoo.com/wu_ice/"><img src="img/portfolio/8-wuice.png"></a>
							</div>
							<div class="pic showBlur">
								<img src="img/portfolio/8-wuice.png">
							</div>
							<div class="bg"></div>
							<div class="text">
								Maj.Frutti 精緻冰店
							</div>
							<div class="logo">
								<img src="img/portfolio/wuice_logo.png">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="portfolioPageBg portfolioPageGraphicDesignBg" style="display:none;">
				<div class="portfolioPage portfolioPageGraphicDesign">
					<div class="portfolioLeft">
						<h2 class="portfolioTitle">Graphic design <span class="zhtw">視覺、平面設計</span></h2>
						<div class="portfolioDiv">
							<div class="pic showOriginal">
								<img src="img/designSampleCandace.jpg">
							</div>
							<div class="pic showBlur">
								<img src="img/designSampleCandace.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								Candace 洪秀女名品服飾設計
							</div>
							<div class="logo">
								<img src="img/designSampleLogoCandace.png">
							</div>
						</div>
						<div class="portfolioDiv">
							<div class="pic showOriginal">
								<img src="img/designSampleKantocars.jpg">
							</div>
							<div class="pic showBlur">
								<img src="img/designSampleKantocars.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								Kantocars 關東車材
							</div>
							<div class="logo">
								<img src="img/designSampleLogoKantocars.png">
							</div>
						</div>
						<div class="portfolioDiv">
							<div class="pic showOriginal">
								<img src="img/designSampleKing.jpg">
							</div>
							<div class="pic showBlur">
								<img src="img/designSampleKing.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								King 曼谷家具第一品牌
							</div>
							<div class="logo">
								<img src="img/designSampleLogoKing.png">
							</div>
						</div>
						<div class="portfolioDiv">
							<div class="pic showOriginal">
								<img src="img/designSampleDeleon.jpg">
							</div>
							<div class="pic showBlur">
								<img src="img/designSampleDeleon.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								Deleon 德利昂義式餐廳
							</div>
							<div class="logo">
								<img src="img/designSampleLogoDeleon.png">
							</div>
						</div>
					</div>
					<div class="portfolioContent">
					</div>
					<div class="portfolioRight">
						<div class="portfolioDiv">
							<div class="pic showOriginal">
								<img src="img/designSampleGxxly.jpg">
							</div>
							<div class="pic showBlur">
								<img src="img/designSampleGxxly.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								新聯陽房地產品牌
							</div>
							<div class="logo">
								<img src="img/designSampleLogoGxxly.png">
							</div>
						</div>
						<div class="portfolioDiv">
							<div class="pic showOriginal">
								<img src="img/designSampleChuantin.jpg">
							</div>
							<div class="pic showBlur">
								<img src="img/designSampleChuantin.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								Chuantin 川霆科技品牌
							</div>
							<div class="logo">
								<img src="img/designSampleLogoChuantin.png">
							</div>
						</div>
						<div class="portfolioDiv">
							<div class="pic showOriginal">
								<img src="img/designSampleCandace.jpg">
							</div>
							<div class="pic showBlur">
								<img src="img/designSampleCandace.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								Candace 洪秀女名品服飾設計
							</div>
							<div class="logo">
								<img src="img/designSampleLogoCandace.png">
							</div>
						</div>
						<div class="portfolioDiv">
							<div class="pic showOriginal">
								<img src="img/designSampleKantocars.jpg">
							</div>
							<div class="pic showBlur">
								<img src="img/designSampleKantocars.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								Kantocars 關東車材
							</div>
							<div class="logo">
								<img src="img/designSampleLogoKantocars.png">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="portfolioPageBg portfolioPageMarketingBg" style="display:none;">
				<div class="portfolioPage portfolioPageMarketing">
					<div class="portfolioLeft">
						<h2 class="portfolioTitle">Marketing <span class="zhtw">網路、整合行銷專案</span></h2>
						<div class="portfolioDiv">
							<div class="pic showOriginal">
								<img src="img/designSampleCandace.jpg">
							</div>
							<div class="pic showBlur">
								<img src="img/designSampleCandace.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								Candace 洪秀女名品服飾設計
							</div>
							<div class="logo">
								<img src="img/designSampleLogoCandace.png">
							</div>
						</div>
						<div class="portfolioDiv">
							<div class="pic showOriginal">
								<img src="img/designSampleKantocars.jpg">
							</div>
							<div class="pic showBlur">
								<img src="img/designSampleKantocars.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								Kantocars 關東車材
							</div>
							<div class="logo">
								<img src="img/designSampleLogoKantocars.png">
							</div>
						</div>
						<div class="portfolioDiv">
							<div class="pic showOriginal">
								<img src="img/designSampleKing.jpg">
							</div>
							<div class="pic showBlur">
								<img src="img/designSampleKing.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								King 曼谷家具第一品牌
							</div>
							<div class="logo">
								<img src="img/designSampleLogoKing.png">
							</div>
						</div>
						<div class="portfolioDiv">
							<div class="pic showOriginal">
								<img src="img/designSampleDeleon.jpg">
							</div>
							<div class="pic showBlur">
								<img src="img/designSampleDeleon.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								Deleon 德利昂義式餐廳
							</div>
							<div class="logo">
								<img src="img/designSampleLogoDeleon.png">
							</div>
						</div>
					</div>
					<div class="portfolioContent">
					</div>
					<div class="portfolioRight">
						<div class="portfolioDiv">
							<div class="pic showOriginal">
								<img src="img/designSampleGxxly.jpg">
							</div>
							<div class="pic showBlur">
								<img src="img/designSampleGxxly.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								新聯陽房地產品牌
							</div>
							<div class="logo">
								<img src="img/designSampleLogoGxxly.png">
							</div>
						</div>
						<div class="portfolioDiv">
							<div class="pic showOriginal">
								<img src="img/designSampleChuantin.jpg">
							</div>
							<div class="pic showBlur">
								<img src="img/designSampleChuantin.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								Chuantin 川霆科技品牌
							</div>
							<div class="logo">
								<img src="img/designSampleLogoChuantin.png">
							</div>
						</div>
						<div class="portfolioDiv">
							<div class="pic showOriginal">
								<img src="img/designSampleCandace.jpg">
							</div>
							<div class="pic showBlur">
								<img src="img/designSampleCandace.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								Candace 洪秀女名品服飾設計
							</div>
							<div class="logo">
								<img src="img/designSampleLogoCandace.png">
							</div>
						</div>
						<div class="portfolioDiv">
							<div class="pic showOriginal">
								<img src="img/designSampleKantocars.jpg">
							</div>
							<div class="pic showBlur">
								<img src="img/designSampleKantocars.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								Kantocars 關東車材
							</div>
							<div class="logo">
								<img src="img/designSampleLogoKantocars.png">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?=$temp['footer_bar']?>
<?=$temp['body_end']?>