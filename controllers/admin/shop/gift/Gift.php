<?php

class Gift_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('AdminModel');
        $this->AdminModel->construct(['data' => $this->data, 'file' => __FILE__ ]);
    }

    public function edit()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
            
        $giftid = $this->input->get('giftid');

        $data['Gift'] = new Gift([
            'db_where_arr' => [
                'giftid' => $giftid
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
        $giftid = $this->input->post('giftid', TRUE);
        $name = $this->input->post('name', TRUE, '贈品名稱', 'required');
        $synopsis = $this->input->post('synopsis', TRUE);
        $picids_arr = $this->input->post('picids_arr', TRUE);
        $prioritynum = $this->input->post('prioritynum', TRUE);
        if ($this->form_validation->check() == FALSE) return FALSE;

        //檢測名稱不能重複上傳
        $Gift = new Gift([
            'db_where_arr' => [
                'giftid !=' => $giftid,
                'name' => $name
            ]
        ]);

        if(!empty($Gift->giftid))
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => '不可重複上傳相同名字的贈品'
            ]);
            return FALSE;
        }

        //建構Gift物件，並且更新
        $Gift = new Gift([
            'giftid' => $giftid,
            'name' => $name,
            'synopsis' => $synopsis,
            'picids_arr' => $picids_arr,
            'prioritynum' => $prioritynum
        ]);
        $Gift->update();

        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '設定成功',
            'url' => 'admin/shop/gift/gift/tablelist'
        ]);
    }

    public function tablelist()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $data['search_giftid'] = $this->input->get('giftid');
        $data['search_name'] = $this->input->get('name');

        $limitstart = $this->input->get('limitstart');
        $limitcount = $this->input->get('limitcount');
        $limitcount = !empty($limitcount) ? $limitcount : 20;

        $data['GiftList'] = new ObjList([
            'db_where_arr' => [
                'giftid' => $data['search_giftid']
            ],
            'db_where_like_arr' => [
                'name' => $data['search_name']
            ],
            'db_orderby_arr' => [
                'prioritynum' => 'DESC',
                'giftid' => 'DESC'
            ],
            'db_where_deletenull_bln' => TRUE,
            'model_name' => 'Gift',
            'limitstart' => $limitstart,
            'limitcount' => $limitcount
        ]);

        $data['page_links'] = $data['GiftList']->create_links(['base_url' => 'admin/'.$data['child1_name'].'/'.$data['child2_name'].'/'.$data['child3_name'].'/'.$data['child4_name']]);

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

        $search_giftid = $this->input->post('search_giftid', TRUE);
        $search_name = $this->input->post('search_name', TRUE);

        $url = 'admin/shop/gift/gift/tablelist/?';

        if(!empty($search_giftid))
        {
            $url = $url.'&giftid='.$search_giftid;
        }

        if(!empty($search_name))
        {
            $url = $url.'&name='.$search_name;
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
        $giftid = $this->input->get('giftid');

        //CSRF過濾
        if($hash == $this->security->get_csrf_hash())
        {
            $Gift = new Gift([
                'db_where_arr' => [
                    'giftid' => $giftid
                ]
            ]);

            foreach ($Gift->pic_PicObjList->obj_arr as $key => $value_pic)
            {
                $PicObj = new PicObj([
                    'db_where_arr' => [
                        'picid' => $value_pic->picid
                    ]
                ]);
                $PicObj->destroy();
            }

            $Gift->destroy();

            $this->load->model('Message');
            $this->Message->show([
                'message' => '刪除成功',
                'url' => 'admin/shop/gift/gift/tablelist'
            ]);
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/shop/gift/gift/tablelist'
            ]);
        }
    }
}

?>