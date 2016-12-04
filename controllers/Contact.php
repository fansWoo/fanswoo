<?php

class Contact_Controller extends MY_controller
{
	public function __construct()
    {
        parent::__construct();

        $data = $this->data;

        $this->load->helper('form');
        $this->load->library('form_validation');
    }
    
    public function index()
    {
        $data = $this->data;

        //global
        $data['global']['page_title_name'] = '聯繫我們';
        $data['global']['style'][] = 'temp/global.css';
        $data['global']['style'][] = 'temp/header_bar.css';
        $data['global']['style'][] = 'contact/index.css';
        
        $data['global']['js'][] = 'contact_form.js';
            
        //temp
		$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
		$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
		$data['temp']['header_bar'] = $this->load->view('temp/header_bar', $data, TRUE);
		$data['temp']['footer_bar'] = $this->load->view('temp/footer_bar', $data, TRUE);
		$data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);
        $data['loading_page'] = 'contact';

        //輸出模板
        $this->load->view('contact', $data);
    }

    public function contact_post()
    {
        //基本post欄位
        $username = $this->input->post('username', TRUE, '您的姓名', 'required');
        $company = $this->input->post('company', TRUE, '公司名稱', 'required');
        $phone = $this->input->post('phone', TRUE, '聯繫電話', 'required');
        $email = $this->input->post('email', TRUE, '電子郵件', 'required|valid_email');
        $address = $this->input->post('address', TRUE, '公司地址', 'required');
        $content = $this->input->post('content', TRUE, '聯繫內容', 'required');
        $classtype = $this->input->post('classtype', TRUE, '詢問項目', 'required');
        $classtype2 = $this->input->post('classtype2', TRUE, '詢問細節','required');
        $budget_range = $this->input->post('budget_range', TRUE, '預算欄位','required');

        if( !$this->form_validation->check() ) return FALSE;

        //建構Contact物件，並且更新
        $Contact = new ContactFanswoo([
            'username' => $username,
            'company' => $company,
            'phone' => $phone,
            'email' => $email,
            'address' => $address,
            'content' => $content,
            'classtype' => $classtype,
            'classtype2' => $classtype2,
            'budget_range' => $budget_range,
            'status_process' => 1
        ]);
        $Contact->update();

        //寄出電子郵件
        $Setting = new Setting([
            'db_where_arr' => [
                'keyword' => 'smtp_email'
            ]
        ]);

        $smtp_email = $Setting->value;
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
        '<br>客戶預算： '.$budget_range.
        '<br>需求內容： '.$content.
        '<br><br>填寫時間：'.date('Y-m-d H:i:s').
        '<br><br>後台位置：<a href="http://'.$_SERVER['HTTP_HOST'].base_url().'admin">http://'.$_SERVER['HTTP_HOST'].base_url().'admin</a><br>';

        $Mailer = new Mailer;
        $return_message = $Mailer->sendmail($smtp_email, $email_name, $title, $message);
        if($return_message === TRUE)
        {
            //寄件成功
        }
        else
        {
            //送出訊息
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '聯繫單已送出，郵件系統忙碌中...'
            ));
            return FALSE;
        }

        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '寄件成功',
            'js' => "fbq('track', 'Lead');"
        ]);
    }
}

?>