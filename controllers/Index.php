<?php
class Index_Controller extends MY_Controller
{

    public function index()
    {
    	$data = $this->data;

	    //global
		$data['global']['page_title_name'] = '客製化網站設計';
		$data['global']['style'][] = 'temp/global.css';
		$data['global']['style'][] = 'temp/header_bar.css';
		$data['global']['style'][] = 'temp/footer_bar.css';
	    $data['global']['style'][] = 'index.css';

		$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
		$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
		$data['temp']['header_bar'] = $this->load->view('temp/header_bar', $data, TRUE);
		$data['temp']['footer_bar'] = $this->load->view('temp/footer_bar', $data, TRUE);
		$data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);

		$data['loading_page'] = 'index';
			
		//輸出模板
		$this->load->view('index', $data);
	}

}

?>