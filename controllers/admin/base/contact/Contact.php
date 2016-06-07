<?php

class Contact_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('AdminModel');
        $this->AdminModel->construct(['data' => $this->data, 'file' => __FILE__ ]);
    }

    public function edit()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
            
        $contactid = $this->input->get('contactid');

        if(empty($contactid))
        {
            //送出成功訊息
            $this->load->model('Message');
            $this->Message->show([
                'message' => '請選擇欲編輯的聯繫單',
                'url' => 'admin/base/contact/contact/tablelist'
            ]);
            return FALSE;
        }

        $data['Contact'] = new Contact([
            'db_where_arr' => [
                'contactid' => $contactid
            ]
        ]);

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

        //基本post欄位
        $contactid = $this->input->post('contactid', TRUE);
        $status_process = $this->input->post('status_process');

        //建構Contact物件，並且更新
        $Contact = new Contact([
            'contactid' => $contactid,
            'status_process' => $status_process
        ]);
        $Contact->update([
            'db_update_arr' => ['status_process']
        ]);

        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '設定成功',
            'url' => 'admin/base/contact/contact/tablelist'
        ]);
    }

    public function tablelist()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $data['search_contactid'] = $this->input->get('contactid');
        $data['search_username'] = $this->input->get('username');
        $data['search_status_process'] = $this->input->get('status_process');

        $limitstart = $this->input->get('limitstart');
        $limitcount = $this->input->get('limitcount');
        $limitcount = !empty($limitcount) ? $limitcount : 20;

        $data['ContactList'] = new ObjList([
            'db_where_arr' => [
                'contactid' => $data['search_contactid'],
                'status_process' => $data['search_status_process']
            ],
            'db_where_like_arr' => [
                'username' => $data['search_username']
            ],
            'db_where_or_arr' => [
                'classids' => [ $class_ClassMeta->classid ]
            ],
            'db_orderby_arr' => [
                'contactid' => 'DESC'
            ],
            'db_where_deletenull_bln' => TRUE,
            'model_name' => 'Contact',
            'limitstart' => $limitstart,
            'limitcount' => $limitcount
        ]);
        $data['page_links'] = $data['ContactList']->create_links(['base_url' => 'admin/'.$data['child1_name'].'/'.$data['child2_name'].'/'.$data['child3_name'].'/'.$data['child4_name']]);

        //temp
        $data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
        $data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['admin_header_bar'] = $this->load->view('admin/temp/admin_header_bar', $data, TRUE);
        $data['temp']['admin_footer_bar'] = $this->load->view('admin/temp/admin_footer_bar', $data, TRUE);
        $data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url'], $data);

    }

    public function tablelist_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $search_contactid = $this->input->post('search_contactid', TRUE);
        $search_status_process = $this->input->post('search_status_process', TRUE);
        $search_username = $this->input->post('search_username', TRUE);

        $url = 'admin/base/contact/contact/tablelist/?';

        if(!empty($search_contactid))
        {
            $url = $url.'&contactid='.$search_contactid;
        }

        if(!empty($search_status_process))
        {
            $url = $url.'&status_process='.$search_status_process;
        }

        if(!empty($search_username))
        {
            $url = $url.'&username='.$search_username;
        }

        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '資料存取中...',
            'url' => $url
        ]);
    }

    public function delete()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        //CSRF過濾
        if($this->input->get('hash') == $this->security->get_csrf_hash())
        {
            $Contact = new Contact([
                'contactid' => $this->input->get('contactid')
            ]);
            $Contact->delete();

            $this->load->model('Message');
            $this->Message->show([
                'message' => '刪除成功',
                'url' => 'admin/base/contact/contact/tablelist'
            ]);
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/base/contact/contact/tablelist'
            ]);
        }
    }

    public function delete_batch_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
        
        $contactid_arr = $this->input->post('contactid_arr[]');

        //CSRF過濾
        if($this->input->get('hash') == $this->security->get_csrf_hash())
        {
            if(!empty($contactid_arr))
            {
                foreach($contactid_arr as $key => $value_contact)
                {
                    $Contact = new Contact([
                        'contactid' => $value_contact
                    ]);
                    $Contact->delete();
                }
            }
            else
            {
                $this->load->model('Message');
                $this->Message->show([
                    'message' => '未選擇要刪除的聯繫單'
                ]);
                return TRUE;
            }

            $this->load->model('Message');
            $this->Message->show([
                'message' => '刪除成功',
                'url' => 'admin/base/contact/contact/tablelist'
            ]);
            return TRUE;
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/base/contact/contact/tablelist'
            ]);
            return TRUE;
        }
    }
}

?>