<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title_Str?> - <?=$child3_title_Str?></h2>
<div class="contentBox allWidth">
    <h3><?=$child3_title_Str?> > <?=$child4_title_Str?></h3>
    <h4>請選擇欲修改之<?=$child3_title_Str?></h4>
    <div class="spanLine noneBg">
        <div class="spanLineLeft">
            <a href="admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/edit" class="button">新增<?=$child3_title_Str?></a>
        </div>
    </div>
	<div class="spanLine tableTitle">
        <div class="spanLineLeft text width100">
            設計項目ID
        </div>
        <div class="spanLineLeft text width300">
			設計項目名稱
        </div>
        <div class="spanLineLeft text width150">
			設計項目報價 (NT$)
        </div>
	</div>
    <?php echo form_open("admin/$child1_name_Str/$child2_name_Str/$child3_name_Str/{$child4_name_Str}_post/") ?>
        <div class="spanLine">
            <div class="spanLineLeft text width100">
                <input type="number" class="text" style="margin-left:-6px;" value="<?=!empty($search_designid_Num)?$search_designid_Num:''?>" name="search_designid_Num" placeholder="請填寫ID">
            </div>
            <div class="spanLineLeft text width300">
                <input type="text" class="text" style="margin-left:-6px;" value="<?=!empty($search_title_Str)?$search_title_Str:''?>" name="search_title_Str" placeholder="請填寫設計項目名稱">
            </div>
            <div class="spanLineLeft text width150">
                <input type="number" class="text" style="margin-left:-6px;" value="<?=!empty($search_price_Num)?$search_price_Num:''?>" name="search_price_Num" placeholder="請填寫報價金額">
            </div>
            <div class="spanLineLeft text width150">
                <input type="submit" class="button" style="height: 30px; margin-left:-6px;" value="篩選">
            </div>
        </div>
    </form>
    <?if(!empty($DesignList->obj_Arr)):?>
    <?foreach($DesignList->obj_Arr as $key => $value_Design):?>
    <div class="spanLine">
        <div class="spanLineLeft text width100">
            <?=$value_Design->designid_Num?>
        </div>
        <div class="spanLineLeft text width300">
            <a href="admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/edit/?designid=<?=$value_Design->designid_Num?>">
                <?=$value_Design->title_Str?>
            </a>
        </div>
        <div class="spanLineLeft text width150">
            <?=$value_Design->price_Num?>
        </div>
        <div class="spanLineLeft width150 hoverHidden">
            <a href="admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/edit/?designid=<?=$value_Design->designid_Num?>">編輯</a>
            <span class="ahref" onClick="fanswoo.check_href_action('確定要刪除這個設計項目？', 'admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/delete/?designid=<?=$value_Design->designid_Num?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除</span>
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
    <div class="pageLink"><?=$design_links?></div>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>