<?php

class Project extends ObjDbBase
{

    public $projectid = 0;
    public $uid = 0;
    public $name = '';
    public $admin_uid = '';
    public $permission_uids_UserList = '';
    public $working_days = 0;
    public $class_ClassMetaList;
    public $designids = '';
    public $pay_name = '';
    public $pay_account = '';
    public $pay_price_total = 0;
    public $pay_price_receive = 0;
    public $pay_price_schedule = 0;
    public $pay_price_schedule2 = 0;
    public $pay_remark = '';
    public $pay_status = 0;
    public $paycheck_status = 0;
    public $project_status = 1;
    public $pay_paytime_DateTimeObj;
    public $setuptime_DateTimeObj;
    public $endtime_DateTimeObj;
    public $updatetime_DateTimeObj;
    public $DesignList;
    public $status = 1;
    public $db_name = 'project';//填寫物件聯繫資料庫之名稱
    public $db_uniqueid = 'projectid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_arr = [//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'projectid' => 'projectid',
        'uid' => 'uid',
        'name' => 'name',
        'admin_uid' => 'admin_uid',
        'permission_uids' => ['permission_uids_UserList', 'uniqueids'],
        'working_days' => 'working_days',
        'classids' => array('class_ClassMetaList', 'uniqueids'),
        'designids' => 'designids',
        'pay_name' => 'pay_name',
        'pay_account' => 'pay_account',
        'pay_price_total' => 'pay_price_total',
        'pay_price_receive' => 'pay_price_receive',
        'pay_price_schedule' => 'pay_price_schedule',
        'pay_price_schedule2' => 'pay_price_schedule2',
        'pay_remark' => 'pay_remark',
        'pay_status' => 'pay_status',
        'paycheck_status' => 'paycheck_status',
        'project_status' => 'project_status',
        'pay_paytime' => array('pay_paytime_DateTimeObj', 'datetime'),
        'setuptime' => array('setuptime_DateTimeObj', 'datetime'),
        'endtime' => array('endtime_DateTimeObj', 'datetime'),
        'updatetime' => array('updatetime_DateTimeObj', 'datetime'),
        'status' => 'status'
    ];
	
	public function construct($arg = [])
	{
        $permission_uids = !empty($arg['permission_uids']) ? $arg['permission_uids'] : '' ;
        $permission_emails = !empty($arg['permission_emails']) ? $arg['permission_emails'] : '' ;
        $this->set__permission_uids_UserList([
            'permission_uids' => $permission_uids,
            'permission_emails' => $permission_emails
        ]);
        $this->set('projectid', $arg['projectid']);
        $this->set('uid', $arg['uid']);
        $this->set('name', $arg['name']);
        $this->set('admin_uid', $arg['admin_uid']);
        $this->set('working_days', $arg['working_days']);
        $this->set('class_ClassMetaList', [
            'classids' => $arg['classids'],
            'classids_arr' => $arg['classids_arr']
        ], 'ClassMetaList');
        $this->set('designids', $arg['designids']);
        $this->set('pay_name', $arg['pay_name']);
        $this->set('pay_account', $arg['pay_account']);
        $this->set('pay_price_total', $arg['pay_price_total']);
        $this->set('pay_price_receive', $arg['pay_price_receive']);
        $this->set('pay_price_schedule', $arg['pay_price_schedule']);
        $this->set('pay_price_schedule2', $arg['pay_price_schedule2']);
        $this->set('pay_remark', $arg['pay_remark']);
        $this->set('pay_status', $arg['pay_status']);
        $this->set('paycheck_status', $arg['paycheck_status']);
        $this->set('project_status', $arg['project_status']);
        $this->set('pay_paytime_DateTimeObj', [
            'datetime' => $arg['pay_paytime']
        ], 'DateTimeObj');
        $this->set('setuptime_DateTimeObj', [
            'datetime' => $arg['setuptime']
        ], 'DateTimeObj');
        $this->set('endtime_DateTimeObj', [
            'datetime' => $arg['endtime']
        ], 'DateTimeObj');
        $this->set('updatetime_DateTimeObj', [
            'datetime' => $arg['updatetime']
        ], 'DateTimeObj');
        $this->set('status', $arg['status']);
        $this->set__uid_User(['uid' => $arg['uid']]);
        $this->set__uid(['uid' => $arg['uid']]);

        $projectid = !empty($arg['projectid']) ? $arg['projectid'] : 0;
        $DesignList = new ObjList();
        $DesignList->construct_db([
            'db_where_arr' => [
                'projectid' => $projectid
            ],
            'db_orderby_arr' => [
                'prioritynum' => 'DESC',
                'designid' => 'DESC'
            ],
            'model_name' => 'Design',
            'limitstart' => 0,
            'limitcount' => 100
        ]);
        $this->DesignList = $DesignList;
        
        return TRUE;
    }

    public function set__admin_uid()
    {

        if(!empty($this->admin_uid) )
        {
            $data['User'] = new User();
            $data['User']->construct_db(array(
                'db_where_arr' => array(
                    'email' => $this->admin_uid
                )
            ));

            $admin_uid = $data['User']->uid;
        }
        else
        {
            $admin_uid = '';
        }
        $this->admin_uid = $admin_uid;
    }

    public function set__permission_uids_UserList($arg)
    {
        if( !empty($arg['permission_uids']) )
        {
            $permission_uids_arr = explode(',', $arg['permission_uids']);
            $UserList = new ObjList();
            $UserList->construct_db([
                'db_where_or_arr' => [
                    'uid' => $permission_uids_arr
                ],
                'model_name' => 'User',
                'db_orderby_arr' => [
                    'uid' => $permission_uids_arr
                ],
                'limitstart' => 0,
                'limitcount' => 100
            ]);
        }
        else if( !empty($arg['permission_emails']) )
        {
            $permission_emails_arr = explode(PHP_EOL, $arg['permission_emails']);
            $UserList = new ObjList();
            $UserList->construct_db([
                'db_where_or_arr' => [
                    'email' => $permission_emails_arr
                ],
                'model_name' => 'User',
                'limitstart' => 0,
                'limitcount' => 100
            ]);

            $UserList->uniqueids_arr = [];
            foreach($UserList->obj_arr as $key => $value_User)
            {
                $array_search = array_search( $value_User->email, $permission_emails_arr );
                if( $array_search !== FALSE )
                {
                    $UserList->uniqueids_arr[$array_search] = $value_User->uid;
                }
            }
            ksort($UserList->uniqueids_arr);
            $UserList->uniqueids = implode(',', $UserList->uniqueids_arr);
        }
        else
        {
            $UserList = new ObjList;
        }
        $this->permission_uids_UserList = $UserList;
    }
	
}