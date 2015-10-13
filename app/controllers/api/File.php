<?php
        
class File_Controller extends MY_Controller {

    public function upload_file()
    {
        $response_Arr = [];

        $fileids_FilesArr = $this->input->file('fileids_FilesArr');
        foreach($fileids_FilesArr['name'] as $key => $value)
        {
            if(!empty($value))
            {
                $file_FileObj = new FileObj();
                $file_FileObj->construct(array(
                    'filefile_FileArr' => getfile_from_files(array(
                        'files_Arr' => $fileids_FilesArr,
                        'key_Str' => $key
                    )),
                    // 'thumb_Str' => 'w50h50,w300h300,w600h600'
                ));
                $file_upload_Return = $file_FileObj->upload();
                if( $file_upload_Return === TRUE )
                {
                    $file_Arr[] = $file_FileObj;
                }
                else if ( $file_upload_Return === FALSE)
                {
                    $response_Arr['status'] = 'false';
                    $response_Arr['error_message'] = '未知的錯誤';
                    echo json_encode($response_Arr);
                    return TRUE;
                }
                else
                {
                    $response_Arr['status'] = 'false';
                    $response_Arr['error_message'] = $file_upload_Return;
                    echo json_encode($response_Arr);
                    return TRUE;
                }
            }
        }
        $response_Arr['status'] = 'true';
        $response_Arr['error_message'] = '上傳成功';
        $response_Arr['file_Arr'] = $file_Arr;
        echo json_encode($response_Arr);
        return TRUE;
    }
    
    public function delete_file($do, $fileid = 0)
    {
        global $admin;
        $data = $this->common_model->data;
        $child_name = 'postfile';//管理分類類別名稱
        
        if( !empty($fileid) )
        {
            $FileObj = new FileObj();
            $FileObj->construct(array('fileid_Num' => $fileid));
            $FileObj->delete();
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
}

?>