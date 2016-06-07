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

        if(empty($data['OrderShop']->orderid))
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => '請先選擇欲修改的訂單',
                'url' => 'admin/shop/order_shop/order_shop/tablelist'
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

        //基本post欄位
        $orderid = $this->input->post('orderid', TRUE);
        $paycheck_status = $this->input->post('paycheck_status', TRUE);
        $product_status = $this->input->post('product_status', TRUE);
        $receive_name = $this->input->post('receive_name', TRUE);
        $receive_phone = $this->input->post('receive_phone', TRUE);
        $receive_time = $this->input->post('receive_time', TRUE);
        $receive_address = $this->input->post('receive_address', TRUE);
        $receive_remark = $this->input->post('receive_remark', TRUE);
        $transport_id = $this->input->post('transport_id', TRUE);
        $sendtime = $this->input->post('sendtime', TRUE);
        $order_status = $this->input->post('order_status', TRUE);
        $content = $this->input->post('content', TRUE);

        //建構OrderShop物件，並且更新
        $OrderShop = new OrderShop([
            'orderid' => $orderid,
            'paycheck_status' => $paycheck_status,
            'product_status' => $product_status,
            'receive_name' => $receive_name,
            'receive_phone' => $receive_phone,
            'receive_time' => $receive_time,
            'receive_address' => $receive_address,
            'receive_remark' => $receive_remark,
            'transport_id' => $transport_id,
            'sendtime' => $sendtime,
            'updatetime' => '',
            'order_status' => $order_status
        ]);
        $OrderShop->update([
            'db_update_arr' => [
                'paycheck_status',
                'product_status',
                'receive_name',
                'receive_phone',
                'receive_time',
                'receive_address',
                'receive_remark',
                'transport_id',
                'sendtime',
                'updatetime',
                'order_status'
            ]
        ]);        if( !empty($content) )
        {
            $Comment = new Comment([
                'uid' => $data['User']->uid,
                'typename' => 'order',
                'id' => $OrderShop->orderid,
                'content' => $content
            ]);
            $Comment->update();
        }

        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '設定成功',
            'url' => 'admin/shop/order_shop/order_shop/tablelist'
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

    public function delete()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        //CSRF過濾
        if( $this->input->get('hash') == $this->security->get_csrf_hash() )
        {
            $OrderShop = new OrderShop([
                'orderid' => $this->input->get('orderid')
            ]);
            $OrderShop->delete();

            $this->load->model('Message');
            $this->Message->show([
                'message' => '刪除成功',
                'url' => 'admin/shop/order_shop/order_shop/tablelist'
            ]);
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/shop/order_shop/order_shop/tablelist'
            ]);
        }
    }

    public function delete_batch_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
        
        $orderid_arr = $this->input->post('orderid_arr[]');
        
        //CSRF過濾
        if( $this->input->get('hash') == $this->security->get_csrf_hash() )
        {
            if(!empty($orderid_arr))
            {
                foreach($orderid_arr as $key => $orderid)
                {
                    $OrderShop = new OrderShop([
                        'orderid' => $orderid
                    ]);
                    $OrderShop->delete();
                }
            }
            else
            {
                $this->load->model('Message');
                $this->Message->show([
                    'message' => '未選擇要刪除的訂單'
                ]);
                return TRUE;
            }

            $this->load->model('Message');
            $this->Message->show([
                'message' => '刪除成功',
                'url' => 'admin/shop/order_shop/order_shop/tablelist'
            ]);
            return TRUE;
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/shop/order_shop/order_shop/tablelist'
            ]);
            return TRUE;
        }
    }
}

?>