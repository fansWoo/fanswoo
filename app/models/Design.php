<?php

class Design extends ObjDbBase
{

    public $designid_Num = 0;
    public $uid_Num = 0;
    public $title_Str = '';
    public $synopsis_Str = '';
    public $price_Num = 0;
    public $prioritynum_Num = 0;
    public $updatetime_DateTime;
    public $status_Num = 1;
    public $db_name_Str = 'shop_project_design';//填寫物件聯繫資料庫之名稱
    public $db_uniqueid_Str = 'designid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_Arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'designid' => 'designid_Num',
        'uid' => 'uid_Num',
        'title' => 'title_Str',
        'price' => 'price_Num',
        'synopsis' => 'synopsis_Str',
        'prioritynum' => 'prioritynum_Num',
        'updatetime' => array('updatetime_DateTime', 'datetime_Str'),
        'status' => 'status_Num'
    );
	
	public function construct($arg)
    {
        $data = $this->data;
        
        //將引數設為物件屬性，或將引數作為物件型屬性的建構值
        $this->set('designid_Num', $arg['designid_Num']);
        $this->set('title_Str', $arg['title_Str']);
        $this->set('synopsis_Str', $arg['synopsis_Str']);
        $this->set('price_Num', $arg['price_Num']);
        $this->set('prioritynum_Num', $arg['prioritynum_Num']);
        $this->set('updatetime_DateTime', [
            'datetime_Str' => $arg['updatetime_Str'],
            'inputtime_date_Str' => $arg['updatetime_inputtime_date_Str'],
            'inputtime_time_Str' => $arg['updatetime_inputtime_time_Str']
        ], 'DateTimeObj');
        $this->set__status_Num(['status_Num' => $arg['status_Num']]);
        $this->set__uid_Num(['uid_Num' => $arg['uid_Num']]);
        
        return TRUE;
    }
	
}