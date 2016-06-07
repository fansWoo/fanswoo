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

        $groupid = $this->input->get('groupid');

        $data['UserGroup'] = new UserGroup([
            'db_where_arr' => [
                'groupid' => $groupid
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

        $groupid = $this->input->post('groupid', TRUE);
        $groupname = $this->input->post('groupname', TRUE, '會員群組名稱', 'required');
        if ($this->form_validation->check() == FALSE) return FALSE;

        $UserGroup = new UserGroup([
            'groupid' => $groupid,
            'groupname' => $groupname
        ]);
        $UserGroup->update();

        $this->load->model('Message');
        $this->Message->show([
            'message' => '設定成功',
            'url' => 'admin/base/user/classmeta/tablelist'
        ]);
    }

    public function tablelist()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $limitstart = $this->input->get('limitstart');
        $limitcount = $this->input->get('limitcount');
        $limitcount = !empty($limitcount) ? $limitcount : 20;

        //權限判斷
        if(
            in_array( 1, $data['User']->group_UserGroupList->uniqueids_arr)
        )
        {
        }
        else if(
            in_array( 2, $data['User']->group_UserGroupList->uniqueids_arr)
        )
        {
            $groupids_1_purview = 1;
        }
        else if(
            in_array( 3, $data['User']->group_UserGroupList->uniqueids_arr)
        )
        {
            $groupids_1_purview = 1;
            $groupids_2_purview = 2;
            $groupids_3_purview = 3;
        }

        $data['UserGroupList'] = new ObjList();
        $data['UserGroupList']->construct_db([
            'db_where_arr' => [
                'groupid !=' => $groupids_1_purview,
                'groupid != ' => $groupids_2_purview,
                'groupid !=  ' => $groupids_3_purview
            ],
            'db_where_deletenull_bln' => TRUE,
            'model_name' => 'UserGroup',
            'limitstart' => $limitstart,
            'limitcount' => $limitcount
        ]);
        $data['class_links'] = $data['UserGroupList']->create_links(['base_url' => 'admin/'.$data['child1_name'].'/'.$data['child2_name'].'/'.$data['child3_name'].'/'.$data['child4_name']]);

        //temp
        $data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
        $data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['admin_header_bar'] = $this->load->view('admin/temp/admin_header_bar', $data, TRUE);
        $data['temp']['admin_footer_bar'] = $this->load->view('admin/temp/admin_footer_bar', $data, TRUE);
        $data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url'], $data);
    }

    public function delete()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        //CSRF過濾
        if( $this->input->get('hash') == $this->security->get_csrf_hash() )
        {
            $UserGroup = new UserGroup([
                'groupid' => $this->input->get('groupid')
            ]);
            $UserGroup->destroy();

            $this->load->model('Message');
            $this->Message->show([
                'message' => '刪除成功',
                'url' => 'admin/base/user/classmeta/tablelist'
            ]);
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/base/user/classmeta/tablelist'
            ]);
        }
    }

}