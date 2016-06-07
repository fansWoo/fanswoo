<?=$temp['header_up']?>
<script src="js/tool/ckeditor/ckeditor.js"></script>
<script>
Temp.ready(function(){

    CKEDITOR.replace( 'content', {
        toolbar: 'html'
    });
    CKEDITOR.replace( 'content_specification', {
        toolbar: 'html'
    });
});
</script>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title?> - <?=$child3_title?></h2>
<div class="contentBox allWidth">
    <h3><?=$child3_title?> > <?if(!empty($showpiece_Showpiece->showpieceid)):?>編輯<?else:?>新增<?endif?></h3>
	<h4>請填寫<?=$child3_title?>之詳細資訊</h4>
	<?php echo form_open_multipart("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                商品名稱
            </div>
            <div class="spanLineLeft width500">
                <input type="text" class="text" name="name" placeholder="請輸入商品名稱" value="<?=$showpiece_Showpiece->name?>" required>
		    </div>
		</div>
	</div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                商品圖片
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
                    <?if(!empty($showpiece_Showpiece->pic_PicObjList->obj_arr)):?>
                    <?foreach($showpiece_Showpiece->pic_PicObjList->obj_arr as $key => $value_PicObj):?>
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
                商品分類
            </div>
            <div class="spanLineLeft width500" fanswoo-selectEachDiv="class">
                <?if(!empty($showpiece_Showpiece->class_ClassMetaList->obj_arr)):?>
                <?foreach($showpiece_Showpiece->class_ClassMetaList->obj_arr as $key => $value_ClassMeta):?>
                    <div class="selectLine" fanswoo-selectEachLine>
                        <span class="floatleft">分類 <span fanswoo-selectEachLineCount></span> ：</span>
                        <select fanswoo-selectEachLineMaster="class">
                            <option value="">沒有分類標籤</option>
                            <?foreach($class2_ClassMetaList->obj_arr as $key2 => $value2_ClassMeta):?>
                            <option value="<?=$value2_ClassMeta->classid?>"<?if($value_ClassMeta->class_ClassMetaList->obj_arr[0]->classid == $value2_ClassMeta->classid):?> selected<?endif?>><?=$value2_ClassMeta->classname?></option>
                            <?endforeach?>
                        </select>
                        <span fanswoo-selectEachLineSlave="class">
                        <?foreach($class2_ClassMetaList->obj_arr as $key2 => $value2_ClassMeta):?>
                            <select fanswoo-selectValue="<?=$value2_ClassMeta->classid?>" fanswoo-selectName="classids_arr[]"<?if($value_ClassMeta->class_ClassMetaList->obj_arr[0]->classid == $value2_ClassMeta->classid):?> name="classids_arr[]"<?else:?> style="display:none;"<?endif?>>
                                <option value="">沒有分類標籤</option>
                                <?
                                    $test_ClassMetaList = new ObjList([
                                        'db_where_arr' => [
                                            'modelname' => 'showpiece'
                                        ],
                                        'db_where_or_arr' => [
                                            'classids' => [$value2_ClassMeta->classid]
                                        ],
                                        'model_name' => 'ClassMeta',
                                        'limitstart' => 0,
                                        'limitcount' => 100
                                    ]);
                                ?>
                                <?foreach($test_ClassMetaList->obj_arr as $key3 => $value3_ClassMeta):?>
                                <option value="<?=$value3_ClassMeta->classid?>"<?if($value_ClassMeta->classid == $value3_ClassMeta->classid):?> selected<?endif?>><?=$value3_ClassMeta->classname?></option>
                                <?endforeach?>
                            </select>
                        <?endforeach?>
                        </span>
                    </div>
                <?endforeach?>
                <?endif?>
                <div class="selectLine" fanswoo-selectEachLine>
                    <span class="floatleft">分類 <span fanswoo-selectEachLineCount></span> ：</span>
                    <select fanswoo-selectEachLineMaster="class">
                        <option value="">沒有分類標籤</option>
                        <?foreach($class2_ClassMetaList->obj_arr as $key2 => $value2_ClassMeta):?>
                        <option value="<?=$value2_ClassMeta->classid?>"><?=$value2_ClassMeta->classname?></option>
                        <?endforeach?>
                    </select>
                    <span fanswoo-selectEachLineSlave="class">
                    <?foreach($class2_ClassMetaList->obj_arr as $key2 => $value2_ClassMeta):?>
                        <select name="classids_arr[]" fanswoo-selectValue="<?=$value2_ClassMeta->classid?>" fanswoo-selectName="classids_arr[]" style="display:none;">
                            <option value="">沒有分類標籤</option>
                            <?
                                $test_ClassMetaList = new ObjList([
                                    'db_where_arr' => [
                                        'modelname' => 'showpiece'
                                    ],
                                    'db_where_or_arr' => [
                                        'classids' => [$value2_ClassMeta->classid]
                                    ],
                                    'model_name' => 'ClassMeta',
                                    'limitstart' => 0,
                                    'limitcount' => 100
                                ]);
                            ?>
                            <?foreach($test_ClassMetaList->obj_arr as $key3 => $value3_ClassMeta):?>
                            <option value="<?=$value3_ClassMeta->classid?>"><?=$value3_ClassMeta->classname?></option>
                            <?endforeach?>
                        </select>
                    <?endforeach?>
                    </span>
                </div>
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineLeft width500">
                <span class="gray">請選擇二級分類及分類標籤，多種分類可以重複選取</span>
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
                商品簡介
            </div>
            <div class="spanLineLeft width500">
                <textarea cols="80" id="synopsis" name="synopsis" rows="10"><?=$showpiece_Showpiece->synopsis?></textarea>
		    </div>
		</div>
	</div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                商品內容
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
                <textarea cols="80" id="content" name="content" rows="10"><?=$showpiece_Showpiece->content_Html?></textarea>
            </div>
            <div class="spanLineLeft">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                商品規格
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
                <textarea cols="80" id="content_specification" name="content_specification" rows="10"><?=$showpiece_Showpiece->content_specification_Html?></textarea>
            </div>
            <div class="spanLineLeft">
            </div>
        </div>
    </div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                優先排序指數
            </div>
            <div class="spanLineLeft">
                <input type="number" class="text width100" name="prioritynum" value="<?=$showpiece_Showpiece->prioritynum?>">
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
    <?if(!empty($showpiece_Showpiece->showpieceid)):?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                更新日期
            </div>
            <div class="spanLineLeft">
                <?=$showpiece_Showpiece->updatetime_DateTime->datetime?>
            </div>
        </div>
    </div>
    <?endif?>
	<div class="spanLine spanSubmit">
	    <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <?if(!empty($showpiece_Showpiece->showpieceid)):?><input type="hidden" name="showpieceid" value="<?=$showpiece_Showpiece->showpieceid?>"><?endif?>
                <input type="submit" class="submit" value="<?if(!empty($showpiece_Showpiece->showpieceid)):?>儲存變更<?else:?>新增商品<?endif?>">
                <?if(!empty($showpiece_Showpiece->showpieceid)):?><span class="submit gray" onClick="fanswoo.check_href_action('刪除後將進入回收空間，確定要刪除嗎？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?showpieceid=<?=$showpiece_Showpiece->showpieceid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除<?=$child3_title?></span><?endif?>
            </div>
        </div>
	</div>
	</form>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>