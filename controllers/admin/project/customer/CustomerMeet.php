<?php

class CustomerMeet_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('AdminModel');
        $this->AdminModel->construct(['data' => $this->data, 'file' => __FILE__ ]);
    }

    public function edit()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $visitid = $this->input->get('visitid');

        $data['CustomerMeet'] = new CustomerMeet([
            'db_where_arr' => [
                'visitid' => $visitid
            ]
        ]);

        $data['global']['js'][] = 'tool/ckeditor/ckeditor.js';
        $data['global']['js'][] = 'tool/jquery-ui-timepicker-addon/script.js';
        $data['global']['js'][] = 'style/jquery-ui-timepicker-addon/style.css';

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url'], $data);
    }

    public function edit_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        //基本post欄位
        $visitid = $this->input->post('visitid', TRUE);
        $customerids = $this->input->post('customerids', TRUE, '客戶ID', 'required');
        $visit_class = $this->input->post('visit_class', TRUE, '拜訪性質');
        $visit_time = $this->input->post('visit_time', TRUE, '拜訪時間');
        if( !$this->form_validation->check() ) return FALSE;

        //建構CustomerMeet物件，並且更新
        $CustomerMeet = new CustomerMeet([
            'visitid' => $visitid,
            'customerids' => $customerids,
            'visit_class' => $visit_class,
            'visit_time' => $visit_time         
        ]);
        $CustomerMeet->update();
               
        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '設定成功',
            'url' => 'admin/project/customer/customermeet/tablelist/'
        ]);
        return TRUE;
    }

    public function tablelist()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $data['search_visitid'] = $this->input->get('visitid');
        $data['search_customerids'] = $this->input->get('customerids');
        $data['search_visit_class'] = $this->input->get('visit_class');
        $data['search_visit_time'] = $this->input->get('visit_time');
        $limitstart = $this->input->get('limitstart');
        $limitcount = $this->input->get('limitcount');
        $limitcount = !empty($limitcount) ? $limitcount : 20;

        $data['CustomerMeetList'] = new ObjList([
            'db_where_arr' => [
                'customerids' => $data['search_customerids'],
                'visitid' => $data['search_visitid'],
                'visit_class like' => $data['search_visit_class'],
                'visit_time like' => $data['search_visit_time']                
            ],
            'db_orderby_arr' => [
                'visit_time' => 'DESC'
            ],
            'db_where_deletenull_bln' => TRUE,
            'obj_class' => 'CustomerMeet',
            'limitstart' => $limitstart,
            'limitcount' => $limitcount
        ]);

        $data['page_link'] = $data['CustomerMeetList']->create_links(['base_url' => 'admin/'.$data['child1_name'].'/'.$data['child2_name'].'/'.$data['child3_name'].'/'.$data['child4_name']]);

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url'], $data);

    }

    public function tablelist_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $search_customerids = $this->input->post('search_customerids', TRUE);
        $search_visitid = $this->input->post('search_visitid', TRUE);
        $search_visit_class = $this->input->post('search_visit_class', TRUE);
        $search_visit_time = $this->input->post('search_visit_time', TRUE);

        $url = 'admin/project/customer/customermeet/tablelist/?';

        if(!empty($search_customerids))
        {
            $url = $url.'&customerids='.$search_customerids;
        }
        
        if(!empty($search_visitid))
        {
            $url = $url.'&visitid='.$search_visitid;
        }

        if(!empty($search_visit_class))
        {
            $url = $url.'&visit_class='.$search_visit_class;
        }

        if(!empty($search_visit_time))
        {
            $url = $url.'&visit_time='.$search_visit_time;
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
        //CSRF過濾
        if( $this->input->get('hash') == $this->security->get_csrf_hash() )
        {
            $customermeet = new CustomerMeet([
                'visitid' => $this->input->get('visitid')
            ]);
            $customermeet->delete();

            $this->load->model('Message');
            $this->Message->show([
                'message' => '刪除成功',
                'url' => 'admin/project/customer/customermeet/tablelist'
            ]);
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/project/customer/customermeet/tablelist'
            ]);
        }
    }
}