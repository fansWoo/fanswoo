<?php

class Project_Controller extends MY_Controller {

    protected $child1_name_Str = 'project';
    protected $child2_name_Str = 'project';
    protected $child3_name_Str = 'project';

    public function __construct()
    {
        parent::__construct();
        $data = $this->data;

        $this->load->model('AdminModel');
        $this->AdminModel->child1_name_Str = $this->child1_name_Str;
        $this->AdminModel->child2_name_Str = $this->child2_name_Str;
        $this->AdminModel->child3_name_Str = $this->child3_name_Str;

        if($data['User']->uid_Num == '')
        {
            $url = base_url('user/login/?url=admin');
            header('Location: '.$url);
        }

        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function edit()
    {
        $data = $this->data;//取得公用數據
        $data = array_merge($data, $this->AdminModel->get_data(array(
            'child4_name_Str' => 'edit'//管理分類名稱
        )));
            
        $data['projectid_Num'] = $this->input->get('projectid');

        $data['Project'] = new Project();
        $data['Project']->construct_db(array(
            'db_where_Arr' => array(
                'projectid' => $data['projectid_Num']
            )
        ));

        $data['ProjectClassMetaList'] = new ObjList();
        $data['ProjectClassMetaList']->construct_db(array(
            'db_where_Arr' => array(
                'modelname' => 'project'
            ),
            'model_name_Str' => 'ClassMeta',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));

        $data['class2_ClassMetaList'] = new ObjList();
        $data['class2_ClassMetaList']->construct_db(array(
            'db_where_Arr' => array(
                'modelname_Str' => 'project_class2'
            ),
            'model_name_Str' => 'ClassMeta',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));

        $data['ProjectDesignList'] = new ObjList();
        $data['ProjectDesignList']->construct_db(array(
            'db_orderby_Arr' => array(
                array('updatetime', 'DESC')
            ),
            'db_where_deletenull_Bln' => TRUE,
            'model_name_Str' => 'Design',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));

        $data['project_designids_Arr'] = explode(",", trim($data['Project']->designids_Str));

        $data['DesignPriceList'] = new ObjList();
        $data['DesignPriceList']->construct_db(array(
            'db_where_or_Arr' => array(
                'designid' => $data['project_designids_Arr']
            ),
            'db_orderby_Arr' => array(
                array('updatetime', 'DESC')
            ),
            'db_where_deletenull_Bln' => TRUE,
            'model_name_Str' => 'Design',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));

        $data['SuggestList'] = new ObjList();
        $data['SuggestList']->construct_db(array(
            'db_where_Arr' => array(
                'projectid_Num' => $data['projectid_Num']
            ),
            'db_orderby_Arr' => array(
                array('suggestid', 'ASC')
            ),
            'db_where_deletenull_Bln' => TRUE,
            'model_name_Str' => 'Suggest',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));

        $data['admin_User'] = new User();
        $data['admin_User']->construct_db(array(
            'db_where_Arr' => array(
                'uid_Num' => $data['Project']->admin_uid_Num
            )
        ));
        
        //global
        $data['global']['style'][] = 'app/css/admin/global.css';
        $data['global']['js'][] = 'app/js/admin.js';
        $data['global']['js'][] = 'fanswoo-framework/js/jquery.form.js';

        //temp
        $data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
        $data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['admin_header_bar'] = $this->load->view('admin/temp/admin_header_bar', $data, TRUE);
        $data['temp']['admin_footer_bar'] = $this->load->view('admin/temp/admin_footer_bar', $data, TRUE);
        $data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url_Str'], $data);
    }

    public function prints()
    {
        $data = $this->data;//取得公用數據
        $data = array_merge($data, $this->AdminModel->get_data(array(
            'child4_name_Str' => 'prints'//管理分類名稱
        )));
            
        $data['projectid_Num'] = $this->input->get('projectid');

        $data['Project'] = new Project();
        $data['Project']->construct_db(array(
            'db_where_Arr' => array(
                'projectid' => $data['projectid_Num']
            )
        ));
        
        if(empty($data['Project']->projectid_Num))
        {
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '請先選擇欲列印的專案',
                'url' => 'admin/project/project/project/tablelist'
            ));
            return FALSE;
        }

        $project_permission_uids_Arr = explode(PHP_EOL, trim($data['Project']->permission_uids_UserList->uniqueids_Str));

        $data['project_User'] = new User();
        $data['project_User']->construct_db(array(
            'db_where_Arr' => array(
                'uid_Num' => $project_permission_uids_Arr[0]
            )
        ));

        $data['admin_User'] = new User();
        $data['admin_User']->construct_db(array(
            'db_where_Arr' => array(
                'uid_Num' => $data['Project']->admin_uid_Num
            )
        ));

        $data['project_designids_Arr'] = explode(",", trim($data['Project']->designids_Str));


        $data['ProjectDesignList'] = new ObjList();
        $data['ProjectDesignList']->construct_db(array(
            'db_where_or_Arr' => array(
                'designid' => $data['project_designids_Arr']
            ),
            'db_orderby_Arr' => array(
                array('updatetime', 'DESC')
            ),
            'db_where_deletenull_Bln' => TRUE,
            'model_name_Str' => 'Design',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));

        $data['SuggestList'] = new ObjList();
        $data['SuggestList']->construct_db(array(
            'db_where_Arr' => array(
                'projectid_Num' => $data['projectid_Num']
            ),
            'db_orderby_Arr' => array(
                array('suggestid', 'ASC')
            ),
            'db_where_deletenull_Bln' => TRUE,
            'model_name_Str' => 'Suggest',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));
        
        //global
        $data['global']['style'][] = 'app/css/admin/prints.css';
        $data['global']['js'][] = 'app/js/admin.js';
        $data['global']['js'][] = 'fanswoo-framework/js/jquery.form.js';

        //temp
        $data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
        $data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['admin_header_bar'] = $this->load->view('admin/temp/admin_header_bar', $data, TRUE);
        $data['temp']['admin_footer_bar'] = $this->load->view('admin/temp/admin_footer_bar', $data, TRUE);
        $data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url_Str'], $data);
    }

    public function edit_post()
    {
        $data = $this->data;//取得公用數據

        $this->form_validation->set_rules('name_Str', '專案名稱', 'required');
        
        if ($this->form_validation->run() !== FALSE)
        {
            //基本post欄位
            $projectid_Num = $this->input->post('projectid_Num', TRUE);
            $name_Str = $this->input->post('name_Str', TRUE);
            $admin_uid_Num = $this->input->post('admin_uid_Num', TRUE);
            $permission_emails_Str = $this->input->post('permission_emails_Str');
            $working_days_Num = $this->input->post('working_days_Num', TRUE);
            $classids_Arr = $this->input->post('classids_Arr', TRUE);
            $designids_Str = $this->input->post('designids_Str[]', TRUE);
            $pay_price_total_Num = $this->input->post('pay_price_total_Num', TRUE);
            $pay_price_receive_Num = $this->input->post('pay_price_receive_Num', TRUE);
            $pay_price_schedule_Num = $this->input->post('pay_price_schedule_Num', TRUE);
            $paycheck_status_Num = $this->input->post('paycheck_status_Num', TRUE);
            $project_status_Num = $this->input->post('project_status_Num', TRUE);
            $setuptime_Str = $this->input->post('setuptime_Str', TRUE);

            //建構Project物件，並且更新
            $Project = new Project();
            $Project->construct([
                'projectid_Num' => $projectid_Num,
                'name_Str' => $name_Str,
                'admin_uid_Num' => $admin_uid_Num,
                'working_days_Num' => $working_days_Num,
                'classids_Arr' => $classids_Arr,
                'designids_Str' => implode(",",$designids_Str),
                'pay_price_total_Num' => $pay_price_total_Num,
                'pay_price_receive_Num' => $pay_price_receive_Num,
                'pay_price_schedule_Num' => $pay_price_schedule_Num,
                'paycheck_status_Num' => $paycheck_status_Num,
                'project_status_Num' => $project_status_Num,
                'setuptime_Str' => $setuptime_Str
            ]);
            $Project->set__permission_uids_UserList(['permission_emails_Str' => $permission_emails_Str]);
            $Project->set__admin_uid_Num(['admin_uid_Num' => $admin_uid_Num]);
            $Project->update(array(
            'db_update_Arr' => array(
                'name',
                'admin_uid',
                'permission_uids',
                'working_days',
                'classids',
                'designids',
                'pay_price_total',
                'pay_price_receive',
                'pay_price_schedule',
                'paycheck_status',
                'project_status',
                'setuptime',
                'updatetime'
                )
            ));

            //送出成功訊息
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '設定成功',
                'url' => 'admin/project/project/project/tablelist/'
            ));
        }
        else
        {
            $validation_errors_Str = validation_errors();
            $validation_errors_Str = !empty($validation_errors_Str) ? $validation_errors_Str : '設定錯誤' ;
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => $validation_errors_Str,
                'url' => 'admin/project/project/project/edit/?projectid='.$projectid_Num
            ));
        }
    }

    public function copy()
    {
        $data = $this->data;//取得公用數據

        $projectid_Num = $this->input->get('projectid');

        $Project = new Project();
        $Project->construct_db(array(
            'db_where_Arr' => array(
                'projectid' => $projectid_Num
            )
        ));

        //建構ProjectFanswoo物件，並且更新
        $ProjectFanswoo = new Project();
        $ProjectFanswoo->construct(array(
            'name_Str' => $Project->name_Str,
            'admin_uid_Num' => $Project->admin_uid_Num,
            'permission_uids_Str' => $Project->permission_uids_UserList->uniqueids_Str,
            'working_days_Num' => $Project->working_days_Num,
            'classids_Arr' => $Project->class_ClassMetaList->uniqueids_Arr,
            'designids_Str' => $Project->designids_Str,
            'pay_price_total_Num' => $Project->pay_price_total_Num,
            // 'pay_price_receive_Num' => $Project->pay_price_receive_Num,
            // 'pay_price_schedule_Num' => $Project->pay_price_schedule_Num,
            // 'paycheck_status_Num' => $Project->paycheck_status_Num,
            'project_status_Num' => $Project->project_status_Num,
            'setuptime_Str' => $Project->setuptime_DateTimeObj->datetime_Str
        ));

        $ProjectFanswoo->update();

        if($ProjectFanswoo->projectid_Num !== NULL)
        {
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '複製成功',
                'url' => 'admin/project/project/project/tablelist'
            ));
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '複製失敗',
                'url' => 'admin/project/project/project/tablelist'
            ));
        }
    }

    public function tablelist()
    {
        $data = $this->data;//取得公用數據
        $data = array_merge($data, $this->AdminModel->get_data(array(
            'child4_name_Str' => 'tablelist'//管理分類名稱
        )));

        $data['search_projectid_Num'] = $this->input->get('projectid');
        $data['search_name_Str'] = $this->input->get('name');
        $data['search_class_slug_Str'] = $this->input->get('class_slug');

        $limitstart_Num = $this->input->get('limitstart');
        $limitcount_Num = $this->input->get('limitcount');
        $limitcount_Num = !empty($limitcount_Num) ? $limitcount_Num : 20;

        $class_ClassMeta = new ClassMeta();
        $class_ClassMeta->construct_db(array(
            'db_where_Arr' => array(
                'slug' => $data['search_class_slug_Str']
            )
        ));

        $data['ProjectList'] = new ObjList();
        $data['ProjectList']->construct_db(array(
            'db_where_Arr' => array(
                'projectid' => $data['search_projectid_Num']
            ),
            'db_where_like_Arr' => array(
                'name_Str' => $data['search_name_Str']
            ),
            'db_where_or_Arr' => array(
                'classids' => array($class_ClassMeta->classid_Num)
            ),
            'db_orderby_Arr' => array(
                array('updatetime', 'DESC')
            ),
            'db_where_deletenull_Bln' => TRUE,
            'model_name_Str' => 'Project',
            'limitstart_Num' => $limitstart_Num,
            'limitcount_Num' => $limitcount_Num
        ));
        $data['page_link'] = $data['ProjectList']->create_links(array('base_url_Str' => 'admin/'.$data['child1_name_Str'].'/'.$data['child2_name_Str'].'/'.$data['child3_name_Str'].'/'.$data['child4_name_Str']));

        $data['ProjectClassMetaList'] = new ObjList();
        $data['ProjectClassMetaList']->construct_db(array(
            'db_where_Arr' => [
                'modelname' => 'project'
            ],
            'model_name_Str' => 'ClassMeta',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));

        //global
        $data['global']['style'][] = 'app/css/admin/global.css';
        $data['global']['js'][] = 'app/js/admin.js';

        //temp
        $data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
        $data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['admin_header_bar'] = $this->load->view('admin/temp/admin_header_bar', $data, TRUE);
        $data['temp']['admin_footer_bar'] = $this->load->view('admin/temp/admin_footer_bar', $data, TRUE);
        $data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url_Str'], $data);

    }

    public function tablelist_post()
    {
        $data = $this->data;//取得公用數據

        $search_projectid_Num = $this->input->post('search_projectid_Num', TRUE);
        $search_class_slug_Str = $this->input->post('search_class_slug_Str', TRUE);
        $search_name_Str = $this->input->post('search_name_Str', TRUE);

        $url_Str = base_url('admin/project/project/Project/tablelist/?');

        if(!empty($search_projectid_Num))
        {
            $url_Str = $url_Str.'&projectid='.$search_projectid_Num;
        }

        if(!empty($search_class_slug_Str))
        {
            $url_Str = $url_Str.'&class_slug='.$search_class_slug_Str;
        }

        if(!empty($search_name_Str))
        {
            $url_Str = $url_Str.'&name='.$search_name_Str;
        }

        header("Location: $url_Str");
    }

    public function delete()
    {
        $hash_Str = $this->input->get('hash');
        $projectid_Num = $this->input->get('projectid');

        //CSRF過濾
        if($hash_Str == $this->security->get_csrf_hash())
        {
            $Project = new Project();
            $Project->construct(array('projectid_Num' => $projectid_Num));
            $Project->delete();

            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '刪除成功',
                'url' => 'admin/project/project/project/tablelist'
            ));
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/project/project/project/tablelist'
            ));
        }
    }
}

?>