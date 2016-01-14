<?php
class Page_Controller extends MY_Controller {

    public $data = array();
    
	public function _remap($slug_Str = 'index'){
        $data = $this->data;
        
        $data['page_slug_Str'] = $slug_Str;

        $data['PagerField'] = new PagerField();
        $data['PagerField']->construct_db(array(
            'db_where_Arr' => array(
                'pager.slug' => $slug_Str
            )
        ));

        if(!empty($data['PagerField']->pagerid_Num))
        {
        	if(!empty($data['PagerField']->href_Str))
        	{
        		header("Location: " . base_url($data['PagerField']->href_Str) );
        	}

	        $data['ClassMeta'] = new ClassMeta();
	        $data['ClassMeta']->construct_db(array(
	            'db_where_Arr' => array(
	                'classid' => $data['PagerField']->class_ClassMetaList->obj_Arr[0]->classid_Num
	            )
	        ));

	        $data['PagerList'] = new ObjList();
	        $data['PagerList']->construct_db(array(
	            'db_where_Arr' => array(
                	'classids' => $data['ClassMeta']->classid_Num
	            ),
	            'db_orderby_Arr' => array(
	                array('prioritynum', 'DESC'),
	                array('pagerid', 'DESC')
	            ),
	            'model_name_Str' => 'Pager',
	            'limitstart_Num' => 0,
	            'limitcount_Num' => 100
	        ));

	        //global
			$data['global']['style'][] = 'temp/style.css';
			$data['global']['style'][] = 'temp/header_bar.css';
			$data['global']['style'][] = 'temp/footer_bar.css';
	        $data['global']['style'][] = 'pager/default.css';
	        
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
	        if(empty($slug_Str))
	        {
	            $slug_Str = 'index';
	        }
	        
	        //global
	    	$data['global']['js'][] = 'script_header_bar_mobile';
	    	
			$data['global']['style'][] = 'temp/style.css';
			$data['global']['style'][] = 'temp/header_bar.css';
			$data['global']['style'][] = 'temp/footer_bar.css';
	        $data['global']['style'][] = 'page/'.$slug_Str.'.css';
	        
	        //temp
			$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
			$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
			$data['temp']['header_bar'] = $this->load->view('temp/header_bar', $data, TRUE);
			$data['temp']['footer_bar'] = $this->load->view('temp/footer_bar', $data, TRUE);
			$data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);
			
			//輸出模板
			$this->load->view('page/'.$slug_Str, $data);
        }
	}
}
// class Page_Controller extends MY_Controller
// {
//     public $data = array();
    
// 	public function _remap($page = 'index'){
//         $data = $this->data;
        
//         if(isset($page) == FALSE)
//         {
//             $page = 'index';
//         }
// 		//沒有這個頁面
// 		if ( ! file_exists('app/views/page/'.$page.'.php')){
// 			show_404();
// 		}
		
// 		//判斷PC/Mobile瀏覽器
// 		if(isset($data['global']['browser_agent']['agent_ie']) && $data['global']['browser_agent']['agent_ie'] == 'ie8')
// 		{
// 			$agent = 'ie8';
// 			$agent_temp = '_ie8';
// 		}
// 		else
// 		{
// 			$agent = '';
// 			$agent_temp = '';
// 		}
		
// 		//如果沒有手機版本就連回PC版本
// 		if ( ! file_exists('app/views/page/'.$page.$agent_temp.'.php')){
// 			$agent = '';
// 			$agent_temp = '';
// 		}
		
// 		//view data設定
// 		$data['page'] = $page;
        
//         //global
// 		$data['global']['style'][] = 'app/css/style'.$agent_temp.'.css';
// 		$data['global']['style'][] = $page.$agent_temp.'.css';
        
//         //temp
// 		$data['temp']['header_up'] = $this->load->view('temp/header_up'.$agent_temp, $data, TRUE);
// 		$data['temp']['header_down'] = $this->load->view('temp/header_down'.$agent_temp, $data, TRUE);
// 		$data['temp']['footer'] = $this->load->view('temp/footer'.$agent_temp, $data, TRUE);
		
// 		//PC/Mobile版本特別模組
// 		if($agent !== 'm'){
// 			$data['temp']['topheader'] = $this->load->view('temp/topheader'.$agent_temp, $data, TRUE);
// 		}
		
// 		//輸出模板
// 		$this->load->view('page/'.$page.$agent_temp, $data);
// 	}
// }

?>