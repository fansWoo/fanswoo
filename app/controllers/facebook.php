<?php

class facebook_controller extends FS_controller {

    public $data = array();
    
	public function index()
	{
		header("Location: http://web.fanswoo.com/fanswoo/facebook/get_id");
	}
    
	public function get_id()
	{
        $data = $this->data;
		
		//輸出模板
		$this->load->view('facebook/get_id', $data);
	}

	public function get_mail()
	{
        $data = $this->data;

        $data['uniqueid_Num'] = $this->input->get('uniqueid');
        $data['limitstart_Num'] = $this->input->get('limitstart');
        $data['limitover_Num'] = $this->input->get('limitover');

        $data['FacebookLikeList'] = new ObjList();
        $data['FacebookLikeList']->construct_db([
        	'db_where_Arr' => [
        		'facebook_id !=' => '',
        		'count >=' => $data['limitstart_Num'],
        		'count <=' => $data['limitover_Num'],
        		'uniqueid' => $data['uniqueid_Num']
        	],
            'model_name_Str' => 'FacebookLike',
            'limitstart_Num' => 0,
            'limitcount_Num' => 99999999,
            'limitcount_max_Bln' => TRUE
        ]);

        for($i = 0; $i < 100; $i++)
        {
	        $this->db->from('facebook_like_id');
	        $this->db->where([
	        	'uniqueid' => $data['uniqueid_Num'],
	        	'count' => $i + 1
	        ]);
	        $data['select_count_Num'][$i] = $this->db->get()->num_rows();
        }

        for($i = 0; $i < 100; $i++)
        {
	        $this->db->from('facebook_like_id');
	        $this->db->where([
        		'facebook_id !=' => '',
	        	'uniqueid' => $data['uniqueid_Num'],
	        	'count' => $i + 1
	        ]);
	        $data['select_count_mail_Num'][$i] = $this->db->get()->num_rows();
        }


        $data['select_count_total_Num'] = 0;
        for($i = $data['limitstart_Num'] - 1; $i < $data['limitover_Num']; $i++)
        {
        	$data['select_count_total_Num'] = $data['select_count_total_Num'] + $data['select_count_Num'][$i];
        }
		
		//輸出模板
		$this->load->view('facebook/get_mail', $data);
	}

	public function facebook_like_ids_post()
	{
		$uniqueid_Num = $this->input->post('uniqueid');
		$facebook_like_ids_Str = $this->input->post('facebook_like_ids');
		$facebook_fans_id_Str = $this->input->post('facebook_fans_id');

		//刪除七天前的查詢
		$this->db->where(['facebook_id' => '','updatetime < NOW() - INTERVAL 7 DAY' => null]);
        $this->db->delete('facebook_like_id'); 

        if(empty($facebook_like_ids_Str))
        {
        	return FALSE;
        }

        //如果uniqueid重複，就不查詢
        $this->db->from('facebook_like_id');
        $this->db->where('uniqueid', $uniqueid_Num);
        $count_Num = $this->db->get()->num_rows();
		if($count_Num > 0)
		{
			echo '本uniqueid重複';
			return FALSE;
		}

		$facebook_like_ids_Arr = explode(",", $facebook_like_ids_Str);
		$facebook_like_ids_Arr = array_count_values($facebook_like_ids_Arr);

		foreach($facebook_like_ids_Arr as $key => $value)
		{
			//查詢facebook_like_id & facebook_id
			$FacebookId = new FacebookId();
			$FacebookId->construct_db([
				'db_where_Arr' => [
					'facebook_like_id' => $key
				]
			]);
			
			$FacebookLike = new FacebookLike();
			$FacebookLike->construct([
				'facebook_like_id_Num' => $key,
				'facebook_id_Str' => $FacebookId->facebook_id_Str,
				'count_Num' => $value,
				'facebook_fans_id_Str' => $facebook_fans_id_Str,
				'uniqueid_Num' => $uniqueid_Num
			]);
			$FacebookLike->update();
		}

		echo $uniqueid_Num;
	}

	public function get_facebook_like_ids()
	{
		$uniqueid_Num = $this->input->get('uniqueid');

		if(empty($uniqueid_Num))
		{
        	$db_where_Arr = [
        		'facebook_id' => ''
        	];
		}
		else
		{
        	$db_where_Arr = [
        		'facebook_id' => '',
        		'uniqueid' => $uniqueid_Num
        	];
		}

        $FacebookLikeList = new ObjList();
        $FacebookLikeList->construct_db([
        	'db_where_Arr' => $db_where_Arr,
            'model_name_Str' => 'FacebookLike',
            'db_orderby_Arr' => ['updatetime' => 'ASC'],
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ]);

        $facebook_like_ids_Str = '';
        foreach($FacebookLikeList->obj_Arr as $key => $value_FacebookLike)
        {
	        $value_FacebookLike->set('updatetime_DateTime', [
	            'unix_Num' => time("NOW")
	        ], 'DateTimeObj');
        	$value_FacebookLike->update();
        	if($key == 0)
        	{
        		$facebook_like_ids_Str = $value_FacebookLike->facebook_like_id_Num;
        	}
        	else
        	{
        		$facebook_like_ids_Str = $facebook_like_ids_Str . ',' . $value_FacebookLike->facebook_like_id_Num;
        	}
        }

		echo $facebook_like_ids_Str;
	}


	public function set_facebook_id()
	{
		$token_Str = $this->input->get('token');
		$facebook_like_id_Num = $this->input->get('facebook_like_id');
		$facebook_id_Str = $this->input->get('facebook_id');

		if($facebook_like_id_Num == $facebook_id_Str)
		{
			echo 'error';
			return FALSE;
		}

		$error_Arr = ['login.php'];
		if(in_array($facebook_id_Str, $error_Arr))
		{
			echo 'error';
			return FALSE;
		}

		//刪除facebook_like_id資料庫中facebook_id重複的資料
        $this->db->where('facebook_id', $facebook_id_Str);
        $query = $this->db->get('facebook_like_id');
		$data_Arr = $query->result();

		if(count($data_Arr) > 0)
		{
	        foreach($data_Arr as $key => $value)
	        {
		        if($value->facebook_id != $facebook_like_id_Num)
		        {
			        $this->db->from('facebook_like_id');
			        $this->db->where([
		        		'facebook_id' => $facebook_id_Str
			        ]);
			        $this->db->update('facebook_like_id', ['facebook_id' => '']);
		        }
	        }
		}

		//刪除facebook_id資料庫中facebook_id重複的資料
        $this->db->where('facebook_id', $facebook_id_Str);
        $query = $this->db->get('facebook_id');
		$data_Arr = $query->result();

		if(count($data_Arr) > 0)
		{
	        foreach($data_Arr as $key => $value)
	        {
		        if($value->facebook_id != $facebook_like_id_Num)
		        {
			        $this->db->from('facebook_like_id');
			        $this->db->where([
		        		'facebook_id' => $facebook_id_Str
			        ]);
			        $this->db->delete('facebook_id');
		        }
	        }
		}

        //將facebook_like_id存入資料庫
        $this->db->from('facebook_id');
        $this->db->where('facebook_like_id', $facebook_like_id_Num);
        $count_Num = $this->db->get()->num_rows;

        if($count_Num > 0)
        {
			$FacebookId = new FacebookId();
			$FacebookId->construct_db([
				'db_where_Arr' => [
					'facebook_like_id_Num' => $facebook_like_id_Num
				]
			]);
			$FacebookId->facebook_id_Str = $facebook_id_Str;
			$FacebookId->update();
        }
        else
        {
			$FacebookId = new FacebookId();
			$FacebookId->construct([
				'facebook_like_id_Num' => $facebook_like_id_Num,
				'facebook_id_Str' => $facebook_id_Str
			]);
			$FacebookId->update();
        }

        $this->db->from('facebook_like_id');
	    $this->db->where([
        	'facebook_like_id' => $facebook_like_id_Num
	    ]);
	    $this->db->update('facebook_like_id', ['facebook_id' => $facebook_id_Str]);

		echo 'true';
	}

	public function get_facebook_account()
	{
		$this->db->where('status !=', '-1');
		$this->db->order_by('updatetime', 'ASC');
		$query = $this->db->get('facebook_account', 1, 0);
		$data_Arr = $query->result();
		$data_Json = json_encode($data_Arr[0]);

		$this->db->where('email', $data_Arr[0]->email);
		$this->db->update('facebook_account', ['updatetime' =>  date('Y-m-d H:i:s', time("NOW") ) ]);

		echoe($data_Json);
	}

	public function delete_facebook_account()
	{
		$email_Str = $this->input->get('email');

		if(!empty($email_Str))
		{
			$this->db->where('email', $email_Str);
			$this->db->update('facebook_account', ['status' => -1]);
		}
		echo 'true';
	}

}

?>