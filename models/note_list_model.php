<?php
class Note_list_model extends CI_Model {

    private $note_list = array();
    private $note_list_array = array();
    private $data = array();
    
	public function __construct()
	{
        $this->data = $this->common_model->common();
	}
	
	public function construct($arg = array('note_array' => array() ) )
	{
        $note_list = array();
        $note_list_array = array();
        
        $note_array = $arg['note_array'];
        foreach($note_array as $key => $value)
        {
            $Note = new CI_Model();
            $Note->load->model('note_model');
            $Note->note_model->construct(array(
                'noteid' => $value['noteid'],
                'uid' => $value['uid'],
                'username' => $value['username'],
                'title' => $value['title'],
                'pic' => $value['pic'],
                'content' => $value['content'],
                'classid' => $value['classid'],
                'viewnum' => $value['viewnum'],
                'replynum' => $value['replynum'],
                'prioritynum' => $value['prioritynum'],
                'updatetime' => $value['updatetime'],
                'status' => $value['status']
            ));
            $note_array = $Note->note_model->get_array();
            $this->note_list[] = $Note;
            $this->note_list_array[] = $note_array;
        }
        
        return TRUE;
    }
    
	public function db_construct($arg = array('db_where' => array() ) )
    {
        $db_where2 = isset($arg['db_where']) ? $arg['db_where'] : array();
        if(empty($db_where2['status']) == TRUE)
        {
            $db_where['status'] = 1;
        }
        
        if(empty($db_where2['uid']) == FALSE)
        {
            $db_where['note.uid'] = $db_where2['uid'];
        }
        
		$this->db->from('note');
		$this->db->join('note_field', 'note.noteid = note_field.noteid', 'left');
		$this->db->where($db_where);
		$query = $this->db->get();
		$note_list = $query->result_array();
        
        $this->construct(array(
            'note_array' => $note_list
        ));
    }
    
	public function get_array()
	{
        $note_list_array = $this->note_list_array;
		return $note_list_array;
	}
	
}