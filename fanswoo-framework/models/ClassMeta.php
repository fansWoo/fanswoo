<?php

class ClassMeta extends ObjDbBase {

    public $classid_Num = 0;
    public $uid_Num = 0;
    public $classname_Str = '';
    public $slug_Str = '';
    public $content_Str = '';
    public $modelname_Str = '';
    public $amountnum_Num = 0;
    public $class_ClassMetaList;//分類標籤類別列表
    public $prioritynum_Num = 0;
    public $updatetime_DateTime;
    public $locale_Str = '';
    public $status_Num = 1;
    public $construct_class_Bln = TRUE;
    public $ObjList = array();
    public $db_name_Str = 'class';//填寫物件聯繫資料庫之名稱
    public $db_uniqueid_Str = 'classid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_Arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'classid' => 'classid_Num',
        'uid' => 'uid_Num',
        'classname' => 'classname_Str',
        'slug' => 'slug_Str',
        'content' => 'content_Str',
        'modelname' => 'modelname_Str',
        'amountnum' => 'amountnum_Num',
        'classids' => array('class_ClassMetaList', 'uniqueids_Str'),
        'updatetime' => array('updatetime_DateTime', 'datetime_Str'),
        'prioritynum' => 'prioritynum_Num',
        'locale' => 'locale_Str',
        'status' => 'status_Num'
    );
	
	public function construct($arg)
	{
        $data = $this->data;

        $classid_Num = !empty($arg['classid_Num']) ? $arg['classid_Num'] : 0;
        $uid_Num = !empty($arg['uid_Num']) ? $arg['uid_Num'] : 0;
        $classname_Str = !empty($arg['classname_Str']) ? $arg['classname_Str'] : '';
        $slug_Str = !empty($arg['slug_Str']) ? $arg['slug_Str'] : '';
        $content_Str = !empty($arg['content_Str']) ? $arg['content_Str'] : '';
        $modelname_Str = !empty($arg['modelname_Str']) ? $arg['modelname_Str'] : '';
        $amountnum_Num = !empty($arg['amountnum_Num']) ? $arg['amountnum'] : 0;
        $classids_Str = !empty($arg['classids_Str']) ? $arg['classids_Str'] : '';
        $classids_Arr = !empty($arg['classids_Arr']) ? $arg['classids_Arr'] : array();
        $updatetime_Str = !empty($arg['updatetime_Str']) ? $arg['updatetime_Str'] : '';
        $updatetime_inputtime_date_Str = !empty($arg['updatetime_inputtime_date_Str']) ? $arg['updatetime_inputtime_date_Str'] : '';
        $updatetime_inputtime_time_Str = !empty($arg['updatetime_inputtime_time_Str']) ? $arg['updatetime_inputtime_time_Str'] : '';
        $prioritynum_Num = !empty($arg['prioritynum_Num']) ? $arg['prioritynum_Num'] : 0;
        $locale_Str = !empty($arg['locale_Str']) ? $arg['locale_Str'] : '';
        $status_Num = !empty($arg['status_Num']) ? $arg['status_Num'] : 1;
        
        //建立ClassMetaList物件
        if($this->construct_class_Bln)
        {
            check_comma_array($classids_Str, $classids_Arr);
            $class_ClassMetaList = new ObjList;
            $class_ClassMetaList->construct_db(array(
                'db_where_or_Arr' => array(
                    'classid_Num' => $classids_Arr
                ),
                'model_name_Str' => 'ClassMeta',
                'limitstart_Num' => 0,
                'limitcount_Num' => 100
            ));
        }

        //建立DateTime物件
        $updatetime_DateTime = new DateTimeObj();
        $updatetime_DateTime->construct(array(
            'datetime_Str' => $updatetime_Str,
            'inputtime_date_Str' => $updatetime_inputtime_date_Str,
            'inputtime_time_Str' => $updatetime_inputtime_time_Str
        ));
        
        //set
        $this->classid_Num = $classid_Num;
        $this->classname_Str = $classname_Str;
        $this->amountnum_Num = $amountnum_Num;
        $this->modelname_Str = $modelname_Str;
        $this->class_ClassMetaList = $class_ClassMetaList;
        $this->prioritynum_Num = $prioritynum_Num;
        $this->updatetime_DateTime = $updatetime_DateTime;
        $this->status_Num = $status_Num;

        $this->set('content_Str', $content_Str);
        $this->set__locale_Str(['locale_Str' => $arg['locale_Str']]);
        $this->set__slug_Str(['slug_Str' => $slug_Str]);
        $this->set__uid_Num(['uid_Num' => $uid_Num]);
        
        return TRUE;
    }
    
}