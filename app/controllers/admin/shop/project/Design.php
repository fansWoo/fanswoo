<?php

class Design_Controller extends MY_Controller {

    protected $child1_name_Str = 'shop';
    protected $child2_name_Str = 'project';
    protected $child3_name_Str = 'design';

    public function __construct()
    {
        parent::__construct();
        $data = $this->data;

        $this->load->model('AdminModel');
        $this->AdminModel->child1_name_Str = $this->child1_name_Str;
        $this->AdminModel->child2_name_Str = $this->child2_name_Str;
        $this->AdminModel->child3_name_Str = $this->child3_name_Str;

        if($data['User']->uid_Num == '')
        {
            $url = base_url('user/login/?url=admin');
            header('Location: '.$url);
        }

        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function edit()
    {
        $data = $this->data;//取得公用數據
        $data = array_merge($data, $this->AdminModel->get_data(array(
            'child4_name_Str' => 'edit'//管理分類名稱
        )));
            
        $designid_Num = $this->input->get('designid');

        $data['Design'] = new Design();
        $data['Design']->construct_db(array(
            'db_where_Arr' => array(
                'designid_Num' => $designid_Num
            )
        )); 

        //global
        $data['global']['style'][] = 'app/css/admin/global.css';
        $data['global']['js'][] = 'app/js/admin.js';
        $data['global']['js'][] = 'fanswoo-framework/js/jquery.form.js';

        //temp
        $data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
        $data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['admin_header_bar'] = $this->load->view('admin/temp/admin_header_bar', $data, TRUE);
        $data['temp']['admin_footer_bar'] = $this->load->view('admin/temp/admin_footer_bar', $data, TRUE);
        $data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url_Str'], $data);
    }

    public function edit_post()
    {
        $data = $this->data;//取得公用數據

        $this->form_validation->set_rules('title_Str', '設計項目名稱', 'required');

        $designid_Num = $this->input->post('designid_Num', TRUE);

        if ($this->form_validation->run() !== FALSE)
        {
            //基本post欄位
            $title_Str = $this->input->post('title_Str', TRUE);
            $price_Num = $this->input->post('price_Num', TRUE);
            $synopsis_Str = $this->input->post('synopsis_Str', TRUE);
            $prioritynum_Num = $this->input->post('prioritynum_Num', TRUE);

            //建構Design物件，並且更新
            $Design = new Design();
            $Design->construct(array(
                'designid_Num' => $designid_Num,
                'title_Str' => $title_Str,
                'price_Num' => $price_Num,
                'synopsis_Str' => $synopsis_Str,
                'prioritynum_Num' => $prioritynum_Num
            ));
            $Design->update();

            //送出成功訊息
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '設定成功',
                'url' => 'admin/shop/project/design/tablelist'
            ));
        }
        else
        {
            $validation_errors_Str = validation_errors();
            $validation_errors_Str = !empty($validation_errors_Str) ? $validation_errors_Str : '設定錯誤' ;
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => $validation_errors_Str,
                'url' => 'admin/shop/project/design/edit/?designid='.$designid_Num
            ));
        }
    }

    public function tablelist()
    {
        $data = $this->data;//取得公用數據
        $data = array_merge($data, $this->AdminModel->get_data(array(
            'child4_name_Str' => 'tablelist'//管理分類名稱
        )));

        $data['search_designid_Num'] = $this->input->get('designid');
        $data['search_title_Str'] = $this->input->get('title');
        $data['search_price_Num'] = $this->input->get('price');

        $limitstart_Num = $this->input->get('limitstart');
        $limitcount_Num = $this->input->get('limitcount');
        $limitcount_Num = !empty($limitcount_Num) ? $limitcount_Num : 20;

        $data['DesignList'] = new ObjList();
        $data['DesignList']->construct_db(array(
            'db_where_Arr' => array(
                'designid_Num' => $data['search_designid_Num']
            ),
            'db_where_like_Arr' => array(
                'title_Str' => $data['search_title_Str'],
                'price_Num' => $data['search_price_Num']
            ),
            'db_orderby_Arr' => array(
                array('prioritynum', 'DESC'),
                array('designid', 'DESC')
            ),
            'db_where_deletenull_Bln' => TRUE,
            'model_name_Str' => 'Design',
            'limitstart_Num' => $limitstart_Num,
            'limitcount_Num' => $limitcount_Num
        ));
        $data['design_links'] = $data['DesignList']->create_links(array('base_url_Str' => 'admin/'.$data['child1_name_Str'].'/'.$data['child2_name_Str'].'/'.$data['child3_name_Str'].'/'.$data['child4_name_Str']));

        //global
        $data['global']['style'][] = 'app/css/admin/global.css';
        $data['global']['js'][] = 'app/js/admin.js';

        //temp
        $data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
        $data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['admin_header_bar'] = $this->load->view('admin/temp/admin_header_bar', $data, TRUE);
        $data['temp']['admin_footer_bar'] = $this->load->view('admin/temp/admin_footer_bar', $data, TRUE);
        $data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url_Str'], $data);

    }

    public function tablelist_post()
    {
        $data = $this->data;//取得公用數據

        $search_designid_Num = $this->input->post('search_designid_Num', TRUE);
        $search_title_Str = $this->input->post('search_title_Str', TRUE);
        $search_price_Num = $this->input->post('search_price_Num', TRUE);

        $url_Str = base_url('admin/shop/project/design/tablelist/?');

        if(!empty($search_designid_Num))
        {
            $url_Str = $url_Str.'&designid='.$search_designid_Num;
        }

        if(!empty($search_title_Str))
        {
            $url_Str = $url_Str.'&title='.$search_title_Str;
        }

        if(!empty($search_price_Num))
        {
            $url_Str = $url_Str.'&price='.$search_price_Num;
        }

        header("Location: $url_Str");
    }

    public function delete()
    {
        $hash_Str = $this->input->get('hash');
        $designid_Num = $this->input->get('designid');

        //CSRF過濾
        if($hash_Str == $this->security->get_csrf_hash())
        {
            $Design = new Design();
            $Design->construct(array('designid_Num' => $designid_Num));
            $Design->delete();

            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '刪除成功',
                'url' => 'admin/shop/project/design/tablelist'
            ));
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/shop/project/design/tablelist'
            ));
        }
    }

}