<?php
		
class Project_Controller extends MY_Controller {
	
	public function delete_design_item()
	{
        $data = $this->data;

        $designid = $this->input->get('designid');

        if( empty($data['User']->uid) )
        {
            echo '操作權限不足';
            return FALSE;
        }
		
		if( !empty($designid) )
        {
            $Design = new Design();
            $Design->construct(['designid' => $designid]);
            $Design->delete();
            return TRUE;
		}
        else
        {
            echo '處理失敗';
            return FALSE;
        }
	}
    
}

?>