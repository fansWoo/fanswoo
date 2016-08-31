<?php

class AdminSetting extends ObjBase {

    public $config_path = '';
    public $data = [];

	public function __construct()
	{
		parent::__construct();
	}

	public function view($arg = [])
	{
		$data = $this->data;

        $this->config->load( $this->config_path );
        $data['setting_arr'] = $this->config->item('setting_arr');

        foreach( (array) $data['setting_arr'] as $key => $value_arr)
        {
            if( !empty($value_arr['child']) )
            {
                foreach($value_arr['child'] as $key2 => $value2_arr)
                {
                	if( !empty($value2_arr['name']) )
                	{
                    	$name_arr[] = $value2_arr['name'];
                	}

                    if( !empty($value2_arr['child']) )
                    {
		                foreach($value2_arr['child'] as $key3 => $value3_arr)
		                {
		                	if( !empty($value3_arr['name']) )
		                	{
		                    	$name_arr[] = $value3_arr['name'];
		                	}
		                }
                    }
                }
            }
        }

        $data['SettingList'] = new SettingList([
            'db_where_arr' => [
                'keyword in' => $name_arr
            ]
        ]);

        $data['global']['form_open'] = $arg['form_open'];

        //temp
        $data['temp']['admin_header_bar'] = $this->load->view('admin/temp/admin_header_bar', $data, TRUE);
        $data['temp']['admin_footer_bar'] = $this->load->view('admin/temp/admin_footer_bar', $data, TRUE);

        //輸出模板
        $this->load->view('admin/temp/admin_setting', $data);
	}

	public function post($arg = [])
	{
        $this->config->load( $this->config_path );
        $data['setting_arr'] = $this->config->item('setting_arr');

        $setting_group = $this->input->post('setting_group', TRUE);

        foreach($data['setting_arr'] as $key => $value_arr)
        {

            if( $setting_group == $key && !empty($value_arr['child']) )
            {

                //過濾不符合規則的POST
                foreach($value_arr['child'] as $key2 => $value2_arr)
                {
                    if( !empty($value2_arr['set_rules']) )
                    {
                        $this->form_validation->set_rules($value2_arr['name'], $value2_arr['title'], $value2_arr['set_rules']);
                    }
                }
                if( !$this->form_validation->check() ) return FALSE;

                $i = 0;
                foreach($value_arr['child'] as $key2 => $value2_arr)
                {
                    if(
                        $value2_arr['type'] == 'radio' ||
                        $value2_arr['type'] == 'select'
                    )
                    {
	                   $setting_construct_name = $this->input->post($value2_arr['name']);
	                   $setting_construct_name_arr[$i]['value'] = isset($setting_construct_name) ? $setting_construct_name : $value2_arr['default_value'];
	                   $setting_construct_name_arr[$i]['keyword'] = $value2_arr['name'];
	                   $setting_construct_name_arr[$i]['modelname'] = $value2_arr['modelname'];
                    }
                    else if(
                        $value2_arr['type'] == 'checkbox' ||
                        $value2_arr['type'] == 'group'
                    )
                    {
                        foreach($value2_arr['child'] as $key3 => $value3_arr)
                        {
                            $setting_construct_name = $this->input->post($value3_arr['name'], TRUE);
                            if( $value2_arr['type'] == 'checkbox' )
                            {
                                $setting_construct_name_arr[$i]['value'] = isset($setting_construct_name) ? 1 : 0;
                            }
                            else
                            {
                                $setting_construct_name_arr[$i]['value'] = isset($setting_construct_name) ? $setting_construct_name : $value3_arr['default_value'];
                            }
                            $setting_construct_name_arr[$i]['keyword'] = $value3_arr['name'];
                            $setting_construct_name_arr[$i]['modelname'] = $value3_arr['modelname'];
                    		$i++;
                        }
                    }
                    else
                    {
	                   $setting_construct_name = $this->input->post($value2_arr['name'], TRUE);
	                   $setting_construct_name_arr[$i]['value'] = isset($setting_construct_name) ? $setting_construct_name : $value2_arr['default_value'];
	                   $setting_construct_name_arr[$i]['keyword'] = $value2_arr['name'];
	                   $setting_construct_name_arr[$i]['modelname'] = $value2_arr['modelname'];
                    }
                    $i++;
                }

                $SettingList = new SettingList();
                $SettingList->construct(array(
                    'construct_arr' => $setting_construct_name_arr
                ));
                $SettingList->update();

                //送出成功訊息

                $this->load->model('Message');
                $this->Message->show([
                    'message' => '設定成功',
                ]);
                return TRUE;

            }

        }

	}
                
}