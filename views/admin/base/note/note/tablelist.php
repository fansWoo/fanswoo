<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<div class="contentBox contentTablelist allWidth">
    <h2><?=$child2_title?> - <?=$child3_title?></h2>
	<h3><?=$child3_title?> > <?=$child4_title?></h3>
	<h4>請選擇欲修改之<?=$child3_title?></h4>
	<div class="spanLine noneBg">
        <div class="spanLineLeft">
			<a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit" class="button">新增<?=$child3_title?></a>
        </div>
	</div>
    <div class="spanLineTable">
        <div class="spanLineTableContent">
        	<div class="spanLine tablelist tableTitle">
                <?if(!empty($NoteList->obj_arr)):?>
                <div class="spanLineLeft checkbox"></div>
                <?endif?>
                <div class="spanLineLeft text width100">
        			文章ID
                </div>
                <div class="spanLineLeft text width300">
        			文章標題
                </div>
                <div class="spanLineLeft text width200">
                    文章分類標籤
                </div>
                <div class="spanLineLeft text width150">
                    擁有人
                </div>
                <div class="spanLineLeft text width100">
                    文章發表狀態
                </div>
                <div class="spanLineLeft text width100">
                    編輯操作
                </div>
        	</div>
            <div class="spanLine tablelist">
                <?php echo form_open("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
                    <?if(!empty($NoteList->obj_arr)):?>
                    <div class="spanLineLeft checkbox">
                        <input type="checkbox" id="check_all">
                    </div>
                    <?endif?>
                    <div class="spanLineLeft text width100">
                        <input type="number" class="text" style="margin-left:-6px;" value="<?=!empty($search_noteid)?$search_noteid:''?>" name="search_noteid" placeholder="請填寫ID">
                    </div>
                    <div class="spanLineLeft text width300">
                        <input type="text" class="text" style="margin-left:-6px;" value="<?=!empty($search_title)?$search_title:''?>" name="search_title" placeholder="請填寫文章標題">
                    </div>
                    <div class="spanLineLeft text width200">
                        <select name="search_class_slug" style="margin-left:-6px;">
                            <option value="">不透過分類標籤篩選</option>
                            <?foreach($NoteClassMetaList->obj_arr as $key => $value_ClassMeta):?>
                            <option value="<?=$value_ClassMeta->slug?>"<?if(!empty($search_class_slug) && $search_class_slug == $value_ClassMeta->slug) echo ' selected'?>><?=$value_ClassMeta->classname?></option>
                            <?endforeach?>
                        </select>
                    </div>
                    <div class="spanLineLeft text width150">
                        <?if($UserGroup==100):?>
                            會員名稱
                        <?else:?>
                            <input type="text" class="text" style="margin-left:-6px;" value="<?=!empty($search_username)?$search_username:''?>" name="search_username" placeholder="請填寫擁有人完整名稱">
                        <?endif?>
                    </div>
                    <div class="spanLineLeft text width100">
                        <select name="search_shelves_status" style="min-width:50px; margin-left:-6px;">
                            <option value="1"<?if(!empty($search_shelves_status) && $search_shelves_status == 1):?>selected<?endif?>>已發表</option>
                            <option value="2"<?if(!empty($search_shelves_status) && $search_shelves_status == 2):?>selected<?endif?>>未發表</option>
                        </select>
                    </div>
                    <div class="spanLineLeft text width100">
                        <input type="submit" class="button filter" value="篩選">
                    </div>
                </form>
            </div>
            <?if(!empty($NoteList->obj_arr)):?>
            <?php echo form_open("admin/$child1_name/$child2_name/$child3_name/delete_batch_post/") ?>
            <?foreach($NoteList->obj_arr as $key => $value_Note):?>
            <div class="spanLine tablelist">
                <div class="spanLineLeft checkbox">
                    <input type="checkbox" name="noteid_arr[]" value="<?=$value_Note->noteid?>" class="check">
                </div>
                <div class="spanLineLeft text width100">
                    <?=$value_Note->noteid?>
                </div>
                <div class="spanLineLeft text width300">
                    <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit/?noteid=<?=$value_Note->noteid?>"><?=$value_Note->title?></a>
                </div>
                <div class="spanLineLeft text width200">
                    <?if(!empty($value_Note->class_ClassMetaList->obj_arr)):?>
                    <?foreach($value_Note->class_ClassMetaList->obj_arr as $key => $value_ClassMeta):?>
                        <?if($key !== 0):?>,<?endif?><?=$value_ClassMeta->classname?>
                    <?endforeach?>
                    <?else:?>
                    <span class="gray">沒有分類標籤</span>
                    <?endif?>
                </div>
                <div class="spanLineLeft text width150">
                    <?=$value_Note->uid_User->username?>
                </div>
                <div class="spanLineLeft text width100">
                    <?if($value_Note->shelves_status ==1 ):?>
                    已發表
                    <?else:?>
                    未發表
                    <?endif?>
                </div>
                <div class="spanLineLeft width100 tablelistMenu">
                    <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit/?noteid=<?=$value_Note->noteid?>">編輯</a>
                    <span class="ahref" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?noteid=<?=$value_Note->noteid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除</span>
                </div>
        	</div>
            <?endforeach?>
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
    <?if(!empty($NoteList->obj_arr[0]->noteid)):?>
    <div class="batch_deletion">
        <input type="button" class="button" id="delete" style="height: 32px;" value="批量刪除">
        <script>
        $(function(){
            $(document).on('click', ':button#delete', function(event){
                if( confirm('刪除後將進入回收空間，確定要刪除嗎？') )
                {
                    $(':submit#delete').click();
                }
            });
        });
        </script>
    </div>
    <?endif?>
    <div class="pageLink"><?=$page_link?></div>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>