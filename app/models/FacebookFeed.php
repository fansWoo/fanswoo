<?php

class FacebookFeed extends ObjDbBase
{

    public $feedid_Num = 0;
    public $facebook_feedid_Num = 0;
    public $facebookid_Str = '';
    public $facebookids_Str = '';
    public $searchid_Num = 0;
    public $status_Num = 1;
    public $db_name_Str = 'facebook_feedid';//填寫物件聯繫資料庫之名稱
    public $db_uniqueid_Str = 'feedid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_Arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'feedid' => 'feedid_Num',
        'facebook_feedid' => 'facebook_feedid_Num',
        'facebookid' => 'facebookid_Str',
        'facebookids' => 'facebookids_Str',
        'searchid' => 'searchid_Num',
        'status' => 'status_Num'
    );
	
	public function construct($arg)
	{
        //引入引數並將空值的變數給予空值
        reset_null_arr($arg, ['feedid_Num', 'facebook_feedid_Num', 'facebookid_Str', 'facebookids_Str', 'searchid_Num', 'status_Num']);
        foreach($arg as $key => $value) ${$key} = $arg[$key];
        
        //將引數設為物件屬性，或將引數作為物件型屬性的建構值
        $this->set('feedid_Num', $feedid_Num);
        $this->set('facebook_feedid_Num', $facebook_feedid_Num);
        $this->set('facebookid_Str', $facebookid_Str);
        $this->set('facebookids_Str', $facebookids_Str);
        $this->set('searchid_Num', $searchid_Num);
        $this->set('status_Num', $status_Num);
        
        return TRUE;
    }
    
}