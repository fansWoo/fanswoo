<?php

class ProductShop extends ObjDbBase
{

    public $productid_Num = 0;
    public $uid_Num = 0;
    public $name_Str = '';
    public $pic_PicObjList;//照片類別列表
    public $content_Html = '';//網頁語言類別
    public $content_specification_Html = '';//網頁語言類別
    public $synopsis_Str = '';
    public $price_Num = 0;
    public $cost_Num = 0;
    public $warehouseid_Str = '';
    public $class_ClassMetaList;//分類標籤類別列表
    public $stock_StockProductShopList;
    public $stock_classname1_Arr = [];
    public $stock_classname2_Arr = [];
    public $prioritynum_Num = 0;
    public $updatetime_DateTime;
    public $shelves_status_Num = 2;
    public $status_Num = 1;
    public $db_name_Str = 'shop_product';//填寫物件聯繫資料庫之名稱
    public $db_uniqueid_Str = 'productid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_Arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'productid' => 'productid_Num',
        'uid' => 'uid_Num',
        'name' => 'name_Str',
        'price' => 'price_Num',
        'cost' => 'cost_Num',
        'warehouseid' => 'warehouseid_Str',
        'synopsis' => 'synopsis_Str',
        'picids' => array('pic_PicObjList', 'uniqueids_Str'),
        'classids' => array('class_ClassMetaList', 'uniqueids_Str'),
        'content' => 'content_Html',
        'content_specification' => 'content_specification_Html',
        'prioritynum' => 'prioritynum_Num',
        'updatetime' => array('updatetime_DateTime', 'datetime_Str'),
        'shelves_status' => 'shelves_status_Num',
        'status' => 'status_Num'
    );
	
	public function construct($arg)
	{
        
        //取得引數
        $productid_Num = !empty($arg['productid_Num']) ? $arg['productid_Num'] : 0;
        $uid_Num = !empty($arg['uid_Num']) ? $arg['uid_Num'] : 0;
        $name_Str = !empty($arg['name_Str']) ? $arg['name_Str'] : '';
        $picids_Str = !empty($arg['picids_Str']) ? $arg['picids_Str'] : '';
        $picids_Arr = !empty($arg['picids_Arr']) ? $arg['picids_Arr'] : array();
        $content_Str = !empty($arg['content_Str']) ? $arg['content_Str'] : '' ;
        $content_specification_Str = !empty($arg['content_specification_Str']) ? $arg['content_specification_Str'] : '' ;
        $synopsis_Str = !empty($arg['synopsis_Str']) ? $arg['synopsis_Str'] : '' ;
        $price_Num = !empty($arg['price_Num']) ? $arg['price_Num'] : 0 ;
        $cost_Num = !empty($arg['cost_Num']) ? $arg['cost_Num'] : 0 ;
        $warehouseid_Str = !empty($arg['warehouseid_Str']) ? $arg['warehouseid_Str'] : '';
        $classids_Str = !empty($arg['classids_Str']) ? $arg['classids_Str'] : '';
        $classids_Arr = !empty($arg['classids_Arr']) ? $arg['classids_Arr'] : array();
        $prioritynum_Num = !empty($arg['prioritynum_Num']) ? $arg['prioritynum_Num'] : 0;
        $updatetime_Str = !empty($arg['updatetime_Str']) ? $arg['updatetime_Str'] : '';
        $updatetime_inputtime_date_Str = !empty($arg['updatetime_inputtime_date_Str']) ? $arg['updatetime_inputtime_date_Str'] : '';
        $updatetime_inputtime_time_Str = !empty($arg['updatetime_inputtime_time_Str']) ? $arg['updatetime_inputtime_time_Str'] : '';
        $shelves_status_Num = !empty($arg['shelves_status_Num']) ? $arg['shelves_status_Num'] : 2;
        $status_Num = !empty($arg['status_Num']) ? $arg['status_Num'] : 1;
        
        //若uid為空則以登入者uid作為本物件之預設uid
        if(empty($uid_Num) || empty($uid_Num))
        {
            $data['user'] = get_user();
            $uid_Num = $data['user']['uid'];
        }
        
        //建立ClassMetaList物件
        check_comma_array($classids_Str, $classids_Arr);
        $class_ClassMetaList = $this->load->model('ObjList', nrnum());
        $class_ClassMetaList->construct_db(array(
            'db_where_or_Arr' => array(
                'classid_Num' => $classids_Arr
            ),
            'model_name_Str' => 'ClassMeta',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));

        //建立DateTime物件
        $updatetime_DateTime = new DateTimeObj();
        $updatetime_DateTime->construct(array(
            'datetime_Str' => $updatetime_Str,
            'inputtime_date_Str' => $updatetime_inputtime_date_Str,
            'inputtime_time_Str' => $updatetime_inputtime_time_Str
        ));
        
        //HTML值運算
        $content_Html = $content_Str;
        $content_specification_Html = $content_specification_Str;

        $stock_StockProductShopList = new ObjList();
        $stock_StockProductShopList->construct_db([
            'db_where_Arr' => [
                'productid' => $productid_Num
            ],
            'model_name_Str' => 'StockProductShop',
            'limitstart_Num' => 0,
            'db_orderby_Arr' => [
                'prioritynum' => 'DESC',
                'stockid' => 'DESC'
            ],
            'limitcount_Num' => 100
        ]);

        $stock_classname1_Arr = [];
        $stock_classname2_Arr = [];
        foreach($stock_StockProductShopList->obj_Arr as $key => $value_StockProductShop)
        {
            //依照規格的排序
            if( !in_array($value_StockProductShop->classname1_Str, $stock_classname1_Arr) )
            {
                $stock_classname1_Arr[$value_StockProductShop->color_rgb_Str] = $value_StockProductShop->classname1_Str;
            }
            if( !in_array($value_StockProductShop->classname2_Str, $stock_classname2_Arr) )
            {
                $stock_classname2_Arr[] = $value_StockProductShop->classname2_Str;
            }
        }
        
        //將建構方法所計算出的值存入此類別之屬性
        $this->productid_Num = $productid_Num;
        $this->name_Str = $name_Str;
        $this->uid_Num = $uid_Num;
        $this->content_Html = $content_Html;
        $this->stock_StockProductShopList = $stock_StockProductShopList;
        $this->stock_classname1_Arr = $stock_classname1_Arr;
        $this->stock_classname2_Arr = $stock_classname2_Arr;
        $this->content_specification_Html = $content_specification_Html;
        $this->synopsis_Str = $synopsis_Str;
        $this->price_Num = $price_Num;
        $this->cost_Num = $cost_Num;
        $this->warehouseid_Str = $warehouseid_Str;
        $this->class_ClassMetaList = $class_ClassMetaList;
        $this->prioritynum_Num = $prioritynum_Num;
        $this->updatetime_DateTime = $updatetime_DateTime;
        $this->shelves_status_Num = $shelves_status_Num;
        $this->status_Num = $status_Num;
        
        //建立PicObjList物件
        $this->set('pic_PicObjList', [
            'picids_Str' => $picids_Str,
            'picids_Arr' => $picids_Arr
        ], 'PicObjList');
        
        return TRUE;
    }
	
}