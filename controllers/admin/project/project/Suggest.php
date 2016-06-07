<?php

class Suggest_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('AdminModel');
        $this->AdminModel->construct(['data' => $this->data, 'file' => __FILE__ ]);
    }

    public function edit()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
        
        $data['projectid'] = $this->input->get('projectid');    
        $suggestid = $this->input->get('suggestid');

        if(empty($data['projectid']))
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
            'db_where_arr' => array(
                'suggestid' => $suggestid
            )
        )); 

        //global
        $data['global']['js'][] = 'tool/jquery.form.js';

        //temp
        $data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
        $data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['admin_header_bar'] = $this->load->view('admin/temp/admin_header_bar', $data, TRUE);
        $data['temp']['admin_footer_bar'] = $this->load->view('admin/temp/admin_footer_bar', $data, TRUE);
        $data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url'], $data);
    }

    public function edit_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $suggestid = $this->input->post('suggestid', TRUE);
        $projectid = $this->input->post('projectid', TRUE);

        $project_Suggest = new Suggest();
        $project_Suggest->construct_db(array(
            'db_where_arr' => array(
                'suggestid' => $suggestid
            )
        ));

        $Project = new Project();
        $Project->construct_db(array(
            'db_where_arr' => array(
                'projectid' => $projectid
            )
        ));

        $project_permission_uids_arr = explode(PHP_EOL, trim($Project->permission_uids_UserList->uniqueids));

        $project_User = new User();
        $project_User->construct_db(array(
            'db_where_arr' => array(
                'uid' => $project_permission_uids_arr[0]
            )
        ));

        $this->form_validation->set_rules('answer', '回覆修改內容', 'required');

        if ($this->form_validation->run() !== FALSE)
        {
            //基本post欄位
            $answer = $this->input->post('answer', TRUE);
            $suggest_status = $this->input->post('suggest_status', TRUE);
            $answer_status = $this->input->post('answer_status', TRUE);

            //建構Suggest物件，並且更新
            $Suggest = new Suggest();
            $Suggest->construct(array(
                'suggestid' => $suggestid,
                'answer' => $answer,
                'suggest_status' => 1,
                'answer_status' => $answer_status
            ));
            $Suggest->update(array(
                'db_update_arr' => array(
                    'answer',
                    'answer_status',
                    'updatetime'
                )
            ));

            //寄出電子郵件通知專案訂購人
            $email = $project_User->email;
            $email_name = 'fansWoo';
            $title = 'fansWoo專案修改建議回覆通知';
            $suggest_title = $project_Suggest->title;

            $message = '您好：<br><br>我們收到一則專案修改建議回覆<br><br>專案編號為：'.$projectid.
            '，修改建議標題：'.$suggest_title.'<br><br>請至後台觀看，謝謝<br><br>後台位置：<br>
            <a href="http://'.$_SERVER['HTTP_HOST'].base_url('admin').'">
            http://'.$_SERVER['HTTP_HOST'].base_url('admin/').'</a><br><br>'.date('Y-m-d H:i:s');

            $Mailer = new Mailer;
            $return_message = $Mailer->sendmail($email, $email_name, $title, $message);
            if($return_message === TRUE)
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
                'url' => 'admin/project/project/project/tablelist'
            ));
        }
        else
        {
            $validation_errors = validation_errors();
            $validation_errors = !empty($validation_errors) ? $validation_errors : '設定錯誤' ;
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => $validation_errors,
                'url' => 'admin/project/project/suggest/edit/?suggestid='.$suggestid
            ));
        }
    }

    public function delete()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
        
        $hash = $this->input->get('hash');
        $suggestid = $this->input->get('suggestid');

        //CSRF過濾
        if($hash == $this->security->get_csrf_hash())
        {
            $Suggest = new Suggest();
            $Suggest->construct(array('suggestid' => $suggestid));
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