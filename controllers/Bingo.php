<?php

class Bingo_Controller extends MY_Controller
{

    public function lettory()
    {
        $data = $this->data;

        $data['username'] = $this->input->get('username');

        if( $data['username'] == 'mimi' )
        {
        	$data['number_arr'] = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25];
        }
        else if( $data['username'] == 'william' )
        {
        	$data['number_arr'] = [25, 24, 23, 22, 21, 20, 19, 18, 17, 16, 15, 14, 13, 12, 11, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1];
        }
        else
        {
        	echo '沒有這個使用者名稱';
        	exit;
        }

        $data['global']['js'][] = 'model/Pusher.js';
        $data['global']['style'] = [];


        //輸出模板
        $this->load->view('bingo/lettory.php', $data);
    }

    public function controll()
    {
        $data = $this->data;

        $data['global']['js'][] = 'model/Pusher.js';
        $data['global']['style'] = [];

        //輸出模板
        $this->load->view('bingo/controll.php', $data);
    }

}

?>