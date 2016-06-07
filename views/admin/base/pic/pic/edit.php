<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title?> - <?=$child3_title?></h2>
<div class="contentBox allWidth">
	<h3><?=$child3_title?> > <?if(!empty($PicObj->picid)):?>編輯<?else:?>新增<?endif?></h3>
    <h4>請填寫<?=$child3_title?>之詳細資訊</h4>
    <?php echo form_open_multipart("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/")?>
    <?if(!empty($PicObj->picid)):?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                圖片標題
            </div>
            <div class="spanLineLeft">
                <?=$PicObj->title?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                圖片擁有人
            </div>
            <div class="spanLineLeft">
                <?=$PicObj->uid_User->email?>
            </div>
        </div>
    </div>
    <?endif?>
    <?if(empty($PicObj->picid)):?>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                圖片上傳
            </div>
            <div class="spanLineLeft width500">
                <div fanswoo-pic_upload_ajax>上傳更多圖片</div>
                <div class="picidUploadList" fanswoo-piclist>
                    <div fanswoo-picid class="picidUploadLi" fanswoo-clone>
                        <div class="pic"><img src="" fanswoo-picid_img></div>
                        <div class="other">
                            <div class="pic_copy"><input type="text" fanswoo-input_copy readonly /></div>
                            <div fanswoo-pic_delete class="pic_delete">刪除圖片</div>
                        </div>
                        <input type="hidden" fanswoo-picid_input_hidden_picid name="picids_arr[]">
                    </div>
                </div>
		    </div>
		</div>
	</div>
    <?else:?>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                圖片預覽
            </div>
            <div class="spanLineLeft width500">
                <img style="max-width:500px;" src="<?if(!empty($PicObj->path_arr['w0h0'])):?><?=$PicObj->path_arr['w0h0']?><?endif?>">
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                圖片網址
            </div>
            <div class="spanLineLeft width500">
                <input type="text" value="<?=$PicObj->path_arr['w0h0']?>" fanswoo-input_copy readonly style="width:95%;">
                <br>
                <a href="<?=$PicObj->path_arr['w0h0']?>" target="_blank">
                    <?=$PicObj->path_arr['w0h0']?>
                </a>
		    </div>
		</div>
	</div>
    <?endif?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                分類標籤
            </div>
            <div class="spanLineLeft width300">
                <?if(!empty($PicObj->class_ClassMetaList->obj_arr)):?>
                <div>
                    <select name="classids_arr[]">
                        <option value="">沒有分類標籤</option>
                        <?foreach($ClassMetaList->obj_arr as $key2 => $value2_ClassMeta):?>
                        <option value="<?=$value2_ClassMeta->classid?>"<?if($PicObj->class_ClassMetaList->obj_arr[0]->classid == $value2_ClassMeta->classid):?> selected<?endif?>><?=$value2_ClassMeta->classname?></option>
                        <?endforeach?>
                    </select>
                </div>
                <?else:?>
                <div>
                    <select name="classids_arr[]">
                        <option value="">沒有分類標籤</option>
                        <?foreach($ClassMetaList->obj_arr as $key => $value_ClassMeta):?>
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
                <a href="admin/<?=$child1_name?>/<?=$child2_name?>/album/tablelist">管理分類標籤</a>
            </div>
        </div>
    </div>
    <?if(!empty($PicObj->picid)):?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                更新日期
            </div>
            <div class="spanLineLeft">
                <?=$PicObj->updatetime_DateTime->datetime?>
            </div>
        </div>
    </div>
    <?endif?>
	<div class="spanLine spanSubmit">
	    <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <?if(!empty($PicObj->picid)):?><input type="hidden" name="picid" value="<?=$PicObj->picid?>"><?endif?>
                <input type="submit" class="submit" value="儲存變更">
                <?if(!empty($PicObj->picid)):?><span class="submit gray" onClick="fanswoo.check_href_action('刪除後將進入回收空間，確定要刪除嗎？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?picid=<?=$PicObj->picid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除<?=$child3_title?></span><?endif?>
            </div>
        </div>
	</div>
	</form>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>