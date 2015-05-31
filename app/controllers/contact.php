<?php

class contact_controller extends FS_controller
{
    
	public function index(){
        $data = $this->data;
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name', '姓名', 'required');
		$this->form_validation->set_rules('company', '公司', 'required');
		$this->form_validation->set_rules('telphone', '電話', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		
		if ($this->form_validation->run() == TRUE)
		{
			$this->load->model('contact_model');
			$this->contact_model->sendmail();

			$message = '需求單已經成功送出';
			$url = 'contact';
			
			$this->load->model('message_model');
			$this->message_model->show(array('message' => $message, 'url' => $url));
		}
		else
		{
			//判斷PC/Mobile瀏覽器
			$this->load->library('user_agent');
			if ($this->agent->is_mobile())
			{
				$agent = 'm';
				$agent_temp = '_m';
			}
			else
			{
				$agent = '';
				$agent_temp = '';
			}
			
            //data
			$data['page'] = 'contact'.$agent_temp;
        
            //global
            $data['global']['style'][] = 'style';
            $data['global']['style'][] = 'contact'.$agent_temp;
            
            //temp
			$data['temp']['header_up'] = $this->load->view('temp/header_up'.$agent_temp, $data, TRUE);
			$data['temp']['header_down'] = $this->load->view('temp/header_down'.$agent_temp, $data, TRUE);
			if($agent !== 'm')
			{
				$data['temp']['topheader'] = $this->load->view('temp/topheader'.$agent_temp, $data, TRUE);
			}
			$data['temp']['footer'] = $this->load->view('temp/footer'.$agent_temp, $data, TRUE);
			
			$this->load->view('contact/index'.$agent_temp, $data);
		}
	}
}

?>