<?=$temp['header_up']?>
<script>
Temp.ready(function(){

    //加載 HTML 編輯器
    CKEDITOR.replace( 'content', {
        toolbar: 'basic'
    });

    $('#Contact_time').datepicker({
        dateFormat: 'yy-mm-dd'
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
                公司號碼
            </div>
            <div class="spanLineLeft width200">
                <input type="text" class="text" name="tel" placeholder="請輸入公司號碼" value="<?=$Customer->tel?>" required>
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
                意願程度
            </div>
            <div class="spanLineLeft">
                <select name="wish">
                    <option value="0"<?if($Customer->wish == 0):?> selected<?endif?>>S</option>
                    <option value="1"<?if($Customer->wish == 1):?> selected<?endif?>>A</option>
                    <option value="2"<?if($Customer->wish == 2):?> selected<?endif?>>B</option>
                    <option value="3"<?if($Customer->wish == 3):?> selected<?endif?>>C</option>
                    <option value="4"<?if($Customer->wish == 4):?> selected<?endif?>>D</option>
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
            <div class="spanLineRight">
                <input type="text" class="money" name="budget_range" placeholder="請輸入預算金額" value="<?=$Customer->budget_range?>" required>
            </div>
        </div>  
     </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                功能需求
            </div>
            <div class="spanLineRight">
                <textarea cols="80" id="demand" name="demand" rows="10" required><?=$Customer->demand_Html?></textarea>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                最後聯繫時間
            </div>
            <div class="spanLineLeft">
                <input type="text" id="contact_time" class="text" name="contact_time" value="<?=$Customer->contact_time_DateTime->inputtime_date?>">
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