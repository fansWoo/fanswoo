<?=$temp['header_up']?>
<script>
Temp.ready(function(){
    $(document).on('click', ':button#delete', function(event){
        if( confirm('刪除後將進入回收空間，確定要刪除嗎？') )
        {
            $(':submit#delete').click();
        }
    });
});
</script>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2>分類標籤管理 - 圖片列表</h2>
<div class="contentBox contentTablelist allWidth">
	<h3>圖片列表</h3>
	<h4>請填寫欲新增、編輯或刪除之圖片</h4>
	<div class="spanLine noneBg">
        <div class="spanLineLeft">
            <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit" class="button">新增<?=$child3_title?></a>
        </div>
	</div>
	<div class="spanLineTable">
        <div class="spanLineTableContent">
            <div class="spanLine tablelist tableTitle">
                <div class="spanLineLeft text width100">
        			圖片ID
                </div>
                <div class="spanLineLeft text width400">
        			圖片標題
                </div>
                <div class="spanLineLeft text width150">
                    擁有人
                </div>
                <div class="spanLineLeft text width150">
                    分類標籤
                </div>
                <div class="spanLineLeft text width150">
                    編輯操作
                </div>
        	</div>
            <div class="spanLine tablelist">
                <?php echo form_open("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
                    <div class="spanLineLeft text width100">
                        <input type="text" class="text" style="margin-left:-6px;" value="<?=!empty($search_picid)?$search_picid:''?>" name="search_picid" placeholder="請填寫ID">
                    </div>
                    <div class="spanLineLeft text width400">
                        <input type="text" class="text" style="margin-left:-6px;" value="<?=!empty($search_title)?$search_title:''?>" name="search_title" placeholder="請填寫圖片標題">
                    </div>
                    <div class="spanLineLeft text width150">
                    <?if($usergroupid_UserGroup >= 100):?>
                        會員名稱
                    <?else:?>
                        <input type="text" class="text" value="<?=!empty($search_uid)?$search_uid:''?>" name="search_uid" placeholder="請填寫會員ID">
                    <?endif?>
                    </div>
                    <div class="spanLineLeft text width150">
                        <select name="search_class_slug" style="margin-left:-6px;">
                            <option value="">不透過分類標籤篩選</option>
                            <!-- <option value="hidden"<?if(!empty($search_class_slug) && $search_class_slug == 'hidden') echo ' selected'?>>完全隱藏的圖片</option> -->
                            <option value="unclassified"<?if(!empty($search_class_slug) && $search_class_slug == 'unclassified') echo ' selected'?>>尚未分類的圖片</option>
                            <?foreach($pic_ClassMetaList->obj_arr as $key => $value_ClassMeta):?>
                            <option value="<?=$value_ClassMeta->slug?>"<?if(!empty($search_class_slug) && $search_class_slug == $value_ClassMeta->slug) echo ' selected'?>><?=$value_ClassMeta->classname?></option>
                            <?endforeach?>
                        </select>
                    </div>
                    <div class="spanLineLeft text width150">
                        <input type="submit" class="button" style="height: 30px;" value="篩選">
                    </div>
                </form>
            </div>
            <?if(!empty($piclist_PicList->obj_arr[0]->picid)):?>
            <?php echo form_open("admin/$child1_name/$child2_name/$child3_name/delete_batch_post/") ?>
            <div class="spanLineTable">
                <div class="spanLine pic">
                    <?foreach($piclist_PicList->obj_arr as $key => $value_Pic):?>
                        <div class="pic_block">
                            <input type="checkbox" class="pic_check" name="picid_arr[]" value="<?=$value_Pic->picid?>">
                            <div class="hover_box">
                                <div class="picid"><span><?=$value_Pic->picid?></span></div>
                                <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit/?picid=<?=$value_Pic->picid?>">編輯</a>
                            </div>
                            <img src="<?=$value_Pic->path_arr[w0h0]?>" class="piclist"></img>
                        </div>
                    <?endforeach?>
                </div>
            </div>
            <input type="submit" id="delete" class="button" style="display:none;">
            </form>
            <?else:?>
            <div class="spanLine">
                <div class="spanLineLeft text width500">
                    這個篩選條件沒有搜尋到結果，請選擇其它篩選條件
                </div>
            </div>
            <?endif?>
        </div>
    </div>
    <?if(!empty($piclist_PicList->obj_arr[0]->picid)):?>
    <div class="batch_deletion">
        <input type="button" class="button" id="delete" style="height: 32px;" value="批量刪除">
    </div>
    <?endif?>
    <div class="pageLink"><?=$pic_links?></div>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>