<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['setting_arr'] = [
    [
        'title' => '網站標題管理',
        'subtitle' => '請填寫標題之詳細資訊',
        'child' => [
            [
                'title' => '網站標題名稱',
                'type' => 'text',
                'placeholder' => '請輸入網站標題名稱',
                'explanation' => '本網站標題名稱將於網站標題最前端顯示',
                'set_rules' => 'required',
                'default_value' => '',
                'modelname' => '',
                'name' => 'website_title_name'
            ],
            [
                'title' => '網站標題引言',
                'type' => 'text',
                'placeholder' => '請輸入網站標題引言',
                'explanation' => '本網站標題名稱將於網站標題最後端顯示',
                'set_rules' => 'required',
                'default_value' => '',
                'modelname' => '',
                'name' => 'website_title_introduction'
            ]
        ]
    ],
    [
        'title' => '註冊選項',
        'subtitle' => '請填寫註冊之詳細資訊',
        'child' => [
            [
                'title' => 'Google註冊驗證',
                'type' => 'checkbox',
                'child' => [
                    [
                        'title' => '開啟Google註冊驗證',
                        'set_rules' => '',
                        'default_value' => 0,
                        'modelname' => 'user_register',
                        'name' => 'google_recaptcha'
                    ]
                ],
                'explanation' => '開啟此值則註冊會員需先進行 Google 驗證，避免機器人海量註冊'
            ],
            [
                'title' => '註冊驗證信',
                'type' => 'checkbox',
                'child' => [
                    [
                        'title' => '開啟註冊驗證信',
                        'set_rules' => '',
                        'default_value' => 0,
                        'modelname' => 'user_register',
                        'name' => 'register_email'
                    ]
                ],
                'explanation' => '開啟此值則註冊會員需先進行 email 驗證'
            ]
        ]
    ],
    [
        'title' => '網站名稱設置',
        'subtitle' => '請填寫網站名稱及LOGO圖檔，此設置之設置將影響網站前台之顯示',
        'child' => [
            [
                'title' => '網站名稱',
                'type' => 'text',
                'placeholder' => '請輸入網站名稱',
                'explanation' => '',
                'set_rules' => 'required',
                'default_value' => '',
                'modelname' => '',
                'name' => 'website_name'
            ],
            [
                'title' => '網站LOGO圖檔',
                'type' => 'text',
                'placeholder' => '請輸入圖檔連結，http://',
                'explanation' => '請填寫圖檔位置，可以填寫本網站圖檔之相對位置，也可以填寫外網之絕對位置網址',
                'set_rules' => ['required', 'valid_url_pic'],
                'default_value' => '',
                'modelname' => '',
                'name' => 'website_logo'
            ]
        ]
    ],
    [
        'title' => '郵件SMTP系統設置',
        'subtitle' => '若本系統擁有SMTP寄件功能，此設置將影響網站SMTP之設定',
        'child' => [
            [
                'title' => '寄信郵件帳號',
                'type' => 'text',
                'placeholder' => '請輸入寄件郵件帳號',
                'explanation' => '',
                'set_rules' => ['required', 'valid_email'],
                'default_value' => '',
                'modelname' => 'smtp',
                'name' => 'smtp_account'
            ],
            [
                'title' => '寄信郵件密碼',
                'type' => 'password',
                'placeholder' => '請輸入寄件郵件密碼',
                'explanation' => '',
                'set_rules' => 'required',
                'default_value' => '',
                'modelname' => 'smtp',
                'name' => 'smtp_password'
            ],
            [
                'title' => '顯示郵件',
                'type' => 'text',
                'placeholder' => '請輸入顯示郵件',
                'explanation' => '',
                'set_rules' => ['required', 'valid_email'],
                'default_value' => '',
                'modelname' => 'smtp',
                'name' => 'smtp_email'
            ],
            [
                'title' => '顯示名稱',
                'type' => 'text',
                'placeholder' => '請輸入顯示名稱',
                'explanation' => '',
                'set_rules' => 'required',
                'default_value' => '',
                'modelname' => 'smtp',
                'name' => 'smtp_username'
            ],
            [
                'title' => 'SMTP Host',
                'type' => 'text',
                'placeholder' => '請輸入SMTP位置',
                'explanation' => '',
                'set_rules' => ['required', 'valid_url'],
                'default_value' => 'smtp.gmail.com',
                'modelname' => 'smtp',
                'name' => 'smtp_host'
            ],
            [
                'title' => 'SMTP SSL',
                'type' => 'checkbox',
                'child' => [
                    [
                        'title' => '連接SSL port 445',
                        'set_rules' => '',
                        'default_value' => 1,
                        'modelname' => 'smtp',
                        'name' => 'smtp_ssl_checkbox'
                    ]
                ],
                'explanation' => ''
            ]
        ]
    ]
];