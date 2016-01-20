<?=$temp['header_up']?>
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
                專案管理人
            </div>
            <div class="spanLineLeft width300">
                <input type="text" class="text" name="admin_uid_Num" placeholder="請輸入專案管理人email" value="<?=$admin_User->email_Str?>">
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
                <textarea name="permission_emails_Str" style="height:100px;"><?if($Project->permission_uids_UserList->obj_Arr):?><?foreach( $Project->permission_uids_UserList->obj_Arr as $key => $value_User ):?><?=$value_User->email_Str?>

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
</div>
<div class="contentBox allWidth">
    <h3>設計項目列表</h3>
    <h4>請確認本專案之設計項目資訊</h4>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案設計項目
            </div>
            <div class="spanLineLeft width600 stock_area">
                <?if($Project->DesignList->obj_Arr):?>
                <?foreach($Project->DesignList->obj_Arr as $key => $value_Design):?>
                <div class="selectLine">
                    <input type="text" class="text title" style="width:200px;" name="title_StrArr[]" placeholder="名稱" data-value="<?=$value_Design->title_Str?>" value="<?=$value_Design->title_Str?>">
                    <input type="number" class="text width100 price" name="price_NumArr[]" placeholder="報價" data-value="<?=$value_Design->price_Num?>" value="<?=$value_Design->price_Num?>">
                    <input type="number" class="text width100 days" name="days_NumArr[]" placeholder="時程" data-value="<?=$value_Design->days_Num?>" value="<?=$value_Design->days_Num?>">
                    <textarea style="height:100px;" name="synopsis_StrArr[]" placeholder="內容" data-value="<?=$value_Design->synopsis_Str?>"><?=$value_Design->synopsis_Str?></textarea>
                    <input type="hidden" class="designid" name="designid_NumArr[]" value="<?=$value_Design->designid_Num?>">
                    <span class="move">移動</span>
                    <span class="copy">複製</span>
                    <span class="delete">清除</span>
                </div>
                <?endforeach?>
                <?else:?>
                <div class="selectLine">
                    <input type="text" class="text title" style="width:200px;" name="title_StrArr[]" placeholder="名稱" data-value="" value="">
                    <input type="number" class="text width100 price" name="price_NumArr[]" placeholder="報價" data-value="" value="">
                    <input type="number" class="text width100 days" name="days_NumArr[]" placeholder="時程">
                    <textarea style="height:100px;" name="synopsis_StrArr[]" placeholder="內容" data-value=""></textarea>
                    <input type="hidden" class="designid" name="designid_NumArr[]" value="">
                </div>
                <?endif?>
            </div>
            <div class="selectLine stock_line_clone" style="display: none;">
                <input type="text" class="text title" style="width:200px;" name="title_StrArr[]" placeholder="名稱" data-value="">
                <input type="number" class="text width100 price" name="price_NumArr[]" placeholder="報價" data-value="">
                <input type="number" class="text width100 days" name="days_NumArr[]" placeholder="時程">
                <textarea style="height:100px;" name="synopsis_StrArr[]" placeholder="內容" data-value=""></textarea>
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
                專案付款進度 (%)
            </div>
            <div class="spanLineLeft">
                <!-- <input id="pay_price_schedule_input" type="hidden" name="pay_price_schedule_Num" value="<?=$Project->pay_price_schedule_Num?>">
                <span id="pay_price_schedule" style="margin-left:5px;" class="red"></span> -->
                <input type="number" class="text" min="0" max="100" name="pay_price_schedule_Num" value="<?=$Project->pay_price_schedule_Num?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                專案應支付款 (%)
            </div>
            <div class="spanLineLeft">
                <input type="number" class="text" min="0" max="100" name="pay_price_schedule2_Num" value="<?=$Project->pay_price_schedule2_Num?>">
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
    <?if(!empty($Project->projectid_Num)):?>
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
    <?endif?>
    <div class="spanLine spanSubmit">
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <?if(!empty($Project->projectid_Num)):?><input type="hidden" name="projectid_Num" value="<?=$Project->projectid_Num?>"><?endif?>
                <input type="submit" class="submit" value="<?if(!empty($Project->projectid_Num)):?>儲存變更<?else:?>新增專案<?endif?>">
                <?if(!empty($Project->projectid_Num)):?><a href="admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/project/prints?projectid=<?=$Project->projectid_Num?>" target="_blank"><span class="submit">列印成估價單</span></a><?endif?>
                <?if(!empty($Project->projectid_Num)):?><span class="submit gray" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/delete/?projectid=<?=$Project->projectid_Num?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除<?=$child3_title_Str?></span><?endif?>
            </div>
        </div>
    </div>
</div>
</form>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>