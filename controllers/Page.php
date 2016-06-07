<?php
class Page_Controller extends MY_Controller {

    public $data = array();
    
	public function _remap($slug = 'index'){
        $data = $this->data;
        
        $data['page_slug'] = $slug;

        $data['PagerField'] = new PagerField();
        $data['PagerField']->construct_db(array(
            'db_where_arr' => array(
                'pager.slug' => $slug
            )
        ));

        if(!empty($data['PagerField']->pagerid))
        {
        	if(!empty($data['PagerField']->href))
        	{
        		header("Location: " . base_url($data['PagerField']->href) );
        	}

	        $data['ClassMeta'] = new ClassMeta();
	        $data['ClassMeta']->construct_db(array(
	            'db_where_arr' => array(
	                'classid' => $data['PagerField']->class_ClassMetaList->obj_arr[0]->classid
	            )
	        ));

	        $data['PagerList'] = new ObjList();
	        $data['PagerList']->construct_db(array(
	            'db_where_arr' => array(
                	'classids' => $data['ClassMeta']->classid
	            ),
	            'db_orderby_arr' => array(
	                array('prioritynum', 'DESC'),
	                array('pagerid', 'DESC')
	            ),
	            'model_name' => 'Pager',
	            'limitstart' => 0,
	            'limitcount' => 100
	        ));

	        //global
			$data['global']['style'][] = 'temp/global.css';
			$data['global']['style'][] = 'temp/header_bar.css';
			$data['global']['style'][] = 'temp/footer_bar.css';
	        $data['global']['style'][] = 'pager/default.css';
	        
	        $data['global']['js'][] = 'tool/smooth_scrollerator.js';
	        $data['global']['js'][] = 'tool/cycle2.js';
	        
	        //temp
			$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
			$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
			$data['temp']['header_bar'] = $this->load->view('temp/header_bar', $data, TRUE);
			$data['temp']['footer_bar'] = $this->load->view('temp/footer_bar', $data, TRUE);
			$data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);
			
			//輸出模板
			$this->load->view('pager/default', $data);
        }
        //以FTP為內容的page
        else
        {
	        if(empty($slug))
	        {
	            $slug = 'index';
	        }
	        
	        //global
			$data['global']['style'][] = 'temp/global.css';
			$data['global']['style'][] = 'temp/header_bar.css';
			$data['global']['style'][] = 'temp/footer_bar.css';
	        $data['global']['style'][] = 'page/'.$slug.'.css';

	        $data['global']['js'][] = 'tool/smooth_scrollerator.js';
	        $data['global']['js'][] = 'tool/cycle2.js';
	        
	        //temp
			$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
			$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
			$data['temp']['header_bar'] = $this->load->view('temp/header_bar', $data, TRUE);
			$data['temp']['footer_bar'] = $this->load->view('temp/footer_bar', $data, TRUE);
			$data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);
			
			//輸出模板
			$this->load->view('page/'.$slug, $data);
        }
	}
}
