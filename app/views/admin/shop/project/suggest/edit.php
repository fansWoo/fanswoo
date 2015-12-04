<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title_Str?> - <?=$child3_title_Str?></h2>
<div class="contentBox allWidth">
    <h3><?=$child3_title_Str?> > <?if(!empty($Suggest->suggestid_Num)):?>編輯<?else:?>新增<?endif?></h3>
    <h4>請填寫<?=$child3_title_Str?>之詳細資訊</h4>
    <?php echo form_open("admin/$child1_name_Str/$child2_name_Str/$child3_name_Str/{$child4_name_Str}_post/") ?>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                修改建議標題
            </div>
            <div class="spanLineLeft width300">
                <?=$Suggest->title_Str?>
            </div>
		</div>
	</div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                修改建議內容
            </div>
            <div class="spanLineLeft width300">
                <?=$Suggest->content_Str?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                回覆建議內容
            </div>
            <div class="spanLineLeft width300">
                <textarea name="answer_Str"><?=$Suggest->answer_Str?></textarea>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                處理狀態
            </div>
            <div class="spanLineLeft width500">
                <select name="answer_status_Num">
                    <option value="1" <?if($Suggest->answer_status_Num == 1):?> selected<?endif?>>評估中</option>
                    <option value="2" <?if($Suggest->answer_status_Num == 2):?> selected<?endif?>>修改中</option>
                    <option value="3" <?if($Suggest->answer_status_Num == 3):?> selected<?endif?>>已完成</option>
                </select>
            </div>
        </div>
    </div>
    <?if(!empty($Suggest->suggestid_Num)):?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                更新日期
            </div>
            <div class="spanLineLeft">
                <?=$Suggest->updatetime_DateTime->datetime_Str?>
            </div>
        </div>
    </div>
    <?endif?>
	<div class="spanLine spanSubmit">
		<div class="spanLineLeft">
		</div>
		<div class="spanLineRight">
            <?if(!empty($Suggest->suggestid_Num)):?><input type="hidden" name="suggestid_Num" value="<?=$Suggest->suggestid_Num?>"><?endif?>
		    <input type="submit" class="submit" value="<?if(!empty($Suggest->suggestid_Num)):?>儲存變更<?else:?>新增修改建議<?endif?>">
            <?if(!empty($Suggest->suggestid_Num)):?><span class="submit gray" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/delete/?suggestid=<?=$Suggest->suggestid_Num?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除<?=$child3_title_Str?></span><?endif?>
		</div>
	</div>
	</form>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>