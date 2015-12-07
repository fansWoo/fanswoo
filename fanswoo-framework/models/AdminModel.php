<?php

class AdminModel extends FS_Model {

    public $child1_name_Str = '';
    public $child2_name_Str = '';
    public $child3_name_Str = '';
    public $child4_name_Str = '';
    public $child1_title_Str = '';
    public $child2_title_Str = '';
    public $child3_title_Str = '';
    public $child4_title_Str = '';
    public $admin_child_url_Str = '';
    public $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->config->load('admin', TRUE);

		$data['User'] = new User();
		$data['User']->construct_db(array(
			'db_where_Arr' => array(
				'uid_Num' => $this->session->userdata('uid')
			)
		));
		$this->data = $data;
	}

	public function get_data($arg)
	{
		$data = $this->data;
		$child4_name_Str = !empty($arg['child4_name_Str']) ? $arg['child4_name_Str'] : '';

        $child1_name_Str = $this->child1_name_Str;
        $child2_name_Str = $this->child2_name_Str;
        $child3_name_Str = $this->child3_name_Str;
		$child_data_Arr = $this->get_child($child4_name_Str);
		$group_purview_Arr = $this->config->item('group_purview_Arr', 'admin');

		$data_Arr['admin_sidebox'] = $this->reset_sidebox();
		$data_Arr = array_merge($data_Arr, $child_data_Arr);

		$group_purview_Bln = FALSE;
		if( in_array( 1, $data['User']->group_UserGroupList->uniqueids_Arr) )
		{
			$group_purview_Bln = TRUE;
		}
		else
		{
			foreach($data['User']->group_UserGroupList->uniqueids_Arr as $key => $value_Num)
			{
				if(
					!empty($group_purview_Arr[$value_Num]) &&
					is_array($group_purview_Arr[$value_Num])
				)
				{
					foreach($group_purview_Arr[$value_Num] as $key => $value_Arr)
					{
						if(
							$value_Arr[0] === $child1_name_Str &&
							$value_Arr[1] === $child2_name_Str &&
							$value_Arr[2] === $child3_name_Str &&
							$value_Arr[3] === $child4_name_Str
						)
						{
							$group_purview_Bln = TRUE;
							break;
						}
					}
				}
			}
		}

        if($group_purview_Bln !== TRUE)
        {
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '管理權限不足',
                'url' => 'admin'
            ));
            return FALSE;
        }

		return $data_Arr;
	}

	public function get_child($arg)
	{
		$child4_name_Str = $arg;

        $child1_name_Str = $this->child1_name_Str;
        $child2_name_Str = $this->child2_name_Str;
        $child3_name_Str = $this->child3_name_Str;

		$admin_sidebox = $this->config->item('admin_sidebox', 'admin');

        $this->child4_name_Str = $child4_name_Str;

		$this->child1_title_Str = $admin_sidebox[$child1_name_Str]['title'];
		$this->child2_title_Str = $admin_sidebox[$child1_name_Str]['child2'][$child2_name_Str]['title'];
		$this->child3_title_Str = $admin_sidebox[$child1_name_Str]['child2'][$child2_name_Str]['child3'][$child3_name_Str]['title'];
		$this->child4_title_Str = $admin_sidebox[$child1_name_Str]['child2'][$child2_name_Str]['child3'][$child3_name_Str]['child4'][$child4_name_Str]['title'];

		$this->admin_child_url_Str = $this->child1_name_Str.'/'.$this->child2_name_Str.'/'.$this->child3_name_Str.'/'.$this->child4_name_Str.'.php';

		$return_Arr = array(
			'child1_name_Str' => $this->child1_name_Str,
			'child2_name_Str' => $this->child2_name_Str,
			'child3_name_Str' => $this->child3_name_Str,
			'child4_name_Str' => $this->child4_name_Str,
			'child1_title_Str' => $this->child1_title_Str,
			'child2_title_Str' => $this->child2_title_Str,
			'child3_title_Str' => $this->child3_title_Str,
			'child4_title_Str' => $this->child4_title_Str,
			'admin_child_url_Str' => $this->admin_child_url_Str
		);

		return $return_Arr;
	}

	public function reset_sidebox()
	{
		$data = $this->data;

		$child1_name_Str = $this->child1_name_Str;
		$child2_name_Str = $this->child2_name_Str;
		$child3_name_Str = $this->child3_name_Str;
		$child4_name_Str = $this->child4_name_Str;

		$admin_sidebox = $this->config->item('admin_sidebox', 'admin');
		$group_purview_Arr = $this->config->item('group_purview_Arr', 'admin');

		if( in_array( 1, $data['User']->group_UserGroupList->uniqueids_Arr) )
		{
			$admin_sidebox2 = $admin_sidebox;
		}
		else
		{
			foreach($data['User']->group_UserGroupList->uniqueids_Arr as $key => $value_Num)
			{
				if(
					!empty($group_purview_Arr[$value_Num]) &&
					is_array($group_purview_Arr[$value_Num])
				)
				{
					foreach($group_purview_Arr[$value_Num] as $key => $value_Arr)
					{
						foreach($admin_sidebox as $key => $child1)
						{
					        if( $key == $value_Arr[0])
					        {
						        foreach($child1['child2'] as $key2 => $child2)
						        {
						            if( $key2 == $value_Arr[1] )
						            {
							            foreach($child2['child3'] as $key3 => $child3)
							            {
								            if( $key3 == $value_Arr[2] )
								            {
									            foreach($child3['child4'] as $key4 => $child4)
									            {
										            if( $key4 == $value_Arr[3] )
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
						}
					}
				}
			}
		}

		$admin_sidebox2[$child1_name_Str]['child2'][$child2_name_Str]['child3'][$child3_name_Str]['child4'][$child4_name_Str]['selected'] = TRUE;
		$admin_sidebox2[$child1_name_Str]['child2'][$child2_name_Str]['child3'][$child3_name_Str]['selected'] = TRUE;
		$admin_sidebox2[$child1_name_Str]['child2'][$child2_name_Str]['selected'] = TRUE;
		$admin_sidebox2[$child1_name_Str]['selected'] = TRUE;

		// ec($admin_sidebox2);

		return $admin_sidebox2;
	}
	
}