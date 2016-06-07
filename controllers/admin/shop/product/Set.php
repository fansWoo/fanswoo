<?php

class Set_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('AdminModel');
        $this->AdminModel->construct(['data' => $this->data, 'file' => __FILE__ ]);
    }

    public function set()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        //待建立
        //設定產品庫存規格A的名稱
        //設定產品庫存規格A的勾選單(這個規格是產品顏色，並且需要顯示色碼)
        //設定產品庫存規格B的名稱

        //temp
        $data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
        $data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['admin_header_bar'] = $this->load->view('admin/temp/admin_header_bar', $data, TRUE);
        $data['temp']['admin_footer_bar'] = $this->load->view('admin/temp/admin_footer_bar', $data, TRUE);
        $data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url'], $data);
    }

    public function set_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
        //待建立
        //設定產品庫存規格A的名稱
        //設定產品庫存規格A的勾選單(這個規格是產品顏色，並且需要顯示色碼)
        //設定產品庫存規格B的名稱
    }

    public function set_destroy_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $ProductShopList = new ObjList([
            'db_where_arr' => [
                'status' => -1,
            ],
            'db_where_deletenull_bln' => TRUE,
            'model_name' => 'ProductShop',
            'limitstart' => 0,
            'limitcount' => 100
        ]);
        foreach ($ProductShopList->obj_arr as $key => $value_product)
        {
            $ProductShop = new ProductShop([
                'db_where_arr' => [
                    'productid' => $value_product->productid,
                    'status' => -1
                ]
            ]);
            foreach ($ProductShop->pic_PicObjList->obj_arr as $key => $value_pic)
            {
                $PicObj = new PicObj([
                    'db_where_arr' => [
                        'picid' => $value_pic->picid
                    ]
                ]);
                $PicObj->destroy();
            }
            $ProductShop->destroy();

            $StockProductShopList = new ObjList([
                'db_where_arr' => [
                    'productid' => $ProductShop->productid
                ],
                'db_where_deletenull_bln' => TRUE,
                'model_name' => 'StockProductShop',
                'limitstart' => 0,
                'limitcount' => 100
            ]);
            foreach ($StockProductShopList->obj_arr as $key => $value_stockproduct)
            {
                $StockProductShop = new StockProductShop([
                    'stockid' => $value_stockproduct->stockid
                ]);
                $StockProductShop->destroy();
            }
        }

        if(!empty($ProductShopList->obj_arr))
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => '銷毀成功',
                'url' => 'admin/shop/product/set/set'
            ]);
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => '已無可銷毀的項目',
                'url' => 'admin/shop/product/set/set'
            ]);
        }
    }

    public function set_recovery_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
        
        $ProductShopList = new ObjList([
            'db_where_arr' => [
                'status' => -1,
            ],
            'db_where_deletenull_bln' => TRUE,
            'model_name' => 'ProductShop',
            'limitstart' => 0,
            'limitcount' => 100
        ]);
        foreach ($ProductShopList->obj_arr as $key => $value_product)
        {
            $ProductShop = new ProductShop([
                'productid' => $value_product->productid
            ]);
            $ProductShop->recovery();
        }

        if(!empty($ProductShopList->obj_arr))
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => '復原成功',
                'url' => 'admin/shop/product/set/set'
            ]);
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => '已無可復原的項目',
                'url' => 'admin/shop/product/set/set'
            ]);
        }
    }
}

?>