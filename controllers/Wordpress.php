<?php

class Wordpress_Controller extends MY_controller
{
	public function __construct()
    {
        parent::__construct();

        $data = $this->data;

        $this->load->helper('form');
        $this->load->library('form_validation');
    }
    
    public function index()
    {
        $data = $this->data;

        $data['previous_url'] = base_url($_SERVER['REQUEST_URI']);

        //global
        $data['global']['page_title_name'] = '0元免費套版網站';
        $data['global']['style'][] = 'temp/global.css';
        $data['global']['style'][] = 'temp/header_bar.css';
		$data['global']['style'][] = 'temp/footer_bar.css';
        $data['global']['style'][] = 'wordpress/index.css';

        $data['global']['js'][] = 'contact_form.js';
        $data['global']['js'][] = 'tool/cycle2.js';
            
        //temp
		$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
		$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
		$data['temp']['header_bar'] = $this->load->view('temp/header_bar', $data, TRUE);
		$data['temp']['footer_bar'] = $this->load->view('temp/footer_bar', $data, TRUE);
		$data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);
        $data['temp']['contact_content_area'] = $this->load->view('temp/contact_content_area', $data, TRUE);
        $data['loading_page'] = 'wordpress';

        //輸出模板
        $this->load->view('wordpress', $data);
    }

}

?>