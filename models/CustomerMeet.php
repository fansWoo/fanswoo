<?php

class CustomerMeet extends ObjDbBase
{

    public function attr_setting()
    {
        $this->set_db_uniqueid('visitid');
        $this->add_db_name('project_customer_meet');

        $this->attr('visitid')->field('visitid');
        $this->attr('visit_class')->field('visit_class');
        $this->attr('content_Html')->field('content');
        $this->attr('status')->field('status');

        $this->attr('CustomerList')->field('customerids')->update_child('uniqueids');
        $this->attr('visit_time_DateTime')->field('visit_time')->update_child('datetime');
    }
	
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