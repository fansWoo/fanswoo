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
                <div class="spanLineLeft text width100">
                    設計項目ID
                </div>
                <div class="spanLineLeft text width300">
        			設計項目名稱
                </div>
                <div class="spanLineLeft text width150">
        			設計項目報價 (NT$)
                </div>
                <div class="spanLineLeft text width150">
                    設計項目分類標籤
                </div>
                <div class="spanLineLeft text width150">
                    編輯操作
                </div>
        	</div>
            <div class="spanLine tablelist">
                <?php echo form_open("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
                    <div class="spanLineLeft text width100">
                        <input type="number" class="text" style="margin-left:-6px;" value="<?=!empty($search_designid)?$search_designid:''?>" name="search_designid" placeholder="請填寫ID">
                    </div>
                    <div class="spanLineLeft text width300">
                        <input type="text" class="text" style="margin-left:-6px;" value="<?=!empty($search_title)?$search_title:''?>" name="search_title" placeholder="請填寫設計項目名稱">
                    </div>
                    <div class="spanLineLeft text width150">
                        <input type="number" class="text" style="margin-left:-6px;" value="<?=!empty($search_price)?$search_price:''?>" name="search_price" placeholder="請填寫報價金額">
                    </div>
                    <div class="spanLineLeft text width150">
                        <select name="search_class_slug" style="margin-left:-6px;">
                            <option value="">不透過分類標籤篩選</option>
                            <?foreach($DesignClassMetaList->obj_arr as $key => $value_ClassMeta):?>
                            <option value="<?=$value_ClassMeta->slug?>"<?if(!empty($search_class_slug) && $search_class_slug == $value_ClassMeta->slug) echo ' selected'?>><?=$value_ClassMeta->classname?></option>
                            <?endforeach?>
                        </select>
                    </div>
                    <div class="spanLineLeft text width150">
                        <input type="submit" class="button" style="height: 30px; margin-left:-6px;" value="篩選">
                    </div>
                </form>
            </div>
            <?if(!empty($DesignList->obj_arr)):?>
            <?foreach($DesignList->obj_arr as $key => $value_Design):?>
            <div class="spanLine tablelist">
                <div class="spanLineLeft text width100">
                    <?=$value_Design->designid?>
                </div>
                <div class="spanLineLeft text width300">
                    <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit/?designid=<?=$value_Design->designid?>">
                        <?=$value_Design->title?>
                    </a>
                </div>
                <div class="spanLineLeft text width150">
                    <?=$value_Design->price?>
                </div>
                <div class="spanLineLeft text width150">
                    <?if(!empty($value_Design->class_ClassMetaList->obj_arr)):?>
                    <?foreach($value_Design->class_ClassMetaList->obj_arr as $key => $value_ClassMeta):?>
                        <?if($key !== 0):?>,<?endif?><?=$value_ClassMeta->classname?>
                    <?endforeach?>
                    <?else:?>
                    <span class="gray">沒有分類標籤</span>
                    <?endif?>
                </div>
                <div class="spanLineLeft width150 tablelistMenu">
                    <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit/?designid=<?=$value_Design->designid?>">編輯</a>
                    <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/copy/?designid=<?=$value_Design->designid?>">複製</a>
                    <span class="ahref" onClick="fanswoo.check_href_action('確定要刪除這個設計項目？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?designid=<?=$value_Design->designid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除</span>
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
    <div class="pageLink"><?=$design_links?></div>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>