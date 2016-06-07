<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title?> - <?=$child3_title?></h2>
<div class="contentBox allWidth">
    <h3><?=$child3_title?> > <?if(!empty($FileObj->fileid)):?>編輯<?else:?>新增<?endif?></h3>
	<h4>請填寫<?=$child3_title?>之詳細資訊</h4>
    <?php echo form_open_multipart("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
    <?if(empty($FileObj->fileid)):?>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                檔案上傳
            </div>
            <div class="spanLineLeft width500">
                <div fanswoo-file_upload_ajax>上傳更多檔案</div>
                <div class="fileidUploadList" fanswoo-filelist>
                    <div fanswoo-fileid class="fileidUploadLi" fanswoo-clone>
                        <div class="other">
                            <div class="file_copy"><input type="text" fanswoo-input_copy readonly /></div>
                            <div fanswoo-file_delete class="file_delete">刪除檔案</div>
                        </div>
                        <input type="hidden" fanswoo-fileid_input_hidden_fileid name="fileids_arr[]">
                    </div>
                </div>
		    </div>
		</div>
	</div>
    <?else:?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                檔案標題
            </div>
            <div class="spanLineLeft">
                <?=$FileObj->title?>
            </div>
        </div>
    </div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                檔案網址
            </div>
            <div class="spanLineLeft width500">
                <input type="text" style="width:450px;" value="<?=$FileObj->download_file_path?>" fanswoo-input_copy readonly>
                <br>
                <a href="<?=$FileObj->download_file_path?>">
                    下載檔案
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
                <?if(!empty($FileObj->class_ClassMetaList->obj_arr)):?>
                <div>
                    <select name="classids_arr[]">
                        <option value="">沒有分類標籤</option>
                        <?foreach($ClassMetaList->obj_arr as $key2 => $value2_ClassMeta):?>
                        <option value="<?=$value2_ClassMeta->classid?>"<?if($FileObj->class_ClassMetaList->obj_arr[0]->classid == $value2_ClassMeta->classid):?> selected<?endif?>><?=$value2_ClassMeta->classname?></option>
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
                <a href="admin/<?=$child1_name?>/<?=$child2_name?>/classmeta/tablelist">管理分類標籤</a>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                會員檔案下載權限
            </div>
            <div class="spanLineLeft width500">
                <textarea name="permission_emails"><?if($FileObj->permission_uids_UserList->obj_arr):?><?foreach( $FileObj->permission_uids_UserList->obj_arr as $key => $value_User ):?><?=$value_User->email?>

<?endforeach?><?endif?></textarea>
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineLeft width500">
                <span class="gray">請填寫擁有檔案下載權限之會員email帳號，每個email帳號一行</span>
            </div>
        </div>
    </div>
    <?if(!empty($FileObj->fileid)):?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                更新日期
            </div>
            <div class="spanLineLeft">
                <?=$FileObj->updatetime_DateTime->datetime?>
            </div>
        </div>
    </div>
    <?endif?>
	<div class="spanLine spanSubmit">
	    <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <?if(!empty($FileObj->fileid)):?><input type="hidden" name="fileid" value="<?=$FileObj->fileid?>"><?endif?>
                <input type="submit" class="submit" value="儲存變更">
                <?if(!empty($FileObj->fileid)):?><span class="submit gray" onClick="fanswoo.check_href_action('刪除後將進入回收空間，確定要刪除嗎？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?fileid=<?=$FileObj->fileid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除<?=$child3_title?></span><?endif?>
            </div>
        </div>
	</div>
	</form>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>