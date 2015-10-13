<?php

class Note_Controller extends MY_controller {
    
	// public function index()
	// {

 //        $data = $this->data;
        
 //        $this->load->model('note_list_model');
 //        $this->note_list_model->db_construct( array('db_where' => array('uid' => $data['user']['uid']) ) );
 //        $data['note_list'] = $this->note_list_model->get_array();
	// 	$data['note_other_list'] = $data['note_list'];
		
 //        //view
	// 	$data['page'] = 'note';
        
 //        //global
 //        $data['global']['style'][] = 'app/css/style.css';
 //        $data['global']['style'][] = 'app/css/note.css';
        
 //        //temp
	// 	$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
	// 	$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
	// 	$data['temp']['topheader'] = $this->load->view('temp/topheader', $data, TRUE);
	// 	$data['temp']['footer'] = $this->load->view('temp/footer', $data, TRUE);
		
	// 	$this->load->view('note/index', $data);
	// }
	
	// public function view($noteid = 0){
 //        $data = $this->data;
		
 //        $this->load->model('note_model');
 //        $this->note_model->db_construct( array('db_where' => array('noteid' => $noteid) ) );
 //        $data['note'] = $this->note_model->get_array();
        
 //        $this->load->model('note_list_model');
 //        $this->note_list_model->db_construct( array('db_where' => array('uid' => $data['user']['uid']) ) );
 //        $data['note_other_list'] = $this->note_list_model->get_array();
        
 //        //data
	// 	$data['page'] = 'note';
        
 //        //global
 //        $data['global']['style'][] = 'app/css/style.css';
 //        $data['global']['style'][] = 'app/css/note.css';
        
 //        //temp
	// 	$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
	// 	$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
	// 	$data['temp']['topheader'] = $this->load->view('temp/topheader', $data, TRUE);
	// 	$data['temp']['footer'] = $this->load->view('temp/footer', $data, TRUE);
		
	// 	$this->load->view('note/index', $data);

	// }

	public function index()
    {
        $data = $this->data;

        $limitstart_Num = $this->input->get('limitstart');
        $limitcount_Num = $this->input->get('limitcount');
        $limitcount_Num = !empty($limitcount_Num) ? $limitcount_Num : 10;

        $search_class_slug_Str = $this->input->get('class_slug');
        $class_ClassMeta = new ClassMeta();
        $class_ClassMeta->construct_db(array(
            'db_where_Arr' => array(
                'slug' => $search_class_slug_Str
            )
        ));
        
        $data['new_NoteFieldList'] = new ObjList();
        $data['new_NoteFieldList']->construct_db(array(
            'db_where_Arr' => array(
                'modelname' => 'note'
            ),
            'db_where_or_Arr' => array(
                'classids' => array($class_ClassMeta->classid_Num)
            ),
            'model_name_Str' => 'NoteField',
            'db_orderby_Arr' => array(
                array('prioritynum', 'DESC'),
                array('updatetime', 'DESC')
            ),
            'db_where_deletenull_Bln' => TRUE,
            'model_name_Str' => 'NoteField',
            'limitstart_Num' => $limitstart_Num,
            'limitcount_Num' => $limitcount_Num
        ));
        $data['page_link'] = $data['new_NoteFieldList']->create_links(array('base_url_Str' => 'note/'));

        // ec($data['new_NoteFieldList']);
        
        $data['ClassMetaList'] = new ObjList();
        $data['ClassMetaList']->construct_db(array(
            'db_where_Arr' => array(
                'modelname' => 'note'
            ),
            'model_name_Str' => 'ClassMeta',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));
        
        //global
		$data['global']['style'][] = 'app/css/temp/style.css';
		$data['global']['style'][] = 'app/css/temp/header_bar.css';
		$data['global']['style'][] = 'app/css/temp/footer_bar.css';
		$data['global']['style'][] = 'app/css/note/index.css';
        
        //temp
        $data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
        $data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['header_bar'] = $this->load->view('temp/header_bar', $data, TRUE);
        $data['temp']['footer_bar'] = $this->load->view('temp/footer_bar', $data, TRUE);
        $data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);
		
		//輸出模板
		$this->load->view('note/index', $data);
	}

    public function view($noteid_Num)
    {
        $data = $this->data;

        if(empty($noteid_Num))
        {
            $this->load->model('Message');
            $this->Message->show(array('message' => '連結輸入錯誤', 'url' => 'note'));
            return FALSE;
        }
        
        $data['ClassMetaList'] = new ObjList();
        $data['ClassMetaList']->construct_db(array(
            'db_where_Arr' => array(
                'modelname' => 'note'
            ),
            'model_name_Str' => 'ClassMeta',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));
        
        $data['new_NoteFieldList'] = new ObjList();
        $data['new_NoteFieldList']->construct_db(array(
            'db_where_Arr' => array(
                'modelname' => 'note'
            ),
            'model_name_Str' => 'NoteField',
            'db_orderby_Arr' => array(
                array('prioritynum', 'DESC'),
                array('updatetime', 'DESC')
            ),
            'db_where_deletenull_Bln' => TRUE,
            'model_name_Str' => 'NoteField',
            'limitstart_Num' => 0,
            'limitcount_Num' => 5
        ));

        $data['NoteField'] = new NoteField();
        $data['NoteField']->construct_db(array(
            'db_where_Arr' => array(
                'note.noteid' => $noteid_Num
            )
        ));
        
        //global
        $data['global']['style'][] = 'app/css/temp/style.css';
        $data['global']['style'][] = 'app/css/temp/header_bar.css';
		$data['global']['style'][] = 'app/css/temp/footer_bar.css';
        $data['global']['style'][] = 'app/css/note/view.css';
        
        //temp
        $data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
        $data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['header_bar'] = $this->load->view('temp/header_bar', $data, TRUE);
        $data['temp']['footer_bar'] = $this->load->view('temp/footer_bar', $data, TRUE);
        $data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);
        
        //輸出模板
        $this->load->view('note/view', $data);
    }
}

?>