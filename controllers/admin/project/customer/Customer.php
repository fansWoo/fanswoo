<?php

class Customer_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('AdminModel');
        $this->AdminModel->construct(['data' => $this->data, 'file' => __FILE__ ]);
    }

    public function edit()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
            
        $customerid = $this->input->get('customerid');

        $data['Customer'] = new Customer([
            'db_where_arr' => [
                'customerid' => $customerid
            ]
        ]);
        

        $data['UserList'] = new ObjList([
            'db_where_deletenull_bln' => TRUE,
            'obj_class' => 'User',
            'limitstart' => 0,
            'limitcount' => 100
        ]);

        $data['WorktaskClassMetaList'] = new ObjList([
            'db_where_arr' => [
                'modelname' => 'worktask'
            ],
            'obj_class' => 'ClassMeta',
            'limitstart' => 0,
            'limitcount' => 100
        ]);

        $data['ProjectList']=new ObjList([
            'db_where_arr' => [
            	 
            ],
            'db_where_deletenull_bln' => TRUE,
            'obj_class' => 'Project',
            'limitstart' => 0,
            'limitcount' => 100
        ]);
        
        $Project = new Project([
            'db_where_arr' => [
            	 'projectid'=>$data['Worktask']->projectid
            ],
            'db_where_deletenull_bln' => TRUE,
            'obj_class' => 'Project',
            'limitstart' => 0,
            'limitcount' => 100
        ]);
        $data['admin_uids_arr']=$Project->admin_uids_UserList->uniqueids_arr;
        
        
        
        $data['uid']=$this->session->userdata('uid');

        $data['global']['js'][] = 'tool/ckeditor/ckeditor.js';
        $data['global']['js'][] = 'tool/jquery-ui-timepicker-addon/script.js';
        $data['global']['js'][] = 'tool/jquery-ui-timepicker-addon/style.css';

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url'], $data);
    }

    public function edit_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        //基本post欄位
        $customerid = $this->input->post('customerid', TRUE);
        $cutomer_name = $this->input->post('cutomer_name', TRUE, '任務名稱', 'required');
        $company = $this->input->post('company', TRUE, '公司名稱', 'required');
        $phone = $this->input->post('phone', TRUE, '手機號碼', 'required');
        $tel = $this->input->post('tel', TRUE, '公司電話', 'required');
        $email = $this->input->post('email', TRUE, '電子郵件', 'required|valid_email');
        $address = $this->input->post('address', TRUE, '公司地址', 'required');
        $wish=$this->input->post('wish','意願',TRUE);
        $budget_range = $this->input->post('budget_range', TRUE, '預算', 'required');
        $content = $this->input->post('content', FALSE, '任務內容');
        $contact_time = $this->input->post('contact_time', TRUE, '最後聯繫時間');
        $post_from = $this->input->post('post_from', TRUE);
        if( !$this->form_validation->check() ) return FALSE;
        
        
        if(!empty($worktaskid)){
        	$old_Worktask = new Worktask([
        			'db_where_arr' => [
        					'worktaskid' => $worktaskid
        			]
        	]);
        }
        
        $work_status = is_numeric($work_status) ? $work_status : 2;
        
        //建構Worktask物件，並且更新
        $Worktask = new Worktask([
            'customerid' => $customerid,
            'cutomer_name' => $cutomer_name,
            'company' => $company,
            'phone' => $phone,
        	'tel'=>$tel,
            'email' => $email,
            'address' => $address, 
            'wish' => $wish,
            'budget_range' => $budget_range,
            'end_time' => $end_time,
            'content' => $content,
            'contact_time' => $contact_time,
        ]);
        
        $Project = new Project([
        		'db_where_arr' => [
        				'customerid'=>$Customer->customerid
        		],
        		'db_where_deletenull_bln' => TRUE,
        		'obj_class' => 'Project',
        		'limitstart' => 0,
        		'limitcount' => 100
        ]);
        
        
        $login_uid=$this->session->userdata('uid');

        //只有管理員即被分派者可以修改此張工作單
        if(!in_array($login_uid, $Project->admin_uids_UserList->uniqueids_arr) && $login_uid != $Worktask->uid_User->uid){
        	//送出成功訊息
        	$this->load->model('Message');
        	$this->Message->show([
        			'message' => '您沒有權限修改此工作單',
        			'url' => 'admin/project/worktask/worktask/edit/?worktaskid='.$worktaskid
        	]);
        	return TRUE;
        }
        
              
        $Worktask->count_use_time($this_use_hour);
        $Worktask->update();
        

        if( $post_from == 'calendar')
        {
            //送出成功訊息
            $this->load->model('Message');
            $this->Message->show([
                'message' => '設定成功',
                'response' => [
                    'customerid' => $Worktask->customerid,
                    'content' => $Worktask->content_Html,
                    
                    
                    'classids' => $Worktask->class_ClassMetaList->obj_arr[0]->classid,
                	'current_percent'=>$Worktask->current_percent,
                    'use_hour' => $Worktask->use_hour,
                    'estimate_hour' => $Worktask->estimate_hour,
                ]
            ]);
            return TRUE;
        }
        else
        {
            //送出成功訊息
            $this->load->model('Message');
            $this->Message->show([
                'message' => '設定成功',
                'url' => 'admin/project/worktask/worktask/tablelist/'
            ]);
            return TRUE;
        }
    }

    public function tablelist()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $data['search_worktaskid'] = $this->input->get('worktaskid');
        $data['search_title'] = $this->input->get('title');
        $data['search_projectid'] = $this->input->get('projectid');
        $data['search_pemission_uid'] = $this->input->get('pemission_uid');
        $data['search_work_status'] = $this->input->get('work_status');
        $data['search_class_slug'] = $this->input->get('class_slug');

        $limitstart = $this->input->get('limitstart');
        $limitcount = $this->input->get('limitcount');
        $limitcount = !empty($limitcount) ? $limitcount : 20;

        $class_ClassMeta = new ClassMeta([
            'db_where_arr' => [
                'slug' => $data['search_class_slug']
            ]
        ]);

        $data['WorktaskList'] = new ObjList([
            'db_where_arr' => [
                'worktaskid' => $data['search_worktaskid'],
                'title like' => $data['search_title'],
            	'uid'=>$data['search_pemission_uid'],
            	'projectid'=>$data['search_projectid'],
            	'work_status'=> $data['search_work_status'],
                'classids' => $class_ClassMeta->classid
            ],
            'db_orderby_arr' => [
                'prioritynum' => 'DESC',
            ],
            'db_where_deletenull_bln' => TRUE,
            'obj_class' => 'Worktask',
            'limitstart' => $limitstart,
            'limitcount' => $limitcount
        ]);

		
        $permission_arr=[];
        foreach($data['WorktaskList']->obj_arr as $key=>$value_Worktask){
        	$permission_arr[$value_Worktask->uid_User->uid]=$value_Worktask->uid_User->username;      	
        };
        $data['permission_arr']=$permission_arr;
              
        $data['ProjectList'] = new ObjList([
        		'db_where_arr' => [
					'status'=> 1
        		],
        		'db_where_deletenull_bln' => TRUE,
        		'obj_class' => 'Project',
        		'limitstart' => 0,
        		'limitcount' => 100
        ]);
        
        $data['page_link'] = $data['WorktaskList']->create_links(['base_url' => 'admin/'.$data['child1_name'].'/'.$data['child2_name'].'/'.$data['child3_name'].'/'.$data['child4_name']]);
        
        
        $data['WorktaskClassMetaList'] = new ObjList([
            'db_where_arr' => [
                'modelname' => 'worktask'
            ],
            'obj_class' => 'ClassMeta',
            'limitstart' => 0,
            'limitcount' => 100
        ]);

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url'], $data);

    }

    public function tablelist_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $search_worktaskid = $this->input->post('search_worktaskid', TRUE);
        $search_projectid = $this->input->post('search_projectid', TRUE);
        $search_pemission_uid = $this->input->post('search_pemission_uid', TRUE);
        $search_work_status = $this->input->post('search_work_status', TRUE);
        $search_class_slug = $this->input->post('search_class_slug', TRUE);
        $search_title = $this->input->post('search_title', TRUE);

        $url = 'admin/project/worktask/worktask/tablelist/?';

        if(!empty($search_worktaskid))
        {
            $url = $url.'&worktaskid='.$search_worktaskid;
        }
        
        if(!empty($search_projectid))
        {
        	$url = $url.'&projectid='.$search_projectid;
        }
        
        if(!empty($search_pemission_uid))
        {
        	$url = $url.'&pemission_uid='.$search_pemission_uid;
        }

        if(!empty($search_class_slug))
        {
            $url = $url.'&class_slug='.$search_class_slug;
        }
        
        if(!empty($search_work_status))
        {
        	$url = $url.'&work_status='.$search_work_status;
        }

        if(!empty($search_title))
        {
            $url = $url.'&title='.$search_title;
        }

        
        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '資料存取中...',
            'url' => $url
        ]);
    }

    public function calendar()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $data['WorktaskClassMetaList'] = new ObjList([
            'db_where_arr' => [
                'modelname' => 'worktask'
            ],
            'obj_class' => 'ClassMeta',
            'limitstart' => 0,
            'limitcount' => 100
        ]);

        $data['ProjectList'] = new ObjList([
            'db_where_arr' => [
                [
                    'uid' => $data['User']->uid
                ],
                [
                    'admin_uids find' => $data['User']->uid
                ],
                [
                    'permission_uids find' => $data['User']->uid
                ]
            ],
            'db_where_deletenull_bln' => TRUE,
            'obj_class' => 'Project',
            'limitstart' => 0,
            'limitcount' => 100
        ]);

        $admin_ProjectList = new ObjList([
            'db_where_arr' => [
                [
                    'uid' => $data['User']->uid
                ],
                [
                    'admin_uids find' => $data['User']->uid
                ]
            ],
            'db_where_deletenull_bln' => TRUE,
            'obj_class' => 'Project',
            'limitstart' => 0,
            'limitcount' => 100
        ]);

        $permission_uid_arr = [];
        foreach($admin_ProjectList->obj_arr as $key => $value_Project)
        {
            foreach($value_Project->admin_uids_UserList->obj_arr as $key2 => $value_User)
            {
                $permission_uid_arr[] = $value_User->uid;
            }
            foreach($value_Project->permission_uids_UserList->obj_arr as $key2 => $value_User)
            {
                $permission_uid_arr[] = $value_User->uid;
            }
        }
        $permission_uid_arr[] = $data['User']->uid;

        $data['UserList'] = new ObjList([
            'db_where_arr' => [
                'uid in' => $permission_uid_arr
            ],
            'db_where_deletenull_bln' => TRUE,
            'obj_class' => 'User',
            'limitstart' => 0,
            'limitcount' => 100
        ]);

        
        
        //global
        $data['global']['js'][] = 'tool/ckeditor/ckeditor.js';
        $data['global']['js'][] = 'tool/jquery-ui-timepicker-addon/script.js';
        $data['global']['js'][] = 'tool/jquery-ui-timepicker-addon/zh-tw.js';
        $data['global']['js'][] = 'tool/jquery-ui-timepicker-addon/style.css';
        $data['global']['js'][] = 'tool/fullcalendar/moment.min.js';
        $data['global']['js'][] = 'tool/fullcalendar/fullcalendar.min.js';
        $data['global']['js'][] = 'tool/fullcalendar/gcal.js';
        $data['global']['js'][] = 'admin/project/worktask/worktask/calendar.js';

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url'], $data);

    }

    public function worktask_list_json()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $uid = $this->input->get('uid');
        $projectid = $this->input->get('projectid');
        $datetime = $this->input->get('datetime');

        $permission_uid_arr = [];
        if( empty( $uid ) )
        {
            $admin_ProjectList = new ObjList([
                'db_where_arr' => [
                    [
                        'uid' => $data['User']->uid
                    ],
                    [
                        'admin_uids find' => $data['User']->uid
                    ]
                ],
                'db_where_deletenull_bln' => TRUE,
                'obj_class' => 'Project',
                'limitstart' => 0,
                'limitcount' => 100
            ]);

            foreach($admin_ProjectList->obj_arr as $key => $value_Project)
            {
                foreach($value_Project->admin_uids_UserList->obj_arr as $key2 => $value_User)
                {
                    $permission_uid_arr[] = $value_User->uid;
                }
                foreach($value_Project->permission_uids_UserList->obj_arr as $key2 => $value_User)
                {
                    $permission_uid_arr[] = $value_User->uid;
                }
            }

            $permission_uid_arr[] = $data['User']->uid;
        }
        else
        {
            // 如果指定的 uid 不可以觀看權限
            // echo '這個帳號沒有觀察這個 uid 的權限';
            // exit;

            $permission_uid_arr = [$uid];
        }

        $projectid_arr = [];
        if( empty( $projectid ) )
        {

            $ProjectList = new ObjList([
                'db_where_arr' => [
                    [
                        'uid' => $data['User']->uid
                    ],
                    [
                        'admin_uids find' => $data['User']->uid
                    ],
                    [
                        'permission_uids find' => $data['User']->uid
                    ]
                ],
                'db_where_deletenull_bln' => TRUE,
                'obj_class' => 'Project',
                'limitstart' => 0,
                'limitcount' => 100
            ]);

            foreach( $ProjectList as $key => $value_Project)
            {
                $projectid_arr[] = $value_Project->projectid;
            }
        }
        else
        {
            $projectid_arr = [$projectid];
        }

        $DateTimeObj = new DateTimeObj([
            'datetime' => $datetime
        ]);

        //撈出從時間點開始計算之上個月月初到下個月月底的資料
        $timenow_month_start = date("Y-m-d", mktime(24, 0, 0, date("m", $DateTimeObj->unix) - 1, 0, date("Y", $DateTimeObj->unix)));
        $timenow_month_end = date("Y-m-d", mktime(0, 0, 0, date("m", $DateTimeObj->unix) + 1 + 1, 0, date("Y", $DateTimeObj->unix)));

        $WorktaskList = new ObjList([
            'db_where_arr' => [
                'start_time >' => $timenow_month_start,
                'end_time <' => $timenow_month_end,
                'uid in' => $permission_uid_arr,
                'projectid in' => $projectid_arr
            ],
            'db_where_deletenull_bln' => TRUE,
            'obj_class' => 'Worktask',
            'limitstart' => 0,
            'limitcount' => 100
        ]);

        $worktask_arr = [];
        foreach( (array) $WorktaskList->obj_arr as $key => $value_Worktask )
        {
            $worktask_arr[$key]['id'] = $value_Worktask->worktaskid;
            $worktask_arr[$key]['worktaskid'] = $value_Worktask->worktaskid;
            $worktask_arr[$key]['title'] = $value_Worktask->title;
            $worktask_arr[$key]['content'] = $value_Worktask->content_Html;
            $worktask_arr[$key]['estimate_hour'] = $value_Worktask->estimate_hour;
            $worktask_arr[$key]['use_hour'] = $value_Worktask->use_hour;
            $worktask_arr[$key]['classids'] = $value_Worktask->class_ClassMetaList->obj_arr[0]->classid;
            $worktask_arr[$key]['projectid'] = $value_Worktask->projectid;
            $worktask_arr[$key]['uid'] = $value_Worktask->uid_User->uid;
            $worktask_arr[$key]['current_percent'] = $value_Worktask->current_percent;
            $worktask_arr[$key]['start_time'] = date("Y-m-d h:i:s", strtotime( $value_Worktask->start_time_DateTime->inputtime_date ) );
            $worktask_arr[$key]['end_time'] = date("Y-m-d h:i:s", strtotime("+1 Day", strtotime( $value_Worktask->end_time_DateTime->inputtime_date ) ) );
            $worktask_arr[$key]['start'] = date("Y-m-d", strtotime( $value_Worktask->start_time_DateTime->inputtime_date ) );
            $worktask_arr[$key]['end'] = date("Y-m-d", strtotime("+1 Day", strtotime( $value_Worktask->end_time_DateTime->inputtime_date ) ) );
            $worktask_arr[$key]['work_status'] = $value_Worktask->work_status;
            if( $value_Worktask->work_status == 0)
            {
                $worktask_arr[$key]['color'] = '#F691B2';
                $worktask_arr[$key]['textColor'] = 'black';
            }
            else if( $value_Worktask->work_status == 1)
            {
                $worktask_arr[$key]['color'] = '#dcf1db';
                $worktask_arr[$key]['textColor'] = 'black';
            }
            else if( $value_Worktask->work_status == 2)
            {
                $worktask_arr[$key]['color'] = '#F5F5F5';
                $worktask_arr[$key]['textColor'] = '#AAA';
            }
        }

        // ec($uid, $projectid, $worktask_arr);
        $worktask_json = json_encode( $worktask_arr );
        echo $worktask_json;
    }

    public function delete()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $url = FALSE;
        $dont_change_page = $this->input->get('dont_change_page');
        if( empty( $dont_change_page ) )
        {
            $url = 'admin/base/worktask/worktask/tablelist';
        }

        //CSRF過濾
        if( $this->input->get('hash') == $this->security->get_csrf_hash() )
        {
            $worktask = new worktask([
                'worktaskid' => $this->input->get('worktaskid')
            ]);
            $worktask->delete();

            $this->load->model('Message');
            $this->Message->show([
                'message' => '刪除成功',
                'url' => $url
            ]);
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => $url
            ]);
        }
    }

    public function delete_batch_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
        
        $worktaskid_arr = $this->input->post('worktaskid_arr[]');

        if( empty($worktaskid_arr) )
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => '未選擇要刪除的常見問題'
            ]);
            return TRUE;
        }

        //CSRF過濾
        if($this->input->get('hash') == $this->security->get_csrf_hash())
        {
            if(!empty($worktaskid_arr))
            {
                foreach($worktaskid_arr as $key => $worktaskid)
                {
                    $worktask = new worktask([
                        'worktaskid' => $worktaskid
                    ]);
                    $worktask->delete();
                }
            }

            $this->load->model('Message');
            $this->Message->show([
                'message' => '刪除成功',
                'url' => 'admin/base/worktask/worktask/tablelist'
            ]);
            return TRUE;
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/base/worktask/worktask/tablelist'
            ]);
            return TRUE;
        }
    }
}

?>