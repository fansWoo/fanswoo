<?=$temp['header_up']?>
<script src="app/js/smooth_scrollerator.js"></script>
<?=$temp['header_down']?>
<?=$temp['header_bar']?>
		<div class="bg1">fansWoo</div>
		<div class="bg2">fansWoo</div>
		<div class="bg3">fansWoo</div>
        
		<div class="textHotNews">
			<h2>熱門文章</h2>
			<?foreach($new_NoteFieldList->obj_Arr as $key => $value_NoteFieldList):?>
				<a href="note/view/<?=$value_NoteFieldList->noteid_Num?>"><?=$value_NoteFieldList->title_Str?></a>
			<?endforeach?>
		</div>
		<div class="newsContent">
			<h2 class="newsTitle">趨勢 <b>N</b>ews</h2>
			<h3><b>設計創作、市場行銷、企業管理、科技資訊</b></h3>
				<?foreach($new_NoteFieldList->obj_Arr as $key => $value_NoteFieldList):?>
				<div class="stage">
					<h3 class="title"><a href="note/view/<?=$value_NoteFieldList->noteid_Num?>"><?=$value_NoteFieldList->title_Str?></a></h3>
					<p class="title2"><a href="" fanScript-hrefNone class="author">Sacriley Yang</a><?=$value_NoteFieldList->updatetime_DateTime->getdate_Arr['year']?>.<?=$value_NoteFieldList->updatetime_DateTime->getdate_Arr['mon']?>.<?=$value_NoteFieldList ->updatetime_DateTime->getdate_Arr['mday']?></p>
					<?if($value_NoteFieldList->pic_PicObjList->obj_Arr[0]->path_Arr['w0h0'] !== NULL):?>
						<a href="note/view/<?=$value_NoteFieldList->noteid_Num?>" class="pic">
							<img src="<?=$value_NoteFieldList->pic_PicObjList->obj_Arr[0]->path_Arr['w0h0']?>">
						</a>
					<?endif?>
					<div class="message">
						<?=mb_substr(strip_tags($value_NoteFieldList->content_Html), 0, 100, 'utf-8')?>
					</div>
					<iframe src="http://www.facebook.com/widgets/like.php?href=http://www.facebook.com/fanswoo.my&show_faces=true" scrolling="no" frameborder="0" allowTransparency="true" style="border:none;overflow:hidden;width:500px; height:65px;"></iframe>
					<p>（<a href="note/view/<?=$value_NoteFieldList->noteid_Num?>">繼續閱讀...</a>）</p>
				</div>
				<?endforeach?>
				<?if(0):?>
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
				<?endif?>
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
		</div>
<?=$temp['footer_bar']?>
<?=$temp['body_end']?>