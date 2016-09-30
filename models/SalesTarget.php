<?php

class Customer extends ObjDbBase
{
    public $contact_time_DateTime;
    public $updatetime_DateTime;
    public $db_name_arr = ['project_sales_target'];//填寫物件聯繫資料庫之名稱
    public $db_uniqueid = 'sales_target_id';//填寫物件聯繫資料庫之唯一ID
    public $db_field_arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'sales_target_id' => 'sales_target_id',
        'uid' => ['uid_User', 'uid'],
        'customer_name' => 'customer_name',
        'project'=>'project',
        'website' => 'website',
        'prioritynum' => 'prioritynum',
        // 'updatetime' => ['updatetime_DateTime', 'datetime']
    );
	
	public function construct($arg = [])
    {
              
        //將引數設為物件屬性，或將引數作為物件型屬性的建構值
        $this->set('sales_target_id', $arg['sales_target_id']);
        $this->set('customer_name', $arg['customer_name']);
        // $this->set('budget_range', $arg['budget_range']);
        // $this->set('website', $arg['website']);
        $this->set('prioritynum', $arg['prioritynum']);
        // $this->set('updatetime_DateTime', [
        //     'datetime' => $arg['updatetime'],
        //     'inputtime_date' => $arg['start_inputtime_date'],
        //     'inputtime_time' => $arg['start_inputtime_time']
        // ], 'DateTimeObj');
        $this->set__uid_User(['uid' => $arg['uid']]);
        $this->set__status(['status' => $arg['status']]);       
        return TRUE;
    }
	
}