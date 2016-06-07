<?=$temp['header_up']?>
<script src="js/tool/ckeditor/ckeditor.js"></script>
<script>
Temp.ready(function(){
    CKEDITOR.replace( 'content', {
        toolbar: 'html'
    });
    CKEDITOR.replace( 'content_specification', {
        toolbar: 'html'
    });
});
</script>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title?> - <?=$child3_title?></h2>
<div class="contentBox allWidth">
    <h3><?=$child3_title?> > <?if(!empty($product_ProductShop->productid)):?>編輯<?else:?>新增<?endif?></h3>
	<h4>請填寫<?=$child3_title?>之詳細資訊</h4>
	<?php echo form_open_multipart("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
    <?if(!empty($product_ProductShop->productid)):?>
        <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                產品連結
            </div>
            <div class="spanLineLeft width500">
                <a href="<?=base_url('product/'.$product_ProductShop->productid)?>" target="_blank">
                    <?=$_SERVER['HTTP_HOST'].base_url('product/'.$product_ProductShop->productid)?>
                </a>
            </div>
        </div>
    </div>
    <?endif?>
    <div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                產品名稱
            </div>
            <div class="spanLineLeft width500">
                <input type="text" class="text" name="name" placeholder="請輸入產品名稱" value="<?=$product_ProductShop->name?>" required>
		    </div>
		</div>
	</div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                產品倉儲編號
            </div>
            <div class="spanLineLeft">
                <input type="text" class="text" name="warehouseid" placeholder="請輸入產品倉儲編號" value="<?=$product_ProductShop->warehouseid?>">
            </div>
        </div>
    </div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                產品售價
            </div>
            <div class="spanLineLeft">
                <input type="number" min="0" class="text" name="price" placeholder="請輸入產品售價" value="<?=$product_ProductShop->price?>">
		    </div>
		</div>
	</div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                產品成本
            </div>
            <div class="spanLineLeft">
                <input type="number" min="0" class="text" name="cost" placeholder="請輸入產品成本" value="<?=$product_ProductShop->cost?>">
            </div>
        </div>
    </div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                產品圖片
            </div>
            <div class="spanLineRight">
                <div fanswoo-pic_upload_ajax fanswoo-upload_status="hidden">上傳更多圖片</div>
                <div class="picidUploadList" fanswoo-piclist>
                    <div fanswoo-picid class="picidUploadLi" fanswoo-clone>
                        <div class="pic"><img src="" fanswoo-picid_img></div>
                        <div class="other">
                            <div class="pic_copy"><input type="text" fanswoo-picid_path_input fanswoo-input_copy readonly /></div>
                            <div fanswoo-pic_delete class="pic_delete">刪除圖片</div>
                        </div>
                        <input type="hidden" fanswoo-picid_input_hidden_picid name="picids_arr[]">
                    </div>
                    <?if(!empty($product_ProductShop->pic_PicObjList->obj_arr)):?>
                    <?foreach($product_ProductShop->pic_PicObjList->obj_arr as $key => $value_PicObj):?>
                    <div fanswoo-picid="<?=$value_PicObj->picid?>" class="picidUploadLi">
                        <div class="pic"><img src="<?=$value_PicObj->path_arr['w50h50']?>" fanswoo-picid_img></div>
                        <div class="other">
                            <div class="pic_copy"><input type="text" fanswoo-picid_path_input fanswoo-input_copy readonly value="<?=$value_PicObj->path_arr['w0h0']?>" /></div>
                            <div fanswoo-pic_delete class="pic_delete">刪除圖片</div>
                        </div>
                        <input type="hidden" fanswoo-picid_input_hidden_picid name="picids_arr[]" value="<?=$value_PicObj->picid?>">
                    </div>
                    <?endforeach?>
                    <?endif?>
                </div>
		    </div>
		</div>
	    <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineLeft width500">
                <span class="gray">請上傳300x300之圖檔，多張圖檔將以第一張為默認顯示圖檔</span>
		    </div>
		</div>
	</div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                產品分類
            </div>
            <div class="spanLineLeft width500" fanswoo-selectEachDiv="class">
                <?if(!empty($product_ProductShop->class_ClassMetaList->obj_arr)):?>
                <?foreach($product_ProductShop->class_ClassMetaList->obj_arr as $key => $value_ClassMeta):?>
                    <div class="selectLine" fanswoo-selectEachLine>
                        <span class="floatleft">分類 <span fanswoo-selectEachLineCount></span> ：</span>
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
                                    $test_ClassMetaList = new ObjList([
                                        'db_where_arr' => [
                                            'modelname' => 'product_shop'
                                        ],
                                        'db_where_or_arr' => [
                                            'classids' => [$value2_ClassMeta->classid]
                                        ],
                                        'model_name' => 'ClassMeta',
                                        'limitstart' => 0,
                                        'limitcount' => 100
                                    ]);
                                ?>
                                <?foreach($test_ClassMetaList->obj_arr as $key3 => $value3_ClassMeta):?>
                                <option value="<?=$value3_ClassMeta->classid?>"<?if($value_ClassMeta->classid == $value3_ClassMeta->classid):?> selected<?endif?>><?=$value3_ClassMeta->classname?></option>
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
                        <?foreach($class2_ClassMetaList->obj_arr as $key2 => $value2_ClassMeta):?>
                        <option value="<?=$value2_ClassMeta->classid?>"><?=$value2_ClassMeta->classname?></option>
                        <?endforeach?>
                    </select>
                    <span fanswoo-selectEachLineSlave="class">
                    <?foreach($class2_ClassMetaList->obj_arr as $key2 => $value2_ClassMeta):?>
                        <select name="classids_arr[]" fanswoo-selectValue="<?=$value2_ClassMeta->classid?>" fanswoo-selectName="classids_arr[]" style="display:none;">
                            <option value="">沒有分類標籤</option>
                            <?
                                $test_ClassMetaList = new ObjList([
                                    'db_where_arr' => [
                                        'modelname' => 'product_shop'
                                    ],
                                    'db_where_or_arr' => [
                                        'classids' => [$value2_ClassMeta->classid]
                                    ],
                                    'model_name' => 'ClassMeta',
                                    'limitstart' => 0,
                                    'limitcount' => 100
                                ]);
                            ?>
                            <?foreach($test_ClassMetaList->obj_arr as $key3 => $value3_ClassMeta):?>
                            <option value="<?=$value3_ClassMeta->classid?>"><?=$value3_ClassMeta->classname?></option>
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
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineLeft width500">
                <a href="admin/<?=$child1_name?>/<?=$child2_name?>/classmeta/tablelist">管理分類標籤</a>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                產品庫存
            </div>
            <div class="spanLineLeft width600 stock_area">
                <?if($product_ProductShop->stock_StockProductShopList->obj_arr):?>
                <?foreach($product_ProductShop->stock_StockProductShopList->obj_arr as $key => $value_StockProductShop):?>
                <div class="selectLine">
                    <input type="text" class="text width100 stock_class1" name="stock_classname1Arr[]" placeholder="規格1" data-value="<?=$value_StockProductShop->classname1?>" value="<?=$value_StockProductShop->classname1?>" readonly required>
                    <input type="text" class="text width100 stock_class2" name="stock_classname2Arr[]" placeholder="規格2" data-value="<?=$value_StockProductShop->classname2?>" value="<?=$value_StockProductShop->classname2?>" readonly required>
                    <input type="text" class="text width100 color_rgb" name="stock_color_rgbArr[]" placeholder="RGB色碼" data-value="<?=$value_StockProductShop->color_rgb?>" value="<?=$value_StockProductShop->color_rgb?>" required>
                    <input type="number" class="text width100" min="0" name="stock_stocknumArr[]" placeholder="庫存" data-value="<?=$value_StockProductShop->stocknum?>" value="<?=$value_StockProductShop->stocknum?>" required>
                    <input type="hidden" class="stock_class1_disabled" name="stock_classname1Arr[]" data-value="<?=$value_StockProductShop->classname1?>" value="<?=$value_StockProductShop->classname1?>">
                    <input type="hidden" class="stock_class2_disabled" name="stock_classname2Arr[]" data-value="<?=$value_StockProductShop->classname2?>" value="<?=$value_StockProductShop->classname2?>">
                    <input type="hidden" class="stockid" name="stockidArr[]" value="<?=$value_StockProductShop->stockid?>">
                    <span class="move">移動</span>
                    <span class="copy">複製</span>
                    <span class="delete">清除</span>
                </div>
                <?endforeach?>
                <?else:?>
                <div class="selectLine">
                    <input type="text" class="text width100 stock_class1" name="stock_classname1Arr[]" placeholder="規格1" data-value="" value="" required>
                    <input type="text" class="text width100 stock_class2" name="stock_classname2Arr[]" placeholder="規格2" data-value="" value="" required>
                    <input type="text" class="text width100 color_rgb" name="stock_color_rgbArr[]" placeholder="RGB色碼" required>
                    <input type="number" class="text width100" min="0" name="stock_stocknumArr[]" placeholder="庫存" data-value="" value="" required>
                    <input type="hidden" class="stockid" name="stockidArr[]" value="">
                </div>
                <?endif?>
            </div>
            <div class="selectLine stock_line_clone" style="display: none;">
                <input type="text" class="text width100 stock_class1" name="stock_classname1Arr[]" placeholder="規格1" data-value="">
                <input type="text" class="text width100 stock_class2" name="stock_classname2Arr[]" placeholder="規格2" data-value="">
                <input type="text" class="text width100 color_rgb" name="stock_color_rgbArr[]" placeholder="RGB色碼">
                <input type="number" class="text width100" min="0" name="stock_stocknumArr[]" placeholder="庫存" data-value="">
                <span class="move">移動</span>
                <span class="copy">複製</span>
                <span class="delete">清除</span>
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineLeft width500">
                <p class="gray">請填寫規格1、規格2的庫存數量，可以依照不同種類之規格填寫顏色、尺寸等自定義規格</p>
                <p class="gray">至少必須填寫第一筆規格，讓系統計算庫存資訊</p>
            </div>
        </div>
    </div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                產品簡介
            </div>
            <div class="spanLineLeft width500">
                <textarea cols="80" id="synopsis" name="synopsis" rows="10"><?=$product_ProductShop->synopsis?></textarea>
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                產品內容
            </div>
            <div class="spanLineRight">
                <div fanswoo-pic_upload_ajax fanswoo-upload_status="unclassified">上傳更多圖片</div>
                <div class="picidUploadList" fanswoo-piclist>
                    <div fanswoo-picid class="picidUploadLi" fanswoo-clone>
                        <div class="pic"><img src="" fanswoo-picid_img></div>
                        <div class="other">
                            <div class="pic_copy"><input type="text" fanswoo-picid_path_input fanswoo-input_copy readonly /></div>
                            <div fanswoo-pic_delete class="pic_delete">刪除圖片</div>
                        </div>
                    </div>
                </div>
                <textarea cols="80" id="content" name="content" rows="10"><?=$product_ProductShop->content_Html?></textarea>
		    </div>
            <div class="spanLineLeft">
            </div>
		</div>
	</div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                產品規格
            </div>
            <div class="spanLineRight">
                <div fanswoo-pic_upload_ajax fanswoo-upload_status="unclassified">上傳更多圖片</div>
                <div class="picidUploadList" fanswoo-piclist>
                    <div fanswoo-picid class="picidUploadLi" fanswoo-clone>
                        <div class="pic"><img src="" fanswoo-picid_img></div>
                        <div class="other">
                            <div class="pic_copy"><input type="text" fanswoo-picid_path_input fanswoo-input_copy readonly /></div>
                            <div fanswoo-pic_delete class="pic_delete">刪除圖片</div>
                        </div>
                    </div>
                </div>
                <textarea cols="80" id="content_specification" name="content_specification" rows="10"><?=$product_ProductShop->content_specification_Html?></textarea>
            </div>
            <div class="spanLineLeft">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                 產品上架狀態
            </div>
            <div class="spanLineLeft">
                <select name="shelves_status">
                    <option value="1"<?if($product_ProductShop->shelves_status == 1):?> selected<?endif?>>已上架</option>
                    <option value="2"<?if($product_ProductShop->shelves_status == 2):?> selected<?endif?>>未上架</option>
                </select>
            </div>
        </div>
    </div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                優先排序指數
            </div>
            <div class="spanLineLeft">
                <input type="number" class="text width100" name="prioritynum" value="<?=$product_ProductShop->prioritynum?>">
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
    <?if(!empty($product_ProductShop->productid)):?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                更新日期
            </div>
            <div class="spanLineLeft">
                <?=$product_ProductShop->updatetime_DateTime->datetime?>
            </div>
        </div>
    </div>
    <?endif?>
	<div class="spanLine spanSubmit">
	    <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <?if(!empty($product_ProductShop->productid)):?><input type="hidden" name="productid" value="<?=$product_ProductShop->productid?>"><?endif?>
                <input type="submit" class="submit" name="send_bln" value="<?if(!empty($product_ProductShop->productid)):?>儲存變更<?else:?>新增產品<?endif?>">
                <input type="submit" class="submit" name="show_bln" value="存成草稿並預覽">
                <?if(!empty($product_ProductShop->productid)):?><span class="submit gray" onClick="fanswoo.check_href_action('刪除後將進入回收空間，確定要刪除嗎？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?productid=<?=$product_ProductShop->productid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除<?=$child3_title?></span><?endif?>
            </div>
        </div>
	</div>
	</form>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>