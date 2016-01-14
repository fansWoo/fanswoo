<?=$temp['header_up']?>
<script>
$(function(){
    //專案金額加總計算
    var project_price_total = 0;
    $(".project_price").each(function(key, value){
        project_price_total += parseInt($(".project_price").eq(key).text());
        console.log($(".project_price").eq(key).text());
    });
    $("#project_price_total").text(project_price_total);
});
</script>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title_Str?> - <?=$child3_title_Str?></h2>
<div class="contentBox contentTablelist allWidth">
	<h3><?=$child3_title_Str?> > <?=$child4_title_Str?></h3>
	<h4>請選擇欲修改之<?=$child3_title_Str?></h4>
	<div class="spanLine noneBg">
        <div class="spanLineLeft">
			<a href="admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/edit" class="button">新增<?=$child3_title_Str?></a>
        </div>
	</div>
	<div class="spanLineTable">
        <p style="margin:5px 10px; 0 0;">專案金額加總：NT $<span id="project_price_total"></span></p>
        <div class="spanLineTableContent">
            <div class="spanLine tablelist tableTitle">
                <div class="spanLineLeft text width100">
        			專案ID
                </div>
                <div class="spanLineLeft text width300">
        			專案名稱
                </div>
                <div class="spanLineLeft text width100">
                    專案總金額
                </div>
                <div class="spanLineLeft text width100">
                    已收款項
                </div>
                <div class="spanLineLeft text width100">
                    付款進度 (%)
                </div>
                <div class="spanLineLeft text width100">
                    開始日期
                </div>
                <div class="spanLineLeft text width100">
                    結束日期
                </div>
                <div class="spanLineLeft text width150">
                    專案分類標籤
                </div>
                <div class="spanLineLeft text width150">
                    編輯操作
                </div>
        	</div>
            <div class="spanLine tablelist">
                <?php echo form_open("admin/$child1_name_Str/$child2_name_Str/$child3_name_Str/{$child4_name_Str}_post/") ?>
                    <div class="spanLineLeft text width100">
                        <input type="number" class="text" style="margin-left:-6px;" value="<?=!empty($search_projectid_Num)?$search_projectid_Num:''?>" name="search_projectid_Num" placeholder="請填寫ID">
                    </div>
                    <div class="spanLineLeft text width300">
                        <input type="text" class="text" style="margin-left:-6px;" value="<?=!empty($search_name_Str)?$search_name_Str:''?>" name="search_name_Str" placeholder="請填寫專案名稱">
                    </div>
                    <div class="spanLineLeft text width100">
                        <input type="number" class="text" style="margin-left:-6px;" value="<?=!empty($search_pay_price_total_Num)?$search_pay_price_total_Num:''?>" name="search_pay_price_total_Num" placeholder="專案總金額">
                    </div>
                    <div class="spanLineLeft text width100">
                        <input type="number" class="text" style="margin-left:-6px;" value="<?=!empty($search_pay_price_receive_Num)?$search_pay_price_receive_Num:''?>" name="search_pay_price_receive_Num" placeholder="已收款項">
                    </div>
                    <div class="spanLineLeft text width100">
                        <input type="number" class="text" style="margin-left:-6px;" value="<?=!empty($search_pay_price_schedule_Num)?$search_pay_price_schedule_Num:''?>" name="search_pay_price_schedule_Num" placeholder="付款進度">
                    </div>
                    <div class="spanLineLeft text width100">
                        <script src="fanswoo-framework/js/jquery-ui-timepicker-addon/script.js"></script>
                        <link rel="stylesheet" type="text/css" href="fanswoo-framework/js/jquery-ui-timepicker-addon/style.css"></link>
                        <script>
                        $(function(){
                            $('#setuptime_Str').datetimepicker({
                                dateFormat: 'yy-mm-dd',
                                timeFormat: ''
                            });
                        });
                        </script>
                        <input type="text" id="setuptime_Str" class="text" style="margin-left:-6px;" value="<?=!empty($search_setuptime_Str)?$search_setuptime_Str:''?>" name="search_setuptime_Str" placeholder="開始日期">
                    </div>
                    <div class="spanLineLeft text width100">
                        <script src="fanswoo-framework/js/jquery-ui-timepicker-addon/script.js"></script>
                        <link rel="stylesheet" type="text/css" href="fanswoo-framework/js/jquery-ui-timepicker-addon/style.css"></link>
                        <script>
                        $(function(){
                            $('#endtime_Str').datetimepicker({
                                dateFormat: 'yy-mm-dd',
                                timeFormat: ''
                            });
                        });
                        </script>
                        <input type="text" id="endtime_Str" class="text" style="margin-left:-6px;" value="<?=!empty($search_endtime_Str)?$search_endtime_Str:''?>" name="search_endtime_Str" placeholder="結束日期">
                    </div>
                    <div class="spanLineLeft text width150">
                        <select name="search_class_slug_Str" style="margin-left:-6px;">
                            <option value="">不透過分類標籤篩選</option>
                            <?foreach($ProjectClassMetaList->obj_Arr as $key => $value_ClassMeta):?>
                            <option value="<?=$value_ClassMeta->slug_Str?>"<?if(!empty($search_class_slug_Str) && $search_class_slug_Str == $value_ClassMeta->slug_Str) echo ' selected'?>><?=$value_ClassMeta->classname_Str?></option>
                            <?endforeach?>
                        </select>
                    </div>
                    <div class="spanLineLeft text width150">
                        <input type="submit" class="button" style="height: 30px; margin-left:-6px;" value="篩選">
                    </div>
                </form>
            </div>
            <?if(!empty($ProjectList->obj_Arr)):?>
            <?foreach($ProjectList->obj_Arr as $key => $value_Project):?>
            <div class="spanLine tablelist">
                <div class="spanLineLeft text width100">
                    <?=$value_Project->projectid_Num?>
                </div>
                <div class="spanLineLeft text width300">
                    <a href="admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/edit/?projectid=<?=$value_Project->projectid_Num?>">
                        <?=$value_Project->name_Str?>
                    </a>
                </div>
                <div class="spanLineLeft text width100">
                    NT $<span class="project_price"><?=$value_Project->pay_price_total_Num?></span>
                </div>
                <div class="spanLineLeft text width100">
                    NT $<?=$value_Project->pay_price_receive_Num?>
                </div>
                <div class="spanLineLeft text width100">
                    <?=$value_Project->pay_price_schedule_Num?> %
                </div>
                <div class="spanLineLeft text width100">
                    <?=$value_Project->setuptime_DateTimeObj->inputtime_date_Str?>
                </div>
                <div class="spanLineLeft text width100">
                   <?=$value_Project->endtime_DateTimeObj->inputtime_date_Str?>
                </div>
                <div class="spanLineLeft text width150">
                    <?if(!empty($value_Project->class_ClassMetaList->obj_Arr)):?>
                    <?foreach($value_Project->class_ClassMetaList->obj_Arr as $key => $value_ClassMeta):?>
                        <?if($key !== 0):?>,<?endif?><?=$value_ClassMeta->classname_Str?>
                    <?endforeach?>
                    <?else:?>
                    <span class="gray">沒有分類標籤</span>
                    <?endif?>
                </div>
                <div class="spanLineLeft width150 tablelistMenu">
                    <a href="admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/edit/?projectid=<?=$value_Project->projectid_Num?>">編輯</a>
                    <a href="admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/copy/?projectid=<?=$value_Project->projectid_Num?>">複製</a>
                    <span class="ahref" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/delete/?projectid=<?=$value_Project->projectid_Num?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除</span>
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
    <div class="pageLink"><?=$page_link?></div>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>