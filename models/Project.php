<?php

class Project extends ObjDbBase
{

    public function attr_setting()
    {
        $this->set_db_uniqueid('projectid');
        $this->add_db_name('project');

        $this->attr('projectid')->field('projectid');
        $this->attr('name')->field('name');
        $this->attr('working_days')->field('working_days');
        $this->attr('use_hour_total')->field('use_hour_total');
        $this->attr('estimate_hour_total')->field('estimate_hour_total');
        $this->attr('pay_name')->field('pay_name');
        $this->attr('pay_account')->field('pay_account');
        $this->attr('pay_price_total')->field('pay_price_total');
        $this->attr('pay_price_receive')->field('pay_price_receive');
        $this->attr('pay_price_schedule')->field('pay_price_schedule');
        $this->attr('pay_price_bad_debt')->field('pay_price_bad_debt');
        $this->attr('pay_remark')->field('pay_remark');
        $this->attr('pay_status')->field('pay_status');
        $this->attr('paycheck_status')->field('paycheck_status');
        $this->attr('project_status')->field('project_status');
        $this->attr('status')->field('status');

        $this->attr('uid_User')->field('uid')->update_child('uid');
        $this->attr('admin_uids_UserList')->field('admin_uids')->update_child('uniqueids');
        $this->attr('customer_uids_UserList')->field('customer_uids')->update_child('uniqueids');
        $this->attr('permission_uids_UserList')->field('permission_uids')->update_child('uniqueids');
        $this->attr('class_ClassMetaList')->field('classids')->update_child('uniqueids');
        $this->attr('pay_paytime_DateTimeObj')->field('pay_paytime')->update_child('datetime');
        $this->attr('setuptime_DateTimeObj')->field('setuptime')->update_child('datetime');
        $this->attr('endtime_DateTimeObj')->field('endtime')->update_child('datetime');
        $this->attr('updatetime_DateTimeObj')->field('updatetime')->update_child('datetime');
    }

	public function construct($arg = [])
	{
        $this->set('projectid', $arg['projectid']);
        $this->set('name', $arg['name']);
        $this->set('working_days', $arg['working_days']);
        $this->set('estimate_hour_total', $arg['estimate_hour_total']);
        $this->set('use_hour_total', $arg['use_hour_total']);
        $this->set('class_ClassMetaList', [
            'classids' => $arg['classids'],
            'classids_arr' => $arg['classids_arr']
        ], 'ClassMetaList');
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
        // $this->set__uid(['uid' => $arg['uid']]);
        $this->set__uid_User(['uid' => $arg['uid'], 'email' => $arg['user_email']]);
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