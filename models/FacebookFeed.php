<?php

class FacebookFeed extends ObjDbBase
{

    public $feedid = 0;
    public $facebook_feedid = 0;
    public $facebookid = '';
    public $facebookids = '';
    public $searchid = 0;
    public $status = 1;
    public $db_name = 'facebook_feedid';//填寫物件聯繫資料庫之名稱
    public $db_uniqueid = 'feedid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'feedid' => 'feedid',
        'facebook_feedid' => 'facebook_feedid',
        'facebookid' => 'facebookid',
        'facebookids' => 'facebookids',
        'searchid' => 'searchid',
        'status' => 'status'
    );
	
	public function construct($arg)
	{
        //引入引數並將空值的變數給予空值
        reset_null_arr($arg, ['feedid', 'facebook_feedid', 'facebookid', 'facebookids', 'searchid', 'status']);
        foreach($arg as $key => $value) ${$key} = $arg[$key];
        
        //將引數設為物件屬性，或將引數作為物件型屬性的建構值
        $this->set('feedid', $feedid);
        $this->set('facebook_feedid', $facebook_feedid);
        $this->set('facebookid', $facebookid);
        $this->set('facebookids', $facebookids);
        $this->set('searchid', $searchid);
        $this->set('status', $status);
        
        return TRUE;
    }
    
}