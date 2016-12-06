<?=$temp['header_up']?>
<script>
Temp.ready(function(){


    function thousandComma(number)
    {
     var num = number.toString();
     var pattern = /(-?\d+)(\d{3})/;
      
     while(pattern.test(num))
     {
      num = num.replace(pattern, "$1,$2");
      
     }
     return num;
     
    }

    $('#start_time').datetimepicker({
        dateFormat: 'yy-mm-dd',
        timeFormat: 'HH:mm:ss'
    });

    $('#end_time').datetimepicker({
        dateFormat: 'yy-mm-dd',
        timeFormat: 'HH:mm:ss'
    });

    // 根據算
    $('.project.tablelist').each(function(key, value){
        var $this = $(value);
        var projectid = $this.find('.projectid').text();
        var pay_price_total = $this.find('.pay_price_total').attr('data-pay_price_total');
        var pay_price_receive = $this.find('.pay_price_receive').attr('data-pay_price_receive')

        $this.find('.pay_price_total').text( thousandComma( pay_price_total ) + ' 元' );
        $this.find('.pay_price_receive').text( thousandComma( pay_price_receive ) + ' 元' );

        $.ajax({
            url: $('base').attr('href') + 'admin/project/project/project/time_json',
            type: 'GET',
            data: {
                projectid: projectid
            },
            async: true
        })
        .done(function(response){
            if( fanswoo.is_json(response) )
            {
                var response_json = $.parseJSON(response);
                var actual_use_day_total = response_json.actual_use_day_total;
                var actual_use_hour_total = response_json.actual_use_hour_total;
                var actual_use_day_pay = response_json.actual_use_day_pay;
                var actual_use_day_pay_total = response_json.actual_use_day_pay_total;
                var real_receipt_profit = pay_price_receive - actual_use_day_pay_total;
                var estimates_profit = pay_price_total - actual_use_day_pay_total;


                $this.find('.actual_use_day_total').text(actual_use_day_total + ' 天');
                $this.find('.actual_use_hour_total').text(actual_use_hour_total + ' 小時');
                $this.find('.actual_use_day_pay').text( thousandComma( actual_use_day_pay ) + ' 元');
                $this.find('.actual_use_day_pay_total').text( thousandComma( actual_use_day_pay_total ) + ' 元');
                $this.find('.real_receipt_profit').text( thousandComma( real_receipt_profit ) + ' 元');
                $this.find('.estimates_profit').text( thousandComma( estimates_profit ) + ' 元');


                if( real_receipt_profit < 0 )
                {
                    $this.find('.real_receipt_profit').css('color', 'red');
                }

                if( estimates_profit < 0 )
                {
                    $this.find('.estimates_profit').css('color', 'red');
                }
            }
        })
    　　.fail(function(response){
        });
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
        <p>業務獎金百分比： 5% | 營業稅百分比： 5% | 基礎管銷成本百分比： 50%</p>
    </div>
	<div class="spanLine noneBg">
        <div class="spanLineLeft">
			<a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit" class="button">新增<?=$child3_title?></a>
        </div>
	</div>
	<div class="spanLineTable">
        <div class="spanLineTableContent">
            <div class="spanLine tablelist tableTitle">
                <div class="spanLineLeft text width100">
        			專案ID
                </div>
                <div class="spanLineLeft text width200">
        			專案名稱
                </div>
                <div class="spanLineLeft text width100" title="以專案執行人員及主管之薪資計算">
                    執行成本估算
                </div>
                <div class="spanLineLeft text width100" title="執行成本加上公司其它人員薪資之計算">
                    實際成本估算
                </div>
                <div class="spanLineLeft text width100">
                    專案總金額
                </div>
                <div class="spanLineLeft text width100">
                    實收利潤
                </div>
                <div class="spanLineLeft text width100">
                    預估利潤
                </div>
                <div class="spanLineLeft text width100">
                    已收款項
                </div>
                <div class="spanLineLeft text width100">
                    付款進度 (%)
                </div>
                <div class="spanLineLeft text width100">
                    實際消耗天數
                </div>
                <div class="spanLineLeft text width100">
                    實際消耗時數
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
                <?php echo form_open("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
                    <div class="spanLineLeft text width100">
                        <input type="number" class="text" style="margin-left:-6px;" value="<?=!empty($search_projectid)?$search_projectid:''?>" name="search_projectid" placeholder="請填寫ID">
                    </div>
                    <div class="spanLineLeft text width200">
                        <input type="text" class="text" style="margin-left:-6px;" value="<?=!empty($search_name)?$search_name:''?>" name="search_name" placeholder="請填寫專案名稱">
                    </div>
                    <div class="spanLineLeft text width100">
                        0 元
                    </div>
                    <div class="spanLineLeft text width100">
                        0 元
                    </div>
                    <div class="spanLineLeft text width100">
                        0 元
                    </div>
                    <div class="spanLineLeft text width100">
                        0 元
                    </div>
                    <div class="spanLineLeft text width100">
                        0 元
                    </div>
                    <div class="spanLineLeft text width100">
                        0 元
                    </div>
                    <div class="spanLineLeft text width100">
                        0 %
                    </div>
                    <div class="spanLineLeft text width100">
                        0 天
                    </div>
                    <div class="spanLineLeft text width100">
                        0 小時
                    </div>
                    <div class="spanLineLeft text width100">
                        <input type="text" id="start_time" class="text" style="margin-left:-6px;" value="<?=!empty($search_setuptime)?$search_setuptime:''?>" name="search_start_time" placeholder="開始日期">
                    </div>
                    <div class="spanLineLeft text width100">
                        <input type="text" id="end_time" class="text" style="margin-left:-6px;" value="<?=!empty($search_endtime)?$search_endtime:''?>" name="search_end_time" placeholder="結束日期">
                    </div>
                    <div class="spanLineLeft text width150">
                        <select name="search_class_slug" style="margin-left:-6px;">
                            <option value="">不透過分類標籤篩選</option>
                            <?foreach($ProjectClassMetaList->obj_arr as $key => $value_ClassMeta):?>
                            <option value="<?=$value_ClassMeta->slug?>"<?if(!empty($search_class_slug) && $search_class_slug == $value_ClassMeta->slug) echo ' selected'?>><?=$value_ClassMeta->classname?></option>
                            <?endforeach?>
                        </select>
                    </div>
                    <div class="spanLineLeft text width150">
                        <input type="submit" class="button" style="height: 30px; margin-left:-6px;" value="篩選">
                    </div>
                </form>
            </div>
            <?if(!empty($ProjectList->obj_arr)):?>
            <?foreach($ProjectList->obj_arr as $key => $value_Project):?>
            <div class="project spanLine tablelist">
                <div class="projectid spanLineLeft text width100"><?=$value_Project->projectid?></div>
                <div class="spanLineLeft text width200">
                    <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit/?projectid=<?=$value_Project->projectid?>">
                        <?=$value_Project->name?>
                    </a>
                </div>
                <div class="actual_use_day_pay spanLineLeft text width100" title="以專案執行人員及主管之薪資計算">
                    0 元
                </div>
                <div class="actual_use_day_pay_total spanLineLeft text width100" title="執行成本加上公司其它人員薪資之計算">
                    0 元
                </div>
                <div class="pay_price_total spanLineLeft text width100" data-pay_price_total="<?=$value_Project->pay_price_total?>">
                </div>
                <div class="real_receipt_profit spanLineLeft text width100" title="以收款金額作為計算之收款利潤">
                    0 元
                </div>
                <div class="estimates_profit spanLineLeft text width100" title="以總金額作為計算之預估利潤">
                    0 元
                </div>
                <div class="pay_price_receive spanLineLeft text width100" data-pay_price_receive="<?=$value_Project->pay_price_receive?>">
                    0 元
                </div>
                <div class="spanLineLeft text width100">
                    <?=$value_Project->pay_price_schedule?> %
                </div>
                <div class="actual_use_day_total spanLineLeft text width100">
                    0 天
                </div>
                <div class="actual_use_hour_total spanLineLeft text width100">
                    0 小時
                </div>
                <div class="spanLineLeft text width100">
                    <?=$value_Project->setuptime_DateTimeObj->inputtime_date?>
                </div>
                <div class="spanLineLeft text width100">
                   <?=$value_Project->endtime_DateTimeObj->inputtime_date?>
                </div>
                <div class="spanLineLeft text width150">
                    <?if(!empty($value_Project->class_ClassMetaList->obj_arr)):?>
                    <?foreach($value_Project->class_ClassMetaList->obj_arr as $key => $value_ClassMeta):?>
                        <?if($key !== 0):?>,<?endif?><?=$value_ClassMeta->classname?>
                    <?endforeach?>
                    <?else:?>
                    <span class="gray">沒有分類標籤</span>
                    <?endif?>
                </div>
                <div class="spanLineLeft width150 tablelistMenu">
                    <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit/?projectid=<?=$value_Project->projectid?>">編輯</a>
                    <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/copy/?projectid=<?=$value_Project->projectid?>">複製</a>
                    <span class="ahref" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?projectid=<?=$value_Project->projectid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除</span>
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