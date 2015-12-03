<?php

class Project extends ObjDbBase
{

    public $projectid_Num = 0;
    public $uid_Num = 0;
    public $name_Str = '';
    public $permission_uids_Str = '';
    public $working_days_Num = 0;
    public $class_ClassMetaList;
    public $designids_Str = '';
    public $pay_name_Str = '';
    public $pay_account_Str = '';
    public $pay_price_total_Num = 0;
    public $pay_remark_Str = '';
    public $pay_status_Num = 0;
    public $paycheck_status_Num = 0;
    public $project_status_Num = 1;
    public $pay_paytime_DateTimeObj;
    public $setuptime_DateTimeObj;
    public $updatetime_DateTimeObj;
    public $status_Num = 1;
    public $db_name_Str = 'shop_project';//填寫物件聯繫資料庫之名稱
    public $db_uniqueid_Str = 'projectid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_Arr = [//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'projectid' => 'projectid_Num',
        'uid' => 'uid_Num',
        'name' => 'name_Str',
        'permission_uids' => 'permission_uids_Str',
        'working_days' => 'working_days_Num',
        'classids' => array('class_ClassMetaList', 'uniqueids_Str'),
        'designids' => 'designids_Str',
        'pay_name' => 'pay_name_Str',
        'pay_account' => 'pay_account_Str',
        'pay_price_total' => 'pay_price_total_Num',
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

        $this->set('projectid_Num', $arg['projectid_Num']);
        $this->set('uid_Num', $arg['uid_Num']);
        $this->set('name_Str', $arg['name_Str']);
        $this->set('permission_uids_Str', $arg['permission_uids_Str']);
        $this->set('working_days_Num', $arg['working_days_Num']);
        $this->set('class_ClassMetaList', [
            'classids_Str' => $arg['classids_Str'],
            'classids_Arr' => $arg['classids_Arr']
        ], 'ClassMetaList');
        $this->set('designids_Str', $arg['designids_Str']);
        $this->set('pay_name_Str', $arg['pay_name_Str']);
        $this->set('pay_account_Str', $arg['pay_account_Str']);
        $this->set('pay_price_total_Num', $arg['pay_price_total_Num']);
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
        $this->set__comment_CommentList(['projectid_Num' => $arg['projectid_Num']]);
        
        return TRUE;
    }

    public function set__comment_CommentList($arg)
    {
        reset_null_arr($arg, ['projectid_Num']);
        foreach($arg as $key => $value) ${$key} = $arg[$key];

        $comment_CommentList = new ObjList();
        $comment_CommentList->construct_db(array(
            'db_where_Arr' => [
                'typename' => 'project',
                'id' => $projectid_Num
            ],
            'model_name_Str' => 'Comment',
            'limitstart_Num' => 0,
            'limitcount_Num' => 9999
        ));
        $this->set('comment_CommentList', $comment_CommentList);
    }
	
}