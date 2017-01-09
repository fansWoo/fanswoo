<?php

class Project_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('AdminModel');
        $this->AdminModel->construct(['data' => $this->data, 'file' => __FILE__ ]);
    }

    public function edit()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
            
        $data['projectid'] = $this->input->get('projectid');

        $data['Project'] = new Project([
            'db_where_arr' => [
                'projectid' => $data['projectid']
            ]
        ]);

        $data['ProjectClassMetaList'] = new ObjList([
            'db_where_arr' => array(
                'modelname' => 'project'
            ),
            'obj_class' => 'ClassMeta',
            'limitstart' => 0,
            'limitcount' => 100
        ]);
        
        $data['WorktaskClassMetaList'] = new ObjList([
        		'db_where_arr' => [
        				'modelname' => 'worktask'
        		],
        		'obj_class' => 'ClassMeta',
        		'limitstart' => 0,
        		'limitcount' => 100
        ]);
        
        $data['use_hour_total_arr']=array();
        $data['estimate_hour_total_arr']=array();
        
                       
        //新增專案不用撈計時資料
        if(!empty($data['projectid'])){
        	
        	foreach ($data['WorktaskClassMetaList']->obj_arr as $key => $value_WorktaskClassMeta){
        		 
        		$WorktaskList = new ObjList([
        				'db_where_arr' => [
        					'projectid' => $data['projectid'],
        					'classids' =>$value_WorktaskClassMeta->classid
        				],
        				'obj_class' => 'Worktask',
        				'limitstart' => 0,
        				'limitcount' => 100
        		]);
        		
        		$use_hour_total=0;
        		$estimate_hour_total=0;
        		foreach ($WorktaskList->obj_arr as $key2 =>$value_Worktask){
        			$use_hour_total=$use_hour_total+$value_Worktask->use_hour;
        			$estimate_hour_total=$estimate_hour_total+$value_Worktask->estimate_hour;
        		}
        		$data['use_hour_total_arr'][$value_WorktaskClassMeta->classid]=$use_hour_total;
        		$data['estimate_hour_total_arr'][$value_WorktaskClassMeta->classid]=$estimate_hour_total;
        		
        	}
//         	ec2($data['use_hour_total_arr']);
        	
        	//加總不分classids物件
        	$for_total_WorktaskList = new ObjList([
        			'db_where_arr' => [
        					'projectid' => $data['projectid']
        			],
        			'obj_class' => 'Worktask',
        			'limitstart' => 0,
        			'limitcount' => 100
        	]);
        	
        	$data['use_hour_all']=0;  //專案總耗用工時
        	$data['estimate_hour_all']=0; //專案總預估工時
        	$data['unfinish_job']=0;   //尚未完成總數
        	
        	foreach ($for_total_WorktaskList->obj_arr as $key3 => $value_for_total_Worktask){
        		$data['use_hour_all'] += $value_for_total_Worktask->use_hour;
        		$data['estimate_hour_all'] += $value_for_total_Worktask->estimate_hour;
        		 
        		//未完成總數
        		if($value_for_total_Worktask->work_status == 0){
        			$data['unfinish_job']++;
        		}
        	}
        }
        

        $data['class2_ClassMetaList'] = new ObjList();
        $data['class2_ClassMetaList']->construct_db(array(
            'db_where_arr' => array(
                'modelname' => 'project_class2'
            ),
            'obj_class' => 'ClassMeta',
            'limitstart' => 0,
            'limitcount' => 100
        ));

        $data['SuggestList'] = new ObjList();
        $data['SuggestList']->construct_db(array(
            'db_where_arr' => array(
                'projectid' => $data['projectid']
            ),
            'db_orderby_arr' => array(
                array('suggestid', 'ASC')
            ),
            'db_delete_all_null' => TRUE,
            'obj_class' => 'Suggest',
            'limitstart' => 0,
            'limitcount' => 100
        ));

        $data['admin_User'] = new User();
        $data['admin_User']->construct_db(array(
            'db_where_arr' => array(
                'uid' => $data['Project']->admin_uid
            )
        ));

        $data['global']['js'][] = 'tool/jquery-ui-timepicker-addon/script.js';
        $data['global']['style'][] = 'tool/jquery-ui-timepicker-addon/style.css';

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url'], $data);
    }

    public function edit_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
        
        //基本post欄位
        $projectid = $this->input->post('projectid', TRUE);
        $name = $this->input->post('name', TRUE, '專案名稱', 'required');
        $user_email = $this->input->post('user_email', TRUE);
        $customer_emails = $this->input->post('customer_emails', TRUE);
        $admin_emails = $this->input->post('admin_emails', TRUE);
        $permission_emails = $this->input->post('permission_emails', TRUE);
        $working_days = $this->input->post('working_days', TRUE);
        $classids_arr = $this->input->post('classids_arr', TRUE);
        $project_status = $this->input->post('project_status', TRUE);
        $setuptime = $this->input->post('setuptime', TRUE);
        $endtime = $this->input->post('endtime', TRUE);

        if( !$this->form_validation->check() ) return FALSE;

        $endtime = date('Y-m-d H-i-s',strtotime( $setuptime.'+'.$working_days.'day'));

        //建構Project物件，並且更新
        $Project = new Project([
            'projectid' => $projectid,
            'user_email' => $user_email,
            'name' => $name,
            'working_days' => $working_days,
            'classids_arr' => $classids_arr,
            'permission_emails' => $permission_emails,
            'admin_emails' => $admin_emails,
            'customer_emails' => $customer_emails,
            'paycheck_status' => $paycheck_status,
            'project_status' => $project_status,
            'setuptime' => $setuptime,
            'endtime' => $endtime
        ]);
        $Project->update(array(
            'db_update_arr' => array(
                'name',
                'uid',
                'admin_uids',
                'customer_uids',
                'permission_uids',
                'working_days',
                'classids',
                'project_status',
                'setuptime',
                'endtime',
                'updatetime'
            )
        ));

        //清空所有 projectid 等於這個專案但是 uid 不在此存取權限內的任務
//         $WorktaskList = new ObjList([
//             'db_where_arr' => [
//                 [
//                     'projectid' => $projectid,
//                     'uid !=' => $Project->uid
//                 ],
//                 [
//                     'projectid' => $projectid,
//                     'uid not in' => $Project->admin_uids_UserList->uniqueids_arr
//                 ],
//                 [
//                     'projectid' => $projectid,
//                     'uid not in' => $Project->customer_uids_UserList->uniqueids_arr
//                 ],
//                 [
//                     'projectid' => $projectid,
//                     'uid not in' => $Project->permission_uids_UserList->uniqueids_arr
//                 ]
//             ],
//             'db_delete_all_null' => TRUE,
//             'obj_class' => 'Worktask',
//             'limitstart' => 0,
//             'limitcount' => 100
//         ]);

//         foreach( $WorktaskList->obj_arr as $key => $value_Worktask)
//         {
//             $value_Worktask->projectid = 0;
//             $value_Worktask->update();
//         }

        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '設定成功',
        	'url' => 'admin/project/project/project/tablelist'
        ]);
    }

    public function edit_price_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        dd('hey');

        //基本post欄位
        $projectid = $this->input->post('projectid', TRUE);
        $pay_price_total = $this->input->post('pay_price_total', TRUE);
        $pay_price_receive = $this->input->post('pay_price_receive', TRUE);
        $pay_price_bad_debt = $this->input->post('pay_price_bad_debt', TRUE);
        $paycheck_status = $this->input->post('paycheck_status', TRUE);

        if( !$this->form_validation->check() ) return FALSE;

        //建構Project物件，並且更新
        $Project = new Project([
            'projectid' => $projectid,
            'pay_price_total' => $pay_price_total,
            'pay_price_receive' => $pay_price_receive,
            'pay_price_bad_debt' => $pay_price_bad_debt,
            'paycheck_status' => $paycheck_status
        ]);
        $Project->update(array(
        'db_update_arr' => array(
            'pay_price_total',
            'pay_price_receive',
            'pay_price_bad_debt',
            'paycheck_status'
            )
        ));

        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '設定成功',
        	'url' => 'admin/project/project/project/tablelist'
        ]);
    }

    public function edit_design_post()
    {
        $designidArr = $this->input->post('designidArr', TRUE);
        $titleArr = $this->input->post('titleArr', TRUE);
        $priceArr = $this->input->post('priceArr', TRUE);
        $daysArr = $this->input->post('daysArr', TRUE);
        $synopsisArr = $this->input->post('synopsisArr', TRUE);

        $titleArr_count = count($titleArr);
        foreach( $titleArr as $key => $value)
        {
            if( !empty( $value ) )
            {
                $Design = new Design();
                $Design->construct([
                    'designid' => $designidArr[$key],
                    'projectid' => $Project->projectid,
                    'title' => $titleArr[$key],
                    'price' => $priceArr[$key],
                    'days' => $daysArr[$key],
                    'synopsis' => $synopsisArr[$key],
                    'prioritynum' => $titleArr_count - $key
                ]);
                $Design->update();
            }
        }
    }

    public function copy()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $projectid = $this->input->get('projectid');

        $Project = new Project();
        $Project->construct_db(array(
            'db_where_arr' => array(
                'projectid' => $projectid
            )
        ));

        //建構ProjectFanswoo物件，並且更新
        $ProjectFanswoo = new Project();
        $ProjectFanswoo->construct(array(
            'name' => $Project->name,
            'admin_uid' => $Project->admin_uid,
            'permission_uids' => $Project->permission_uids_UserList->uniqueids,
            'working_days' => $Project->working_days,
            'classids_arr' => $Project->class_ClassMetaList->uniqueids_arr,
            'pay_price_total' => $Project->pay_price_total,
            'project_status' => $Project->project_status,
            'setuptime' => $Project->setuptime_DateTimeObj->datetime,
            'endtime' => $Project->endtime_DateTimeObj->datetime
        ));

        $ProjectFanswoo->update();

        $design_count = count($Project->DesignList->obj_arr);
        foreach($Project->DesignList->obj_arr as $key => $value_Design)
        {
            $Design = new Design();
            $Design->construct([
                'projectid' => $ProjectFanswoo->projectid,
                'title' => $value_Design->title,
                'price' => $value_Design->price,
                'days' => $value_Design->days,
                'synopsis' => $value_Design->synopsis,
                'prioritynum' => $design_count - $key
            ]);
            $Design->update();
        }

        if($ProjectFanswoo->projectid !== NULL)
        {
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '複製成功',
                'url' => 'admin/project/project/project/tablelist'
            ));
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '複製失敗',
                'url' => 'admin/project/project/project/tablelist'
            ));
        }
    }

    public function tablelist()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $data['search_projectid'] = $this->input->get('projectid');
        $data['search_name'] = $this->input->get('name');
        $data['search_class_slug'] = $this->input->get('class_slug');
        $data['search_pay_price_receive'] = $this->input->get('price_receive');
        $data['search_pay_price_total'] = $this->input->get('price_total');
        $data['search_pay_price_schedule'] = $this->input->get('price_schedule');
        $data['search_setuptime'] = $this->input->get('setuptime');
        $data['search_endtime'] = $this->input->get('endtime');

        $limitstart = $this->input->get('limitstart');
        $limitcount = $this->input->get('limitcount');
        $limitcount = !empty($limitcount) ? $limitcount : 20;

        $class_ClassMeta = new ClassMeta();
        $class_ClassMeta->construct_db(array(
            'db_where_arr' => array(
                'slug' => $data['search_class_slug']
            )
        ));

        $data['ProjectList'] = Project::list([
            'db_where_arr' => [
                [
                    'projectid' => $data['search_projectid'],
                    'uid' => $data['User']->uid,
                    'pay_price_receive' => $data['search_pay_price_receive'],
                    'pay_price_total' => $data['search_pay_price_total'],
                    'pay_price_schedule' => $data['search_pay_price_schedule'],
                    'name like' => $data['search_name'],
                    'setuptime like' => $data['search_setuptime'],
                    'endtime like' => $data['search_endtime'],
                    'classids find' => $class_ClassMeta->classid
                ],
                [
                    'projectid' => $data['search_projectid'],
                    'admin_uids find' => $data['User']->uid,
                    'pay_price_receive' => $data['search_pay_price_receive'],
                    'pay_price_total' => $data['search_pay_price_total'],
                    'pay_price_schedule' => $data['search_pay_price_schedule'],
                    'name like' => $data['search_name'],
                    'setuptime like' => $data['search_setuptime'],
                    'endtime like' => $data['search_endtime'],
                    'classids find' => $class_ClassMeta->classid
                ],
                [
                    'projectid' => $data['search_projectid'],
                    'customer_uids find' => $data['User']->uid,
                    'pay_price_receive' => $data['search_pay_price_receive'],
                    'pay_price_total' => $data['search_pay_price_total'],
                    'pay_price_schedule' => $data['search_pay_price_schedule'],
                    'name like' => $data['search_name'],
                    'setuptime like' => $data['search_setuptime'],
                    'endtime like' => $data['search_endtime'],
                    'classids find' => $class_ClassMeta->classid
                ],
                [
                    'projectid' => $data['search_projectid'],
                    'permission_uids find' => $data['User']->uid,
                    'pay_price_receive' => $data['search_pay_price_receive'],
                    'pay_price_total' => $data['search_pay_price_total'],
                    'pay_price_schedule' => $data['search_pay_price_schedule'],
                    'name like' => $data['search_name'],
                    'setuptime like' => $data['search_setuptime'],
                    'endtime like' => $data['search_endtime'],
                    'classids find' => $class_ClassMeta->classid
                ]
            ],
            'db_orderby_arr' => [
                'setuptime' => 'DESC'
            ],
            'db_delete_all_null' => TRUE,
            'limitstart' => $limitstart,
            'limitcount' => $limitcount
        ]);
        $data['page_link'] = $data['ProjectList']->create_links(array('base_url' => 'admin/'.$data['child1_name'].'/'.$data['child2_name'].'/'.$data['child3_name'].'/'.$data['child4_name']));

        $data['ProjectClassMetaList'] = new ObjList();
        $data['ProjectClassMetaList']->construct_db(array(
            'db_where_arr' => [
                'modelname' => 'project'
            ],
            'obj_class' => 'ClassMeta',
            'limitstart' => 0,
            'limitcount' => 100
        ));

        $data['global']['js'][] = 'tool/jquery-ui-timepicker-addon/script.js';
        $data['global']['style'][] = 'tool/jquery-ui-timepicker-addon/style.css';

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url'], $data);

    }

    public function tablelist_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $search_projectid = $this->input->post('search_projectid', TRUE);
        $search_class_slug = $this->input->post('search_class_slug', TRUE);
        $search_name = $this->input->post('search_name', TRUE);
        $search_pay_price_receive = $this->input->post('search_pay_price_receive', TRUE);
        $search_pay_price_total = $this->input->post('search_pay_price_total', TRUE);
        $search_pay_price_schedule = $this->input->post('search_pay_price_schedule', TRUE);
        $search_setuptime = $this->input->post('search_setuptime', TRUE);
        $search_endtime = $this->input->post('search_endtime', TRUE);

        $url = 'admin/project/project/Project/tablelist/?';

        if(!empty($search_projectid))
        {
            $url = $url.'&projectid='.$search_projectid;
        }

        if(!empty($search_class_slug))
        {
            $url = $url.'&class_slug='.$search_class_slug;
        }

        if(!empty($search_name))
        {
            $url = $url.'&name='.$search_name;
        }

        if(!empty($search_pay_price_receive))
        {
            $url = $url.'&price_receive='.$search_pay_price_receive;
        }

        if(!empty($search_pay_price_total))
        {
            $url = $url.'&price_total='.$search_pay_price_total;
        }

        if(!empty($search_pay_price_schedule))
        {
            $url = $url.'&price_schedule='.$search_pay_price_schedule;
        }

        if(!empty($search_setuptime))
        {
            $url = $url.'&setuptime='.$search_setuptime;
        }

        if(!empty($search_endtime))
        {
            $url = $url.'&endtime='.$search_endtime;
        }

        $this->load->model('Message');
        $this->Message->show([
            'message' => '資料存取中...',
            'url' => $url
        ]);
    }

    public function time_json()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
            
        $projectid = $this->input->get('projectid');
        $dd = $this->input->get('dd');

        $month = 6; // 以最近幾個月作為近期支出的計算基準

        $Project = Project::orm([
            'db_where_arr' => [
                'projectid' => $projectid
            ],
        ]);

        $ProjectList = Project::list([
            'db_where_arr' => [
                'setuptime >' => date('Y-m-d H-i-s', strtotime("-" + $month + " month") )
            ],
            'limitcount' => 100
        ]);

        $WorktaskList = Worktask::list([
            'db_where_arr' => [
                'projectid' => $projectid
            ],
            'limitstart' => 0,
            'limitcount' => 100000,
            'limitcount_max_bln' => TRUE
        ]);

        foreach( (array) $WorktaskList->obj_arr as $key => $value_Worktask )
        {
            // 計算專案有牽涉到該任務的消耗天數
            $related_use_day = ( ( $value_Worktask->end_time_DateTime->unix - $value_Worktask->start_time_DateTime->unix ) + 86400 ) / 86400;
            // 計算專案有牽涉到該任務的消耗時數

            $day_WorktaskList = Worktask::list([
                'db_where_arr' => [
                    [
                        'worktaskid !=' => $value_Worktask->worktaskid,
                        'uid' => $value_Worktask->uid_User->uid,
                        'end_time <=' => $value_Worktask->end_time_DateTime->datetime,
                        'end_time >=' => $value_Worktask->start_time_DateTime->datetime
                    ],
                    [
                        'worktaskid !=' => $value_Worktask->worktaskid,
                        'uid' => $value_Worktask->uid_User->uid,
                        'start_time >=' => $value_Worktask->start_time_DateTime->datetime,
                        'start_time <=' => $value_Worktask->end_time_DateTime->datetime
                    ]
                ],
                'limitstart' => 0,
                'limitcount' => 100000,
                'limitcount_max_bln' => TRUE
            ]);

            // 扣除的天數先歸零
            $out_day = 0;

            // 未填寫工作天數的話，扣除天數以系統自己計算
            if( 1 )
            {
                foreach( (array) $day_WorktaskList->obj_arr as $key2 => $value_other_Worktask )
                {
                    // 計算其它專案有牽涉到該任務的消耗天數
                    $related_use_other_day = ( ( $value_other_Worktask->end_time_DateTime->unix - $value_other_Worktask->start_time_DateTime->unix ) + 86400 ) / 86400;

                    // 計算該相關任務的開始日期比此任務的開始日期早幾天
                    $related_use_other_day_start = ( $value_Worktask->start_time_DateTime->unix - $value_other_Worktask->start_time_DateTime->unix ) / 86400;
                    $related_use_other_day_start = $related_use_other_day_start > 0 ? $related_use_other_day_start : 0;

                    // 計算該相關任務的結束日期比此任務的結束日期晚幾天
                    $related_use_other_day_end = ( $value_other_Worktask->end_time_DateTime->unix - $value_Worktask->end_time_DateTime->unix ) / 86400;
                    $related_use_other_day_end = $related_use_other_day_end > 0 ? $related_use_other_day_end : 0;
                    // dd($related_use_other_day_end, $value_Worktask->end_time_DateTime, $value_other_Worktask->end_time_DateTime);

                    // 實際影響到該任務的時間
                    $out_day = $out_day + $related_use_other_day - $related_use_other_day_start - $related_use_other_day_end;
                }
            }
            // 如果該任務有填寫小時的話，則以填寫的小時轉成天數進行計算
            // 每 8 小時視為 1 天
            else
            {

            }

            // $out_day 需要再扣掉假日
            // $out_day 需要再扣掉假日
            // $out_day 需要再扣掉假日

            // 實際消耗天數，計算扣除其它任務時間的耗時並且四捨五入
            $actual_use_day = round( $related_use_day / ( $related_use_day + $out_day ) * $related_use_day, 1);
            // 實際消耗時數
            $actual_use_hour = round( $actual_use_day * 8);

            $related_use_day_arr[] = $related_use_day;
            $actual_use_day_arr[] = $actual_use_day;
            $actual_use_hour_arr[] = $actual_use_hour;
        }

        // 計算實際消耗總時數
        foreach( $actual_use_hour_arr as $key => $value )
        {
            $actual_use_hour_total = $actual_use_hour_total + $value;
        }

        // 計算關聯消耗總天數
        foreach( $related_use_day_arr as $key => $value )
        {
            $related_use_day_total = $related_use_day_total + $value;
        }

        // 計算實際消耗總天數
        foreach( $actual_use_day_arr as $key => $value )
        {
            $actual_use_day_total = $actual_use_day_total + $value;
        }

        $actual_use_day_pay = $actual_use_day_total * 2200; // 耗用時間加上內部人員天數薪資
        $project_total_count = count( $ProjectList->obj_arr ) ; // 最近的專案總數

        $esther_pay = ( 25000 + 7000 + 5000 ) * $month; // 時婷半年薪 + 健保 + 年終
        $shuan_pay = ( 25000 + 7000 ) * $month; // 尚恩半年底薪 + 健保
        $yi_pay = ( 80000 + 7000 ) * $month; // 楊翊半年薪 + 健保
        $other_pay = 60000 * $month; // 房租估算 + 行銷估算 + 雜費

        $bonus_pay = $Project->pay_price_total * 0.05; // 業績獎金
        $tax_pay = $Project->pay_price_total * 0.05; // 稅收

        $total_pay_price_receive_total = 0; // 總收款金額加總
        foreach( (array) $ProjectList->obj_arr as $key => $value_Project )
        {
            $total_pay_price_receive_total = $total_pay_price_receive_total + $value_Project->pay_price_receive;
        }
        // 該專案收款佔總收款之金額比例
        $pay_price_proportion = $Project->pay_price_receive / $total_pay_price_receive_total;

        // 目前實際成本計算暫時以每個月人事開銷總額除以案量數估算，之後會加上最近之每個專案金額之佔比參數
        $actual_use_day_pay_total = round(
            $actual_use_day_pay + // 專案執行人員
            $bonus_pay + // 業績獎金
            $tax_pay + // 稅收
            ( 
                ( $esther_pay + $shuan_pay + $yi_pay + $other_pay ) * // 其它人員薪資 + 雜費
                $pay_price_proportion  // 該專案佔總專案之金額比例
            )
        );

        // 如果有帶 $dd 參數的話，就把資料改成以 $dd 印出來
        if( ! empty($dd) )
        {
            dd( $actual_use_day_pay, $actual_use_day_pay_total, $actual_use_hour_total, $actual_use_day_total, $related_use_day_total, $related_use_day_arr, $actual_use_hour_arr );
        }

        echo json_encode([
            'actual_use_day_pay' => $actual_use_day_pay, // 真實時間計算成本
            'actual_use_day_pay_total' => $actual_use_day_pay_total, // 真實時間計算成本
            'actual_use_hour_total' => $actual_use_hour_total, // 真實消耗總時數
            'actual_use_day_total' => $actual_use_day_total, // 真實消耗總天數
            'related_use_day_total' => $related_use_day_total, // 關聯天數
        ]);

    }

    public function delete()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
        
        $hash = $this->input->get('hash');
        $projectid = $this->input->get('projectid');

        //CSRF過濾
        if($hash == $this->security->get_csrf_hash())
        {
            $Project = new Project();
            $Project->construct(array('projectid' => $projectid));
            $Project->delete();

            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '刪除成功',
                'url' => 'admin/project/project/project/tablelist'
            ));
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/project/project/project/tablelist'
            ));
        }
    }
}

?>