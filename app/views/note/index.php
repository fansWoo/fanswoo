<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['topheader']?>
		<div class="bg1">fansWoo</div>
		<div class="bg2">fansWoo</div>
		<div class="bg3">fansWoo</div>
        
		<div class="textHotNews">
			<h2>熱門文章</h2>
			<?foreach($note_other_list as $value):?>
				<a href="note/view/<?=$value['noteid']?>"><?=$value['title']?></a>
			<?endforeach?>
		</div>
		<div class="newsContent">
			<h2 class="newsTitle">趨勢 <b>N</b>ews</h2>
			<h3><b>設計創作、市場行銷、企業管理、科技資訊</b></h3>
			<?if(isset($note_list)):?>
			<?foreach($note_list as $value):?>
				<div class="stage">
					<h3 class="title"><a href="note/view/<?=$value['noteid']?>"><?=$value['title']?></a></h3>
					<p class="title2"><a href="" fanScript-hrefNone class="author">Sacriley Yang</a><?=$value['updatetime']?></p>
					<?if($value['pic']):?>
					<a href="note/view/<?=$value['noteid']?>" class="pic">
						<img src="<?=$value['pic']?>">
					</a>
					<?endif?>
					<div class="message">
					<?=$value['content_html']?>
					</div>
					<iframe src="http://www.facebook.com/widgets/like.php?href=http://www.facebook.com/fanswoo.my&show_faces=true" scrolling="no" frameborder="0" allowTransparency="true" style="border:none;overflow:hidden;width:500px; height:65px;"></iframe>
					<p>（<a href="note/view/<?=$value['noteid']?>">繼續閱讀...</a>）</p>
				</div>
			<?endforeach?>
			<?else:?>
				<div class="stage">
					<h3 class="title"><a href="note/view/<?=$note['noteid']?>"><?=$note['title']?></a></h3>
					<p class="title2"><a href="" fanScript-hrefNone class="author">Sacriley Yang</a><?=$note['updatetime']?></p>
					<div class="message">
					<?=$note['content_html']?>
					</div>
					<iframe src="http://www.facebook.com/widgets/like.php?href=http://www.facebook.com/fanswoo.my&show_faces=true" scrolling="no" frameborder="0" allowTransparency="true" style="border:none;overflow:hidden;width:500px; height:65px;"></iframe>
				</div>
				<div class="hotNews">
					<h3>延伸閱讀</h3>
					<?foreach($note_other_list as $value):?>
						<a href="note/view/<?=$value['noteid']?>">
							<div class="pic"><img src="<?=$value['pic']?>"></div>
							<p><?=$value['title']?></p>
							<p class="gray">by Sacriley Yang at <?=$value['updatetime']?></p>
						</a>
					<?endforeach?>
				</div>
				<?if(0):?>
				<div class="authorArea">
					<h3>本篇作者</h3>
					<div class="pic"></div>
					<h3>Sacriley Yang<span class="gray">UI/UX設計師</span></h3>
					<p>使用者介面設計是一門深奧的學問，除了達到基本的使用者需求，還需要兼顧產品的創意、程式內容、美術設計、企業獲利和市場行銷，如何為企業打造一個雙贏的品牌，正是我們致力探討的目標。</p>
				</div>
				<?endif?>
				<div class="commentList">
					<h3>留言討論</h3>
					<div id="fb-root"></div>
					<script>
					(function(d, s, id) {
						var js, fjs = d.getElementsByTagName(s)[0];
						if (d.getElementById(id)) return;
							js = d.createElement(s); js.id = id;
							js.src = "//connect.facebook.net/zh_TW/all.js#xfbml=1&appId=275778529183085";
							fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));
					</script>
					<div class="fb-comments" data-href="http://web.fanswoo.com/business/note/view/<?=$note['noteid']?>" data-width="520"></div>
				</div>
			<?endif?>
		</div>
<?=$temp['footer']?>