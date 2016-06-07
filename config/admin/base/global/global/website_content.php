<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['setting_arr'] = [
    [
        'title' => '網站首頁',
        'subtitle' => '請填寫首頁之詳細資訊',
        'child' => [
            [
                'title' => '網站首頁圖片',
                'type' => 'text',
                'placeholder' => '請輸入網站標題名稱',
                'explanation' => '本網站標題名稱將於網站標題最前端顯示',
                'set_rules' => 'required',
                'default_value' => '',
                'modelname' => 'sample',
                'name' => 'sample_text'
            ],
            [
                'title' => '網站首頁圖片2',
                'type' => 'text',
                'placeholder' => '請輸入網站標題名稱',
                'explanation' => '本網站標題名稱將於網站標題最後端顯示',
                'set_rules' => '',
                'default_value' => '',
                'modelname' => 'sample',
                'name' => 'sample_text2'
            ]
        ]
    ]
];