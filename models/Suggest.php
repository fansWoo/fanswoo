<?php

class Suggest extends ObjDbBase
{

    public $suggestid = 0;
    public $projectid = 0;
    public $uid = 0;
    public $title = '';
    public $content = '';
    public $answer = '';
    public $suggest_time_DateTime;
    public $updatetime_DateTime;
    public $suggest_status = 0;
    public $answer_status = 1;
    public $status = 1;
    public $db_name_arr = ['project_suggest'];//填寫物件聯繫資料庫之名稱
    public $db_uniqueid = 'suggestid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'suggestid' => 'suggestid',
        'projectid' => 'projectid',
        'uid' => 'uid',
        'title' => 'title',
        'content' => 'content',
        'answer' => 'answer',
        'suggest_time' => array('suggest_time_DateTime', 'datetime'),
        'updatetime' => array('updatetime_DateTime', 'datetime'),
        'suggest_status' => 'suggest_status',
        'answer_status' => 'answer_status',
        'status' => 'status'
    );
	
	public function construct($arg = [])
    {
        $data = $this->data;
        
        //將引數設為物件屬性，或將引數作為物件型屬性的建構值
        $this->set('suggestid', $arg['suggestid']);
        $this->set('projectid', $arg['projectid']);
        $this->set('title', $arg['title']);
        $this->set('content', $arg['content']);
        $this->set('answer', $arg['answer']);;
        $this->set('suggest_time_DateTime', [
            'datetime' => $arg['suggest_time'],
            'inputtime_date' => $arg['updatetime_inputtime_date'],
            'inputtime_time' => $arg['updatetime_inputtime_time']
        ], 'DateTimeObj');
        $this->set('updatetime_DateTime', [
            'datetime' => $arg['updatetime'],
            'inputtime_date' => $arg['updatetime_inputtime_date'],
            'inputtime_time' => $arg['updatetime_inputtime_time']
        ], 'DateTimeObj');
        $this->set('suggest_status', $arg['suggest_status']);
        $this->set('answer_status', $arg['answer_status']);
        $this->set__status(['status' => $arg['status']]);
        $this->set__uid(['uid' => $arg['uid']]);
        
        return TRUE;
    }
	
}