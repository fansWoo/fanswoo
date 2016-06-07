<?php

class FacebookSearch extends ObjDbBase
{

    public $searchid = 0;
    public $facebookid_fans = '';
    public $count = 0;
    public $content = '';
    public $updatetime_DateTime;
    public $status = 1;
    public $db_name = 'facebook_search';//填寫物件聯繫資料庫之名稱
    public $db_uniqueid = 'searchid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'searchid' => 'searchid',
        'facebookid_fans' => 'facebookid_fans',
        'count' => 'count',
        'content' => 'content',
        'updatetime' => array('updatetime_DateTime', 'datetime'),
        'status' => 'status'
    );
	
	public function construct($arg)
	{
        //引入引數並將空值的變數給予空值
        reset_null_arr($arg, ['searchid', 'facebookid_fans', 'content', 'count', 'updatetime', 'updatetime_inputtime_date', 'updatetime_inputtime_time', 'status']);
        foreach($arg as $key => $value) ${$key} = $arg[$key];
        
        //將引數設為物件屬性，或將引數作為物件型屬性的建構值
        $this->set('searchid', $searchid);
        $this->set('facebookid_fans', $facebookid_fans);
        $this->set('content', $content);
        $this->set('count', $count);
        $this->set('updatetime_DateTime', [
            'datetime' => $updatetime,
            'inputtime_date' => $updatetime_inputtime_date,
            'inputtime_time' => $updatetime_inputtime_time
        ], 'DateTimeObj');
        $this->set('status', $status);
        
        return TRUE;
    }
    
}