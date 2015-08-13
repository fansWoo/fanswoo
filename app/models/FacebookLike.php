<?php

class FacebookLike extends ObjDbBase
{

    public $fblikeid_Num = 0;
    public $facebook_like_id_Num = 0;
    public $facebook_id_Str = '';
    public $count_Num = 0;
    public $uniqueid_Num = 0;
    public $facebook_fans_id_Str;
    public $updatetime_DateTime;
    public $status_Num = 1;
    public $db_name_Str = 'facebook_like_id';//填寫物件聯繫資料庫之名稱
    public $db_uniqueid_Str = 'fblikeid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_Arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'fblikeid' => 'fblikeid_Num',
        'facebook_like_id' => 'facebook_like_id_Num',
        'facebook_id' => 'facebook_id_Str',
        'count' => 'count_Num',
        'uniqueid' => 'uniqueid_Num',
        'facebook_fans_id' => 'facebook_fans_id_Str',
        'updatetime' => array('updatetime_DateTime', 'datetime_Str'),
        'status' => 'status_Num'
    );
	
	public function construct($arg)
	{
        //引入引數並將空值的變數給予空值
        reset_null_arr($arg, ['fblikeid_Num', 'facebook_like_id_Num', 'facebook_id_Str', 'count_Num', 'uniqueid_Num', 'facebook_fans_id_Str', 'updatetime_Str', 'updatetime_inputtime_date_Str', 'updatetime_inputtime_time_Str', 'status_Num']);
        foreach($arg as $key => $value) ${$key} = $arg[$key];
        
        //將引數設為物件屬性，或將引數作為物件型屬性的建構值
        $this->set('fblikeid_Num', $fblikeid_Num);
        $this->set('facebook_like_id_Num', $facebook_like_id_Num);
        $this->set('facebook_id_Str', $facebook_id_Str);
        $this->set('count_Num', $count_Num);
        $this->set('uniqueid_Num', $uniqueid_Num);
        $this->set('facebook_fans_id_Str', $facebook_fans_id_Str);
        $this->set('updatetime_DateTime', [
            'datetime_Str' => $updatetime_Str,
            'inputtime_date_Str' => $updatetime_inputtime_date_Str,
            'inputtime_time_Str' => $updatetime_inputtime_time_Str
        ], 'DateTimeObj');
        $this->set('status_Num', $status_Num);
        
        return TRUE;
    }
    
}