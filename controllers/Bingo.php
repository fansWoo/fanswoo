<?php

class Bingo_Controller extends MY_Controller
{

    public function lettory()
    {
        $data = $this->data;
              
		
        $data['username'] = $this->input->get('username');
        
        
        $data['number_arr']=[];		

        
		function unique_rand($min, $max, $num) {
			$count = 0;
			$return = array();
			while ($count < $num) {
				$return[] = str_pad(mt_rand($min, $max),2,'0',STR_PAD_LEFT);
				$return = array_flip(array_flip($return));
				$count = count($return);
			}
			shuffle($return);
			return $return;
		}
		        
        $data['number_arr']=unique_rand(1,25,25);

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