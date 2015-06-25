<?php

class recaptcha_controller extends FS_Controller
{
    public $data = array();
    
	public function index(){
        $data = $this->data;
		
		$this->load->helper('form');
		$this->load->library('form_validation');
        
        //global
		$data['global']['style'][] = 'style'.$agent_temp;
		$data['global']['style'][] = $page.$agent_temp;
        
        //temp
		$data['temp']['header_up'] = $this->load->view('temp/header_up'.$agent_temp, $data, TRUE);
		$data['temp']['header_down'] = $this->load->view('temp/header_down'.$agent_temp, $data, TRUE);
		$data['temp']['footer'] = $this->load->view('temp/footer'.$agent_temp, $data, TRUE);
		
		//輸出模板
		$this->load->view('recaptcha', $data);
	}

	public function post(){
        $data = $this->data;

        $g_recaptcha_response = $this->input->post('g-recaptcha-response');

		$request = send_request(
			'https://www.google.com/recaptcha/api/siteverify',
			array(
				'secret' => '6LcXlggTAAAAAH2SiFEpEeRk34n7KPZSiVS1DCIM',
				'response' => $g_recaptcha_response
			),
			'',
			'POST'
		);
		print_r($request);

	}
}

?>