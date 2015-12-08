<?=$temp['header_up']?>
<script>
$(function(){

    $("#pay_price_schedule").text(<?=$Project->pay_price_schedule_Num?>+' %');
    $("#pay_price_schedule_input").val(<?=$Project->pay_price_schedule_Num?>);

    var schedule = parseInt($("#pay_price_schedule_input").val());
    if(schedule==100){$("#pay_price_schedule").css('color','green');}
    else{$("#pay_price_schedule").css('color','red');}

    $("#pay_price_total").change(function(){

        var total = parseInt($("#pay_price_total").val());
        var receive = parseInt($("#pay_price_receive").val());
        schedule = ( receive / total ) * 100 ;

        // $("#pay_price_schedule").text(schedule.toFixed(2)+' %');
        // $("#pay_price_schedule_input").val(schedule.toFixed(2));

        //四捨五入
        $("#pay_price_schedule").text(Math.round(schedule)+' %');
        $("#pay_price_schedule_input").val(Math.round(schedule));

        if(total==receive)
        { 
            $("#pay_price_schedule").css('color','green');
        }
        else
        { 
            $("#pay_price_schedule").css('color','red');
        }

        if(total<receive)
        {
            alert("收款金額大於總金額");
            var receive = $("#pay_price_receive").val(0);
            $("#pay_price_schedule").text("0 %");
            $("#pay_price_schedule_input").val("0");
        }

        var total2 = $("#pay_price_total").val();
        var receive2 = $("#pay_price_receive").val();

        if(total2==''||receive2=='')
        {
            $("#pay_price_schedule").text("0 %");
        }

    });

    $("#pay_price_total").keyup(function(){

        var total = parseInt($("#pay_price_total").val());
        var receive = parseInt($("#pay_price_receive").val());
        schedule = ( receive / total ) * 100 ;

        // $("#pay_price_schedule").text(schedule.toFixed(2)+' %');
        // $("#pay_price_schedule_input").val(schedule.toFixed(2));

        //四捨五入
        $("#pay_price_schedule").text(Math.round(schedule)+' %');
        $("#pay_price_schedule_input").val(Math.round(schedule));

        if(total==receive)
        { 
            $("#pay_price_schedule").css('color','green');
        }
        else
        { 
            $("#pay_price_schedule").css('color','red');
        }

        var total2 = $("#pay_price_total").val();
        var receive2 = $("#pay_price_receive").val();

        if(total2==''||receive2=='')
        {
            $("#pay_price_schedule").text("0 %");
        }

    });

    $("#pay_price_receive").change(function(){

        var total = parseInt($("#pay_price_total").val());
        var receive = parseInt($("#pay_price_receive").val());
        schedule = ( receive / total ) * 100 ;

        // $("#pay_price_schedule").text(schedule.toFixed(2)+' %');
        // $("#pay_price_schedule_input").val(schedule.toFixed(2));

        //四捨五入
        $("#pay_price_schedule").text(Math.round(schedule)+' %');
        $("#pay_price_schedule_input").val(Math.round(schedule));

        if(total==receive)
        { 
            $("#pay_price_schedule").css('color','green');
        }
        else
        { 
            $("#pay_price_schedule").css('color','red');
        }

        if(total<receive)
        {
            alert("收款金額大於總金額");
            var receive = $("#pay_price_receive").val(0);
            $("#pay_price_schedule").text("0 %");
            $("#pay_price_schedule_input").val("0");
        }

        var total2 = $("#pay_price_total").val();
        var receive2 = $("#pay_price_receive").val();

        if(total2==''||receive2=='')
        {
            $("#pay_price_schedule").text("0 %");
        }

    });

    $("#pay_price_receive").keyup(function(){

        var total = parseInt($("#pay_price_total").val());
        var receive = parseInt($("#pay_price_receive").val());
        schedule = ( receive / total ) * 100 ;

        // $("#pay_price_schedule").text(schedule.toFixed(2)+' %');
        // $("#pay_price_schedule_input").val(schedule.toFixed(2));

        //四捨五入
        $("#pay_price_schedule").text(Math.round(schedule)+' %');
        $("#pay_price_schedule_input").val(Math.round(schedule));

        if(total==receive)
        { 
            $("#pay_price_schedule").css('color','green');
        }
        else
        { 
            $("#pay_price_schedule").css('color','red');
        }

        var total2 = $("#pay_price_total").val();
        var receive2 = $("#pay_price_receive").val();

        if(total2==''||receive2=='')
        {
            $("#pay_price_schedule").text("0 %");
        }

    });

});
</script>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title_Str?> - <?=$child3_title_Str?></h2>
<?php echo form_open_multipart("admin/$child1_name_Str/$child2_name_Str/$child3_name_Str/{$child4_name_Str}_post/") ?>
<div class="contentBox allWidth">
    <h3><?=$child3_title_Str?> > <?if(!empty($Project->projectid_Num)):?>編輯<?else:?>新增<?endif?></h3>
    <h4>請填寫<?=$child3_title_Str?>之詳細資訊</h4>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案名稱
            </div>
            <div class="spanLineLeft width400">
                <input type="text" class="text" name="name_Str" placeholder="請輸入專案名稱" value="<?=$Project->name_Str?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案分類
            </div>
            <div class="spanLineLeft width500">
                <?if(!empty($Project->class_ClassMetaList->obj_Arr)):?>
                    <?foreach($Project->class_ClassMetaList->obj_Arr as $key => $value_ClassMeta):?>
                        <div class="selectLine" style="border-bottom:0px dashed #DDD;" fanswoo-selectEachLine>
                            <select fanswoo-selectEachLineMaster="class">
                                <option value="">沒有分類標籤</option>
                                <?foreach($class2_ClassMetaList->obj_Arr as $key2 => $value2_ClassMeta):?>
                                <option value="<?=$value2_ClassMeta->classid_Num?>"<?if($value_ClassMeta->class_ClassMetaList->obj_Arr[0]->classid_Num == $value2_ClassMeta->classid_Num):?> selected<?endif?>><?=$value2_ClassMeta->classname_Str?></option>
                                <?endforeach?>
                            </select>
                            <span fanswoo-selectEachLineSlave="class">
                            <?foreach($class2_ClassMetaList->obj_Arr as $key2 => $value2_ClassMeta):?>
                                <select fanswoo-selectValue="<?=$value2_ClassMeta->classid_Num?>" fanswoo-selectName="classids_Arr[]"<?if($value_ClassMeta->class_ClassMetaList->obj_Arr[0]->classid_Num == $value2_ClassMeta->classid_Num):?> name="classids_Arr[]"<?else:?> style="display:none;"<?endif?>>
                                    <option value="">沒有分類標籤</option>
                                    <?
                                        $test_ClassMetaList = new ObjList();
                                        $test_ClassMetaList->construct_db(array(
                                            'db_where_Arr' => array(
                                                'modelname_Str' => 'project'
                                            ),
                                            'db_where_or_Arr' => array(
                                                'classids' => array($value2_ClassMeta->classid_Num)
                                            ),
                                            'model_name_Str' => 'ClassMeta',
                                            'limitstart_Num' => 0,
                                            'limitcount_Num' => 100
                                        ));
                                    ?>
                                    <?foreach($test_ClassMetaList->obj_Arr as $key3 => $value3_ClassMeta):?>
                                    <option value="<?=$value3_ClassMeta->classid_Num?>"<?if($value_ClassMeta->classid_Num == $value3_ClassMeta->classid_Num):?> selected<?endif?>><?=$value3_ClassMeta->classname_Str?></option>
                                    <?endforeach?>
                                </select>
                            <?endforeach?>
                            </span>
                        </div>
                    <?endforeach?>
                    <?else:?>
                    <div class="selectLine" style="border-bottom:0px dashed #DDD;" fanswoo-selectEachLine>
                        <select fanswoo-selectEachLineMaster="class">
                            <option value="">沒有分類標籤</option>
                            <?foreach($class2_ClassMetaList->obj_Arr as $key2 => $value2_ClassMeta):?>
                            <option value="<?=$value2_ClassMeta->classid_Num?>"><?=$value2_ClassMeta->classname_Str?></option>
                            <?endforeach?>
                        </select>
                        <span fanswoo-selectEachLineSlave="class">
                        <?foreach($class2_ClassMetaList->obj_Arr as $key2 => $value2_ClassMeta):?>
                            <select name="classids_Arr[]" fanswoo-selectValue="<?=$value2_ClassMeta->classid_Num?>" fanswoo-selectName="classids_Arr[]" style="display:none;">
                                <option value="">沒有分類標籤</option>
                                <?
                                    $test_ClassMetaList = new ObjList();
                                    $test_ClassMetaList->construct_db(array(
                                        'db_where_Arr' => array(
                                            'modelname_Str' => 'project'
                                        ),
                                        'db_where_or_Arr' => array(
                                            'classids' => array($value2_ClassMeta->classid_Num)
                                        ),
                                        'model_name_Str' => 'ClassMeta',
                                        'limitstart_Num' => 0,
                                        'limitcount_Num' => 100
                                    ));
                                ?>
                                <?foreach($test_ClassMetaList->obj_Arr as $key3 => $value3_ClassMeta):?>
                                <option value="<?=$value3_ClassMeta->classid_Num?>"><?=$value3_ClassMeta->classname_Str?></option>
                                <?endforeach?>
                            </select>
                        <?endforeach?>
                        </span>
                    </div>
                <?endif?>
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineLeft width500">
                <span class="gray">請選擇二級分類及分類標籤</span>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案開始日期
            </div>
            <div class="spanLineLeft">
                <script src="fanswoo-framework/js/jquery-ui-timepicker-addon/script.js"></script>
                <link rel="stylesheet" type="text/css" href="fanswoo-framework/js/jquery-ui-timepicker-addon/style.css"></link>
                <script>
                $(function(){
                    $('#setuptime_Str').datetimepicker({
                        dateFormat: 'yy-mm-dd',
                        timeFormat: 'HH:mm:ss'
                    });
                });
                </script>
                <input type="text" id="setuptime_Str" class="text" name="setuptime_Str" value="<?=$Project->setuptime_DateTimeObj->datetime_Str?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案所需時程(天)
            </div>
            <div class="spanLineLeft">
                <input type="number" min="0" class="text" name="working_days_Num" placeholder="請輸入專案所需時程(天)" value="<?=$Project->working_days_Num?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                會員權限
            </div>
            <div class="spanLineLeft width300">
                <textarea name="permission_uids_Str" style="height:100px;border: 1px solid #CCC ;"><?=$Project->permission_uids_Str?></textarea>
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineLeft width500">
                <span class="gray">請填寫擁有查看此專案系統權限之會員ID，每個ID一行</span><br>
                <span class="gray">第一位會員即為此專案訂購會員</span>
            </div>
        </div>
    </div>
</div>
<div class="contentBox allWidth">
    <h3>設計項目列表</h3>
    <h4>請確認本專案之設計項目資訊</h4>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                設計項目類別
            </div>
            <div class="spanLineLeft width300">
                <p style="margin-left:20px;">系統開發</p>
                <?foreach($ProjectDesignList->obj_Arr as $key => $value_Design):?>
                <?if($value_Design->class_ClassMetaList->obj_Arr[0]->class_ClassMetaList->obj_Arr[0]->classname_Str=='系統開發'):?>
                    <div class="checkbox_item">
                        <input type="checkbox" class="checkbox" name="designids_Str[]" value="<?=$value_Design->designid_Num?>" <?foreach($project_designids_Arr as $key2 => $value_project_designids):?><?if($value_Design->designid_Num == $value_project_designids):?> checked<?else:?><?endif?><?endforeach?>><a href="admin/<?=$child1_name_Str?>/design/design/edit?designid=<?=$value_Design->designid_Num?>" target="_blank" style="color:#003377;"><span style="margin-left:5px;" required><?=$value_Design->title_Str?></span></a><br>  
                    </div>
                <?endif?>
                <?endforeach?>
            </div>
            <div class="spanLineLeft width300">
                <p style="margin-left:20px;">美術設計</p>
                <?foreach($ProjectDesignList->obj_Arr as $key => $value_Design):?>
                <?if($value_Design->class_ClassMetaList->obj_Arr[0]->class_ClassMetaList->obj_Arr[0]->classname_Str=='美術設計'):?>
                    <div class="checkbox_item">
                        <input type="checkbox" class="checkbox" name="designids_Str[]" value="<?=$value_Design->designid_Num?>" <?foreach($project_designids_Arr as $key2 => $value_project_designids):?><?if($value_Design->designid_Num == $value_project_designids):?> checked<?else:?><?endif?><?endforeach?>><a href="admin/<?=$child1_name_Str?>/design/design/edit?designid=<?=$value_Design->designid_Num?>" target="_blank" style="color:#003377;"><span style="margin-left:5px;" required><?=$value_Design->title_Str?></span></a><br>  
                    </div>
                <?endif?>
                <?endforeach?>
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineLeft width500">
                <a href="admin/<?=$child1_name_Str?>/design/design/tablelist">管理設計項目類別</a>
            </div>
        </div>
    </div>
</div>
<div class="contentBox allWidth">
    <h3>付款資訊</h3>
    <h4>請確認本專案之付款資訊</h4>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案總金額 (NT$)
            </div>
            <div class="spanLineLeft">
                <input id="pay_price_total" type="number" min="0" class="text" name="pay_price_total_Num" value="<?=$Project->pay_price_total_Num?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案已收款項 (NT$)
            </div>
            <div class="spanLineLeft">
                <input id="pay_price_receive" type="number" min="0" class="text" name="pay_price_receive_Num" value="<?=$Project->pay_price_receive_Num?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案付款進度
            </div>
            <div class="spanLineLeft">
                <input id="pay_price_schedule_input" type="hidden" name="pay_price_schedule_Num" value="<?=$Project->pay_price_schedule_Num?>">
                <span id="pay_price_schedule" style="margin-left:5px;" class="red"></span>
            </div>
        </div>
    </div>
    <?if($Project->pay_status_Num == 1):?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                轉帳帳號
            </div>
            <div class="spanLineLeft">
                <?=$Project->pay_account_Str?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                轉帳人姓名
            </div>
            <div class="spanLineLeft">
                <?=$Project->pay_name_Str?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                轉帳時間
            </div>
            <div class="spanLineLeft width500">
                <?=$Project->pay_paytime_DateTimeObj->datetime_Str?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                付款備註
            </div>
            <div class="spanLineLeft width500">
                <?=$Project->pay_remark_Str?>
            </div>
        </div>
    </div>
    <?endif?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                付款狀態
            </div>
            <div class="spanLineLeft width500">
                <?if($Project->pay_status_Num == 0):?>
                <span class="red">會員尚未填寫付款資訊</span>
                <?elseif($Project->pay_status_Num == 1):?>
                <span class="green">會員已填寫付款資訊</span>
                <?endif?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                款項確認狀態
            </div>
            <div class="spanLineLeft width500">
                <select name="paycheck_status_Num" class="<?if($Project->paycheck_status_Num == 0):?>red<?elseif($Project->paycheck_status_Num == 1):?>green<?endif?>">
                    <option value="0" class="red"<?if($Project->paycheck_status_Num == 0):?> selected<?endif?>>款項待確認</option>
                    <option value="1" class="green"<?if($Project->paycheck_status_Num == 1):?> selected<?endif?>>款項已確認</option>
                </select>
            </div>
        </div>
    </div>
</div>
<?if(!empty($projectid_Num)):?>
<?if(!empty($SuggestList->obj_Arr)):?>
<div class="contentBox allWidth">
    <h3>專案修改建議列表</h3>
    <h4>請確認本專案之修改建議</h4>
    <div class="spanLineTable">
        <div class="spanLineTableContent">
            <div class="spanLine order tablelist tableTitle">
                <div class="spanLineLeft text width300">
                    修改建議標題
                </div>
                <div class="spanLineLeft text width100">
                    處理狀態
                </div>
                <div class="spanLineLeft text width150">
                    提出時間
                </div>
            </div>
            <?foreach($SuggestList->obj_Arr as $key => $value_Suggest):?>
            <div class="spanLine order tablelist" style="border-bottom: 0px solid #EEE;">
                <div class="spanLineLeft text width300">
                    <a href="admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/suggest/edit/?suggestid=<?=$value_Suggest->suggestid_Num?>&projectid=<?=$Project->projectid_Num?>" target="_blank">
                        <?=$value_Suggest->title_Str?>
                    </a>
                </div>
                <div class="spanLineLeft text width100">
                    <?if($value_Suggest->answer_status_Num == 1):?>
                    <span class="green">評估中</span>
                    <?elseif($value_Suggest->answer_status_Num == 2):?>
                    <span class="green">修改中</span>
                    <?elseif($value_Suggest->answer_status_Num == 3):?>
                    <span>已完成</span>
                    <?endif?>
                </div>
                <div class="spanLineLeft text width150">
                    <?=$value_Suggest->suggest_time_DateTime->datetime_Str?>
                </div>
            </div>
            <?endforeach?>
        </div>
    </div>
</div>
<?endif?>
<?endif?>
<div class="contentBox allWidth">
    <h3>專案資訊</h3>
    <h4>請確認本專案之進行資訊</h4>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案進行狀態
            </div>
            <div class="spanLineLeft width500">
                <select name="project_status_Num" style="color:#027de5">
                    <option value="1" <?if($Project->project_status_Num == 1):?> selected<?endif?>>估價中</option>
                    <option value="2" <?if($Project->project_status_Num == 2):?> selected<?endif?>>開發中</option>
                    <option value="3" <?if($Project->project_status_Num == 3):?> selected<?endif?>>維護</option>
                    <option value="4" <?if($Project->project_status_Num == 4):?> selected<?endif?>>結案</option>
                </select>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                最後更新時間
            </div>
            <div class="spanLineLeft width500">
                <?=$Project->updatetime_DateTimeObj->datetime_Str?>
            </div>
        </div>
    </div>
    <div class="spanLine spanSubmit">
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <?if(!empty($Project->projectid_Num)):?><input type="hidden" name="projectid_Num" value="<?=$Project->projectid_Num?>"><?endif?>
                <input type="submit" class="submit" value="<?if(!empty($Project->projectid_Num)):?>儲存變更<?else:?>新增專案<?endif?>">
                <?if(!empty($Project->projectid_Num)):?><a href="admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/project/prints?projectid=<?=$Project->projectid_Num?>" target="_blank"><span class="submit">列印成估價單</span></a><?endif?>
                <?if(!empty($Project->projectid_Num)):?><span class="submit gray" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/delete/?noteid=<?=$Project->projectid_Num?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除<?=$child3_title_Str?></span><?endif?>
            </div>
        </div>
    </div>
</div>
</form>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>