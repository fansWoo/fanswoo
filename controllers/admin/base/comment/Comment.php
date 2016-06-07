<?php

class Comment_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('AdminModel');
        $this->AdminModel->construct(['data' => $this->data, 'file' => __FILE__ ]);
    }

    public function edit()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
            
        $commentid = $this->input->get('commentid');

        if(empty($commentid))
        {
            //送出成功訊息
            $this->load->model('Message');
            $this->Message->show([
                'message' => '請選擇欲查看的留言',
                'url' => 'admin/base/comment/comment/tablelist'
            ]);
            return FALSE;
        }

        $data['Comment'] = new Comment([
            'db_where_arr' => [
                'commentid' => $commentid
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

    public function tablelist()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $data['search_content'] = $this->input->get('content');
        $data['search_uid'] = $this->input->get('uid');
        $data['search_class_slug'] = $this->input->get('class_slug');

        $limitstart = $this->input->get('limitstart');
        $limitcount = $this->input->get('limitcount');
        $limitcount = !empty($limitcount) ? $limitcount : 20;

        $data['CommentList'] = new ObjList([
            'db_where_arr' => [
                'typename != ' => 'order',
                'uid' => $data['search_uid']
            ],
            'db_where_like_arr' => [
                'content' => $data['search_content'],
                'typename' => $data['search_class_slug']
            ],
            'db_orderby_arr' => [
                'updatetime' => 'DESC'
            ],
            'db_where_deletenull_bln' => TRUE,
            'model_name' => 'Comment',
            'limitstart' => $limitstart,
            'limitcount' => $limitcount
        ]);
        $data['page_link'] = $data['CommentList']->create_links(['base_url' => 'admin/'.$data['child1_name'].'/'.$data['child2_name'].'/'.$data['child3_name'].'/'.$data['child4_name']]);

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

        $search_content = $this->input->post('search_content', TRUE);
        $search_class_slug = $this->input->post('search_class_slug', TRUE);
        $search_uid = $this->input->post('search_uid', TRUE);

        $url = 'admin/base/comment/comment/tablelist/?';

        if(!empty($search_content))
        {
            $url = $url.'&content='.$search_content;
        }

        if(!empty($search_class_slug))
        {
            $url = $url.'&class_slug='.$search_class_slug;
        }

        if(!empty($search_uid))
        {
            $url = $url.'&uid='.$search_uid;
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
            $Comment = new Comment([
                'commentid' => $this->input->get('commentid')
            ]);
            $Comment->destroy();

            $this->load->model('Message');
            $this->Message->show([
                'message' => '刪除成功',
                'url' => 'admin/base/comment/comment/tablelist'
            ]);
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/base/comment/comment/tablelist'
            ]);
        }
    }
}

?>