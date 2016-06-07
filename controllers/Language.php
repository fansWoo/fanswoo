<?php

class Language_controller extends MY_Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $change = $this->input->get('change');
        $back_url = $this->input->get('back_url');

        $this->i18n->prevent_auto();
        $this->i18n->set_current_locale($change);

        if(empty($back_url))
        {
            $back_url = base_url();
        }

        header("Location: $back_url");
    }

}

/* End of file i18nmanual.php */
/* Location: ./application/controller/i18nmanual.php */