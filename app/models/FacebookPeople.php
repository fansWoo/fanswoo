<?php

class FacebookPeople extends ObjDbBase
{

    public $fbid_Num = 0;
    public $facebookid_Str = '';
    public $facebookid_fans_Str = '';
    public $count_Num = 0;
    public $searchid_Num = 0;
    public $status_Num = 1;
    public $db_name_Str = 'facebook_people';//填寫物件聯繫資料庫之名稱
    public $db_uniqueid_Str = 'fbid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_Arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'fbid' => 'fbid_Num',
        'facebookid' => 'facebookid_Str',
        'facebookid_fans' => 'facebookid_fans_Str',
        'count' => 'count_Num',
        'searchid' => 'searchid_Num',
        'status' => 'status_Num'
    );
	
	public function construct($arg)
	{
        //引入引數並將空值的變數給予空值
        reset_null_arr($arg, ['fbid_Num', 'facebookid_Str', 'facebookid_fans_Str', 'count_Num', 'searchid_Num', 'status_Num']);
        foreach($arg as $key => $value) ${$key} = $arg[$key];
        
        //將引數設為物件屬性，或將引數作為物件型屬性的建構值
        $this->set('fbid_Num', $fbid_Num);
        $this->set('facebookid_Str', $facebookid_Str);
        $this->set('facebookid_fans_Str', $facebookid_fans_Str);
        $this->set('count_Num', $count_Num);
        $this->set('searchid_Num', $searchid_Num);
        $this->set('status_Num', $status_Num);
        
        return TRUE;
    }
    
}