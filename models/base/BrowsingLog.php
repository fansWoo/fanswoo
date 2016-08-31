<?php

class BrowsingLog extends ObjDbBase
{
    public $db_name_arr = ['browsing_log'];//填寫物件聯繫資料庫之名稱
    public $db_uniqueid = 'browsing_logid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_arr = [//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'browsing_logid' => 'browsing_logid',
        'uid' => ['uid_User', 'uid'],
        'real_ip' => 'real_ip',
        'proxy_ip' => 'proxy_ip',
        'mac_addr' => 'mac_addr',
        'url' => 'url',
        'get_message' => 'get_message',
        'post_message' => 'post_message',
        'header_message' => 'header_message',
        'locale' => 'locale',
        'updatetime' => ['updatetime_DateTime', 'datetime'],
        'status' => 'status'
    ];
	
	public function construct($arg = [])
	{
        $this->set('browsing_logid', $arg['browsing_logid']);
        $this->set('real_ip', $arg['real_ip']);
        $this->set('proxy_ip', $arg['proxy_ip']);
        $this->set('mac_addr', $arg['mac_addr']);
        $this->set('get_message', $arg['get_message']);
        $this->set('post_message', $arg['post_message']);
        $this->set('header_message', $arg['header_message']);
        $this->set('updatetime_DateTime', [
            'datetime' => $arg['updatetime'],
            'inputtime_date' => $arg['updatetime_inputtime_date'],
            'inputtime_time' => $arg['updatetime_inputtime_time']
        ], 'DateTimeObj');
        $this->set__url(['url', $arg['url']]);
        $this->set__uid_User(['uid' => $arg['uid']]);
        $this->set__locale(['locale' => $arg['locale']]);
        $this->set__status(['status' => $arg['status']]);
        
        return TRUE;
    }

    public function set__url($arg = [])
    {
        if( empty($arg['url']) )
        {
            $this->set('url', uri_string() );
        }
        else
        {
            $this->set('url', $arg['url']);
        }
    }

    public function get_user_info()
    {
    	$this->real_ip = get_real_ip();
    	$this->proxy_ip = get_proxy_ip();
        $this->header_message = get_http_header();
        $this->get_message = json_encode( $this->input->get() );
        $this->post_message = json_encode( $this->input->post() );
        $this->mac_addr = get_mac_addr();
    }
	
}