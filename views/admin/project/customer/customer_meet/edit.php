<?=$temp['header_up']?>
<script src="js/tool/ckeditor/ckeditor.js"></script>
<script src="js/tool/jquery-ui-timepicker-addon/script.js"></script>
<link rel="stylesheet" type="text/css" href="style/tool/jquery-ui-timepicker-addon/style.css"></link>
<script>
Temp.ready(function(){

    //加載 HTML 編輯器
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
    <h3><?=$child3_title?> > <?if(!empty($Customer_meet->customerids)):?>編輯<?else:?>新增<?endif?></h3>
    <h4>請填寫<?=$child3_title?>之詳細資訊</h4>
    <?php echo form_open_multipart("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft ">
                公司名稱
            </div>
            <div class="spanLineLeft width200">
                <input type="text" class="text" name="company" placeholder="請選擇客戶公司名稱" value="<?=$Customer_meet->company?>" required>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                客戶名稱
            </div>

            <div class="spanLineLeft width200">
                <input type="text" class="text" name="customer_name" placeholder="請輸入客戶名稱" value="<?=$Customer_meet->customer_name?>" required>
            </div>           
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                拜訪時間
            </div>
            <div class="spanLineLeft">
                <input type="text" id="visit_time" class="text" name="visit_time" value="<?=$Customer_meet->visit_time_DateTime->datetime?>">
            </div>
        </div>
     </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                拜訪性質
            </div>
            <div class="spanLineLeft">
                <select name="visit">
                    <option value="接洽"<?if($Customer_meet->visit == '接洽'):?> selected<?endif?>>接洽</option>
                    <option value="議價"<?if($Customer_meet->visit == '議價'):?> selected<?endif?>>議價</option>
                    <option value="B"<?if($Customer_meet->visit == 'B'):?> selected<?endif?>>B</option>
                    <option value="C"<?if($Customer_meet->visit == 'C'):?> selected<?endif?>>C</option>
                    <option value="D"<?if($Customer_meet->visit == 'D'):?> selected<?endif?>>D</option>
                </select>
            </div>
        </div>
    </div>
    <div class="spanLine spanSubmit">
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <?if(!empty($Customer->customerid)):?><input type="hidden" name="customerid" value="<?=$Customer->customerid?>"><?endif?>
                <input type="submit" class="submit" value="<?if(!empty($Customer->customerid)):?>儲存變更<?else:?>新增客戶名單<?endif?>">
                <?if(!empty($Customer->customerid)):?><span class="submit gray" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?customerid=<?=$Customer->customerid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除<?=$child3_title?></span><?endif?>
            </div>
        </div>
    </div>
    </form>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>