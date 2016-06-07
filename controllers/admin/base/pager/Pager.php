<?php

class Pager_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('AdminModel');
        $this->AdminModel->construct(['data' => $this->data, 'file' => __FILE__ ]);
    }

    public function edit()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
            
        $pagerid = $this->input->get('pagerid');

        if(empty($pagerid))
        {
            $data['PagerField'] = new PagerField([
                'db_where_arr' => [
                    'pager.pagerid' => $pagerid
                ]
            ]);
        }
        else
        {
            $Pager = new Pager([
                'db_where_arr' => [
                    'pagerid' => $pagerid
                ]
            ]);

            if( $Pager->pagerid == 0 )
            {
                header('Location: '.base_url('admin/base/pager/pager/edit'));
            }
            else
            {
                $data['PagerField'] = new PagerField([
                    'db_where_arr' => [
                        'pager.pagerid' => $pagerid
                    ]
                ]);
            }
        }

        $data['PagerClassMetaList'] = new ObjList([
            'db_where_arr' => [
                'modelname' => 'pager'
            ],
            'model_name' => 'ClassMeta',
            'limitstart' => 0,
            'limitcount' => 100
        ]);

        $data['class_ClassMetaList'] = new ObjList([
            'db_where_arr' => [
                'modelname' => 'pager2'
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
        $pagerid = $this->input->post('pagerid', TRUE);
        $title = $this->input->post('title', TRUE, '頁面標題', 'required');
        $slug = $this->input->post('slug', TRUE);
        $href = $this->input->post('href', TRUE);
        $target = $this->input->post('target', TRUE);
        $classids_arr = $this->input->post('classids_arr', TRUE);
        $content = $this->input->post('content');
        $prioritynum = $this->input->post('prioritynum', TRUE);
        if ($this->form_validation->check() == FALSE) return FALSE;

        if(!empty($target))
        {
            $target = 1;
        }

        //建構Pager物件，並且更新
        $PagerField = new PagerField([
            'pagerid' => $pagerid,
            'title' => $title,
            'slug' => $slug,
            'href' => $href,
            'target' => $target,
            'classids_arr' => $classids_arr,
            'content' => $content,
            'prioritynum' => $prioritynum
        ]);
        $PagerField->update();

        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '設定成功',
            'url' => 'admin/base/pager/pager/tablelist/'
        ]);
    }

    public function tablelist()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $data['search_pagerid'] = $this->input->get('pagerid');
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

        $data['PagerList'] = new ObjList([
            'db_where_arr' => [
                'pagerid' => $data['search_pagerid']
            ],
            'db_where_like_arr' => [
                'title' => $data['search_title']
            ],
            'db_where_or_arr' => [
                'classids' => [$class_ClassMeta->classid]
            ],
            'db_orderby_arr' => [
                'prioritynum' => 'DESC',
                'updatetime' => 'DESC'
            ],
            'db_where_deletenull_bln' => TRUE,
            'model_name' => 'Pager',
            'limitstart' => $limitstart,
            'limitcount' => $limitcount
        ]);
        $data['page_link'] = $data['PagerList']->create_links(['base_url' => 'admin/'.$data['child1_name'].'/'.$data['child2_name'].'/'.$data['child3_name'].'/'.$data['child4_name']]);

        $data['PagerClassMetaList'] = new ObjList([
            'db_where_arr' => [
                'modelname' => 'pager'
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

        $search_pagerid = $this->input->post('search_pagerid', TRUE);
        $search_class_slug = $this->input->post('search_class_slug', TRUE);
        $search_title = $this->input->post('search_title', TRUE);

        $url = 'admin/base/pager/pager/tablelist/?';

        if(!empty($search_pagerid))
        {
            $url = $url.'&pagerid='.$search_pagerid;
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
            $PagerField = new PagerField([
                'pagerid' => $this->input->get('pagerid')
            ]);
            $PagerField->delete();

            $this->load->model('Message');
            $this->Message->show([
                'message' => '刪除成功',
                'url' => 'admin/base/pager/pager/tablelist'
            ]);
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/base/pager/pager/tablelist'
            ]);
        }
    }

    public function delete_batch_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
        
        $pagerid_arr = $this->input->post('pagerid_arr[]');

        //CSRF過濾
        if( $this->input->get('hash') == $this->security->get_csrf_hash() )
        {
            if(!empty($pagerid_arr))
            {
                foreach($pagerid_arr as $key => $pagerid)
                {
                    $PagerField = new PagerField([
                        'pagerid' => $pagerid
                    ]);
                    $PagerField->delete();
                }
            }
            else
            {
                $this->load->model('Message');
                $this->Message->show([
                    'message' => '未選擇要刪除的動態頁面'
                ]);
                return TRUE;
            }

            $this->load->model('Message');
            $this->Message->show([
                'message' => '刪除成功',
                'url' => 'admin/base/pager/pager/tablelist'
            ]);
            return TRUE;
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/base/pager/pager/tablelist'
            ]);
            return TRUE;
        }
    }
}

?>