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
            $data['number_arr'] = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25];
        }
        else if( $data['username'] == 'mimi' )
        {
            $data['name'] = '琬君';
            $data['number_arr'] = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25];
        }
        else if( $data['username'] == 'wenyi' )
        {
            $data['name'] = '文憶';
            $data['number_arr'] = [2, 3, 4, 8, 9, 10, 14, 15, 16, 20, 21, 22, 26, 27, 28, 32, 33, 34, 38, 39, 40, 44, 45, 46, 50];
        }
        else if( $data['username'] == 'vivian' )
        {
            $data['name'] = '郁文';
            $data['number_arr'] = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25];
        }
        else if( $data['username'] == 'shaun' )
        {
            $data['name'] = '尚恩';
            $data['number_arr'] = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25];
        }
        else if( $data['username'] == 'paypay' )
        {
            $data['name'] = '沛沛';
            $data['number_arr'] = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25];
        }
        else if( $data['username'] == 'esther' )
        {
            $data['name'] = '時婷';
            $data['number_arr'] = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25];
        }
        else
        {
            echo '請在網址列輸入正確的英文';
            return FALSE;
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