<?=$temp['header_up']?>
<script>
Temp.ready(function(){
    // AJAX物件讀取
    var search_ajax = function()
    {
        Temp.note_User = new ObjDbBase({
            obj_var: 'note_User',
            obj_class: 'User',
            db_where_arr: [
                { field: 'username', value: $("[name='search_username']").val() }
            ]
        });
        // fanswoo.message_show(
        //     '資料讀取中...',
        //     1
        // );
        Temp.search_shelves_status = $("[name='search_shelves_status']").val();
        $.when( Temp.note_User.deferred ).done(function(){
            Temp.NoteList = new ObjList({
                obj_var: 'NoteList',
                obj_class: 'NoteField',
                temp_ajax_selector: '#note_tablelist',
                db_where_arr: [
                    { field: 'note.noteid', value: $("[name='search_noteid']").val() },
                    { field: 'note.classids', value: $("[name='search_class_classid']").val() },
                    { field: 'note.shelves_status', value: Temp.search_shelves_status },
                    { field: 'note.uid', value: Temp.note_User.uid }
                ],
                db_where_like_arr: [
                    { field: 'note.title', value: $("[name='search_title']").val() }
                ],
                db_where_deletenull_bln: 'TRUE',
                limitstart: 0,
                limitcount: 10
            });
        });
    }
    //每 5 秒重新讀取一次 AJAX 物件
    search_time = setInterval(search_ajax, 5000);
    //每次輸入框輸入字元，就讀取一次 AJAX 物件
    $(document).on('keyup', "[name='search_title'], [name='search_noteid'], [name='search_username']", function(){
        search_ajax();
    });
    //每次輸入框內的值變動，就讀取一次 AJAX 物件
    $(document).on('change', "[name='search_class_classid'], [name='search_shelves_status']", function(){
        search_ajax();
    });

    // $("a[href^='admin/base/note/note/edit']").temp_load_page({
    //     url: 'admin/base/note/note/edit',
    //     now_body_animate: 'temp_page_load_animate',
    //     next_body_animate: 'temp_page_load_animate',
    //     func: function(){
    //         clearInterval(search_time);
    //     }
    // });

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
<h2>{{child2_title}} - {{child3_title}}</h2>
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
                <?if(!empty($NoteList->obj_arr)):?>
                <div class="spanLineLeft checkbox"></div>
                <?endif?>
                <div class="spanLineLeft text width100">
                    文章ID
                </div>
                <div class="spanLineLeft text width300">
                    文章標題
                </div>
                <div class="spanLineLeft text width150">
                    擁有人
                </div>
                <div class="spanLineLeft text width150">
                    文章分類標籤
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
                    <div class="spanLineLeft text width150">
                    <?if($usergroupid_UserGroup >= 100):?>
                        會員名稱
                    <?else:?>
                        <input type="text" class="text" style="margin-left:-6px;" value="<?=!empty($search_uid)?$search_uid:''?>" name="search_uid" placeholder="請填寫會員ID">
                    <?endif?>
                    </div>
                    <div class="spanLineLeft text width150">
                        <select name="search_class_classid" style="margin-left:-6px;">
                            <option value="">不透過分類標籤篩選</option>
                            <?foreach($NoteClassMetaList->obj_arr as $key => $value_ClassMeta):?>
                            <option value="<?=$value_ClassMeta->classid?>"<?if(!empty($search_class_classid) && $search_class_classid == $value_ClassMeta->classid) echo ' selected'?>><?=$value_ClassMeta->classname?></option>
                            <?endforeach?>
                        </select>
                    </div>
                    <div class="spanLineLeft text width100">
                        <select name="search_shelves_status" style="min-width:85px;">
                            {{#when search_shelves_status '==' 1}}
                            <option value="1" selected>已發表</option>
                            {{else}}
                            <option value="1">已發表</option>
                            {{/when}}
                            {{#when search_shelves_status '==' 2}}
                            <option value="2" selected>未發表</option>
                            {{else}}
                            <option value="2">未發表</option>
                            {{/when}}
                        </select>
                    </div>
                    <div class="spanLineLeft text width100">
                        <input type="submit" class="button filter" value="篩選">
                    </div>
                </form>
            </div>
            <div id="note_tablelist">
            {{#if NoteList.obj_arr.0.noteid}}
            <?php echo form_open("admin/$child1_name/$child2_name/$child3_name/delete_batch_post/") ?>
                {{#each NoteList.obj_arr}}
                <div class="spanLine tablelist">
                    <div class="spanLineLeft checkbox">
                        <input type="checkbox" name="noteid_arr[]" value="{{this.noteid}}" class="check">
                    </div>
                    <div class="spanLineLeft text width100">
                        {{this.noteid}}
                    </div>
                    <div class="spanLineLeft text width300">
                        <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit/?noteid={{this.noteid}}">{{this.title}}</a>
                    </div>
                    <div class="spanLineLeft text width150">
                        {{this.uid_User.username}}
                    </div>
                    <div class="spanLineLeft text width150">
                        {{#if this.class_ClassMetaList.obj_arr.0.classid}}
                            {{#each this.class_ClassMetaList.obj_arr}}
                                {{#if key}},{{else}}{{this.classname}}{{/if}}
                            {{/each}}
                        {{else}}
                            <span class="gray">沒有分類標籤</span>
                        {{/if}}
                    </div>
                    <div class="spanLineLeft text width100">
                        {{#when this.shelves_status '==' 1}}
                        已發表
                        {{else}}
                        未發表
                        {{/when}}
                    </div>
                    <div class="spanLineLeft width100 tablelistMenu">
                        <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit/?noteid={{this.noteid}}">編輯</a>
                        <span class="ahref" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?noteid={{this.noteid}}&hash=<?=$this->security->get_csrf_hash()?>');">刪除</span>
                    </div>
                </div>
                {{/each}}
            <input type="submit" id="delete" class="button" style="display:none;">
            </form>
            {{else}}
                <div class="spanLine">
                    <div class="spanLineLeft text width500">
                        這個篩選條件沒有搜尋到結果，請選擇其它篩選條件
                    </div>
                </div>
            {{/if}}
            </div>
        </div>
    </div>
    <?if(!empty($NoteList->obj_arr[0]->noteid)):?>
    <div class="batch_deletion">
        <input type="button" class="button" id="delete" style="height: 32px;" value="批量刪除">
    </div>
    <?endif?>
    <div class="pageLink"><?=$page_link?></div>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>