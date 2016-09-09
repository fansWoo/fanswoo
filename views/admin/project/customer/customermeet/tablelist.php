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
                    客戶ID
                </div>
                <div class="spanLineLeft text width200">
                    公司名稱
                </div>
                <div class="spanLineLeft text width150">
                    客戶名稱
                </div>          
                <div class="spanLineLeft text width150">
                    拜訪時間
                </div>
            </div>
            <div class="spanLine tablelist">
                <?php echo form_open("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
                    <?if(!empty($CustomerList->obj_arr)):?>
                    <div class="spanLineLeft checkbox">
                        <input type="checkbox" id="check_all">
                    </div>
                    <?endif?>
                    <div class="spanLineLeft text width100">
                        <input type="number" class="text" style="margin-left:-6px;" value="<?=!empty($search_customerid)?$search_customerid:''?>" name="search_customerid" placeholder="請填寫ID">
                    </div>
                    <div class="spanLineLeft text width200">
                        <input type="text" class="text" style="margin-left:-6px;" value="<?=!empty($search_company)?$search_company:''?>" name="search_company" placeholder="請填寫公司名稱">
                    </div>
                    <div class="spanLineLeft text width150">
                        <input type="text" class="text" style="margin-left:-6px;" value="<?=!empty($search_customer_name)?$search_customer_name:''?>" name="search_customer_name" placeholder="請填寫客戶名稱">
                    </div>
                    <div class="spanLineLeft text width150">
                        <select name="search_wish" style="min-width:110px;">
                            <option value="" <?if(empty($search_wish)):?>selected<?endif?>>未選擇意願程度</option>
                            <option value="S"<?if(!empty($search_wish) && $search_wish == 'S'):?>selected<?endif?>>S</option>
                            <option value="A"<?if(!empty($search_wish) && $search_wish == 'A'):?>selected<?endif?>>A</option>
                            <option value="B"<?if(!empty($search_wish) && $search_wish == 'B'):?>selected<?endif?>>B</option>
                            <option value="C"<?if(!empty($search_wish) && $search_wish == 'C'):?>selected<?endif?>>C</option>
                            <option value="D"<?if(!empty($search_wish) && $search_wish == 'D'):?>selected<?endif?>>D</option>
                        </select>
                    </div>
                    <div class="spanLineLeft text width150">
                        <select name="search_budget_range" style="min-width:100px;">
                            <option value="" <?if(empty($search_budget_range)):?>selected<?endif?>>未選擇預算範圍</option>
                            <option value="15萬以下"<?if(!empty($search_budget_range) && $search_budget_range == '15萬以下'):?>selected<?endif?>>15萬以下</option>
                            <option value="15-50萬"<?if(!empty($search_budget_range) && $search_budget_range == '15-50萬'):?>selected<?endif?>>15-50萬</option>
                            <option value="50-100萬"<?if(!empty($search_budget_range) && $search_budget_range == '50-100萬'):?>selected<?endif?>>50-100萬</option>
                            <option value="100-150萬"<?if(!empty($search_budget_range) && $search_budget_range == '100-150萬'):?>selected<?endif?>>100-150萬</option>
                            <option value="150萬-200萬"<?if(!empty($search_budget_range) && $search_budget_range == '150萬-200萬'):?>selected<?endif?>>150萬-200萬</option>
                        </select>
                    </div>
                    <div class="spanLineLeft text width150">
                    最後聯繫時間
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
                    <input type="checkbox" name="customerid_arr[]" value="<?=$value_CustomerMeet->customerid?>" class="check">
                </div>
                <div class="spanLineLeft text width100">
                    <?=$value_CustomerMeet->customerid?>
                </div>
                <div class="spanLineLeft text width200">
                    <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit/?customerid=<?=$value_CustomerMeet->customerid?>"><?=$value_CustomerMeet->company?></a>
                </div>
                <div class="spanLineLeft text width150">
                    <?=$value_CustomerMeet->customer_name?>
                </div>
                <div class="spanLineLeft text width150">
                    <?=$value_CustomerMeet->visit_time_DateTime->datetime?>
                </div>
                <div class="spanLineLeft width150 tablelistMenu">
                    <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit/?customerid=<?=$value_CustomerMeet->customerid?>">編輯</a>
                    <span class="ahref" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?customerid=<?=$value_CustomerMeet->customerid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除</span>
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
    <?if(!empty($CustomerMeetList->obj_arr[0]->customerid)):?>
    <div class="batch_deletion">
        <input type="button" class="button" id="delete" style="height: 32px;" value="批量刪除">
    </div>
    <?endif?>
    <div class="pageLink"><?=$page_link?></div>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>