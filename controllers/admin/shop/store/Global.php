<?php

class Global_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('AdminModel');
        $this->AdminModel->construct(['data' => $this->data, 'file' => __FILE__ ]);
    }

    public function hot()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $shop_hot_product_Setting = new Setting([
            'db_where_arr' => [
                'keyword' => 'shop_hot_product'
            ]
        ]);
        $data['global']['shop_hot_product'] = $shop_hot_product_Setting->value;

        //temp
        $data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
        $data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['admin_header_bar'] = $this->load->view('admin/temp/admin_header_bar', $data, TRUE);
        $data['temp']['admin_footer_bar'] = $this->load->view('admin/temp/admin_footer_bar', $data, TRUE);
        $data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url'], $data);
    }

    public function hot_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $shop_hot_product = $this->input->post('shop_hot_product', TRUE);

        $SettingList = new SettingList([
            'construct_arr' => [
                [
                    'keyword' => 'shop_hot_product',
                    'value' => $shop_hot_product,
                    'modelname' => 'shop'
                ]
            ]
        ]);
        $SettingList->update();

        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '設定成功',
            'url' => 'admin/shop/store/global/hot'
        ]);
    }

    public function coupon()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $data['coupon_SettingList'] = new SettingList([
            'db_where_arr' => [
                'modelname' => 'shop_coupon'
            ]
        ]);

        //temp
        $data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
        $data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['admin_header_bar'] = $this->load->view('admin/temp/admin_header_bar', $data, TRUE);
        $data['temp']['admin_footer_bar'] = $this->load->view('admin/temp/admin_footer_bar', $data, TRUE);
        $data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url'], $data);
    }

    public function coupon_rule_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $shop_rule_use_coupon_count = $this->input->post('shop_rule_use_coupon_count', TRUE);
        $shop_rule_use_get_coupon_count = $this->input->post('shop_rule_use_get_coupon_count', TRUE);

        $SettingList = new SettingList([
            'construct_arr' => [
                [
                    'keyword' => 'shop_rule_use_coupon_count',
                    'value' => $shop_rule_use_coupon_count,
                    'modelname' => 'shop_coupon'
                ],
                [
                    'keyword' => 'shop_rule_use_get_coupon_count',
                    'value' => $shop_rule_use_get_coupon_count,
                    'modelname' => 'shop_coupon'
                ]
            ]
        ]);
        $SettingList->update();

        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '設定成功',
            'url' => 'admin/shop/store/global/coupon'
        ]);
    }

    public function coupon_get_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $shop_user_register_get_coupon_count = $this->input->post('shop_user_register_get_coupon_count', TRUE);
        $shop_rule_coupon_count = $this->input->post('shop_rule_coupon_count', TRUE);
        $shop_rule_get_coupon_count = $this->input->post('shop_rule_get_coupon_count', TRUE);

        $SettingList = new SettingList([
            'construct_arr' => [
                [
                    'keyword' => 'shop_user_register_get_coupon_count',
                    'value' => $shop_user_register_get_coupon_count,
                    'modelname' => 'shop_coupon'
                ],
                [
                    'keyword' => 'shop_rule_coupon_count',
                    'value' => $shop_rule_coupon_count,
                    'modelname' => 'shop_coupon'
                ],
                [
                    'keyword' => 'shop_rule_get_coupon_count',
                    'value' => $shop_rule_get_coupon_count,
                    'modelname' => 'shop_coupon'
                ]
            ]
        ]);
        $SettingList->update();

        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '設定成功',
            'url' => 'admin/shop/store/global/coupon'
        ]);
    }

    public function tradein()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $data['tradein_SettingList'] = new SettingList([
            'db_where_arr' => [
                'modelname' => 'shop_tradein'
            ]
        ]);

        //temp
        $data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
        $data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['admin_header_bar'] = $this->load->view('admin/temp/admin_header_bar', $data, TRUE);
        $data['temp']['admin_footer_bar'] = $this->load->view('admin/temp/admin_footer_bar', $data, TRUE);
        $data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url'], $data);
    }

    public function tradein_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);
        
        $shop_rule_use_tradein_money = $this->input->post('shop_rule_use_tradein_money', TRUE);
        $shop_rule_get_tradein_money = $this->input->post('shop_rule_get_tradein_money', TRUE);
        $shop_rule_get_tradein_money_type = $this->input->post('shop_rule_get_tradein_money_type', TRUE);
        $shop_rule_use_tradein_count = $this->input->post('shop_rule_use_tradein_count', TRUE);
        $shop_rule_get_tradein_count = $this->input->post('shop_rule_get_tradein_count', TRUE);
        $shop_rule_get_tradein_count_type = $this->input->post('shop_rule_get_tradein_count_type', TRUE);

        $SettingList = new SettingList([
            'construct_arr' => [
                [
                    'keyword' => 'shop_rule_use_tradein_money',
                    'value' => $shop_rule_use_tradein_money,
                    'modelname' => 'shop_tradein'
                ],
                [
                    'keyword' => 'shop_rule_get_tradein_money',
                    'value' => $shop_rule_get_tradein_money,
                    'modelname' => 'shop_tradein'
                ],
                [
                    'keyword' => 'shop_rule_get_tradein_money_type',
                    'value' => $shop_rule_get_tradein_money_type,
                    'modelname' => 'shop_tradein'
                ],
                [
                    'keyword' => 'shop_rule_use_tradein_count',
                    'value' => $shop_rule_use_tradein_count,
                    'modelname' => 'shop_tradein'
                ],
                [
                    'keyword' => 'shop_rule_get_tradein_count',
                    'value' => $shop_rule_get_tradein_count,
                    'modelname' => 'shop_tradein'
                ],
                [
                    'keyword' => 'shop_rule_get_tradein_count_type',
                    'value' => $shop_rule_get_tradein_count_type,
                    'modelname' => 'shop_tradein'
                ]
            ]
        ]);
        $SettingList->update();

        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '設定成功',
            'url' => 'admin/shop/store/global/tradein'
        ]);
    }

    public function transfer()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $data['transfer_SettingList'] = new SettingList([
            'db_where_arr' => [
                'modelname' => 'shop_transfer'
            ]
        ]);

        //temp
        $data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
        $data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['admin_header_bar'] = $this->load->view('admin/temp/admin_header_bar', $data, TRUE);
        $data['temp']['admin_footer_bar'] = $this->load->view('admin/temp/admin_footer_bar', $data, TRUE);
        $data['temp']['body_end'] = $this->load->view('temp/body_end', $data, TRUE);

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url'], $data);
    }

    public function transfer_post()
    {
        $data = $this->AdminModel->get_data(__FUNCTION__);

        $bank_code = $this->input->post('bank_code', TRUE);
        $bank_account = $this->input->post('bank_account', TRUE);
        $bank_account_name = $this->input->post('bank_account_name', TRUE);
        $bank_account_remark = $this->input->post('bank_account_remark', TRUE);

        $SettingList = new SettingList([
            'construct_arr' => [
                [
                    'keyword' => 'bank_code',
                    'value' => $bank_code,
                    'modelname' => 'shop_transfer'
                ],
                [
                    'keyword' => 'bank_account',
                    'value' => $bank_account,
                    'modelname' => 'shop_transfer'
                ],
                [
                    'keyword' => 'bank_account_name',
                    'value' => $bank_account_name,
                    'modelname' => 'shop_transfer'
                ],
                [
                    'keyword' => 'bank_account_remark',
                    'value' => $bank_account_remark,
                    'modelname' => 'shop_transfer'
                ]

            ]
        ]);
        $SettingList->update();

        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show([
            'message' => '設定成功',
            'url' => 'admin/shop/store/global/transfer'
        ]);
    }
}

?>