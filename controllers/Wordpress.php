<?php

class Wordpress_Controller extends MY_controller
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

        $data['previous_url_Str'] = uri_string();

        //global
        $data['global']['style'][] = 'temp/style.css';
        $data['global']['style'][] = 'temp/header_bar.css';
		$data['global']['style'][] = 'temp/footer_bar.css';
        $data['global']['style'][] = 'wordpress/index.css';

        $data['global']['js'][] = 'smooth_scrollerator.js';
        $data['global']['js'][] = 'cycle2.js';
            
        //temp
		$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
		$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
		$data['temp']['header_bar'] = $this->load->view('temp/header_bar', $data, TRUE);
		$data['temp']['footer_bar'] = $this->load->view('temp/footer_bar', $data, TRUE);
		$data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);

        //輸出模板
        $this->load->view('wordpress/index', $data);
    }

    public function order_submit()
    {
        $data['previous_url_Str'] = uri_string();

        $this->form_validation->set_rules('username_Str', '您的姓名', 'required');
        $this->form_validation->set_rules('company_Str', '公司名稱', 'required');
        $this->form_validation->set_rules('phone_Str', '聯繫電話', 'required');
        $this->form_validation->set_rules('email_Str', '電子郵件', 'required');
        $this->form_validation->set_rules('address_Str', '公司地址', 'required');
        $this->form_validation->set_rules('classtype_Str', '主機類型', 'required');
        $this->form_validation->set_rules('years_Num', '訂購期限', 'required');
        $this->form_validation->set_rules('price_Num', '總金額', 'required');

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
            $years_Num = $this->input->post('years_Num', TRUE);
            $price_Num = $this->input->post('price_Num', TRUE);

            //註冊會員帳號
            $password_Str = substr(md5(rand(32767, 65534) + $this->config->item('timenow')), 0, 8);
            
            $User = new User();
            $User->construct_db(array(
                'db_where_Arr' => [
                    'email' => $email_Str
                ]
            ));
            if(empty($User->uid_Num))
            {
                $User = new User();
                $register_status = $User->register(array(
                    'email_Str' => $email_Str,
                    'password_Str' => $password_Str,
                    'password2_Str' => $password_Str
                ));
                if($register_status === TRUE)
                {
                    //寄出電子郵件表示註冊成功，以及登入帳號密碼

                    $website_name_Str = 'FANSWOO';
                    $email_name_Str = 'FANSWOO';
                    $title_Str = $website_name_Str.' - 申請套版網站成功通知';

                    $message_Str = '您好：<br><br>我們收到您申請的訂購通知，特地發送信件予您通知<br><br>註冊帳號：'.$email_Str.'<br>註冊密碼：'.$password_Str.'
                    <br><br>訂購詳細內容為：
                    <br>客戶姓名： '.$username_Str.
                    '<br>公司名稱： '.$company_Str.
                    '<br>聯繫電話： '.$phone_Str.
                    '<br>電子郵件： '.$email_Str.
                    '<br>公司地址： '.$address_Str.
                    '<br>主機類型： '.$classtype_Str.
                    '<br>訂購期限： '.$years_Num.
                    '年<br>總共金額： NT$'.$price_Num.
                    '<br>需求內容： '.$content_Str.
                    '<br>申請時間：'.date('Y-m-d H:i:s').
                    '<br><br>請登入後台網址修改您的新密碼，<br>請於完成ATM轉帳或匯款後於後台填寫付款資訊<br><br>訂單管理後台位置：<br><a href="http://'.$_SERVER['HTTP_HOST'].base_url().'admin/user/order_shop/order_shop/tablelist">http://'.$_SERVER['HTTP_HOST'].base_url().'admin/user/order_shop/order_shop/tablelist</a>';

                    $Mailer = new Mailer;
                    $return_message_Str = $Mailer->sendmail($email_Str, $email_name_Str, $title_Str, $message_Str);
                    if($return_message_Str === TRUE)
                    {
                    }
                    else
                    {
                        //送出訊息
                        $this->load->model('Message');
                        $this->Message->show(array(
                            'message' => 'error(4)：下單失敗，郵件伺服器出錯，請電話與我們聯繫，謝謝',
                            'url' => ''
                        ));
                        return FALSE;
                    }
                }
                else
                {
                    //送出訊息
                    $this->load->model('Message');
                    $this->Message->show(array(
                        'message' => '會員註冊失敗，請填寫其它email帳號',
                        'url' => ''
                    ));
                    return FALSE;
                }
            }
            else
            {
                //寄出電子郵件表示訂購成功
                $website_name_Str = 'FANSWOO';
                $email_name_Str = 'FANSWOO';
                $title_Str = $website_name_Str.' - 申請套版網站成功通知';

                $message_Str = '您好：<br><br>我們收到您申請的訂購通知，特地發送信件予您通知<br><br>您的訂購帳號：'.$email_Str.'
                <br><br>訂購詳細內容為：
                <br>客戶姓名： '.$username_Str.
                '<br>公司名稱： '.$company_Str.
                '<br>聯繫電話： '.$phone_Str.
                '<br>電子郵件： '.$email_Str.
                '<br>公司地址： '.$address_Str.
                '<br>主機類型： '.$classtype_Str.
                '<br>訂購期限： '.$years_Num.
                '年<br>總共金額： NT$'.$price_Num.
                '<br>需求內容： '.$content_Str.
                '<br><br>請於完成ATM轉帳或匯款後於後台填寫付款資訊<br><br>訂單管理後台位置：<br><a href="http://'.$_SERVER['HTTP_HOST'].base_url().'admin/user/order_shop/order_shop/tablelist">http://'.$_SERVER['HTTP_HOST'].base_url().'admin/user/order_shop/order_shop/tablelist</a><br><br>申請時間：'.date('Y-m-d H:i:s');

                $Mailer = new Mailer;
                $return_message_Str = $Mailer->sendmail($email_Str, $email_name_Str, $title_Str, $message_Str);
                if($return_message_Str === TRUE)
                {
                }
                else
                {
                    //送出成功訊息
                    $this->load->model('Message');
                    $this->Message->show(array(
                        'message' => 'error(4)：下單失敗，郵件伺服器出錯，請電話與我們聯繫，謝謝',
                        'url' => ''
                    ));
                    return FALSE;
                }
            }

            //寄出電子郵件給管理者
            $Setting = new Setting();
            $Setting->construct_db([
                'db_where_Arr' => [
                    'keyword_Str' => 'smtp_email'
                ]
            ]);

            $smtp_email_Str = $Setting->value_Str;
            $email_name_Str = 'fanswoo';
            $title_Str = $company_Str.'的'.$username_Str.'申請了套版網站';
            $message_Str = '您好，我們收到套版網站的申請<br>
            <br>客戶姓名： '.$username_Str.
            '<br>公司名稱： '.$company_Str.
            '<br>聯繫電話： '.$phone_Str.
            '<br>電子郵件： '.$email_Str.
            '<br>公司地址： '.$address_Str.
            '<br>主機類型： '.$classtype_Str.
            '<br>訂購期限： '.$years_Num.
            '年<br>總共金額： NT$'.$price_Num.
            '<br>需求內容： '.$content_Str.
            '<br><br>申請時間：'.date('Y-m-d H:i:s').
            '<br><br>後台位置：<a href="http://'.$_SERVER['HTTP_HOST'].base_url().'admin">http://'.$_SERVER['HTTP_HOST'].base_url().'admin</a><br>';

            $Mailer = new Mailer;
            $return_message_Str = $Mailer->sendmail($smtp_email_Str, $email_name_Str, $title_Str, $message_Str);
            if($return_message_Str === TRUE)
            {
                //寄件成功
            }
            else
            {
                //送出訊息
                $this->load->model('Message');
                $this->Message->show(array(
                    'message' => 'error(4)：下單失敗，郵件伺服器出錯，請電話與我們聯繫，謝謝',
                    'url' => $previous_url_Str
                ));
                return FALSE;
            }

            //建構訂單
            $OrderShop = new OrderShop();
            $OrderShop->construct(array(
                'uid_Num' => $User->uid_Num,
                'order_status_Num' => -1,//建構中的訂單
                'status_Num' => 1
            ));
            $OrderShop->update();
            
            $OrderShop->receive_name_Str = $username_Str;
            $OrderShop->receive_address_Str = $address_Str;
            $OrderShop->receive_phone_Str = $phone_Str;
            $OrderShop->receive_time_Str = $receive_time_Str;
            $OrderShop->receive_remark_Str = $receive_remark_Str;
            $OrderShop->pay_paytype_Str = 'atm';
            $OrderShop->order_status_Num = 0;

            $OrderShop->update();

            //建構WordpressOrder物件，並且更新
            $WordpressOrder = new WordpressOrder();
            $WordpressOrder->construct(array(
                'username_Str' => $username_Str,
                'orderid_Num' => $OrderShop->orderid_Num,
                'uid_Num' => $User->uid_Num,
                'company_Str' => $company_Str,
                'phone_Str' => $phone_Str,
                'email_Str' => $email_Str,
                'address_Str' => $address_Str,
                'content_Str' => $content_Str,
                'classtype_Str' => $classtype_Str,
                'years_Num' => $years_Num,
                'price_Num' => $price_Num,
                'status_process_Num' => 1
            ));
            $WordpressOrder->update();

            //送出成功訊息
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '下單成功',
                'url' => 'admin/user/order_shop/order_shop/tablelist'
            ));
        }
        else
        {
            $validation_errors_Str = validation_errors();
            $validation_errors_Str = !empty($validation_errors_Str) ? $validation_errors_Str : '設定錯誤' ;
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => $validation_errors_Str,
                'url' => $previous_url_Str
            ));
        }
    }

}

?>