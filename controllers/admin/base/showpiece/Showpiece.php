<?php

class Showpiece_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('AdminModel');
        $this->AdminModel->construct(['data' => $this->data, 'file' => __FILE__ ]);
    }

    public function edit()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
            
        $showpieceid = $this->input->get('showpieceid');

        $data['showpiece_Showpiece'] = new Showpiece([
            'db_where_arr' => [
                'showpieceid' => $showpieceid
            ]
        ]);
        
        $data['class_ClassMetaList'] = new ObjList([
            'db_where_arr' => [
                'modelname' => 'showpiece'
            ],
            'model_name' => 'ClassMeta',
            'limitstart' => 0,
            'limitcount' => 100
        ]);
        
        $data['class2_ClassMetaList'] = new ObjList([
            'db_where_arr' => [
                'modelname' => 'showpiece_class2'
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

    public function edit_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        //基本post欄位
        $showpieceid = $this->input->post('showpieceid', TRUE);
        $name = $this->input->post('name', TRUE, '產品名稱', 'required');
        $price = $this->input->post('price', TRUE);
        $synopsis = $this->input->post('synopsis', TRUE);
        $classids_arr = $this->input->post('classids_arr', TRUE);
        $content = $this->input->post('content', FALSE);
        $content_specification = $this->input->post('content_specification', FALSE);
        $prioritynum = $this->input->post('prioritynum', TRUE);
        $picids_arr = $this->input->post('picids_arr', TRUE);
        if ($this->form_validation->check() == FALSE) return FALSE;

        //建構Showpiece物件，並且更新
        $showpiece_Showpiece = new Showpiece([
            'showpieceid' => $showpieceid,
            'name' => $name,
            'price' => $price,
            'synopsis' => $synopsis,
            'mainpicids_arr' => $mainpicids_arr,
            'picids_arr' => $picids_arr,
            'classids_arr' => $classids_arr,
            'content' => $content,
            'content_specification' => $content_specification,
            'prioritynum' => $prioritynum
        ]);
        $showpiece_Showpiece->update();

        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '設定成功',
            'url' => 'admin/base/showpiece/showpiece/tablelist'
        ]);
    }

    public function tablelist()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $data['search_showpieceid'] = $this->input->get('showpieceid');
        $data['search_name'] = $this->input->get('name');
        $data['search_class_slug'] = $this->input->get('class_slug');

        $limitstart = $this->input->get('limitstart');
        $limitcount = $this->input->get('limitcount');
        $limitcount = !empty($limitcount) ? $limitcount : 20;

        $class_ClassMeta = new ClassMeta([
            'db_where_arr' => [
                'slug' => $data['search_class_slug']
            ]
        ]);

        $data['showpiece_ShowpieceList'] = new ObjList([
            'db_where_arr' => [
                'showpieceid' => $data['search_showpieceid']
            ],
            'db_where_like_arr' => [
                'name' => $data['search_name']
            ],
            'db_where_or_arr' => [
                'classids' => [$class_ClassMeta->classid]
            ],
            'db_orderby_arr' => [
                'prioritynum' => 'DESC',
                'updatetime' => 'DESC'
            ],
            'db_where_deletenull_bln' => TRUE,
            'model_name' => 'Showpiece',
            'limitstart' => $limitstart,
            'limitcount' => $limitcount
        ]);
        $data['showpiece_links'] = $data['showpiece_ShowpieceList']->create_links(['base_url' => 'admin/'.$data['child1_name'].'/'.$data['child2_name'].'/'.$data['child3_name'].'/'.$data['child4_name']]);

        $data['class_ClassMetaList'] = new ObjList([
            'db_where_arr' => [
                'modelname' => 'showpiece'
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

        $search_showpieceid = $this->input->post('search_showpieceid', TRUE);
        $search_class_slug = $this->input->post('search_class_slug', TRUE);
        $search_name = $this->input->post('search_name', TRUE);

        $url = 'admin/base/showpiece/showpiece/tablelist/?';

        if(!empty($search_showpieceid))
        {
            $url = $url.'&showpieceid='.$search_showpieceid;
        }

        if(!empty($search_class_slug))
        {
            $url = $url.'&class_slug='.$search_class_slug;
        }

        if(!empty($search_name))
        {
            $url = $url.'&name='.$search_name;
        }

        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '設定成功',
            'url' => $url
        ]);
    }

    public function delete()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        //CSRF過濾
        if( $this->input->get('hash') == $this->security->get_csrf_hash() )
        {
            $Showpiece = new Showpiece([
                'showpieceid' => $this->input->get('showpieceid')
            ]);
            $Showpiece->delete();

            $this->load->model('Message');
            $this->Message->show([
                'message' => '刪除成功',
                'url' => 'admin/base/showpiece/showpiece/tablelist'
            ]);
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/base/showpiece/showpiece/tablelist'
            ]);
        }
    }

    public function delete_batch_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
        
        $showpieceid_arr = $this->input->post('showpieceid_arr[]');

        //CSRF過濾
        if( $this->input->get('hash') == $this->security->get_csrf_hash() )
        {
            if(!empty($showpieceid_arr))
            {
                foreach($showpieceid_arr as $key => $showpieceid)
                {
                    $Showpiece = new Showpiece([
                        'showpieceid' => $showpieceid
                    ]);
                    $Showpiece->delete();
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
                'url' => 'admin/base/showpiece/showpiece/tablelist'
            ]);
            return TRUE;
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/base/showpiece/showpiece/tablelist'
            ]);
            return TRUE;
        }
    }
}

?>