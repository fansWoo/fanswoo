<?php

class Project_Controller extends MY_Controller {

    protected $child1_name_Str = 'project';
    protected $child2_name_Str = 'user';
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
                'projectid_Num' => $data['projectid_Num']
            )
        ));

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

        if(empty($data['Project']->projectid_Num))
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
            'db_where_Arr' => [
                'modelname' => 'shop_transfer'
            ]
        ]);

        $data['DesignList'] = new ObjList();
        $data['DesignList']->construct_db(array(
            'db_where_Arr' => array(
                'projectid' => $data['projectid_Num']
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

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url_Str'], $data);
    }

    public function edit_post()
    {
        $data = $this->data;//取得公用數據

        $projectid_Num = $this->input->post('projectid_Num', TRUE);

        //基本post欄位
        $pay_account_Str = $this->input->post('pay_account_Str', TRUE);
        $pay_name_Str = $this->input->post('pay_name_Str', TRUE);
        $pay_paytime_Str = $this->input->post('pay_paytime_Str', TRUE);
        $pay_remark_Str = $this->input->post('pay_remark_Str', TRUE);

        if( !empty($pay_account_Str) && !empty($pay_name_Str) && !empty($pay_paytime_Str) )
        {
            //建構Project物件，並且更新
            $Project = new Project();
            $Project->construct(array(
                'projectid_Num' => $projectid_Num,
                'pay_account_Str' => $pay_account_Str,
                'pay_name_Str' => $pay_name_Str,
                'pay_paytime_Str' => $pay_paytime_Str,
                'pay_remark_Str' => $pay_remark_Str,
                'pay_status_Num' => 1
            ));
            $Project->update(array(
                'db_update_Arr' => array(
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
        $data = $this->data;//取得公用數據
        $data = array_merge($data, $this->AdminModel->get_data(array(
            'child4_name_Str' => 'tablelist'//管理分類名稱
        )));

        $limitstart_Num = $this->input->get('limitstart');
        $limitcount_Num = $this->input->get('limitcount');
        $limitcount_Num = !empty($limitcount_Num) ? $limitcount_Num : 20;

        $data['ProjectList'] = new ObjList();
        $data['ProjectList']->construct_db(array(
            'db_where_like_Arr' => array(
                'permission_uids' => $data['User']->uid_Num
            ),
            'db_orderby_Arr' => array(
                array('projectid', 'DESC')
            ),
            'db_where_deletenull_Bln' => TRUE,
            'model_name_Str' => 'Project',
            'limitstart_Num' => $limitstart_Num,
            'limitcount_Num' => $limitcount_Num
        ));
        $data['page_links'] = $data['ProjectList']->create_links(array('base_url_Str' => 'admin/'.$data['child1_name_Str'].'/'.$data['child2_name_Str'].'/'.$data['child3_name_Str'].'/'.$data['child4_name_Str']));

        //view data設定
        $data['admin_sidebox'] = $this->AdminModel->reset_sidebox();

        //global
        $data['global']['style'][] = 'admin/global.css';
        $data['global']['js'][] = 'admin.js';

        //temp
        $data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
        $data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['admin_header_bar'] = $this->load->view('admin/temp/admin_header_bar', $data, TRUE);
        $data['temp']['admin_footer_bar'] = $this->load->view('admin/temp/admin_footer_bar', $data, TRUE);
        $data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url_Str'], $data);

    }

}

?>