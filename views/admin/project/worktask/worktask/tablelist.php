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
<h2><?=$child2_title?> - <?=$child3_title?></h2>
<div class="contentBox contentTablelist allWidth">
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
                <?if(!empty($WorktaskList->obj_arr)):?>
                <div class="spanLineLeft checkbox"></div>
                <?endif?>
                <div class="spanLineLeft text width200">
                    問題標題
                </div>
                <div class="spanLineLeft text width180">
                    專案名稱
                </div>
                <div class="spanLineLeft text width150">
                    任務執行人
                </div>
                <div class="spanLineLeft text width150">
                    目前狀態
                </div>
                
                <div class="spanLineLeft text width150">
                    工作分類
                </div>
                <div class="spanLineLeft text width150">
                    編輯操作
                </div>
            </div>
            <div class="spanLine tablelist">
                <?php echo form_open("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
                    <?if(!empty($WorktaskList->obj_arr)):?>
                    <div class="spanLineLeft checkbox">
                        <input type="checkbox" id="check_all">
                    </div>
                    <?endif?>
                    <div class="spanLineLeft text width200">
                        <input type="text" class="text" style="margin-left:-6px;" value="<?=!empty($search_title)?$search_title:''?>" name="search_title" placeholder="請填寫問題標題">
                    </div>
                    <div class="spanLineLeft text width180">
                        <select name="search_projectid" style="margin-left:-6px;">
                            <option value="">不透過分類標籤篩選</option>
                            <?foreach($ProjectList->obj_arr as $key2 => $value_Project):?>
                            <option value="<?=$value_Project->projectid?>"<?if(!empty($search_projectid) && $search_projectid == $value_Project->projectid) echo ' selected'?>><?=$value_Project->name?></option>
                            <?endforeach?>
                        </select>
                    </div>
                    <div class="spanLineLeft text width150">
                        <select name="search_pemission_uid" style="margin-left:-6px;">
                            <option value="unselected">不透過分類標籤篩選</option>
                            <?foreach($permission_UserList->obj_arr as $key => $value_User):?>
                            <option value="<?=$value_User->uid?>"<?if(!empty($search_pemission_uid) && $search_pemission_uid == $value_User->uid):?> selected<?endif?>><?=$value_User->username?></option>
                            <?endforeach?>
                        </select>
                    </div>
                    <div class="spanLineLeft text width150">
                        <select name="search_work_status" style="min-width:110px;">
                            <option value="unselected"<?if( empty($search_work_status) ):?> selected<?endif?>>未選擇狀態</option>
                            <option value="0"<?if( isset($search_work_status) && $search_work_status == 0):?> selected<?endif?>>任務未完成</option>
                            <option value="1"<?if( isset($search_work_status) && $search_work_status == 1):?> selected<?endif?>>主管檢核中</option>
                            <option value="2"<?if( isset($search_work_status) && $search_work_status == 2):?> selected<?endif?>>主管審核通過</option>
                        </select>
                    </div>
                    <div class="spanLineLeft text width150">
                        <select name="search_class_slug" style="margin-left:-6px;">
                            <option value="">不透過分類標籤篩選</option>
                            <?foreach($WorktaskClassMetaList->obj_arr as $key => $value_ClassMeta):?>
                            <option value="<?=$value_ClassMeta->slug?>"<?if(!empty($search_class_slug) && $search_class_slug == $value_ClassMeta->slug) echo ' selected'?>><?=$value_ClassMeta->classname?></option>
                            <?endforeach?>
                        </select>
                    </div>
                    <div class="spanLineLeft text width150">
                        <input type="submit" class="button" style="height: 30px;" value="篩選">
                    </div>
                </form>
            </div>
            <?if(!empty($WorktaskList->obj_arr)):?>
            <?php echo form_open("admin/$child1_name/$child2_name/$child3_name/delete_batch_post/") ?>
            <?foreach($WorktaskList->obj_arr as $key => $value_Worktask):?>
            <div class="spanLine tablelist">
                <div class="spanLineLeft checkbox">
                    <input type="checkbox" name="worktaskid_arr[]" value="<?=$value_Worktask->worktaskid?>" class="check">
                </div>
                <div class="spanLineLeft text width200">
                    <a class="<?if($value_Worktask->work_status == 1):?> green<?elseif($value_Worktask->work_status == 2):?> gray<?elseif($value_Worktask->work_status == 0):?> red<?endif?>" href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit/?worktaskid=<?=$value_Worktask->worktaskid?>"><?=$value_Worktask->title?></a>
                </div>
                <div class="spanLineLeft text width180">
                    <?=$value_Worktask->project_ProjectList->obj_arr[0]->name?>
                </div>
                <div class="spanLineLeft text width150">
                    <?=$value_Worktask->uid_User->username?>
                </div>
                <div class="spanLineLeft text width150">
                    <?if($value_Worktask->work_status == 1):?>
                    <span class="green">主管檢核中</span>
                    <?elseif($value_Worktask->work_status == 2):?>
                    <span class="gray">主管審核通過</span>
                    <?elseif($value_Worktask->work_status == 0):?>
                    <span class="red">未完成</span>
                    <?endif?>
                </div>
                <div class="spanLineLeft text width150">
                    <?if(!empty($value_Worktask->class_ClassMetaList->obj_arr)):?>
                    <?foreach($value_Worktask->class_ClassMetaList->obj_arr as $key => $value_ClassMeta):?>
                        <?if($key !== 0):?>,<?endif?><?=$value_ClassMeta->classname?>
                    <?endforeach?>
                    <?else:?>
                    <span class="gray">沒有分類標籤</span>
                    <?endif?>
                </div>
                <div class="spanLineLeft width150 tablelistMenu">
                    <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit/?worktaskid=<?=$value_Worktask->worktaskid?>">編輯</a>
                    <span class="ahref" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?worktaskid=<?=$value_Worktask->worktaskid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除</span>
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
    <?if(!empty($WorktaskList->obj_arr[0]->worktaskid)):?>
    <div class="batch_deletion">
        <input type="button" class="button" id="delete" style="height: 32px;" value="批量刪除">
    </div>
    <?endif?>
    <div class="pageLink"><?=$page_link?></div>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>