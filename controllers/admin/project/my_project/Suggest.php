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
                'url' => 'admin/project/user/project/tablelist'
            ));
            return FALSE;
        }

        $data['Suggest'] = new Suggest();
        $data['Suggest']->construct_db(array(
            'db_where_arr' => array(
                'suggestid' => $suggestid,
            )
        ));

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url'], $data);
    }

    public function edit_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $projectid = $this->input->post('projectid', TRUE);
        $suggestid = $this->input->post('suggestid', TRUE);

        $Project = new Project();
        $Project->construct_db(array(
            'db_where_arr' => array(
                'projectid' => $projectid
            )
        ));

        $admin_User = new User();
        $admin_User->construct_db(array(
            'db_where_arr' => array(
                'uid' => $Project->admin_uid
            )
        ));

        $this->form_validation->set_rules('title', '修改建議標題', 'required');

        if ($this->form_validation->run() !== FALSE)
        {
            //基本post欄位
            $title = $this->input->post('title', TRUE);
            $content = $this->input->post('content', TRUE);
            $suggest_status = $this->input->post('suggest_status', TRUE);

            //建構Suggest物件，並且更新
            $Suggest = new Suggest();
            $Suggest->construct(array(
                'suggestid' => $suggestid,
                'projectid' => $projectid,
                'title' => $title,
                'content' => $content,
                'suggest_status' => 1,
            ));
            $Suggest->update();

            //寄出電子郵件通知專案管理人
            $email = $admin_User->email;
            $email_name = 'fansWoo';
            $title = 'fansWoo專案有新的修改建議';

            $message = '您好：<br><br>我們收到一則新的修改建議<br><br>
            專案編號為：'.$projectid.'，修改建議標題：'.$Suggest->title.
            '<br><br>請至後台觀看，謝謝<br><br>後台位置：<br>
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
                'url' => 'admin/project/user/project/tablelist'
            ));
        }
        else
        {
            $validation_errors = validation_errors();
            $validation_errors = !empty($validation_errors) ? $validation_errors : '設定錯誤' ;
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => $validation_errors,
                'url' => 'admin/project/user/suggest/edit/?suggestid='.$suggestid
            ));
        }
    }

}