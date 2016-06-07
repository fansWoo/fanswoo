<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title?> - 專案修改建議</h2>
<div class="contentBox allWidth">
    <h3>專案修改建議 > <?if(!empty($Suggest->suggestid)):?>編輯<?else:?>新增<?endif?></h3>
    <h4>請填寫專案修改建議之詳細資訊</h4>
    <?php echo form_open("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                修改建議標題
            </div>
            <div class="spanLineLeft width300">
                <?if($Suggest->suggest_status==1):?>
                    <?=$Suggest->title?>
                <?else:?>
                    <input type="text" class="text" name="title" placeholder="請輸入修改建議標題" value="<?=$Suggest->title?>">
                <?endif?>
            </div>
		</div>
	</div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                修改建議內容
            </div>
            <div class="spanLineLeft width300">
                <?if($Suggest->suggest_status==1):?>
                    <?=$Suggest->content?>
                <?else:?>
                    <textarea name="content"><?=$Suggest->content?></textarea><?=$Suggest->content?>
                <?endif?>
            </div>
        </div>
    </div>
    <?if(empty($Suggest->suggestid)):?>
    <?else:?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                回覆建議內容
            </div>
            <div class="spanLineLeft width300">
                <?if(!empty($Suggest->answer)):?>
                    <?=$Suggest->answer?>
                <?else:?>
                    <p class="red">管理員尚未回覆</p>
                <?endif?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                處理狀態
            </div>
            <div class="spanLineLeft width500">
                <?if($Suggest->answer_status == 1):?><p class="green">評估中</p></option>
                <?elseif($Suggest->answer_status == 2):?><p class="green">修改中</p></option>
                <?elseif($Suggest->answer_status == 3):?>已完成</option>
                <?endif?>
            </div>
        </div>
    </div>
    <?endif?>
    <?if(!empty($Suggest->suggestid)):?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                提出日期
            </div>
            <div class="spanLineLeft">
                <?=$Suggest->suggest_time_DateTime->datetime?>
            </div>
        </div>
    </div>
    <?endif?>
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
    <?if($Suggest->suggest_status==1):?>
    <?else:?>
	<div class="spanLine spanSubmit">
		<div class="spanLineLeft">
		</div>
		<div class="spanLineRight">
            <?if(!empty($Suggest->suggestid)):?><input type="hidden" name="suggestid" value="<?=$Suggest->suggestid?>"><?endif?>
            <?if(empty($Suggest->projectid)):?><input type="hidden" name="projectid" value="<?=$projectid?>"><?endif?>
		    <input type="submit" class="submit" value="<?if(!empty($Suggest->suggestid)):?>儲存變更<?else:?>新增修改建議<?endif?>">
		</div>
	</div>
    <?endif?>
	</form>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>