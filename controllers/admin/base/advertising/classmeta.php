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
        $data['ClassMeta'] = new ClassMeta([
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

        $class_ClassMeta = new ClassMeta([
            'classid' => $classid,
            'classname' => $classname,
            'slug' => $slug,
            'content' => $content,
            'prioritynum' => $prioritynum,
            'modelname' => 'advertising'
        ]);
        $class_ClassMeta->update();

        $this->load->model('Message');
        $this->Message->show([
            'message' => '設定成功',
            'url' => 'admin/base/advertising/classmeta/tablelist'
        ]);
    }

    public function tablelist()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $data['search_classname'] = $this->input->get('classname');
        $data['search_slug'] = $this->input->get('slug');

        $limitstart = $this->input->get('limitstart');
        $limitcount = $this->input->get('limitcount');
        $limitcount = !empty($limitcount) ? $limitcount : 20;

        $data['AdvertisingClassList'] = new ObjList([
            'db_where_arr' => [
                'modelname' => 'advertising',
                'classname' => $data['search_classname'],
                'slug' => $data['search_slug']
            ],
            'db_orderby_arr' => [
                'prioritynum' => 'DESC',
                'classid' => 'ASC'
            ],
            'db_where_deletenull_bln' => TRUE,
            'model_name' => 'ClassMeta',
            'limitstart' => $limitstart,
            'limitcount' => $limitcount
        ]);
        $data['class_links'] = $data['AdvertisingClassList']->create_links(['base_url' => 'admin/'.$data['child1_name'].'/'.$data['child2_name'].'/'.$data['child3_name'].'/'.$data['child4_name']]);

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
        $search_username = $this->input->post('search_username', TRUE);

        $url = 'admin/base/advertising/classmeta/tablelist/?';

        if(!empty($search_classname))
        {
            $url = $url.'&classname='.$search_classname;
        }

        if(!empty($search_slug))
        {
            $url = $url.'&slug='.$search_slug;
        }

        if(!empty($search_username))
        {
            $url = $url.'&username='.$search_username;
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
        if($this->input->get('hash') == $this->security->get_csrf_hash())
        {
            $class_ClassMeta = new ClassMeta([
                'classid' => $this->input->get('classid')
            ]);
            $class_ClassMeta->destroy();

            $this->load->model('Message');
            $this->Message->show([
                'message' => '刪除成功',
                'url' => 'admin/base/advertising/classmeta/tablelist/'
            ]);
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/base/advertising/classmeta/tablelist/'
            ]);
        }
    }
}

?>