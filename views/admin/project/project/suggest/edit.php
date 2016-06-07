<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2>專案 - 修改建議</h2>
<div class="contentBox allWidth">
    <h3>專案修改建議編輯</h3>
    <h4>請填寫專案修改建議之詳細資訊</h4>
    <?php echo form_open("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                修改建議標題
            </div>
            <div class="spanLineLeft width300">
                <?=$Suggest->title?>
            </div>
		</div>
	</div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                修改建議內容
            </div>
            <div class="spanLineLeft width300">
                <?=$Suggest->content?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                回覆建議內容
            </div>
            <div class="spanLineLeft width300">
                <textarea name="answer"><?=$Suggest->answer?></textarea>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                處理狀態
            </div>
            <div class="spanLineLeft width500">
                <select name="answer_status">
                    <option value="1" <?if($Suggest->answer_status == 1):?> selected<?endif?>>評估中</option>
                    <option value="2" <?if($Suggest->answer_status == 2):?> selected<?endif?>>修改中</option>
                    <option value="3" <?if($Suggest->answer_status == 3):?> selected<?endif?>>已完成</option>
                </select>
            </div>
        </div>
    </div>
    <?if(!empty($Suggest->suggestid)):?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                更新日期
            </div>
            <div class="spanLineLeft">
                <?=$Suggest->updatetime_DateTime->datetime?>
            </div>
        </div>
    </div>
    <?endif?>
	<div class="spanLine spanSubmit">
		<div class="spanLineLeft">
		</div>
		<div class="spanLineRight">
            <?if(!empty($Suggest->suggestid)):?><input type="hidden" name="suggestid" value="<?=$Suggest->suggestid?>"><?endif?>
		    <input type="submit" class="submit" value="<?if(!empty($Suggest->suggestid)):?>儲存變更<?else:?>新增修改建議<?endif?>">
            <input type="hidden" name="projectid" value="<?=$Suggest->projectid?>">
            <?if(!empty($Suggest->suggestid)):?><span class="submit gray" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?suggestid=<?=$Suggest->suggestid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除<?=$child3_title?></span><?endif?>
		</div>
	</div>
	</form>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>