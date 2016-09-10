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

    $('#contact_time').datetimepicker({
        dateFormat: 'yy-mm-dd',
        timeFormat: 'HH:mm:ss'
    });
});
</script>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title?> - <?=$child3_title?></h2>
<div class="contentBox allWidth">
    <h3><?=$child3_title?> > <?if(!empty($Customer->customerid)):?>編輯<?else:?>新增<?endif?></h3>
    <h4>請填寫<?=$child3_title?>之詳細資訊</h4>
    <?php echo form_open_multipart("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft ">
                公司名稱
            </div>
            <div class="spanLineLeft width200">
                <input type="text" class="text" name="company" placeholder="請輸入客戶公司名稱" value="<?=$Customer->company?>" required>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                客戶名稱
            </div>

            <div class="spanLineLeft width200">
                <input type="text" class="text" name="customer_name" placeholder="請輸入客戶名稱" value="<?=$Customer->customer_name?>" required>
            </div>           
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                電子郵件
            </div>
            <div class="spanLineLeft width200">
                <input type="text" class="text" name="email" placeholder="請輸入電子郵件" value="<?=$Customer->email?>" required>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                手機號碼
            </div>
            <div class="spanLineLeft width200">
                <input type="text" class="text" name="phone" placeholder="請輸入手機號碼" value="<?=$Customer->phone?>" required>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                公司電話號碼
            </div>
            <div class="spanLineLeft width200">
                <input type="text" class="text" name="tel" placeholder="請輸入公司號碼" value="<?=$Customer->tel?>" required>
            </div>
        </div>
    </div>  
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                公司地址
            </div>

            <div class="spanLineLeft width300">
                <input type="text" class="text" name="address" placeholder="請輸入客戶公司地址" value="<?=$Customer->address?>" required>
            </div>           
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                公司網址
            </div>

            <div class="spanLineLeft width300">
                <input type="text" class="text" name="website" placeholder="請輸入客戶公司網址" value="<?=$Customer->website?>" required>
            </div>           
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                最後聯繫時間
            </div>
            <div class="spanLineLeft">
                <input type="text" id="contact_time" class="text" name="contact_time" value="<?=$Customer->contact_time_DateTime->datetime?>">
            </div>
        </div>
     </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                意願等級
            </div>
            <div class="spanLineLeft">
                <select name="wish">
                    <option value="">請選擇意願等級</option>
                    <option value="S"<?if($Customer->wish == 'S'):?> selected<?endif?>>S</option>
                    <option value="A"<?if($Customer->wish == 'A'):?> selected<?endif?>>A</option>
                    <option value="B"<?if($Customer->wish == 'B'):?> selected<?endif?>>B</option>
                    <option value="C"<?if($Customer->wish == 'C'):?> selected<?endif?>>C</option>
                    <option value="D"<?if($Customer->wish == 'D'):?> selected<?endif?>>D</option>
                </select>
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <p class="gray">S=已成交, A=要做/無簽約, B=想做/無簽約, C=考慮中, D=無意願</p>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                預算
            </div>
            <div class="spanLineLeft">
                <select name="budget_range">
                    <option value="">請選擇預算範圍</option>
                    <option value="15萬以下"<?if($Customer->budget_range == '15萬以下'):?> selected<?endif?>>15萬以下</option>
                    <option value="15-50萬"<?if($Customer->budget_range == '15-50萬'):?> selected<?endif?>>15-50萬</option>
                    <option value="50-100萬"<?if($Customer->budget_range == '50-100萬'):?> selected<?endif?>>50-100萬</option>
                    <option value="100-150萬"<?if($Customer->budget_range == '100-150萬'):?> selected<?endif?>>100-150萬</option>
                    <option value="150萬-200萬"<?if($Customer->budget_range == '150萬-200萬'):?> selected<?endif?>>150萬-200萬</option>
                </select>
            </div>
        </div>  
     </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                功能需求
            </div>
            <div class="spanLineRight">
                <textarea cols="80" id="content" name="content" rows="10" required><?=$Customer->content_Html?></textarea>
            </div>
        </div>
    </div>
     <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                名單新增時間
            </div>
            <div class="spanLineLeft" style="width:160px;">
                <input type="text" id="updatetime" class="text" name="updatetime" value="<?=$Customer->updatetime_DateTime->datetime?>">
            </div>
        </div>
    </div>
     <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                優先排序指數
            </div>
            <div class="spanLineLeft" style="width:160px;">
                <input type="number" class="text " name="prioritynum" min="0" value="<?=$Customer->priokmnritynum?>">
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <p class="gray">優先排序值較高者，其排序較為前面</p>
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