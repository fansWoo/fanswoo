<?php

class Product_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('AdminModel');
        $this->AdminModel->construct(['data' => $this->data, 'file' => __FILE__ ]);
    }

    public function edit()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
            
        $productid = $this->input->get('productid');

        $data['product_ProductShop'] = new ProductShop([
            'db_where_arr' => [
                'productid' => $productid
            ]
        ]);
        
        $data['class_ClassMetaList'] = new ObjList([
            'db_where_arr' => [
                'modelname' => 'product'
            ],
            'model_name' => 'ClassMeta',
            'limitstart' => 0,
            'limitcount' => 100
        ]);
        
        $data['class2_ClassMetaList'] = new ObjList([
            'db_where_arr' => [
                'modelname' => 'product_shop_class2'
            ],
            'model_name' => 'ClassMeta',
            'limitstart' => 0,
            'limitcount' => 100
        ]);

        $data['global']['js'][] = 'admin/shop.js';

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
        $productid = $this->input->post('productid', TRUE);
        $name = $this->input->post('name', TRUE, '產品名稱', 'required');
        $price = $this->input->post('price', TRUE);
        $cost = $this->input->post('cost', TRUE);
        $synopsis = $this->input->post('synopsis', TRUE);
        $classids_arr = $this->input->post('classids_arr', TRUE);
        $content = $this->input->post('content', FALSE);
        $content_specification = $this->input->post('content_specification', FALSE);
        $warehouseid = $this->input->post('warehouseid', TRUE);
        $prioritynum = $this->input->post('prioritynum', TRUE);
        $picids_arr = $this->input->post('picids_arr', TRUE);
        $shelves_status = $this->input->post('shelves_status', TRUE);
        $show_bln = $this->input->post('show_bln', TRUE);

        $this->form_validation->set_rules('stock_classname1Arr[0]', '庫存規格1', 'required');
        $this->form_validation->set_rules('stock_classname2Arr[0]', '庫存規格2', 'required');

        $stockidArr = $this->input->post('stockidArr', TRUE);
        $stock_classname1Arr = $this->input->post('stock_classname1Arr', TRUE);
        $stock_classname2Arr = $this->input->post('stock_classname2Arr', TRUE);
        $stock_color_rgbArr = $this->input->post('stock_color_rgbArr', TRUE);
        $stock_stocknumArr = $this->input->post('stock_stocknumArr', TRUE);
        if ($this->form_validation->check() == FALSE) return FALSE;

        for( $i = 0 ; $i < count($stock_classname1Arr) - 2; $i++ )
        {
            if( empty($stock_classname1Arr[$i]) )
            {
                //送出成功訊息
                $this->load->model('Message');
                $this->Message->show([
                    'message' => '產品庫存欄位不能為空'
                ]);
                return FALSE;
            }
        }

        if(!empty($show_bln))
        {
            $shelves_status = 2;
        }

        //建構ProductShop物件，並且更新
        $product_ProductShop = new ProductShop([
            'productid' => $productid,
            'name' => $name,
            'price' => $price,
            'cost' => $cost,
            'synopsis' => $synopsis,
            'picids_arr' => $picids_arr,
            'classids_arr' => $classids_arr,
            'content' => $content,
            'content_specification' => $content_specification,
            'warehouseid' => $warehouseid,
            'prioritynum' => $prioritynum,
            'shelves_status' => $shelves_status,
        ]);
        $product_ProductShop->update();

        //計算庫存
        $stock_classname1Arr_count = count($stock_classname1Arr);
        foreach( $stock_classname1Arr as $key => $value)
        {
            if( !empty( $value ) )
            {
                $StockProductShop = new StockProductShop([
                    'stockid' => $stockidArr[$key],
                    'productid' => $product_ProductShop->productid,
                    'classname1' => $stock_classname1Arr[$key],
                    'classname2' => $stock_classname2Arr[$key],
                    'color_rgb' => $stock_color_rgbArr[$key],
                    'stocknum' => $stock_stocknumArr[$key],
                    'prioritynum' => $stock_classname1Arr_count - $key
                ]);
                $StockProductShop->update();
            }
        }

        if(!empty($show_bln))
        {
            //送出成功訊息
            $this->load->model('Message');
            $this->Message->show([
                'message' => '草稿預覽中...',
                'url' => 'product/'.$product_ProductShop->productid
            ]);
        }
        else
        {
            //送出成功訊息
            $this->load->model('Message');
            $this->Message->show([
                'message' => '設定成功',
                'url' => 'admin/shop/product/product/tablelist'
            ]);
        }
    }

    public function copy()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $productid = $this->input->get('productid');

        $product2_ProductShop = new ProductShop([
            'db_where_arr' => [
                'productid' => $productid
            ]
        ]);

        //建構ProductShopNxstgirl物件，並且更新
        $product_ProductShop = new ProductShop([
            'name' => $product2_ProductShop->name,
            'price' => $product2_ProductShop->price,
            'cost' => $product2_ProductShop->cost,
            'synopsis' => $product2_ProductShop->synopsis,
            'classids_arr' => $product2_ProductShop->class_ClassMetaList->uniqueids_arr,
            'content' => $product2_ProductShop->content_Html,
            'content_specification' => $product2_ProductShop->content_specification_Html,
            'precautions' => $product2_ProductShop->precautions_Html,
            'warehouseid' => $product2_ProductShop->warehouseid,
            'prioritynum' => $product2_ProductShop->prioritynum,
        ]);

        $product_ProductShop->update();

        $stock_count = count($product2_ProductShop->stock_StockProductShopList->obj_arr);
        foreach( $product2_ProductShop->stock_StockProductShopList->obj_arr as $key => $value_StockProductShop )
        {
            $StockProductShop = new StockProductShop([
                'productid' => $product_ProductShop->productid,
                'classname1' => $value_StockProductShop->classname1,
                'classname2' => $value_StockProductShop->classname2,
                'color_rgb' => $value_StockProductShop->color_rgb,
                'stocknum' => $value_StockProductShop->stocknum,
                'prioritynum' => $stock_count - $key
            ]);
            $StockProductShop->update();
        }

        if($product_ProductShop->productid !== NULL)
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => '複製成功，請篩選未上架產品查看',
                'url' => 'admin/shop/product/product/tablelist'
            ]);
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => '複製失敗',
                'url' => 'admin/shop/product/product/tablelist'
            ]);
        }
    }

    public function tablelist()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $data['search_productid'] = $this->input->get('productid');
        $data['search_name'] = $this->input->get('name');
        $data['search_class_slug'] = $this->input->get('class_slug');
        $data['search_warehouseid'] = $this->input->get('warehouseid');
        $data['search_shelves_status'] = $this->input->get('shelves_status');

        //預設顯示已上架產品
        if(empty($data['search_shelves_status']))
        {
            $data['search_shelves_status'] = 1;
        }

        $limitstart = $this->input->get('limitstart');
        $limitcount = $this->input->get('limitcount');
        $limitcount = !empty($limitcount) ? $limitcount : 20;

        $class_ClassMeta = new ClassMeta([
            'db_where_arr' => [
                'slug' => $data['search_class_slug']
            ]
        ]);

        $data['product_ProductShopList'] = new ObjList([
            'db_where_arr' => [
                'productid' => $data['search_productid'],
                'shelves_status' => $data['search_shelves_status']
            ],
            'db_where_like_arr' => [
                'name' => $data['search_name'],
                'warehouseid'=>  $data['search_warehouseid']
            ],
            'db_where_or_arr' => [
                'classids' => [$class_ClassMeta->classid]
            ],
            'db_orderby_arr' => [
                'prioritynum' => 'DESC',
                'productid' => 'DESC'
            ],
            'db_where_deletenull_bln' => TRUE,
            'model_name' => 'ProductShop',
            'limitstart' => $limitstart,
            'limitcount' => $limitcount
        ]);

        $data['product_links'] = $data['product_ProductShopList']->create_links(['base_url' => 'admin/'.$data['child1_name'].'/'.$data['child2_name'].'/'.$data['child3_name'].'/'.$data['child4_name']]);

        $data['class_ClassMetaList'] = new ObjList([
            'db_where_arr' => [
                'modelname' => 'product_shop'
            ],
            'model_name' => 'ClassMeta',
            'limitstart' => 0,
            'limitcount' => 100
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

    public function tablelist_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $search_productid = $this->input->post('search_productid', TRUE);
        $search_class_slug = $this->input->post('search_class_slug', TRUE);
        $search_name = $this->input->post('search_name', TRUE);
        $search_warehouseid = $this->input->post('search_warehouseid', TRUE);
        $search_shelves_status = $this->input->post('search_shelves_status', TRUE);

        $url = 'admin/shop/product/product/tablelist/?';

        if(!empty($search_productid))
        {
            $url = $url.'&productid='.$search_productid;
        }

        if(!empty($search_class_slug))
        {
            $url = $url.'&class_slug='.$search_class_slug;
        }

        if(!empty($search_name))
        {
            $url = $url.'&name='.$search_name;
        }

        if(!empty($search_warehouseid))
        {
            $url = $url.'&warehouseid='.$search_warehouseid;
        }

        if(!empty($search_shelves_status))
        {
            $url = $url.'&shelves_status='.$search_shelves_status;
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
            $ProductShop = new ProductShop([
                'productid' => $this->input->get('productid')
            ]);
            $ProductShop->delete();

            $this->load->model('Message');
            $this->Message->show([
                'message' => '刪除成功',
                'url' => 'admin/shop/product/product/tablelist'
            ]);
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/shop/product/product/tablelist'
            ]);
        }
    }

    public function delete_batch_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
        
        $productid_arr = $this->input->post('productid_arr[]');

        //CSRF過濾
        if( $this->input->get('hash') == $this->security->get_csrf_hash() )
        {
            if(!empty($productid_arr))
            {
                foreach($productid_arr as $key => $productid)
                {
                    $ProductShop = new ProductShop([
                        'productid' => $productid
                    ]);
                    $ProductShop->delete();
                }
            }
            else
            {
                $this->load->model('Message');
                $this->Message->show([
                    'message' => '未選擇要刪除的產品'
                ]);
                return TRUE;
            }

            $this->load->model('Message');
            $this->Message->show([
                'message' => '刪除成功',
                'url' => 'admin/shop/product/product/tablelist'
            ]);
            return TRUE;
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/shop/product/product/tablelist'
            ]);
            return TRUE;
        }
    }
}

?>