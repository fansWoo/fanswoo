<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title_Str?> - <?=$child3_title_Str?></h2>
<div class="contentBox allWidth">
    <h3><?=$child3_title_Str?> > <?=$child4_title_Str?></h3>
    <h4>請選擇欲修改之<?=$child3_title_Str?></h4>
	<div class="spanLine noneBg">
        <div class="spanLineLeft">
            <a href="admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/edit" class="button">新增<?=$child3_title_Str?></a>
        </div>
        <div class="spanLineRight width300">
            <input type="text" class="floatright text" id="search" name="search" placeholder="請輸入想要搜尋的檔案標題" style="display:none;">
        </div>
	</div>
	<div class="spanLine tableTitle">
        <div class="spanLineLeft text width100">
			檔案ID
        </div>
        <div class="spanLineLeft text width300">
			檔案標題
        </div>
        <div class="spanLineLeft text width150">
            分類標籤
        </div>
	</div>
    <?php echo form_open("admin/$child1_name_Str/$child2_name_Str/$child3_name_Str/{$child4_name_Str}_post/") ?>
        <div class="spanLine">
            <div class="spanLineLeft text width100">
                <input type="text" class="text" style="margin-left:-6px;" value="<?=!empty($search_fileid_Num)?$search_fileid_Num:''?>" name="search_fileid_Num" placeholder="請填寫id">
            </div>
            <div class="spanLineLeft text width300">
                <input type="text" class="text" style="margin-left:-6px;" value="<?=!empty($search_title_Str)?$search_title_Str:''?>" name="search_title_Str" placeholder="請填寫標籤名稱">
            </div>
            <div class="spanLineLeft text width150">
                <select name="search_class_slug_Str" style="margin-left:-6px;">
                    <option value="">不透過分類標籤篩選</option>
                    <?foreach($file_ClassMetaList->obj_Arr as $key => $value_ClassMeta):?>
                    <option value="<?=$value_ClassMeta->slug_Str?>"<?if(!empty($search_class_slug_Str) && $search_class_slug_Str == $value_ClassMeta->slug_Str) echo ' selected'?>><?=$value_ClassMeta->classname_Str?></option>
                    <?endforeach?>
                </select>
            </div>
            <div class="spanLineLeft text width150">
                <input type="submit" class="button" style="height: 30px; margin-left:-6px;" value="篩選">
            </div>
        </div>
    </form>
    <?if(!empty($filelist_FileList->obj_Arr[0]->fileid_Num)):?>
    <?foreach($filelist_FileList->obj_Arr as $key => $value_File):?>
    <div class="spanLine">
        <div class="spanLineLeft text width100">
            <?=$value_File->fileid_Num?>
        </div>
        <div class="spanLineLeft text width300">
            <a href="admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/edit/?fileid=<?=$value_File->fileid_Num?>"><?=$value_File->title_Str?></a>
        </div>
        <div class="spanLineLeft text width150">
            <?if(!empty($value_File->class_ClassMetaList) && !empty($value_File->class_ClassMetaList->obj_Arr)):?>
            <?foreach($value_File->class_ClassMetaList->obj_Arr as $key => $value2_ClassMeta):?>
                <?if($key !== 0):?>,<?endif?><?=$value2_ClassMeta->classname_Str?>
            <?endforeach?>
            <?else:?>
            <span class="gray">沒有分類標籤</span>
            <?endif?>
        </div>
        <div class="spanLineLeft width150 hoverHidden">
            <a href="admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/edit/?fileid=<?=$value_File->fileid_Num?>">編輯</a>
            <span class="ahref" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/delete/?fileid=<?=$value_File->fileid_Num?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除</span>
        </div>
	</div>
    <?endforeach?>
    <div class="pageLink"><?=$file_links?></div>
    <?else:?>
    <div class="spanLine">
        <div class="spanLineLeft text width300">
            這個篩選條件沒有搜尋到結果，請選擇其它篩選條件
        </div>
    </div>
    <?endif?>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>