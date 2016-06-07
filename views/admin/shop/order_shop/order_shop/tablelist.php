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
<h2>訂單管理 - 訂單列表</h2>
<div class="contentBox contentTablelist allWidth">
	<h3>訂單列表</h3>
	<h4>請填寫欲新增或更改之訂單</h4>
	<div class="spanLineTable">
        <div class="spanLineTableContent">
            <div class="spanLine tablelist tableTitle">
                <?if(!empty($OrderShopList->obj_arr)):?>
                <div class="spanLineLeft checkbox">
                    <input type="checkbox" id="check_all">
                </div>
                <?endif?>
                <div class="spanLineLeft text width100">
                    會員ID
                </div>
                <div class="spanLineLeft text width100">
        			訂單ID
                </div>
                <div class="spanLineLeft text width100">
                    款項支付狀態
                </div>
                <div class="spanLineLeft text width100">
        			款項確認狀態
                </div>
                <div class="spanLineLeft text width100">
        			貨物處理狀態
                </div>
                <div class="spanLineLeft text width100">
        			訂單執行狀態
                </div>
                <div class="spanLineLeft text width150">
                    下單時間
                </div>
                <div class="spanLineLeft text width100">
                    編輯操作
                </div>
        	</div>
            <?php echo form_open("admin/$child1_name/$child2_name/$child3_name/delete_batch_post/") ?>
            <?foreach($OrderShopList->obj_arr as $key => $value_OrderShop):?>
            <div class="spanLine tablelist">
                <div class="spanLineLeft checkbox">
                    <input type="checkbox" name="orderid_arr[]" value="<?=$value_OrderShop->orderid?>" class="check">
                </div>
                <div class="spanLineLeft text width100">
                    <?if(!empty($value_OrderShop->uid)):?>
                        <?=$value_OrderShop->uid?>
                    <?else:?>
                        非會員
                    <?endif?>
                </div>
                <div class="spanLineLeft text width100">
                    <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit/?orderid=<?=$value_OrderShop->orderid?>">
                        <?=$value_OrderShop->orderid?>
                    </a>
                </div>
                <div class="spanLineLeft text width100">
                    <?if($value_OrderShop->pay_status == 1):?>
                    <span class="green">訂購人已填</span>
                    <?elseif($value_OrderShop->pay_status == 0):?>
                    <span class="<?if($value_OrderShop->paycheck_status == 1):?>green<?else:?>red<?endif?>">訂購人未填</span>
                    <?endif?>
                </div>
                <div class="spanLineLeft text width100">
                    <?if($value_OrderShop->paycheck_status == 1):?>
                    <span class="green">款項已確認</span>
                    <?elseif($value_OrderShop->paycheck_status == 0):?>
                    <span class="red">款項未確認</span>
                    <?endif?>
                </div>
                <div class="spanLineLeft text width100">
                    <?if($value_OrderShop->product_status == 1):?>
                    <span class="green">貨物已備妥</span>
                    <?elseif($value_OrderShop->product_status == 0):?>
                    <span class="red">貨物準備中</span>
                    <?endif?>
                </div>
                <div class="spanLineLeft text width100">
                    <?if($value_OrderShop->order_status == 1):?>
                    <span class="green">訂單已完成</span>
                    <?elseif($value_OrderShop->order_status == 0):?>
                    <span class="red">訂單處理中</span>
                    <?endif?>
                </div>
                <div class="spanLineLeft text width150">
                    <?=$value_OrderShop->setuptime_DateTimeObj->datetime?>
                </div>
                <div class="spanLineLeft width100 tablelistMenu">
                    <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit/?orderid=<?=$value_OrderShop->orderid?>">編輯</a>
                    <span class="ahref" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?orderid=<?=$value_OrderShop->orderid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除</span>
                </div>
        	</div>
            <?endforeach?>
            <input type="submit" id="delete" class="button" style="display:none;">
            </form>
        </div>
    </div>
    <?if(!empty($OrderShopList->obj_arr[0]->orderid)):?>
    <div class="batch_deletion">
        <input type="button" class="button" id="delete" style="height: 32px;" value="批量刪除">
    </div>
    <?endif?>
    <div class="pageLink"><?=$page_links?></div>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>