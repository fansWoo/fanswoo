<?=$temp['header_up']?>
<script>
Temp.ready(function(){

    //加載 HTML 編輯器
    CKEDITOR.replace( 'content', {
        toolbar: 'basic'
    });

    $('#start_time').datetimepicker({
        dateFormat: 'yy-mm-dd',
        timeFormat: 'HH:mm:ss'
    });
    $('#end_time').datetimepicker({
        dateFormat: 'yy-mm-dd',
        timeFormat: 'HH:mm:ss'
    });
});
</script>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title?> - <?=$child3_title?></h2>
<div class="contentBox allWidth">
    <h3><?=$child3_title?> > <?if(!empty($Worktask->worktaskid)):?>編輯<?else:?>新增<?endif?></h3>
    <h4>請填寫<?=$child3_title?>之詳細資訊</h4>
    <?php echo form_open_multipart("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                任務名稱
            </div>
            <div class="spanLineLeft width500">
                <input type="text" class="text" name="title" placeholder="請輸入問題標題" value="<?=$Worktask->title?>" required>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案名稱
            </div>
            <div class="spanLineLeft width300">
                <?if(!empty($Worktask->class_ClassMetaList->obj_arr)):?>
                <div>
                    <select name="projectid">
                        <option value="">尚未選擇專案</option>
                        <?foreach( (array) $ProjectList->obj_arr as $key2 => $value_Project):?>
                        <option value="<?=$value_Project->projectid?>"<?if($Worktask->projectid == $value_Project->projectid):?> selected<?endif?>><?=$value_Project->name?></option>
                        <?endforeach?>
                    </select>
                </div>
                <?else:?>
                <div>
                    <select name="projectid">
                        <option value="">尚未選擇專案</option>
                        <?foreach( (array) $ProjectList->obj_arr as $key => $value_Project):?>
                        <option value="<?=$value_Project->projectid?>"><?=$value_Project->name?></option>
                        <?endforeach?>
                    </select>
                </div>
                <?endif?>
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineLeft width500">
                <a href="admin/<?=$child1_name?>/project/project/tablelist">管理專案</a>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                任務分類
            </div>
            <div class="spanLineLeft width300">
                <?if(!empty($Worktask->class_ClassMetaList->obj_arr)):?>
                <div>
                    <select name="classids">
                        <option value="">尚未選擇任務分類</option>
                        <?foreach($WorktaskClassMetaList->obj_arr as $key2 => $value2_WorktaskClass):?>
                        <option value="<?=$value2_WorktaskClass->classid?>"<?if($Worktask->class_ClassMetaList->obj_arr[0]->classid == $value2_WorktaskClass->classid):?> selected<?endif?>><?=$value2_WorktaskClass->classname?></option>
                        <?endforeach?>
                    </select>
                </div>
                <?else:?>
                <div>
                    <select name="classids">
                        <option value="">尚未選擇任務分類</option>
                        <?foreach($WorktaskClassMetaList->obj_arr as $key => $value_ClassMeta):?>
                        <option value="<?=$value_ClassMeta->classid?>"><?=$value_ClassMeta->classname?></option>
                        <?endforeach?>
                    </select>
                </div>
                <?endif?>
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineLeft width500">
                <a href="admin/<?=$child1_name?>/<?=$child2_name?>/classmeta/tablelist">管理任務分類</a>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                任務內容
            </div>
            <div class="spanLineRight">
                <textarea cols="80" id="content" name="content" rows="10" required><?=$Worktask->content_Html?></textarea>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                預估時數
            </div>
            <div class="spanLineLeft">
                <input type="number" id="estimate_hour" class="text" name="estimate_hour" value="<?=$Worktask->estimate_hour?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                耗用時數
            </div>
            <div class="spanLineLeft">
                <input type="number" id="use_hour" class="text" name="use_hour" value="<?=$Worktask->use_hour?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                起始時間
            </div>
            <div class="spanLineLeft">
                <input type="text" id="start_time" class="text" name="start_time" value="<?=$Worktask->start_time_DateTime->datetime?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                結束時間
            </div>
            <div class="spanLineLeft">
                <input type="text" id="end_time" class="text" name="end_time" value="<?=$Worktask->end_time_DateTime->datetime?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                優先排序指數
            </div>
            <div class="spanLineLeft">
                <input type="number" class="text width100" name="prioritynum" min="0" value="<?=$Worktask->prioritynum?>">
            </div>
        </div>
    </div>
    <div class="spanLine spanSubmit">
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <?if(!empty($Worktask->worktaskid)):?><input type="hidden" name="worktaskid" value="<?=$Worktask->worktaskid?>"><?endif?>
                <input type="submit" class="submit" value="<?if(!empty($Worktask->worktaskid)):?>儲存變更<?else:?>新增常見問題<?endif?>">
                <?if(!empty($Worktask->worktaskid)):?><span class="submit gray" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?worktaskid=<?=$Worktask->worktaskid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除<?=$child3_title?></span><?endif?>
            </div>
        </div>
    </div>
    </form>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>