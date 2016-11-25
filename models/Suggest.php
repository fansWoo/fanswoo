<?php

class Suggest extends ObjDbBase
{

    public function attr_setting()
    {
        $this->set_db_uniqueid('suggestid');
        $this->add_db_name('project_suggest');

        $this->attr('suggestid')->field('suggestid');
        $this->attr('projectid')->field('projectid');
        $this->attr('uid')->field('uid');
        $this->attr('title')->field('title');
        $this->attr('content')->field('content');
        $this->attr('answer')->field('answer');
        $this->attr('suggest_status')->field('suggest_status');
        $this->attr('answer_status')->field('answer_status');
        $this->attr('status')->field('status');

        $this->attr('suggest_time_DateTime')->field('suggest_time')->update_child('datetime');
        $this->attr('updatetime_DateTime')->field('updatetime')->update_child('datetime');
    }
	
	public function construct($arg = [])
    {
        $data = $this->data;
        
        //將引數設為物件屬性，或將引數作為物件型屬性的建構值
        $this->set('suggestid', $arg['suggestid']);
        $this->set('projectid', $arg['projectid']);
        $this->set('title', $arg['title']);
        $this->set('content', $arg['content']);
        $this->set('answer', $arg['answer']);;
        $this->set('suggest_time_DateTime', [
            'datetime' => $arg['suggest_time'],
            'inputtime_date' => $arg['updatetime_inputtime_date'],
            'inputtime_time' => $arg['updatetime_inputtime_time']
        ], 'DateTimeObj');
        $this->set('updatetime_DateTime', [
            'datetime' => $arg['updatetime'],
            'inputtime_date' => $arg['updatetime_inputtime_date'],
            'inputtime_time' => $arg['updatetime_inputtime_time']
        ], 'DateTimeObj');
        $this->set('suggest_status', $arg['suggest_status']);
        $this->set('answer_status', $arg['answer_status']);
        $this->set__status(['status' => $arg['status']]);
        $this->set__uid(['uid' => $arg['uid']]);
        
        return TRUE;
    }
	
}