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
            'modelname' => 'worktask'
        ]);
        $ClassMeta->update();

        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '設定成功',
            'url' => 'admin/project/worktask/classmeta/tablelist'
        ]);
    }

    public function tablelist()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $limitstart = $this->input->get('limitstart');
        $limitcount = $this->input->get('limitcount');
        $limitcount = empty($limitcount) ? 20 : $limitcount;
        $limitcount = $limitcount > 100 ? 100 : $limitcount;

        $data['search_classname'] = $this->input->get('classname');
        $data['search_slug'] = $this->input->get('slug');

        $data['class_list_ClassMetaList'] = new ObjList();
        $data['class_list_ClassMetaList']->construct_db(array(
            'db_where_arr' => array(
                'modelname' => 'worktask',
                'slug' => $data['search_slug'],
                'classname like' => $data['search_classname']
            ),
            'db_where_deletenull_bln' => TRUE,
            'db_orderby_arr' => array(
                array('prioritynum', 'DESC'),
                array('classid', 'DESC')
            ),
            'obj_class' => 'ClassMeta',
            'limitstart' => 0,
            'limitcount' => 100
        ));
        $data['class_links'] = $data['class_list_ClassMetaList']->create_links(array('base_url' => 'admin/'.$data['child1_name'].'/'.$data['child2_name'].'/'.$data['child3_name'].'/'.$data['child4_name']));
        
        //建立class2_ClassMetaList
        $data['class2_ClassMetaList'] = new ObjList();
        $data['class2_ClassMetaList']->construct_db(array(
            'db_where_arr' => array(
                'modelname' => 'project_class2'
            ),
            'obj_class' => 'ClassMeta',
            'limitstart' => 0,
            'limitcount' => 100
        ));

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url'], $data);
    }

    public function tablelist_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $search_classname = $this->input->post('search_classname', TRUE);
        $search_slug = $this->input->post('search_slug', TRUE);
        $search_class2_slug = $this->input->post('search_class2_slug', TRUE);

        $url = base_url('admin/project/project/classmeta/tablelist/?');

        if(!empty($search_classname))
        {
            $url = $url.'&classname='.$search_classname;
        }

        if(!empty($search_slug))
        {
            $url = $url.'&slug='.$search_slug;
        }

        if(!empty($search_class2_slug))
        {
            $url = $url.'&class2_slug='.$search_class2_slug;
        }

        header("Location: $url");
    }

    public function delete()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
        
        $hash = $this->input->get('hash');
        $classid = $this->input->get('classid');

        //CSRF過濾
        if($hash == $this->security->get_csrf_hash())
        {
            $ClassMeta = new ClassMeta();
            $ClassMeta->construct(array('classid' => $classid));
            $ClassMeta->delete();

            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '刪除成功',
                'url' => 'admin/project/project/classmeta/tablelist'
            ));
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/project/project/classmeta/tablelist'
            ));
        }
    }

}