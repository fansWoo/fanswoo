<?php

class Project extends ObjDbBase
{

    public $projectid = 0;
    public $uid = 0;
    public $name = '';
    public $admin_uids_UserList = '';
    public $customer_uids_UserList = '';
    public $permission_uids_UserList = '';
    public $working_days = 0;
    public $class_ClassMetaList;
    public $pay_name = '';
    public $pay_account = '';
    public $pay_price_total = 0;
    public $pay_price_receive = 0;
    public $pay_price_schedule = 0;
    public $pay_price_bad_debt = 0;
    public $pay_remark = '';
    public $pay_status = 0;
    public $paycheck_status = 0;
    public $project_status = 1;
    public $pay_paytime_DateTimeObj;
    public $setuptime_DateTimeObj;
    public $endtime_DateTimeObj;
    public $updatetime_DateTimeObj;
    public $status = 1;
    public $db_name_arr = ['project'];//填寫物件聯繫資料庫之名稱
    public $db_uniqueid = 'projectid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_arr = [//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'projectid' => 'projectid',
        'uid' => 'uid',
        'name' => 'name',
        'admin_uids' => ['admin_uids_UserList', 'uniqueids'],
        'customer_uids' => ['customer_uids_UserList', 'uniqueids'],
        'permission_uids' => ['permission_uids_UserList', 'uniqueids'],
        'working_days' => 'working_days',
        'classids' => array('class_ClassMetaList', 'uniqueids'),
        'designids' => 'designids',
        'pay_name' => 'pay_name',
        'pay_account' => 'pay_account',
        'pay_price_total' => 'pay_price_total',
        'pay_price_receive' => 'pay_price_receive',
        'pay_price_schedule' => 'pay_price_schedule',
        'pay_price_bad_debt' => 'pay_price_bad_debt',
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
        $this->set('projectid', $arg['projectid']);
        $this->set('uid', $arg['uid']);
        $this->set('name', $arg['name']);
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
        $this->set('pay_price_bad_debt', $arg['pay_price_bad_debt']);
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
        $this->set__uid(['uid' => $arg['uid']]);
        $this->set__uid_User(['uid' => $arg['uid']]);
        $this->set__pay_price_schedule();
        $this->set__permission_uids_UserList([
            'uids' => $arg['permission_uids'],
            'emails' => $arg['permission_emails']
        ]);
        $this->set__customer_uids_UserList([
            'uids' => $arg['customer_uids'],
            'emails' => $arg['customer_emails']
        ]);
        $this->set__admin_uids_UserList([
            'uids' => $arg['admin_uids'],
            'emails' => $arg['admin_emails']
        ]);
    }

    public function set__pay_price_schedule()
    {
        $pay_price_total = $this->get('pay_price_total');
        $pay_price_receive = $this->get('pay_price_receive');
        $pay_price_bad_debt = $this->get('pay_price_bad_debt');
        if( $pay_price_total == 0)
        {
            $pay_price_schedule = 0;
        }
        else
        {
            $pay_price_schedule = ( ( $pay_price_receive + $pay_price_bad_debt ) / $pay_price_total ) * 100;
            $pay_price_schedule = round($pay_price_schedule, 1);
        }
        $this->set('pay_price_schedule', $pay_price_schedule);
    }

    public function set__permission_uids_UserList($arg)
    {
        if( !empty($arg['uids']) )
        {
            $uids_arr = explode(',', $arg['uids']);
            $UserList = new ObjList();
            $UserList->construct_db([
                'db_where_arr' => [
                    'uid in' => $uids_arr
                ],
                'obj_class' => 'User',
                'db_orderby_arr' => [
                    'uid' => $uids_arr
                ],
                'limitstart' => 0,
                'limitcount' => 100
            ]);
        }
        else if( !empty($arg['emails']) )
        {
            $emails_arr = explode_php_eol( $arg['emails'] );
            $UserList = new ObjList([
                'db_where_arr' => [
                    'email in' => $emails_arr
                ],
                'obj_class' => 'User',
                'limitstart' => 0,
                'limitcount' => 100
            ]);
        }
        else
        {
            $UserList = new ObjList;
        }
        $this->permission_uids_UserList = $UserList;
    }

    public function set__customer_uids_UserList($arg)
    {
        if( !empty($arg['uids']) )
        {
            $uids_arr = explode(',', $arg['uids']);
            $UserList = new ObjList();
            $UserList->construct_db([
                'db_where_arr' => [
                    'uid in' => $uids_arr
                ],
                'obj_class' => 'User',
                'db_orderby_arr' => [
                    'uid' => $uids_arr
                ],
                'limitstart' => 0,
                'limitcount' => 100
            ]);
        }
        else if( !empty($arg['emails']) )
        {
            $emails_arr = explode_php_eol( $arg['emails'] );
            $UserList = new ObjList([
                'db_where_arr' => [
                    'email in' => $emails_arr
                ],
                'obj_class' => 'User',
                'limitstart' => 0,
                'limitcount' => 100
            ]);
        }
        else
        {
            $UserList = new ObjList;
        }
        $this->customer_uids_UserList = $UserList;
    }

    public function set__admin_uids_UserList($arg)
    {
        if( !empty($arg['uids']) )
        {
            $uids_arr = explode(',', $arg['uids']);
            $UserList = new ObjList();
            $UserList->construct_db([
                'db_where_arr' => [
                    'uid in' => $uids_arr
                ],
                'obj_class' => 'User',
                'db_orderby_arr' => [
                    'uid' => $uids_arr
                ],
                'limitstart' => 0,
                'limitcount' => 100
            ]);
        }
        else if( !empty($arg['emails']) )
        {
            $emails_arr = explode_php_eol( $arg['emails'] );
            $UserList = new ObjList([
                'db_where_arr' => [
                    'email in' => $emails_arr
                ],
                'obj_class' => 'User',
                'limitstart' => 0,
                'limitcount' => 100
            ]);
        }
        else
        {
            $UserList = new ObjList;
        }
        $this->admin_uids_UserList = $UserList;
    }
	
}