<?=$temp['header_up']?>
<script>
Temp.ready(function(){
    $(document).on('click', ':button#delete', function(event){
        if( confirm('刪除後將進入回收空間，確定要刪除嗎？') )
        {
            $(':submit#delete').click();
        }
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
        <div class="spanLineLeft">
			<a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit" class="button">新增<?=$child3_title?></a>
        </div>
	</div>
	<div class="spanLineTable">
        <div class="spanLineTableContent">
            <div class="spanLine tablelist tableTitle">
                <?if(!empty($product_ProductShopList->obj_arr)):?>
                <div class="spanLineLeft checkbox"></div>
                <?endif?>
                <div class="spanLineLeft text width100">
        			產品ID
                </div>
                <div class="spanLineLeft text width300">
        			產品名稱
                </div>
                <div class="spanLineLeft text width150">
                    產品分類標籤
                </div>
                <div class="spanLineLeft text width150">
                    產品倉儲編號
                </div>
                <div class="spanLineLeft text width100">
                    產品上架狀態
                </div>
                <div class="spanLineLeft text width150">
                    編輯操作
                </div>
        	</div>
            <div class="spanLine tablelist">
                <?php echo form_open("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
                    <?if(!empty($product_ProductShopList->obj_arr)):?>
                    <div class="spanLineLeft checkbox">
                        <input type="checkbox" id="check_all">
                    </div>
                    <?endif?>
                    <div class="spanLineLeft text width100">
                        <input type="number" class="text" style="margin-left:-6px;" value="<?=!empty($search_productid)?$search_productid:''?>" name="search_productid" placeholder="請填寫ID">
                    </div>
                    <div class="spanLineLeft text width300">
                        <input type="text" class="text" style="margin-left:-6px;" value="<?=!empty($search_name)?$search_name:''?>" name="search_name" placeholder="請填寫產品名稱">
                    </div>
                    <div class="spanLineLeft text width150">
                        <select name="search_class_slug" style="margin-left:-6px;">
                            <option value="">不透過分類標籤篩選</option>
                            <?foreach($class_ClassMetaList->obj_arr as $key => $value_ClassMeta):?>
                            <option value="<?=$value_ClassMeta->slug?>"<?if(!empty($search_class_slug) && $search_class_slug == $value_ClassMeta->slug) echo ' selected'?>><?=$value_ClassMeta->classname?></option>
                            <?endforeach?>
                        </select>
                    </div>
                    <div class="spanLineLeft text width150">
                        <input type="text" class="text" value="<?=!empty($search_warehouseid)?$search_warehouseid:''?>" name="search_warehouseid" placeholder="請填寫產品倉儲編號">
                    </div>
                    <div class="spanLineLeft text width100">
                        <select name="search_shelves_status" style="margin-left:-6px;min-width:85px;">
                            <option value="1"<?if(!empty($search_shelves_status) && $search_shelves_status == 1):?>selected<?endif?>>已上架</option>
                            <option value="2"<?if(!empty($search_shelves_status) && $search_shelves_status == 2):?>selected<?endif?>>未上架</option>
                        </select>
                    </div>
                    <div class="spanLineLeft text width150">
                        <input type="submit" class="button filter" value="篩選">
                    </div>
                </form>
            </div>
            <?if(!empty($product_ProductShopList->obj_arr)):?>
            <?php echo form_open("admin/$child1_name/$child2_name/$child3_name/delete_batch_post/") ?>
            <?foreach($product_ProductShopList->obj_arr as $key => $value_ProductShop):?>
            <div class="spanLine tablelist">
                <div class="spanLineLeft checkbox">
                    <input type="checkbox" name="productid_arr[]" value="<?=$value_ProductShop->productid?>" class="check">
                </div>
                <div class="spanLineLeft text width100">
                    <?=$value_ProductShop->productid?>
                </div>
                <div class="spanLineLeft text width300">
                    <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit/?productid=<?=$value_ProductShop->productid?>"><?=$value_ProductShop->name?></a>
                </div>
                <div class="spanLineLeft text width150">
                    <?if(!empty($value_ProductShop->class_ClassMetaList->obj_arr)):?>
                    <?foreach($value_ProductShop->class_ClassMetaList->obj_arr as $key => $value_ClassMeta):?>
                        <?if($key !== 0):?>,<?endif?><?=$value_ClassMeta->classname?>
                    <?endforeach?>
                    <?else:?>
                    <span class="gray">沒有分類標籤</span>
                    <?endif?>
                </div>
                <div class="spanLineLeft text width150">
                    <?if( !empty($value_ProductShop->warehouseid) ):?><?=$value_ProductShop->warehouseid?></a><?else:?>未填寫倉儲編號<?endif?>
                </div>
                <div class="spanLineLeft text width100">
                    <?if($value_ProductShop->shelves_status ==1 ):?>
                    已上架
                    <?else:?>
                    未上架
                    <?endif?>
                </div>
                <div class="spanLineLeft width150 tablelistMenu">
                    <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit/?productid=<?=$value_ProductShop->productid?>">編輯</a>
                    <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/copy/?productid=<?=$value_ProductShop->productid?>">複製</a>
                    <span class="ahref" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?productid=<?=$value_ProductShop->productid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除</span>
                </div>
        	</div>
            <?endforeach?>
            <input type="submit" id="delete" class="button" style="display:none;">
            </form>
            <?else:?>
            <div class="spanLine">
                <div class="spanLineLeft text width500">
                    這個篩選條件沒有搜尋到結果，請選擇其它篩選條件
                </div>
            </div>
            <?endif?>
        </div>
    </div>
    <?if(!empty($product_ProductShopList->obj_arr[0]->productid)):?>
    <div class="batch_deletion">
        <input type="button" class="button" id="delete" style="height: 32px;" value="批量刪除">
    </div>
    <?endif?>
    <div class="pageLink"><?=$product_links?></div>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>