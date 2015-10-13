<?php

class FS_Controller extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();

        $SettingList = new SettingList();
        $SettingList->construct_db(array(
            'db_where_Arr' => array(
                'modelname' => ''
            )
        ));

        $data['global'] = $SettingList->get_array();
        $data['global']['website_metatag_Arr'] = explode(PHP_EOL, $data['global']['website_metatag']);

        $data['global']['browser_agent'] = browser_agent();
        $data['global']['locale'] = $this->i18n->get_current_locale();

        $data['User'] = new User();
        $data['User']->construct_db(array(
            'db_where_Arr' => array(
                'uid_Num' => $this->session->userdata('uid')
            )
        ));

        //顯示提示訊息
        $data['global']['message_show']['content'] = $this->input->cookie('message_show_content');
        $data['global']['message_show']['second'] = $this->input->cookie('message_show_second');

        if(!empty( $data['global']['message_show']['content']) )
        {
            $data['global']['style'][] = 'app/css/temp/message_window.css';
            $data['temp']['message_window'] = $this->load->view('temp/message_window', $data, TRUE);
            //刪除提示訊息
            $this->input->set_cookie([
                'name' => 'message_show_content',
                'expire' => ''
            ]);
            $this->input->set_cookie([
                'name' => 'message_show_second',
                'expire' => ''
            ]);
        }

        $this->data = $data;
    }
}