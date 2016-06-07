<?php

class Advertising_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('AdminModel');
        $this->AdminModel->construct(['data' => $this->data, 'file' => __FILE__ ]);
    }

    public function edit()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
            
        $advertisingid = $this->input->get('advertisingid');

        $data['Advertising'] = new Advertising([
            'db_where_arr' => [
                'advertisingid' => $advertisingid
            ]
        ]);

        $data['AdvertisingClassList'] = new ObjList([
            'db_where_arr' => [
                'modelname' => 'advertising'
            ],
            'db_orderby_arr' => [
                'prioritynum' => 'DESC',
                'classid' => 'ASC'
            ],
            'db_where_deletenull_bln' => TRUE,
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

    public function edit_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        //基本post欄位
        $advertisingid = $this->input->post('advertisingid', TRUE);
        $title = $this->input->post('title', TRUE, '廣告標題', 'required');
        $href = $this->input->post('href', TRUE, '廣告連結', 'required');
        $classids_arr = $this->input->post('classids_arr', TRUE);
        $content = $this->input->post('content');
        $prioritynum = $this->input->post('prioritynum', TRUE);
        $picids_arr = $this->input->post('picids_arr', TRUE);
        if( !$this->form_validation->check() ) return FALSE;

        //建構Advertising物件，並且更新
        $Advertising = new Advertising([
            'advertisingid' => $advertisingid,
            'title' => $title,
            'href' => $href,
            'picids_arr' => $picids_arr,
            'classids_arr' => $classids_arr,
            'content' => $content,
            'prioritynum' => $prioritynum
        ]);
        $Advertising->update();

        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '設定成功',
            'url' => 'admin/base/advertising/advertising/tablelist'
        ]);
    }

    public function tablelist()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $data['search_advertisingid'] = $this->input->get('advertisingid');
        $data['search_title'] = $this->input->get('title');
        $data['search_class_slug'] = $this->input->get('class_slug');

        $limitstart = $this->input->get('limitstart');
        $limitcount = $this->input->get('limitcount');
        $limitcount = !empty($limitcount) ? $limitcount : 20;

        $class_ClassMeta = new ClassMeta([
            'db_where_arr' => [
                'slug' => $data['search_class_slug']
            ]
        ]);

        $data['AdvertisingList'] = new ObjList([
            'db_where_arr' => [
                'advertisingid' => $data['search_advertisingid']
            ],
            'db_where_like_arr' => [
                'title' => $data['search_title']
            ],
            'db_where_or_arr' => [
                'classids' => [ $class_ClassMeta->classid ]
            ],
            'db_orderby_arr' => [
                'prioritynum' => 'DESC',
                'updatetime' => 'DESC'
            ],
            'db_where_deletenull_bln' => TRUE,
            'model_name' => 'Advertising',
            'limitstart' => $limitstart,
            'limitcount' => $limitcount
        ]);
        $data['page_link'] = $data['AdvertisingList']->create_links(['base_url' => 'admin/'.$data['child1_name'].'/'.$data['child2_name'].'/'.$data['child3_name'].'/'.$data['child4_name']]);

        $data['AdvertisingClassList'] = new ObjList([
            'db_where_arr' => [
                'modelname' => 'advertising'
            ],
            'db_where_deletenull_bln' => TRUE,
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

        $search_advertisingid = $this->input->post('search_advertisingid', TRUE);
        $search_class_slug = $this->input->post('search_class_slug', TRUE);
        $search_title = $this->input->post('search_title', TRUE);

        $url = 'admin/base/advertising/advertising/tablelist/?';

        if(!empty($search_advertisingid))
        {
            $url = $url.'&advertisingid='.$search_advertisingid;
        }

        if(!empty($search_class_slug))
        {
            $url = $url.'&class_slug='.$search_class_slug;
        }

        if(!empty($search_title))
        {
            $url = $url.'&title='.$search_title;
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
            $Advertising = new Advertising([
                'db_where_arr' => [
                    'advertisingid' => $this->input->get('advertisingid'),
                    'status' => 1,
                ]
            ]);
            foreach ($Advertising->pic_PicObjList->obj_arr as $key => $value_pic)
            {
                $PicObj = new PicObj([
                    'db_where_arr' => [
                        'picid' => $value_pic->picid
                    ]
                ]);
                $PicObj->destroy();
            }
            $Advertising->destroy();

            $this->load->model('Message');
            $this->Message->show([
                'message' => '刪除成功',
                'url' => 'admin/base/advertising/advertising/tablelist',
                'return_type' => 'page'
            ]);
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/base/advertising/advertising/tablelist',
                'return_type' => 'page'
            ]);
        }
    }
}

?>