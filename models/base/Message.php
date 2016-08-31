<?php

class Message extends CI_Model {

    private $data = [];

	public function show($arg = [])
	{
        $arg['second'] = !empty($arg['second']) ? $arg['second'] : 2 ;
        $arg['message'] = preg_replace('/\s/', ' ', $arg['message']);
        $fs_ajax_post = $this->input->post('fs_ajax_post');

        if( !empty($fs_ajax_post) )
        {
            //送出成功訊息
            $return_arr['message'] = $arg['message'];
            $return_arr['second'] = $arg['second'];
            $return_arr['response'] = $arg['response'];

            if( $arg['url'] !== FALSE || !isset($arg['url']) )
            {
                $return_arr['url'] = $arg['url'];

                if( 
                    stristr($arg['url'], 'http') ||
                    stristr( $arg['url'], base_url() )
                )
                {
                    $arg['url'] = $arg['url'];
                }
                else
                {
                    $arg['url'] = base_url( $arg['url'] );
                }
            }
            else
            {
                unset( $arg['url'] );
            }

            $return_Json = json_encode($return_arr, JSON_UNESCAPED_UNICODE);
            echo $return_Json;

            return TRUE;
        }
        else
        {
            //data
            $this->input->set_cookie([
                'name' => 'message_show_content',
                'value' => $arg['message'],
                'expire' => '60'
            ]);
            $this->input->set_cookie([
                'name' => 'message_show_second',
                'value' => $arg['second'],
                'expire' => '60'
            ]);

            if( empty( $arg['url'] ) )
            {
                header("Location: " . $_SERVER['HTTP_REFERER'] );
            }
            else if( 
                stristr( $arg['url'], 'http')
            )
            {
                header("Location: " . $arg['url'] );
            }
            else
            {
                header("Location: " . base_url( $arg['url'] ) );
            }
            return TRUE;
        }
	}
	
}