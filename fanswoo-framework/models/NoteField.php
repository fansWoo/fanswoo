<?php

class NoteField extends Note {

    public $content_Html;
    public $db_name_Arr = array('note', 'note_field');//填寫物件聯繫資料庫之名稱
    public $db_uniqueid_Str = 'noteid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_Arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'note.noteid' => 'noteid_Num',
        'note.uid' => ['uid_User', 'uid_Num'],
        'note.username' => 'username_Str',
        'note.title' => 'title_Str',
        'note.slug' => 'slug_Str',
        'note.picids' => array('pic_PicObjList', 'uniqueids_Str'),
        'note.classids' => array('class_ClassMetaList', 'uniqueids_Str'),
        'note.modelname' => 'modelname_Str',
        'note.viewnum' => 'viewnum_Num',
        'note.replynum' => 'replynum_Num',
        'note.prioritynum' => 'prioritynum_Num',
        'note.updatetime' => array('updatetime_DateTime', 'datetime_Str'),
        'note.locale' => 'locale_Str',
        'note.shelves_status' => 'shelves_status_Num',
        'note.status' => 'status_Num',
        'note_field.content' => 'content_Html'
    );
	
	public function construct($arg)
	{
        parent::construct($arg);

        $this->set('content_Html', $arg['content_Str']);

        return TRUE;
    }
	
}