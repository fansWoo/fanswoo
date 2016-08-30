<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title?> - <?=$child3_title?></h2>
<div class="contentBox allWidth">
    <h3><?=$child3_title?> > <?if(!empty($Contact->contactid)):?>編輯<?else:?>新增<?endif?></h3>
	<h4>請填寫<?=$child3_title?>之詳細資訊</h4>
	<?php echo form_open_multipart("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                聯繫人名稱
            </div>
            <div class="spanLineLeft width500">
                <?=$Contact->username?>
		    </div>
		</div>
	</div>



<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                公司名稱
            </div>
            <div class="spanLineLeft width500">
                <?=$Contact->company?>
            </div>
        </div>
    </div>



    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                電子郵件
            </div>
            <div class="spanLineLeft width500">
                <?=$Contact->email?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                聯繫電話
            </div>
            <div class="spanLineLeft width500">
                <?=$Contact->phone?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                詢問項目
            </div>
            <div class="spanLineLeft width500">
                <?=$Contact->classtype?>
            </div>
        </div>
    </div>



<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                項目細節
            </div>
            <div class="spanLineLeft width500">
                <?=$Contact->classtype2?>
            </div>
        </div>
    </div>



<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                項目預算
            </div>
            <div class="spanLineLeft width500">
                <?=$Contact->money?>
            </div>
        </div>
    </div>


    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                聯繫內容
            </div>
            <div class="spanLineLeft width500">
                <?=$Contact->content?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                聯繫狀態
            </div>
            <div class="spanLineLeft width500">
                <select name="status_process">
                    <option value="1"<?if($Contact->status_process == 1):?> selected<?endif?>>未處理</option>
                    <option value="2"<?if($Contact->status_process == 2):?> selected<?endif?>>已處理</option>
                </select>
            </div>
        </div>
    </div>
    <?if(!empty($Contact->contactid)):?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                聯繫日期
            </div>
            <div class="spanLineLeft width200">
                <?=$Contact->updatetime_DateTime->datetime?>
            </div>
        </div>
    </div>
    <?endif?>
	<div class="spanLine spanSubmit">
	    <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <?if(!empty($Contact->contactid)):?><input type="hidden" name="contactid" value="<?=$Contact->contactid?>"><?endif?>
                <input type="submit" class="submit" value="<?if(!empty($Contact->contactid)):?>儲存變更<?else:?>新增產品<?endif?>">
                <?if(!empty($Contact->contactid)):?><span class="submit gray" onClick="fanswoo.check_href_action('刪除後將進入回收空間，確定要刪除嗎？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?contactid=<?=$Contact->contactid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除<?=$child3_title?></span><?endif?>
            </div>
        </div>
	</div>
	</form>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>