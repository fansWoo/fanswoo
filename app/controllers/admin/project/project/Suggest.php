<?php

class Suggest_Controller extends MY_Controller {

    protected $child1_name_Str = 'project';
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
                'url' => 'admin/project/project/project/tablelist'
            ));
            return FALSE;
        }

        $data['Suggest'] = new Suggest();
        $data['Suggest']->construct_db(array(
            'db_where_Arr' => array(
                'suggestid' => $suggestid_Num
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

        $suggestid_Num = $this->input->post('suggestid_Num', TRUE);

        $this->form_validation->set_rules('answer_Str', '回覆修改內容', 'required');

        if ($this->form_validation->run() !== FALSE)
        {
            //基本post欄位
            $answer_Str = $this->input->post('answer_Str', TRUE);
            $suggest_status_Num = $this->input->post('suggest_status_Num', TRUE);
            $answer_status_Num = $this->input->post('answer_status_Num', TRUE);

            //建構Suggest物件，並且更新
            $Suggest = new Suggest();
            $Suggest->construct(array(
                'suggestid_Num' => $suggestid_Num,
                'answer_Str' => $answer_Str,
                'suggest_status_Num' => 1,
                'answer_status_Num' => $answer_status_Num
            ));
            $Suggest->update(array(
                'db_update_Arr' => array(
                    'answer',
                    'answer_status',
                    'updatetime'
                )
            ));

            //送出成功訊息
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '設定成功',
                'url' => 'admin/project/project/project/tablelist'
            ));
        }
        else
        {
            $validation_errors_Str = validation_errors();
            $validation_errors_Str = !empty($validation_errors_Str) ? $validation_errors_Str : '設定錯誤' ;
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => $validation_errors_Str,
                'url' => 'admin/project/project/suggest/edit/?suggestid='.$suggestid_Num
            ));
        }
    }

    public function delete()
    {
        $hash_Str = $this->input->get('hash');
        $suggestid_Num = $this->input->get('suggestid');

        //CSRF過濾
        if($hash_Str == $this->security->get_csrf_hash())
        {
            $Suggest = new Suggest();
            $Suggest->construct(array('suggestid_Num' => $suggestid_Num));
            $Suggest->delete();

            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '刪除成功',
                'url' => 'admin/project/project/project/tablelist'
            ));
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/project/project/project/tablelist'
            ));
        }
    }

}