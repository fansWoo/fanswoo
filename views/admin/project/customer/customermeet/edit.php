<?=$temp['header_up']?>
<script src="js/tool/ckeditor/ckeditor.js"></script>
<script src="js/tool/jquery-ui-timepicker-addon/script.js"></script>
<link rel="stylesheet" type="text/css" href="style/tool/jquery-ui-timepicker-addon/style.css"></link>
<script>
Temp.ready(function(){

    // 加載 HTML 編輯器
    CKEDITOR.replace( 'content', {
        toolbar: 'basic'
    });

    $('#visit_time').datetimepicker({
        dateFormat: 'yy-mm-dd',
        timeFormat: 'HH:mm:ss'
    });
});
</script>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title?> - <?=$child3_title?></h2>
<div class="contentBox allWidth">
    <h3><?=$child3_title?> > <?if(!empty($Customer_meet->visitid)):?>編輯<?else:?>新增<?endif?></h3>
    <h4>請填寫<?=$child3_title?>之詳細資訊</h4>
    <?php echo form_open_multipart("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft ">
                公司名稱
            </div>
            <div class="spanLineLeft width200">
                <select name="customerids_arr">
                   <?foreach($CustomerList->obj_arr as $key => $value_customer):?>
                    <option value="<?=$value_customer->customerid?>"><?=$value_customer->company?></option>
                    <?endforeach?>
                </select>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                客戶名稱
            </div>
            <div class="spanLineLeft width200">
                    <input type="text" class="text" name="customer_name" value="<?=$CustomerMeet->customer_name?>">
            </div>           
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                拜訪時間
            </div>
            <div class="spanLineLeft">
                <input type="text" id="visit_time" class="text" name="visit_time" value="<?=$CustomerMeet->visit_time_DateTime->datetime?>">
            </div>
        </div>
     </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                拜訪性質
            </div>
            <div class="spanLineLeft">
                <select name="visit_class" >
                    <option value="">請選擇拜訪性質</option>
                    <option value="接洽"<?if($CustomerMeet->visit_class == '接洽'):?> selected<?endif?>>接洽</option>
                    <option value="議價"<?if($CustomerMeet->visit_class == '議價'):?> selected<?endif?>>議價</option>
                    <option value="其他"<?if($CustomerMeet->visit_class == '其他'):?> selected<?endif?>>其他</option>
                </select>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                拜訪內容
            </div>
            <div class="spanLineRight"> 
                <textarea cols="80" id="content" name="content" rows="10" required><?=$CustomerMeet->content_Html?></textarea>
            </div>           
        </div>
    </div>
    <div class="spanLine spanSubmit">
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <?if(!empty($CustomerMeet->visitid)):?><input type="hidden" name="visitid" value="<?=$CustomerMeet->visitid?>"><?endif?>
                <input type="submit" class="submit" value="<?if(!empty($CustomerMeet->visitid)):?>儲存變更<?else:?>新增拜訪紀錄<?endif?>">
                <?if(!empty($CustomerMeet->visitid)):?><span class="submit gray" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?visitid=<?=$CustomerMeet->visitid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除<?=$child3_title?></span><?endif?>
            </div>
        </div>
    </div>
    </form>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>