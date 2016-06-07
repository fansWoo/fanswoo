<?php

class Faq_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('AdminModel');
        $this->AdminModel->construct(['data' => $this->data, 'file' => __FILE__ ]);
    }

    public function edit()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
            
        $faqid = $this->input->get('faqid');

        $data['FaqField'] = new FaqField([
            'db_where_arr' => [
                'faq.faqid' => $faqid
            ]
        ]);

        $data['FaqClassMetaList'] = new ObjList([
            'db_where_arr' => [
                'modelname' => 'faq'
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
        $faqid = $this->input->post('faqid', TRUE);
        $title = $this->input->post('title', TRUE, '問題標題', 'required');
        $classids_arr = $this->input->post('classids_arr', TRUE);
        $content = $this->input->post('content', FALSE, '回答內容', 'required');
        $prioritynum = $this->input->post('prioritynum', TRUE);
        $updatetime = $this->input->post('updatetime', TRUE);
        if( !$this->form_validation->check() ) return FALSE;

        //建構Faq物件，並且更新
        $FaqField = new FaqField([
            'faqid' => $faqid,
            'title' => $title,
            'classids_arr' => $classids_arr,
            'content' => $content,
            'prioritynum' => $prioritynum,
            'updatetime' => $updatetime,
            'modelname' => 'faq'
        ]);
        $FaqField->update();

        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '設定成功',
            'url' => 'admin/base/faq/faq/tablelist/'
        ]);
    }

    public function tablelist()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $data['search_faqid'] = $this->input->get('faqid');
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

        $data['FaqList'] = new ObjList([
            'db_where_arr' => [
                'modelname' => 'faq',
                'faqid' => $data['search_faqid']
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
            'model_name' => 'Faq',
            'limitstart' => $limitstart,
            'limitcount' => $limitcount
        ]);
        $data['page_link'] = $data['FaqList']->create_links(['base_url' => 'admin/'.$data['child1_name'].'/'.$data['child2_name'].'/'.$data['child3_name'].'/'.$data['child4_name']]);

        $data['FaqClassMetaList'] = new ObjList([
            'db_where_arr' => [
                'modelname' => 'faq'
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

        $search_faqid = $this->input->post('search_faqid', TRUE);
        $search_class_slug = $this->input->post('search_class_slug', TRUE);
        $search_title = $this->input->post('search_title', TRUE);

        $url = 'admin/base/faq/faq/tablelist/?';

        if(!empty($search_faqid))
        {
            $url = $url.'&faqid='.$search_faqid;
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
        if( $this->input->get('hash') == $this->security->get_csrf_hash() )
        {
            $FaqField = new FaqField([
                'faqid' => $this->input->get('faqid')
            ]);
            $FaqField->delete();

            $this->load->model('Message');
            $this->Message->show([
                'message' => '刪除成功',
                'url' => 'admin/base/faq/faq/tablelist'
            ]);
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/base/faq/faq/tablelist'
            ]);
        }
    }

    public function delete_batch_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
        
        $faqid_arr = $this->input->post('faqid_arr[]');

        if( empty($faqid_arr) )
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => '未選擇要刪除的常見問題'
            ]);
            return TRUE;
        }

        //CSRF過濾
        if($this->input->get('hash') == $this->security->get_csrf_hash())
        {
            if(!empty($faqid_arr))
            {
                foreach($faqid_arr as $key => $faqid)
                {
                    $FaqField = new FaqField([
                        'faqid' => $faqid
                    ]);
                    $FaqField->delete();
                }
            }

            $this->load->model('Message');
            $this->Message->show([
                'message' => '刪除成功',
                'url' => 'admin/base/faq/faq/tablelist'
            ]);
            return TRUE;
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/base/faq/faq/tablelist'
            ]);
            return TRUE;
        }
    }
}

?>