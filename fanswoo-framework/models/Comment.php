<?php

class Comment extends ObjDbBase {

    public $commentid_Num = 0;
    public $uid_Num = 0;
    public $uid_User;
    public $typename_Str;
    public $id_Num;
    public $title_Str = '';
    public $content_Html = '';
    public $updatetime_DateTime = 0;
    public $status_Num = 1;
    public $db_name_Str = 'comment';//填寫物件聯繫資料庫之名稱
    public $db_uniqueid_Str = 'commentid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_Arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'commentid' => 'commentid_Num',
        'uid' => 'uid_Num',
        'typename' => 'typename_Str',
        'id' => 'id_Num',
        'title' => 'title_Str',
        'content' => 'content_Html',
        'updatetime' => array('updatetime_DateTime', 'datetime_Str'),
        'status' => 'status_Num'
    );
	
	public function construct($arg)
	{
        //引入引數並將空值的變數給予空值
        foreach($arg as $key => $value) ${$key} = $arg[$key];
        
        //將引數設為物件屬性，或將引數作為物件型屬性的建構值
        $this->set('commentid_Num', $commentid_Num);
        $this->set('title_Str', $title_Str);
        $this->set('typename_Str', $typename_Str);
        $this->set('id_Num', $id_Num);
        $this->set('content_Html', $content_Str);
        $this->set('updatetime_DateTime', [
            'datetime_Str' => $updatetime_Str,
            'inputtime_date_Str' => $updatetime_inputtime_date_Str,
            'inputtime_time_Str' => $updatetime_inputtime_time_Str
        ], 'DateTimeObj');
        $this->set__status_Num(['status_Num' => $status_Num]);
        $this->set__uid_Num(['uid_Num' => $uid_Num]);
        $this->set__uid_User(['uid_Num' => $uid_Num]);
        
        return TRUE;
    }
	
}