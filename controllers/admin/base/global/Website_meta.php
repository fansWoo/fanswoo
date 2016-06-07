<?php

class Website_meta_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('AdminModel');
        $this->AdminModel->construct(['data' => $this->data, 'file' => __FILE__ ]);
    }
    
    public function seo($input = '')
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
                    
        //temp
        $data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
        $data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['admin_header_bar'] = $this->load->view('admin/temp/admin_header_bar', $data, TRUE);
        $data['temp']['admin_footer_bar'] = $this->load->view('admin/temp/admin_footer_bar', $data, TRUE);
        $data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url'], $data);
    }

    public function seo_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $this->form_validation->set_rules('website_metatag', 'SEO標籤', 'required');
        if( !$this->form_validation->check() ) return FALSE;

        $website_metatag = $this->input->post('website_metatag', TRUE);

        $Setting = new Setting([
            'keyword' => 'website_metatag',
            'value' => $website_metatag
        ]);
        $Setting->update();

        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '設定成功'
        ]);
    }
    
    public function plugin($input = '')
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
                    
        //temp
        $data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
        $data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['admin_header_bar'] = $this->load->view('admin/temp/admin_header_bar', $data, TRUE);
        $data['temp']['admin_footer_bar'] = $this->load->view('admin/temp/admin_footer_bar', $data, TRUE);
        $data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url'], $data);
    }

    public function plugin_ga_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $this->form_validation->set_rules('website_script_plugin_ga', 'GA Script Plugin');
        if( !$this->form_validation->check() ) return FALSE;

        $website_script_plugin_ga = $this->input->post('website_script_plugin_ga');

        $SettingList = new SettingList([
            'construct_arr' => [
                [
                    'keyword' => 'website_script_plugin_ga',
                    'value' => $website_script_plugin_ga
                ]
            ]
        ]);
        $SettingList->update();

        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '設定成功'
        ]);
    }

    public function plugin_fb_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
        
        $this->form_validation->set_rules('website_script_plugin_fb', 'Custom Script Plugin');
        if( !$this->form_validation->check() ) return FALSE;

        $website_script_plugin_fb = $this->input->post('website_script_plugin_fb');

        $SettingList = new SettingList([
            'construct_arr' => [
                [
                    'keyword' => 'website_script_plugin_fb',
                    'value' => $website_script_plugin_fb
                ]
            ]
        ]);
        $SettingList->update();

        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '設定成功'
        ]);
    }

    public function plugin_custom_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $this->form_validation->set_rules('website_script_plugin_custom', 'Custom Script Plugin');
        if( !$this->form_validation->check() ) return FALSE;

        $website_script_plugin_custom = $this->input->post('website_script_plugin_custom');

        $SettingList = new SettingList([
            'construct_arr' => [
                [
                    'keyword' => 'website_script_plugin_custom',
                    'value' => $website_script_plugin_custom
                ]
            ]
        ]);
        $SettingList->update();

        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '設定成功'
        ]);
    }
}

?>