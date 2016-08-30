<?php

class ContactFanswoo extends Contact
{
    public $db_name_arr = ['contact'];//填寫物件聯繫資料庫之名稱
    public $db_uniqueid = 'contactid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_arr = [//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'contactid' => 'contactid',
        'username' => 'username',
        'email' => 'email',
        'phone' => 'phone',
        'content' => 'content',
        'company' => 'company',
        'classtype' => 'classtype',
        'classtype2' => 'classtype2',
        'money' => 'money',
        'status_process' => 'status_process',
        'updatetime' => ['updatetime_DateTime', 'datetime'],
        'locale' => 'locale',
        'status' => 'status'
    ];
	
	public function construct($arg = [])
	{
        parent::construct($arg);
        
        $this->set('company', $arg['company']);
        $this->set('classtype2', $arg['classtype2']);
        $this->set('money', $arg['money']);
        
        return TRUE;
    }
}