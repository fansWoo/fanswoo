<?php

class File_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('AdminModel');
        $this->AdminModel->construct(['data' => $this->data, 'file' => __FILE__ ]);
    }
	
	public function edit()
	{
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $fileid = $this->input->get('fileid');
            
        $data['FileObj'] = new FileObj([
        	'db_where_arr' => [
        		'fileid' => $fileid
        	]
        ]);
            
        $data['ClassMetaList'] = new ObjList([
        	'db_where_arr' => [
        		'uid' => $data['User']->uid,
        		'modelname' => 'file'
        	],
            'model_name' => 'ClassMeta',
            'limitstart' => 0,
            'limitcount' => 100
        ]);
            
        //temp
        $data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
        $data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['admin_header_bar'] = $this->load->view('admin/temp/admin_header_bar', $data, TRUE);
        $data['temp']['admin_footer_bar'] = $this->load->view('admin/temp/admin_footer_bar', $data, TRUE);
        $data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url'], $data);
	}

	public function edit_post()
	{
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $fileids_arr = $this->input->post('fileids_arr');
		$fileid = $this->input->post('fileid');
        $classids_arr = $this->input->post('classids_arr');
        $permission_emails = $this->input->post('permission_emails');

		if(!empty($fileid))
		{
		    $FileObj = new FileObj([
		    	'db_where_arr' => [
		        	'fileid' => $fileid,
		        ]
		    ]);

            $FileObj->set__permission_uids_UserList(['permission_emails' => $permission_emails]);

            $FileObj->class_ClassMetaList = new ObjList();
            $FileObj->class_ClassMetaList->construct_db([
                'db_where_or_arr' => [
                    'classid' => $classids_arr
                ],
                'db_from' => 'class',
                'model_name' => 'ClassMeta',
                'limitstart' => 0,
                'limitcount' => 100
            ]);
            $FileObj->updatetime_DateTime = new DateTimeObj();
		    $FileObj->updatetime_DateTime->construct();
		    $FileObj->update();

            $this->load->model('Message');
            $this->Message->show([
                'message' => '設定成功',
                'url' => 'admin/base/file/file/tablelist'
            ]);
		}
		else if( !empty($fileids_arr) )
		{
            $FileObjList = new ObjList;
            $FileObjList->construct_db([
                'db_where_or_arr' => [
                    'fileid' => $fileids_arr
                ],
                'db_orderby_arr' => [
                    'prioritynum' => 'DESC',
                    'updatetime' => 'DESC'
                ],
                'model_name' => 'FileObj',
                'limitstart' => 0,
                'limitcount' => 100
            ]);

            foreach($FileObjList->obj_arr as $key => $value_FileObj)
            {
                $value_FileObj->set('class_ClassMetaList', [
                    'classids_arr' => $classids_arr
                ], 'ClassMetaList');
                $value_FileObj->set__permission_uids_UserList(['permission_emails' => $permission_emails]);
                $value_FileObj->update();
            }

            $this->load->model('Message');
            $this->Message->show([
                'message' => '設定成功',
                'url' => 'admin/base/file/file/tablelist'
            ]);
		}
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => '未知的錯誤',
                'url' => 'admin/base/file/file/tablelist'
            ]);
        }

	}
	
	public function tablelist()
	{
        $data = $this->AdminModel->get_data(__FUNCTION__);

		$limitstart = $this->input->get('limitstart');
        $limitcount = $this->input->get('limitcount');
        $limitcount = !empty($limitcount) ? $limitcount : 20;

        $data['search_class_slug'] = $this->input->get('class_slug');
        $data['search_title'] = $this->input->get('title');
        $data['search_fileid'] = $this->input->get('fileid');

        $class_ClassMeta = new ClassMeta([
            'db_where_arr' => [
                'uid' => $data['User']->uid,
                'slug' => $data['search_class_slug']
            ],
            'db_where_deletenull_bln' => FALSE
        ]);

        $data['filelist_FileList'] = new ObjList([
            'db_where_arr' => [
                'fileid' => $data['search_fileid'],
                'uid' => $data['User']->uid,
            ],
            'db_where_like_arr' => [
                'title' => $data['search_title']
            ],
            'db_where_or_arr' => [
                'classids' => [$class_ClassMeta->classid]
            ],
            'db_where_deletenull_bln' => TRUE,
            'model_name' => 'FileObj',
            'db_orderby_arr' => [
                'prioritynum' => 'DESC',
                'updatetime' => 'DESC'
            ],
            'limitstart' => $limitstart,
            'limitcount' => $limitcount
      	]);
        $data['file_links'] = $data['filelist_FileList']->create_links(['base_url' => "admin/base/file/file/tablelist/?class_slug=$data[search_class_slug]"]);

        $data['file_ClassMetaList'] =  new ObjList([
            'db_where_arr' => [
                'uid' => $data['User']->uid,
                'modelname' => 'file'
            ],
            'db_where_deletenull_bln' => TRUE,
            'model_name' => 'ClassMeta',
            'db_orderby_arr' => [
                'prioritynum' => 'DESC',
                'updatetime' => 'DESC'
            ],
            'limitstart' => 0,
            'limitcount' => 100
        ]);
            
        //temp
        $data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
        $data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['admin_header_bar'] = $this->load->view('admin/temp/admin_header_bar', $data, TRUE);
        $data['temp']['admin_footer_bar'] = $this->load->view('admin/temp/admin_footer_bar', $data, TRUE);
        $data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url'], $data);
	}

    public function tablelist_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $search_fileid = $this->input->post('search_fileid', TRUE);
        $search_title = $this->input->post('search_title', TRUE);
        $search_class_slug = $this->input->post('search_class_slug', TRUE);

        $url = 'admin/base/file/file/tablelist/?';

        if(!empty($search_fileid))
        {
            $url = $url.'&fileid='.$search_fileid;
        }

        if(!empty($search_title))
        {
            $url = $url.'&title='.$search_title;
        }

        if(!empty($search_class_slug))
        {
            $url = $url.'&class_slug='.$search_class_slug;
        }

        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '資料存取中...',
            'url' => $url
        ]);
    }

    public function delete()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        //CSRF過濾
        if( $this->input->get('hash') == $this->security->get_csrf_hash() )
        {
            $FileObj = new FileObj([
                'fileid' => $this->input->get('fileid')
            ]);
            $FileObj->delete();

            $this->load->model('Message');
            $this->Message->show([
                'message' => '刪除成功',
                'url' => 'admin/base/file/file/tablelist'
            ]);
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/base/file/file/tablelist'
            ]);
        }
    }

    public function delete_batch_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
        
        $fileid_arr = $this->input->post('fileid_arr[]');

        //CSRF過濾
        if($this->input->get('hash') == $this->security->get_csrf_hash())
        {
            if(!empty($fileid_arr))
            {
                foreach($fileid_arr as $key => $fileid)
                {
                    $FileObj = new FileObj([
                        'fileid' => $fileid
                    ]);
                    $FileObj->delete();
                }
            }
            else
            {
                $this->load->model('Message');
                $this->Message->show([
                    'message' => '未選擇要刪除的常見問題'
                ]);
                return TRUE;
            }

            $this->load->model('Message');
            $this->Message->show([
                'message' => '刪除成功',
                'url' => 'admin/base/file/file/tablelist'
            ]);
            return TRUE;
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/base/file/file/tablelist'
            ]);
            return TRUE;
        }
    }
}

?>