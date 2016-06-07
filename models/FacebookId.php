<?php

class FacebookId extends ObjDbBase
{

    public $fbid = 0;
    public $facebook_like_id = 0;
    public $facebook_id = '';
    public $status = 1;
    public $db_name = 'facebook_id';//填寫物件聯繫資料庫之名稱
    public $db_uniqueid = 'fbid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'fbid' => 'fbid',
        'facebook_like_id' => 'facebook_like_id',
        'facebook_id' => 'facebook_id',
        'status' => 'status'
    );
    
    public function construct($arg)
    {
        //引入引數並將空值的變數給予空值
        reset_null_arr($arg, ['fbid', 'facebook_like_id', 'facebook_id', 'status']);
        foreach($arg as $key => $value) ${$key} = $arg[$key];
        
        //將引數設為物件屬性，或將引數作為物件型屬性的建構值
        $this->set('fbid', $fbid);
        $this->set('facebook_like_id', $facebook_like_id);
        $this->set('facebook_id', $facebook_id);
        $this->set('status', $status);
        
        return TRUE;
    }
    
}