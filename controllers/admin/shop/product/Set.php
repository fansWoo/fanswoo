<?php

class Set_Controller extends MY_Controller {

    protected $child1_name_Str = 'shop';
    protected $child2_name_Str = 'product';
    protected $child3_name_Str = 'set';

    public function __construct()
    {
        parent::__construct();
        $data = $this->data;

        $this->load->model('AdminModel');
        $this->AdminModel->child1_name_Str = $this->child1_name_Str;
        $this->AdminModel->child2_name_Str = $this->child2_name_Str;
        $this->AdminModel->child3_name_Str = $this->child3_name_Str;

        if(empty($data['User']->uid_Num))
        {
            $url = base_url('user/login/?url=admin');
            header('Location: '.$url);
            return FALSE;
        }

        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function set()
    {
        $data = $this->data;//取得公用數據
        $data = array_merge($data, $this->AdminModel->get_data(array(
            'child4_name_Str' => 'set'//管理分類名稱
        )));

        //待建立
        //設定產品庫存規格A的名稱
        //設定產品庫存規格A的勾選單(這個規格是產品顏色，並且需要顯示色碼)
        //設定產品庫存規格B的名稱

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

    public function set_post()
    {

        $this->form_validation->set_rules('website_title_name', '網站標題名稱', 'required');

        if ($this->form_validation->run() === TRUE)
        {
            $website_title_name = $this->input->post('website_title_name', TRUE);
            $website_title_introduction = $this->input->post('website_title_introduction', TRUE);

            $SettingList = new SettingList();
            $SettingList->construct(array(
                'construct_Arr' => array(
                    array(
                        'keyword_Str' => 'website_title_name',
                        'value_Str' => $website_title_name
                    ),
                    array(
                        'keyword_Str' => 'website_title_introduction',
                        'value_Str' => $website_title_introduction
                    )
                )
            ));
            $SettingList->update(array());

            //送出成功訊息
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '設定成功',
                'url' => 'admin/base/global/global/common'
            ));
        }
        else
        {
            //送出失敗訊息
            $validation_errors_Str = validation_errors();
            $validation_errors_Str = !empty($validation_errors_Str) ? $validation_errors_Str : '設定錯誤' ;
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => $validation_errors_Str,
                'url' => 'admin/base/global/global/common'
            ));
        }
    }

}

?>