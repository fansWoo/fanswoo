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

        $data['previous_url_Str'] = uri_string();

        //global
        $data['global']['style'][] = 'temp/style.css';
        $data['global']['style'][] = 'temp/header_bar.css';
		$data['global']['style'][] = 'temp/footer_bar.css';
        $data['global']['style'][] = 'contact/index.css';
        
        $data['global']['js'][] = 'smooth_scrollerator.js';
            
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
        $previous_url_Str = $this->input->post('previous_url_Str');

        $this->form_validation->set_rules('username_Str', '您的姓名', 'required');
        $this->form_validation->set_rules('company_Str', '公司名稱', 'required');
        $this->form_validation->set_rules('phone_Str', '聯繫電話', 'required');
        $this->form_validation->set_rules('email_Str', '電子郵件', 'required');
        $this->form_validation->set_rules('address_Str', '公司地址', 'required');
        // $this->form_validation->set_rules('content_Str', '聯繫內容', 'required');
        $this->form_validation->set_rules('classtype_Str', '詢問項目', 'required');
        // $this->form_validation->set_rules('classtype2_Str', '主要項目', 'required');
        $this->form_validation->set_rules('money_Str', '預算', 'required');

        if ($this->form_validation->run() !== FALSE)
        {
            //基本post欄位
            $username_Str = $this->input->post('username_Str', TRUE);
            $company_Str = $this->input->post('company_Str', TRUE);
            $phone_Str = $this->input->post('phone_Str', TRUE);
            $email_Str = $this->input->post('email_Str', TRUE);
            $address_Str = $this->input->post('address_Str', TRUE);
            $content_Str = $this->input->post('content_Str', TRUE);
            $classtype_Str = $this->input->post('classtype_Str', TRUE);
            $classtype2_Str = $this->input->post('classtype2_Str', TRUE);
            $money_Str = $this->input->post('money_Str', TRUE);

            //建構Contact物件，並且更新
            $Contact = new ContactFanswoo();
            $Contact->construct(array(
                'username_Str' => $username_Str,
                'company_Str' => $company_Str,
                'phone_Str' => $phone_Str,
                'email_Str' => $email_Str,
                'address_Str' => $address_Str,
                'content_Str' => $content_Str,
                'classtype_Str' => $classtype_Str,
                'classtype2_Str' => $classtype2_Str,
                'money_Str' => $money_Str,
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
            $email_name_Str = 'fanswoo';
            $title_Str = $company_Str.'的'.$username_Str.'有一封瘋沃科技的需求單';
            $message_Str = '您好，我們收到一封聯繫單<br>
            <br>客戶姓名： '.$username_Str.
            '<br>公司名稱： '.$company_Str.
            '<br>聯繫電話： '.$phone_Str.
            '<br>電子郵件： '.$email_Str.
            '<br>聯繫地址： '.$address_Str.
            '<br>詢問項目： '.$classtype_Str.
            '<br>項目細節： '.$classtype2_Str.
            '<br>客戶預算： '.$money_Str.
            '<br>需求內容： '.$content_Str.
            '<br><br>填寫時間：'.date('Y-m-d H:i:s').
            '<br><br>後台位置：<a href="http://'.$_SERVER['HTTP_HOST'].base_url().'admin">http://'.$_SERVER['HTTP_HOST'].base_url().'admin</a><br>';

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
                    'url' => $previous_url_Str
                ));
                return FALSE;
            }

            //送出成功訊息
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => 'Setting Success',
                'url' => $previous_url_Str
            ));
        }
        else
        {
            $validation_errors_Str = validation_errors();
            $validation_errors_Str = !empty($validation_errors_Str) ? $validation_errors_Str : 'Setting Error' ;
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => $validation_errors_Str,
                'url' => $previous_url_Str
            ));
        }
    }
}

?>