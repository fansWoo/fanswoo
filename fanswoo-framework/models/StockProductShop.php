<?php

class StockProductShop extends ObjDbBase
{

    public $stockid_Num = 0;
    public $productid_Num = 0;
    public $stocknum_Num = 0;
    public $classname1_Str = '';
    public $classname2_Str = '';
    public $color_rgb_Str = '';
    public $prioritynum_Num = 0;
    public $status_Num = 1;
    public $db_name_Str = 'shop_product_stock';//填寫物件聯繫資料庫之名稱
    public $db_uniqueid_Str = 'stockid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_Arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'stockid' => 'stockid_Num',
        'productid' => 'productid_Num',
        'stocknum' => 'stocknum_Num',
        'color_rgb' => 'color_rgb_Str',
        'classname1' => 'classname1_Str',
        'classname2' => 'classname2_Str',
        'prioritynum' => 'prioritynum_Num',
        'status' => 'status_Num'
    );

    public function construct($arg)
    {
        $this->set('stockid_Num', $arg['stockid_Num']);
        $this->set('productid_Num', $arg['productid_Num']);
        $this->set('stocknum_Num', $arg['stocknum_Num']);
        $this->set('color_rgb_Str', $arg['color_rgb_Str']);
        $this->set('classname1_Str', $arg['classname1_Str']);
        $this->set('classname2_Str', $arg['classname2_Str']);
        $this->set('prioritynum_Num', $arg['prioritynum_Num']);
        $this->set__status_Num(['status_Num' => $arg['status_Num']]);

        return TRUE;
    }
	
}