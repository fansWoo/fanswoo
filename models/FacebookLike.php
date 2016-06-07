<?php

class FacebookLike extends ObjDbBase
{

    public $fblikeid = 0;
    public $facebook_like_id = 0;
    public $facebook_id = '';
    public $count = 0;
    public $uniqueid = 0;
    public $facebook_fans_id;
    public $updatetime_DateTime;
    public $status = 1;
    public $db_name = 'facebook_like_id';//填寫物件聯繫資料庫之名稱
    public $db_uniqueid = 'fblikeid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'fblikeid' => 'fblikeid',
        'facebook_like_id' => 'facebook_like_id',
        'facebook_id' => 'facebook_id',
        'count' => 'count',
        'uniqueid' => 'uniqueid',
        'facebook_fans_id' => 'facebook_fans_id',
        'updatetime' => array('updatetime_DateTime', 'datetime'),
        'status' => 'status'
    );
	
	public function construct($arg)
	{
        //引入引數並將空值的變數給予空值
        reset_null_arr($arg, ['fblikeid', 'facebook_like_id', 'facebook_id', 'count', 'uniqueid', 'facebook_fans_id', 'updatetime', 'updatetime_inputtime_date', 'updatetime_inputtime_time', 'status']);
        foreach($arg as $key => $value) ${$key} = $arg[$key];
        
        //將引數設為物件屬性，或將引數作為物件型屬性的建構值
        $this->set('fblikeid', $fblikeid);
        $this->set('facebook_like_id', $facebook_like_id);
        $this->set('facebook_id', $facebook_id);
        $this->set('count', $count);
        $this->set('uniqueid', $uniqueid);
        $this->set('facebook_fans_id', $facebook_fans_id);
        $this->set('updatetime_DateTime', [
            'datetime' => $updatetime,
            'inputtime_date' => $updatetime_inputtime_date,
            'inputtime_time' => $updatetime_inputtime_time
        ], 'DateTimeObj');
        $this->set('status', $status);
        
        return TRUE;
    }
    
}