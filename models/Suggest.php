<?php

class Suggest extends ObjDbBase
{

    public $suggestid_Num = 0;
    public $projectid_Num = 0;
    public $uid_Num = 0;
    public $title_Str = '';
    public $content_Str = '';
    public $answer_Str = '';
    public $suggest_time_DateTime;
    public $updatetime_DateTime;
    public $suggest_status_Num = 0;
    public $answer_status_Num = 1;
    public $status_Num = 1;
    public $db_name_Str = 'project_suggest';//填寫物件聯繫資料庫之名稱
    public $db_uniqueid_Str = 'suggestid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_Arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'suggestid' => 'suggestid_Num',
        'projectid' => 'projectid_Num',
        'uid' => 'uid_Num',
        'title' => 'title_Str',
        'content' => 'content_Str',
        'answer' => 'answer_Str',
        'suggest_time' => array('suggest_time_DateTime', 'datetime_Str'),
        'updatetime' => array('updatetime_DateTime', 'datetime_Str'),
        'suggest_status' => 'suggest_status_Num',
        'answer_status' => 'answer_status_Num',
        'status' => 'status_Num'
    );
	
	public function construct($arg)
    {
        $data = $this->data;
        
        //將引數設為物件屬性，或將引數作為物件型屬性的建構值
        $this->set('suggestid_Num', $arg['suggestid_Num']);
        $this->set('projectid_Num', $arg['projectid_Num']);
        $this->set('title_Str', $arg['title_Str']);
        $this->set('content_Str', $arg['content_Str']);
        $this->set('answer_Str', $arg['answer_Str']);;
        $this->set('suggest_time_DateTime', [
            'datetime_Str' => $arg['suggest_time_Str'],
            'inputtime_date_Str' => $arg['updatetime_inputtime_date_Str'],
            'inputtime_time_Str' => $arg['updatetime_inputtime_time_Str']
        ], 'DateTimeObj');
        $this->set('updatetime_DateTime', [
            'datetime_Str' => $arg['updatetime_Str'],
            'inputtime_date_Str' => $arg['updatetime_inputtime_date_Str'],
            'inputtime_time_Str' => $arg['updatetime_inputtime_time_Str']
        ], 'DateTimeObj');
        $this->set('suggest_status_Num', $arg['suggest_status_Num']);
        $this->set('answer_status_Num', $arg['answer_status_Num']);
        $this->set__status_Num(['status_Num' => $arg['status_Num']]);
        $this->set__uid_Num(['uid_Num' => $arg['uid_Num']]);
        
        return TRUE;
    }
	
}