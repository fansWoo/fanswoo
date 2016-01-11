<?=$temp['header_up']?>
<script>
$(function(){
    
    $(".spanLine.tablelist").each(function(key, value){

        var month = $(this).data('month');

        //專案業績月份達成進度
        var achieving_goals_total = 0;
        $(".achieving_goals[data-month=" + month + "]").each(function(key, value){
            achieving_goals_total += parseInt($(this).text());
        });
        $(".achieving_goals_total[data-month=" + month + "]").text(achieving_goals_total);

        //專案業績月份達成率
        var reaching_rate = 0;
        if($("input[type=number][data-month=" + month + "]").val() == ""){reaching_rate = 0;}
        else{reaching_rate = Math.round((achieving_goals_total / $("input[type=number][data-month=" + month + "]").val()) * 100 );};
        $(".reaching_rate[data-month=" + month + "]").text(reaching_rate);

    });

    //專案業績年度目標進度加總 / 達成進度加總 / 達成率
    var year_sales_target_total = 0;
    var year_achieving_goals_total = 0;
    var year_reaching_rate = 0;

    $(".spanLineLeft input[type=number]").each(function(key, value){
        if($(this).val() == ""){year_sales_target_total = 0;}else{year_sales_target_total += parseInt($(this).val());};
    });
    
    $(".spanLineLeft .achieving_goals_total").each(function(key, value){
        year_achieving_goals_total += parseInt($(this).text());
    });

    if(year_sales_target_total == 0){year_reaching_rate = 0;}
    else{year_reaching_rate = Math.round(((year_achieving_goals_total / year_sales_target_total) * 100 ));};

    $("#year_sales_target_total").text(year_sales_target_total);
    $("#year_achieving_goals_total").text(year_achieving_goals_total);
    $("#year_reaching_rate").text(year_reaching_rate);

});
</script>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title_Str?> - <?=$child3_title_Str?></h2>
<div class="contentBox contentTablelist allWidth">
    <h3><?=$child3_title_Str?> > 編輯</h3>
    <h4>請填寫專案業績進度之詳細資訊</h4>
    <?php echo form_open_multipart("admin/$child1_name_Str/$child2_name_Str/$child3_name_Str/{$child4_name_Str}_post/") ?>
    <div class="spanLineTable">
        <p style="margin:0 10px;letter-spacing:1.5px;">年度加總：目標進度 NT$ <span id="year_sales_target_total"></span> / 達成進度 NT$ <span id="year_achieving_goals_total"></span> / 達成率 <span id="year_reaching_rate"></span> %</p>
        <div class="spanLineTableContent">
            <div class="spanLine tablelist tableTitle">
                <div class="spanLineLeft text width100">
                    月份
                </div>
                <div class="spanLineLeft text width150">
                    目標進度 ( NT$ )
                </div>
                <div class="spanLineLeft text width150">
                    達成進度
                </div>
                <div class="spanLineLeft text width100">
                    達成率 ( % )
                </div>
            </div>
            <div class="spanLine tablelist" data-month="Jan">
                <div class="spanLineLeft text width100">
                    一月
                </div>
                <div class="spanLineLeft text width150">
                    <input type="number" class="text" name="sales_target_Jan" placeholder="請輸入目標進度" value="<?=$global['sales_target_Jan']?>" data-month="Jan">
                </div>
                <div class="spanLineLeft text width150">
                    NT$ <span class="achieving_goals_total" data-month="Jan"></span>
                    <?foreach($Jan_ProjectList->obj_Arr as $key => $value_Project):?>
                        <span class="achieving_goals" data-month="Jan"><?=$value_Project->pay_price_total_Num?></span>
                    <?endforeach?>
                </div>
                <div class="spanLineLeft text width100">
                    <span class="reaching_rate" data-month="Jan"></span> %
                </div>
            </div>
            <div class="spanLine tablelist" data-month="Feb">
                <div class="spanLineLeft text width100">
                    二月
                </div>
                <div class="spanLineLeft text width150">
                    <input type="number" class="text" name="sales_target_Feb" placeholder="請輸入目標進度" value="<?=$global['sales_target_Feb']?>" data-month="Feb">
                </div>
                <div class="spanLineLeft text width150">
                    NT$ <span class="achieving_goals_total" data-month="Feb"></span>
                    <?foreach($Feb_ProjectList->obj_Arr as $key => $value_Project):?>
                        <span class="achieving_goals" data-month="Feb"><?=$value_Project->pay_price_total_Num?></span>
                    <?endforeach?>
                </div>
                <div class="spanLineLeft text width100">
                    <span class="reaching_rate" data-month="Feb"></span> %
                </div>
            </div>
            <div class="spanLine tablelist" data-month="Mar">
                <div class="spanLineLeft text width100">
                    三月
                </div>
                <div class="spanLineLeft text width150">
                    <input type="number" class="text" name="sales_target_Mar" placeholder="請輸入目標進度" value="<?=$global['sales_target_Mar']?>" data-month="Mar">
                </div>
                <div class="spanLineLeft text width150">
                    NT$ <span class="achieving_goals_total" data-month="Mar"></span>
                    <?foreach($Mar_ProjectList->obj_Arr as $key => $value_Project):?>
                        <span class="achieving_goals" data-month="Mar"><?=$value_Project->pay_price_total_Num?></span>
                    <?endforeach?>
                </div>
                <div class="spanLineLeft text width100">
                    <span class="reaching_rate" data-month="Mar"></span> %
                </div>
            </div>
            <div class="spanLine tablelist" data-month="Apr">
                <div class="spanLineLeft text width100">
                    四月
                </div>
                <div class="spanLineLeft text width150">
                    <input type="number" class="text" name="sales_target_Apr" placeholder="請輸入目標進度" value="<?=$global['sales_target_Apr']?>" data-month="Apr">
                </div>
                <div class="spanLineLeft text width150">
                    NT$ <span class="achieving_goals_total" data-month="Apr"></span>
                    <?foreach($Apr_ProjectList->obj_Arr as $key => $value_Project):?>
                        <span class="achieving_goals" data-month="Apr"><?=$value_Project->pay_price_total_Num?></span>
                    <?endforeach?>
                </div>
                <div class="spanLineLeft text width100">
                    <span class="reaching_rate" data-month="Apr"></span> %
                </div>
            </div>
            <div class="spanLine tablelist" data-month="May">
                <div class="spanLineLeft text width100">
                    五月
                </div>
                <div class="spanLineLeft text width150">
                    <input type="number" class="text" name="sales_target_May" placeholder="請輸入目標進度" value="<?=$global['sales_target_May']?>" data-month="May">
                </div>
                <div class="spanLineLeft text width150">
                    NT$ <span class="achieving_goals_total" data-month="May"></span>
                    <?foreach($May_ProjectList->obj_Arr as $key => $value_Project):?>
                        <span class="achieving_goals" data-month="May"><?=$value_Project->pay_price_total_Num?></span>
                    <?endforeach?>
                </div>
                <div class="spanLineLeft text width100">
                    <span class="reaching_rate" data-month="May"></span> %
                </div>
            </div>
            <div class="spanLine tablelist" data-month="Jun">
                <div class="spanLineLeft text width100">
                    六月
                </div>
                <div class="spanLineLeft text width150">
                    <input type="number" class="text" name="sales_target_Jun" placeholder="請輸入目標進度" value="<?=$global['sales_target_Jun']?>" data-month="Jun">
                </div>
                <div class="spanLineLeft text width150">
                    NT$ <span class="achieving_goals_total" data-month="Jun"></span>
                    <?foreach($Jun_ProjectList->obj_Arr as $key => $value_Project):?>
                        <span class="achieving_goals" data-month="Jun"><?=$value_Project->pay_price_total_Num?></span>
                    <?endforeach?>
                </div>
                <div class="spanLineLeft text width100">
                    <span class="reaching_rate" data-month="Jun"></span> %
                </div>
            </div>
            <div class="spanLine tablelist" data-month="Jul">
                <div class="spanLineLeft text width100">
                    七月
                </div>
                <div class="spanLineLeft text width150">
                    <input type="number" class="text" name="sales_target_Jul" placeholder="請輸入目標進度" value="<?=$global['sales_target_Jul']?>" data-month="Jul">
                </div>
                <div class="spanLineLeft text width150">
                    NT$ <span class="achieving_goals_total" data-month="Jul"></span>
                    <?foreach($Jul_ProjectList->obj_Arr as $key => $value_Project):?>
                        <span class="achieving_goals" data-month="Jul"><?=$value_Project->pay_price_total_Num?></span>
                    <?endforeach?>
                </div>
                <div class="spanLineLeft text width100">
                    <span class="reaching_rate" data-month="Jul"></span> %
                </div>
            </div>
            <div class="spanLine tablelist" data-month="Aug">
                <div class="spanLineLeft text width100">
                    八月
                </div>
                <div class="spanLineLeft text width150">
                    <input type="number" class="text" name="sales_target_Aug" placeholder="請輸入目標進度" value="<?=$global['sales_target_Aug']?>" data-month="Aug">
                </div>
                <div class="spanLineLeft text width150">
                    NT$ <span class="achieving_goals_total" data-month="Aug"></span>
                    <?foreach($Aug_ProjectList->obj_Arr as $key => $value_Project):?>
                        <span class="achieving_goals" data-month="Aug"><?=$value_Project->pay_price_total_Num?></span>
                    <?endforeach?>
                </div>
                <div class="spanLineLeft text width100">
                    <span class="reaching_rate" data-month="Aug"></span> %
                </div>
            </div>
            <div class="spanLine tablelist" data-month="Sep">
                <div class="spanLineLeft text width100">
                    九月
                </div>
                <div class="spanLineLeft text width150">
                    <input type="number" class="text" name="sales_target_Sep" placeholder="請輸入目標進度" value="<?=$global['sales_target_Sep']?>" data-month="Sep">
                </div>
                <div class="spanLineLeft text width150">
                    NT$ <span class="achieving_goals_total" data-month="Sep"></span>
                    <?foreach($Sep_ProjectList->obj_Arr as $key => $value_Project):?>
                        <span class="achieving_goals" data-month="Sep"><?=$value_Project->pay_price_total_Num?></span>
                    <?endforeach?>
                </div>
                <div class="spanLineLeft text width100">
                    <span class="reaching_rate" data-month="Sep"></span> %
                </div>
            </div>
            <div class="spanLine tablelist" data-month="Oct">
                <div class="spanLineLeft text width100">
                    十月
                </div>
                <div class="spanLineLeft text width150">
                    <input type="number" class="text" name="sales_target_Oct" placeholder="請輸入目標進度" value="<?=$global['sales_target_Oct']?>" data-month="Oct">
                </div>
                <div class="spanLineLeft text width150">
                    NT$ <span class="achieving_goals_total" data-month="Oct"></span>
                    <?foreach($Oct_ProjectList->obj_Arr as $key => $value_Project):?>
                        <span class="achieving_goals" data-month="Oct"><?=$value_Project->pay_price_total_Num?></span>
                    <?endforeach?>
                </div>
                <div class="spanLineLeft text width100">
                    <span class="reaching_rate" data-month="Oct"></span> %
                </div>
            </div>
            <div class="spanLine tablelist" data-month="Nov">
                <div class="spanLineLeft text width100">
                    十一月
                </div>
                <div class="spanLineLeft text width150">
                    <input type="number" class="text" name="sales_target_Nov" placeholder="請輸入目標進度" value="<?=$global['sales_target_Nov']?>" data-month="Nov">
                </div>
                <div class="spanLineLeft text width150">
                    NT$ <span class="achieving_goals_total" data-month="Nov"></span>
                    <?foreach($Nov_ProjectList->obj_Arr as $key => $value_Project):?>
                        <span class="achieving_goals" data-month="Nov"><?=$value_Project->pay_price_total_Num?></span>
                    <?endforeach?>
                </div>
                <div class="spanLineLeft text width100">
                    <span class="reaching_rate" data-month="Nov"></span> %
                </div>
            </div>
            <div class="spanLine tablelist" data-month="Dec">
                <div class="spanLineLeft text width100">
                    十二月
                </div>
                <div class="spanLineLeft text width150">
                    <input type="number" class="text" name="sales_target_Dec" placeholder="請輸入目標進度" value="<?=$global['sales_target_Dec']?>" data-month="Dec">
                </div>
                <div class="spanLineLeft text width150">
                    NT$ <span class="achieving_goals_total" data-month="Dec"></span>
                    <?foreach($Dec_ProjectList->obj_Arr as $key => $value_Project):?>
                        <span class="achieving_goals" data-month="Dec"><?=$value_Project->pay_price_total_Num?></span>
                    <?endforeach?>
                </div>
                <div class="spanLineLeft text width100">
                    <span class="reaching_rate" data-month="Dec"></span> %
                </div>
            </div>
        </div>
    </div>
    <div class="spanLine spanSubmit">
        <div class="spanStage">
            <div class="spanLineLeft">
                <input type="submit" class="submit" value="儲存設置">
            </div>
        </div>
    </div>
    </form>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>