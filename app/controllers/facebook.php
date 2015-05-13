<?php

class facebook extends CI_Controller {

    private $data = array();
    
	public function __construct(){
		parent::__construct();
        $this->data = $this->common_model->common();
	}
    
	public function index(){
        $data = $this->data;

		// 建立CURL連線
		// $ch = curl_init();

		// // 設定擷取的URL網址
		// curl_setopt($ch, CURLOPT_URL, "http://graph.facebook.com/1529686803975150/feed?fields=id,created_time&limit=250");
		// curl_setopt($ch, CURLOPT_HEADER, false);
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		// $feed_json_Str = curl_exec($ch);

		// foreach()
		// {
		// 	curl_setopt($ch, CURLOPT_URL, "http://graph.facebook.com/1582006402076523/likes?limit=1000");
		// 	curl_setopt($ch, CURLOPT_HEADER, false);
		// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		// 	sleep(1);
		// }

		// $json_Str = curl_exec($ch);

		// // 關閉CURL連線
		// curl_close($ch);

		// echo '<pre>';
		// print_r(json_decode($json_Str, TRUE));
		// echo '</pre>';
		// echo(json_decode'($json_Str));
		
		//輸出模板
		$this->load->view('facebook', $data);
	}
}

?>