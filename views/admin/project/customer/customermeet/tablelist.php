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
                <?if(!empty($CustomerMeetList->obj_arr)):?>
                <div class="spanLineLeft checkbox"></div>
                <?endif?>
                <div class="spanLineLeft text width100">
                    拜訪紀錄ID
                </div>
                <div class="spanLineLeft text width200">
                    公司名稱
                </div>         
                <div class="spanLineLeft text width150">
                    拜訪時間
                </div>
            </div>
            <div class="spanLine tablelist">
                <?php echo form_open("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
                    <?if(!empty($CustomerMeetList->obj_arr)):?>
                    <div class="spanLineLeft checkbox">
                        <input type="checkbox" id="check_all">
                    </div>
                    <?endif?>
                    <div class="spanLineLeft text width100">
                        <input type="number" class="text" style="margin-left:-6px;" value="<?=!empty($search_visitid)?$search_visitid:''?>" name="search_visitid" placeholder="請填寫ID">
                    </div>
                    <div class="spanLineLeft text width200">
                        <input type="text" class="text" style="margin-left:-6px;" value="<?=!empty($search_customerids)?$search_customerids:''?>" name="search_customerids" placeholder="請填寫公司名稱">
                    </div>
                    <div class="spanLineLeft text width150">
                        拜訪時間
                    </div>
                    <div class="spanLineLeft text width150">
                        <input type="submit" class="button" style="height: 30px;" value="篩選">
                    </div>
                </form>
            </div>
            <?if(!empty($CustomerMeetList->obj_arr)):?>
            <?foreach($CustomerMeetList->obj_arr as $key => $value_CustomerMeet):?>
            <div class="spanLine tablelist">
                <div class="spanLineLeft checkbox">
                    <input type="checkbox" name="customerid_arr[]" value="<?=$value_CustomerMeet->visitid?>" class="check">
                </div>
                <div class="spanLineLeft text width100" >
                    <?=$value_CustomerMeet->visitid?>
                </div>

                <div class="spanLineLeft text width200">         
                    <?=$value_CustomerMeet->CustomerList->obj_arr[0]->company?>    
                </div>

                <div class="spanLineLeft text width150">
                    <?=$value_CustomerMeet->visit_time_DateTime->datetime?>
                </div>
                <div class="spanLineLeft width150 tablelistMenu">
                    <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit/?visitid=<?=$value_CustomerMeet->visitid?>">編輯</a>
                    <span class="ahref" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?visitid=<?=$value_CustomerMeet->visitid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除</span>
                </div>
            </div>
            <?endforeach?>
            <input type="submit" id="delete" class="button" style="display:none;"
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
    <?if(!empty($CustomerMeetList->obj_arr[0]->visitid)):?>
    <div class="batch_deletion">
        <input type="button" class="button" id="delete" style="height: 32px;" value="批量刪除">
    </div>
    <?endif?>
    <div class="pageLink"><?=$page_link?></div>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>