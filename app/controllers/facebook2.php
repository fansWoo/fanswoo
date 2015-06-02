<?php

class facebook2_controller extends FS_controller {

    public $data = array();
    
	public function index()
	{
        $data = $this->data;

        $data['FacebookSearchList'] = new ObjList();
        $data['FacebookSearchList']->construct_db([
            'model_name_Str' => 'FacebookSearch',
            'limitstart_Num' => 0,
            'limitcount_Num' => 99999999,
            'limitcount_max_Bln' => TRUE,
	        'db_where_deletenull_Bln' => TRUE
        ]);
		
		//輸出模板
		$this->load->view('facebook2/feedid', $data);
	}
    
	public function feedid()
	{
        $data = $this->data;

        $data['FacebookSearchList'] = new ObjList();
        $data['FacebookSearchList']->construct_db([
            'model_name_Str' => 'FacebookSearch',
            'limitstart_Num' => 0,
            'limitcount_Num' => 99999999,
            'limitcount_max_Bln' => TRUE,
	        'db_where_deletenull_Bln' => TRUE
        ]);
		
		//輸出模板
		$this->load->view('facebook2/feedid', $data);
	}

	public function mail()
	{
        $data = $this->data;

        $data['searchid_Num'] = $this->input->get('searchid');

		$data['FacebookSearch'] = new FacebookSearch();
		$data['FacebookSearch']->construct_db([
			'db_where_Arr' => [
				'searchid_Num' => $data['searchid_Num']
			]
		]);

		if(empty($data['FacebookSearch']->searchid_Num))
		{
			echo '這個粉絲團尚未展開搜尋';
			return false;
		}

		$this->db->select_max('count');
	    $this->db->where(['searchid' => $data['searchid_Num']]);
		$query = $this->db->get('facebook_people');
        $data_Arr = $query->result_array();
        $data['max_count_Num'] = $data_Arr[0]['count'];

        if(empty($data['max_count_Num']))
        {
	        $this->db->from('facebook_feedid');
	        $this->db->where([
	        	'searchid' => $data['searchid_Num'],
	        	'status' => 2
	        ]);
	        $data['schedule_get'] = $this->db->get()->num_rows();

	        $this->db->from('facebook_feedid');
	        $this->db->where([
	        	'searchid' => $data['searchid_Num'],
	        	'status' => 1
	        ]);
	        $data['schedule_noget'] = $this->db->get()->num_rows();

	        $data['schedule_total'] = $data['schedule_get'] + $data['schedule_noget'];
        }
        else
        {
	        for($i = 0; $i < $data['max_count_Num']; $i++)
	        {
		        $this->db->from('facebook_people');
		        $this->db->where([
		        	'searchid' => $data['searchid_Num'],
		        	'count' => $i + 1
		        ]);
		        $data['select_count_Num'][$i] = $this->db->get()->num_rows();
		        if($i == 0)
		        {
		    		$data['people_total'] = $data['select_count_Num'][$i];
		        }
		        else
		        {
		    		$data['people_total'] = $data['people_total'] + $data['select_count_Num'][$i];
		        }
	        }
        }
		
		//輸出模板
		$this->load->view('facebook2/mail', $data);
	}

	public function download_mail()
	{
        $searchid_Num = $this->input->get('searchid');
        $limitstart_Num = $this->input->get('limitstart');
        $limitover_Num = $this->input->get('limitover');

        if(!empty($searchid_Num) && !empty($limitstart_Num) && !empty($limitover_Num))
        {
	        $FacebookPeopleList = new ObjList();
	        $FacebookPeopleList->construct_db([
	        	'db_where_Arr' => [
	        		'facebookid !=' => '',
	        		'count >=' => $limitstart_Num,
	        		'count <=' => $limitover_Num,
	        		'searchid' => $searchid_Num
	        	],
	            'model_name_Str' => 'FacebookPeople',
	            'limitstart_Num' => 0,
	            'limitcount_Num' => 99999999,
	            'limitcount_max_Bln' => TRUE
	        ]);
	        $list = [];
	        foreach($FacebookPeopleList->obj_Arr as $key => $value_FacebookPeople)
	        {
	        	$list[] = [$value_FacebookPeople->facebookid_Str . '@facebook.com'];
	        }
	        $count_Num = count($FacebookPeopleList->obj_Arr);

			$filename = $FacebookPeopleList->obj_Arr[0]->facebookid_fans_Str . '@like' . $limitstart_Num . '-' . $limitover_Num . '@total-' . $count_Num . '@' . date("Y-m-d") . ".csv";
			$f = fopen('php://memory', 'w'); // 寫入 php://memory
			foreach ($list as $row) {
			    fputcsv($f, $row);
			}
			fseek($f, 0);
			header('Content-Type: application/csv');
			header('Content-Disposition: attachement; filename="' . $filename . '"');
			fpassthru($f);
        }
        else
        {
        	echo 'no id';
        }
	}

	public function post_facebook_feedids()
	{
		$feedids_Str = $this->input->post('feedids_Str');
		$facebookid_Str = $this->input->post('facebookid_Str');

		//刪除七天前的查詢
		$this->db->where(['feedid' => '']);
        $this->db->delete('facebook_feedid'); 

        if(empty($feedids_Str) || empty($facebookid_Str) || $facebookid_Str == 'undefined')
        {
			$data_Arr['status'] = 'no input feedid or facebookid';
			$data_Json = json_encode($data_Arr);
			echo $data_Json;
        	return TRUE;
        }
        $facebookid_Str = strtolower($facebookid_Str);

		//增加feedid到資料庫
		$FacebookSearch = new FacebookSearch();
		$FacebookSearch->construct_db([
			'db_where_Arr' => [
				'facebookid_fans' => $facebookid_Str
			]
		]);

		if(!empty($FacebookSearch->searchid_Num))
		{
			$data_Arr['status'] = 'already repeat';
			$data_Arr['searchid'] = $FacebookSearch->searchid_Num;
			$data_Json = json_encode($data_Arr);

			echo $data_Json;
			return TRUE;
		}
		else if(empty($FacebookSearch->searchid_Num))
		{
			//增加feedid到資料庫
			$FacebookSearch = new FacebookSearch();
			$FacebookSearch->construct([
				'facebookid_fans_Str' => $facebookid_Str
			]);
			$FacebookSearch->update();
		}

		$feedids_Arr = explode(",", $feedids_Str);

		foreach($feedids_Arr as $key => $value)
		{
			//增加feedid到資料庫
			$FacebookFeed = new FacebookFeed();
			$FacebookFeed->construct_db([
				'db_where_Arr' => [
					'facebook_feedid' => $value
				]
			]);
			$FacebookFeed->searchid_Num = $FacebookSearch->searchid_Num;
			$FacebookFeed->facebookid_Str = $facebookid_Str;
			$FacebookFeed->facebook_feedid_Num = $value;
			$FacebookFeed->update();
		}

		$data_Arr['searchid'] = $FacebookSearch->searchid_Num;
		$data_Json = json_encode($data_Arr);

		echo $data_Json;
	}

	public function delete_facebook_search()
	{
		$searchid_Num = $this->input->post('searchid');

		if(empty($searchid_Num))
		{
			echo 'false';
			return false;
		}

		//增加feedid到資料庫
		$FacebookSearch = new FacebookSearch();
		$FacebookSearch->construct_db([
			'db_where_Arr' => [
				'searchid' => $searchid_Num
			]
		]);
	    $FacebookSearch->destroy();

		//刪除舊的動態列表
	    $FacebookFeedList = new ObjList();
	    $FacebookFeedList->construct_db([
	        'db_where_Arr' => [
	        	'searchid' => $searchid_Num,
	        	'status' => FALSE
	        ],
	        'model_name_Str' => 'FacebookFeed',
	        'limitstart_Num' => 0,
	        'limitcount_Num' => 99999999,
	        'limitcount_max_Bln' => TRUE
	    ]);

	    foreach($FacebookFeedList->obj_Arr as $key => $value_FacebookFeed)
	    {
	      	$value_FacebookFeed->destroy();
	    }

	    //delete FacebookPeopleList
	    $FacebookPeopleList = new ObjList();
	    $FacebookPeopleList->construct_db([
	       	'db_where_Arr' => [
	        	'searchid' => $searchid_Num,
	        	'status' => false
	        ],
	        'model_name_Str' => 'FacebookPeople',
	        'limitstart_Num' => 0,
	        'limitcount_Num' => 99999999,
	        'limitcount_max_Bln' => TRUE
	    ]);

	    foreach($FacebookPeopleList->obj_Arr as $key => $value_FacebookPeople)
	    {
	       	$value_FacebookPeople->destroy();
	    }

	    echo 'true';
	}

	public function get_facebook_feedids()
	{
		$searchid_Num = $this->input->get('searchid');

		$db_where_Arr = [];
		if(empty($searchid_Num))
		{
			echo 'no searchid';
			return false;
		}

        $FacebookFeedList = new ObjList();
        $FacebookFeedList->construct_db([
        	'db_where_Arr' => [
        		'searchid' => $searchid_Num,
        		'status' => 1
        	],
            'model_name_Str' => 'FacebookFeed',
            'db_orderby_Arr' => ['feedid' => 'DESC'],
            'limitstart_Num' => 0,
            'limitcount_Num' => 250,
            'db_where_deletenull_Bln' => TRUE,
            'limitcount_max_Bln' => TRUE
        ]);

        $FacebookFeedList2 = new ObjList();
        $FacebookFeedList2->construct_db([
        	'db_where_Arr' => [
        		'searchid' => $searchid_Num,
        		'status' => 2
        	],
            'model_name_Str' => 'FacebookFeed',
            'db_orderby_Arr' => ['feedid' => 'ASC'],
            'limitstart_Num' => 0,
            'limitcount_Num' => 1
        ]);

        if(!empty($FacebookFeedList2->obj_Arr))
        {
        	$FacebookFeedList->obj_Arr = array_reverse($FacebookFeedList->obj_Arr);
        	$FacebookFeedList2->obj_Arr[0]->facebookids_Str = '';
        	$FacebookFeedList2->obj_Arr[0]->update();
        	$FacebookFeedList->obj_Arr[] = $FacebookFeedList2->obj_Arr[0];
        	$FacebookFeedList->obj_Arr = array_reverse($FacebookFeedList->obj_Arr);
        }

        $facebook_feedids_Str = '';

        foreach($FacebookFeedList->obj_Arr as $key => $value_FacebookFeed)
        {
        	if($key == 0)
        	{
        		$facebook_feedids_Str = $value_FacebookFeed->facebook_feedid_Num;
        	}
        	else
        	{
        		$facebook_feedids_Str = $facebook_feedids_Str . ',' . $value_FacebookFeed->facebook_feedid_Num;
        	}
        }

		echo $facebook_feedids_Str;
	}

	public function set_facebookids()
	{
		$facebookids_Str = $this->input->get('facebookids');
		$feedid_Num = $this->input->get('feedid');

		if(empty($feedid_Num))
		{
			echo 'false';
			return false;
		}

		$FacebookFeed = new FacebookFeed();
		$FacebookFeed->construct_db([
			'db_where_Arr' => [
				'facebook_feedid' => $feedid_Num,
				'status' => false
			]
		]);

		if(empty($FacebookFeed->facebookids_Str))
		{
			$FacebookFeed->facebookids_Str = $facebookids_Str;
		}
		else
		{
			$FacebookFeed->facebookids_Str = $FacebookFeed->facebookids_Str . ',' . $facebookids_Str;
		}
        echo $FacebookFeed->facebookids_Str;
		$FacebookFeed->status_Num = 2;
		$FacebookFeed->update();
        

		echo 'true';
	}

	public function set_facebookids_finish()
	{
		$searchid_Num = $this->input->get('searchid');

		if(empty($searchid_Num))
		{
			return false;
		}

		$FacebookSearch = new FacebookSearch();
		$FacebookSearch->construct_db([
			'db_where_Arr' => [
				'searchid_Num' => $searchid_Num
			]
		]);

	    $FacebookFeedList = new ObjList();
	    $FacebookFeedList->construct_db([
	        'db_where_Arr' => [
	        	'searchid' => $searchid_Num,
	        	'status' => FALSE
	        ],
	        'model_name_Str' => 'FacebookFeed',
	        'limitstart_Num' => 0,
	        'limitcount_Num' => 99999999,
	        'limitcount_max_Bln' => TRUE
	    ]);

		foreach($FacebookFeedList->obj_Arr as $key => $value_FacebookFeed)
		{
            if(!empty($value_FacebookFeed->facebookids_Str))
            {
                $facebookid_Arr = explode(",", $value_FacebookFeed->facebookids_Str);
                foreach($facebookid_Arr as $key => $value)
                {
                    $facebookids_Arr[] = strtolower($value);
                }
            }
		}
		$facebookids_Arr = array_count_values($facebookids_Arr);

	    //delete FacebookPeopleList
	    $FacebookPeopleList = new ObjList();
	    $FacebookPeopleList->construct_db([
	       	'db_where_Arr' => [
	        	'searchid' => $searchid_Num,
	        	'status' => false
	        ],
	        'model_name_Str' => 'FacebookPeople',
	        'limitstart_Num' => 0,
	        'limitcount_Num' => 99999999,
	        'limitcount_max_Bln' => TRUE
	    ]);

	    foreach($FacebookPeopleList->obj_Arr as $key => $value_FacebookPeople)
	    {
	       	$value_FacebookPeople->destroy();
	    }

		foreach($facebookids_Arr as $key => $value)
		{
			$FacebookPeople = new FacebookPeople();
			$FacebookPeople->construct([
				'facebookid_Str' => $key,
				'facebookid_fans_Str' => $FacebookSearch->facebookid_fans_Str,
				'count_Num' => $value,
				'searchid_Num' => $searchid_Num,
			]);
			$FacebookPeople->update();
		}

		echo 'true';
	}

}

?>