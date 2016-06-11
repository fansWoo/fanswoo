<?=$temp['header_up']?>
<script src="js/tool/jquery-ui-timepicker-addon/script.js"></script>
<link rel="stylesheet" type="text/css" href="js/tool/jquery-ui-timepicker-addon/style.css"></link>
<script>
Temp.ready(function(){
    $('#updatetime').datetimepicker({
        dateFormat: 'yy-mm-dd',
        timeFormat: 'HH:mm:ss'
    });
});
</script>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title?> - <?=$child3_title?></h2>
<div class="contentBox allWidth">
    <h3><?=$child3_title?> > <?if(!empty($FaqField->faqid)):?>編輯<?else:?>新增<?endif?></h3>
    <h4>請填寫<?=$child3_title?>之詳細資訊</h4>
    <?php echo form_open_multipart("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                問題標題
            </div>
            <div class="spanLineLeft width500">
                <input type="text" class="text" name="title" placeholder="請輸入問題標題" value="<?=$FaqField->title?>" required>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                分類標籤
            </div>
            <div class="spanLineLeft width300">
                <?if(!empty($FaqField->class_ClassMetaList->obj_arr)):?>
                <div>
                    <select name="classids_arr[]">
                        <option value="">沒有分類標籤</option>
                        <?foreach($FaqClassMetaList->obj_arr as $key2 => $value2_FaqClass):?>
                        <option value="<?=$value2_FaqClass->classid?>"<?if($FaqField->class_ClassMetaList->obj_arr[0]->classid == $value2_FaqClass->classid):?> selected<?endif?>><?=$value2_FaqClass->classname?></option>
                        <?endforeach?>
                    </select>
                </div>
                <?else:?>
                <div>
                    <select name="classids_arr[]">
                        <option value="">沒有分類標籤</option>
                        <?foreach($FaqClassMetaList->obj_arr as $key => $value_ClassMeta):?>
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
                <a href="admin/<?=$child1_name?>/<?=$child2_name?>/classmeta/tablelist">管理分類標籤</a>
            </div>
        </div>
    </div>
    <?if(0):?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                文章預覽圖
            </div>
            <div class="spanLineLeft width500">
                <div class="fileMultiple1"><input type="file" name="picids_FilesArr[]" accept="image/*"></div>
                <?if(!empty($FaqField->pic_PicObjList->obj_arr[0]->picid)):?>
                <div class="picidUploadList">
                    <div fanswoo-picid="<?=$FaqField->pic_PicObjList->obj_arr[0]->picid?>" class="picidUploadLi">
                        <div fanswoo-picDelete class="picDelete"></div>
                        <img src="<?=$FaqField->pic_PicObjList->obj_arr[0]->path_arr['w50h50']?>">
                        <input type="hidden" name="picids_arr[]" value="<?=$FaqField->pic_PicObjList->obj_arr[0]->picid?>">
                    </div>
                </div>
                <?endif?>
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineLeft width500">
                <span class="gray">請上傳300x300之圖檔</span>
            </div>
        </div>
    </div>
    <?endif?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                回答內容
            </div>
            <div class="spanLineLeft width500">
                <textarea cols="80" id="content" name="content" rows="10" required><?=$FaqField->content_Html?></textarea>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                新增時間
            </div>
            <div class="spanLineLeft">
                <input type="text" id="updatetime" class="text" name="updatetime" value="<?=$FaqField->updatetime_DateTime->datetime?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                優先排序指數
            </div>
            <div class="spanLineLeft">
                <input type="number" class="text width100" name="prioritynum" min="0" value="<?=$FaqField->prioritynum?>">
            </div>
        </div>
    </div>
    <div class="spanLine spanSubmit">
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <?if(!empty($FaqField->faqid)):?><input type="hidden" name="faqid" value="<?=$FaqField->faqid?>"><?endif?>
                <input type="submit" class="submit" value="<?if(!empty($FaqField->faqid)):?>儲存變更<?else:?>新增常見問題<?endif?>">
                <?if(!empty($FaqField->faqid)):?><span class="submit gray" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?faqid=<?=$FaqField->faqid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除<?=$child3_title?></span><?endif?>
            </div>
        </div>
    </div>
    </form>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>