<?php

class Customer extends ObjDbBase
{
    public $contact_time_DateTime;
    public $updatetime_DateTime;
    public $db_name_arr = ['project_customer'];//填寫物件聯繫資料庫之名稱
    public $db_uniqueid = 'customerid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'customerid' => 'customerid',
        'uid' => ['uid_User', 'uid'],
        'company' => 'company',
        'customer_name' => 'customer_name',
        'phone'=>'phone',
        'tel'=>'tel',
        'email'=>'email',
    	'wish'=>'wish',
        'content' => 'content_Html',
        'address'=>'address',
        'budget_range' => 'budget_range',
        'contact_time' => array('contact_time_DateTime', 'datetime'),
        'website' => 'website',
        'prioritynum' => 'prioritynum',
        'updatetime' => ['updatetime_DateTime', 'datetime']
    );
	
	public function construct($arg = [])
    {
        $data = $this->data;
        
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