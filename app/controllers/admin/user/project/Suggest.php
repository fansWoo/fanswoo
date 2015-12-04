<?php

class Suggest_Controller extends MY_Controller {

    protected $child1_name_Str = 'user';
    protected $child2_name_Str = 'project';
    protected $child3_name_Str = 'suggest';

    public function __construct()
    {
        parent::__construct();
        $data = $this->data;

        $this->load->model('AdminModel');
        $this->AdminModel->child1_name_Str = $this->child1_name_Str;
        $this->AdminModel->child2_name_Str = $this->child2_name_Str;
        $this->AdminModel->child3_name_Str = $this->child3_name_Str;

        if($data['User']->uid_Num == '')
        {
            $url = base_url('user/login/?url=admin');
            header('Location: '.$url);
        }

        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function edit()
    {
        $data = $this->data;//取得公用數據
        $data = array_merge($data, $this->AdminModel->get_data(array(
            'child4_name_Str' => 'edit'//管理分類名稱
        )));
        
        $data['projectid_Num'] = $this->input->get('projectid');    
        $suggestid_Num = $this->input->get('suggestid');

        if(empty($data['projectid_Num']))
        {
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '請先選擇欲增加修改建議的專案',
                'url' => 'admin/user/project/project/tablelist'
            ));
            return FALSE;
        }

        $data['Suggest'] = new Suggest();
        $data['Suggest']->construct_db(array(
            'db_where_Arr' => array(
                'suggestid' => $suggestid_Num,
            )
        )); 

        //global
        $data['global']['style'][] = 'app/css/admin/global.css';
        $data['global']['js'][] = 'app/js/admin.js';
        $data['global']['js'][] = 'fanswoo-framework/js/jquery.form.js';

        //temp
        $data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
        $data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['admin_header_bar'] = $this->load->view('admin/temp/admin_header_bar', $data, TRUE);
        $data['temp']['admin_footer_bar'] = $this->load->view('admin/temp/admin_footer_bar', $data, TRUE);
        $data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url_Str'], $data);
    }

    public function edit_post()
    {
        $data = $this->data;//取得公用數據

        $projectid_Num = $this->input->post('projectid_Num', TRUE);
        $suggestid_Num = $this->input->post('suggestid_Num', TRUE);

        $this->form_validation->set_rules('title_Str', '修改建議標題', 'required');

        if ($this->form_validation->run() !== FALSE)
        {
            //基本post欄位
            $title_Str = $this->input->post('title_Str', TRUE);
            $content_Str = $this->input->post('content_Str', TRUE);
            $suggest_status_Num = $this->input->post('suggest_status_Num', TRUE);

            //建構Suggest物件，並且更新
            $Suggest = new Suggest();
            $Suggest->construct(array(
                'suggestid_Num' => $suggestid_Num,
                'projectid_Num' => $projectid_Num,
                'title_Str' => $title_Str,
                'content_Str' => $content_Str,
                'suggest_status_Num' => 1,
            ));
            $Suggest->update();

            //送出成功訊息
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '設定成功',
                'url' => 'admin/user/project/project/tablelist'
            ));
        }
        else
        {
            $validation_errors_Str = validation_errors();
            $validation_errors_Str = !empty($validation_errors_Str) ? $validation_errors_Str : '設定錯誤' ;
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => $validation_errors_Str,
                'url' => 'admin/user/project/suggest/edit/?suggestid='.$suggestid_Num
            ));
        }
    }

}