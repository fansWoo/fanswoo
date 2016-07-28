<?php

class Worktask extends ObjDbBase
{

    public $worktaskid = 0;
    public $projectid = 0;
    public $title = '';
    public $content_Html = '';
    public $class_ClassMetaList;
    public $estimate_hour = 0;
    public $use_hour = 0;
    public $uid_User;
    public $start_time_DateTime;
    public $end_time_DateTime;
    public $prioritynum = 0;
    public $work_status = 1;
    public $status = 1;
    public $db_name_arr = ['project_worktask'];//填寫物件聯繫資料庫之名稱
    public $db_uniqueid = 'worktaskid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'worktaskid' => 'worktaskid',
        'projectid' => 'projectid',
        'title' => 'title',
        'content' => 'content_Html',
        'uid' => ['uid_User', 'uid'],
        'classids' => ['class_ClassMetaList', 'uniqueids'],
        'estimate_hour' => 'estimate_hour',
        'use_hour' => 'use_hour',
        'start_time' => array('start_time_DateTime', 'datetime'),
        'end_time' => array('end_time_DateTime', 'datetime'),
        'prioritynum' => 'prioritynum',
        'work_status' => 'work_status',
        'status' => 'status'
    );
	
	public function construct($arg = [])
    {
        $data = $this->data;
        
        //將引數設為物件屬性，或將引數作為物件型屬性的建構值
        $this->set('worktaskid', $arg['worktaskid']);
        $this->set('projectid', $arg['projectid']);
        $this->set('title', $arg['title']);
        $this->set('content_Html', $arg['content']);
        $this->set('estimate_hour', $arg['estimate_hour']);
        $this->set('use_hour', $arg['use_hour']);
        $this->set('prioritynum', $arg['prioritynum']);
        $this->set('work_status', $arg['work_status']);
        $this->set('start_time_DateTime', [
            'datetime' => $arg['start_time'],
            'inputtime_date' => $arg['start_inputtime_date'],
            'inputtime_time' => $arg['start_inputtime_time']
        ], 'DateTimeObj');
        $this->set('class_ClassMetaList', [
            'classids' => $arg['classids'],
            'classids_arr' => $arg['classids_arr']
        ], 'ClassMetaList');
        $this->set('end_time_DateTime', [
            'datetime' => $arg['end_time'],
            'inputtime_date' => $arg['start_inputtime_date'],
            'inputtime_time' => $arg['start_inputtime_time']
        ], 'DateTimeObj');
        $this->set__uid_User(['uid' => $arg['uid']]);
        $this->set__status(['status' => $arg['status']]);
        
        return TRUE;
    }
	
}