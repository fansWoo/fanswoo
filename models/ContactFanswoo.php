<?php

class ContactFanswoo extends Contact
{

    public $contactid = 0;
    public $uid = 0;
    public $username = '';
    public $email = '';
    public $phone = '';
    public $content = '';
    public $classtype = '';
    public $company = '';
    public $address = '';
    public $classtype2 = '';
    public $money = '';
    public $status_process = 0;
    public $updatetime_DateTime;
    public $status = 1;
    public $db_name = 'contact';//填寫物件聯繫資料庫之名稱
    public $db_uniqueid = 'contactid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'contactid' => 'contactid',
        'username' => 'username',
        'email' => 'email',
        'phone' => 'phone',
        'content' => 'content',
        'classtype' => 'classtype',
        'company' => 'company',
        'address' => 'address',
        'classtype2' => 'classtype2',
        'money' => 'money',
        'status_process' => 'status_process',
        'updatetime' => array('updatetime_DateTime', 'datetime'),
        'status' => 'status'
    );
	
	public function construct($arg)
	{
        parent::construct($arg);
        //引入引數並將空值的變數給予空值
        reset_null_arr($arg, ['contactid', 'uid', 'username', 'email', 'phone', 'content', 'classtype', 'company', 'address', 'classtype2', 'money','updatetime', 'updatetime_inputtime_date', 'updatetime_inputtime_time', 'status']);
        foreach($arg as $key => $value) ${$key} = $arg[$key];
        
        //將引數設為物件屬性，或將引數作為物件型屬性的建構值
        $this->set('contactid', $contactid);
        $this->set('uid', $uid);
        $this->set('username', $username);
        $this->set('email', $email);
        $this->set('phone', $phone);
        $this->set('content', $content);
        $this->set('classtype', $classtype);
        $this->set('company', $company);
        $this->set('address', $address);
        $this->set('classtype2', $classtype2);
        $this->set('money', $money);
        $this->set('status_process', $status_process);
        $this->set('status', $status);
        $this->set('updatetime_DateTime', [
            'datetime' => $updatetime,
            'inputtime_date' => $updatetime_inputtime_date,
            'inputtime_time' => $updatetime_inputtime_time
        ], 'DateTimeObj');
        $this->set__uid(['uid' => $uid]);
        
        return TRUE;
    }

    public function set__uid($arg)
    {
        //引入引數並將空值的變數給予空值
        reset_null_arr($arg, ['uid']);
        foreach($arg as $key => $value) ${$key} = $arg[$key];

        //若uid為空則以登入者uid作為本物件之預設uid
        if(empty($uid) || empty($uid))
        {
            $data['user'] = get_user();
            $uid = $data['user']['uid'];
        }

        $this->uid = $uid;
    }
    
}