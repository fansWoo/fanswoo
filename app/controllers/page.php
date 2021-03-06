<?php

class page_controller extends FS_Controller
{
    public $data = array();
    
	public function _remap($page = 'index'){
        $data = $this->data;
        
        if(isset($page) == FALSE)
        {
            $page = 'index';
        }
		//沒有這個頁面
		if ( ! file_exists('app/views/page/'.$page.'.php')){
			show_404();
		}
		
		//判斷PC/Mobile瀏覽器
		if(isset($data['global']['browser_agent']['agent_ie']) && $data['global']['browser_agent']['agent_ie'] == 'ie8')
		{
			$agent = 'ie8';
			$agent_temp = '_ie8';
		}
		else
		{
			$agent = '';
			$agent_temp = '';
		}
		
		//如果沒有手機版本就連回PC版本
		if ( ! file_exists('app/views/page/'.$page.$agent_temp.'.php')){
			$agent = '';
			$agent_temp = '';
		}
		
		//view data設定
		$data['page'] = $page;
        
        //global
		$data['global']['style'][] = 'style'.$agent_temp;
		$data['global']['style'][] = $page.$agent_temp;
        
        //temp
		$data['temp']['header_up'] = $this->load->view('temp/header_up'.$agent_temp, $data, TRUE);
		$data['temp']['header_down'] = $this->load->view('temp/header_down'.$agent_temp, $data, TRUE);
		$data['temp']['footer'] = $this->load->view('temp/footer'.$agent_temp, $data, TRUE);
		
		//PC/Mobile版本特別模組
		if($agent !== 'm'){
			$data['temp']['topheader'] = $this->load->view('temp/topheader'.$agent_temp, $data, TRUE);
		}
		
		//輸出模板
		$this->load->view('page/'.$page.$agent_temp, $data);
	}
}

?>