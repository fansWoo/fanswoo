<?php

class Worktask extends ObjDbBase
{

    public function attr_setting()
    {
        $this->set_db_uniqueid('worktaskid');
        $this->add_db_name('project_worktask');

        $this->attr('worktaskid')->field('worktaskid');
        $this->attr('projectid')->field('projectid');
        $this->attr('content_Html')->field('content');
        $this->attr('title')->field('title');
        $this->attr('current_percent')->field('current_percent');
        $this->attr('estimate_hour')->field('estimate_hour');
        $this->attr('use_hour')->field('use_hour');
        $this->attr('prioritynum')->field('prioritynum');
        $this->attr('work_status')->field('work_status');
        $this->attr('status')->field('status');

        $this->attr('uid_User')->field('uid')->update_child('uid');
        $this->attr('class_ClassMetaList')->field('classids')->update_child('uniqueids');
        $this->attr('start_time_DateTime')->field('start_time')->update_child('datetime');
        $this->attr('end_time_DateTime')->field('end_time')->update_child('datetime');
    }
	
	public function construct($arg = [])
    {
        $data = $this->data;
        
        //將引數設為物件屬性，或將引數作為物件型屬性的建構值
        $this->set('worktaskid', $arg['worktaskid']);
        $this->set('projectid', $arg['projectid']);
        $this->set('title', $arg['title']);
        $this->set('content_Html', $arg['content']);
        $this->set('estimate_hour', $arg['estimate_hour']);
        $this->set('current_percent', $arg['current_percent']);
        $this->set('use_hour', $arg['use_hour']);
        $this->set('prioritynum', $arg['prioritynum']);
        $this->set('work_status', $arg['work_status']);
        $this->set('start_time_DateTime', [
            'datetime' => $arg['start_time'],
            'inputtime_date' => $arg['start_inputtime_date'],
            'inputtime_time' => $arg['start_inputtime_time']
        ], 'DateTimeObj');
        $this->set('class_ClassMetaList', [
            'classids' => $arg['classids'],
            'classids_arr' => $arg['classids_arr']
        ], 'ClassMetaList');
        $this->set('end_time_DateTime', [
            'datetime' => $arg['end_time'],
            'inputtime_date' => $arg['start_inputtime_date'],
            'inputtime_time' => $arg['start_inputtime_time']
        ], 'DateTimeObj');
        $this->set__uid_User(['uid' => $arg['uid']]);
        $this->set__status(['status' => $arg['status']]);
        $this->set__project_ProjectList(['projectid' => $arg['projectid']]);
        
        return TRUE;
    }
    
    public function set__project_ProjectList($arg)
    {
    	reset_null_arr($arg, ['projectid']);
    	foreach($arg as $key => $value) ${$key} = $arg[$key];
    
    	$project_ProjectList = new ObjList([
    			'db_where_arr' => [
    					'projectid' => $projectid
    			],
    			'obj_class' => 'Project',
    			'limitstart' => 0,
    			'limitcount' => 9999
    	]);
    	
    	$this->set('project_ProjectList', $project_ProjectList);
    }
    
    public function count_use_time($this_use_hour){
    	
    	$this->use_hour=$this->use_hour+$this_use_hour;
    }
	
}