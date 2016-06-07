<?=$temp['header_up']?>
<script src="js/tool/jquery-ui-timepicker-addon/script.js"></script>
<link rel="stylesheet" type="text/css" href="js/tool/jquery-ui-timepicker-addon/style.css"></link>
<script>
Temp.ready(function(){
    $('#setuptime').datetimepicker({
        dateFormat: 'yy-mm-dd',
        timeFormat: 'HH:mm:ss'
    });
});
</script>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title?> - <?=$child3_title?></h2>
<?php echo form_open_multipart("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
<div class="contentBox allWidth">
    <h3><?=$child3_title?> > <?if(!empty($Project->projectid)):?>編輯<?else:?>新增<?endif?></h3>
    <h4>請填寫<?=$child3_title?>之詳細資訊</h4>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案名稱
            </div>
            <div class="spanLineLeft width400">
                <input type="text" class="text" name="name" placeholder="請輸入專案名稱" value="<?=$Project->name?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案分類
            </div>
            <div class="spanLineLeft width500">
                <?if(!empty($Project->class_ClassMetaList->obj_arr)):?>
                    <?foreach($Project->class_ClassMetaList->obj_arr as $key => $value_ClassMeta):?>
                        <div class="selectLine" style="border-bottom:0px dashed #DDD;" fanswoo-selectEachLine>
                            <select fanswoo-selectEachLineMaster="class">
                                <option value="">沒有分類標籤</option>
                                <?foreach($class2_ClassMetaList->obj_arr as $key2 => $value2_ClassMeta):?>
                                <option value="<?=$value2_ClassMeta->classid?>"<?if($value_ClassMeta->class_ClassMetaList->obj_arr[0]->classid == $value2_ClassMeta->classid):?> selected<?endif?>><?=$value2_ClassMeta->classname?></option>
                                <?endforeach?>
                            </select>
                            <span fanswoo-selectEachLineSlave="class">
                            <?foreach($class2_ClassMetaList->obj_arr as $key2 => $value2_ClassMeta):?>
                                <select fanswoo-selectValue="<?=$value2_ClassMeta->classid?>" fanswoo-selectName="classids_arr[]"<?if($value_ClassMeta->class_ClassMetaList->obj_arr[0]->classid == $value2_ClassMeta->classid):?> name="classids_arr[]"<?else:?> style="display:none;"<?endif?>>
                                    <option value="">沒有分類標籤</option>
                                    <?
                                        $test_ClassMetaList = new ObjList();
                                        $test_ClassMetaList->construct_db(array(
                                            'db_where_arr' => array(
                                                'modelname' => 'project'
                                            ),
                                            'db_where_or_arr' => array(
                                                'classids' => array($value2_ClassMeta->classid)
                                            ),
                                            'model_name' => 'ClassMeta',
                                            'limitstart' => 0,
                                            'limitcount' => 100
                                        ));
                                    ?>
                                    <?foreach($test_ClassMetaList->obj_arr as $key3 => $value3_ClassMeta):?>
                                    <option value="<?=$value3_ClassMeta->classid?>"<?if($value_ClassMeta->classid == $value3_ClassMeta->classid):?> selected<?endif?>><?=$value3_ClassMeta->classname?></option>
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
                            <?foreach($class2_ClassMetaList->obj_arr as $key2 => $value2_ClassMeta):?>
                            <option value="<?=$value2_ClassMeta->classid?>"><?=$value2_ClassMeta->classname?></option>
                            <?endforeach?>
                        </select>
                        <span fanswoo-selectEachLineSlave="class">
                        <?foreach($class2_ClassMetaList->obj_arr as $key2 => $value2_ClassMeta):?>
                            <select name="classids_arr[]" fanswoo-selectValue="<?=$value2_ClassMeta->classid?>" fanswoo-selectName="classids_arr[]" style="display:none;">
                                <option value="">沒有分類標籤</option>
                                <?
                                    $test_ClassMetaList = new ObjList();
                                    $test_ClassMetaList->construct_db(array(
                                        'db_where_arr' => array(
                                            'modelname' => 'project'
                                        ),
                                        'db_where_or_arr' => array(
                                            'classids' => array($value2_ClassMeta->classid)
                                        ),
                                        'model_name' => 'ClassMeta',
                                        'limitstart' => 0,
                                        'limitcount' => 100
                                    ));
                                ?>
                                <?foreach($test_ClassMetaList->obj_arr as $key3 => $value3_ClassMeta):?>
                                <option value="<?=$value3_ClassMeta->classid?>"><?=$value3_ClassMeta->classname?></option>
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
                專案管理人
            </div>
            <div class="spanLineLeft width300">
                <input type="text" class="text" name="admin_uid" placeholder="請輸入專案管理人email" value="<?=$admin_User->email?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案開始日期
            </div>
            <div class="spanLineLeft">
                <input type="text" id="setuptime" class="text" name="setuptime" value="<?=$Project->setuptime_DateTimeObj->datetime?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案所需時程(天)
            </div>
            <div class="spanLineLeft">
                <input type="number" min="0" class="text" name="working_days" placeholder="請輸入專案所需時程(天)" value="<?=$Project->working_days?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                會員權限
            </div>
            <div class="spanLineLeft width300">
                <textarea name="permission_emails" style="height:100px;"><?if($Project->permission_uids_UserList->obj_arr):?><?foreach( $Project->permission_uids_UserList->obj_arr as $key => $value_User ):?><?=$value_User->email?>

<?endforeach?><?endif?></textarea>
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
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案進行狀態
            </div>
            <div class="spanLineLeft width500">
                <select name="project_status">
                    <option value="2" <?if($Project->project_status == 2):?> selected<?endif?>>開發中</option>
                    <option value="4" <?if($Project->project_status == 4):?> selected<?endif?>>已結案</option>
                </select>
            </div>
        </div>
    </div>
    <?if(!empty($Project->projectid)):?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                最後更新時間
            </div>
            <div class="spanLineLeft width500">
                <?=$Project->updatetime_DateTimeObj->datetime?>
            </div>
        </div>
    </div>
    <?endif?>
    <div class="spanLine spanSubmit">
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <?if(!empty($Project->projectid)):?><input type="hidden" name="projectid" value="<?=$Project->projectid?>"><?endif?>
                <input type="submit" class="submit" value="<?if(!empty($Project->projectid)):?>儲存變更<?else:?>新增專案<?endif?>">
                <?if(!empty($Project->projectid) && 0):?><a href="admin/<?=$child1_name?>/<?=$child2_name?>/project/prints?projectid=<?=$Project->projectid?>" target="_blank"><span class="submit">列印成估價單</span></a><?endif?>
                <?if(!empty($Project->projectid)):?><span class="submit gray" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?projectid=<?=$Project->projectid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除<?=$child3_title?></span><?endif?>
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
                <input id="pay_price_total" type="number" min="0" class="text" name="pay_price_total" value="<?=$Project->pay_price_total?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案已收款項 (NT$)
            </div>
            <div class="spanLineLeft">
                <input id="pay_price_receive" type="number" min="0" class="text" name="pay_price_receive" value="<?=$Project->pay_price_receive?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案付款進度 (%)
            </div>
            <div class="spanLineLeft">
                <!-- <input id="pay_price_schedule_input" type="hidden" name="pay_price_schedule" value="<?=$Project->pay_price_schedule?>">
                <span id="pay_price_schedule" style="margin-left:5px;" class="red"></span> -->
                <input type="number" class="text" min="0" max="100" name="pay_price_schedule" value="<?=$Project->pay_price_schedule?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案應支付款 (%)
            </div>
            <div class="spanLineLeft">
                <input type="number" class="text" min="0" max="100" name="pay_price_schedule2" value="<?=$Project->pay_price_schedule2?>">
            </div>
        </div>
    </div>
    <?if($Project->pay_status == 1):?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                轉帳帳號
            </div>
            <div class="spanLineLeft">
                <?=$Project->pay_account?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                轉帳人姓名
            </div>
            <div class="spanLineLeft">
                <?=$Project->pay_name?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                轉帳時間
            </div>
            <div class="spanLineLeft width500">
                <?=$Project->pay_paytime_DateTimeObj->datetime?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                付款備註
            </div>
            <div class="spanLineLeft width500">
                <?=$Project->pay_remark?>
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
                <?if($Project->pay_status == 0):?>
                <span class="red">會員尚未填寫付款資訊</span>
                <?elseif($Project->pay_status == 1):?>
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
                <select name="paycheck_status" class="<?if($Project->paycheck_status == 0):?>red<?elseif($Project->paycheck_status == 1):?>green<?endif?>">
                    <option value="0" class="red"<?if($Project->paycheck_status == 0):?> selected<?endif?>>款項待確認</option>
                    <option value="1" class="green"<?if($Project->paycheck_status == 1):?> selected<?endif?>>款項已確認</option>
                </select>
            </div>
        </div>
    </div>
</div>
<?if(!empty($projectid)):?>
<?if(!empty($SuggestList->obj_arr)):?>
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
            <?foreach($SuggestList->obj_arr as $key => $value_Suggest):?>
            <div class="spanLine order tablelist" style="border-bottom: 0px solid #EEE;">
                <div class="spanLineLeft text width300">
                    <a href="admin/<?=$child1_name?>/<?=$child2_name?>/suggest/edit/?suggestid=<?=$value_Suggest->suggestid?>&projectid=<?=$Project->projectid?>" target="_blank">
                        <?=$value_Suggest->title?>
                    </a>
                </div>
                <div class="spanLineLeft text width100">
                    <?if($value_Suggest->answer_status == 1):?>
                    <span class="green">評估中</span>
                    <?elseif($value_Suggest->answer_status == 2):?>
                    <span class="green">修改中</span>
                    <?elseif($value_Suggest->answer_status == 3):?>
                    <span>已完成</span>
                    <?endif?>
                </div>
                <div class="spanLineLeft text width150">
                    <?=$value_Suggest->suggest_time_DateTime->datetime?>
                </div>
            </div>
            <?endforeach?>
        </div>
    </div>
</div>
<?endif?>
<?endif?>
</form>
<div class="contentBox allWidth" style="display:none;">
    <h3>設計項目列表</h3>
    <h4>請確認本專案之設計項目資訊</h4>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案設計項目
            </div>
            <div class="spanLineLeft width600 stock_area">
                <?if($Project->DesignList->obj_arr):?>
                <?foreach($Project->DesignList->obj_arr as $key => $value_Design):?>
                <div class="selectLine">
                    <input type="text" class="text title" style="width:200px;" name="titleArr[]" placeholder="名稱" data-value="<?=$value_Design->title?>" value="<?=$value_Design->title?>">
                    <input type="number" class="text width100 price" name="priceArr[]" placeholder="報價" data-value="<?=$value_Design->price?>" value="<?=$value_Design->price?>">
                    <input type="number" class="text width100 days" name="daysArr[]" placeholder="時程" data-value="<?=$value_Design->days?>" value="<?=$value_Design->days?>">
                    <textarea style="height:100px;" name="synopsisArr[]" placeholder="內容" data-value="<?=$value_Design->synopsis?>"><?=$value_Design->synopsis?></textarea>
                    <input type="hidden" class="designid" name="designidArr[]" value="<?=$value_Design->designid?>">
                    <span class="move">移動</span>
                    <span class="copy">複製</span>
                    <span class="delete">清除</span>
                </div>
                <?endforeach?>
                <?else:?>
                <div class="selectLine">
                    <input type="text" class="text title" style="width:200px;" name="titleArr[]" placeholder="名稱" data-value="" value="">
                    <input type="number" class="text width100 price" name="priceArr[]" placeholder="報價" data-value="" value="">
                    <input type="number" class="text width100 days" name="daysArr[]" placeholder="時程">
                    <textarea style="height:100px;" name="synopsisArr[]" placeholder="內容" data-value=""></textarea>
                    <input type="hidden" class="designid" name="designidArr[]" value="">
                </div>
                <?endif?>
            </div>
            <div class="selectLine stock_line_clone" style="display: none;">
                <input type="text" class="text title" style="width:200px;" name="titleArr[]" placeholder="名稱" data-value="">
                <input type="number" class="text width100 price" name="priceArr[]" placeholder="報價" data-value="">
                <input type="number" class="text width100 days" name="daysArr[]" placeholder="時程">
                <textarea style="height:100px;" name="synopsisArr[]" placeholder="內容" data-value=""></textarea>
                <span class="move">移動</span>
                <span class="copy">複製</span>
                <span class="delete">清除</span>
            </div>
            <script>
            $(function(){
                $( ".stock_area" ).sortable({
                    handle: ".move"
                });
                $('.stock_line_clone').clone().removeClass('stock_line_clone').css('display', 'block').disableSelection().insertAfter('.stock_area .selectLine:last');
                $(document).on('change', '.stock_area .title', function(){
                    $(this).attr('data-value', $(this).val());
                    if( $(".stock_area > .selectLine > .title[data-value='']").size() === 0 )
                    {
                        $('.stock_line_clone').clone().removeClass('stock_line_clone').css('display', 'block').disableSelection().insertAfter('.stock_area .selectLine:last');
                    }
                });
                $('.stock_area .copy').disableSelection();
                $(document).on('click', '.stock_area .copy', function(){
                    $clone = $(this).parents('.selectLine').clone().insertAfter( $(this).parents('.selectLine') );
                    $clone.children('.designid').val('');
                    $clone.children('.title').removeAttr('disabled');
                    $clone.children('.price').removeAttr('disabled');
                });
                $('.stock_area .delete').disableSelection();
                $(document).on('click', '.stock_area .delete', function(){
                    var answer = confirm('確定要刪除嗎？');
                    if ( ! answer){
                        return false;
                    }
                    var designid = $(this).parents('.selectLine').children('.designid').val();
                    $.ajax({
                        url: 'api/project/delete_design_item/?designid=' + designid,
                        error: function(xhr){},
                        success: function(response){
                        }
                    });
                    if(
                        $(".stock_area > .selectLine").size() > 2
                    )
                    {
                        $(this).parent('.selectLine').remove();
                    }
                    else
                    {
                        $(this).parent('.selectLine').children(':input').val('');
                        $(this).parent('.selectLine').children(':input').attr('data-value', '');
                    }
                });
            });
            </script>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineLeft width500">
                <p class="gray">請填寫各設計項目的名稱、報價、時程及設計項目內容</p>
            </div>
        </div>
    </div>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>