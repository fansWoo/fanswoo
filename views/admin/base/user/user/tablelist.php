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
                <?if(!empty($user_UserList->obj_arr)):?>
                <div class="spanLineLeft checkbox"></div>
                <?endif?>
                <div class="spanLineLeft text width100">
                    會員ID
                </div>
                <div class="spanLineLeft text width200">
                    會員名稱
                </div>
                <div class="spanLineLeft text width300">
                    電子郵件帳號
                </div>
                <div class="spanLineLeft text width150">
                    會員群組
                </div>
                <div class="spanLineLeft text width100">
                    編輯操作
                </div>
            </div>
            <div class="spanLine tablelist">
                <?php echo form_open("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
                    <?if(!empty($user_UserList->obj_arr)):?>
                    <div class="spanLineLeft checkbox">
                        <input type="checkbox" id="check_all">
                    </div>
                    <?endif?>
                    <div class="spanLineLeft text width100">
                        <input type="number" class="text" style="margin-left:-6px;" min="0" value="<?=!empty($search_uid)?$search_uid:''?>" name="search_uid" placeholder="請填寫ID">
                    </div>
                    <div class="spanLineLeft text width200">
                        <input type="text" class="text" style="margin-left:-6px;" value="<?=!empty($search_username)?$search_username:''?>" name="search_username" placeholder="請填寫會員名稱">
                    </div>
                    <div class="spanLineLeft text width300">
                        <input type="text" class="text" style="margin-left:-6px;" value="<?=!empty($search_email)?$search_email:''?>" name="search_email" placeholder="請填寫會員電子郵件帳號">
                    </div>
                    <div class="spanLineLeft text width150">
                        <select name="search_group_groupid" style="margin-left:-6px;">
                            <option value="">不透過分類標籤篩選</option>
                            <?foreach($UserGroupList->obj_arr as $key => $value_UserGroup):?>
                            <option value="<?=$value_UserGroup->groupid?>"<?if(!empty($search_group_groupid) && $search_group_groupid == $value_UserGroup->groupid) echo ' selected'?>><?=$value_UserGroup->groupname?></option>
                            <?endforeach?>
                        </select>
                    </div>
                    <div class="spanLineLeft text width100">
                        <input type="submit" class="button filter" value="篩選">
                    </div>
                </form>
            </div>
            <?if(!empty($user_UserList->obj_arr)):?>
            <?php echo form_open("admin/$child1_name/$child2_name/$child3_name/delete_batch_post/") ?>
            <?foreach($user_UserList->obj_arr as $key => $value_User):?>
            <div class="spanLine tablelist">
                <div class="spanLineLeft checkbox">
                    <input type="checkbox" name="uid_arr[]" value="<?=$value_User->uid?>" class="check">
                </div>
                <div class="spanLineLeft text width100">
                    <?=$value_User->uid?>
                </div>
                <div class="spanLineLeft text width200">
                    <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit/?uid=<?=$value_User->uid?>"><?=$value_User->username?></a>
                </div>
                <div class="spanLineLeft text width300">
                    <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit/?uid=<?=$value_User->uid?>"><?=$value_User->email?></a>
                </div>
                <div class="spanLineLeft text width150">
                    <?if(!empty($value_User->group_UserGroupList->obj_arr)):?>
                    <?foreach($value_User->group_UserGroupList->obj_arr as $key => $value_UserGroup):?>
                        <?if($key !== 0):?>,<?endif?><?=$value_UserGroup->groupname?>
                    <?endforeach?>
                    <?else:?>
                    <span class="gray">沒有分類標籤</span>
                    <?endif?>
                </div>
                <div class="spanLineLeft width100 tablelistMenu">
                    <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit/?uid=<?=$value_User->uid?>">編輯</a>
                    <span class="ahref" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?uid=<?=$value_User->uid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除</span>
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
    <?if(!empty($user_UserList->obj_arr[0]->uid)):?>
    <div class="batch_deletion">
        <input type="button" class="button" id="delete" style="height: 32px;" value="批量刪除">
    </div>
    <?endif?>
    <div class="pageLink"><?=$product_links?></div>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>