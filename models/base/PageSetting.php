<?php

class PageSetting extends ObjDbBase
{
    public $db_name_arr = ['page_setting']; //填寫物件聯繫資料庫之名稱
    public $db_uniqueid = 'page_settingid'; //填寫物件聯繫資料庫之唯一ID
    public $db_field_arr = [ //填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'page_settingid' => 'page_settingid',
        'uid' => 'uid',
        'title' => 'title',
        'tag' => 'tag',
        'href' => 'href',
        'global_status' => 'global_status',
        'metatag' => 'metatag',
        'script_plugin' => 'script_plugin',
        'synopsis' => 'synopsis',
        'view' => 'view',
        'status' => 'status'
    ];
	
	public function construct($arg = [])
	{
        $this->set('page_settingid', $arg['page_settingid']);
        $this->set('title', $arg['title']);
        $this->set('tag', $arg['tag']);
        $this->set('href', $arg['href']);
        $this->set('global_status', $arg['global_status']);
        $this->set('metatag', $arg['metatag']);
        $this->set('script_plugin', $arg['script_plugin']);
        $this->set('synopsis', $arg['synopsis']);
        $this->set('view', $arg['view']);
        $this->set__uid(['uid' => $arg['uid']]);
        $this->set__status(['status' => $arg['status']]);
    }

}