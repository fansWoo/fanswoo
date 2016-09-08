<?php

class Customer_meet_Controller extends MY_Controller {

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

        $data['Customer_meet'] = new Customer_meet([
            'db_where_arr' => [
                'visitid' => $visitid
            ]
        ]);

        $data['global']['js'][] = 'tool/ckeditor/ckeditor.js';
        $data['global']['js'][] = 'tool/jquery-ui-timepicker-addon/script.js';
        $data['global']['js'][] = 'tool/jquery-ui-timepicker-addon/style.css';

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url'], $data);
    }

    public function edit_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        //基本post欄位
        $visitid = $this->input->post('visitid', TRUE);
        $customerids = $this->input->post('customerids', TRUE, '客戶ID', 'required');
        $visit = $this->input->post('visit', TRUE, '拜訪性質');
        $visit_time = $this->input->post('visit_time', TRUE, '拜訪時間');
        if( !$this->form_validation->check() ) return FALSE;

        //建構Customer_meet物件，並且更新
        $Customer_meet = new Customer_meet([
            'visitid' => $visitid,
            'customerids' => $customerids,
            'visit_' => $visit,
            'visit_time' => $visit_time
            
            
        ]);
        $Customer_meet->update();
               
        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '設定成功',
            'url' => 'admin/project/customer/customer_meet/tablelist/'
        ]);
        return TRUE;
    }

    public function tablelist()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $data['search_visitid'] = $this->input->get('visitid');
        $data['search_customerids'] = $this->input->get('customerids');
        $data['search_visit'] = $this->input->get('visit');
        $data['search_visit_time'] = $this->input->get('visit_time');
        $data['search_class_slug'] = $this->input->get('class_slug');
        $limitstart = $this->input->get('limitstart');
        $limitcount = $this->input->get('limitcount');
        $limitcount = !empty($limitcount) ? $limitcount : 20;

        $class_ClassMeta = new ClassMeta([
            'db_where_arr' => [
                'slug' => $data['search_class_slug']
            ]
        ]);

        $data['Customer_meetList'] = new ObjList([
            'db_where_arr' => [
                'customerids' => $data['search_customerids'],
                'visitid' => $data['search_visitid'],
                'visit like' => $data['search_visit'],
                'visit_time like' => $data['search_visit_time']
                
            ],
            'db_orderby_arr' => [
                // 'prioritynum' => 'DESC',
                'visit_time' => 'DESC'
            ],
            'db_where_deletenull_bln' => TRUE,
            'obj_class' => 'Customer_meet',
            'limitstart' => $limitstart,
            'limitcount' => $limitcount
        ]);

        $data['page_link'] = $data['CustomerList']->create_links(['base_url' => 'admin/'.$data['child1_name'].'/'.$data['child2_name'].'/'.$data['child3_name'].'/'.$data['child4_name']]);
        
        
        $data['Customer_meetClassMetaList'] = new ObjList([
            'db_where_arr' => [
                'modelname' => 'customer'
            ],
            'obj_class' => 'ClassMeta',
            'limitstart' => 0,
            'limitcount' => 100
        ]);

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url'], $data);

    }

    public function tablelist_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $search_customerid = $this->input->post('search_customerid', TRUE);
        $search_company = $this->input->post('search_company', TRUE);           
        $search_class_slug = $this->input->post('search_class_slug', TRUE);
        $search_visit = $this->input->post('search_visit', TRUE);
        $search_visit_time = $this->input->post('search_visit_time', TRUE);
        


        $url = 'admin/project/customer/customer/tablelist/?';

        if(!empty($search_customerid))
        {
            $url = $url.'&customerid='.$search_customerid;
        }
        
        if(!empty($search_company))
        {
            $url = $url.'&company='.$search_company;
        }

        if(!empty($search_visit))
        {
            $url = $url.'&visit='.$search_visit;
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

    public function calendar()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $data['CustomerClassMetaList'] = new ObjList([
            'db_where_arr' => [
                'modelname' => 'customer'
            ],
            'obj_class' => 'ClassMeta',
            'limitstart' => 0,
            'limitcount' => 100
        ]);
              
        //global
        $data['global']['js'][] = 'tool/ckeditor/ckeditor.js';
        $data['global']['js'][] = 'tool/jquery-ui-timepicker-addon/script.js';
        $data['global']['js'][] = 'tool/jquery-ui-timepicker-addon/zh-tw.js';
        $data['global']['js'][] = 'tool/jquery-ui-timepicker-addon/style.css';
        $data['global']['js'][] = 'tool/fullcalendar/moment.min.js';
        $data['global']['js'][] = 'tool/fullcalendar/fullcalendar.min.js';
        $data['global']['js'][] = 'tool/fullcalendar/gcal.js';
        $data['global']['js'][] = 'admin/project/customer/customer/calendar.js';

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url'], $data);

    }

    public function delete()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $url = FALSE;
        $dont_change_page = $this->input->get('dont_change_page');
        if( empty( $dont_change_page ) )
        {
            $url = 'admin/project/customer/customer_meet/tablelist';
        }

        //CSRF過濾
        if( $this->input->get('hash') == $this->security->get_csrf_hash() )
        {
            $customer = new customer([
                'customerid' => $this->input->get('customerid')
            ]);
            $customer->delete();

            $this->load->model('Message');
            $this->Message->show([
                'message' => '刪除成功',
                'url' => $url
            ]);
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => $url
            ]);
        }
    }
}

}