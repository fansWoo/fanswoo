<?php

class Worktask_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('AdminModel');
        $this->AdminModel->construct(['data' => $this->data, 'file' => __FILE__ ]);
    }

    public function edit()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
            
        $worktaskid = $this->input->get('worktaskid');

        $data['Worktask'] = new Worktask([
            'db_where_arr' => [
                'worktaskid' => $worktaskid
            ]
        ]);

        $data['UserList'] = new ObjList([
            'db_where_deletenull_bln' => TRUE,
            'model_name' => 'User',
            'limitstart' => 0,
            'limitcount' => 100
        ]);

        $data['WorktaskClassMetaList'] = new ObjList([
            'db_where_arr' => [
                'modelname' => 'worktask'
            ],
            'model_name' => 'ClassMeta',
            'limitstart' => 0,
            'limitcount' => 100
        ]);

        $data['ProjectList'] = new ObjList([
            'db_where_arr' => [
            ],
            'db_where_deletenull_bln' => TRUE,
            'model_name' => 'Project',
            'limitstart' => 0,
            'limitcount' => 100
        ]);

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
        $worktaskid = $this->input->post('worktaskid', TRUE);
        $title = $this->input->post('title', TRUE, '任務名稱', 'required');
        $projectid = $this->input->post('projectid', TRUE, '專案名稱', 'required');
        $uid = $this->input->post('uid', TRUE, '專案執行人', 'required');
        $classids = $this->input->post('classids', TRUE, '任務分類', 'required');
        $estimate_hour = $this->input->post('estimate_hour', TRUE, '預估時數');
        $use_hour = $this->input->post('use_hour', TRUE, '耗用時數');
        $content = $this->input->post('content', FALSE, '任務內容');
        $start_time = $this->input->post('start_time', TRUE, '起始時間');
        $end_time = $this->input->post('end_time', TRUE, '結束時間');
        $prioritynum = $this->input->post('prioritynum', TRUE);
        $work_status = $this->input->post('work_status', TRUE);
        $post_from = $this->input->post('post_from', TRUE);

        if( !$this->form_validation->check() ) return FALSE;

        //建構Worktask物件，並且更新
        $Worktask = new Worktask([
            'worktaskid' => $worktaskid,
            'title' => $title,
            'projectid' => $projectid,
            'uid' => $uid,
            'classids' => $classids,
            'estimate_hour' => $estimate_hour,
            'use_hour' => $use_hour,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'content' => $content,
            'work_status' => $work_status,
            'prioritynum' => $prioritynum
        ]);
        $Worktask->update();

        if( $post_from == 'calendar')
        {
            //送出成功訊息
            $this->load->model('Message');
            $this->Message->show([
                'message' => '設定成功',
                'response' => [
                    'worktaskid' => $Worktask->worktaskid,
                    'content' => $Worktask->content_Html,
                    'projectid' => $Worktask->projectid,
                    'uid' => $Worktask->uid_User->uid,
                    'classids' => $Worktask->class_ClassMetaList->obj_arr[0]->classid,
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
                'worktaskid' => $data['search_worktaskid']
            ],
            'db_where_like_arr' => [
                'title' => $data['search_title']
            ],
            'db_where_or_arr' => [
                'classid' => [$class_ClassMeta->classid]
            ],
            'db_orderby_arr' => [
                'prioritynum' => 'DESC',
            ],
            'db_where_deletenull_bln' => TRUE,
            'model_name' => 'Worktask',
            'limitstart' => $limitstart,
            'limitcount' => $limitcount
        ]);
        $data['page_link'] = $data['WorktaskList']->create_links(['base_url' => 'admin/'.$data['child1_name'].'/'.$data['child2_name'].'/'.$data['child3_name'].'/'.$data['child4_name']]);

        $data['WorktaskClassMetaList'] = new ObjList([
            'db_where_arr' => [
                'modelname' => 'worktask'
            ],
            'model_name' => 'ClassMeta',
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
        $search_class_slug = $this->input->post('search_class_slug', TRUE);
        $search_title = $this->input->post('search_title', TRUE);

        $url = 'admin/base/worktask/worktask/tablelist/?';

        if(!empty($search_worktaskid))
        {
            $url = $url.'&worktaskid='.$search_worktaskid;
        }

        if(!empty($search_class_slug))
        {
            $url = $url.'&class_slug='.$search_class_slug;
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
            'model_name' => 'ClassMeta',
            'limitstart' => 0,
            'limitcount' => 100
        ]);

        $data['ProjectList'] = new ObjList([
            'db_where_or_arr' => [
                'uid' => [$data['User']->uid],
                'admin_uids' => [$data['User']->uid],
                'permission_uids' => [$data['User']->uid]
            ],
            'db_where_deletenull_bln' => TRUE,
            'model_name' => 'Project',
            'limitstart' => 0,
            'limitcount' => 100
        ]);

        $admin_ProjectList = new ObjList([
            'db_where_or_arr' => [
                'uid' => [$data['User']->uid],
                'admin_uids' => [$data['User']->uid]
            ],
            'db_where_deletenull_bln' => TRUE,
            'model_name' => 'Project',
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
            'db_where_or_arr' => [
                'uid' => $permission_uid_arr
            ],
            'db_where_deletenull_bln' => TRUE,
            'model_name' => 'User',
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
                'db_where_or_arr' => [
                    'uid' => [$data['User']->uid],
                    'admin_uids' => [$data['User']->uid]
                ],
                'db_where_deletenull_bln' => TRUE,
                'model_name' => 'Project',
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
                'db_where_or_arr' => [
                    'uid' => [$data['User']->uid],
                    'admin_uids' => [$data['User']->uid],
                    'permission_uids' => [$data['User']->uid]
                ],
                'db_where_deletenull_bln' => TRUE,
                'model_name' => 'Project',
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
                'uid' => $permission_uid_arr,
                'projectid' => $permission_uid_arr
            ],
            'db_where_deletenull_bln' => TRUE,
            'model_name' => 'Worktask',
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

        ec($worktask_arr);
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