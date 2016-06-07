<?php
        
class Pic_Controller extends MY_Controller {

    public function upload_pic()
    {
        $response_arr = [];

        $picids_FilesArr = $this->input->file('picids_FilesArr');
        foreach($picids_FilesArr['name'] as $key => $value)
        {
            if(!empty($value))
            {
                $pic_PicObj = new PicObj();
                $pic_PicObj->construct(array(
                    'picfile_FileArr' => getfile_from_files(array(
                        'files_arr' => $picids_FilesArr,
                        'key' => $key
                    )),
                    'thumb' => 'w50h50,w300h300,w600h600'
                ));
                $pic_upload_Return = $pic_PicObj->upload();
                if( $pic_upload_Return === TRUE )
                {
                    $pic_arr[] = $pic_PicObj;
                }
                else if ( $pic_upload_Return === FALSE)
                {
                    $response_arr['status'] = 'false';
                    $response_arr['error_message'] = '未知的錯誤';
                    echo json_encode($response_arr);
                    return TRUE;
                }
                else
                {
                    $response_arr['status'] = 'false';
                    $response_arr['error_message'] = $pic_upload_Return;
                    echo json_encode($response_arr);
                    return TRUE;
                }
            }
        }
        $response_arr['status'] = 'true';
        $response_arr['error_message'] = '上傳成功';
        $response_arr['pic_arr'] = $pic_arr;
        echo json_encode($response_arr);
        return TRUE;
    }
    
    public function delete_pic($do, $picid = 0)
    {
        global $admin;
        $data = $this->common_model->data;
        $child_name = 'postpic';//管理分類類別名稱
        
        if( !empty($picid) )
        {
            $PicObj = new PicObj();
            $PicObj->construct(array('picid' => $picid));
            $PicObj->delete();
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
}

?>