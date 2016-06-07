<?php

class Page_setting_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('AdminModel');
        $this->AdminModel->construct(['data' => $this->data, 'file' => __FILE__ ]);
    }

    public function edit()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
            
        $page_settingid = $this->input->get('page_settingid');

        $data['PageSetting'] = new PageSetting([
            'db_where_arr' => [
                'page_settingid' => $page_settingid
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

    public function edit_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        //基本post欄位
        $page_settingid = $this->input->post('page_settingid', TRUE);
        $title = $this->input->post('title', TRUE, '全域分頁標題', 'required');
        $tag = $this->input->post('tag', TRUE);
        $href = $this->input->post('href', TRUE);
        $global_status = $this->input->post('global_status', TRUE);
        $metatag = $this->input->post('metatag', TRUE);
        $script_plugin = $this->input->post('script_plugin', FALSE);
        $synopsis = $this->input->post('synopsis', TRUE);
        if ($this->form_validation->check() == FALSE) return FALSE;

        //檢測全域分頁代碼不能重複上傳
        $PageSetting = new PageSetting([
            'db_where_arr' => [
                'page_settingid !=' => $page_settingid,
                'tag' => $tag
            ]
        ]);

        if(!empty($PageSetting->page_settingid))
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => '不可重複全域分頁代碼的全域分頁'
            ]);
            return FALSE;
        }

        //建構PageSetting物件，並且更新
        $PageSetting = new PageSetting([
            'page_settingid' => $page_settingid,
            'title' => $title,
            'tag' => $tag,
            'href' => $href,
            'global_status' => $global_status,
            'metatag' => $metatag,
            'script_plugin' => $script_plugin,
            'synopsis' => $synopsis
        ]);
        $PageSetting->update();

        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '設定成功',
            'url' => 'admin/base/page_setting/page_setting/tablelist'
        ]);
    }

    public function tablelist()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $data['search_page_settingid'] = $this->input->get('page_settingid');
        $data['search_title'] = $this->input->get('title');

        $limitstart = $this->input->get('limitstart');
        $limitcount = $this->input->get('limitcount');
        $limitcount = !empty($limitcount) ? $limitcount : 20;

        $data['PageSettingList'] = new ObjList([
            'db_where_arr' => [
                'page_settingid' => $data['search_page_settingid']
            ],
            'db_where_like_arr' => [
                'title' => $data['search_title']
            ],
            'db_orderby_arr' => [
                'page_settingid' => 'DESC'
            ],
            'db_where_deletenull_bln' => TRUE,
            'model_name' => 'PageSetting',
            'limitstart' => $limitstart,
            'limitcount' => $limitcount
        ]);

        $data['page_links'] = $data['PageSettingList']->create_links(['base_url' => 'admin/'.$data['child1_name'].'/'.$data['child2_name'].'/'.$data['child3_name'].'/'.$data['child4_name']]);

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

        $search_page_settingid = $this->input->post('search_page_settingid', TRUE);
        $search_title = $this->input->post('search_title', TRUE);

        $url = 'admin/base/page_setting/page_setting/tablelist/?';

        if(!empty($search_page_settingid))
        {
            $url = $url.'&page_settingid='.$search_page_settingid;
        }

        if(!empty($search_title))
        {
            $url = $url.'&title='.$search_title;
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
        
        $hash = $this->input->get('hash');
        $page_settingid = $this->input->get('page_settingid');

        //CSRF過濾
        if($hash == $this->security->get_csrf_hash())
        {
            $PageSetting = new PageSetting([
                'db_where_arr' => [
                    'page_settingid' => $page_settingid
                ]
            ]);

            $PageSetting->destroy();

            $this->load->model('Message');
            $this->Message->show([
                'message' => '刪除成功',
                'url' => 'admin/base/page_setting/page_setting/tablelist'
            ]);
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/base/page_setting/page_setting/tablelist'
            ]);
        }
    }
}

?>