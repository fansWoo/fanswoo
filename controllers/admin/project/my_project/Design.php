<?php

class Design_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('AdminModel');
        $this->AdminModel->construct(['data' => $this->data, 'file' => __FILE__ ]);
    }

    public function edit()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
            
        $designid = $this->input->get('designid');

        $data['Design'] = new Design();
        $data['Design']->construct_db(array(
            'db_where_arr' => array(
                'designid' => $designid
            )
        ));

        if(empty($data['Design']->designid))
        {
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '請先選擇欲查看設計項目的專案',
                'url' => 'admin/project/user/project/tablelist'
            ));
            return FALSE;
        }

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url'], $data);
    }
    
}