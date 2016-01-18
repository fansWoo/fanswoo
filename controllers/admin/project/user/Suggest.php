<?php

class Suggest_Controller extends MY_Controller {

    protected $child1_name_Str = 'project';
    protected $child2_name_Str = 'user';
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
                'url' => 'admin/project/user/project/tablelist'
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
        $data['global']['style'][] = 'admin/global.css';
        $data['global']['js'][] = 'admin.js';
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

        $Project = new Project();
        $Project->construct_db(array(
            'db_where_Arr' => array(
                'projectid_Num' => $projectid_Num
            )
        ));

        $admin_User = new User();
        $admin_User->construct_db(array(
            'db_where_Arr' => array(
                'uid_Num' => $Project->admin_uid_Num
            )
        ));

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

            //寄出電子郵件通知專案管理人
            $email_Str = $admin_User->email_Str;
            $email_name_Str = 'fansWoo';
            $title_Str = 'fansWoo專案有新的修改建議';

            $message_Str = '您好：<br><br>我們收到一則新的修改建議<br><br>
            專案編號為：'.$projectid_Num.'，修改建議標題：'.$Suggest->title_Str.
            '<br><br>請至後台觀看，謝謝<br><br>後台位置：<br>
            <a href="http://'.$_SERVER['HTTP_HOST'].base_url('admin').'">
            http://'.$_SERVER['HTTP_HOST'].base_url('admin/').'</a><br><br>'.date('Y-m-d H:i:s');

            $Mailer = new Mailer;
            $return_message_Str = $Mailer->sendmail($email_Str, $email_name_Str, $title_Str, $message_Str);
            if($return_message_Str === TRUE)
            {
                //寄件成功
            }
            else
            {
                //送出訊息
                $this->load->model('Message');
                $this->Message->show(array(
                    'message' => 'error(4)：郵件伺服器出錯',
                    'url' => 'contact'
                ));
                return FALSE;
            }

            //送出成功訊息
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '設定成功',
                'url' => 'admin/project/user/project/tablelist'
            ));
        }
        else
        {
            $validation_errors_Str = validation_errors();
            $validation_errors_Str = !empty($validation_errors_Str) ? $validation_errors_Str : '設定錯誤' ;
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => $validation_errors_Str,
                'url' => 'admin/project/user/suggest/edit/?suggestid='.$suggestid_Num
            ));
        }
    }

}