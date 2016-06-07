<?php

class Global_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('AdminModel');
        $this->AdminModel->construct(['data' => $this->data, 'file' => __FILE__ ]);
    }

    public function common()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'url' => 'admin/base/global/global/global_setting'
        ]);
        return TRUE;
    }

    public function global_setting()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $AdminSetting = new AdminSetting;
        $AdminSetting->set('data', $data);
        $AdminSetting->set('config_path', 'admin/base/global/global/global_setting');
        $AdminSetting->view([
            'form_open' => 'admin/'.$data['admin_child_url'].'_post'
        ]);
    }

    public function global_setting_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $AdminSetting = new AdminSetting;
        $AdminSetting->set('config_path', 'admin/base/global/global/global_setting');
        $AdminSetting->post();
    }

    public function website_content()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $AdminSetting = new AdminSetting;
        $AdminSetting->set('data', $data);
        $AdminSetting->set('config_path', 'admin/base/global/global/website_content');
        $AdminSetting->view([
            'form_open' => 'admin/'.$data['admin_child_url'].'_post'
        ]);
    }

    public function website_content_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
        
        $AdminSetting = new AdminSetting;
        $AdminSetting->set('config_path', 'admin/base/global/global/website_content');
        $AdminSetting->post();
    }
}

?>