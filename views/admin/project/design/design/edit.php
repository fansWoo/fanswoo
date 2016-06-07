<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title?> - <?=$child3_title?></h2>
<div class="contentBox allWidth">
    <h3><?=$child3_title?> > <?if(!empty($Design->designid)):?>編輯<?else:?>新增<?endif?></h3>
    <h4>請填寫<?=$child3_title?>之詳細資訊</h4>
    <?php echo form_open("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                設計項目名稱
            </div>
            <div class="spanLineLeft width300">
                <input type="text" class="text" name="title" placeholder="請輸入設計項目名稱" value="<?=$Design->title?>">
            </div>
		</div>
	</div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                設計項目報價 (NT$)
            </div>
            <div class="spanLineLeft">
                <input type="number" min="0" class="text" name="price" placeholder="請輸入報價金額" value="<?=$Design->price?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                設計項目分類
            </div>
            <div class="spanLineLeft width500">
                <?if(!empty($Design->class_ClassMetaList->obj_arr)):?>
                    <?foreach($Design->class_ClassMetaList->obj_arr as $key => $value_ClassMeta):?>
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
                                                'modelname' => 'design'
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
                                            'modelname' => 'design'
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
                <span class="gray">請選擇二級分類及分類標籤，多種分類可以重複選取</span>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                設計項目簡介
            </div>
            <div class="spanLineLeft width300">
                <textarea name="synopsis"><?=$Design->synopsis?></textarea>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                優先排序指數
            </div>
            <div class="spanLineLeft">
                <input type="number" class="text width100" name="prioritynum" value="<?=$Design->prioritynum?>">
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <p class="gray">優先排序指數越高，排序順序越前面</p>
            </div>
        </div>
    </div>
    <?if(!empty($Design->designid)):?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                更新日期
            </div>
            <div class="spanLineLeft">
                <?=$Design->updatetime_DateTime->datetime?>
            </div>
        </div>
    </div>
    <?endif?>
	<div class="spanLine spanSubmit">
		<div class="spanLineLeft">
		</div>
		<div class="spanLineRight">
            <?if(!empty($Design->designid)):?><input type="hidden" name="designid" value="<?=$Design->designid?>"><?endif?>
		    <input type="submit" class="submit" value="<?if(!empty($Design->designid)):?>儲存變更<?else:?>新增設計項目<?endif?>">
            <?if(!empty($Design->designid)):?><span class="submit gray" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?designid=<?=$Design->designid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除<?=$child3_title?></span><?endif?>
		</div>
	</div>
	</form>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>