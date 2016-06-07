<?php

class Classmeta_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('AdminModel');
        $this->AdminModel->construct(['data' => $this->data, 'file' => __FILE__ ]);
    }

    public function edit()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $classid = $this->input->get('classid');
        $slug = $this->input->get('slug');

        //初始化ClassMeta
        $data['class_ClassMeta'] = new ClassMeta([
            'db_where_arr' => [
                'classid' => $classid,
                'slug' => $slug
            ],
            'db_where_deletenull_bln' => TRUE
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

        $classid = $this->input->post('classid', TRUE);
        $classname = $this->input->post('classname', TRUE, '分類名稱', 'required');
        $slug = $this->input->post('slug', TRUE);
        $content = $this->input->post('content', TRUE);
        $prioritynum = $this->input->post('prioritynum', TRUE);
        if( !$this->form_validation->check() ) return FALSE;
                
        $ClassMeta = new ClassMeta([
            'classid' => $classid,
            'classname' => $classname,
            'slug' => $slug,
            'content' => $content,
            'prioritynum' => $prioritynum,
            'modelname' => 'faq'
        ]);
        $ClassMeta->update();

        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '設定成功',
            'url' => 'admin/base/faq/classmeta/tablelist'
        ]);
    }

    public function tablelist()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $data['search_classname'] = $this->input->get('classname');
        $data['search_slug'] = $this->input->get('slug');
        $data['search_class_slug'] = $this->input->get('class_slug');

        $limitstart = $this->input->get('limitstart');
        $limitcount = $this->input->get('limitcount');
        $limitcount = !empty($limitcount) ? $limitcount : 20;

        $class_ClassMeta = new ClassMeta([
            'db_where_arr' => [
                'uid' => $data['User']->uid,
                'slug' => $data['search_class_slug']
            ],
            'db_where_deletenull_bln' => FALSE
        ]);

        $data['class_list_ClassMetaList'] = new ObjList([
            'db_where_arr' => [
                'modelname' => 'faq',
                'slug' => $data['search_slug']
            ],
            'db_where_like_arr' => [
                'classname' => $data['search_classname']
            ],
            'db_where_or_arr' => [
                'classids' => [$class_ClassMeta->classid]
            ],
            'db_where_deletenull_bln' => TRUE,
            'db_orderby_arr' => [
                'prioritynum' => 'DESC',
                'classid' => 'DESC'
            ],
            'model_name' => 'ClassMeta',
            'limitstart' => 0,
            'limitcount' => 100
        ]);
        $data['class_links'] = $data['class_list_ClassMetaList']->create_links(['base_url' => 'admin/'.$data['child1_name'].'/'.$data['child2_name'].'/'.$data['child3_name'].'/'.$data['child4_name']]);
        
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

        $search_classname = $this->input->post('search_classname', TRUE);
        $search_slug = $this->input->post('search_slug', TRUE);

        $url = 'admin/base/faq/classmeta/tablelist/?';

        if(!empty($search_classname))
        {
            $url = $url.'&classname='.$search_classname;
        }

        if(!empty($search_slug))
        {
            $url = $url.'&slug='.$search_slug;
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
            $classid = $this->input->get('classid');

            $ClassMeta = new ClassMeta([
                'classid' => $classid
            ]);
            $ClassMeta->delete();

            $this->load->model('Message');
            $this->Message->show([
                'message' => '刪除成功',
                'url' => 'admin/base/faq/classmeta/tablelist'
            ]);
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/base/faq/classmeta/tablelist'
            ]);
        }
    }
}

?>