<?php

class OrderShop extends ObjDbBase
{

    public $orderid_Num = 0;
    public $uid_Num = 0;
    public $receive_name_Str = '';
    public $receive_phone_Str = '';
    public $receive_time_Str = '';
    public $receive_address_Str = '';
    public $receive_remark_Str = '';
    public $pay_name_Str = '';
    public $pay_paytype_Str = '';
    public $pay_price_total_Num = 0;
    public $pay_account_Str = '';
    public $pay_remark_Str = '';
    public $pay_price_freight_Num = 0;
    public $coupon_count_Num = 0;
    public $tradein_count_Num = 0;
    public $pay_paytime_DateTimeObj;
    public $pay_status_Num = 0;
    public $paycheck_status_Num = 0;
    public $cart_CartShopList;
    public $comment_CommentList;
    public $setuptime_DateTimeObj;
    public $sendtime_DateTimeObj;
    public $updatetime_DateTimeObj;
    public $order_status_Num = 0;
    public $product_status_Num = 0;
    public $status_Num = 1;
    public $db_name_Str = 'shop_order';//填寫物件聯繫資料庫之名稱
    public $db_uniqueid_Str = 'orderid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_Arr = [//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'orderid' => 'orderid_Num',
        'uid' => 'uid_Num',
        'receive_name' => 'receive_name_Str',
        'receive_phone' => 'receive_phone_Str',
        'receive_time' => 'receive_time_Str',
        'receive_address' => 'receive_address_Str',
        'receive_remark' => 'receive_remark_Str',
        'pay_name' => 'pay_name_Str',
        'pay_paytype' => 'pay_paytype_Str',
        'pay_sendtype' => 'pay_sendtype_Str',
        'pay_price_total' => 'pay_price_total_Num',
        'pay_account' => 'pay_account_Str',
        'pay_remark' => 'pay_remark_Str',
        'pay_price_freight' => 'pay_price_freight_Num',
        'coupon_count' => 'coupon_count_Num',
        'tradein_count' => 'tradein_count_Num',
        'pay_paytime' => array('pay_paytime_DateTimeObj', 'datetime_Str'),
        'sendtime' => array('sendtime_DateTimeObj', 'datetime_Str'),
        'setuptime' => array('setuptime_DateTimeObj', 'datetime_Str'),
        'pay_price_total' => 'pay_price_total_Num',
        'pay_status' => 'pay_status_Num',
        'paycheck_status' => 'paycheck_status_Num',
        'product_status' => 'product_status_Num',
        'order_status' => 'order_status_Num',
        'updatetime' => array('updatetime_DateTimeObj', 'datetime_Str'),
        'status' => 'status_Num'
    ];
	
	public function construct($arg)
	{
        $this->set('orderid_Num', $arg['orderid_Num']);
        $this->set('receive_name_Str', $arg['receive_name_Str']);
        $this->set('receive_phone_Str', $arg['receive_phone_Str']);
        $this->set('receive_time_Str', $arg['receive_time_Str']);
        $this->set('receive_address_Str', $arg['receive_address_Str']);
        $this->set('receive_remark_Str', $arg['receive_remark_Str']);
        $this->set('pay_name_Str', $arg['pay_name_Str']);
        $this->set('pay_paytype_Str', $arg['pay_paytype_Str']);
        $this->set('pay_sendtype_Str', $arg['pay_sendtype_Str']);
        $this->set('pay_price_total_Num', $arg['pay_price_total_Num']);
        $this->set('pay_account_Str', $arg['pay_account_Str']);
        $this->set('pay_remark_Str', $arg['pay_remark_Str']);
        $this->set('pay_price_freight_Num', $arg['pay_price_freight_Num']);
        $this->set('coupon_count_Num', $arg['coupon_count_Num']);
        $this->set('tradein_count_Num', $arg['tradein_count_Num']);
        $this->set('pay_status_Num', $arg['pay_status_Num']);
        $this->set('paycheck_status_Num', $arg['paycheck_status_Num']);
        $this->set('product_status_Num', $arg['product_status_Num']);
        $this->set('order_status_Num', $arg['order_status_Num']);
        $this->set('status_Num', $arg['status_Num']);
        $this->set('updatetime_DateTimeObj', [
            'datetime_Str' => $arg['updatetime_Str']
        ], 'DateTimeObj');
        $this->set('pay_paytime_DateTimeObj', [
            'datetime_Str' => $arg['pay_paytime_Str']
        ], 'DateTimeObj');
        $this->set('setuptime_DateTimeObj', [
            'datetime_Str' => $arg['setuptime_Str']
        ], 'DateTimeObj');
        $this->set('sendtime_DateTimeObj', [
            'datetime_Str' => $arg['sendtime_Str']
        ], 'DateTimeObj');
        $this->set__uid_Num(['uid_Num' => $arg['uid_Num']]);
        $this->set__uid_User(['uid_Num' => $arg['uid_Num']]);
        $this->set__cart_CartShopList(['orderid_Num' => $arg['orderid_Num']]);
        $this->set__comment_CommentList(['orderid_Num' => $arg['orderid_Num']]);
        
        return TRUE;
    }

    public function set__cart_CartShopList($arg)
    {
        reset_null_arr($arg, ['orderid_Num']);
        foreach($arg as $key => $value) ${$key} = $arg[$key];

        $cart_CartShopList = new ObjList();
        $cart_CartShopList->construct_db(array(
            'db_where_Arr' => array(
                'orderid' => $orderid_Num
            ),
            'model_name_Str' => 'CartShop',
            'limitstart_Num' => 0,
            'limitcount_Num' => 9999
        ));
        $this->set('cart_CartShopList', $cart_CartShopList);
    }

    public function set__comment_CommentList($arg)
    {
        reset_null_arr($arg, ['orderid_Num']);
        foreach($arg as $key => $value) ${$key} = $arg[$key];

        $comment_CommentList = new ObjList();
        $comment_CommentList->construct_db(array(
            'db_where_Arr' => [
                'typename' => 'order',
                'id' => $orderid_Num
            ],
            'model_name_Str' => 'Comment',
            'limitstart_Num' => 0,
            'limitcount_Num' => 9999
        ));
        $this->set('comment_CommentList', $comment_CommentList);
    }

    public function change_freight($arg)
    {
        $pay_price_freight_Num = !empty($arg['pay_price_freight_Num']) ? $arg['pay_price_freight_Num'] : 0;

        $this->pay_price_freight_Num = $pay_price_freight_Num;

        $this->count_price_total();
    }

    public function change_tradein_count($arg)
    {
        $this->set('tradein_count_Num', 0);
        $this->count_price_total();
    }

    public function change_coupon_count($arg)
    {
        $coupon_count_Num = !empty($arg['coupon_count_Num']) ? $arg['coupon_count_Num'] : 0;

        $this->set('coupon_count_Num', 0);
        $this->count_price_total();

        $shop_rule_use_coupon_count_Setting = new Setting();
        $shop_rule_use_coupon_count_Setting->construct_db([
            'db_where_Arr' => [
                'keyword' => 'shop_rule_use_coupon_count'
            ]
        ]);

        $shop_rule_use_get_coupon_count_Setting = new Setting();
        $shop_rule_use_get_coupon_count_Setting->construct_db([
            'db_where_Arr' => [
                'keyword' => 'shop_rule_use_get_coupon_count'
            ]
        ]);

        $UserFieldShop = new UserFieldShop();
        $UserFieldShop->construct_db([
            'db_where_Arr' => [
                'user.uid' => $this->uid_Num
            ]
        ]);

        if(
            $this->pay_price_total_Num >= $shop_rule_use_coupon_count_Setting->value_Str &&
            $coupon_count_Num <= $shop_rule_use_get_coupon_count_Setting->value_Str &&
            $coupon_count_Num <= $UserFieldShop->coupon_count_Num
        )
        {
            $this->coupon_count_Num = $coupon_count_Num;
            $this->count_price_total();
            return TRUE;
        }
        else
        {
            return '折扣金優惠數字錯誤';
        }
    }

    public function add_cart($arg)
    {
        $productid_Num = !empty($arg['productid_Num']) ? $arg['productid_Num'] : 0;
        $stockid_Num = !empty($arg['stockid_Num']) ? $arg['stockid_Num'] : 0;
        $amount_Num = !empty($arg['amount_Num']) ? $arg['amount_Num'] : 0;

        $uid_Num = $this->uid_Num;
        $orderid_Num = $this->orderid_Num;
        $pay_price_freight_Num = $this->pay_price_freight_Num;

        //將產品數量增加至原有的購物車
        $CartShop = new CartShop();
        $CartShop->construct_db(array(
            'db_where_Arr' => array(
                'orderid_Num' => $orderid_Num,
                'productid_Num' => $productid_Num,
                'stockid_Num' => $stockid_Num,
                'status_Num' => 1
            )
        ));
        $CartShop->amount_Num = $CartShop->amount_Num + $amount_Num;

        //如果這個購物車是空的，就建立新的購物車
        if(empty($CartShop->cartid_Num))
        {
            $CartShop = new CartShop();
            $CartShop->construct(array(
                'productid_Num' => $productid_Num,
                'stockid_Num' => $stockid_Num,
                'orderid_Num' => $orderid_Num,
                'uid_Num' => $uid_Num,
                'amount_Num' => $amount_Num
            ));
        }
        $CartShop->update();

        $this->count_price_total();
    }

    public function delete_cart($arg)
    {
        $cartid_Num = !empty($arg['cartid_Num']) ? $arg['cartid_Num'] : 0;

        $uid_Num = $this->uid_Num;
        $orderid_Num = $this->orderid_Num;
        $pay_price_freight_Num = $this->pay_price_freight_Num;

        //將產品數量增加至原有的購物車
        $CartShop = new CartShop();
        $CartShop->construct_db(array(
            'db_where_Arr' => array(
                'cartid_Num' => $cartid_Num
            )
        ));
        $CartShop->delete();

        $this->count_price_total();
    }

    public function count_price_total()
    {
        $orderid_Num = $this->orderid_Num;
        $pay_price_freight_Num = $this->pay_price_freight_Num;
        $coupon_count_Num = $this->coupon_count_Num;
        $tradein_count_Num = $this->tradein_count_Num;

        $shop_tradein_SettingList = new SettingList();
        $shop_tradein_SettingList->construct_db([
            'db_where_Arr' => [
                'modelname' => 'shop_tradein'
            ]
        ]);

        $cart_CartShopList = new ObjList();
        $cart_CartShopList->construct_db(array(
            'db_where_Arr' => array(
                'orderid_Num' => $orderid_Num
            ),
            'model_name_Str' => 'CartShop',
            'limitstart_Num' => 0,
            'limitcount_Num' => 9999
        ));

        $pay_price_total_Num = 0;
        $cart_count_Num = 0;
        foreach($cart_CartShopList->obj_Arr as $key => $value_CartShop)
        {
            $pay_price_total_Num = $pay_price_total_Num + $value_CartShop->price_total_Num;
            $cart_count_Num = $cart_count_Num + $value_CartShop->amount_Num;
        }

        //計算滿額滿金額優惠折扣
        $tradein_count_Num = 0;
        if($pay_price_total_Num >= $shop_tradein_SettingList->obj_Arr['shop_rule_use_tradein_money']->value_Str)
        {
            if($shop_tradein_SettingList->obj_Arr['shop_rule_get_tradein_money_type']->value_Str == 'money')
            {
                $tradein_count_Num = $tradein_count_Num + $shop_tradein_SettingList->obj_Arr['shop_rule_get_tradein_money']->value_Str;
                $pay_price_total_Num = $pay_price_total_Num - $shop_tradein_SettingList->obj_Arr['shop_rule_get_tradein_money']->value_Str;
            }
            else if($shop_tradein_SettingList->obj_Arr['shop_rule_get_tradein_money_type']->value_Str == 'tradein')
            {
                if( $shop_tradein_SettingList->obj_Arr['shop_rule_get_tradein_money']->value_Str <= 100 && $shop_tradein_SettingList->obj_Arr['shop_rule_get_tradein_money']->value_Str != 0 )
                {
                    $tradein_count_Num = $tradein_count_Num + ( $pay_price_total_Num * ( 100 - $shop_tradein_SettingList->obj_Arr['shop_rule_get_tradein_money']->value_Str) / 100 );
                    $pay_price_total_Num = $pay_price_total_Num * $shop_tradein_SettingList->obj_Arr['shop_rule_get_tradein_money']->value_Str / 100;
                }
            }
        }

        //計算滿額件數優惠
        if( $cart_count_Num >= $shop_tradein_SettingList->obj_Arr['shop_rule_use_tradein_count']->value_Str)
        {
            if($shop_tradein_SettingList->obj_Arr['shop_rule_get_tradein_count_type']->value_Str == 'money')
            {
                $tradein_count_Num = $tradein_count_Num + $shop_tradein_SettingList->obj_Arr['shop_rule_get_tradein_count']->value_Str;
                $pay_price_total_Num = $pay_price_total_Num - $shop_tradein_SettingList->obj_Arr['shop_rule_get_tradein_count']->value_Str;
            }
            else if($shop_tradein_SettingList->obj_Arr['shop_rule_get_tradein_count_type']->value_Str == 'tradein')
            {
                if( $shop_tradein_SettingList->obj_Arr['shop_rule_get_tradein_count']->value_Str <= 100 && $shop_tradein_SettingList->obj_Arr['shop_rule_get_tradein_count']->value_Str != 0 )
                {
                    $tradein_count_Num = $tradein_count_Num + ( $pay_price_total_Num * ( 100 - $shop_tradein_SettingList->obj_Arr['shop_rule_get_tradein_count']->value_Str) / 100 );
                    $pay_price_total_Num = $pay_price_total_Num * $shop_tradein_SettingList->obj_Arr['shop_rule_get_tradein_count']->value_Str / 100;
                }
            }
        }

        // ec( $pay_price_total_Num );

        //計算運費
        $pay_price_total_Num = $pay_price_total_Num + $pay_price_freight_Num;

        //計算折扣金
        $pay_price_total_Num = $pay_price_total_Num - $coupon_count_Num;

        $this->tradein_count_Num = $tradein_count_Num;
        $this->pay_price_total_Num = $pay_price_total_Num;

        return $pay_price_total_Num;
    }

    public function finish_order()
    {
        //檢查購物車的購買數量是否都低於庫存數量
        foreach($this->cart_CartShopList->obj_Arr as $key => $value_CartShop)
        {
            if($value_CartShop->StockProductShop->stocknum_Num < $value_CartShop->amount_Num)
            {
                //如果庫存數量低於購買數量，就刪除這個購物選項
                $value_CartShop->delete();
                return '選購的部份產品已售出，已刪除庫存不足的產品項目';
            }
        }

        //將庫存扣除購物選項的購物數量
        foreach($this->cart_CartShopList->obj_Arr as $key => $value_CartShop)
        {
            $value_CartShop->StockProductShop->set('stocknum_Num', $value_CartShop->StockProductShop->stocknum_Num - $value_CartShop->amount_Num);
            $value_CartShop->StockProductShop->update();
        }

        //扣除會員折扣金
        $UserFieldShop = new UserFieldShop();
        $UserFieldShop->construct_db([
            'db_where_Arr' => [
                'user.uid' => $this->uid_Num
            ]
        ]);
        if($UserFieldShop->coupon_count_Num >= $this->coupon_count_Num)
        {
            $UserFieldShop->set('coupon_count_Num', $UserFieldShop->coupon_count_Num - $this->coupon_count_Num);
            $UserFieldShop->update([
                'db_update_Arr' => ['user_field_shop.coupon_count']
            ]);
        }
        else if( $this->coupon_count_Num != 0 )
        {
            return '折扣金不足';
        }

        $shop_rule_coupon_count_Setting = new Setting();
        $shop_rule_coupon_count_Setting->construct_db([
            'db_where_Arr' => [
                'keyword' => 'shop_rule_coupon_count'
            ]
        ]);

        if($this->pay_price_total_Num >= $shop_rule_coupon_count_Setting->value_Str )
        {
            $shop_rule_get_coupon_count_Setting = new Setting();
            $shop_rule_get_coupon_count_Setting->construct_db([
                'db_where_Arr' => [
                    'keyword' => 'shop_rule_get_coupon_count'
                ]
            ]);

            $UserFieldShop->set('coupon_count_Num', $UserFieldShop->get('coupon_count_Num') + $shop_rule_get_coupon_count_Setting->value_Str );
            $UserFieldShop->update([
                'db_update_Arr' => ['user_field_shop.coupon_count']
            ]);
        }


        //設定訂單成功
        $this->order_status_Num = 0;
        $this->update();

        return TRUE;
    }
	
}