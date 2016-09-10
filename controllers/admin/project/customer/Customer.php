<?php

class Customer_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('AdminModel');
        $this->AdminModel->construct(['data' => $this->data, 'file' => __FILE__ ]);
    }

    public function edit()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $customerid = $this->input->get('customerid');

        $data['Customer'] = new Customer([
            'db_where_arr' => [
                'customerid' => $customerid
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
        $customerid = $this->input->post('customerid', TRUE);
        $customer_name = $this->input->post('customer_name', TRUE, '客戶名稱', 'required');
        $company = $this->input->post('company', TRUE, '公司名稱', 'required');
        $phone = $this->input->post('phone', TRUE, '手機號碼', 'required');
        $tel = $this->input->post('tel', TRUE, '公司電話');
        $email = $this->input->post('email', TRUE, '電子郵件', 'required|valid_email');
        $address = $this->input->post('address', TRUE, '公司地址', 'required');
        $wish = $this->input->post('wish','意願',TRUE);
        $budget_range = $this->input->post('budget_range', TRUE, '預算', 'required');
        $content = $this->input->post('content', FALSE, '功能需求');
        $contact_time = $this->input->post('contact_time', TRUE, '最後聯繫時間');
        $website = $this->input->post('website', TRUE, '公司網址');
        $prioritynum = $this->input->post('prioritynum', TRUE);
        $updatetime = $this->input->post('updatetime', TRUE, 名單新增時間);
        if( !$this->form_validation->check() ) return FALSE;

        //建構Customer物件，並且更新
        $Customer = new Customer([
            'customerid' => $customerid,
            'customer_name' => $customer_name,
            'company' => $company,
            'phone' => $phone,
        	'tel'=> $tel,
            'email' => $email,
            'address' => $address, 
            'wish' => $wish,
            'budget_range' => $budget_range,
            'content' => $content,
            'contact_time' => $contact_time,
            'website' => $website,
            'prioritynum' => $prioritynum,
            'updatetime' => $updatetime,
        ]);
        $Customer->update();
               
        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '設定成功',
            'url' => 'admin/project/customer/customer/tablelist/'
        ]);
        return TRUE;
    }

    public function tablelist()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $data['search_customerid'] = $this->input->get('customerid');
        $data['search_company'] = $this->input->get('company');
        $data['search_customer_name'] = $this->input->get('customer_name');
        $data['search_wish'] = $this->input->get('wish');
        $data['search_contact_time'] = $this->input->get('contact_time');
        $data['search_class_slug'] = $this->input->get('class_slug');
        $data['search_budget_range'] = $this->input->get('budget_range');
        $limitstart = $this->input->get('limitstart');
        $limitcount = $this->input->get('limitcount');
        $limitcount = !empty($limitcount) ? $limitcount : 20;

        $class_ClassMeta = new ClassMeta([
            'db_where_arr' => [
                'slug' => $data['search_class_slug']
            ]
        ]);

        $data['CustomerList'] = new ObjList([
            'db_where_arr' => [
                'customerid' => $data['search_customerid'],
                'company like' => $data['search_company'],
                'customer_name like' => $data['search_customer_name'],
                'wish like' => $data['search_wish'],
                'budget_range like' => $data['search_budget_range']
            ],
            'db_orderby_arr' => [
                'prioritynum' => 'DESC',
                'updatetime' => 'DESC'
            ],
            'db_where_deletenull_bln' => TRUE,
            'obj_class' => 'Customer',
            'limitstart' => $limitstart,
            'limitcount' => $limitcount
        ]);

        $data['page_link'] = $data['CustomerList']->create_links(['base_url' => 'admin/'.$data['child1_name'].'/'.$data['child2_name'].'/'.$data['child3_name'].'/'.$data['child4_name']]);
        
        
        $data['ClassMetaList'] = new ObjList([
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
        $search_customer_name = $this->input->post('search_customer_name', TRUE);
        $search_wish = $this->input->post('search_wish', TRUE);
        $search_contact_time = $this->input->post('search_contact_time', TRUE);
        $search_budget_range = $this->input->post('search_budget_range', TRUE);
        $search_updatetime = $this->input->post('search_updatetime', TRUE);
        


        $url = 'admin/project/customer/customer/tablelist/?';

        if(!empty($search_customerid))
        {
            $url = $url.'&customerid='.$search_customerid;
        }
        
        if(!empty($search_company))
        {
        	$url = $url.'&company='.$search_company;
        }

        if(!empty($search_customer_name))
        {
            $url = $url.'&customer_name='.$search_customer_name;
        }
        
        if(!empty($search_wish))
        {
        	$url = $url.'&wish='.$search_wish;
        }

        if(!empty($search_contact_time))
        {
            $url = $url.'&contact_time='.$search_contact_time;
        }
        if(!empty($search_budget_range))
        {
            $url = $url.'&budget_range='.$search_budget_range;
        }
        if(!empty($search_updatetime))
        {
            $url = $url.'&updatetime='.$search_updatetime;
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
            $url = 'admin/project/customer/customer/tablelist';
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

?>