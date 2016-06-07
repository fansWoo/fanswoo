<?=$temp['header_up']?>
<script src="js/tool/jquery-ui-timepicker-addon/script.js"></script>
<link rel="stylesheet" type="text/css" href="js/tool/jquery-ui-timepicker-addon/style.css"></link>
<script>
Temp.ready(function(){
    $('#pay_paytime').datetimepicker({
        dateFormat: 'yy-mm-dd',
        timeFormat: 'HH:mm:ss'
    });
});
</script>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2>訂單管理 - 確認訂單</h2>
<div class="contentBox allWidth">
    <?php echo form_open("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
	<h3>訂單資訊</h3>
	<h4>請確認訂單、款項、貨物及收件資訊</h4>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                訂單編號
            </div>
            <div class="spanLineLeft width500">
                <?if(!empty($OrderShop->orderid)):?><?=$OrderShop->orderid?><?endif?>
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                訂購人E-mail
            </div>
            <div class="spanLineLeft width500">
                <?if(!empty($order_User->email)):?>
                <?=$order_User->email?>
                <?else:?>
                <?=$OrderShop->receive_email?>
                <?endif?>
		    </div>
		</div>
	</div>
    <div style="border-top: 2px #AAA dashed;margin:30px 0;"></div>
	<h3>付款資訊</h3>
	<h4>請確認本訂單之付款資訊</h4>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                付款方式
            </div>
            <div class="spanLineLeft">
                <?if($OrderShop->pay_paytype == 'atm'):?>
                ATM轉帳
                <?elseif($OrderShop->pay_paytype == 'card'):?>
                信用卡
                <?elseif($OrderShop->pay_paytype == 'cash_on_delivery'):?>
                貨到付款
                <?endif?>
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                付款總金額
            </div>
            <div class="spanLineLeft width600">
                NT$<?=$OrderShop->pay_price_total?>（含運費 NT$<?=$OrderShop->pay_price_freight?> <?if($OrderShop->tradein_count > 0):?>、 滿額優惠減免 NT$<?=$OrderShop->tradein_count?> <?endif?> <?if($OrderShop->coupon_count > 0):?>、 折扣金減免 NT$<?=$OrderShop->coupon_count?> <?endif?>）
		    </div>
		</div>
	</div>
    <?if($OrderShop->pay_paytype == 'atm'):?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                收款資訊
            </div>
            <div class="spanLineLeft width400">
                收款銀行： <?=$transfer_SettingList->obj_arr['bank_code']->value?>
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineLeft width400">
                收款帳號： <?=$transfer_SettingList->obj_arr['bank_account']->value?>
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineLeft width400">
                銀行戶名： <?=$transfer_SettingList->obj_arr['bank_account_name']->value?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                轉帳帳號
            </div>
            <div class="spanLineLeft">
                <?if($OrderShop->pay_status == 1):?>
                <?=$OrderShop->pay_account?>
                <?else:?>
                <input type="text" class="text" name="pay_account">
                <?endif?>
            </div>
        </div>
    </div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                轉帳人姓名
            </div>
            <div class="spanLineLeft">
                <?if($OrderShop->pay_status == 1):?>
                <?=$OrderShop->pay_name?>
                <?else:?>
                <input type="text" class="text" name="pay_name">
                <?endif?>
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                轉帳時間
            </div>
            <div class="spanLineLeft">
                <?if($OrderShop->pay_status == 1):?>
                <?=$OrderShop->pay_paytime_DateTimeObj->datetime?>
                <?else:?>
                <input type="text" class="text" id="pay_paytime" name="pay_paytime">
                <?endif?>
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                付款備註
            </div>
            <div class="spanLineLeft width500">
                <?if($OrderShop->pay_status == 1):?>
                    <?if(!empty($OrderShop->pay_remark)):?>
                    <?=$OrderShop->pay_remark?>
                    <?else:?>
                    未填寫付款備註
                    <?endif?>
                <?else:?>
                <textarea name="pay_remark"></textarea>
                <?endif?>
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
                <?if($OrderShop->pay_status == 0):?>
                <span class="red">尚未填寫付款資訊</span>
                <?elseif($OrderShop->pay_status == 1):?>
                <span class="green">已填寫付款資訊</span>
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
                <span class="<?if($OrderShop->paycheck_status == 0):?>red<?elseif($OrderShop->paycheck_status == 1):?>green<?endif?>">
                    <?if($OrderShop->paycheck_status == 0):?>款項待確認<?endif?>
                    <?if($OrderShop->paycheck_status == 1):?>款項已確認<?endif?>
                </span>
		    </div>
		</div>
	</div>
    <div style="border-top: 2px #AAA dashed;margin:30px 0;"></div>
    <h3>貨運資訊</h3>
    <h4>請確認貨運資訊</h4>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                運輸方式
            </div>
            <div class="spanLineLeft width500">
                <?=$OrderShop->transport_mode?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                運輸單號
            </div>
            <div class="spanLineLeft width500">
                <?if (empty($OrderShop->transport_id)):?>
                <p class="red">待管理員確認運輸單號</p>
                <?else:?>
                <?=$OrderShop->transport_id?>
                <?endif?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                運輸查貨網址
            </div>
            <div class="spanLineRight">
                <a href="<?=$Transport->url?>" target="_blank"><?=$Transport->url?></a>
            </div>
        </div>
    </div>
    <div style="border-top: 2px #AAA dashed;margin:30px 0;"></div>
	<h3>貨物處理狀態</h3>
	<h4>請確認貨物處理狀態</h4>
	<div class="spanLineTable">
        <div class="spanLineTableContent">
            <div class="spanLine order tablelist tableTitle">
                <div class="spanLineLeft">
                    購物貨物列表
                </div>
                <div class="spanLineLeft width400">
                    貨物名稱
    		    </div>
                <div class="spanLineLeft width100 aligncenter">
                    單價
                </div>
                <div class="spanLineLeft width100 aligncenter">
                    數量
                </div>
                <div class="spanLineLeft width100 aligncenter">
                    小計
                </div>
    		</div>
            <?foreach($OrderShop->cart_CartShopList->obj_arr as $key => $value_CartShop):?>
            <div class="spanLine order tablelist">
                <div class="spanLineLeft">
                </div>
                <div class="spanLineLeft width400">
                    <a href="product/<?=$value_CartShop->product_ProductShop->productid?>" target="_blank">
                        <?=$value_CartShop->product_ProductShop->name?> ( <?=$value_CartShop->StockProductShop->classname1?> / <?=$value_CartShop->StockProductShop->classname2?> )
                    </a>
                </div>
                <div class="spanLineLeft width100 aligncenter">
                    <?=$value_CartShop->price?>
                </div>
                <div class="spanLineLeft width100 aligncenter">
                    <?=$value_CartShop->amount?>
                </div>
                <div class="spanLineLeft width100 aligncenter">
                    <?=$value_CartShop->price_total?>
                </div>
            </div>
            <?endforeach?>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                貨物處理狀態
            </div>
            <div class="spanLineLeft width500">
                <span class="<?if($OrderShop->product_status == 0):?>red<?elseif($OrderShop->product_status == 1):?>green<?endif?>">
                    <?if($OrderShop->product_status == 0):?>貨物待確認<?endif?>
                    <?if($OrderShop->product_status == 1):?>貨物已確認<?endif?>
                </span>
            </div>
        </div>
    </div>
    <div style="border-top: 2px #AAA dashed;margin:30px 0;"></div>
	<h3>收件人資訊</h3>
	<h4>請確認訂單收件人資訊</h4>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                收件人姓名
            </div>
            <div class="spanLineLeft">
                <?=$OrderShop->receive_name?>
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                收件人電話
            </div>
            <div class="spanLineLeft">
                <?=$OrderShop->receive_phone?>
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                收件最佳時間
            </div>
            <div class="spanLineLeft width500">
                <?if($OrderShop->receive_time == 'morning'):?>
                早上 8:00 ~ 12:00
                <?elseif($OrderShop->receive_time == 'afternoon'):?>
                下午 12:00 ~ 17:00
                <?elseif($OrderShop->receive_time == 'night'):?>
                晚上 17:00 以後
                <?endif?>
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                收件人地址
            </div>
            <div class="spanLineLeft width500">
                <?=$OrderShop->receive_address?>
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                收件人備註
            </div>
            <div class="spanLineLeft width500">
                <?if(!empty($OrderShop->receive_remark)):?>
                <?=$OrderShop->receive_remark?>
                <?else:?>
                未填寫備註
                <?endif?>
		    </div>
		</div>
	</div>
    <div style="border-top: 2px #AAA dashed;margin:30px 0;"></div>
    <h3>訂單留言</h3>
    <h4>請確認訂單留言資訊</h4>
    <div class="spanLine">
        <?if( !empty($OrderShop->comment_CommentList->obj_arr) ):?>
        <div class="spanStage">
            <div class="spanLineLeft">
                訂單留言
            </div>
            <div class="spanLineLeft width500">
                <?foreach($OrderShop->comment_CommentList->obj_arr as $key => $value_Comment):?>
                <p><?=$value_Comment->uid_User->username?> <span class="gray"><?=$value_Comment->updatetime_DateTime->datetime?></span></p>
                <div style="word-wrap:break-word;"><?=$value_Comment->content_Html?></div>
                <div style="border-top: 1px #CCC dashed;margin:10px 0;"></div>
                <?endforeach?>
            </div>
        </div>
        <?endif?>
        <div class="spanStage">
            <div class="spanLineLeft">
                <?if( empty($OrderShop->comment_CommentList->obj_arr) ):?>
                訂單留言
                <?endif?>
            </div>
            <div class="spanLineLeft width500">
                <textarea cols="80" name="content" rows="10" placeholder="請填寫新的留言..."></textarea>
            </div>
        </div>
    </div>
    <div style="border-top: 2px #AAA dashed;margin:30px 0;"></div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                下單時間
            </div>
            <div class="spanLineLeft width500">
                <?=$OrderShop->setuptime_DateTimeObj->datetime?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                最後更新時間
            </div>
            <div class="spanLineLeft width500">
                <?=$OrderShop->updatetime_DateTimeObj->datetime?>
            </div>
        </div>
    </div>
    <?if($OrderShop->sendtime_DateTimeObj->datetime !== $OrderShop->setuptime_DateTimeObj->datetime):?>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                貨物寄出時間
            </div>
            <div class="spanLineLeft width500">
                <?=$OrderShop->sendtime_DateTimeObj->datetime?>
		    </div>
		</div>
	</div>
    <?endif?>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                訂單處理狀態
            </div>
            <div class="spanLineLeft width500">
                <span class="<?if($OrderShop->order_status == 0):?>red<?elseif($OrderShop->order_status == 1):?>green<?endif?>">
                    <?if($OrderShop->order_status == 0):?>
                    訂單未完成
                    <?elseif($OrderShop->order_status == 1):?>
                    訂單已完成，已確認貨物及付款狀態
                    <?endif?>
                </select>
		    </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <p class="gray">訂單確認狀態選項經確認送出後，便無法再修改本訂單所有資料</p>
            </div>
		</div>
	</div>
	<div class="spanLine spanSubmit">
	    <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <?if(!empty($OrderShop->orderid)):?><input type="hidden" name="orderid" value="<?=$OrderShop->orderid?>"><?endif?>
                <input type="submit" class="submit" value="儲存變更">
            </div>
        </div>
	</div>
	</form>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>