<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title_Str?> - <?=$child3_title_Str?></h2>
<div class="contentBox allWidth">
    <h3><?=$child3_title_Str?> > <?if(!empty($Design->designid_Num)):?>編輯<?else:?>新增<?endif?></h3>
    <h4>請填寫<?=$child3_title_Str?>之詳細資訊</h4>
    <?php echo form_open("admin/$child1_name_Str/$child2_name_Str/$child3_name_Str/{$child4_name_Str}_post/") ?>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                設計項目名稱
            </div>
            <div class="spanLineLeft width300">
                <input type="text" class="text" name="title_Str" placeholder="請輸入設計項目名稱" value="<?=$Design->title_Str?>">
            </div>
		</div>
	</div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                設計項目報價 (NT$)
            </div>
            <div class="spanLineLeft">
                <input type="number" min="0" class="text" name="price_Num" placeholder="請輸入報價金額" value="<?=$Design->price_Num?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                設計項目簡介
            </div>
            <div class="spanLineLeft width300">
                <textarea name="synopsis_Str"><?=$Design->synopsis_Str?></textarea>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                優先排序指數
            </div>
            <div class="spanLineLeft">
                <input type="number" class="text width100" name="prioritynum_Num" value="<?=$Design->prioritynum_Num?>">
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
    <?if(!empty($Design->designid_Num)):?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                更新日期
            </div>
            <div class="spanLineLeft">
                <?=$Design->updatetime_DateTime->datetime_Str?>
            </div>
        </div>
    </div>
    <?endif?>
	<div class="spanLine spanSubmit">
		<div class="spanLineLeft">
		</div>
		<div class="spanLineRight">
            <?if(!empty($Design->designid_Num)):?><input type="hidden" name="designid_Num" value="<?=$Design->designid_Num?>"><?endif?>
		    <input type="submit" class="submit" value="<?if(!empty($Design->designid_Num)):?>儲存變更<?else:?>新增設計項目<?endif?>">
            <?if(!empty($Design->designid_Num)):?><span class="submit gray" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/delete/?classid=<?=$Design->designid_Num?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除<?=$child3_title_Str?></span><?endif?>
		</div>
	</div>
	</form>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>