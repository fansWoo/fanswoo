<?php

class Note_Controller extends MY_controller {

	public function index()
    {
        $data = $this->data;

        $limitstart = $this->input->get('limitstart');
        $limitcount = $this->input->get('limitcount');
        $limitcount = !empty($limitcount) ? $limitcount : 10;

        $search_class_slug = $this->input->get('class_slug');
        $class_ClassMeta = new ClassMeta();
        $class_ClassMeta->construct_db(array(
            'db_where_arr' => array(
                'slug' => $search_class_slug
            )
        ));
        
        $data['new_NoteFieldList'] = new ObjList(array(
            'db_where_arr' => array(
                'modelname' => 'note',
                'classids find' => $class_ClassMeta->classid
            ),
            'obj_class' => 'NoteField',
            'db_orderby_arr' => array(
                array('prioritynum', 'DESC'),
                array('updatetime', 'DESC')
            ),
            'db_delete_all_null' => TRUE,
            'obj_class' => 'NoteField',
            'limitstart' => $limitstart,
            'limitcount' => $limitcount
        ));
        $data['page_link'] = $data['new_NoteFieldList']->create_links(array('base_url' => 'note/'));
        
        $data['ClassMetaList'] = new ObjList();
        $data['ClassMetaList']->construct_db(array(
            'db_where_arr' => array(
                'modelname' => 'note'
            ),
            'obj_class' => 'ClassMeta',
            'limitstart' => 0,
            'limitcount' => 100
        ));
        
        //global
		$data['global']['style'][] = 'temp/global.css';
		$data['global']['style'][] = 'temp/header_bar.css';
		$data['global']['style'][] = 'temp/footer_bar.css';
		$data['global']['style'][] = 'note/index.css';

        $data['global']['js'][] = 'tool/smooth_scrollerator.js';
        
        //temp
        $data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
        $data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['header_bar'] = $this->load->view('temp/header_bar', $data, TRUE);
        $data['temp']['footer_bar'] = $this->load->view('temp/footer_bar', $data, TRUE);
        $data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);
        $data['loading_page'] = 'note';
		
		//輸出模板
		$this->load->view('note/index', $data);
	}

    public function view($noteid)
    {
        $data = $this->data;

        if(empty($noteid))
        {
            $this->load->model('Message');
            $this->Message->show(array('message' => '連結輸入錯誤', 'url' => 'note'));
            return FALSE;
        }
        
        $data['ClassMetaList'] = new ObjList();
        $data['ClassMetaList']->construct_db(array(
            'db_where_arr' => array(
                'modelname' => 'note'
            ),
            'obj_class' => 'ClassMeta',
            'limitstart' => 0,
            'limitcount' => 100
        ));
        
        $data['new_NoteFieldList'] = new ObjList();
        $data['new_NoteFieldList']->construct_db(array(
            'db_where_arr' => array(
                'modelname' => 'note'
            ),
            'obj_class' => 'NoteField',
            'db_orderby_arr' => array(
                array('prioritynum', 'DESC'),
                array('updatetime', 'DESC')
            ),
            'db_delete_all_null' => TRUE,
            'obj_class' => 'NoteField',
            'limitstart' => 0,
            'limitcount' => 5
        ));

        $data['NoteField'] = new NoteField();
        $data['NoteField']->construct_db(array(
            'db_where_arr' => array(
                'note.noteid' => $noteid
            )
        ));
        
        //global
        $data['global']['style'][] = 'temp/global.css';
        $data['global']['style'][] = 'temp/header_bar.css';
		$data['global']['style'][] = 'temp/footer_bar.css';
        $data['global']['style'][] = 'note/view.css';
        
        $data['global']['js'][] = 'tool/smooth_scrollerator.js';
        
        //temp
        $data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
        $data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['header_bar'] = $this->load->view('temp/header_bar', $data, TRUE);
        $data['temp']['footer_bar'] = $this->load->view('temp/footer_bar', $data, TRUE);
        $data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);
        $data['loading_page'] = 'note';
        
        //輸出模板
        $this->load->view('note/view', $data);
    }
}

?>