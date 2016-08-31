<?php

class Form extends ObjBase {

	protected $CI;

	public function __construct()
	{
		$this->CI =& get_instance();
		// $this->CI->load->model('Message');
		// $this->CI->form_validation->set_rules($index, $label, $rules, $errors);
	}

	public function post($index = NULL, $xss_clean = NULL, $label = NULL, $rules = NULL, $errors = NULL)
	{
		// if( !empty($label) && !empty($rules) )
		// {
		// 	$this->CI->load->library('form_validation');
		// 	$this->CI->form_validation->set_rules($index, $label, $rules, $errors);
		// }
		// return $this->CI->form_validation->_fetch_from_array($_POST, $index, $xss_clean);
	}

    public function check($arg = [])
    {
      //   if ($this->CI->form_validation->run() == TRUE)
      //   {
      //   	return TRUE;
      //   }
      //   else
      //   {
    		// if( empty($arg['return_type']) || $arg['return_type'] == 'json' )
    		// {
	     //        $validation_errors = validation_errors();
	     //        $validation_errors = !empty($validation_errors) ? $validation_errors : '設定錯誤' ;

	     //        //送出成功訊息
	     //        $Message = new Message;
	     //        $Message->show([
	     //            'message' => $validation_errors,
	     //            'url' => NULL
	     //        ]);
    		// }
    		// else if( $arg['return_type'] == 'page' )
    		// {
	     //        $validation_errors = validation_errors();
	     //        $validation_errors = !empty($validation_errors) ? $validation_errors : '設定錯誤' ;

	     //        //送出成功訊息
	     //        $Message = new Message;
	     //        $Message->show([
	     //            'message' => $validation_errors,
	     //            'url' => $_SERVER['HTTP_REFERER']
	     //        ]);
    		// }
	     //    return FALSE;
      //   }
    }
	
}