<?php

//購物網站的寄送單位，以及網站連結查詢位置
class SentUnitShop extends ObjDbBase {

    public $sent_unitid_Num = 0;
    public $uid_Num = 0;
    public $name_Str = '';
    public $href_Str = '';
    public $status_Num = 1;
    public $db_name_Str = 'shop_sent_unit';
    public $db_uniqueid_Str = 'sent_unitid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_Arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'sent_unitid' => 'sent_unitid_Num',
        'uid' => 'uid_Num',
        'name' => 'name_Str',
        'href' => 'href_Str',
        'status' => 'status_Num'
    );
	
	public function construct($arg)
	{
        //引入引數並將空值的變數給予空值
        reset_null_arr($arg, ['sent_unitid_Num', 'uid_Num', 'name_Str', 'href_Str', 'status_Num']);
        foreach($arg as $key => $value) ${$key} = $arg[$key];
        
        //將引數設為物件屬性，或將引數作為物件型屬性的建構值
        $this->set('sent_unitid_Num', $sent_unitid_Num);
        $this->set('name_Str', $name_Str);
        $this->set('href_Str', $href_Str);
        $this->set__status_Num(['status_Num' => $status_Num]);
        $this->set__uid_Num(['uid_Num' => $uid_Num]);
        
        return TRUE;
    }
	
}