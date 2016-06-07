<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title?> - <?=$child3_title?></h2>
<div class="contentBox allWidth">
    <h3><?=$child3_title?> > <?if(!empty($Advertising->advertisingid)):?>編輯<?else:?>新增<?endif?></h3>
    <h4>請填寫<?=$child3_title?>之詳細資訊</h4>
    <?php echo form_open_multipart("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                廣告名稱
            </div>
            <div class="spanLineLeft width500">
                <input type="text" class="text" name="title" placeholder="請輸入廣告名稱" value="<?=$Advertising->title?>" required>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                二級分類
            </div>
            <div class="spanLineLeft width300">
                <?if(!empty($Advertising->class_ClassMetaList->obj_arr)):?>
                <div>
                    <select name="classids_arr[]">
                        <option value="">沒有分類標籤</option>
                        <?foreach($AdvertisingClassList->obj_arr as $key2 => $value2_AdvertisingClass):?>
                        <option value="<?=$value2_AdvertisingClass->classid?>"<?if($Advertising->class_ClassMetaList->obj_arr[0]->classid == $value2_AdvertisingClass->classid):?> selected<?endif?>><?=$value2_AdvertisingClass->classname?></option>
                        <?endforeach?>
                    </select>
                </div>
                <?else:?>
                <div>
                    <select name="classids_arr[]">
                        <option value="">沒有分類標籤</option>
                        <?foreach($AdvertisingClassList->obj_arr as $key => $value_AdvertisingClass):?>
                        <option value="<?=$value_AdvertisingClass->classid?>"><?=$value_AdvertisingClass->classname?></option>
                        <?endforeach?>
                    </select>
                </div>
                <?endif?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                廣告圖片
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
                    <?if(!empty($Advertising->pic_PicObjList->obj_arr)):?>
                    <?foreach($Advertising->pic_PicObjList->obj_arr as $key => $value_PicObj):?>
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
                廣告連結
            </div>
            <div class="spanLineLeft width500">
                <input type="text" class="text" name="href" placeholder="請輸入廣告連結位置" value="<?=$Advertising->href?>" required>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                廣告簡介
            </div>
            <div class="spanLineLeft width500">
                <textarea id="content" name="content" rows="10"><?=$Advertising->content_Html?></textarea>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                優先排序指數
            </div>
            <div class="spanLineLeft">
                <input type="number" class="text width100" name="prioritynum" value="<?=$Advertising->prioritynum?>">
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
    <?if(!empty($Advertising->advertisingid)):?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                更新日期
            </div>
            <div class="spanLineLeft">
                <?=$Advertising->updatetime_DateTime->datetime?>
            </div>
        </div>
    </div>
    <?endif?>
    <div class="spanLine spanSubmit">
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <?if(!empty($Advertising->advertisingid)):?><input type="hidden" name="advertisingid" value="<?=$Advertising->advertisingid?>"><?endif?>
                <input type="submit" class="submit" value="<?if(!empty($Advertising->advertisingid)):?>儲存變更<?else:?>新增廣告<?endif?>">
                <?if(!empty($Advertising->advertisingid)):?><span class="submit gray" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?advertisingid=<?=$Advertising->advertisingid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除<?=$child3_title?></span><?endif?>
            </div>
        </div>
    </div>
    </form>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>