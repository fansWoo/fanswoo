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

        $data['Project'] = new Project();
        $data['Project']->construct_db(array(
            'db_where_arr' => array(
                'projectid' => $data['projectid']
            )
        ));

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

        if(empty($data['Project']->projectid))
        {
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '請先選擇欲修改的專案',
                'url' => 'admin/project/user/project/tablelist'
            ));
            return FALSE;
        }

        $data['transfer_SettingList'] = new SettingList();
        $data['transfer_SettingList']->construct_db([
            'db_where_arr' => [
                'modelname' => 'shop_transfer'
            ]
        ]);

        $data['DesignList'] = new ObjList();
        $data['DesignList']->construct_db(array(
            'db_where_arr' => array(
                'projectid' => $data['projectid']
            ),
            'db_orderby_arr' => array(
                array('updatetime', 'DESC')
            ),
            'db_where_deletenull_bln' => TRUE,
            'model_name' => 'Design',
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

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url'], $data);
    }

    public function edit_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $projectid = $this->input->post('projectid', TRUE);

        //基本post欄位
        $pay_account = $this->input->post('pay_account', TRUE);
        $pay_name = $this->input->post('pay_name', TRUE);
        $pay_paytime = $this->input->post('pay_paytime', TRUE);
        $pay_remark = $this->input->post('pay_remark', TRUE);

        if( !empty($pay_account) && !empty($pay_name) && !empty($pay_paytime) )
        {
            //建構Project物件，並且更新
            $Project = new Project();
            $Project->construct(array(
                'projectid' => $projectid,
                'pay_account' => $pay_account,
                'pay_name' => $pay_name,
                'pay_paytime' => $pay_paytime,
                'pay_remark' => $pay_remark,
                'pay_status' => 1
            ));
            $Project->update(array(
                'db_update_arr' => array(
                    'pay_account',
                    'pay_name',
                    'pay_paytime',
                    'pay_remark',
                    'pay_status',
                )
            ));
        }

        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show(array(
            'message' => '設定成功',
            'url' => 'admin/project/user/project/tablelist'
        ));
    }

    public function tablelist()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $limitstart = $this->input->get('limitstart');
        $limitcount = $this->input->get('limitcount');
        $limitcount = !empty($limitcount) ? $limitcount : 20;

        $data['ProjectList'] = new ObjList([
            'db_where_like_arr' => array(
                'permission_uids' => $data['User']->uid
            ),
            'db_orderby_arr' => array(
                array('projectid', 'DESC')
            ),
            'db_where_deletenull_bln' => TRUE,
            'model_name' => 'Project',
            'limitstart' => $limitstart,
            'limitcount' => $limitcount
        ]);
        $data['page_links'] = $data['ProjectList']->create_links(array('base_url' => 'admin/'.$data['child1_name'].'/'.$data['child2_name'].'/'.$data['child3_name'].'/'.$data['child4_name']));

        //view data設定
        $data['admin_sidebox'] = $this->AdminModel->reset_sidebox();

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url'], $data);

    }

}

?>