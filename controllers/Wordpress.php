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

        $data['previous_url'] = base_url($_SERVER['REQUEST_URI']);

        //global
        $data['global']['style'][] = 'temp/global.css';
        $data['global']['style'][] = 'temp/header_bar.css';
		$data['global']['style'][] = 'temp/footer_bar.css';
        $data['global']['style'][] = 'wordpress/index.css';

        $data['global']['js'][] = 'tool/smooth_scrollerator.js';
        $data['global']['js'][] = 'tool/cycle2.js';
            
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
        $data['previous_url'] = base_url($_SERVER['REQUEST_URI']);

        $this->form_validation->set_rules('username', '您的姓名', 'required');
        $this->form_validation->set_rules('company', '公司名稱', 'required');
        $this->form_validation->set_rules('phone', '聯繫電話', 'required');
        $this->form_validation->set_rules('email', '電子郵件', 'required');
        $this->form_validation->set_rules('address', '公司地址', 'required');
        $this->form_validation->set_rules('classtype', '主機類型', 'required');
        $this->form_validation->set_rules('years', '訂購期限', 'required');
        $this->form_validation->set_rules('price', '總金額', 'required');

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
            $years = $this->input->post('years', TRUE);
            $price = $this->input->post('price', TRUE);

            //註冊會員帳號
            $password = substr(md5(rand(32767, 65534) + $this->config->item('timenow')), 0, 8);
            
            $User = new User();
            $User->construct_db(array(
                'db_where_arr' => [
                    'email' => $email
                ]
            ));
            if(empty($User->uid))
            {
                $User = new User();
                $register_status = $User->register(array(
                    'email' => $email,
                    'password' => $password,
                    'password2' => $password
                ));
                if($register_status === TRUE)
                {
                    //寄出電子郵件表示註冊成功，以及登入帳號密碼

                    $website_name = 'FANSWOO';
                    $email_name = 'FANSWOO';
                    $title = $website_name.' - 申請套版網站成功通知';

                    $message = '您好：<br><br>我們收到您申請的訂購通知，特地發送信件予您通知<br><br>註冊帳號：'.$email.'<br>註冊密碼：'.$password.'
                    <br><br>訂購詳細內容為：
                    <br>客戶姓名： '.$username.
                    '<br>公司名稱： '.$company.
                    '<br>聯繫電話： '.$phone.
                    '<br>電子郵件： '.$email.
                    '<br>公司地址： '.$address.
                    '<br>主機類型： '.$classtype.
                    '<br>訂購期限： '.$years.
                    '年<br>總共金額： NT$'.$price.
                    '<br>需求內容： '.$content.
                    '<br>申請時間：'.date('Y-m-d H:i:s').
                    '<br><br>請登入後台網址修改您的新密碼，<br>請於完成ATM轉帳或匯款後於後台填寫付款資訊<br><br>訂單管理後台位置：<br><a href="http://'.$_SERVER['HTTP_HOST'].base_url().'admin/user/order_shop/order_shop/tablelist">http://'.$_SERVER['HTTP_HOST'].base_url().'admin/user/order_shop/order_shop/tablelist</a>';

                    $Mailer = new Mailer;
                    $return_message = $Mailer->sendmail($email, $email_name, $title, $message);
                    if($return_message === TRUE)
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
                $website_name = 'FANSWOO';
                $email_name = 'FANSWOO';
                $title = $website_name.' - 申請套版網站成功通知';

                $message = '您好：<br><br>我們收到您申請的訂購通知，特地發送信件予您通知<br><br>您的訂購帳號：'.$email.'
                <br><br>訂購詳細內容為：
                <br>客戶姓名： '.$username.
                '<br>公司名稱： '.$company.
                '<br>聯繫電話： '.$phone.
                '<br>電子郵件： '.$email.
                '<br>公司地址： '.$address.
                '<br>主機類型： '.$classtype.
                '<br>訂購期限： '.$years.
                '年<br>總共金額： NT$'.$price.
                '<br>需求內容： '.$content.
                '<br><br>請於完成ATM轉帳或匯款後於後台填寫付款資訊<br><br>訂單管理後台位置：<br><a href="http://'.$_SERVER['HTTP_HOST'].base_url().'admin/user/order_shop/order_shop/tablelist">http://'.$_SERVER['HTTP_HOST'].base_url().'admin/user/order_shop/order_shop/tablelist</a><br><br>申請時間：'.date('Y-m-d H:i:s');

                $Mailer = new Mailer;
                $return_message = $Mailer->sendmail($email, $email_name, $title, $message);
                if($return_message === TRUE)
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
                'db_where_arr' => [
                    'keyword' => 'smtp_email'
                ]
            ]);

            $smtp_email = $Setting->value;
            $email_name = 'fanswoo';
            $title = $company.'的'.$username.'申請了套版網站';
            $message = '您好，我們收到套版網站的申請<br>
            <br>客戶姓名： '.$username.
            '<br>公司名稱： '.$company.
            '<br>聯繫電話： '.$phone.
            '<br>電子郵件： '.$email.
            '<br>公司地址： '.$address.
            '<br>主機類型： '.$classtype.
            '<br>訂購期限： '.$years.
            '年<br>總共金額： NT$'.$price.
            '<br>需求內容： '.$content.
            '<br><br>申請時間：'.date('Y-m-d H:i:s').
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
                    'message' => 'error(4)：下單失敗，郵件伺服器出錯，請電話與我們聯繫，謝謝',
                    'url' => $previous_url
                ));
                return FALSE;
            }

            //建構訂單
            $OrderShop = new OrderShop();
            $OrderShop->construct(array(
                'uid' => $User->uid,
                'order_status' => -1,//建構中的訂單
                'status' => 1
            ));
            $OrderShop->update();
            
            $OrderShop->receive_name = $username;
            $OrderShop->receive_address = $address;
            $OrderShop->receive_phone = $phone;
            $OrderShop->receive_time = $receive_time;
            $OrderShop->receive_remark = $receive_remark;
            $OrderShop->pay_paytype = 'atm';
            $OrderShop->order_status = 0;

            $OrderShop->update();

            //建構WordpressOrder物件，並且更新
            $WordpressOrder = new WordpressOrder();
            $WordpressOrder->construct(array(
                'username' => $username,
                'orderid' => $OrderShop->orderid,
                'uid' => $User->uid,
                'company' => $company,
                'phone' => $phone,
                'email' => $email,
                'address' => $address,
                'content' => $content,
                'classtype' => $classtype,
                'years' => $years,
                'price' => $price,
                'status_process' => 1
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
            $validation_errors = validation_errors();
            $validation_errors = !empty($validation_errors) ? $validation_errors : '設定錯誤' ;
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => $validation_errors,
                'url' => $previous_url
            ));
        }
    }

}

?>