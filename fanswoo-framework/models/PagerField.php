<?php

class PagerField extends Pager {

    public $content_Html;
    public $db_name_Arr = array('pager', 'pager_field');//填寫物件聯繫資料庫之名稱
    public $db_uniqueid_Str = 'pagerid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_Arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'pager.pagerid' => 'pagerid_Num',
        'pager.uid' => 'uid_Num',
        'pager.username' => 'username_Str',
        'pager.title' => 'title_Str',
        'pager.slug' => 'slug_Str',
        'pager.href' => 'href_Str',
        'pager.target' => 'target_Num',
        'pager.classids' => array('class_ClassMetaList', 'uniqueids_Str'),
        'pager.viewnum' => 'viewnum_Num',
        'pager.prioritynum' => 'prioritynum_Num',
        'pager.updatetime' => array('updatetime_DateTime', 'datetime_Str'),
        'pager.locale' => 'locale_Str',
        'pager.status' => 'status_Num',
        'pager_field.content' => 'content_Html'
    );
	
	public function construct($arg)
	{
        parent::construct($arg);

        $this->set('content_Html', $arg['content_Str']);

        return TRUE;
    }
	
}