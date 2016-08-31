<?php

class ClassMeta extends ObjDbBase {

    public $construct_class_bln = TRUE;
    public $ObjList = [];
    public $db_name_arr = ['class'];//填寫物件聯繫資料庫之名稱
    public $db_uniqueid = 'classid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_arr = [//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'classid' => 'classid',
        'uid' => ['uid_User', 'uid'],
        'classname' => 'classname',
        'slug' => 'slug',
        'content' => 'content',
        'modelname' => 'modelname',
        'amountnum' => 'amountnum',
        'classids' => ['class_ClassMetaList', 'uniqueids'],
        'updatetime' => ['updatetime_DateTime', 'datetime'],
        'prioritynum' => 'prioritynum',
        'locale' => 'locale',
        'status' => 'status'
    ];
	
	public function construct($arg = [])
	{
        $data = $this->data;

        $classid = !empty($arg['classid']) ? $arg['classid'] : 0;
        $classname = !empty($arg['classname']) ? $arg['classname'] : '';
        $slug = !empty($arg['slug']) ? $arg['slug'] : '';
        $content = !empty($arg['content']) ? $arg['content'] : '';
        $modelname = !empty($arg['modelname']) ? $arg['modelname'] : '';
        $amountnum = !empty($arg['amountnum']) ? $arg['amountnum'] : 0;
        $classids = !empty($arg['classids']) ? $arg['classids'] : '';
        $classids_arr = !empty($arg['classids_arr']) ? $arg['classids_arr'] : array();
        $updatetime = !empty($arg['updatetime']) ? $arg['updatetime'] : '';
        $updatetime_inputtime_date = !empty($arg['updatetime_inputtime_date']) ? $arg['updatetime_inputtime_date'] : '';
        $updatetime_inputtime_time = !empty($arg['updatetime_inputtime_time']) ? $arg['updatetime_inputtime_time'] : '';
        $prioritynum = !empty($arg['prioritynum']) ? $arg['prioritynum'] : 0;
        $locale = !empty($arg['locale']) ? $arg['locale'] : '';
        $status = !empty($arg['status']) ? $arg['status'] : 1;
        
        //建立ClassMetaList物件
        if($this->construct_class_bln)
        {
            check_comma_array($classids, $classids_arr);
            $class_ClassMetaList = new ObjList;
            $class_ClassMetaList->construct_db(array(
                'db_where_arr' => array(
                    'classid in' => $classids_arr
                ),
                'obj_class' => 'ClassMeta',
                'limitstart' => 0,
                'limitcount' => 100
            ));
        }

        //建立DateTime物件
        $updatetime_DateTime = new DateTimeObj();
        $updatetime_DateTime->construct(array(
            'datetime' => $updatetime,
            'inputtime_date' => $updatetime_inputtime_date,
            'inputtime_time' => $updatetime_inputtime_time
        ));
        
        //set
        $this->classid = $classid;
        $this->classname = $classname;
        $this->amountnum = $amountnum;
        $this->modelname = $modelname;
        $this->class_ClassMetaList = $class_ClassMetaList;
        $this->prioritynum = $prioritynum;
        $this->updatetime_DateTime = $updatetime_DateTime;
        $this->status = $status;

        $this->set('content', $content);
        $this->set__locale(['locale' => $arg['locale']]);
        $this->set__slug(['slug' => $slug]);
        $this->set__uid_User(['uid' => $arg['uid']]);
        
        return TRUE;
    }
    
}