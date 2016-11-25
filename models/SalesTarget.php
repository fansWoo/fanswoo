<?php

class Customer extends ObjDbBase
{

    public function attr_setting()
    {
        $this->set_db_uniqueid('sales_target_id');
        $this->add_db_name('project_sales_target');

        $this->attr('sales_target_id')->field('sales_target_id');
        $this->attr('customer_name')->field('customer_name');
        $this->attr('project')->field('project');
        $this->attr('website')->field('website');
        $this->attr('prioritynum')->field('prioritynum');
        $this->attr('uid_User')->field('uid')->update_child('uid');
        $this->attr('status')->field('status');
    }
	
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