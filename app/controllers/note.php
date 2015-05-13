<?php

class Note extends CI_Controller {
    
    private $data = array();
    
	public function __construct(){
		parent::__construct();
        $this->data = $this->common_model->common();
	}

	public function index(){
        $data = $this->data;
        
        $this->load->model('note_list_model');
        $this->note_list_model->db_construct( array('db_where' => array('uid' => $data['user']['uid']) ) );
        $data['note_list'] = $this->note_list_model->get_array();
		$data['note_other_list'] = $data['note_list'];
		
        //view
		$data['page'] = 'note';
        
        //global
        $data['global']['style'][] = 'style';
        $data['global']['style'][] = 'note';
        
        //temp
		$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
		$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
		$data['temp']['topheader'] = $this->load->view('temp/topheader', $data, TRUE);
		$data['temp']['footer'] = $this->load->view('temp/footer', $data, TRUE);
		
		$this->load->view('note/index', $data);
	}
	
	public function view($noteid = 0){
        $data = $this->data;
		
        $this->load->model('note_model');
        $this->note_model->db_construct( array('db_where' => array('noteid' => $noteid) ) );
        $data['note'] = $this->note_model->get_array();
        
        $this->load->model('note_list_model');
        $this->note_list_model->db_construct( array('db_where' => array('uid' => $data['user']['uid']) ) );
        $data['note_other_list'] = $this->note_list_model->get_array();
        
        //data
		$data['page'] = 'note';
        
        //global
        $data['global']['style'][] = 'style';
        $data['global']['style'][] = 'note';
        
        //temp
		$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
		$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
		$data['temp']['topheader'] = $this->load->view('temp/topheader', $data, TRUE);
		$data['temp']['footer'] = $this->load->view('temp/footer', $data, TRUE);
		
		$this->load->view('note/index', $data);

	}
}

?>