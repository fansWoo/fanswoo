<?php

class Contact_Controller extends MY_controller
{
	public function __construct()
    {
        parent::__construct();

        $SettingList = new SettingList();
        $SettingList->construct_db(array(
            'db_where_Arr' => array(
                'modelname' => ''
            )
        ));

        $data = $this->data;

        $this->load->helper('form');
        $this->load->library('form_validation');
    }
    
    public function index()
    {
        $data = $this->data;

        //global
        $data['global']['style'][] = 'app/css/temp/style.css';
        $data['global']['style'][] = 'app/css/temp/header_bar.css';
		$data['global']['style'][] = 'app/css/temp/footer_bar.css';
        $data['global']['style'][] = 'app/css/contact/index.css';
            
        //temp
		$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
		$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
		$data['temp']['header_bar'] = $this->load->view('temp/header_bar', $data, TRUE);
		$data['temp']['footer_bar'] = $this->load->view('temp/footer_bar', $data, TRUE);
		$data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);

        //輸出模板
        $this->load->view('contact/index', $data);
    }

    public function contact_post()
    {
        $this->form_validation->set_rules('username_Str', 'Your name', 'required');
        $this->form_validation->set_rules('email_Str', 'Email', 'required');
        $this->form_validation->set_rules('classtype_Str', 'Emotional State', 'required');
        $this->form_validation->set_rules('content_Str', 'Message', 'required');

        if ($this->form_validation->run() !== FALSE)
        {
            //基本post欄位
            $username_Str = $this->input->post('username_Str', TRUE);
            $email_Str = $this->input->post('email_Str', TRUE);
            $classtype_Str = $this->input->post('classtype_Str', TRUE);
            $content_Str = $this->input->post('content_Str', TRUE);

            //建構Contact物件，並且更新
            $Contact = new Contact();
            $Contact->construct(array(
                'username_Str' => $username_Str,
                'email_Str' => $email_Str,
                'classtype_Str' => $classtype_Str,
                'content_Str' => $content_Str,
                'status_process_Num' => 1
            ));
            $Contact->update();

            //寄出電子郵件
            $Setting = new Setting();
            $Setting->construct_db([
                'db_where_Arr' => [
                    'keyword_Str' => 'smtp_email'
                ]
            ]);

            $email_Str = $Setting->value_Str;
            $email_name_Str = 'alchema';
            $title_Str = 'alchema網站有新的聯繫單';

            $message_Str = '您好：<br><br>我們收到一封聯繫單，請至後台觀看，謝謝<br><br>後台位置：<br>
            <a href="http://'.$_SERVER['HTTP_HOST'].'/fanswoo/admin">
            http://'.$_SERVER['HTTP_HOST'].'/fanswoo/admin</a><br><br>'.date('Y-m-d H:i:s');

            $Mailer = new Mailer;
            $return_message_Str = $Mailer->sendmail($email_Str, $email_name_Str, $title_Str, $message_Str);
            if($return_message_Str === TRUE)
            {
                //寄件成功
            }
            else
            {
                //送出訊息
                $this->load->model('Message');
                $this->Message->show(array(
                    'message' => 'error(4)：Mail Server Error',
                    'url' => 'contact'
                ));
                return FALSE;
            }

            //送出成功訊息
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => 'Setting Success',
                'url' => 'contact'
            ));
        }
        else
        {
            $validation_errors_Str = validation_errors();
            $validation_errors_Str = !empty($validation_errors_Str) ? $validation_errors_Str : 'Setting Error' ;
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => $validation_errors_Str,
                'url' => 'contact'
            ));
        }
    }
}

?>