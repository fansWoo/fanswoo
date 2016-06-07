<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title?> - <?=$child3_title?></h2>
<div class="contentBox allWidth">
    <h3><?=$child3_title?> > <?if(!empty($Transport->transportid)):?>編輯<?else:?>新增<?endif?></h3>
	<h4>請填寫<?=$child3_title?>之詳細資訊</h4>
	<?php echo form_open_multipart("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
    <div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                運輸名稱
            </div>
            <div class="spanLineLeft width500">
                <input type="text" class="text" name="name" placeholder="請輸入運輸名稱" value="<?=$Transport->name?>" required>
		    </div>
		</div>
	</div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                運輸公司
            </div>
            <div class="spanLineLeft width500">
                <input type="text" class="text" name="company" placeholder="請輸入運輸公司" value="<?=$Transport->company?>" required>
            </div>
        </div>
    </div>
        <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                運輸查貨網址
            </div>
            <div class="spanLineLeft width500">
                <input type="text" class="text" name="url" placeholder="請輸入運輸查貨網址" value="<?=$Transport->url?>" required>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                基底運費金額
            </div>
            <div class="spanLineLeft">
                <input type="number" min="0" class="text" name="base_price" placeholder="請輸入基底運費金額" value="<?=$Transport->base_price?>">
            </div>
        </div>
    </div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                加購運費金額
            </div>
            <div class="spanLineLeft">
                <input type="number" min="0" class="text" name="additional_price" placeholder="請輸入加購運費金額" value="<?=$Transport->additional_price?>">
		    </div>
		</div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <p class="gray">每運輸一個物件增加的運費，範例：總運費 = 基底運費 + 物件數量 * 加購運費</p>
            </div>
        </div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                優先排序指數
            </div>
            <div class="spanLineLeft">
                <input type="number" class="text width100" name="prioritynum" value="<?=$Transport->prioritynum?>">
            </div>
		</div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <p class="gray">優先排序指數越高，排序順序越前面</p>
            </div>
        </div>
	</div>
    <?if(!empty($Transport->transportid)):?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                更新日期
            </div>
            <div class="spanLineLeft">
                <?=$Transport->updatetime_DateTime->datetime?>
            </div>
        </div>
    </div>
    <?endif?>
	<div class="spanLine spanSubmit">
	    <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <?if(!empty($Transport->transportid)):?><input type="hidden" name="transportid" value="<?=$Transport->transportid?>"><?endif?>
                <input type="submit" class="submit" name="send_bln" value="<?if(!empty($Transport->transportid)):?>儲存變更<?else:?>新增產品<?endif?>">
                <?if(!empty($Transport->transportid)):?><span class="submit gray" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?transportid=<?=$Transport->transportid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除<?=$child3_title?></span><?endif?>
            </div>
        </div>
	</div>
	</form>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>