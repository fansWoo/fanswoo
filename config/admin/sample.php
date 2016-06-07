<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['setting_arr'] = [
    [
        'title' => '範例主題',
        'subtitle' => '範例副標題',
        'child' => [
            [
                'title' => '文字',
                'type' => 'text',
                'placeholder' => '請輸入文字',
                'explanation' => '請輸入文字',
                'set_rules' => 'required',
                'default_value' => '',
                'modelname' => 'sample',
                'name' => 'sample_text'
            ],
            [
                'title' => '數字',
                'type' => 'number',
                'min' => 0,
                'max' => 5,
                'placeholder' => '請輸入數字',
                'explanation' => '請輸入數字',
                'set_rules' => '',
                'default_value' => '',
                'modelname' => 'sample',
                'name' => 'sample_number'
            ],
            [
                'title' => '密碼',
                'type' => 'password',
                'placeholder' => '請輸入密碼',
                'explanation' => '請輸入密碼',
                'set_rules' => '',
                'default_value' => '',
                'modelname' => 'sample',
                'name' => 'sample_password'
            ],
            [
                'title' => '複選框',
                'type' => 'checkbox',
                'child' => [
                    [
                        'title' => '複選框',
                        'set_rules' => '',
                        'default_value' => 0,
                        'modelname' => 'sample',
                        'name' => 'sample_check_val_1'
                    ],
                    [
                        'title' => '複選框2',
                        'set_rules' => '',
                        'default_value' => 1,
                        'modelname' => 'sample',
                        'name' => 'sample_check_val_2'
                    ]
                ],
                'explanation' => '複選框'
            ],
            [
                'title' => '單選框',
                'type' => 'radio',
                'set_rules' => '',
                'default_value' => '2',
                'modelname' => 'sample',
                'name' => 'sample_radio',
                'child' => [
                    [
                        'title' => '單選框',
                        'value' => '1'
                    ],
                    [
                        'title' => '單選框2',
                        'value' => '2'
                    ]
                ],
                'explanation' => '單選框'
            ],
            [
                'title' => '下拉式選單',
                'type' => 'select',
                'set_rules' => '',
                'default_value' => '2',
                'modelname' => 'sample',
                'name' => 'sample_select',
                'child' => [
                    [
                        'title' => '下拉式選單',
                        'value' => '1'
                    ],
                    [
                        'title' => '下拉式選單2',
                        'value' => '2'
                    ]
                ],
                'explanation' => '下拉式選單'
            ],
            [
                'title' => '文字框',
                'type' => 'textarea',
                'placeholder' => '請輸入文字框',
                'explanation' => '請輸入文字框',
                'set_rules' => '',
                'default_value' => '',
                'modelname' => 'sample',
                'name' => 'sample_textarea'
            ],
            [
                'title' => 'HTML編輯器',
                'type' => 'html',
                'placeholder' => '請輸入密碼',
                'explanation' => '請輸入密碼',
                'set_rules' => '',
                'default_value' => '',
                'modelname' => 'sample',
                'name' => 'sample_html'
            ],
            // [
            //     'title' => '本文',
            //     'type' => 'content',
            //     'value' => '<a href="">Hello</a> fansWoo',
            //     'explanation' => '請點選超連結'
            // ],
            // [
            //     'title' => '假按鈕',
            //     'type' => 'button',
            //     'explanation' => '請點選假按鈕',
            //     'name' => 'sample_html'
            // ],
            // [
            //     'title' => '日期',
            //     'type' => 'date',
                // 'placeholder' => '請輸入日期',
                // 'explanation' => '請輸入日期',
                // 'set_rules' => '',
                // 'default_value' => '',
                // 'modelname' => 'sample',
                // 'name' => 'sample_html'
            // ],
            // [
            //     'title' => '圖片上傳',
            //     'type' => 'html',
            //     'placeholder' => '請輸入密碼',
            //     'explanation' => '請輸入密碼',
            //     'set_rules' => '',
            //     'default_value' => '',
            //     'modelname' => 'sample',
            //     'name' => 'sample_html'
            // ],
            // [
            //     'title' => '二層次選單',
            //     'type' => 'html',
            //     'placeholder' => '請輸入密碼',
            //     'explanation' => '請輸入密碼',
            //     'set_rules' => '',
            //     'default_value' => '',
            //     'modelname' => 'sample',
            //     'name' => 'sample_html'
            // ],
            // [
            //     'title' => '三層次選單',
            //     'type' => 'html',
            //     'placeholder' => '請輸入密碼',
            //     'explanation' => '請輸入密碼',
            //     'set_rules' => '',
            //     'default_value' => '',
            //     'modelname' => 'sample',
            //     'name' => 'sample_html'
            // ],
            // [
            //     'title' => '群組式表單',
            //     'type' => 'group',
            //     'group_title' => '單次購物訂單滿 [0] 元，可以使用 [1] 元折扣金',
            //     'explanation' => '本網站標題名稱將於網站標題最前端顯示',
            //     'child' => [
            //         [
            //             'title' => '網站標題引言',
            //             'type' => 'text',
            //             'placeholder' => '請輸入網站標題名稱',
            //             'explanation' => '本網站標題名稱將於網站標題最前端顯示',
            //             'set_rules' => 'required',
            //             'default_value' => '未設定',
            //             'modelname' => '',
            //             'name' => 'website_title_introduction'
            //         ],
            //         [
            //             'title' => '網站標題引言',
            //             'type' => 'text',
            //             'placeholder' => '請輸入網站標題名稱',
            //             'explanation' => '本網站標題名稱將於網站標題最前端顯示',
            //             'set_rules' => 'required',
            //             'default_value' => '未設定',
            //             'modelname' => '',
            //             'name' => 'website_title_introduction'
            //         ]
            //     ]
            // ]
        ]
    ],
    [
        'title' => '範例主題2',
        'subtitle' => '範例副標題2',
        'child' => [
            [
                'title' => '文字2',
                'type' => 'text',
                'placeholder' => '請輸入文字2',
                'explanation' => '請輸入文字2',
                'set_rules' => 'required',
                'default_value' => '',
                'modelname' => 'sample',
                'name' => 'sample_text2'
            ],
        ]
    ]
];