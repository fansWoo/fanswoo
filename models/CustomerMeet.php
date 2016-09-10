<?php

class CustomerMeet extends ObjDbBase
{
    public $visit_time_DateTime;
    public $db_name_arr = ['project_customer_meet'];//填寫物件聯繫資料庫之名稱
    public $db_uniqueid = 'visitid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'visitid' => 'visitid',
        'customerids' => ['CustomerList', 'uniqueids'],
        'visit_class'=> 'visit_class',
        'content' => 'content_Html',
        'visit_time' => array('visit_time_DateTime', 'datetime'),
        'status'=> 'status'       
    );
	
	public function construct($arg = [])
    {
        $customerids = !empty($arg['customerids']) ? $arg['customerids'] : '';
        $customerids_arr = !empty($arg['customerids_arr']) ? $arg['customerids_arr'] : array();

        //建立CustomerList物件
        check_comma_array($customerids, $customerids_arr);
        $CustomerList = new ObjList([
            'db_where_arr'=>[
                'customerid in' => $customerids_arr
            ],
            'obj_class' => 'Customer',
            'limitstart' => 0,
            'limitcount' => 999999999
        ]);
        $this->CustomerList = $CustomerList;
        
        //將引數設為物件屬性，或將引數作為物件型屬性的建構值
        $this->set('visitid', $arg['visitid']);
        $this->set('visit_class', $arg['visit_class']);
        $this->set('content_Html', $arg['content']);
        $this->set('visit_time_DateTime', [
            'datetime' => $arg['visit_time'],
            'inputtime_date' => $arg['start_inputtime_date'],
            'inputtime_time' => $arg['start_inputtime_time']
        ], 'DateTimeObj');
        $this->set__status(['status' => $arg['status']]);
        
        return TRUE;
    }
}