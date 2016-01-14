<?php

class FacebookSearch extends ObjDbBase
{

    public $searchid_Num = 0;
    public $facebookid_fans_Str = '';
    public $count_Num = 0;
    public $content_Str = '';
    public $updatetime_DateTime;
    public $status_Num = 1;
    public $db_name_Str = 'facebook_search';//填寫物件聯繫資料庫之名稱
    public $db_uniqueid_Str = 'searchid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_Arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'searchid' => 'searchid_Num',
        'facebookid_fans' => 'facebookid_fans_Str',
        'count' => 'count_Num',
        'content' => 'content_Str',
        'updatetime' => array('updatetime_DateTime', 'datetime_Str'),
        'status' => 'status_Num'
    );
	
	public function construct($arg)
	{
        //引入引數並將空值的變數給予空值
        reset_null_arr($arg, ['searchid_Num', 'facebookid_fans_Str', 'content_Str', 'count_Num', 'updatetime_Str', 'updatetime_inputtime_date_Str', 'updatetime_inputtime_time_Str', 'status_Num']);
        foreach($arg as $key => $value) ${$key} = $arg[$key];
        
        //將引數設為物件屬性，或將引數作為物件型屬性的建構值
        $this->set('searchid_Num', $searchid_Num);
        $this->set('facebookid_fans_Str', $facebookid_fans_Str);
        $this->set('content_Str', $content_Str);
        $this->set('count_Num', $count_Num);
        $this->set('updatetime_DateTime', [
            'datetime_Str' => $updatetime_Str,
            'inputtime_date_Str' => $updatetime_inputtime_date_Str,
            'inputtime_time_Str' => $updatetime_inputtime_time_Str
        ], 'DateTimeObj');
        $this->set('status_Num', $status_Num);
        
        return TRUE;
    }
    
}