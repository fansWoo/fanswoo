<?php

class UserGroup extends ObjDbBase
{
    public $db_name_arr = ['user_group'];//填寫物件聯繫資料庫之名稱
    public $db_uniqueid = 'groupid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_arr = [//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'groupid' => 'groupid',
        'groupname' => 'groupname',
        'status' => 'status'
    ];
    
    public function construct($arg = [])
    {
        //將引數設為物件屬性，或將引數作為物件型屬性的建構值
        $this->set('groupid', $arg['groupid']);
        $this->set('groupname', $arg['groupname']);
        $this->set__status(['status' => $arg['status']]);
        
        return TRUE;
    }
    
}