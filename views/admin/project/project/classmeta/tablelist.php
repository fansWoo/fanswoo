<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title?> - <?=$child3_title?></h2>
<div class="contentBox contentTablelist allWidth">
    <h3><?=$child3_title?> > <?=$child4_title?></h3>
    <h4>請選擇欲修改之<?=$child3_title?></h4>
    <div class="spanLine noneBg">
        <div class="spanLineLeft">
            <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit" class="button">新增<?=$child3_title?></a>
        </div>
    </div>
    <div class="spanLineTable">
        <div class="spanLineTableContent">
            <div class="spanLine tablelist tableTitle">
                <div class="spanLineLeft text width300">
                    分類名稱
                </div>
                <div class="spanLineLeft text width150">
                    分類代號
                </div>
                <div class="spanLineLeft text width150">
                    二級分類標籤
                </div>
                <div class="spanLineLeft text width150">
                    編輯操作
                </div>
            </div>
            <div class="spanLine tablelist">
                <?php echo form_open("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
                    <div class="spanLineLeft text width300">
                        <input type="text" class="text" style="margin-left:-6px;" value="<?=!empty($search_classname)?$search_classname:''?>" name="search_classname" placeholder="請填寫標籤名稱">
                    </div>
                    <div class="spanLineLeft text width150">
                        <input type="text" class="text" style="margin-left:-6px;" value="<?=!empty($search_slug)?$search_slug:''?>" name="search_slug" placeholder="請填寫標籤代號">
                    </div>
                    <div class="spanLineLeft text width150">
                        <select name="search_class2_slug" style="margin-left:-6px;">
                            <option value="">不透過分類標籤篩選</option>
                            <?foreach($class2_ClassMetaList->obj_arr as $key => $value_ClassMeta):?>
                            <option value="<?=$value_ClassMeta->slug?>"<?if(!empty($search_class2_slug) && $search_class2_slug == $value_ClassMeta->slug) echo ' selected'?>><?=$value_ClassMeta->classname?></option>
                            <?endforeach?>
                        </select>
                    </div>
                    <div class="spanLineLeft text width150">
                        <input type="submit" class="button" style="height: 30px; margin-left:-6px;" value="篩選">
                    </div>
                </form>
            </div>
            <?if(!empty($class_list_ClassMetaList->obj_arr)):?>
            <?foreach($class_list_ClassMetaList->obj_arr as $key => $value_ClassMeta):?>
            <div class="spanLine tablelist">
                <div class="spanLineLeft text width300">
                    <?=$value_ClassMeta->classname?>
                </div>
                <div class="spanLineLeft text width150">
                    <?=$value_ClassMeta->slug?>
                </div>
                <div class="spanLineLeft text width150">
                    <?if(!empty($value_ClassMeta->class_ClassMetaList) && !empty($value_ClassMeta->class_ClassMetaList->obj_arr)):?>
                    <?foreach($value_ClassMeta->class_ClassMetaList->obj_arr as $key => $value2_ClassMeta):?>
                        <?if($key !== 0):?>,<?endif?><?=$value2_ClassMeta->classname?>
                    <?endforeach?>
                    <?else:?>
                    <span class="gray">沒有分類標籤</span>
                    <?endif?>
                </div>
                <div class="spanLineLeft width150 tablelistMenu">
                    <a href="admin/<?=$child1_name?>/<?=$child2_name?>/project/tablelist/?class_slug=<?=$value_ClassMeta->slug?>">查看專案</a>
                    <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit/?slug=<?=$value_ClassMeta->slug?>">編輯</a>
                    <span class="ahref" onClick="fanswoo.check_href_action('確定要刪除這個標籤？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?classid=<?=$value_ClassMeta->classid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除</span>
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
    <div class="pageLink"><?=$class_links?></div>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>