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
	<div class="spanLineTable">
        <div class="spanLineTableContent">
            <div class="spanLine tablelist tableTitle">
                <?if(!empty($ContactList->obj_arr)):?>
                <div class="spanLineLeft checkbox"></div>
                <?endif?>
                <div class="spanLineLeft text width100">
        			聯繫單ID
                </div>
                <div class="spanLineLeft text width200">
        			聯絡人姓名
                </div>
                <div class="spanLineLeft text width150">
                    處理狀態
                </div>
                <div class="spanLineLeft text width150">
                    聯繫日期
                </div>
                <div class="spanLineLeft text width100">
                    編輯操作
                </div>
        	</div>
            <div class="spanLine tablelist">
                <?php echo form_open("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
                    <?if(!empty($ContactList->obj_arr)):?>
                    <div class="spanLineLeft checkbox">
                        <input type="checkbox" id="check_all">
                    </div>
                    <?endif?>
                    <div class="spanLineLeft text width100">
                        <input type="number" class="text" style="margin-left:-6px;" value="<?=!empty($search_contactid)?$search_contactid:''?>" name="search_contactid" placeholder="請填寫ID">
                    </div>
                    <div class="spanLineLeft text width200">
                        <input type="text" class="text" style="margin-left:-6px;" value="<?=!empty($search_username)?$search_username:''?>" name="search_username" placeholder="請填寫姓名">
                    </div>
                    <div class="spanLineLeft text width150" style="margin-left:-6px;">
                        <select name="search_status_process">
                            <option value="">不篩選</option>
                            <option value="1"<?if($search_status_process == 1):?> selected<?endif?>>未處理</option>
                            <option value="2"<?if($search_status_process == 2):?> selected<?endif?>>已處理</option>
                        </select>
                    </div>
                    <div class="spanLineLeft text width150" style="margin-left:6px;">
                        聯繫日期
                    </div>
                    <div class="spanLineLeft text width100">
                        <input type="submit" class="button filter" value="篩選">
                    </div>
                </form>
            </div>
            <?if(!empty($ContactList->obj_arr)):?>
            <?php echo form_open("admin/$child1_name/$child2_name/$child3_name/delete_batch_post/") ?>
            <?foreach($ContactList->obj_arr as $key => $value_Contact):?>
            <div class="spanLine tablelist">
                <div class="spanLineLeft checkbox">
                    <input type="checkbox" name="contactid_arr[]" value="<?=$value_Contact->contactid?>" class="check">
                </div>
                <div class="spanLineLeft text width100">
                    <?=$value_Contact->contactid?>
                </div>
                <div class="spanLineLeft text width200">
                    <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit/?contactid=<?=$value_Contact->contactid?>"><?=$value_Contact->username?></a>
                </div>
                <div class="spanLineLeft text width150">
                    <?if($value_Contact->status_process == 1):?>
                    未處理
                    <?elseif($value_Contact->status_process == 2):?>
                    已處理
                    <?endif?>
                </div>
                <div class="spanLineLeft text width150">
                    <?=$value_Contact->updatetime_DateTime->datetime?>
                </div>
                <div class="spanLineLeft width100 tablelistMenu">
                    <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit/?contactid=<?=$value_Contact->contactid?>">編輯</a>
                    <span class="ahref" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?contactid=<?=$value_Contact->contactid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除</span>
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
    <?if(!empty($ContactList->obj_arr[0]->contactid)):?>
    <div class="batch_deletion">
        <input type="button" class="button" id="delete" style="height: 32px;" value="刪除聯繫單">
    </div>
    <?endif?>
    <div class="pageLink"><?=$$contact_links?></div>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>