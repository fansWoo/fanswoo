<?=$temp['header_up']?>
<script>
$(function(){

    var design_price_input = 0;

    $(".design_price").each(function(key, value){

        design_price_input += parseInt($(".design_price").eq(key).text());
        $("#design_price_input").val(design_price_input);

    });

    

    // $(".checkbox").each(function(key, value){

    //     $(".checkbox").eq(key).click(function() {
    //     $(".checkbox").eq(key).attr("id","checkbox_value");
    //     // $(".checkbox").eq(key).prop("checked",true);
    //     console.log($(".checkbox").eq(key));
    // });

        // $(".checkbox").each(function(key, value){

        //     $(".checkbox").eq(key).click(function() {
        //     $(".checkbox").eq(key).attr("id","checkbox_value");
        //     // $(".checkbox").eq(key).prop("checked",true);
        //     });
        // });

        // $(document).on('click', "#design_price_input", function(){
        //     $("#design_price_input").val(200);
    // });
});
</script>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title_Str?> - <?=$child3_title_Str?></h2>
<div class="contentBox allWidth">
    <h3><?=$child3_title_Str?> > <?if(!empty($Project->projectid_Num)):?>編輯<?else:?>新增<?endif?></h3>
    <h4>請填寫<?=$child3_title_Str?>之詳細資訊</h4>
    <?php echo form_open_multipart("admin/$child1_name_Str/$child2_name_Str/$child3_name_Str/{$child4_name_Str}_post/") ?>
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
            <div class="spanLineLeft width500" fanswoo-selectEachDiv="class">
                <?if(!empty($Project->class_ClassMetaList->obj_Arr)):?>
                <?foreach($Project->class_ClassMetaList->obj_Arr as $key => $value_ClassMeta):?>
                    <div class="selectLine" fanswoo-selectEachLine>
                        <span class="floatleft">分類 <span fanswoo-selectEachLineCount></span> ：</span>
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
                <?endif?>
                <div class="selectLine" fanswoo-selectEachLine>
                    <span class="floatleft">分類 <span fanswoo-selectEachLineCount></span> ：</span>
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
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineLeft width500">
                <span class="gray">請選擇二級分類及分類標籤，多種分類可以重複選取</span>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                設計項目類別
            </div>
            <div class="spanLineRight">
                <?foreach($ProjectDesignList->obj_Arr as $key => $value_Design):?>
                <div class="checkbox_item">
                    <input type="checkbox" class="checkbox" name="designids_Str[]" value="<?=$value_Design->designid_Num?>" <?foreach($project_designids_Arr as $key2 => $value_project_designids):?><?if($value_Design->designid_Num == $value_project_designids):?> checked<?else:?><?endif?><?endforeach?>><span style="margin-left:5px;" required><?=$value_Design->title_Str?></span><br>  
                </div>
                <?endforeach?>
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineLeft width500">
                <a href="admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/design/tablelist">管理設計項目類別</a>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                項目加總費用
            </div>
            <div class="spanLineLeft" style="display:none;">
                <?foreach($DesignPriceList->obj_Arr as $key => $value_DesignPrice):?>
                    <span class="design_price"><?=$value_DesignPrice->price_Num?></span>
                <?endforeach?>
            </div>
            <div class="spanLineLeft">
                <?if(!empty($Project->designids_Str)):?>
                    <input id="design_price_input" type="number" min="0" class="text" name="pay_price_total_Num" readonly style="cursor: pointer;">
                <?else:?>
                    <span class="red">請選擇設計項目</span>
                <?endif?>
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <p class="gray">儲存專案後改變金額</p>
                <!-- <p class="gray">點選輸入框重新計算金額</p> -->
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
                <span class="gray">請填寫擁有查看此專案系統權限之會員ID，每個ID一行</span>
            </div>
        </div>
    </div>
    <div style="margin:30px 0;"></div>
    <h3>付款資訊</h3>
    <h4>請確認本訂單之付款資訊</h4>
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
    <div style="margin:30px 0;"></div>
    <h3>專案修改建議</h3>
    <h4>請確認專案修改建議</h4>
    <div class="spanLine">
        <?if( !empty($Project->comment_CommentList->obj_Arr) ):?>
        <div class="spanStage">
            <div class="spanLineLeft">
                專案修改建議
            </div>
            <div class="spanLineLeft width500">
                <?foreach($Project->comment_CommentList->obj_Arr as $key => $value_Comment):?>
                <p><?=$value_Comment->uid_User->username_Str?> <span class="gray"><?=$value_Comment->updatetime_DateTime->datetime_Str?></span></p>
                <div style="word-wrap:break-word;"><?=$value_Comment->content_Html?></div>
                <div style="border-top: 1px #CCC dashed;margin:10px 0;"></div>
                <?endforeach?>
            </div>
        </div>
        <?endif?>
        <div class="spanStage">
            <div class="spanLineLeft">
                <?if( empty($Project->comment_CommentList->obj_Arr) ):?>
                專案修改建議
                <?endif?>
            </div>
            <div class="spanLineLeft width500">
                <textarea cols="80" name="content_Str" rows="10" placeholder="請填寫新的專案修改建議..."></textarea>
            </div>
        </div>
    </div>
    <div style="margin:30px 0;"></div>
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
                <?if(!empty($Project->projectid_Num)):?><span class="submit gray" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/delete/?noteid=<?=$Project->projectid_Num?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除<?=$child3_title_Str?></span><?endif?>
            </div>
        </div>
    </div>
    </form>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>