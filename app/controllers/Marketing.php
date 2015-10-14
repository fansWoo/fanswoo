<?php

class Marketing_Controller extends MY_controller
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

        $data['previous_url_Str'] = uri_string();

        //global
        $data['global']['style'][] = 'app/css/temp/style.css';
        $data['global']['style'][] = 'app/css/temp/header_bar.css';
		$data['global']['style'][] = 'app/css/temp/footer_bar.css';
        $data['global']['style'][] = 'app/css/marketing/index.css';
            
        //temp
		$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
		$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
		$data['temp']['header_bar'] = $this->load->view('temp/header_bar', $data, TRUE);
		$data['temp']['footer_bar'] = $this->load->view('temp/footer_bar', $data, TRUE);
		$data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);

        //輸出模板
        $this->load->view('marketing/index', $data);
    }

}

?>