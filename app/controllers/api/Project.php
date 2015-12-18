<?php
		
class Project_Controller extends MY_Controller {
	
	public function delete_design_item()
	{
        $data = $this->data;

        $designid_Num = $this->input->get('designid');

        if( empty($data['User']->uid_Num) )
        {
            echo '操作權限不足';
            return FALSE;
        }
		
		if( !empty($designid_Num) )
        {
            $Design = new Design();
            $Design->construct(['designid_Num' => $designid_Num]);
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