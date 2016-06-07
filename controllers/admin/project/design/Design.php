<?php

class Design_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('AdminModel');
        $this->AdminModel->construct(['data' => $this->data, 'file' => __FILE__ ]);
    }

    public function edit()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
            
        $designid = $this->input->get('designid');

        $data['Design'] = new Design();
        $data['Design']->construct_db(array(
            'db_where_arr' => array(
                'designid' => $designid
            )
        ));

        $data['DesignClassMetaList'] = new ObjList();
        $data['DesignClassMetaList']->construct_db(array(
            'db_where_arr' => array(
                'modelname' => 'design'
            ),
            'model_name' => 'ClassMeta',
            'limitstart' => 0,
            'limitcount' => 100
        ));

        $data['class2_ClassMetaList'] = new ObjList();
        $data['class2_ClassMetaList']->construct_db(array(
            'db_where_arr' => array(
                'modelname' => 'design_class2'
            ),
            'model_name' => 'ClassMeta',
            'limitstart' => 0,
            'limitcount' => 100
        ));

        //global
        $data['global']['js'][] = 'tool/jquery.form.js';

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

        $this->form_validation->set_rules('title', '設計項目名稱', 'required');

        $designid = $this->input->post('designid', TRUE);

        if ($this->form_validation->run() !== FALSE)
        {
            //基本post欄位
            $title = $this->input->post('title', TRUE);
            $price = $this->input->post('price', TRUE);
            $synopsis = $this->input->post('synopsis', TRUE);
            $classids_arr = $this->input->post('classids_arr', TRUE);
            $prioritynum = $this->input->post('prioritynum', TRUE);

            //建構Design物件，並且更新
            $Design = new Design();
            $Design->construct(array(
                'designid' => $designid,
                'title' => $title,
                'price' => $price,
                'synopsis' => $synopsis,
                'classids_arr' => $classids_arr,
                'prioritynum' => $prioritynum
            ));
            $Design->update();

            //送出成功訊息
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '設定成功',
                'url' => 'admin/project/design/design/tablelist'
            ));
        }
        else
        {
            $validation_errors = validation_errors();
            $validation_errors = !empty($validation_errors) ? $validation_errors : '設定錯誤' ;
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => $validation_errors,
                'url' => 'admin/project/design/design/edit/?designid='.$designid
            ));
        }
    }

    public function copy()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $designid = $this->input->get('designid');

        $Design = new Design();
        $Design->construct_db(array(
            'db_where_arr' => array(
                'designid' => $designid
            )
        ));

        //建構DesignFanswoo物件，並且更新
        $DesignFanswoo = new Design();
        $DesignFanswoo->construct(array(
            'title' => $Design->title,
            'price' => $Design->price,
            'synopsis' => $Design->synopsis,
            'classids_arr' => $Design->class_ClassMetaList->uniqueids_arr,
            'prioritynum' => $Design->prioritynum,
        ));

        $DesignFanswoo->update();

        if($DesignFanswoo->designid !== NULL)
        {
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '複製成功',
                'url' => 'admin/project/design/design/tablelist'
            ));
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '複製失敗',
                'url' => 'admin/project/design/design/tablelist'
            ));
        }
    }

    public function tablelist()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $data['search_designid'] = $this->input->get('designid');
        $data['search_title'] = $this->input->get('title');
        $data['search_price'] = $this->input->get('price');
        $data['search_class_slug'] = $this->input->get('class_slug');

        $limitstart = $this->input->get('limitstart');
        $limitcount = $this->input->get('limitcount');
        $limitcount = !empty($limitcount) ? $limitcount : 20;

        $class_ClassMeta = new ClassMeta();
        $class_ClassMeta->construct_db(array(
            'db_where_arr' => array(
                'slug' => $data['search_class_slug']
            )
        ));

        $data['DesignList'] = new ObjList();
        $data['DesignList']->construct_db(array(
            'db_where_arr' => array(
                'designid' => $data['search_designid']
            ),
            'db_where_like_arr' => array(
                'title' => $data['search_title'],
                'price' => $data['search_price']
            ),
            'db_where_or_arr' => array(
                'classids' => array($class_ClassMeta->classid)
            ),
            'db_orderby_arr' => array(
                array('prioritynum', 'DESC'),
                array('designid', 'DESC')
            ),
            'db_where_deletenull_bln' => TRUE,
            'model_name' => 'Design',
            'limitstart' => $limitstart,
            'limitcount' => $limitcount
        ));
        $data['design_links'] = $data['DesignList']->create_links(array('base_url' => 'admin/'.$data['child1_name'].'/'.$data['child2_name'].'/'.$data['child3_name'].'/'.$data['child4_name']));

        $data['DesignClassMetaList'] = new ObjList();
        $data['DesignClassMetaList']->construct_db(array(
            'db_where_arr' => array(
                'modelname' => 'design'
            ),
            'model_name' => 'ClassMeta',
            'limitstart' => 0,
            'limitcount' => 100
        ));

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

        $search_designid = $this->input->post('search_designid', TRUE);
        $search_title = $this->input->post('search_title', TRUE);
        $search_price = $this->input->post('search_price', TRUE);
        $search_class_slug = $this->input->post('search_class_slug', TRUE);

        $url = base_url('admin/project/design/design/tablelist/?');

        if(!empty($search_designid))
        {
            $url = $url.'&designid='.$search_designid;
        }

        if(!empty($search_title))
        {
            $url = $url.'&title='.$search_title;
        }

        if(!empty($search_price))
        {
            $url = $url.'&price='.$search_price;
        }

        if(!empty($search_class_slug))
        {
            $url = $url.'&class_slug='.$search_class_slug;
        }

        header("Location: $url");
    }

    public function delete()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
        
        $hash = $this->input->get('hash');
        $designid = $this->input->get('designid');

        //CSRF過濾
        if($hash == $this->security->get_csrf_hash())
        {
            $Design = new Design();
            $Design->construct(array('designid' => $designid));
            $Design->delete();

            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '刪除成功',
                'url' => 'admin/project/design/design/tablelist'
            ));
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/project/design/design/tablelist'
            ));
        }
    }

}