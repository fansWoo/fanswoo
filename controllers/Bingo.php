<?php

class Bingo_Controller extends MY_Controller
{

    public function lettory()
    {
        $data = $this->data;
              
		
        $data['username'] = $this->input->get('username');
        $data['number_arr'] = [];		

        
		// function unique_rand($min, $max, $num) {
		// 	$count = 0;
		// 	$return = array();
		// 	while ($count < $num) {
		// 		$return[] = mt_rand($min, $max);
		// 		$return = array_flip(array_flip($return));
		// 		$count = count($return);
		// 	}
		// 	shuffle($return);
		// 	return $return;
		// }
  //       $data['number_arr'] = unique_rand(1,25,25);

        if( $data['username'] == 'william' )
        {
            $data['name'] = '哲賢';
            $data['number_arr'] = [39,36,2,5,35,26,41,19,3,1,43,31,37,49,10,7,33,44,11,42,38,14,30,25,23];
        }
        else if( $data['username'] == 'mimi' )
        {
            $data['name'] = '琬君';
            $data['number_arr'] = [50,12,3,36,1,5,10,42,48,18,4,14,8,28,22,11,25,7,20,16,30,6,15,9,40];
        }
        else if( $data['username'] == 'wenyi' )
        {
            $data['name'] = '文憶';
            $data['number_arr'] = [2, 3, 4, 8, 9, 10, 14, 15, 16, 20, 21, 22, 26, 27, 28, 32, 33, 34, 38, 39, 40, 44, 45, 46, 50];
        }
        else if( $data['username'] == 'vivian' )
        {
            $data['name'] = '郁文';
            $data['number_arr'] = [17,28,26,9,27,32,6,25,37,5,34,47,2,15,16,20,19,39,36,50,12,3,22,18,8];
        }
        else if( $data['username'] == 'shaun' )
        {
            $data['name'] = '尚恩';
            $data['number_arr'] = [8,4,7,45,16,34,26,30,11,9,36,2,5,41,15,43,19,44,31,46,23,33,22,39,40];
        }
        else if( $data['username'] == 'paypay' )
        {
            $data['name'] = '沛沛';
            $data['number_arr'] = [3,11,7,10,23,9,6,25,20,45,12,15,19,31,49,27,33,46,40,1,24,35,17,21,47];
        }
        else if( $data['username'] == 'esther' )
        {
            $data['name'] = '時婷';
            $data['number_arr'] = [49, 10, 26, 5, 41, 19, 9, 30, 1, 6, 32, 34, 39, 48, 42, 3, 11, 12, 20, 14, 18, 23, 44, 43, 40];
        }
        else
        {
            $data['name'] = 'GUEST';
            $data['number_arr'] = [49, 10, 26, 5, 41, 19, 9, 30, 1, 6, 32, 34, 39, 48, 42, 3, 11, 12, 20, 14, 18, 23, 44, 43, 40];
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

    public function get_bingo_get_number_arr()
    {

        $bingo_get_number_arr_Setting = new Setting([
            'db_where_arr' => [
                'keyword' => 'bingo_get_number_arr'
            ]
        ]);

        if($bingo_get_number_arr_Setting->value == '')
        {
            $bingo_get_number_arr_Setting->keyword = 'bingo_get_number_arr';
            $bingo_get_number_arr_Setting->value = '[]';
            $bingo_get_number_arr_Setting->update();
        }


        echo $bingo_get_number_arr_Setting->value;
        return TRUE;
    }

    public function save_bingo_get_number_arr()
    {
        $number_get_arr = $this->input->post('number_get_arr');

        $bingo_get_number_arr_Setting = new Setting([
            'db_where_arr' => [
                'keyword' => 'bingo_get_number_arr'
            ]
        ]);
        $bingo_get_number_arr_Setting->value = $number_get_arr;
        $bingo_get_number_arr_Setting->update();
        echo $number_get_arr;
        return TRUE;
    }

    public function delete_bingo_get_number_arr()
    {
        $number_get_arr = $this->input->post('number_get_arr');

        $bingo_get_number_arr_Setting = new Setting([
            'db_where_arr' => [
                'keyword' => 'bingo_get_number_arr'
            ]
        ]);
        $bingo_get_number_arr_Setting->value = '';
        $bingo_get_number_arr_Setting->update();
        echo $number_get_arr;
        return TRUE;
    }

}

?>