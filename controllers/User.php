<?php

class User_Controller extends MY_Controller
{

	private $next_url = 'admin';
	
	public function index()
	{
		$url = base_url('user/login');
		header('Location: '.$url);
	}
	
	public function logout()
	{
		$data = $this->data;

		$this->session->unset_userdata('uid');
		$url = 'user/login';

		if( empty($data['global']['message_show']['content']) )
		{
			$message = '登出成功';
		}
		else
		{
			$message = $data['global']['message_show']['content'];
		}
		
		$this->load->model('Message');
		$this->Message->show([
			'message' => $message,
			'url' => $url,
			'return_type' => 'page' 
		]);
	}
	
	//註冊會員
	public function register()
	{
        $data = $this->data;

		if(!empty($data['User']->uid))
		{
			$url = base_url($this->next_url);
			header('Location: '.$url);
		}
		$data['google_recaptcha_Setting'] = new Setting([
			'db_where_arr' => [
				'keyword' => 'google_recaptcha'
			]
		]);
		
		//view data設定
		$data['validation_errors'] = validation_errors();
		$data['page'] = 'user';
        

        $data['global']['style'][] = 'user/user.css';
        
        //temp
		$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
		$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
		$data['temp']['header_bar'] = $this->load->view('temp/header_bar', $data, TRUE);
		$data['temp']['footer_bar'] = $this->load->view('temp/footer_bar', $data, TRUE);
		
		//輸出模板
		$this->load->view('user/register.php', $data);
	}

	public function check_verify_code()
	{
		$email = $this->input->get('email');
		$verify_code = $this->input->get('verify_code');

		$User = new User;
		$check_bln = $User->check_verify_code([ // $User->status = 1;
			'email' => $email,
			'verify_code' => $verify_code
		]);
		
		if( $check_bln == TRUE)
		{
			$this->load->model('Message');
			$this->Message->show([
				'message' => '驗證成功',
				'url' => 'user/login'
			]);
			return TRUE;
		}
		else
		{
			$this->load->model('Message');
			$this->Message->show([
				'message' => '驗證碼錯誤',
				'url' => 'user/register'
			]);
			return FALSE;
		}
	}
	
	public function register_post()
	{
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('password', '密碼', 'required');
		$this->form_validation->set_rules('password2', '密碼', 'required');

		//google 驗證
        $google_recaptcha_Setting = new Setting(['keyword' => 'google_recaptcha']);
		if( !empty( $google_recaptcha_Setting->value ) )
		{
			$google_url = "https://www.google.com/recaptcha/api/siteverify";
			$privateKey = "6LfvihsTAAAAAMpigjytJGAPdfgjKrK98Zk3NUt4";//私人鑰匙要到google申請
			$google_url = $google_url."?secret=".$privateKey."&response=".$this->input->post('g-recaptcha-response')."&remoteip=".$_SERVER['REMOTE_ADDR'];
			//呼叫GOOGLE API
			$resbonse = file_get_contents($google_url);
			$resbonse_Json = json_decode($resbonse);
			if ( empty($resbonse_Json->success) )
			{
				$this->load->model('Message');
				$this->Message->show([
					'message' => 'google驗證失敗'
				]);
				return FALSE;
			}
		}
		
		if ($this->form_validation->run() !== FALSE)
		{
			$email = $this->input->post('email', TRUE);
			$password = $this->input->post('password', TRUE);
			$password2 = $this->input->post('password2', TRUE);

			$User = new User();
			$register_status = $User->register(array(
				'email' => $email,
				'password' => $password,
				'password2' => $password2
			));
			if( !empty( $google_recaptcha_Setting->value ) )
			{
				$User->valid_register();
			}

			if($register_status === TRUE)
			{
				$url = $this->next_url;
				$message = "註冊成功";
				
				$this->load->model('Message');
				$this->Message->show(array('message' => $message, 'url' => $url));
			}
			else
			{
				$url = 'user/register';
				$message = $register_status;
				
				$this->load->model('Message');
				$this->Message->show(array('message' => $message, 'url' => $url));
			}
		}
		else
		{
			$url = 'user/register';
			$message = validation_errors();
			
			$this->load->model('Message');
			$this->Message->show(array('message' => $message, 'url' => $url));
		}
	}
	
	public function login()
	{
        $data = $this->data;

		if(!empty($data['User']->uid))
		{
			$url = base_url($this->next_url);
			header('Location: '.$url);
		}
		
		$data['no_rewrite'] = $this->input->get('no_rewrite');

        $data['url'] = $this->input->get('url');
        $data['global']['style'][] = 'user/user.css';
            
        //temp
		$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
		$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
		$data['temp']['header_bar'] = $this->load->view('temp/header_bar', $data, TRUE);
		$data['temp']['footer_bar'] = $this->load->view('temp/footer_bar', $data, TRUE);
				
		//輸出模板
		$this->load->view('user/login', $data);
	}
	
	public function login_post()
	{
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('password', '密碼', 'required');
		if( !$this->form_validation->check() ) return FALSE;
		
		$url = $this->input->post('url', TRUE);
		$email = $this->input->post('email', TRUE);
		$password = $this->input->post('password', TRUE);

		$User = new User();
		$login_status = $User->login(array(
			'email' => $email,
			'password' => $password
		));

		if($login_status === TRUE)
		{
			if(empty($url))
			{
				$url = $this->next_url;
			}

			$message = "登入成功";
			
			$this->load->model('Message');
			$this->Message->show(array('message' => $message, 'url' => $url));
		}
		else
		{
			$url = 'user/login';
			$message = $login_status;
				
			$this->load->model('Message');
			$this->Message->show(array('message' => $message, 'url' => $url));
		}
	}
	
	//忘記密碼
	public function forgetpsw()
	{
        $data = $this->data;
        
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		//view data設定
		$data['validation_errors'] = validation_errors();
		$data['page'] = 'user';
        

        $data['global']['style'][] = 'user/user.css';
        
        //temp
		$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
		$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
		$data['temp']['header_bar'] = $this->load->view('temp/header_bar', $data, TRUE);
		$data['temp']['footer_bar'] = $this->load->view('temp/footer_bar', $data, TRUE);
		
		//輸出模板
		$this->load->view('user/forgetpsw.php', $data);
	}
	
	//忘記密碼
	public function forgetpsw_post()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('email', 'email', 'required');
		
		if($this->form_validation->run() !== FALSE)
		{
			$email = $this->input->post('email', TRUE);

			$User = new User([
				'db_where_arr' => [
					'email' => $email
				]
			]);
			$return_message = $User->send_change_password_email();

			if($return_message === TRUE)
			{
				$url = 'user/login';
				$message = '請至信箱收取信件，並重新登入';
				
				$this->load->model('Message');
				$this->Message->show(array('message' => $message, 'url' => $url));
			}
			else
			{
				$url = 'user/forgetpsw';
				$message = $return_message;
				
				$this->load->model('Message');
				$this->Message->show(array('message' => $message, 'url' => $url, 'second' => 6));
			}
		}
		else
		{
			$url = 'user/forgetpsw';
			$message = validation_errors();
			
			$this->load->model('Message');
			$this->Message->show(array('message' => $message, 'url' => $url));
		}
	}
	
	public function resetpsw()
	{
		//使用由email收到的的email_key進行驗證，若驗證成功即可更改密碼
        $data = $this->data;

        $data['email'] = $this->input->get('email');
        $data['change_email_key'] = $this->input->get('change_email_key');
        
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		//view data設定
		$data['validation_errors'] = validation_errors();
		$data['page'] = 'user';
        

        $data['global']['style'][] = 'user/user.css';
        
        //temp
		$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
		$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
		$data['temp']['header_bar'] = $this->load->view('temp/header_bar', $data, TRUE);
		$data['temp']['footer_bar'] = $this->load->view('temp/footer_bar', $data, TRUE);
		
		//輸出模板
		$this->load->view('user/resetpsw', $data);

	}

	public function resetpsw_post()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('change_email_key', 'email key', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');
		$this->form_validation->set_rules('password2', 'password', 'required');

		$email = $this->input->post('email', TRUE);
		$change_email_key = $this->input->post('change_email_key', TRUE);
		$password = $this->input->post('password', TRUE);
		$password2 = $this->input->post('password2', TRUE);
		
		if($this->form_validation->run() !== FALSE)
		{
			$User = new User([
				'db_where_arr' => [
					'email' => $email
				]
			]);
			$return_message = $User->email_reset_password([
				'password' => $password,
				'password2' => $password2,
				'change_email_key' => $change_email_key
			]);

			if($return_message === TRUE)
			{
				$url = 'user/login';
				$message = '密碼變更成功，請重新登入';
				
				$this->load->model('Message');
				$this->Message->show(array('message' => $message, 'url' => $url));
			}
			else
			{
				$url = 'user/resetpsw/?email='.$email.'&change_email_key='.$change_email_key;
				$message = $return_message;
				
				$this->load->model('Message');
				$this->Message->show(array('message' => $message, 'url' => $url, 'second' => 6));
			}
		}
		else
		{
			$url = 'user/resetpsw/?email='.$email.'&change_email_key='.$change_email_key;
			$message = validation_errors();
			
			$this->load->model('Message');
			$this->Message->show(array('message' => $message, 'url' => $url));
		}
	}
	
}

?>