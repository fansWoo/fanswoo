<?php

class User extends ObjDbBase
{
    public $db_name_arr = ['user'];//填寫物件聯繫資料庫之名稱
    public $db_uniqueid = 'uid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_arr = [//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'uid' => 'uid',
        'username' => 'username',
        'email' => 'email',
        'picids' => ['pic_PicObjList', 'uniqueids'],
        'groupids' => ['group_UserGroupList', 'uniqueids'],
        'updatetime' => ['updatetime_DateTime', 'datetime'],
        'status' => 'status'
    ];
	
	public function construct($arg = [])
	{
        $groupids = !empty($arg['groupids']) ? $arg['groupids'] : '';
        $groupids_arr = !empty($arg['groupids_arr']) ? $arg['groupids_arr'] : array();
        
        //建立UserGroupList物件
        check_comma_array($groupids, $groupids_arr);
        $group_UserGroupList = new ObjList([
            'db_where_arr' => [
                'groupid in' => $groupids_arr
            ],
            'obj_class' => 'UserGroup',
            'limitstart' => 0,
            'limitcount' => 100
        ]);
        
        //將建構方法所計算出的值存入此類別之屬性
        $this->group_UserGroupList = $group_UserGroupList;
        $this->set('uid', $arg['uid']);
        $this->set('username', $arg['username']);
        $this->set('email', $arg['email']);
        $this->set('updatetime_DateTime', [
            'datetime' => $arg['updatetime'],
            'inputtime_date' => $arg['updatetime_inputtime_date'],
            'inputtime_time' => $arg['updatetime_inputtime_time']
        ], 'DateTimeObj');
        $this->set('pic_PicObjList', [
            'picids' => $arg['picids'],
            'picids_arr' => $arg['picids_arr']
        ], 'PicObjList');
        $this->set__status(['status' => $arg['status']]);
        
        return TRUE;
    }

    public function register($arg)
    {
        $email = !empty($arg['email']) ? $arg['email'] : '';
        $password = !empty($arg['password']) ? $arg['password'] : '';
        $password2 = !empty($arg['password2']) ? $arg['password2'] : '';

        if($password !== $password2)
        {
            return 'Please enter the password twice to confirm agreement';
        }

        if(!preg_match("/^([0-9A-Za-z]+)$/", $password))
        {
            return 'Please enter a password consisting of letters and numbers';
        }

        if(strlen($password) < 8 || strlen($password) > 16)
        {
            return 'Please enter a password of 8-16 characters';
        }

        if(!preg_match('/^([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})$/', $email))
        {
            return 'Please enter a valid email format';
        }

        $email_arr = explode('@', $email);
        if(!checkdnsrr($email_arr[1], 'MX'))
        {
            return 'Please enter the correct domain';
        }
        
        $this->db->from('user_verification');
        $this->db->where(array('email' => $email));
        $query = $this->db->get();
            
        if($query->num_rows() > 0)
        {
            return 'This account has been registered';
        }

        $password_salt = substr(md5(rand(32767, 65534) + $this->config->item('timenow')), 0, 6);
        $password_md5 = $this->md5_password($password, $password_salt);

        $updatetime_DateTimeObj = new DateTimeObj();
        $updatetime_DateTimeObj->construct(array());

        $uid = db_search_max(array(
            'table_name' => 'user',
            'id_name' => 'uid'
        )) + 1;

        $this->db->insert('user_verification', array(
            'uid' => $uid,
            'email' => $email,
            'password' => $password_md5,
            'password_salt' => $password_salt,
            'password_key' => $password,
        ));

        $this->db->insert('user', array(
            'uid' => $uid,
            'email' => $email,
            'username' => $email,
            'groupids' => '100',
            'picids' => '',
            'updatetime' => $updatetime_DateTimeObj->datetime,
            'status' => 1
        ));

        $shop_user_register_get_coupon_count_Setting = new Setting();
        $shop_user_register_get_coupon_count_Setting->construct_db([
            'db_where_arr' => [
                'keyword' => 'shop_user_register_get_coupon_count'
            ]
        ]);

        $UserFieldShop = new UserFieldShop();
        $UserFieldShop->construct_db([
            'db_where_arr' => [
                'user.uid' => $uid
            ]
        ]);
        $UserFieldShop->set('coupon_count', $UserFieldShop->coupon_count + $shop_user_register_get_coupon_count_Setting->value);
        $UserFieldShop->update([
            'db_update_arr' => ['user_field_shop.coupon_count']
        ]);

        $this->login(array('email' => $email, 'password' => $password));

        return TRUE;
    }

    public function add($arg)
    {
        $email = !empty($arg['email']) ? $arg['email'] : '';
        $password = !empty($arg['password']) ? $arg['password'] : '';
        $password2 = !empty($arg['password2']) ? $arg['password2'] : '';

        if($password !== $password2)
        {
            return '請重複輸入相同密碼';
        }

        if(!preg_match("/^([0-9A-Za-z]+)$/", $password))
        {
            return '密碼須為英文或數字';
        }

        if(strlen($password) < 8 || strlen($password) > 16)
        {
            return '密碼長度請介於 8-16 字元';
        }

        if(!preg_match('/^([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})$/', $email))
        {
            return '請輸入正確的E-mail';
        }

        $email_arr = explode('@', $email);
        if(!checkdnsrr($email_arr[1], 'MX'))
        {
            return '請輸入正確的E-mail';
        }
        
        $this->db->from('user_verification');
        $this->db->where(array('email' => $email));
        $query = $this->db->get();
            
        if($query->num_rows() > 0)
        {
            return '此帳號已被註冊';
        }

        $password_salt = substr(md5(rand(32767, 65534) + $this->config->item('timenow')), 0, 6);
        $password_md5 = $this->md5_password($password, $password_salt);

        $updatetime_DateTimeObj = new DateTimeObj();
        $updatetime_DateTimeObj->construct(array());

        $uid = db_search_max(array(
            'table_name' => 'user',
            'id_name' => 'uid'
        )) + 1;

        $this->db->insert('user_verification', array(
            'uid' => $uid,
            'email' => $email,
            'password' => $password_md5,
            'password_salt' => $password_salt,
            'password_key' => $password,
        ));

        $this->db->insert('user', array(
            'uid' => $uid,
            'email' => $email,
            'username' => $email,
            'groupids' => '100',
            'picids' => '',
            'updatetime' => $updatetime_DateTimeObj->datetime,
            'status' => 1
        ));

        $shop_user_register_get_coupon_count_Setting = new Setting();
        $shop_user_register_get_coupon_count_Setting->construct_db([
            'db_where_arr' => [
                'keyword' => 'shop_user_register_get_coupon_count'
            ]
        ]);

        $UserFieldShop = new UserFieldShop();
        $UserFieldShop->construct_db([
            'db_where_arr' => [
                'user.uid' => $uid
            ]
        ]);
        $UserFieldShop->set('coupon_count', $UserFieldShop->coupon_count + $shop_user_register_get_coupon_count_Setting->value);
        $UserFieldShop->update([
            'db_update_arr' => ['user_field_shop.coupon_count']
        ]);

        return TRUE;
    }
	
	public function login($arg)
    {
	
		$email = !empty($arg['email']) ? $arg['email'] : '';
        $password = !empty($arg['password']) ? $arg['password'] : '';

        //USER 物件陣列
        $this->db->from('user');
        $this->db->where(array('email' => $email, 'status'=>1));
        $query = $this->db->get();
        $use_arr = $query->result_array();
        
        if(empty($use_arr)){
        	return '這個電子郵件尚未註冊或被註銷，請先註冊會員或連繫管理人員';
        }
        
        $this->db->from('user_verification');
        $this->db->where(array('email' => $email));
        $query = $this->db->get();
        $user_test_arr = $query->result_array();

        if(!empty($user_test_arr))
        {
            $password = $this->md5_password($password, $user_test_arr[0]['password_salt']);
        }
        else
        {
            return '這個電子郵件尚未註冊，請先註冊帳號';
        }
		
		$this->db->from('user_verification');
		$this->db->where(array('email' => $email, 'password' => $password));
		$query = $this->db->get();
			
		if($query->num_rows() > 0)
		{
			$user = $query->result_array();
			$newdata = array(
				'uid'  => $user[0]['uid']
			);
			$this->session->set_userdata($newdata);

            $this->construct(['uid' => $user[0]['uid']]);

			return TRUE;
		}
        else
		{
			return '請輸入正確的密碼';
		}
		
	}

    public function login_facebook($arg)
    {
        
    }

    public function email_reset_password($arg)
    {
        $password = !empty($arg['password']) ? $arg['password'] : '';
        $password2 = !empty($arg['password2']) ? $arg['password2'] : '';
        $change_email_key = !empty($arg['change_email_key']) ? $arg['change_email_key'] : '';

        $email = $this->email;

        $this->db->from('user_verification');
        $this->db->where(array('email' => $email, 'change_email_key' => $change_email_key));
        $this->db->where('change_email_updatetime >', 'DATE_ADD(NOW(), INTERVAL -1 HOUR)', FALSE);
        $query = $this->db->get();
        $user_test_arr = $query->result_array();

        if(!empty($user_test_arr[0]['change_email_key']) && $user_test_arr[0]['change_email_key'] === $change_email_key)
        {
            $return_message = $this->change_password([
                'password' => $password,
                'password2' => $password2
            ]);
			//表單驗證沒問題 才需要清空
			if($return_message===true){
				$this->db->where('email', $email);
				$this->db->update('user_verification', array(
						'change_email_key' => NULL,
						'change_email_updatetime' => NULL
				));
			}
            
            return $return_message;
        }
        else
        {
            return '信箱驗證碼填寫錯誤，請從信箱輸入正確的驗證碼，若驗證碼已經超過一個小時的有效期限，請重新申請信箱驗證碼';
        }

    }

    public function change_password($arg)
    {
        $password = !empty($arg['password']) ? $arg['password'] : '';
        $password2 = !empty($arg['password2']) ? $arg['password2'] : '';

        if($password !== $password2)
        {
            return 'Please enter the password twice to confirm agreement';
        }

        if(!preg_match("/^([0-9A-Za-z]+)$/", $password))
        {
            return 'Please enter a password consisting of letters and numbers';
        }

        if(strlen($password) < 8 || strlen($password) > 16)
        {
            return 'Please enter a password of 8-16 characters';
        }

        $password_salt = substr(md5(rand(32767, 65534) + $this->config->item('timenow')), 0, 6);
        $password_md5 = $this->md5_password($password, $password_salt);

        $this->db->where('uid', $this->uid);
        $this->db->update('user_verification', array(
            'password' => $password_md5,
            'password_salt' => $password_salt
        ));

        $this->db->where('uid', $this->uid);
        $this->db->update('user_verification', array('password_key' => $password));

        return TRUE;
    }

    public function send_change_password_email()
    {
        $email = $this->email;

        $this->db->from('user_verification');
        $this->db->where(array('email' => $email));
        $query = $this->db->get();
        $user_test_arr = $query->result_array();

        if(empty($user_test_arr[0]['uid']))
        {
            return '沒有這個email帳號，請輸入正確的email帳號';
        }

        $this->db->from('user_verification');
        $this->db->where('email', $email);
        $this->db->where('change_email_updatetime >', 'DATE_ADD(NOW(), INTERVAL -1 HOUR)', FALSE);
        $query = $this->db->get();
        $user_arr = $query->result_array();

        if(!empty($user_arr[0]['uid']))
        {
            return '這個帳號在一個小時內已經寄出過重設密碼的請求，請檢查信箱內的重設密碼信件，或於一個小時後再重新嘗試';
        }

        $change_email_key = strtoupper(substr(md5(rand(32767, 65534) + $this->config->item('timenow')), 0, 6));
        $change_email_DateTimeObj = new DateTimeObj();
        $change_email_DateTimeObj->construct([]);

        $this->db->where('email', $email);
        $this->db->update('user_verification', array(
            'change_email_key' => $change_email_key,
            'change_email_updatetime' => $change_email_DateTimeObj->datetime
        ));

        $this->db->from('user');
        $this->db->where('email', $email);
        $query = $this->db->get();
        $user_arr = $query->result_array();

        $website_name = 'fanswoo';
        $name = 'fanswoo';
        $title = $website_name.' - 密碼變更通知';
        $message = $user_arr[0]['username'].'您好：<br><br>我們收到您於'.$website_name.'申請的密碼變更通知，特地發送信件予您通知<br>您可以點選以下網址並填寫信箱驗證碼，以便修改您的新密碼<br><br>信箱驗證碼：'.$change_email_key.'<br>密碼變更位置：<br>'.'http://'.$_SERVER['HTTP_HOST'].base_url('/user/resetpsw/?').'email='.$email.'&change_email_key='.$change_email_key.'<br><br>若您未申請密碼變更，請直接忽略此郵件即可<br><br>'.date('Y-m-d H:i:s');

        $Mailer = new Mailer;
        $return_message = $Mailer->sendmail($email, $name, $title, $message);
        if($return_message === TRUE)
        {
            return TRUE;
        }
        else
        {
            return $return_message;
        }

    }

    public function check_verify_code($arg)
    {
        //確認驗證碼是不是正確
    }

    public function valid_register()
    {
        //隨機產生認證碼
        $verify_code = substr(md5(rand(32767, 65534) + $this->config->item('timenow')), 0, 4);
        $this->set('verify_code', $verify_code);
        $this->set('status', -1);
        
        $website_name_Setting = new Setting([
            'db_where_arr' => [
                'keyword' => 'website_name'
            ]
        ]);
        $title = $website_name_Setting->value.' - 註冊確認信';
        $email_url = urlencode($this->email);
        $verify_url = 'http://'.$_SERVER['HTTP_HOST'].base_url('/user/login/?').'email='.$email_url.'&verify_code='.$verify_code;
        $message = $this->username.'您好：<br><br>感謝您註冊'.$website_name_Setting->value.'的會員，特地發送信件做帳號驗證<br>您可以點選以下網址，以便開通您的帳號<br><br>帳號開通位置：<br>'.$verify_url.'<br><br>'.date('Y-m-d H:i:s');
        
        $Mailer = new Mailer;
        $return_message = $Mailer->sendmail($email, $website_name_Setting->value, $title, $message);
        
        if($return_message === TRUE)
        {
            return TRUE;
        }
        else
        {
            return $return_message;
        }

        $this->update();
    }

    private function md5_password($arg1, $arg2 = '')
    {
        $password = $arg1;
        $password_salt = $arg2;
        $md5_password = md5(md5($password).$password_salt);

        return $md5_password;
    }

    public function destroy()
    {
        parent::destroy();

        $this->db->where(array(
            'uid' => $this->get('uid')
        ));

        $this->db->delete('user_verification');

        $this->db->where(array(
            'uid' => $this->get('uid')
        ));

        $this->db->delete('user_field_shop');

    }
	
}