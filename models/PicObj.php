<?php

class PicObj extends ObjDbBase {

    public $file_path_arr = [];
    public $path_arr = [];
    public $picfile_FileArr = [];
    public $modelname = 'w50h50,w300h300,w600h600';
    public $comment_CommentList;
    public $max_size = 10485760;//單一檔案最大上傳尺寸
    public $db_name_arr = ['pic'];//填寫物件聯繫資料庫之名稱
    public $db_uniqueid = 'picid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_arr = [//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'picid' => 'picid',
        'uid' => ['uid_User', 'uid'],
        'title' => 'title',
        'thumb' => 'thumb',//ex: w50h50,w300h300//ex: array('w0h0' => 'pic/00/52/85/01-abcdefg-w100h100.jpg', 'w100h100' => 'pic/00/52/85/01-abcdefg-w100h100.jpg')
        'filename' => 'filename',
        'size' => 'size',
        'type' => 'type',
        'md5' => 'md5',
        'classids' => ['class_ClassMetaList', 'uniqueids'],
        'upload_status' => 'upload_status',
        'prioritynum' => 'prioritynum',
        'updatetime' => ['updatetime_DateTime', 'datetime'],
        'status' => 'status'
    ];
	
	public function construct($arg = [])
	{
        $picid = !empty($arg['picid']) ? $arg['picid'] : 0 ;
        $picfile_FileArr = !empty($arg['picfile_FileArr']) ? $arg['picfile_FileArr'] : array() ;
        $thumb = !empty($arg['thumb']) ? $arg['thumb'] : 'w50h50,w300h300' ;
        $title = !empty($arg['title']) ? $arg['title'] : '' ;
        $filename = !empty($arg['filename']) ? $arg['filename'] : '' ;
        $size = !empty($arg['size']) ? $arg['size'] : 0 ;
        $type = !empty($arg['type']) ? $arg['type'] : '' ;
        $md5 = !empty($arg['md5']) ? $arg['md5'] : '' ;
        $classids = !empty($arg['classids']) ? $arg['classids'] : '' ;
        $classids_arr = !empty($arg['classids_arr']) ? $arg['classids_arr'] : array() ;
        $path_arr = !empty($arg['path_arr']) ? $arg['path_arr'] : '' ;
        $file_path_arr = !empty($arg['file_path_arr']) ? $arg['file_path_arr'] : '' ;
        $prioritynum = !empty($arg['prioritynum']) ? $arg['prioritynum'] : 0;
        $updatetime = !empty($arg['updatetime']) ? $arg['updatetime'] : '';
        $updatetime_inputtime_date = !empty($arg['updatetime_inputtime_date']) ? $arg['updatetime_inputtime_date'] : '';
        $updatetime_inputtime_time = !empty($arg['updatetime_inputtime_time']) ? $arg['updatetime_inputtime_time'] : '';
        $status = !empty($arg['status']) ? $arg['status'] : 1 ;
        $upload_status = !empty($arg['upload_status']) ? $arg['upload_status'] : 2;
        
        //classid運算
        check_comma_array($classids, $classids_arr);
        $class_ClassMetaList = new ObjList([
            'db_where_arr' => [
                'classid !=' => '',
                'classid in' => $classids_arr
            ],
            'obj_class' => 'ClassMeta',
            'limitstart' => 0,
            'limitcount' => 100
        ]);

        //若這個圖片有分類的話，就不屬於未分類或隱藏的圖片
        if( count($class_ClassMetaList->obj_arr) > 0 )
        {
            $upload_status = 1;
        }
        
        //title size type filename
        if(empty($title) && !empty($picfile_FileArr) )
        {
            $title = $picfile_FileArr['name'];
        }
        if(empty($filename) && !empty($picfile_FileArr) )
        {
            $filename = $picfile_FileArr['name'];
        }
        if(empty($size) && !empty($picfile_FileArr) )
        {
            $size = $picfile_FileArr['size'];
        }
        if(empty($type) && !empty($picfile_FileArr) )
        {
            $type = $picfile_FileArr['type'];
        }
        
        //md5
        if( empty($md5) )
        {
            $md5 = substr(md5('FANSWOO'.rand(10000000, 99999999)),8,16);
        }

        //建立DateTime物件
        $updatetime_DateTime = new DateTimeObj();
        $updatetime_DateTime->construct(array(
            'datetime' => $updatetime,
            'inputtime_date' => $updatetime_inputtime_date,
            'inputtime_time' => $updatetime_inputtime_time
        ));
        
        //set
        $this->set('picid', $picid);
        $this->set('filename', $filename);
        $this->set('thumb', $thumb);
        $this->set('title', $title);
        $this->set('size', $size);
        $this->set('type', $type);
        $this->set('md5', $md5);
        $this->set('class_ClassMetaList', $class_ClassMetaList);
        $this->set('picfile_FileArr', $picfile_FileArr);
        $this->set('prioritynum', $prioritynum);
        $this->set('updatetime_DateTime', $updatetime_DateTime);
        $this->set('upload_status', $upload_status);
        $this->set__status(['status' => $status]);
        $this->set__uid_User(['uid' => $arg['uid']]);
        $this->set__comment_CommentList(['picid' => $arg['picid']]);

        $path_arr = $this->get_path();
        $this->path_arr = $path_arr;
        $file_path_arr = $this->get_file_path();
        $this->file_path_arr = $file_path_arr;
        
        return TRUE;
    }

    public function set__comment_CommentList($arg)
    {
        reset_null_arr($arg, ['picid']);
        foreach($arg as $key => $value) ${$key} = $arg[$key];

        $comment_CommentList = new ObjList([
            'db_where_arr' => [
                'typename' => 'pic',
                'id' => $picid
            ],
            'db_orderby_arr' => [
                'updatetime' => 'DESC'
            ],
            'obj_class' => 'Comment',
            'limitstart' => 0,
            'limitcount' => 9999
        ]);
        $this->set('comment_CommentList', $comment_CommentList);
    }

    public function get_path()
    {
        //path
        if( !empty($this->thumb) && !empty($this->md5) && !empty($this->picid) )
        {
            $substr_picid = abs(intval($this->picid));
            $substr_picid = sprintf("%08d", $substr_picid);

            $dir1 = substr($substr_picid, 0, 2);
            $dir2 = substr($substr_picid, 2, 2);
            $dir3 = substr($substr_picid, 4, 2);
            $dir4 = substr($substr_picid, 6, 2);
            $path_arr['w0h0'] = '//'.$_SERVER['HTTP_HOST'].base_url('pic/'.$dir1.'/'.$dir2.'/'.$dir3.'/'.$dir4.'-'.$this->md5.'.jpg');
            
            $thumb_arr = explode(',', $this->thumb);
            foreach($thumb_arr as $key => $value)
            {
                $path_arr[$value] = '//'.$_SERVER['HTTP_HOST'].base_url('pic/'.$dir1.'/'.$dir2.'/'.$dir3.'/'.$dir4.'-'.$this->md5.'-'.$value.'.jpg');
            }
        }
        else
        {
            $path_arr = array();
        }

        return $path_arr;
    }

    public function get_file_path()
    {
        //path
        if( !empty($this->thumb) && !empty($this->md5) && !empty($this->picid) )
        {
            $substr_picid = abs(intval($this->picid));
            $substr_picid = sprintf("%08d", $substr_picid);

            $dir1 = substr($substr_picid, 0, 2);
            $dir2 = substr($substr_picid, 2, 2);
            $dir3 = substr($substr_picid, 4, 2);
            $dir4 = substr($substr_picid, 6, 2);
            $file_path_arr['w0h0'] = APPPATH.'pic/'.$dir1.'/'.$dir2.'/'.$dir3.'/'.$dir4.'-'.$this->md5.'.jpg';
            
            $thumb_arr = explode(',', $this->thumb);
            foreach($thumb_arr as $key => $value)
            {
                $file_path_arr[$value] = APPPATH.'pic/'.$dir1.'/'.$dir2.'/'.$dir3.'/'.$dir4.'-'.$this->md5.'-'.$value.'.jpg';
            }
        }
        else
        {
            $file_path_arr = array();
        }

        return $file_path_arr;
    }
    
    public function upload()
    {
        $thumb = $this->thumb;
        $picfile_FileArr = $this->picfile_FileArr;
        
        if(empty($picfile_FileArr))
        {
            return FALSE;
        }

        // return $this->uid_User->uid;
        
        $this->update();

        $cutphoto_status = $this->cutphoto(array('width' => 0, 'height' => 0));
        if($cutphoto_status !== TRUE)
        {
            $this->delete();
            return $cutphoto_status;
        }
        
        $thumb_arr = explode(',', $thumb);
        foreach($thumb_arr as $key => $value)
        {
            if(!empty($value))
            {
                $string = str_replace('w', '', $value);
                $string = explode('h', $string);
                $width = $string[0];
                $height = $string[1];
                $this->cutphoto( array( 'width' => $width, 'height' => $height) );
            }
        }

        $path_arr = $this->get_path();
        $this->path_arr = $path_arr;

        $file_path_arr = $this->get_file_path();
        $this->file_path_arr = $file_path_arr;
        
        return TRUE;
    }
    
    //壓縮&縮圖
    private function cutphoto($arg)
    {
        $width = empty($arg['width']) ? 0 : $arg['width'];
        $height = empty($arg['height']) ? 0 : $arg['height'];
        $picfile_FileArr = $this->picfile_FileArr;
        $o_photo = $this->picfile_FileArr['tmp_name'];
        $picid = $this->picid;
        $md5 = $this->md5;

        if(empty($picfile_FileArr))
        {
            return '請選擇正確的圖檔';
        }

        if($picfile_FileArr['size'] > $this->max_size )
        {
            return '單一檔案尺寸過大，超過檔案最大限制';
        }
        if($picfile_FileArr['size'] == 0)
        {
            return '圖檔尺寸過大超過伺服器限制，請聯繫伺服器管理員修改php.ini之upload_max_filesize限制';
        }

		$picid = abs(intval($picid));
		$picid = sprintf("%08d", $picid);
        
		$dir1 = substr($picid, 0, 2);
		$dir2 = substr($picid, 2, 2);
		$dir3 = substr($picid, 4, 2);
		$dir4 = substr($picid, 6, 2);
        
        $path1 = APPPATH.'./pic/'.$dir1;
        if( !is_dir($path1) ) mkdir($path1, 0777);
        $path2 = APPPATH.'./pic/'.$dir1.'/'.$dir2;
        if( !is_dir($path2) ) mkdir($path2, 0777);
        $path3 = APPPATH.'./pic/'.$dir1.'/'.$dir2.'/'.$dir3;
        if( !is_dir($path3) ) mkdir($path3, 0777);
        
        if($width == 0 || $height == 0)
        {
            $width = 10000;
            $height = 10000;
            $d_photo = APPPATH.'./pic/'.$dir1.'/'.$dir2.'/'.$dir3.'/'.$dir4.'-'.$md5.'.jpg';
        }
        else
        {
            $d_photo = APPPATH.'./pic/'.$dir1.'/'.$dir2.'/'.$dir3.'/'.$dir4.'-'.$md5.'-w'.$width.'h'.$height.'.jpg';
        }
        
        if($data = getimagesize($o_photo)) {
            if($data[2] == 1) {
                $make_max = 0;//gif不处理
                if(function_exists("imagecreatefromgif")) {
                    $temp_img = imagecreatefromgif($o_photo);
                }
            } elseif($data[2] == 2) {
                if(function_exists("imagecreatefromjpeg")) {
                    $temp_img = imagecreatefromjpeg($o_photo);
                }
            } elseif($data[2] == 3) {
                if(function_exists("imagecreatefrompng")) {
                    $temp_img = imagecreatefrompng($o_photo);
                }
            }
        }
        if(!$temp_img) return '';
        
        $o_width = imagesx($temp_img);//取得原图宽
        $o_height = imagesy($temp_img);//取得原图高

        //判断处理方法
        if($width>$o_width || $height>$o_height)
        {
            //原图宽或高比规定的尺寸小,进行压缩
            $newwidth = $o_width;
            $newheight = $o_height;
            if($o_width > $width)
            {
                $newwidth = $width;
                $newheight = $o_height*$width/$o_width;
            }
            if($newheight > $height)
            {
                $newwidth = $newwidth*$height/$newheight;
                $newheight = $height;
            }
            //缩略图片
            $new_img = imagecreatetruecolor($newwidth, $newheight);
            
            imagecopyresampled($new_img, $temp_img, 0, 0, 0, 0, $newwidth, $newheight, $o_width, $o_height);
            imagejpeg($new_img , $d_photo, 100);
            imagedestroy($new_img);
        }
        else
        {
        //原图宽与高都比规定尺寸大,进行压缩后裁剪
            if($o_height*$width/$o_width>$height){
                //先确定width与规定相同,如果height比规定大,则ok
                $newwidth=$width;
                $newheight=$o_height*$width/$o_width;
                $x=0;
                $y=($newheight-$height)/2;
            }
            else
            {
                //否则确定height与规定相同,width自适应
                $newwidth=$o_width*$height/$o_height;
                $newheight=$height;
                $x=($newwidth-$width)/2;
                $y=0;
            }
            //缩略图片
            $new_img = imagecreatetruecolor($newwidth, $newheight);
            imagecopyresampled($new_img, $temp_img, 0, 0, 0, 0, $newwidth, $newheight, $o_width, $o_height);

            imagejpeg($new_img , $d_photo, 100);
            
            if($data = getimagesize($o_photo)) {
                if($data[2] == 1) {
                    $make_max = 0;//gif不处理
                    if(function_exists("imagecreatefromgif")) {
                        $temp_img = imagecreatefromgif($o_photo);
                    }
                } elseif($data[2] == 2) {
                    if(function_exists("imagecreatefromjpeg")) {
                        $temp_img = imagecreatefromjpeg($o_photo);
                    }
                } elseif($data[2] == 3) {
                    if(function_exists("imagecreatefrompng")) {
                        $temp_img = imagecreatefrompng($o_photo);
                    }
                }
            }
            if(!$temp_img) return '';

            // $o_width   = imagesx($temp_img);//取得缩略图宽
            // $o_height = imagesy($temp_img);//取得缩略图高
            
            //裁剪图片

            $new_imgx = imagecreatetruecolor($width,$height);
            imagecopyresampled($new_imgx,$new_img,0,0,0,0,$width,$height,$width,$height);
            imagejpeg($new_imgx , $d_photo, 100);
            imagedestroy($new_img);
            imagedestroy($new_imgx);
        }
        
        chmod($d_photo, 0777);

        return TRUE;
    }

    public function destroy()
    {
        parent::destroy();
        unlink( $this->file_path_arr['w0h0'] );
        unlink( $this->file_path_arr['w50h50'] );
        unlink( $this->file_path_arr['w300h300'] );
        unlink( $this->file_path_arr['w600h600'] );
    }
	
}