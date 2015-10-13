<?php

class Note extends ObjDbBase {

    public $noteid_Num = 0;
    public $uid_Num = 0;
    public $username_Str = '';
    public $title_Str = '';
    public $pic_PicObjList;
    public $class_ClassMetaList;
    public $modelname_Str;
    public $viewnum_Num = 0;
    public $replynum_Num = 0;
    public $prioritynum_Num = 0;
    public $updatetime_DateTime = 0;
    public $locale_Str = '';
    public $status_Num = 1;
    public $db_name_Str = 'note';//填寫物件聯繫資料庫之名稱
    public $db_uniqueid_Str = 'noteid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_Arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'noteid' => 'noteid_Num',
        'uid' => 'uid_Num',
        'username' => 'username_Str',
        'title' => 'title_Str',
        'content' => 'content_Html',
        'picids' => array('pic_PicObjList', 'uniqueids_Str'),
        'classids' => array('class_ClassMetaList', 'uniqueids_Str'),
        'modelname' => 'modelname_Str',
        'viewnum' => 'viewnum_Num',
        'replynum' => 'replynum_Num',
        'prioritynum' => 'prioritynum_Num',
        'updatetime' => array('updatetime_DateTime', 'datetime_Str'),
        'locale' => 'locale_Str',
        'status' => 'status_Num'
    );
	
	public function construct($arg)
	{
        //將引數設為物件屬性，或將引數作為物件型屬性的建構值
        $this->set('noteid_Num', $arg['noteid_Num']);
        $this->set('username_Str', $arg['username_Str']);
        $this->set('title_Str', $arg['title_Str']);
        $this->set('viewnum_Num', $arg['viewnum_Num']);
        $this->set('replynum_Num', $arg['replynum_Num']);
        $this->set('prioritynum_Num', $arg['prioritynum_Num']);
        $this->set('modelname_Str', $arg['modelname_Str']);
        $this->set('class_ClassMetaList', [
            'classids_Str' => $arg['classids_Str'],
            'classids_Arr' => $arg['classids_Arr']
        ], 'ClassMetaList');
        $this->set('updatetime_DateTime', [
            'datetime_Str' => $arg['updatetime_Str'],
            'inputtime_date_Str' => $arg['updatetime_inputtime_date_Str'],
            'inputtime_time_Str' => $arg['updatetime_inputtime_time_Str']
        ], 'DateTimeObj');
        $this->set('pic_PicObjList', [
            'picids_Str' => $arg['picids_Str'],
            'picids_Arr' => $arg['picids_Arr']
        ], 'PicObjList');
        $this->set__locale_Str(['locale_Str' => $arg['locale_Str']]);
        $this->set__status_Num(['status_Num' => $arg['status_Num']]);
        $this->set__uid_Num(['uid_Num' => $arg['uid_Num']]);
        
        return TRUE;
    }
	
}