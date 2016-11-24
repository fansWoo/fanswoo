<?php

class Customer extends ObjDbBase
{

    public function attr_setting()
    {
        $this->set_db_uniqueid('customerid');
        $this->add_db_name('project_customer');

        $this->attr('customerid')->field('customerid');
        $this->attr('company')->field('company');
        $this->attr('customer_name')->field('customer_name');
        $this->attr('phone')->field('phone');
        $this->attr('tel')->field('tel');
        $this->attr('email')->field('email');
        $this->attr('wish')->field('wish');
        $this->attr('content_Html')->field('content');
        $this->attr('address')->field('address');
        $this->attr('budget_range')->field('budget_range');
        $this->attr('website')->field('website');
        $this->attr('prioritynum')->field('prioritynum');

        $this->attr('uid_User')->field('uid')->update_child('uid');
        $this->attr('contact_time_DateTime')->field('contact_time')->update_child('datetime');
        $this->attr('updatetime_DateTime')->field('updatetime')->update_child('datetime');
    }
	
	public function construct($arg = [])
    {
        //將引數設為物件屬性，或將引數作為物件型屬性的建構值
        $this->set('customerid', $arg['customerid']);
        $this->set('company', $arg['company']);
        $this->set('customer_name', $arg['customer_name']);
        $this->set('content_Html', $arg['content']);
        $this->set('phone', $arg['phone']);
        $this->set('tel', $arg['tel']);
        $this->set('email', $arg['email']);
        $this->set('wish', $arg['wish']);
        $this->set('address', $arg['address']);
        $this->set('budget_range', $arg['budget_range']);
        $this->set('website', $arg['website']);
        $this->set('prioritynum', $arg['prioritynum']);
        $this->set('contact_time_DateTime', [
            'datetime' => $arg['contact_time'],
            'inputtime_date' => $arg['start_inputtime_date'],
            'inputtime_time' => $arg['start_inputtime_time']
        ], 'DateTimeObj');
        $this->set('updatetime_DateTime', [
            'datetime' => $arg['updatetime'],
            'inputtime_date' => $arg['start_inputtime_date'],
            'inputtime_time' => $arg['start_inputtime_time']
        ], 'DateTimeObj');
        $this->set__uid_User(['uid' => $arg['uid']]);
        $this->set__status(['status' => $arg['status']]);
        
        return TRUE;
    }
	
}