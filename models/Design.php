<?php

class Design extends ObjDbBase
{

    public function attr_setting()
    {
        $this->set_db_uniqueid('designid');
        $this->add_db_name('project_design');

        $this->attr('designid')->field('designid');
        $this->attr('projectid')->field('projectid');
        $this->attr('title')->field('title');
        $this->attr('synopsis')->field('synopsis');
        $this->attr('price')->field('price');
        $this->attr('classname')->field('classname');
        $this->attr('days')->field('days');
        $this->attr('prioritynum')->field('prioritynum');
        $this->attr('status')->field('status');
    }
	
	public function construct($arg = [])
    {
        $data = $this->data;
        
        //將引數設為物件屬性，或將引數作為物件型屬性的建構值
        $this->set('designid', $arg['designid']);
        $this->set('projectid', $arg['projectid']);
        $this->set('title', $arg['title']);
        $this->set('synopsis', $arg['synopsis']);
        $this->set('price', $arg['price']);
        $this->set('classname', $arg['classname']);
        $this->set('days', $arg['days']);
        $this->set('prioritynum', $arg['prioritynum']);
        $this->set__status(['status' => $arg['status']]);
        
        return TRUE;
    }
	
}