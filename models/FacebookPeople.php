<?php

class FacebookPeople extends ObjDbBase
{

    public $fbid = 0;
    public $facebookid = '';
    public $facebookid_fans = '';
    public $count = 0;
    public $searchid = 0;
    public $status = 1;
    public $db_name_arr = ['facebook_people'];//填寫物件聯繫資料庫之名稱
    public $db_uniqueid = 'fbid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'fbid' => 'fbid',
        'facebookid' => 'facebookid',
        'facebookid_fans' => 'facebookid_fans',
        'count' => 'count',
        'searchid' => 'searchid',
        'status' => 'status'
    );
	
	public function construct($arg)
	{
        //引入引數並將空值的變數給予空值
        reset_null_arr($arg, ['fbid', 'facebookid', 'facebookid_fans', 'count', 'searchid', 'status']);
        foreach($arg as $key => $value) ${$key} = $arg[$key];
        
        //將引數設為物件屬性，或將引數作為物件型屬性的建構值
        $this->set('fbid', $fbid);
        $this->set('facebookid', $facebookid);
        $this->set('facebookid_fans', $facebookid_fans);
        $this->set('count', $count);
        $this->set('searchid', $searchid);
        $this->set('status', $status);
        
        return TRUE;
    }
    
}