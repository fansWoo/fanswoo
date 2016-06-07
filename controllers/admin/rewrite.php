<?php

class Rewrite_Controller extends MY_Controller
{
	
	public function index()
	{
        $data = $this->data;

        $this->load->model('AdminModel');
        $this->AdminModel->construct(['data' => $data, 'file' => __FILE__ ]);
        $this->AdminModel->rewrite_page();

	}
	
}

?>