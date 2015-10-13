<?php

class FS_Lang extends CI_Lang {

	public function load($langfile, $idiom = '', $return = FALSE, $add_suffix = TRUE, $alt_path = '')
	{
        $this -> CI = get_instance(); 
		$this->CI->load->library('i18n');
        $idiom = $this->CI->i18n->get_current_locale();
		parent::load($langfile, $idiom, $return = FALSE, $add_suffix = TRUE, $alt_path = '');
	}

}
