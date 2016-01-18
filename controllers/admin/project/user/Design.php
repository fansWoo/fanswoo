<?php

class Design_Controller extends MY_Controller {

    protected $child1_name_Str = 'project';
    protected $child2_name_Str = 'user';
    protected $child3_name_Str = 'design';

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
            
        $designid_Num = $this->input->get('designid');

        $data['Design'] = new Design();
        $data['Design']->construct_db(array(
            'db_where_Arr' => array(
                'designid_Num' => $designid_Num
            )
        ));

        if(empty($data['Design']->designid_Num))
        {
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '請先選擇欲查看設計項目的專案',
                'url' => 'admin/project/user/project/tablelist'
            ));
            return FALSE;
        }

        //global
        $data['global']['style'][] = 'admin/global.css';
        $data['global']['js'][] = 'admin.js';
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
    
}