<?php

class Order_shop_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('AdminModel');
        $this->AdminModel->construct(['data' => $this->data, 'file' => __FILE__ ]);
    }

    public function edit()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
            
        $orderid = $this->input->get('orderid');

        $data['OrderShop'] = new OrderShop([
            'db_where_arr' => [
                'orderid' => $orderid
            ]
        ]);

        $data['transfer_SettingList'] = new SettingList([
            'db_where_arr' => [
                'modelname' => 'shop_transfer'
            ]
        ]);

        $data['Transport'] = new Transport([
            'db_where_arr' => [
                'name' => $data['OrderShop']->transport_mode
            ]
        ]);

        if(empty($data['OrderShop']->orderid))
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => '請先選擇欲修改的訂單',
                'url' => 'admin/user/order_shop/order_shop/tablelist'
            ]);
            return FALSE;
        }

        $data['order_User'] = new User([
            'db_where_arr' => [
                'uid' => $data['OrderShop']->uid
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

        $orderid = $this->input->post('orderid', TRUE);

        $OrderShop = new OrderShop([
            'db_where_arr' => [
                'orderid' => $orderid
            ]
        ]);

        //基本post欄位
        $pay_account = $this->input->post('pay_account', TRUE);
        $pay_name = $this->input->post('pay_name', TRUE);
        $pay_paytime = $this->input->post('pay_paytime', TRUE);
        $pay_remark = $this->input->post('pay_remark', TRUE);
        $content = $this->input->post('content', TRUE);

        if($OrderShop->pay_paytype == 'atm')
        {
            $pay_account = $this->input->post('pay_account', TRUE, '轉帳帳號', 'required');
            $pay_name = $this->input->post('pay_name', TRUE, '轉帳人姓名', 'required');
            $pay_paytime = $this->input->post('pay_paytime', TRUE, '轉帳時間', 'required');
        }

        if( !$this->form_validation->check() ) return FALSE;
        
        if($OrderShop->pay_paytype == 'atm')
        {
            //建構OrderShop物件，並且更新
            $OrderShop = new OrderShop([
                'orderid' => $orderid,
                'pay_account' => $pay_account,
                'pay_name' => $pay_name,
                'pay_paytime' => $pay_paytime,
                'pay_remark' => $pay_remark,
                'pay_status' => 1
            ]);
            $OrderShop->update([
                'db_update_arr' => [
                    'pay_account',
                    'pay_name',
                    'pay_paytime',
                    'pay_remark',
                    'pay_status'
                ]
            ]);
        }

        if( !empty($content) )
        {
            $Comment = new Comment([
                'uid' => $data['User']->uid,
                'typename' => 'order',
                'id' => $orderid,
                'content' => $content
            ]);
            $Comment->update();
        }

        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '設定成功',
            'url' => 'admin/user/order_shop/order_shop/tablelist'
        ]);
    }

    public function tablelist()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $data['search_orderid'] = $this->input->get('orderid');
        $data['search_title'] = $this->input->get('title');
        $data['search_class_slug'] = $this->input->get('class_slug');

        $limitstart = $this->input->get('limitstart');
        $limitcount = $this->input->get('limitcount');
        $limitcount = !empty($limitcount) ? $limitcount : 20;

        $data['OrderShopList'] = new ObjList([
            'db_where_arr' => [
                'uid' => $data['User']->uid,
                'orderid' => $data['search_orderid'],
                'order_status !=' => -1
            ],
            'db_where_like_arr' => [
                'title' => $data['search_title']
            ],
            'db_orderby_arr' => [
                'orderid' => 'DESC'
            ],
            'db_where_deletenull_bln' => TRUE,
            'model_name' => 'OrderShop',
            'limitstart' => $limitstart,
            'limitcount' => $limitcount
        ]);
        $data['page_links'] = $data['OrderShopList']->create_links(['base_url' => 'admin/'.$data['child1_name'].'/'.$data['child2_name'].'/'.$data['child3_name'].'/'.$data['child4_name']]);

        //view data設定
        $data['admin_sidebox'] = $this->AdminModel->reset_sidebox();

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

        $search_orderid = $this->input->post('search_orderid', TRUE);
        $search_class_slug = $this->input->post('search_class_slug', TRUE);
        $search_title = $this->input->post('search_title', TRUE);

        $url = 'admin/shop/product_shop/product/tablelist/?';

        if(!empty($search_orderid))
        {
            $url = $url.'&orderid='.$search_orderid;
        }

        if(!empty($search_class_slug))
        {
            $url = $url.'&class_slug='.$search_class_slug;
        }

        if(!empty($search_title))
        {
            $url = $url.'&title='.$search_title;
        }

        $this->load->model('Message');
        $this->Message->show([
            'message' => '資料存取中...',
            'url' => $url
        ]);
    }
}

?>