<?php

class Note_Controller extends MY_Controller {


    public function __construct()
    {
        parent::__construct();
        $data = $this->data;

        $this->load->model('AdminModel'); 
        $this->AdminModel->construct(['data' => $this->data, 'file' => __FILE__ ]);
    }

    public function edit()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);//取得公用數據      
            
        $noteid = $this->input->get('noteid');

        if(empty($noteid))
        {
            $data['NoteField'] = new NoteField([
                'db_where_arr' => [
                    'note.noteid' => $noteid
                ]
            ]);
        }
        else
        {
            $Note = new Note([
                'db_where_arr' => [
                    'noteid' => $noteid
                ]
            ]);

            if( $Note->noteid == 0 )
            {
                header('Location: '.base_url('admin/base/note/note/edit'));
            }
            else
            {
                $data['NoteField'] = new NoteField([
                    'db_where_arr' => [
                        'note.noteid' => $noteid
                    ]
                ]);
            }
        }

        $data['UserGroup'] = $data['User']->group_UserGroupList->obj_arr[0]->groupid;

        if($data['UserGroup'] == 100)
        {
            $data['NoteClassMetaList'] = new ObjList([
                'db_where_arr' => [
                    'modelname' => 'note',
                    'uid' => $data['User']->uid
                ],
                'obj_class' => 'ClassMeta',
                'limitstart' => 0,
                'limitcount' => 100
            ]);
        }
        else
        {
            $data['NoteClassMetaList'] = new ObjList([
                'db_where_arr' => [
                    'modelname' => 'note'
                ],
                'obj_class' => 'ClassMeta',
                'limitstart' => 0,
                'limitcount' => 100
            ]);
        }


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
        $data = $this->AdminModel->get_data(__FUNCTION__);//取得公用數據

        $noteid = $this->input->post('noteid', TRUE);
        $title = $this->input->post('title', TRUE, '文章標題', 'required');
        $slug = $this->input->post('slug', TRUE);
        $classids_arr = $this->input->post('classids_arr[]', TRUE, '文章分類');
        $content = $this->input->post('content', FALSE, '文章內容', 'required');
        $prioritynum = $this->input->post('prioritynum', TRUE);
        $updatetime = $this->input->post('updatetime', TRUE);
        $picids_arr = $this->input->post('picids_arr');
        $shelves_status = $this->input->post('shelves_status', TRUE);
        $show_bln = $this->input->post('show_bln', TRUE);
        if ( !$this->form_validation->check() ) return FALSE;

        if(!empty($show_bln))
        {
            $shelves_status = 2;
        }

        //建構Note物件，並且更新
        $NoteField = new NoteField([
            'noteid' => $noteid,
            'title' => $title,
            'slug' => $slug,
            'classids_arr' => $classids_arr,
            'content' => $content,
            'picids_arr' => $picids_arr,
            'prioritynum' => $prioritynum,
            'updatetime' => $updatetime,
            'shelves_status' => $shelves_status,
            'modelname' => 'note'
        ]);
        $NoteField->update();

        if( !empty($show_bln) )
        {
            //送出成功訊息
            $this->load->model('Message');
            $this->Message->show([
                'message' => '草稿預覽中...',
                'url' => 'note/view/'.$NoteField->slug
            ]);
        }
        else
        {
            //送出成功訊息
            $this->load->model('Message');
            $this->Message->show([
                'message' => '設定成功',
                'url' => 'admin/base/note/note/tablelist/'
            ]);
        }
    }

    public function tablelist()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);//取得公用數據
        

        $data['search_noteid'] = $this->input->get('noteid');
        $data['search_title'] = $this->input->get('title');
        $data['search_username'] = $this->input->get('username');
        $data['search_class_slug'] = $this->input->get('class_slug');
        $data['search_shelves_status'] = $this->input->get('shelves_status');

        //預設顯示已發表文章
        if(empty($data['search_shelves_status']))
        {
            $data['search_shelves_status'] = 1;
        }

        $limitstart = $this->input->get('limitstart');
        $limitcount = $this->input->get('limitcount');
        $limitcount = !empty($limitcount) ? $limitcount : 20;

        $class_ClassMeta = new ClassMeta([
            'db_where_arr' => [
                'slug' => $data['search_class_slug']
            ]
        ]);

        $User = new User([
            'db_where_arr' => [
                'username' => $data['search_username']
            ]
        ]);
        
        $data['UserGroup'] = $data['User']->group_UserGroupList->obj_arr[0]->groupid;

        if($data['UserGroup'] == 100)
        {
            $data['NoteList'] = new ObjList([
                'db_where_arr' => [
                    'modelname' => 'note',
                    'noteid' => $data['search_noteid'],
                    'shelves_status' => $data['search_shelves_status'],
                    'uid' => $data['User']->uid,
                    'title like' => $data['search_title'],
                    'classids find' => [$class_ClassMeta->classid]
                ],
                'db_orderby_arr' => [
                    'prioritynum' => 'DESC',
                    'updatetime' => 'DESC'
                ],
                'db_delete_all_null' => TRUE,
                'obj_class' => 'Note',
                'limitstart' => $limitstart,
                'limitcount' => $limitcount
            ]);
        }
        else
        {
            $data['NoteList'] = new ObjList([
                'db_where_arr' => [
                    'modelname' => 'note',
                    'noteid' => $data['search_noteid'],
                    'shelves_status' => $data['search_shelves_status'],
                    'uid' => $User->uid,
                    'title like' => $data['search_title'],
                    'classids find' => [$class_ClassMeta->classid]
                ],
                'db_orderby_arr' => [
                    'prioritynum' => 'DESC',
                    'updatetime' => 'DESC'
                ],
                'db_delete_all_null' => TRUE,
                'obj_class' => 'Note',
                'limitstart' => $limitstart,
                'limitcount' => $limitcount
            ]);
        }
        $data['page_link'] = $data['NoteList']->create_links(['base_url' => 'admin/'.$data['child1_name'].'/'.$data['child2_name'].'/'.$data['child3_name'].'/'.$data['child4_name']]);

        if($data['UserGroup'] == 100)
        {
            $data['NoteClassMetaList'] = new ObjList([
                'db_where_arr' => [
                    'modelname' => 'note',
                    'uid' => $data['User']->uid
                ],
                'obj_class' => 'ClassMeta',
                'limitstart' => 0,
                'limitcount' => 100
            ]);
        }
        else
        {
            $data['NoteClassMetaList'] = new ObjList([
                'db_where_arr' => [
                    'modelname' => 'note'
                ],
                'obj_class' => 'ClassMeta',
                'limitstart' => 0,
                'limitcount' => 100
            ]);
        }



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
        $data = $this->AdminModel->get_data(__FUNCTION__);//取得公用數據

        $search_noteid = $this->input->post('search_noteid', TRUE);
        $search_class_slug = $this->input->post('search_class_slug', TRUE);
        $search_title = $this->input->post('search_title', TRUE);
        $search_username = $this->input->post('search_username', TRUE);
        $search_shelves_status = $this->input->post('search_shelves_status', TRUE);

        $url = base_url('admin/base/note/note/tablelist/?');

        if(!empty($search_noteid))
        {
            $url = $url.'&noteid='.$search_noteid;
        }

        if(!empty($search_class_slug))
        {
            $url = $url.'&class_slug='.$search_class_slug;
        }

        if(!empty($search_title))
        {
            $url = $url.'&title='.$search_title;
        }

        if(!empty($search_shelves_status))
        {
            $url = $url.'&shelves_status='.$search_shelves_status;
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
        //CSRF過濾
        if( $this->input->get('hash') == $this->security->get_csrf_hash() )
        {
            $NoteField = new NoteField([
                'noteid' => $this->input->get('noteid')
            ]);
            $NoteField->delete();

            $this->load->model('Message');
            $this->Message->show([
                'message' => '刪除成功',
                'url' => 'admin/base/note/note/tablelist'
            ]);
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/base/note/note/tablelist'
            ]);
        }
    }

    public function delete_batch_post()
    {
        $noteid_arr = $this->input->post('noteid_arr[]');

        //CSRF過濾
        if( $this->input->get('hash') == $this->security->get_csrf_hash() )
        {
            if(!empty($noteid_arr))
            {
                foreach($noteid_arr as $key => $noteid)
                {
                    $NoteField = new NoteField([
                        'noteid' => $noteid
                    ]);
                    $NoteField->delete();
                }
            }
            else
            {
                $this->load->model('Message');
                $this->Message->show([
                    'message' => '未選擇要刪除的文章'
                ]);
                return TRUE;
            }

            $this->load->model('Message');
            $this->Message->show([
                'message' => '刪除成功',
                'url' => 'admin/base/note/note/tablelist'
            ]);
            return TRUE;
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/base/note/note/tablelist'
            ]);
            return TRUE;
        }
    }
}

?>