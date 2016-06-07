<?php

class Contact_Controller extends MY_controller
{
	public function __construct()
    {
        parent::__construct();

        $SettingList = new SettingList();
        $SettingList->construct_db(array(
            'db_where_arr' => array(
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

        $data['previous_url'] = $_SERVER['PHP_SELF'];

        //global
        $data['global']['style'][] = 'temp/global.css';
        $data['global']['style'][] = 'temp/header_bar.css';
		$data['global']['style'][] = 'temp/footer_bar.css';
        $data['global']['style'][] = 'contact/index.css';
        
        $data['global']['js'][] = 'tool/smooth_scrollerator.js';
            
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
        $previous_url = $this->input->post('previous_url');

        $this->form_validation->set_rules('username', '您的姓名', 'required');
        $this->form_validation->set_rules('company', '公司名稱', 'required');
        $this->form_validation->set_rules('phone', '聯繫電話', 'required');
        $this->form_validation->set_rules('email', '電子郵件', 'required');
        $this->form_validation->set_rules('address', '公司地址', 'required');
        // $this->form_validation->set_rules('content', '聯繫內容', 'required');
        $this->form_validation->set_rules('classtype', '詢問項目', 'required');
        // $this->form_validation->set_rules('classtype2', '主要項目', 'required');
        $this->form_validation->set_rules('money', '預算', 'required');

        if ($this->form_validation->run() !== FALSE)
        {
            //基本post欄位
            $username = $this->input->post('username', TRUE);
            $company = $this->input->post('company', TRUE);
            $phone = $this->input->post('phone', TRUE);
            $email = $this->input->post('email', TRUE);
            $address = $this->input->post('address', TRUE);
            $content = $this->input->post('content', TRUE);
            $classtype = $this->input->post('classtype', TRUE);
            $classtype2 = $this->input->post('classtype2', TRUE);
            $money = $this->input->post('money', TRUE);

            //建構Contact物件，並且更新
            $Contact = new ContactFanswoo();
            $Contact->construct(array(
                'username' => $username,
                'company' => $company,
                'phone' => $phone,
                'email' => $email,
                'address' => $address,
                'content' => $content,
                'classtype' => $classtype,
                'classtype2' => $classtype2,
                'money' => $money,
                'status_process' => 1
            ));
            $Contact->update();

            //寄出電子郵件
            $Setting = new Setting();
            $Setting->construct_db([
                'db_where_arr' => [
                    'keyword' => 'smtp_email'
                ]
            ]);

            $email = $Setting->value;
            $email_name = 'fanswoo';
            $title = $company.'的'.$username.'有一封瘋沃科技的需求單';
            $message = '您好，我們收到一封聯繫單<br>
            <br>客戶姓名： '.$username.
            '<br>公司名稱： '.$company.
            '<br>聯繫電話： '.$phone.
            '<br>電子郵件： '.$email.
            '<br>聯繫地址： '.$address.
            '<br>詢問項目： '.$classtype.
            '<br>項目細節： '.$classtype2.
            '<br>客戶預算： '.$money.
            '<br>需求內容： '.$content.
            '<br><br>填寫時間：'.date('Y-m-d H:i:s').
            '<br><br>後台位置：<a href="http://'.$_SERVER['HTTP_HOST'].base_url().'admin">http://'.$_SERVER['HTTP_HOST'].base_url().'admin</a><br>';

            $Mailer = new Mailer;
            $return_message = $Mailer->sendmail($email, $email_name, $title, $message);
            if($return_message === TRUE)
            {
                //寄件成功
            }
            else
            {
                //送出訊息
                $this->load->model('Message');
                $this->Message->show(array(
                    'message' => 'error(4)：Mail Server Error',
                    'url' => $previous_url
                ));
                return FALSE;
            }

            //送出成功訊息
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => 'Setting Success',
                'url' => $previous_url
            ));
        }
        else
        {
            $validation_errors = validation_errors();
            $validation_errors = !empty($validation_errors) ? $validation_errors : 'Setting Error' ;
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => $validation_errors,
                'url' => $previous_url
            ));
        }
    }
}

?>