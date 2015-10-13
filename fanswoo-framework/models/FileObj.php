<?php

class FileObj extends ObjDbBase {

    public $fileid_Num = 0;
    public $uid_Num = 0;
    public $title_Str = '';
    public $filename_Str = '';
    public $size_Num = '';
    public $type_Str = '';
    public $md5_Str = '';
    public $permission_uids_Str = '';
    public $class_ClassMetaList;
    public $filefile_FileArr = array();
    public $path_Str = '';
    public $prioritynum_Num = 0;
    public $updatetime_DateTime;
    public $status_Num = 1;
    public $max_size_Num = 10485760;//單一檔案最大上傳尺寸
    public $db_name_Str = 'file';//填寫物件聯繫資料庫之名稱
    public $db_uniqueid_Str = 'fileid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_Arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'fileid' => 'fileid_Num',
        'uid' => 'uid_Num',
        'title' => 'title_Str',
        'filename' => 'filename_Str',
        'size' => 'size_Num',
        'type' => 'type_Str',
        'md5' => 'md5_Str',
        'permission_uids' => 'permission_uids_Str',
        'classids' => array('class_ClassMetaList', 'uniqueids_Str'),
        'prioritynum' => 'prioritynum_Num',
        'updatetime' => array('updatetime_DateTime', 'datetime_Str'),
        'status' => 'status_Num'
    );
	
	public function construct($arg)
	{
        $fileid_Num = !empty($arg['fileid_Num']) ? $arg['fileid_Num'] : 0 ;
        $uid_Num = !empty($arg['uid_Num']) ? $arg['uid_Num'] : array() ;
        $filefile_FileArr = !empty($arg['filefile_FileArr']) ? $arg['filefile_FileArr'] : array() ;
        $title_Str = !empty($arg['title_Str']) ? $arg['title_Str'] : '' ;
        $filename_Str = !empty($arg['filename_Str']) ? $arg['filename_Str'] : '' ;
        $size_Num = !empty($arg['size_Num']) ? $arg['size_Num'] : 0 ;
        $type_Str = !empty($arg['type_Str']) ? $arg['type_Str'] : '' ;
        $md5_Str = !empty($arg['md5_Str']) ? $arg['md5_Str'] : '' ;
        $permission_uids_Str = !empty($arg['permission_uids_Str']) ? $arg['permission_uids_Str'] : '' ;
        $classids_Str = !empty($arg['classids_Str']) ? $arg['classids_Str'] : '' ;
        $classids_Arr = !empty($arg['classids_Arr']) ? $arg['classids_Arr'] : array() ;
        $path_Str = !empty($arg['path_Str']) ? $arg['path_Str'] : '' ;
        $prioritynum_Num = !empty($arg['prioritynum_Num']) ? $arg['prioritynum_Num'] : 0;
        $updatetime_Str = !empty($arg['updatetime_Str']) ? $arg['updatetime_Str'] : '';
        $updatetime_inputtime_date_Str = !empty($arg['updatetime_inputtime_date_Str']) ? $arg['updatetime_inputtime_date_Str'] : '';
        $updatetime_inputtime_time_Str = !empty($arg['updatetime_inputtime_time_Str']) ? $arg['updatetime_inputtime_time_Str'] : '';
        $status_Num = !empty($arg['status_Num']) ? $arg['status_Num'] : 1 ;
        
        //classid運算
        check_comma_array($classids_Str, $classids_Arr);
        $class_ClassMetaList = new ObjList();
        $class_ClassMetaList->construct_db(array(
            'db_where_or_Arr' => array(
                'classid' => $classids_Arr
            ),
            'model_name_Str' => 'ClassMeta',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));
        
        //uid
        if(empty($uid_Num))
        {
            $data['user'] = get_user();
            $uid_Num = $data['user']['uid'];
        }
        
        //title size type filename
        if(empty($title_Str) && !empty($filefile_FileArr) )
        {
            $title_Str = $filefile_FileArr['name'];
        }
        if(empty($filename_Str) && !empty($filefile_FileArr) )
        {
            $filename_Str = $filefile_FileArr['name'];
        }
        if(empty($size_Num) && !empty($filefile_FileArr) )
        {
            $size_Num = $filefile_FileArr['size'];
        }
        if(empty($type_Str) && !empty($filefile_FileArr) )
        {
            $type_Str = $filefile_FileArr['type'];
        }
        
        //md5
        if( empty($md5_Str) )
        {
            $md5_Str = substr(md5('FANSWOO'.rand(10000000, 99999999)),8,16);
        }

        //建立DateTime物件
        $updatetime_DateTime = new DateTimeObj();
        $updatetime_DateTime->construct(array(
            'datetime_Str' => $updatetime_Str,
            'inputtime_date_Str' => $updatetime_inputtime_date_Str,
            'inputtime_time_Str' => $updatetime_inputtime_time_Str
        ));
        
        //set
        $this->fileid_Num = $fileid_Num;
        $this->uid_Num = $uid_Num;
        $this->filename_Str = $filename_Str;
        $this->title_Str = $title_Str;
        $this->size_Num = $size_Num;
        $this->type_Str = $type_Str;
        $this->md5_Str = $md5_Str;
        $this->permission_uids_Str = $permission_uids_Str;
        $this->class_ClassMetaList = $class_ClassMetaList;
        $this->filefile_FileArr = $filefile_FileArr;
        $this->prioritynum_Num = $prioritynum_Num;
        $this->updatetime_DateTime = $updatetime_DateTime;
        $this->status_Num = $status_Num;

        $path_Str = $this->get_path();
        $this->path_Str = $path_Str;
        
        return TRUE;
    }

    public function get_path()
    {
        //path
        if( !empty($this->md5_Str) && !empty($this->fileid_Num) )
        {
            // $type_Arr = explode('/', $this->type_Str);
            $type_Arr = explode('.', $this->filename_Str);
            $ext_Str = $type_Arr[1];
            $substr_fileid_Num = abs(intval($this->fileid_Num));
            $substr_fileid_Num = sprintf("%08d", $substr_fileid_Num);

            $dir1_Num = substr($substr_fileid_Num, 0, 2);
            $dir2_Num = substr($substr_fileid_Num, 2, 2);
            $dir3_Num = substr($substr_fileid_Num, 4, 2);
            $dir4_Num = substr($substr_fileid_Num, 6, 2);
            $path_Str = prep_url($_SERVER['HTTP_HOST'].base_url('app/file/'.$dir1_Num.'/'.$dir2_Num.'/'.$dir3_Num.'/'.$dir4_Num.'-'.$this->md5_Str.'.'.$ext_Str));
        }
        else
        {
            $path_Str = '';
        }

        return $path_Str;
    }
    
    public function upload()
    {
        
        $filefile_FileArr = $this->filefile_FileArr;
        
        if(empty($filefile_FileArr))
        {
            return FALSE;
        }

        if($filefile_FileArr['size'] > $this->max_size_Num )
        {
            return '單一檔案尺寸過大，超過檔案最大限制';
        }
        
        $this->update();

        //path
        if( !empty($this->md5_Str) && !empty($this->fileid_Num) )
        {
            // $type_Arr = explode('/', $this->type_Str);
            $type_Arr = explode('.', $this->filename_Str);
            $ext_Str = $type_Arr[1];
            $substr_fileid_Num = abs(intval($this->fileid_Num));
            $substr_fileid_Num = sprintf("%08d", $substr_fileid_Num);

            $dir1_Num = substr($substr_fileid_Num, 0, 2);
            $dir2_Num = substr($substr_fileid_Num, 2, 2);
            $dir3_Num = substr($substr_fileid_Num, 4, 2);
            $dir4_Num = substr($substr_fileid_Num, 6, 2);
        
            $path1_Str = APPPATH.'./file/'.$dir1_Num;
            if( !is_dir($path1_Str) ) mkdir($path1_Str, 0777);
            $path2_Str = APPPATH.'./file/'.$dir1_Num.'/'.$dir2_Num;
            if( !is_dir($path2_Str) ) mkdir($path2_Str, 0777);
            $path3_Str = APPPATH.'./file/'.$dir1_Num.'/'.$dir2_Num.'/'.$dir3_Num;
            if( !is_dir($path3_Str) ) mkdir($path3_Str, 0777);

            $path_Str = APPPATH."file/".$dir1_Num."/".$dir2_Num."/".$dir3_Num."/".$dir4_Num."-".$this->md5_Str.".".$ext_Str;

            move_uploaded_file($filefile_FileArr['tmp_name'], $path_Str);

            $this->set('path_Str', $this->get_path() );

            return TRUE;
        }
        else
        {
            return FALSE;
        }
        
    }
	
}