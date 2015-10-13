<?php

class Message extends CI_Model {

    private $data = array();
	
	public function show_turnpage($arg = array('message' => '', 'url' => '', 'second' => 2))
	{
        $data = $this->data;

        $SettingList = new SettingList();
        $SettingList->construct_db(array(
            'db_where_Arr' => array(
                'modelname' => ''
            )
        ));

        $data['global'] = $SettingList->get_array();
        $data['global']['website_metatag_Arr'] = explode(PHP_EOL, $data['global']['website_metatag']);

        $data['global']['browser_agent'] = browser_agent();
        
		$message = isset($arg['message']) ? $arg['message'] : '';
		$url = isset($arg['url']) ? $arg['url'] : '';
		$second = isset($arg['second']) ? $arg['second'] : 2;

        //data
		$data['message'] = $message;
		$data['url'] = $url;
		$data['second'] = $second;
        
        //style
		$data['global']['style'][] = 'app/style/temp/global.css';
		$data['global']['style'][] = 'app/style/temp/message_turnpage.css';
        
        //temp
		$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
		$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
		$data['temp']['header_bar'] = $this->load->view('temp/header_bar', $data, TRUE);
		$data['temp']['footer_bar'] = $this->load->view('temp/footer_bar', $data, TRUE);
		$data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);
		$this->load->view('temp/message', $data);
        
        return FALSE;
	}

	public function show($arg)
	{
        //引入引數並將空值的變數給予空值
        reset_null_arr($arg, ['message', 'url', 'second']);
        foreach($arg as $key => $value) ${$key} = $arg[$key];

        $second = !empty($second) ? $second : 5 ;

        //data
        $this->input->set_cookie([
        	'name' => 'message_show_content',
        	'value' => $message,
        	'expire' => '60'
        ]);
        $this->input->set_cookie([
        	'name' => 'message_show_second',
        	'value' => $second,
        	'expire' => '60'
        ]);

        header("Location: " . base_url( $url ) );
        exit;
	}
	
}