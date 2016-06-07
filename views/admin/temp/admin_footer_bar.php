			</div>
		</div>
		<div class="footer">
			<div class="language">
				<?
					$this->config->load('i18n');
					$language_arr = $this->config->item('language');
				?>
				語言切換：
				<select>
					<?foreach($language_arr['locale'] as $key => $value):?>
					<option value="languages/?change=<?=$key?>&back_url=<?='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>"<?if($global['locale'] == $key):?> selected<?endif?>><?=$value?></option>
					<?endforeach?>
				</select>
			</div>
			<div class="center">
       			<a href="http://fanswoo.com" target="_blank">fansWoo</a> All Rights Reserved. Design By <a href="http://fanswoo.com" target="_blank">fansWoo 瘋沃科技</a>
       		</div>
		</div>