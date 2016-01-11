<?php

class Sales_target_Controller extends MY_Controller {

    protected $child1_name_Str = 'project';
    protected $child2_name_Str = 'sales_target';
    protected $child3_name_Str = 'sales_target';

    public function __construct()
    {
        parent::__construct();
        $data = $this->data;

        $this->load->model('AdminModel');
        $this->AdminModel->child1_name_Str = $this->child1_name_Str;
        $this->AdminModel->child2_name_Str = $this->child2_name_Str;
        $this->AdminModel->child3_name_Str = $this->child3_name_Str;

        if(empty($data['User']->uid_Num))
        {
            $url = base_url('user/login/?url=admin');
            header('Location: '.$url);
            return FALSE;
        }

        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function edit()
    {
        $data = $this->data;//取得公用數據
        $data = array_merge($data, $this->AdminModel->get_data(array(
            'child4_name_Str' => 'edit'//管理分類名稱
        )));

        $SettingList = new SettingList();
        $SettingList->construct_db([
            'db_where_Arr' => [
                'modelname' => 'sales_target'
            ]
        ]);
        $data['global'] = array_merge($data['global'], $SettingList->get_array());

        $data['Jan_ProjectList'] = new ObjList();
        $data['Jan_ProjectList']->construct_db(array(
            'db_where_like_Arr' => array(
                'setuptime' => '-01-',      
            ),
            'db_where_deletenull_Bln' => TRUE,
            'model_name_Str' => 'Project',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));

        $data['Feb_ProjectList'] = new ObjList();
        $data['Feb_ProjectList']->construct_db(array(
            'db_where_like_Arr' => array(
                'setuptime' => '-02-',      
            ),
            'db_where_deletenull_Bln' => TRUE,
            'model_name_Str' => 'Project',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));

        $data['Mar_ProjectList'] = new ObjList();
        $data['Mar_ProjectList']->construct_db(array(
            'db_where_like_Arr' => array(
                'setuptime' => '-03-',      
            ),
            'db_where_deletenull_Bln' => TRUE,
            'model_name_Str' => 'Project',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));

        $data['Apr_ProjectList'] = new ObjList();
        $data['Apr_ProjectList']->construct_db(array(
            'db_where_like_Arr' => array(
                'setuptime' => '-04-',      
            ),
            'db_where_deletenull_Bln' => TRUE,
            'model_name_Str' => 'Project',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));

        $data['May_ProjectList'] = new ObjList();
        $data['May_ProjectList']->construct_db(array(
            'db_where_like_Arr' => array(
                'setuptime' => '-05-',      
            ),
            'db_where_deletenull_Bln' => TRUE,
            'model_name_Str' => 'Project',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));

        $data['Jun_ProjectList'] = new ObjList();
        $data['Jun_ProjectList']->construct_db(array(
            'db_where_like_Arr' => array(
                'setuptime' => '-06-',      
            ),
            'db_where_deletenull_Bln' => TRUE,
            'model_name_Str' => 'Project',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));

        $data['Jul_ProjectList'] = new ObjList();
        $data['Jul_ProjectList']->construct_db(array(
            'db_where_like_Arr' => array(
                'setuptime' => '-07-',      
            ),
            'db_where_deletenull_Bln' => TRUE,
            'model_name_Str' => 'Project',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));

        $data['Aug_ProjectList'] = new ObjList();
        $data['Aug_ProjectList']->construct_db(array(
            'db_where_like_Arr' => array(
                'setuptime' => '-08-',      
            ),
            'db_where_deletenull_Bln' => TRUE,
            'model_name_Str' => 'Project',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));

        $data['Sep_ProjectList'] = new ObjList();
        $data['Sep_ProjectList']->construct_db(array(
            'db_where_like_Arr' => array(
                'setuptime' => '-09-',      
            ),
            'db_where_deletenull_Bln' => TRUE,
            'model_name_Str' => 'Project',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));

        $data['Oct_ProjectList'] = new ObjList();
        $data['Oct_ProjectList']->construct_db(array(
            'db_where_like_Arr' => array(
                'setuptime' => '-10-',      
            ),
            'db_where_deletenull_Bln' => TRUE,
            'model_name_Str' => 'Project',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));

        $data['Nov_ProjectList'] = new ObjList();
        $data['Nov_ProjectList']->construct_db(array(
            'db_where_like_Arr' => array(
                'setuptime' => '-11-',      
            ),
            'db_where_deletenull_Bln' => TRUE,
            'model_name_Str' => 'Project',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));

        $data['Dec_ProjectList'] = new ObjList();
        $data['Dec_ProjectList']->construct_db(array(
            'db_where_like_Arr' => array(
                'setuptime' => '-12-',      
            ),
            'db_where_deletenull_Bln' => TRUE,
            'model_name_Str' => 'Project',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));

        //global
        $data['global']['style'][] = 'app/css/admin/global.css';
        $data['global']['js'][] = 'app/js/admin.js';

        //temp
        $data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
        $data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['admin_header_bar'] = $this->load->view('admin/temp/admin_header_bar', $data, TRUE);
        $data['temp']['admin_footer_bar'] = $this->load->view('admin/temp/admin_footer_bar', $data, TRUE);
        $data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url_Str'], $data);
    }

    public function edit_post()
    {
        $sales_target_Jan = $this->input->post('sales_target_Jan', TRUE);
        $sales_target_Feb = $this->input->post('sales_target_Feb', TRUE);
        $sales_target_Mar = $this->input->post('sales_target_Mar', TRUE);
        $sales_target_Apr = $this->input->post('sales_target_Apr', TRUE);
        $sales_target_May = $this->input->post('sales_target_May', TRUE);
        $sales_target_Jun = $this->input->post('sales_target_Jun', TRUE);
        $sales_target_Jul = $this->input->post('sales_target_Jul', TRUE);
        $sales_target_Aug = $this->input->post('sales_target_Aug', TRUE);
        $sales_target_Sep = $this->input->post('sales_target_Sep', TRUE);
        $sales_target_Oct = $this->input->post('sales_target_Oct', TRUE);
        $sales_target_Nov = $this->input->post('sales_target_Nov', TRUE);
        $sales_target_Dec = $this->input->post('sales_target_Dec', TRUE);

        $SettingList = new SettingList();
        $SettingList->construct(array(
            'construct_Arr' => array(
                array(
                    'keyword_Str' => 'sales_target_Jan',
                    'value_Str' => $sales_target_Jan,
                    'modelname_Str' => 'sales_target'
                ),
                array(
                    'keyword_Str' => 'sales_target_Feb',
                    'value_Str' => $sales_target_Feb,
                    'modelname_Str' => 'sales_target'
                ),
                array(
                    'keyword_Str' => 'sales_target_Mar',
                    'value_Str' => $sales_target_Mar,
                    'modelname_Str' => 'sales_target'
                ),
                array(
                    'keyword_Str' => 'sales_target_Apr',
                    'value_Str' => $sales_target_Apr,
                    'modelname_Str' => 'sales_target'
                ),
                array(
                    'keyword_Str' => 'sales_target_May',
                    'value_Str' => $sales_target_May,
                    'modelname_Str' => 'sales_target'
                ),
                array(
                    'keyword_Str' => 'sales_target_Jun',
                    'value_Str' => $sales_target_Jun,
                    'modelname_Str' => 'sales_target'
                ),
                array(
                    'keyword_Str' => 'sales_target_Jul',
                    'value_Str' => $sales_target_Jul,
                    'modelname_Str' => 'sales_target'
                ),
                array(
                    'keyword_Str' => 'sales_target_Aug',
                    'value_Str' => $sales_target_Aug,
                    'modelname_Str' => 'sales_target'
                ),
                array(
                    'keyword_Str' => 'sales_target_Sep',
                    'value_Str' => $sales_target_Sep,
                    'modelname_Str' => 'sales_target'
                ),
                array(
                    'keyword_Str' => 'sales_target_Oct',
                    'value_Str' => $sales_target_Oct,
                    'modelname_Str' => 'sales_target'
                ),
                array(
                    'keyword_Str' => 'sales_target_Nov',
                    'value_Str' => $sales_target_Nov,
                    'modelname_Str' => 'sales_target'
                ),
                array(
                    'keyword_Str' => 'sales_target_Dec',
                    'value_Str' => $sales_target_Dec,
                    'modelname_Str' => 'sales_target'
                )
            )
        ));
        $SettingList->update(array());

        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show(array(
            'message' => '設定成功',
            'url' => 'admin/project/sales_target/sales_target/edit'
        ));
    }
}

?>