<?php

class Project extends ObjDbBase
{

    public $projectid_Num = 0;
    public $uid_Num = 0;
    public $name_Str = '';
    public $admin_uid_Num = '';
    public $permission_uids_UserList = '';
    public $working_days_Num = 0;
    public $class_ClassMetaList;
    public $designids_Str = '';
    public $pay_name_Str = '';
    public $pay_account_Str = '';
    public $pay_price_total_Num = 0;
    public $pay_price_receive_Num = 0;
    public $pay_price_schedule_Num = 0;
    public $pay_remark_Str = '';
    public $pay_status_Num = 0;
    public $paycheck_status_Num = 0;
    public $project_status_Num = 1;
    public $pay_paytime_DateTimeObj;
    public $setuptime_DateTimeObj;
    public $updatetime_DateTimeObj;
    public $status_Num = 1;
    public $db_name_Str = 'project';//填寫物件聯繫資料庫之名稱
    public $db_uniqueid_Str = 'projectid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_Arr = [//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'projectid' => 'projectid_Num',
        'uid' => 'uid_Num',
        'name' => 'name_Str',
        'admin_uid' => 'admin_uid_Num',
        'permission_uids' => ['permission_uids_UserList', 'uniqueids_Str'],
        'working_days' => 'working_days_Num',
        'classids' => array('class_ClassMetaList', 'uniqueids_Str'),
        'designids' => 'designids_Str',
        'pay_name' => 'pay_name_Str',
        'pay_account' => 'pay_account_Str',
        'pay_price_total' => 'pay_price_total_Num',
        'pay_price_receive' => 'pay_price_receive_Num',
        'pay_price_schedule' => 'pay_price_schedule_Num',
        'pay_remark' => 'pay_remark_Str',
        'pay_status' => 'pay_status_Num',
        'paycheck_status' => 'paycheck_status_Num',
        'project_status' => 'project_status_Num',
        'pay_paytime' => array('pay_paytime_DateTimeObj', 'datetime_Str'),
        'setuptime' => array('setuptime_DateTimeObj', 'datetime_Str'),
        'updatetime' => array('updatetime_DateTimeObj', 'datetime_Str'),
        'status' => 'status_Num'
    ];
	
	public function construct($arg)
	{

        $permission_uids_Str = !empty($arg['permission_uids_Str']) ? $arg['permission_uids_Str'] : '' ;
        $permission_emails_Str = !empty($arg['permission_emails_Str']) ? $arg['permission_emails_Str'] : '' ;
        $this->set__permission_uids_UserList([
            'permission_uids_Str' => $permission_uids_Str,
            'permission_emails_Str' => $permission_emails_Str
        ]);
        $this->set('projectid_Num', $arg['projectid_Num']);
        $this->set('uid_Num', $arg['uid_Num']);
        $this->set('name_Str', $arg['name_Str']);
        $this->set('admin_uid_Num', $arg['admin_uid_Num']);
        $this->set('working_days_Num', $arg['working_days_Num']);
        $this->set('class_ClassMetaList', [
            'classids_Str' => $arg['classids_Str'],
            'classids_Arr' => $arg['classids_Arr']
        ], 'ClassMetaList');
        $this->set('designids_Str', $arg['designids_Str']);
        $this->set('pay_name_Str', $arg['pay_name_Str']);
        $this->set('pay_account_Str', $arg['pay_account_Str']);
        $this->set('pay_price_total_Num', $arg['pay_price_total_Num']);
        $this->set('pay_price_receive_Num', $arg['pay_price_receive_Num']);
        $this->set('pay_price_schedule_Num', $arg['pay_price_schedule_Num']);
        $this->set('pay_remark_Str', $arg['pay_remark_Str']);
        $this->set('pay_status_Num', $arg['pay_status_Num']);
        $this->set('paycheck_status_Num', $arg['paycheck_status_Num']);
        $this->set('project_status_Num', $arg['project_status_Num']);
        $this->set('pay_paytime_DateTimeObj', [
            'datetime_Str' => $arg['pay_paytime_Str']
        ], 'DateTimeObj');
        $this->set('setuptime_DateTimeObj', [
            'datetime_Str' => $arg['setuptime_Str']
        ], 'DateTimeObj');
        $this->set('updatetime_DateTimeObj', [
            'datetime_Str' => $arg['updatetime_Str']
        ], 'DateTimeObj');
        $this->set('status_Num', $arg['status_Num']);
        $this->set__uid_User(['uid_Num' => $arg['uid_Num']]);
        $this->set__uid_Num(['uid_Num' => $arg['uid_Num']]);
        
        return TRUE;
    }

    public function set__admin_uid_Num()
    {

        if(!empty($this->admin_uid_Num) )
        {
            $data['User'] = new User();
            $data['User']->construct_db(array(
                'db_where_Arr' => array(
                    'email_Str' => $this->admin_uid_Num
                )
            ));

            $admin_uid_Num = $data['User']->uid_Num;
        }
        else
        {
            $admin_uid_Num = '';
        }
        $this->admin_uid_Num = $admin_uid_Num;
    }

    public function set__permission_uids_UserList($arg)
    {
        if( !empty($arg['permission_uids_Str']) )
        {
            $permission_uids_Arr = explode(',', $arg['permission_uids_Str']);
            $UserList = new ObjList();
            $UserList->construct_db([
                'db_where_or_Arr' => [
                    'uid' => $permission_uids_Arr
                ],
                'model_name_Str' => 'User',
                'db_orderby_Arr' => [
                    'uid' => $permission_uids_Arr
                ],
                'limitstart_Num' => 0,
                'limitcount_Num' => 100
            ]);
        }
        else if( !empty($arg['permission_emails_Str']) )
        {
            $permission_emails_Arr = explode(PHP_EOL, $arg['permission_emails_Str']);
            $UserList = new ObjList();
            $UserList->construct_db([
                'db_where_or_Arr' => [
                    'email' => $permission_emails_Arr
                ],
                'model_name_Str' => 'User',
                'limitstart_Num' => 0,
                'limitcount_Num' => 100
            ]);

            $UserList->uniqueids_Arr = [];
            foreach($UserList->obj_Arr as $key => $value_User)
            {
                $array_search_Num = array_search( $value_User->email_Str, $permission_emails_Arr );
                if( $array_search_Num !== FALSE )
                {
                    $UserList->uniqueids_Arr[$array_search_Num] = $value_User->uid_Num;
                }
            }
            ksort($UserList->uniqueids_Arr);
            $UserList->uniqueids_Str = implode(',', $UserList->uniqueids_Arr);
        }
        else
        {
            $UserList = new ObjList;
        }
        $this->permission_uids_UserList = $UserList;
    }
	
}