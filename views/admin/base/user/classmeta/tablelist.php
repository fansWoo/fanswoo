<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title?> - <?=$child3_title?></h2>
<div class="contentBox contentTablelist allWidth">
    <h3><?=$child3_title?> > <?=$child4_title?></h3>
    <h4>請選擇欲修改之<?=$child3_title?></h4>
    <?if(0):?>
    <div class="spanLine noneBg">
        <div class="spanLineLeft">
            <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit" class="button">新增<?=$child3_title?></a>
        </div>
    </div>
    <?endif?>
    <div class="spanLineTable">
        <div class="spanLineTableContent">
            <div class="spanLine tablelist tableTitle">
                <div class="spanLineLeft text width200">
                    會員群組名稱
                </div>
                <div class="spanLineLeft text width150">
                    編輯操作
                </div>
            </div>
            <?if(!empty($UserGroupList->obj_arr)):?>
            <?foreach($UserGroupList->obj_arr as $key => $value_UserGroup):?>
            <div class="spanLine tablelist">
                <div class="spanLineLeft text width200">
                    <?=$value_UserGroup->groupname?>
                </div>
                <div class="spanLineLeft width150 tablelistMenu">
                    <a href="admin/<?=$child1_name?>/<?=$child2_name?>/user/tablelist/?group_groupid=<?=$value_UserGroup->groupid?>">查看會員</a>
                    <?if(0):?>
                    <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit/?groupid=<?=$value_UserGroup->groupid?>">編輯</a>
                    <span class="ahref" onClick="fanswoo.check_href_action('確定要刪除這個標籤？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?groupid=<?=$value_UserGroup->groupid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除</span>
                    <?endif?>
                </div>
            </div>
            <?endforeach?>
            <?else:?>
            <div class="spanLine">
                <div class="spanLineLeft text width500">
                    這個篩選條件沒有搜尋到結果，請選擇其它篩選條件
                </div>
            </div>
            <?endif?>
        </div>
    </div>
    <div class="pageLink"><?=$class_links?></div>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>