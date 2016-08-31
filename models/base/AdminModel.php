<?php

class AdminModel extends FS_Model {

    public $child1_name = '';
    public $child2_name = '';
    public $child3_name = '';
    public $child4_name = '';
    public $child1_title = '';
    public $child2_title = '';
    public $child3_title = '';
    public $child4_title = '';
    public $admin_child_url = '';
    public $data = array();

	public function __construct()
	{
		parent::__construct();
		$data = $this->data;

		$this->config->load('admin', TRUE);

        $User = new User([
            'db_where_arr' => array(
                'uid' => $this->session->userdata('uid')
            )
        ]);

        // if( empty($User->uid) )
        // {
        //     $this->load->model('Message');
        //     $this->Message->show([
        //         'message' => '請先登入會員再進行後台操作',
        //         'url' => 'user/login/?url=admin'
        //     ]);
        //     exit;
        //     return FALSE;
        // }

        $this->data = $data;
	}

	public function construct($arg = [])
	{
		$data = $arg['data'];

        $data['global']['style'][] = 'admin/global.css';
        $data['global']['js'][] = 'admin/global.js';
        $data['global']['js'][] = 'tool/jquery.form.js';

        $data['global']['style'][] = 'tool/scrollbar/jquery.mCustomScrollbar.css';
        $data['global']['js'][] = 'tool/scrollbar/jquery.mCustomScrollbar.min.js';

		$this->data = array_merge_recursive($data, $this->data);

		$file = $arg['file'];
		$file_arr = array_reverse( explode(DIRECTORY_SEPARATOR, $file) );
		$child3_name_arr = explode('.', $file_arr[0] );
		$child3_name = strtolower( $child3_name_arr[0] );

        $this->child1_name = $file_arr[2];
        $this->child2_name = $file_arr[1];
        $this->child3_name = $child3_name;
	}

	public function rewrite_page()
	{
		$data = $this->data;

		$default_page = $this->config->item('default_page', 'admin');

		foreach($default_page as $key => $value)
		{
			if( in_array($key, $data['User']->group_UserGroupList->uniqueids_arr ) )
			{

        		header('Location: '.$value);
        		return TRUE;
			}
		}

		header('Location: user/logout');
	}

	public function get_data($arg)
	{
		$data = $this->data;
		$child4_name = $arg;

        $child1_name = $this->child1_name;
        $child2_name = $this->child2_name;
        $child3_name = $this->child3_name;
		$child_data_arr = $this->get_child( $child4_name );

		$admin_sidebox = $this->reset_sidebox();
		$data['admin_sidebox'] = $admin_sidebox;
		$data = array_merge($data, $child_data_arr);

		$last_admin_child1 = $this->session->userdata('last_admin_child1');
		$last_admin_child2 = $this->session->userdata('last_admin_child2');
		$last_admin_child3 = $this->session->userdata('last_admin_child3');
		$last_admin_child4 = $this->session->userdata('last_admin_child4');

		$group_purview_bln = FALSE;

    	if( empty( $data['User']->group_UserGroupList->uniqueids_arr ) )
    	{
    		$groupids_arr = array(0);
    	}
    	else
    	{
    		$groupids_arr = $data['User']->group_UserGroupList->uniqueids_arr;
    	}
    	
		if( in_array( 1, $groupids_arr) )
		{
			$group_purview_bln = TRUE;
		}
		else if(
			empty( $last_admin_child1 ) &&
			empty( $last_admin_child2 ) &&
			empty( $last_admin_child3 ) &&
			empty( $last_admin_child4 )
		)
		{
			foreach($groupids_arr as $key => $value)
			{
				if( in_array( $value, $admin_sidebox[$child1_name]['child2'][$child2_name]['child3'][$child3_name]['child4'][$child4_name]['purview_groupids'] )
				)
				{
					$group_purview_bln = TRUE;
					break;
				}
			}
		}
		else if(
			$child1_name == $last_admin_child1 &&
			$child2_name == $last_admin_child2 &&
			$child3_name == $last_admin_child3 &&
			$child4_name == $last_admin_child4
		)
		{
			$group_purview_bln = TRUE;
		}
		else if( empty($admin_sidebox[$child1_name]['child2'][$child2_name]['child3'][$child3_name]['child4'][$child4_name]['purview_groupids']) )
		{
			foreach($groupids_arr as $key => $value)
			{
				if( in_array( $value, (array) $admin_sidebox[$last_admin_child1]['child2'][$last_admin_child2]['child3'][$last_admin_child3]['child4'][$last_admin_child4]['purview_groupids'] ) )
				{
					$group_purview_bln = TRUE;
					break;
				}
			}
		}
		else
		{
			foreach($groupids_arr as $key => $value)
			{
				if( in_array( $value, $admin_sidebox[$child1_name]['child2'][$child2_name]['child3'][$child3_name]['child4'][$child4_name]['purview_groupids'] )
				)
				{
					$group_purview_bln = TRUE;
					break;
				}
			}
		}
        
        $data['temp']['admin_header_bar'] = $this->load->view('admin/temp/admin_header_bar', $data, TRUE);
        $data['temp']['admin_footer_bar'] = $this->load->view('admin/temp/admin_footer_bar', $data, TRUE);

        if( !empty($group_purview_bln) )
        {
        	if( empty($_POST) )
        	{
		        $this->session->set_userdata('last_admin_child1', $child1_name);
		        $this->session->set_userdata('last_admin_child2', $child2_name);
		        $this->session->set_userdata('last_admin_child3', $child3_name);
		        $this->session->set_userdata('last_admin_child4', $child4_name);
        	}
			return $data;
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '管理權限不足',
                'url' => 'user/logout'
            ));
            exit;
            return FALSE;
        }

	}

	public function get_child($arg)
	{
		$child4_name = $arg;

        $child1_name = $this->child1_name;
        $child2_name = $this->child2_name;
        $child3_name = $this->child3_name;

		$admin_sidebox = $this->config->item('admin_sidebox', 'admin');

        $this->child4_name = $child4_name;

		$this->child1_title = $admin_sidebox[$child1_name]['title'];
		$this->child2_title = $admin_sidebox[$child1_name]['child2'][$child2_name]['title'];
		$this->child3_title = $admin_sidebox[$child1_name]['child2'][$child2_name]['child3'][$child3_name]['title'];
		$this->child4_title = $admin_sidebox[$child1_name]['child2'][$child2_name]['child3'][$child3_name]['child4'][$child4_name]['title'];

		$this->admin_child_url = $this->child1_name.'/'.$this->child2_name.'/'.$this->child3_name.'/'.$this->child4_name;

		$return_arr = array(
			'child1_name' => $this->child1_name,
			'child2_name' => $this->child2_name,
			'child3_name' => $this->child3_name,
			'child4_name' => $this->child4_name,
			'child1_title' => $this->child1_title,
			'child2_title' => $this->child2_title,
			'child3_title' => $this->child3_title,
			'child4_title' => $this->child4_title,
			'admin_child_url' => $this->admin_child_url
		);

		return $return_arr;
	}

	public function reset_sidebox()
	{
		$data = $this->data;

		$child1_name = $this->child1_name;
		$child2_name = $this->child2_name;
		$child3_name = $this->child3_name;
		$child4_name = $this->child4_name;

		$admin_sidebox = $this->config->item('admin_sidebox', 'admin');

    	if( empty( $data['User']->group_UserGroupList->uniqueids_arr ) )
    	{
    		$groupids_arr = array(0);
    	}
    	else
    	{
    		$groupids_arr = $data['User']->group_UserGroupList->uniqueids_arr;
    	}

		if( in_array( 1, $groupids_arr) )
		{
			$admin_sidebox2 = $admin_sidebox;
		}
		else
		{
			foreach($admin_sidebox as $key => $child1)
			{
		        foreach($child1['child2'] as $key2 => $child2)
		        {
			        foreach($child2['child3'] as $key3 => $child3)
		            {
			            foreach($child3['child4'] as $key4 => $child4)
			            {
							foreach($groupids_arr as $key5 => $value)
							{
								if(
									!empty( $admin_sidebox[$key]['child2'][$key2]['child3'][$key3]['child4'][$key4]['purview_groupids'] ) &&
									in_array( $value, $admin_sidebox[$key]['child2'][$key2]['child3'][$key3]['child4'][$key4]['purview_groupids'] )
								)
								{
									$admin_sidebox2[$key]['title'] = $admin_sidebox[$key]['title'];
									$admin_sidebox2[$key]['child2'][$key2]['title'] = $admin_sidebox[$key]['child2'][$key2]['title'];
					        		$admin_sidebox2[$key]['child2'][$key2]['child3'][$key3]['title'] = $admin_sidebox[$key]['child2'][$key2]['child3'][$key3]['title'];
					            	$admin_sidebox2[$key]['child2'][$key2]['child3'][$key3]['child4'][$key4] = $admin_sidebox[$key]['child2'][$key2]['child3'][$key3]['child4'][$key4];
								}
							}
			            }
				    }
				}
			}
		}

		$admin_sidebox2[$child1_name]['child2'][$child2_name]['child3'][$child3_name]['child4'][$child4_name]['selected'] = TRUE;
		$admin_sidebox2[$child1_name]['child2'][$child2_name]['child3'][$child3_name]['selected'] = TRUE;
		$admin_sidebox2[$child1_name]['child2'][$child2_name]['selected'] = TRUE;
		$admin_sidebox2[$child1_name]['selected'] = TRUE;

		return $admin_sidebox2;
	}
	
}