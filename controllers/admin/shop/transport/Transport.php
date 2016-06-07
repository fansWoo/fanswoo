<?php

class Transport_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('AdminModel');
        $this->AdminModel->construct(['data' => $this->data, 'file' => __FILE__ ]);
    }

    public function edit()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
            
        $transportid = $this->input->get('transportid');

        $data['Transport'] = new Transport([
            'db_where_arr' => [
                'transportid' => $transportid
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
        $transportid = $this->input->post('transportid', TRUE);
        $name = $this->input->post('name', TRUE, '運輸名稱', 'required');
        $company = $this->input->post('company', TRUE, '運輸公司', 'required');
        $url = $this->input->post('url', TRUE, '輸查貨網址', 'required');
        $base_price = $this->input->post('base_price', TRUE);
        $additional_price = $this->input->post('additional_price', TRUE);
        $prioritynum = $this->input->post('prioritynum', TRUE);
        if ($this->form_validation->check() == FALSE) return FALSE;

        //檢測不能重複上傳
        $Transport = new Transport([
            'db_where_arr' => [
                'transportid !=' => $transportid,
                'name' => $name
            ]
        ]);

        if(!empty($Transport->transportid))
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => '不可重複上傳相同名字的運輸方式',
                'url' => 'admin/shop/transport/transport/tablelist'
            ]);
            return FALSE;
        }

        //建構Transport物件，並且更新
        $Transport = new Transport([
            'transportid' => $transportid,
            'name' => $name,
            'company' => $company,
            'url' => $url,
            'base_price' => $base_price,
            'additional_price' => $additional_price,
            'prioritynum' => $prioritynum
        ]);
        $Transport->update();

        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '設定成功',
            'url' => 'admin/shop/transport/transport/tablelist'
        ]);
    }

    public function tablelist()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $data['search_transportid'] = $this->input->get('transportid');
        $data['search_name'] = $this->input->get('name');
        $data['search_company'] = $this->input->get('company');

        $limitstart = $this->input->get('limitstart');
        $limitcount = $this->input->get('limitcount');
        $limitcount = !empty($limitcount) ? $limitcount : 20;

        $data['TransportList'] = new ObjList([
            'db_where_arr' => [
                'transportid' => $data['search_transportid']
            ],
            'db_where_like_arr' => [
                'name' => $data['search_name'],
                'company' => $data['search_company']
            ],
            'db_orderby_arr' => [
                'prioritynum' => 'DESC',
                'transportid' => 'DESC'
            ],
            'db_where_deletenull_bln' => TRUE,
            'model_name' => 'Transport',
            'limitstart' => $limitstart,
            'limitcount' => $limitcount
        ]);

        $data['page_links'] = $data['TransportList']->create_links(['base_url' => 'admin/'.$data['child1_name'].'/'.$data['child2_name'].'/'.$data['child3_name'].'/'.$data['child4_name']]);

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

        $search_transportid = $this->input->post('search_transportid', TRUE);
        $search_name = $this->input->post('search_name', TRUE);
        $search_company = $this->input->post('search_company', TRUE);

        $url = 'admin/shop/transport/transport/tablelist/?';

        if(!empty($search_transportid))
        {
            $url = $url.'&transportid='.$search_transportid;
        }

        if(!empty($search_name))
        {
            $url = $url.'&name='.$search_name;
        }

        if(!empty($search_company))
        {
            $url = $url.'&company='.$search_company;
        }

        $this->load->model('Message');
        $this->Message->show([
            'message' => '資料存取中...',
            'url' => $url
        ]);
    }

    public function delete()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
        
        $hash = $this->input->get('hash');
        $transportid = $this->input->get('transportid');

        //CSRF過濾
        if($hash == $this->security->get_csrf_hash())
        {
            $Transport = new Transport([
                'transportid' => $transportid
            ]);
            $Transport->destroy();

            $this->load->model('Message');
            $this->Message->show([
                'message' => '刪除成功',
                'url' => 'admin/shop/transport/transport/tablelist'
            ]);
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/shop/transport/transport/tablelist'
            ]);
        }
    }
}

?>