<?php

class Set_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('AdminModel');
        $this->AdminModel->construct(['data' => $this->data, 'file' => __FILE__ ]);
    }

    public function set()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        //temp
        $data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
        $data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['admin_header_bar'] = $this->load->view('admin/temp/admin_header_bar', $data, TRUE);
        $data['temp']['admin_footer_bar'] = $this->load->view('admin/temp/admin_footer_bar', $data, TRUE);
        $data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url'], $data);
    }

    public function set_destroy_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $NoteList = new ObjList([
            'db_where_arr' => [
                'status' => -1,
            ],
            'db_where_deletenull_bln' => TRUE,
            'model_name' => 'Note',
            'limitstart' => 0,
            'limitcount' => 100
        ]);
        foreach ($NoteList->obj_arr as $key => $value_note)
        {
            $Note = new Note([
                'db_where_arr' => [
                    'noteid' => $value_note->noteid,
                    'status' => -1,
                ]
            ]);
            foreach ($Note->pic_PicObjList->obj_arr as $key => $value_pic)
            {
                $PicObj = new PicObj([
                    'db_where_arr' => [
                        'picid' => $value_pic->picid
                    ]
                ]);
                $PicObj->destroy();
            }
            $Note->destroy();

            $NoteField = new NoteField([
                'noteid' => $value_note->noteid
            ]);
            $NoteField->destroy2();
        }

        if(!empty($NoteList->obj_arr))
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => '銷毀成功',
                'url' => 'admin/base/note/set/set'
            ]);
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => '已無可銷毀的項目',
                'url' => 'admin/base/note/set/set'
            ]);
        }
    }

    public function set_recovery_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
        
        $NoteList = new ObjList([
            'db_where_arr' => [
                'status' => -1,
            ],
            'db_where_deletenull_bln' => TRUE,
            'model_name' => 'Note',
            'limitstart' => 0,
            'limitcount' => 100
        ]);
        foreach ($NoteList->obj_arr as $key => $value_note)
        {
            $Note = new Note([
                'noteid' => $value_note->noteid
            ]);
            $Note->recovery();
        }

        if(!empty($NoteList->obj_arr))
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => '復原成功',
                'url' => 'admin/base/note/set/set'
            ]);
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show([
                'message' => '已無可復原的項目',
                'url' => 'admin/base/note/set/set'
            ]);
        }
    }
}

?>