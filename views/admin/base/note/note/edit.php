<?=$temp['header_up']?>
<script src="js/tool/ckeditor/ckeditor.js"></script>
<script src="js/tool/jquery-ui-timepicker-addon/script.js"></script>
<link rel="stylesheet" type="text/css" href="js/tool/jquery-ui-timepicker-addon/style.css">
<script>
Temp.ready(function(){
    //加載點了超連結以後的頁面以及動畫效果
    // $("a[href^='admin/base/note/note/tablelist']").temp_load_page({
    //     url: 'admin/base/note/note/tablelist',
    //     now_body_animate: 'temp_page_load_animate',
    //     next_body_animate: 'temp_page_load_animate',
    //     func: function(){
    //     }
    // });

    // $("a[href^='admin/base/note/classmeta/tablelist']").temp_load_page({
    //     url: 'admin/base/note/classmeta/tablelist',
    //     now_body_animate: 'temp_page_load_animate',
    //     next_body_animate: 'temp_page_load_animate',
    //     func: function(){
    //     }
    // });

    //加載 HTML 編輯器
    CKEDITOR.replace( 'content', {
        toolbar: 'html'
    });

    //加載日期編輯器
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
    <h3><?=$child3_title?> > <?if(!empty($NoteField->noteid)):?>編輯<?else:?>新增<?endif?></h3>
    <h4>請填寫<?=$child3_title?>之詳細資訊</h4>
    <?php echo form_open_multipart("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                文章標題
            </div>
            <div class="spanLineLeft width500">
                <input type="text" class="text" name="title" placeholder="請輸入文章名稱" value="<?=$NoteField->title?>" required>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                文章代碼
            </div>
            <div class="spanLineLeft width500">
                <input type="text" class="text" name="slug" placeholder="文章代碼" value="<?=$NoteField->slug?>">
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <p class="gray">請填寫文章代碼，將會顯示於此文章連結網址，若無填寫則會自動產生亂碼</p>
                <p class="gray">本值需為英文或數字組合，不得含有中文及特殊符號，並且不得與其它文章代碼有重複</p>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                分類標籤
            </div>
            <div class="spanLineLeft width300">
                <?if(!empty($NoteField->class_ClassMetaList->obj_arr)):?>
                <div>
                    <select name="classids_arr[]">
                        <option value="">沒有分類標籤</option>
                        <?foreach($NoteClassMetaList->obj_arr as $key2 => $value2_NoteClass):?>
                        <option value="<?=$value2_NoteClass->classid?>"<?if($NoteField->class_ClassMetaList->obj_arr[0]->classid == $value2_NoteClass->classid):?> selected<?endif?>><?=$value2_NoteClass->classname?></option>
                        <?endforeach?>
                    </select>
                </div>
                <?else:?>
                <div>
                    <select name="classids_arr[]">
                        <option value="">沒有分類標籤</option>
                        <?foreach($NoteClassMetaList->obj_arr as $key => $value_ClassMeta):?>
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
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                文章預覽圖
            </div>
            <div class="spanLineRight">
                <div fanswoo-pic_upload_ajax fanswoo-upload_status="hidden">上傳更多圖片</div>
                <div class="picidUploadList" fanswoo-piclist>
                    <div fanswoo-picid class="picidUploadLi" fanswoo-clone>
                        <div class="pic"><img src="" fanswoo-picid_img></div>
                        <div class="other">
                            <div class="pic_copy"><input type="text" fanswoo-picid_path_input fanswoo-input_copy readonly /></div>
                            <div fanswoo-pic_delete class="pic_delete">刪除圖片</div>
                        </div>
                        <input type="hidden" fanswoo-picid_input_hidden_picid name="picids_arr[]">
                    </div>
                    <?if(!empty($NoteField->pic_PicObjList->obj_arr)):?>
                    <?foreach($NoteField->pic_PicObjList->obj_arr as $key => $value_PicObj):?>
                    <div fanswoo-picid="<?=$value_PicObj->picid?>" class="picidUploadLi">
                        <div class="pic"><img src="<?=$value_PicObj->path_arr['w50h50']?>" fanswoo-picid_img></div>
                        <div class="other">
                            <div class="pic_copy"><input type="text" fanswoo-picid_path_input fanswoo-input_copy readonly value="<?=$value_PicObj->path_arr['w0h0']?>" /></div>
                            <div fanswoo-pic_delete class="pic_delete">刪除圖片</div>
                        </div>
                        <input type="hidden" fanswoo-picid_input_hidden_picid name="picids_arr[]" value="<?=$value_PicObj->picid?>">
                    </div>
                    <?endforeach?>
                    <?endif?>
                </div>
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineLeft width500">
                <span class="gray">請上傳300x300之圖檔，多張圖檔將以第一張為默認顯示圖檔</span>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                文章內容
            </div>
            <div class="spanLineRight">
                <div fanswoo-pic_upload_ajax fanswoo-upload_status="unclassified">上傳更多圖片</div>
                <div class="picidUploadList" fanswoo-piclist>
                    <div fanswoo-picid class="picidUploadLi" fanswoo-clone>
                        <div class="pic"><img src="" fanswoo-picid_img></div>
                        <div class="other">
                            <div class="pic_copy"><input type="text" fanswoo-picid_path_input fanswoo-input_copy readonly /></div>
                            <div fanswoo-pic_delete class="pic_delete">刪除圖片</div>
                        </div>
                    </div>
                </div>
                <textarea cols="80" id="content" name="content" rows="10" required ><?=$NoteField->content_Html?></textarea>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                文章新增時間
            </div>
            <div class="spanLineLeft"></link>
                <input type="text" id="updatetime" class="text" name="updatetime" value="<?=$NoteField->updatetime_DateTime->datetime?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                 文章發表狀態
            </div>
            <div class="spanLineLeft">
                <select name="shelves_status">
                    <option value="1"<?if($NoteField->shelves_status == 1):?> selected<?endif?>>已發表</option>
                    <option value="2"<?if($NoteField->shelves_status == 2):?> selected<?endif?>>未發表</option>
                </select>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                優先排序指數
            </div>
            <div class="spanLineLeft">
                <input type="number" class="text width100" name="prioritynum" min="0" value="<?=$NoteField->prioritynum?>">
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <p class="gray">優先排序值較高者，其排序較為前面</p>
            </div>
        </div>
    </div>
    <?if(0):?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                瀏覽數
            </div>
            <div class="spanLineLeft">
                <?=$NoteField->viewnum?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                回應數
            </div>
            <div class="spanLineLeft">
                <?=$NoteField->viewnum?>
            </div>
        </div>
    </div>
    <?endif?>
    <div class="spanLine spanSubmit">
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <?if(!empty($NoteField->noteid)):?><input type="hidden" name="noteid" value="<?=$NoteField->noteid?>"><?endif?>
                <input type="submit" class="submit" value="<?if(!empty($NoteField->noteid)):?>儲存變更<?else:?>新增文章<?endif?>">
                <input type="submit" class="submit" name="show_bln" value="存成草稿並預覽">
                <?if(!empty($NoteField->noteid)):?><span class="submit gray" onClick="fanswoo.check_href_action('刪除後將進入回收空間，確定要刪除嗎？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?noteid=<?=$NoteField->noteid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除<?=$child3_title?></span><?endif?>
            </div>
        </div>
    </div>
    </form>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>