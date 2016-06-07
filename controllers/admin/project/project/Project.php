<?php

class Project_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('AdminModel');
        $this->AdminModel->construct(['data' => $this->data, 'file' => __FILE__ ]);
    }

    public function edit()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
            
        $data['projectid'] = $this->input->get('projectid');

        $data['Project'] = new Project([
            'db_where_arr' => [
                'projectid' => $data['projectid']
            ]
        ]);

        $data['ProjectClassMetaList'] = new ObjList([
            'db_where_arr' => array(
                'modelname' => 'project'
            ),
            'model_name' => 'ClassMeta',
            'limitstart' => 0,
            'limitcount' => 100
        ]);

        $data['class2_ClassMetaList'] = new ObjList();
        $data['class2_ClassMetaList']->construct_db(array(
            'db_where_arr' => array(
                'modelname' => 'project_class2'
            ),
            'model_name' => 'ClassMeta',
            'limitstart' => 0,
            'limitcount' => 100
        ));

        $data['SuggestList'] = new ObjList();
        $data['SuggestList']->construct_db(array(
            'db_where_arr' => array(
                'projectid' => $data['projectid']
            ),
            'db_orderby_arr' => array(
                array('suggestid', 'ASC')
            ),
            'db_where_deletenull_bln' => TRUE,
            'model_name' => 'Suggest',
            'limitstart' => 0,
            'limitcount' => 100
        ));

        $data['admin_User'] = new User();
        $data['admin_User']->construct_db(array(
            'db_where_arr' => array(
                'uid' => $data['Project']->admin_uid
            )
        ));
        
        //global
        $data['global']['js'][] = 'tool/jquery.form.js';

        //temp
        $data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
        $data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['admin_header_bar'] = $this->load->view('admin/temp/admin_header_bar', $data, TRUE);
        $data['temp']['admin_footer_bar'] = $this->load->view('admin/temp/admin_footer_bar', $data, TRUE);
        $data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url'], $data);
    }

    public function prints()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $data['projectid'] = $this->input->get('projectid');

        $data['Project'] = new Project();
        $data['Project']->construct_db(array(
            'db_where_arr' => array(
                'projectid' => $data['projectid']
            )
        ));
        
        if(empty($data['Project']->projectid))
        {
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '請先選擇欲列印的專案',
                'url' => 'admin/project/project/project/tablelist'
            ));
            return FALSE;
        }

        $project_permission_uids_arr = explode(PHP_EOL, trim($data['Project']->permission_uids_UserList->uniqueids));

        $data['project_User'] = new User();
        $data['project_User']->construct_db(array(
            'db_where_arr' => array(
                'uid' => $project_permission_uids_arr[0]
            )
        ));

        $data['admin_User'] = new User();
        $data['admin_User']->construct_db(array(
            'db_where_arr' => array(
                'uid' => $data['Project']->admin_uid
            )
        ));

        $data['SuggestList'] = new ObjList();
        $data['SuggestList']->construct_db(array(
            'db_where_arr' => array(
                'projectid' => $data['projectid']
            ),
            'db_orderby_arr' => array(
                array('suggestid', 'ASC')
            ),
            'db_where_deletenull_bln' => TRUE,
            'model_name' => 'Suggest',
            'limitstart' => 0,
            'limitcount' => 100
        ));

        $this->load->library('TcPdfDriver');
        $this->tcpdfdriver->config([
            'creator' => $data['Project']->admin_uid,
            'author' => $data['Project']->admin_uid,
            'title' => $data['Project']->name,
            'subject' => '專案估價單',
            'filename' => $data['Project']->name.'專案估價單'
        ]);

        $this->tcpdfdriver->add_page();
        $html = $this->load->view('admin/'.$data['admin_child_url'], $data, TRUE);
        $this->tcpdfdriver->write_html(['html' => $html]);
        $this->tcpdfdriver->last_page();

        $this->tcpdfdriver->output();
    }

    public function edit_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $this->form_validation->set_rules('name', '專案名稱', 'required');
        if( !$this->form_validation->check() ) return FALSE;
        
        //基本post欄位
        $projectid = $this->input->post('projectid', TRUE);
        $name = $this->input->post('name', TRUE);
        $admin_uid = $this->input->post('admin_uid', TRUE);
        $permission_emails = $this->input->post('permission_emails');
        $working_days = $this->input->post('working_days', TRUE);
        $classids_arr = $this->input->post('classids_arr', TRUE);
        $designids = (array) $this->input->post('designids[]', TRUE);
        $pay_price_total = $this->input->post('pay_price_total', TRUE);
        $pay_price_receive = $this->input->post('pay_price_receive', TRUE);
        $pay_price_schedule = $this->input->post('pay_price_schedule', TRUE);
        $pay_price_schedule2 = $this->input->post('pay_price_schedule2', TRUE);
        $paycheck_status = $this->input->post('paycheck_status', TRUE);
        $project_status = $this->input->post('project_status', TRUE);
        $setuptime = $this->input->post('setuptime', TRUE);
        $endtime = $this->input->post('endtime', TRUE);

        $endtime = date('Y-m-d H-i-s',strtotime( $setuptime.'+'.$working_days.'day'));

        //建構Project物件，並且更新
        $Project = new Project([
            'projectid' => $projectid,
            'name' => $name,
            'admin_uid' => $admin_uid,
            'working_days' => $working_days,
            'classids_arr' => $classids_arr,
            'designids' => implode(",",$designids),
            'pay_price_total' => $pay_price_total,
            'pay_price_receive' => $pay_price_receive,
            'pay_price_schedule' => $pay_price_schedule,
            'pay_price_schedule2' => $pay_price_schedule2,
            'paycheck_status' => $paycheck_status,
            'project_status' => $project_status,
            'setuptime' => $setuptime,
            'endtime' => $endtime
        ]);
        $Project->set__permission_uids_UserList(['permission_emails' => $permission_emails]);
        $Project->set__admin_uid(['admin_uid' => $admin_uid]);
        $Project->update(array(
        'db_update_arr' => array(
            'name',
            'admin_uid',
            'permission_uids',
            'working_days',
            'classids',
            'designids',
            'pay_price_total',
            'pay_price_receive',
            'pay_price_schedule',
            'pay_price_schedule2',
            'paycheck_status',
            'project_status',
            'setuptime',
            'endtime',
            'updatetime'
            )
        ));

        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '設定成功',
            'url' => 'admin/project/project/project/tablelist'
        ]);
    }

    public function edit_design_post()
    {
        $designidArr = $this->input->post('designidArr', TRUE);
        $titleArr = $this->input->post('titleArr', TRUE);
        $priceArr = $this->input->post('priceArr', TRUE);
        $daysArr = $this->input->post('daysArr', TRUE);
        $synopsisArr = $this->input->post('synopsisArr', TRUE);

        $titleArr_count = count($titleArr);
        foreach( $titleArr as $key => $value)
        {
            if( !empty( $value ) )
            {
                $Design = new Design();
                $Design->construct([
                    'designid' => $designidArr[$key],
                    'projectid' => $Project->projectid,
                    'title' => $titleArr[$key],
                    'price' => $priceArr[$key],
                    'days' => $daysArr[$key],
                    'synopsis' => $synopsisArr[$key],
                    'prioritynum' => $titleArr_count - $key
                ]);
                $Design->update();
            }
        }
    }

    public function copy()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $projectid = $this->input->get('projectid');

        $Project = new Project();
        $Project->construct_db(array(
            'db_where_arr' => array(
                'projectid' => $projectid
            )
        ));

        //建構ProjectFanswoo物件，並且更新
        $ProjectFanswoo = new Project();
        $ProjectFanswoo->construct(array(
            'name' => $Project->name,
            'admin_uid' => $Project->admin_uid,
            'permission_uids' => $Project->permission_uids_UserList->uniqueids,
            'working_days' => $Project->working_days,
            'classids_arr' => $Project->class_ClassMetaList->uniqueids_arr,
            'designids' => $Project->designids,
            'pay_price_total' => $Project->pay_price_total,
            // 'pay_price_receive' => $Project->pay_price_receive,
            // 'pay_price_schedule' => $Project->pay_price_schedule,
            // 'pay_price_schedule2' => $Project->pay_price_schedule2,
            // 'paycheck_status' => $Project->paycheck_status,
            'project_status' => $Project->project_status,
            'setuptime' => $Project->setuptime_DateTimeObj->datetime,
            'endtime' => $Project->endtime_DateTimeObj->datetime
        ));

        $ProjectFanswoo->update();

        $design_count = count($Project->DesignList->obj_arr);
        foreach($Project->DesignList->obj_arr as $key => $value_Design)
        {
            $Design = new Design();
            $Design->construct([
                'projectid' => $ProjectFanswoo->projectid,
                'title' => $value_Design->title,
                'price' => $value_Design->price,
                'days' => $value_Design->days,
                'synopsis' => $value_Design->synopsis,
                'prioritynum' => $design_count - $key
            ]);
            $Design->update();
        }

        if($ProjectFanswoo->projectid !== NULL)
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
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $data['search_projectid'] = $this->input->get('projectid');
        $data['search_name'] = $this->input->get('name');
        $data['search_class_slug'] = $this->input->get('class_slug');
        $data['search_pay_price_receive'] = $this->input->get('price_receive');
        $data['search_pay_price_total'] = $this->input->get('price_total');
        $data['search_pay_price_schedule'] = $this->input->get('price_schedule');
        $data['search_setuptime'] = $this->input->get('setuptime');
        $data['search_endtime'] = $this->input->get('endtime');

        $limitstart = $this->input->get('limitstart');
        $limitcount = $this->input->get('limitcount');
        $limitcount = !empty($limitcount) ? $limitcount : 20;

        $class_ClassMeta = new ClassMeta();
        $class_ClassMeta->construct_db(array(
            'db_where_arr' => array(
                'slug' => $data['search_class_slug']
            )
        ));

        $data['ProjectList'] = new ObjList();
        $data['ProjectList']->construct_db(array(
            'db_where_arr' => array(
                'projectid' => $data['search_projectid'],
                'pay_price_receive' => $data['search_pay_price_receive'],
                'pay_price_total' => $data['search_pay_price_total'],
                'pay_price_schedule' => $data['search_pay_price_schedule']                
            ),
            'db_where_like_arr' => array(
                'name' => $data['search_name'],
                'setuptime' => $data['search_setuptime'],
                'endtime' => $data['search_endtime'],
            ),
            'db_where_or_arr' => array(
                'classids' => array($class_ClassMeta->classid)
            ),
            'db_orderby_arr' => array(
                array('updatetime', 'DESC')
            ),
            'db_where_deletenull_bln' => TRUE,
            'model_name' => 'Project',
            'limitstart' => $limitstart,
            'limitcount' => $limitcount
        ));
        $data['page_link'] = $data['ProjectList']->create_links(array('base_url' => 'admin/'.$data['child1_name'].'/'.$data['child2_name'].'/'.$data['child3_name'].'/'.$data['child4_name']));

        $data['ProjectClassMetaList'] = new ObjList();
        $data['ProjectClassMetaList']->construct_db(array(
            'db_where_arr' => [
                'modelname' => 'project'
            ],
            'model_name' => 'ClassMeta',
            'limitstart' => 0,
            'limitcount' => 100
        ));

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

        $search_projectid = $this->input->post('search_projectid', TRUE);
        $search_class_slug = $this->input->post('search_class_slug', TRUE);
        $search_name = $this->input->post('search_name', TRUE);
        $search_pay_price_receive = $this->input->post('search_pay_price_receive', TRUE);
        $search_pay_price_total = $this->input->post('search_pay_price_total', TRUE);
        $search_pay_price_schedule = $this->input->post('search_pay_price_schedule', TRUE);
        $search_setuptime = $this->input->post('search_setuptime', TRUE);
        $search_endtime = $this->input->post('search_endtime', TRUE);

        $url = base_url('admin/project/project/Project/tablelist/?');

        if(!empty($search_projectid))
        {
            $url = $url.'&projectid='.$search_projectid;
        }

        if(!empty($search_class_slug))
        {
            $url = $url.'&class_slug='.$search_class_slug;
        }

        if(!empty($search_name))
        {
            $url = $url.'&name='.$search_name;
        }

        if(!empty($search_pay_price_receive))
        {
            $url = $url.'&price_receive='.$search_pay_price_receive;
        }

        if(!empty($search_pay_price_total))
        {
            $url = $url.'&price_total='.$search_pay_price_total;
        }

        if(!empty($search_pay_price_schedule))
        {
            $url = $url.'&price_schedule='.$search_pay_price_schedule;
        }

        if(!empty($search_setuptime))
        {
            $url = $url.'&setuptime='.$search_setuptime;
        }

        if(!empty($search_endtime))
        {
            $url = $url.'&endtime='.$search_endtime;
        }

        header("Location: $url");
    }

    public function delete()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
        
        $hash = $this->input->get('hash');
        $projectid = $this->input->get('projectid');

        //CSRF過濾
        if($hash == $this->security->get_csrf_hash())
        {
            $Project = new Project();
            $Project->construct(array('projectid' => $projectid));
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