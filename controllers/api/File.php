<?php
        
class File_Controller extends MY_Controller {

    public function upload_file()
    {
        $response_arr = [];

        $fileids_FilesArr = $this->input->file('fileids_FilesArr');
        foreach($fileids_FilesArr['name'] as $key => $value)
        {
            if(!empty($value))
            {
                $file_FileObj = new FileObj();
                $file_FileObj->construct(array(
                    'filefile_FileArr' => getfile_from_files(array(
                        'files_arr' => $fileids_FilesArr,
                        'key' => $key
                    )),
                    // 'thumb' => 'w50h50,w300h300,w600h600'
                ));
                $file_upload_Return = $file_FileObj->upload();
                if( $file_upload_Return === TRUE )
                {
                    $file_arr[] = $file_FileObj;
                }
                else if ( $file_upload_Return === FALSE)
                {
                    $response_arr['status'] = 'false';
                    $response_arr['error_message'] = '未知的錯誤';
                    echo json_encode($response_arr);
                    return TRUE;
                }
                else
                {
                    $response_arr['status'] = 'false';
                    $response_arr['error_message'] = $file_upload_Return;
                    echo json_encode($response_arr);
                    return TRUE;
                }
            }
        }
        $response_arr['status'] = 'true';
        $response_arr['error_message'] = '上傳成功';
        $response_arr['file_arr'] = $file_arr;
        echo json_encode($response_arr);
        return TRUE;
    }
    
    public function delete_file($do, $fileid = 0)
    {
        $data = $this->data;
        $child_name = 'postfile';//管理分類類別名稱
        
        if( !empty($fileid) )
        {
            $FileObj = new FileObj();
            $FileObj->construct(array('fileid' => $fileid));
            $FileObj->delete();
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function download_file($fileid = 0)
    {
        $data = $this->data;
        
        if( !empty($fileid) )
        {
            $FileObj = new FileObj();
            $FileObj->construct_db([
                'db_where_arr' => [
                    'fileid' => $fileid
                ]
            ]);
            
            if( empty($FileObj->fileid) )
            {
                echo '檔案不存在';
                return FALSE;
            }

            if(
                $data['User']->uid == $FileObj->uid ||
                in_array( $data['User']->uid, $FileObj->permission_uids_UserList->uniqueids_arr )
            )
            {

                $file_name = $FileObj->filename;

                $file_path = $FileObj->file_path;
                $file_size = filesize($file_path);

                header('Pragma: public');
                header('Expires: 0');
                header('Last-Modified: ' . gmdate('D, d M Y H:i ') . ' GMT');
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                header('Cache-Control: private', false);
                header('Content-Type: application/octet-stream');
                header('Content-Length: ' . $file_size);
                header('Content-Disposition: attachment; filename="' . $file_name . '";');
                header('Content-Transfer-Encoding: binary');
                readfile($file_path);

                return TRUE;

            }
            else
            {

                echo '檔案觀看權限不足';
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }
    
}

?>