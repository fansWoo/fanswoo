<?php

class Chat_Controller extends MY_Controller
{

    public function index()
    {
        $data = $this->data;

        $data['username'] = $this->input->get('username');

        $data['global']['js'][] = 'model/Pusher.js';

        //輸出模板
        $this->load->view('chat/index.php', $data);
    }

}

?>