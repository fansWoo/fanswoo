<?php

class Worktask extends ObjDbBase
{

    public $designid = 0;
    public $projectid = 0;
    public $title = '';
    public $synopsis = '';
    public $price = 0;
    public $classname = '';
    public $days = 0;
    public $prioritynum = 0;
    public $status = 1;
    public $db_name = 'project_design';//填寫物件聯繫資料庫之名稱
    public $db_uniqueid = 'designid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'designid' => 'designid',
        'projectid' => 'projectid',
        'title' => 'title',
        'synopsis' => 'synopsis',
        'price' => 'price',
        'classname' => 'classname',
        'days' => 'days',
        'prioritynum' => 'prioritynum',
        'status' => 'status'
    );
	
	public function construct($arg = [])
    {
        $data = $this->data;
        
        //將引數設為物件屬性，或將引數作為物件型屬性的建構值
        $this->set('designid', $arg['designid']);
        $this->set('projectid', $arg['projectid']);
        $this->set('title', $arg['title']);
        $this->set('synopsis', $arg['synopsis']);
        $this->set('price', $arg['price']);
        $this->set('classname', $arg['classname']);
        $this->set('days', $arg['days']);
        $this->set('prioritynum', $arg['prioritynum']);
        $this->set__status(['status' => $arg['status']]);
        
        return TRUE;
    }
	
}