<?=$temp['header_up']?>
<link href='js/tool/fullcalendar/fullcalendar.css' rel='stylesheet' />
<link href='js/tool/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title?> - <?=$child4_title?></h2>
<div class="fixed_window_close_bg"></div>
<div class="fixed_window customer_form">
    <?php echo form_open_multipart("admin/$child1_name/$child2_name/$child3_name/edit_post/") ?>
    <div class="fixed_window_title">任務設置</div>
    <div class="fixed_window_end">
        <span class="gray" fanswoo-window_close>取消</span>
        <a class="gray detail" href="">詳細資訊</a>
        <span class="red" fanswoo-customer_delete>刪除任務</span>
        <input type="submit" value="儲存任務">
    </div>
    <div class="fixed_window_content">
        <div class="spanLine">
            <div class="spanStage">
                <div class="spanLineLeft">
                    任務名稱
                </div>
                <div class="spanLineRight">
                    <input type="text" class="text" id="title" name="title" placeholder="請輸入問題標題" required>
                </div>
            </div>
        </div>
        <div class="spanLine">
            <div class="spanStage">
                <div class="spanLineLeft">
                    任務內容
                </div>
                <div class="spanLineRight">
                    <textarea id="content" name="content"></textarea>
                </div>
            </div>
        </div>
        <div class="spanLine">
            <div class="spanStage">
                <div class="spanLineLeft">
                    開始時間
                </div>
                <div class="spanLineRight">
                    <input type="text" class="text" id="start_time" name="start_time" placeholder="請輸入問題標題" value="<?=$Worktask->title?>" required>
                </div>
            </div>
        </div>
        <div class="spanLine">
            <div class="spanStage">
                <div class="spanLineLeft">
                    結束時間
                </div>
                <div class="spanLineRight">
                    <input type="text" class="text" id="end_time" name="end_time" placeholder="請輸入問題標題" value="<?=$Worktask->title?>" required>
                </div>
            </div>
        </div>
        <div class="spanLine">
            <div class="spanStage">
                <div class="spanLineLeft">
                    專案名稱
                </div>
                <div class="spanLineRight">
                    <select id="projectid" name="projectid">
                        <option value="">尚未選擇專案</option>
                        <?foreach( (array) $ProjectList->obj_arr as $key => $value_Project):?>
                        <option value="<?=$value_Project->projectid?>"><?=$value_Project->name?></option>
                        <?endforeach?>
                    </select>
                </div>
            </div>
        </div>
        <div class="spanLine">
            <div class="spanStage">
                <div class="spanLineLeft">
                    任務分類
                </div>
                <div class="spanLineRight">
                    <select id="classids" name="classids">
                        <option value="">尚未選擇任務分類</option>
                        <?foreach( (array) $WorktaskClassMetaList->obj_arr as $key => $value_ClassMeta):?>
                        <option value="<?=$value_ClassMeta->classid?>"><?=$value_ClassMeta->classname?></option>
                        <?endforeach?>
                    </select>
                </div>
            </div>
        </div>
        <div class="spanLine">
            <div class="spanStage">
                <div class="spanLineLeft">
                    被分派者
                </div>
                <div class="spanLineRight">
                    <select id="uid" name="uid">
                        <option value="">尚未選擇專案執行人</option>
                        <?foreach( (array) $UserList->obj_arr as $key => $value_User):?>
                        <option value="<?=$value_User->uid?>"><?=$value_User->username?></option>
                        <?endforeach?>
                    </select>
                </div>
            </div>
        </div>
        <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                目前進度
            </div>
            <div class="spanLineRight" >
                <select name="current_percent" id="current_percent">
                	<option value="0">0%</option>
                    <option value="10">10%</option>
                    <option value="20">20%</option>
                    <option value="30">30%</option>
                    <option value="40">40%</option>
                    <option value="50">50%</option>
                    <option value="60">60%</option>
                    <option value="70">70%</option>
                    <option value="80">80%</option>
                    <option value="90">90%</option>
                    <option value="100">100%</option>
                </select>
            </div>
        </div>
    </div>  
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                本次耗用時數
            </div>
            <div class="spanLineRight">
                <input type="number" id="this_use_hour" class="text" name="this_use_hour" value="">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                預估時數
            </div>
            <div class="spanLineRight">
                <input type="number" id="estimate_hour" class="text" name="estimate_hour" value="<?=$Worktask->estimate_hour?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                累計耗用時數
            </div>
            <div class="spanLineRight">
                <input type="number" id="use_hour" class="text" name="use_hour" value="<?=$Worktask->current_percent?>">
            </div>
        </div>
    </div>
        <div class="spanLine">
            <div class="spanStage">
                <div class="spanLineLeft">
                    執行狀態
                </div>
                <div class="spanLineRight">
                    <select id="work_status" name="work_status">
                        <option value="0">任務未完成</option>
                        <option value="1">任務完成，主管檢核中</option>
                        <option value="2">任務完成，主管審核通過</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="worktaskid" name="worktaskid">
    <input type="hidden" name="post_from" value="calendar">
    </form>
</div>
<div class="contentBox contentTablelist allWidth">
    <div style="margin-bottom: 10px;">
        <select name="search_uid" id="search_uid">
            <option value="0">不篩選任務執行人</option>
            <?foreach($UserList->obj_arr as $key => $value_User):?>
            <option value="<?=$value_User->uid?>"<?if($User->uid == $value_User->uid):?> selected<?endif?>><?=$value_User->username?>（ <?=$value_User->email?> ）</option>
            <?endforeach?>
        </select>
        <select name="search_projectid" id="search_projectid">
            <option value="0">不篩選專案</option>
            <?foreach($ProjectList->obj_arr as $key => $value_Project):?>
            <option value="<?=$value_Project->projectid?>"><?=$value_Project->name?></option>
            <?endforeach?>
        </select>
    </div>
	<div class="calendarContent">
        <div id='calendar'></div>
    </div>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>