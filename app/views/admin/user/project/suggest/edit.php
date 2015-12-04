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
                <?if($Suggest->suggest_status_Num==1):?>
                    <?=$Suggest->title_Str?>
                <?else:?>
                    <input type="text" class="text" name="title_Str" placeholder="請輸入修改建議標題" value="<?=$Suggest->title_Str?>">
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
                <?if($Suggest->suggest_status_Num==1):?>
                    <?=$Suggest->content_Str?>
                <?else:?>
                    <textarea name="content_Str"><?=$Suggest->content_Str?></textarea><?=$Suggest->content_Str?>
                <?endif?>
            </div>
        </div>
    </div>
    <?if(empty($Suggest->suggestid_Num)):?>
    <?else:?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                回覆建議內容
            </div>
            <div class="spanLineLeft width300">
                <?if(!empty($Suggest->answer_Str)):?>
                    <?=$Suggest->answer_Str?>
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
                <?if($Suggest->answer_status_Num == 1):?><p class="green">評估中</p></option>
                <?elseif($Suggest->answer_status_Num == 2):?><p class="green">修改中</p></option>
                <?elseif($Suggest->answer_status_Num == 3):?>已完成</option>
                <?endif?>
            </div>
        </div>
    </div>
    <?endif?>
    <?if(!empty($Suggest->suggestid_Num)):?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                提出日期
            </div>
            <div class="spanLineLeft">
                <?=$Suggest->suggest_time_DateTime->datetime_Str?>
            </div>
        </div>
    </div>
    <?endif?>
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
    <?if($Suggest->suggest_status_Num==1):?>
    <?else:?>
	<div class="spanLine spanSubmit">
		<div class="spanLineLeft">
		</div>
		<div class="spanLineRight">
            <?if(!empty($Suggest->suggestid_Num)):?><input type="hidden" name="suggestid_Num" value="<?=$Suggest->suggestid_Num?>"><?endif?>
            <?if(empty($Suggest->projectid_Num)):?><input type="hidden" name="projectid_Num" value="<?=$projectid_Num?>"><?endif?>
		    <input type="submit" class="submit" value="<?if(!empty($Suggest->suggestid_Num)):?>儲存變更<?else:?>新增修改建議<?endif?>">
		</div>
	</div>
    <?endif?>
	</form>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>