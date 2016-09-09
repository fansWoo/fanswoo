<?=$temp['header_up']?>
<script>
Temp.ready(function(){

    //加載 HTML 編輯器
    // CKEDITOR.replace( 'content', {
    //     toolbar: 'basic'
    // });

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
                <input type="text" class="text" name="" placeholder="請選擇客戶公司名稱" value="" required>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                客戶名稱
            </div>

            <div class="spanLineLeft width200">
                <input type="text" class="text" name="" placeholder="請輸入客戶名稱" value="" required>
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
                <select name="visit_class">
                    <option value="接洽"<?if($Customer_meet->visit_class == '接洽'):?> selected<?endif?>>接洽</option>
                    <option value="議價"<?if($Customer_meet->visit_class == '議價'):?> selected<?endif?>>議價</option>
                    <option value="其他"<?if($Customer_meet->visit_class == '其他'):?> selected<?endif?>>其他</option>
                    <option value="C"<?if($Customer_meet->visit_class == 'C'):?> selected<?endif?>>C</option>
                    <option value="D"<?if($Customer_meet->visit_class == 'D'):?> selected<?endif?>>D</option>
                </select>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                拜訪內容
            </div>

            <div class="spanLineLeft width200">
                <input type="text" class="text" name="" placeholder="請輸入客戶名稱" value="" required>
            </div>           
        </div>
    </div>
    <div class="spanLine spanSubmit">
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <?if(!empty($Customer_meet->visitid)):?><input type="hidden" name="visitid" value="<?=$Customer_meet->visitid?>"><?endif?>
                <input type="submit" class="submit" value="<?if(!empty($Customer_meet->visitid)):?>儲存變更<?else:?>新增拜訪紀錄<?endif?>">
                <?if(!empty($Customer_meet->visitid)):?><span class="submit gray" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?visitid=<?=$Customer_meet->visitid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除<?=$child3_title?></span><?endif?>
            </div>
        </div>
    </div>
    </form>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>