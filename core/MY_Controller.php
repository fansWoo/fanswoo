<?php

class MY_Controller extends FS_Controller
{

    public function __construct()
    {
        parent::__construct();
        $data = $this->data;

        //引入該專案之global.js及global.css
        $data['global']['js'][] = 'global.js';

        //引入專案模板style，如果 admin 則不載入
        $url = explode( base_url(), $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] );
        if( substr($url[1], 0, 5) !== 'admin' )
        {
            $data['global']['style'][] = 'temp/global.css';
            $data['global']['style'][] = 'temp/header_bar.css';
            $data['global']['style'][] = 'temp/footer_bar.css';
        }

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->data = $data;
    }
}