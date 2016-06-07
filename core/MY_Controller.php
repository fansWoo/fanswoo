<?php

class MY_Controller extends FS_Controller
{

    public function __construct()
    {
        parent::__construct();
        $data = $this->data;

        //引入jQuery及jQuery UI
        $data['global']['js'][] = 'tool/jquery-1.12.4.js';
        $data['global']['js'][] = 'tool/jquery-ui-1.11.4.custom/jquery-ui.js';
        $data['global']['style'][] = 'tool/jquery-ui-1.11.4.custom/jquery-ui.css';

        //引入 handlebars 模板引擎
        $data['global']['js'][] = 'tool/handlebars-v4.0.5.js';

        //引入fanswoo-frmaework
        $data['global']['js'][] = 'fanswoo-framework/global.js';
        $data['global']['js'][] = 'fanswoo-framework/model/ObjDbBase.js';
        $data['global']['js'][] = 'fanswoo-framework/model/ObjList.js';
        $data['global']['js'][] = 'fanswoo-framework/model/Temp.js';

        //引入該專案之global.js及global.css
        $data['global']['js'][] = 'global.js';
        $data['global']['style'][] = 'fanswoo-framework/global.css';
        $data['global']['style'][] = 'temp/message_window.css';

        //引入專案模板style，如果 admin 則不載入
        $url = explode( base_url(), $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] );
        if( substr($url[1], 0, 5) !== 'admin' )
        {
            $data['global']['style'][] = 'temp/global.css';
            $data['global']['style'][] = 'temp/header_bar.css';
            $data['global']['style'][] = 'temp/footer_bar.css';
        }

        $data['temp']['message_window'] = $this->load->view('temp/message_window', $data, TRUE);

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->data = $data;
    }
}