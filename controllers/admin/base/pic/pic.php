<?php

class Pic_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $data = $this->data;

        $data['usergroupid_UserGroup'] = $data['User']->group_UserGroupList->obj_arr[0]->groupid;
        
        $this->data = $data;

        $this->load->model('AdminModel');
        $this->AdminModel->construct(['data' => $this->data, 'file' => __FILE__ ]);
    }
	
	public function edit()
	{
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $picid = $this->input->get('picid');
            
        $data['PicObj'] = new PicObj([
        	'db_where_arr' => [
        		'picid' => $picid
        	]
        ]);

        if($data['usergroupid_UserGroup'] >= 100)
        {   
            $data['ClassMetaList'] = new ObjList([
                'db_where_arr' => [
                    'uid' => $data['User']->uid,
                    'modelname' => 'pic'
                ],
                'model_name' => 'ClassMeta',
                'limitstart' => 0,
                'limitcount' => 100
            ]);
        }
        else
        {
            $data['ClassMetaList'] = new ObjList([
                'db_where_arr' => [
                    'modelname' => 'pic'
                ],
                'model_name' => 'ClassMeta',
                'limitstart' => 0,
                'limitcount' => 100
            ]);
        }
            
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

        $picids_arr = $this->input->post('picids_arr');
		$picid = $this->input->post('picid');
        $classids_arr = $this->input->post('classids_arr');

		if(!empty($picid))
		{
		    $PicObj = new PicObj([
		    	'db_where_arr' => [
		        	'picid' => $picid
		        ]
		    ]);
            $PicObj->class_ClassMetaList = new ObjList();
            $PicObj->class_ClassMetaList->construct_db([
                'db_where_or_arr' => [
                    'classid' => $classids_arr
                ],
                'db_from' => 'class',
                'model_name' => 'ClassMeta',
                'limitstart' => 0,
                'limitcount' => 100
            ]);
            $PicObj->updatetime_DateTime = new DateTimeObj();
		    $PicObj->updatetime_DateTime->construct();
            if(!empty($classids_arr[0]))
            {
                $PicObj->upload_status = 1;
            }
            else
            {
                $PicObj->upload_status = 2;
            }
		    $PicObj->update();

            if( !empty($comment_content) )
            {
                $Comment = new Comment([
                    'uid' => $data['User']->uid,
                    'typename' => 'pic',
                    'id' => $PicObj->picid,
                    'content' => $comment_content
                ]);
                $Comment->update();
            }

			$this->load->model('Message');
			$this->Message->show([
			    'message' => '設定成功',
			    'url' => 'admin/base/pic/pic/tablelist'
			]);
		}
		else if( !empty($picids_arr) )
		{
		    $PicObjList = new ObjList;
            $PicObjList->construct_db([
                'db_where_or_arr' => [
                    'picid' => $picids_arr
                ],
                'model_name' => 'PicObj',
                'db_orderby_arr' => [
                    ['prioritynum', 'DESC'],
                    ['updatetime', 'DESC']
                ],
                'limitstart' => 0,
                'limitcount' => 100
            ]);

            if(!empty($classids_arr))
            {
                foreach($PicObjList->obj_arr as $key => $value_PicObj)
                {
                    $value_PicObj->set('class_ClassMetaList', [
                        'classids_arr' => $classids_arr
                    ], 'ClassMetaList');
                    // $value_PicObj->upload_status = 1;
                    $value_PicObj->update();
                }
            }

            $this->load->model('Message');
            $this->Message->show([
                'message' => '設定成功',
                'url' => 'admin/base/pic/pic/tablelist'
            ]);
		}
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => '未知的錯誤',
                'url' => 'admin/base/pic/pic/tablelist'
            ]);
        }

	}
	
	public function tablelist()
	{
        $data = $this->AdminModel->get_data(__FUNCTION__);

		$limitstart = $this->input->get('limitstart');
        $limitcount = $this->input->get('limitcount');
        $limitcount = !empty($limitcount) ? $limitcount : 30;

        $data['search_class_slug'] = $this->input->get('class_slug');
        $data['search_title'] = $this->input->get('title');
        $data['search_picid'] = $this->input->get('picid');
        $data['search_uid'] = $this->input->get('uid');

        $class_ClassMeta = new ClassMeta([
            'db_where_arr' => [
                'slug' => $data['search_class_slug']
            ],
            'db_where_deletenull_bln' => FALSE
        ]);

        $construct_arr = [
            'db_where_arr' => [
                'picid' => $data['search_picid'],
                'upload_status !=' => 3
            ],
            'db_where_like_arr' => [
                'title' => $data['search_title']
            ],
            'db_where_or_arr' => [
                'classids' => [$class_ClassMeta->classid]
            ],
            'db_where_deletenull_bln' => TRUE,
            'model_name' => 'PicObj',
            'db_orderby_arr' => [
                'prioritynum' => 'DESC',
                'updatetime' => 'DESC'
            ],
            'limitstart' => $limitstart,
            'limitcount' => $limitcount
        ];

        //搜尋upload_status=2的待分類圖片
        if( $data['search_class_slug'] == 'unclassified' )
        {
            $construct_arr['db_where_arr']['upload_status'] = 2;
        }
        //搜尋upload_status=3的隱藏圖片
        else if( $data['search_class_slug'] == 'hidden' )
        {
            $construct_arr['db_where_arr']['upload_status'] = 3;
        }

        if($data['usergroupid_UserGroup'] >= 100)
        {
            $construct_arr['db_where_arr']['uid'] = $data['User']->uid;
        }
        else
        {
            $construct_arr['db_where_arr']['uid'] = $data['search_uid'];
        }

        $data['piclist_PicList'] = new ObjList($construct_arr);
        $data['pic_links'] = $data['piclist_PicList']->create_links(['base_url' => "admin/base/pic/pic/tablelist/?class_slug=$data[search_class_slug]"]);

        if($data['usergroupid_UserGroup'] >= 100)
        {
            $data['pic_ClassMetaList'] = new ObjList([
                'db_where_arr' => [
                    'uid' => $data['User']->uid,
                    'modelname' => 'pic'
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
        }
        else
        {
            $data['pic_ClassMetaList'] = new ObjList([
                'db_where_arr' => [
                    'modelname' => 'pic',
                    'uid' => $data['search_uid']
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
        }
            
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

        $search_picid = $this->input->post('search_picid', TRUE);
        $search_title = $this->input->post('search_title', TRUE);
        $search_class_slug = $this->input->post('search_class_slug', TRUE);
        $search_uid = $this->input->post('search_uid', TRUE);

        $url = 'admin/base/pic/pic/tablelist/?';

        if(!empty($search_picid))
        {
            $url = $url.'&picid='.$search_picid;
        }

        if(!empty($search_title))
        {
            $url = $url.'&title='.$search_title;
        }

        if(!empty($search_class_slug))
        {
            $url = $url.'&class_slug='.$search_class_slug;
        }

        if(!empty($search_uid))
        {
            $url = $url.'&uid='.$search_uid;
        }
        
        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '設定成功',
            'url' => $url
        ]);
    }

    public function delete()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        //CSRF過濾
        if( $this->input->get('hash') == $this->security->get_csrf_hash() )
        {
            $PicObj = new PicObj([
                'picid' => $this->input->get('picid')
            ]);
            $PicObj->delete();

            $this->load->model('Message');
            $this->Message->show([
                'message' => '刪除成功',
                'url' => 'admin/base/pic/pic/tablelist'
            ]);
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/base/pic/pic/tablelist'
            ]);
        }
    }

    public function delete_batch_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
        
        $picid_arr = $this->input->post('picid_arr[]');

        //CSRF過濾
        if( $this->input->get('hash') == $this->security->get_csrf_hash() )
        {
            if(!empty($picid_arr))
            {
                foreach($picid_arr as $key => $picid)
                {
                    $PicObj = new PicObj([
                        'picid' => $picid
                    ]);
                    $PicObj->delete();
                }
            }
            else
            {
                $this->load->model('Message');
                $this->Message->show([
                    'message' => '未選擇要刪除的圖片'
                ]);
                return TRUE;
            }

            $this->load->model('Message');
            $this->Message->show([
                'message' => '刪除成功',
                'url' => 'admin/base/pic/pic/tablelist'
            ]);
            return TRUE;
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/base/pic/pic/tablelist'
            ]);
            return TRUE;
        }
    }
}

?>