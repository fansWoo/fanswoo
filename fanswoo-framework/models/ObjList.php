<?php

class ObjList extends CI_Model {

    public $obj_Arr = array();
    public $child_value_Arr = array();
    public $db_uniqueid_Str = '';//填寫物件聯繫資料庫之唯一ID
    public $uniqueids_Arr = array();//物件ID之陣列
    public $uniqueids_Str = '';//物件ID之陣列字串組
    protected $db_where_Arr = array();
    protected $db_where_or_Arr = array();
    protected $db_where_like_Arr = array();
    protected $db_name_Str = '';
    protected $db_where_deletenull_Bln;
    protected $model_name_Str = '';
    protected $limitstart_Num = 0;
    protected $limitcount_Num = 1;
	
	public function construct($arg)
	{
        $construct_Arr = !empty($arg['construct_Arr']) ? $arg['construct_Arr'] : array() ;
        $model_name_Str = !empty($arg['model_name_Str']) ? $arg['model_name_Str'] : array() ;
        $deletestatus_Bln = isset($arg['deletestatus_Bln']) && $arg['deletestatus_Bln'] === TRUE ? TRUE : FALSE ;
        $deletelocale_Bln = isset($arg['deletelocale_Bln']) && $arg['deletelocale_Bln'] === TRUE ? TRUE : FALSE ;
        
        if(empty($model_name_Str))
        {
            $model_name_Str = $this->model_name_Str;
        }
        
        $model_Obj = new $model_name_Str;
        $db_uniqueid_Str = $model_Obj->db_uniqueid_Str;
        $db_uniqueid_Str = $db_uniqueid_Str.'_Num';
        $this->db_uniqueid_Str = $db_uniqueid_Str;

        if(!empty($construct_Arr))
        {
            foreach($construct_Arr as $key => $value_Arr)
            {
                $Model = new $model_name_Str;
                foreach($this->child_value_Arr as $key2 => $value2_Str)
                {
                    $Model->set($key2, $value2_Str);
                }

                if($deletelocale_Bln == TRUE)
                {
                    unset($value_Arr['locale_Str']);
                }
                else if( empty($value_Arr['locale_Str']) )
                {
                    if( isset( $model_Obj->locale_Str ) )
                    {
                        $this->load->library('i18n');
                        $locale_Str = $this->i18n->get_current_locale();
                        $value_Arr['locale_Str'] = $locale_Str;
                    }
                }

                if($deletestatus_Bln == TRUE)
                {
                    unset($value_Arr['status_Num']);
                }
                else if(empty($value_Arr['status_Num']))
                {
                    if( isset( $model_Obj->status_Num ) )
                    {
                        $value_Arr['status_Num'] = 1;
                    }
                }

                $Model->construct($value_Arr);
                $model_db_uniqueid_Str = $Model->$db_uniqueid_Str;
                $this->uniqueids_Arr[] = $model_db_uniqueid_Str;
                $db_objlist_key_Str = $Model->db_objlist_key_Str;
                if( !empty($Model->$db_objlist_key_Str) )
                {
                    $this->obj_Arr[$Model->$db_objlist_key_Str] = $Model;
                }
                else if(!empty($model_db_uniqueid_Str) && !is_numeric($model_db_uniqueid_Str))
                {
                    $this->obj_Arr[$model_db_uniqueid_Str] = $Model;
                }
                else
                {
                    $this->obj_Arr[] = $Model;
                }
            }
        }
        else
        {
            $this->obj_Arr = array();
            $this->obj_Arr[0] = new $model_name_Str;
            $this->obj_Arr[0]->construct(array());
            $this->uniqueids_Arr = array();
        }
        if(!empty($this->uniqueids_Arr) && is_array($this->uniqueids_Arr))
        {
            $this->uniqueids_Str = implode(',', $this->uniqueids_Arr);
        }
        
        return TRUE;
    }
    
	public function construct_db($arg)
    {
        if(is_array($arg))
        {
            $db_where_Arr = !empty($arg['db_where_Arr']) ? $arg['db_where_Arr'] : array();
            $db_where_or_Arr = !empty($arg['db_where_or_Arr']) ? $arg['db_where_or_Arr'] : array();
            $db_where_like_Arr = !empty($arg['db_where_like_Arr']) ? $arg['db_where_like_Arr'] : array();
            $db_where_deletenull_Bln = isset($arg['db_where_deletenull_Bln']) && $arg['db_where_deletenull_Bln'] === TRUE ? TRUE : FALSE ;
            $db_where_deletestatus_Bln = isset($arg['db_where_deletestatus_Bln']) && $arg['db_where_deletestatus_Bln'] === TRUE ? TRUE : FALSE ;
            $db_where_deletelocale_Bln = isset($arg['db_where_deletelocale_Bln']) && $arg['db_where_deletelocale_Bln'] === TRUE ? TRUE : FALSE ;
            $db_orderby_Arr = !empty($arg['db_orderby_Arr']) ? $arg['db_orderby_Arr'] : array();
            $model_name_Str = !empty($arg['model_name_Str']) ? $arg['model_name_Str'] : '' ;
            $limitstart_Num = !empty($arg['limitstart_Num']) ? $arg['limitstart_Num'] : 0;
            $limitcount_Num = !empty($arg['limitcount_Num']) ? $arg['limitcount_Num'] : 0;
            $limitcount_max_Bln = !empty($arg['limitcount_max_Bln']) ? $arg['limitcount_max_Bln'] : FALSE;
        }
        
        $limitstart_Num = !empty($limitstart_Num) ? $limitstart_Num : $this->limitstart_Num ;
        $limitcount_Num = !empty($limitcount_Num) ? $limitcount_Num : $this->limitcount_Num ;
        
        $model_Obj = new $model_name_Str;
        $db_uniqueid_Str = $model_Obj->db_uniqueid_Str;
        $this->db_uniqueid_Str = $db_uniqueid_Str;

        //取得類別資料庫名稱
        if(!empty($model_Obj->db_name_Arr))
        {
            $db_name_Str = $model_Obj->db_name_Arr[0];
        }
        else
        {
            $db_name_Str = $model_Obj->db_name_Str;
        }
        
        if($limitstart_Num < 1)
        {
            $limitstart_Num = 0;
        }
        
        if($limitcount_Num > 100 && $limitcount_max_Bln == FALSE)
        {
            $limitcount_Num = 100;
        }
        
//        $db_where_or_Arr結構示意圖
//        $db_where_or_Arr = array(
//            'picid' => array(
//                528501, 528502, 528503
//            ),
//            'uid' => array(
//                528501, 528502
//            )
//        );

        //若db_where_deletenull_Bln為真，則刪除db_where_Arr內為空值的搜尋條件
        if($db_where_deletenull_Bln)
        {
            foreach($db_where_Arr as $key => $value)
            {
                if(empty($value))
                {
                    unset($db_where_Arr[$key]);
                }
            }
            foreach($db_where_like_Arr as $key => $value)
            {
                if(empty($value))
                {
                    unset($db_where_like_Arr[$key]);
                }
            }
            foreach($db_where_or_Arr as $key => $value_Arr)
            {
                foreach($value_Arr as $key2 => $value2)
                {
                    if(empty($value2))
                    {
                        unset($db_where_or_Arr[$key][$key2]);
                    }
                }
                if(empty($db_where_or_Arr[$key]))
                {
                    unset($db_where_or_Arr[$key]);
                }
            }
        }

        //若「刪除空值」（$db_where_deletenull_Bln）選項開啟，則讀取搜尋條件為空之資料表；若選項未開啟，且其它db_where搜尋條件皆為空值，則不讀取資料庫取值
        if(
            $db_where_deletenull_Bln === FALSE &&
            empty($db_where_Arr) &&
            empty($db_where_like_Arr) &&
            empty($db_where_or_Arr)
        )
        {
            $this->db_where_Arr = $db_where_Arr;
            $this->db_where_or_Arr = $db_where_or_Arr;
            $this->db_where_like_Arr = $db_where_like_Arr;
            $this->db_name_Str = $db_name_Str;
            $this->model_name_Str = $model_name_Str;
            $this->limitcount_Num = $limitcount_Num;
            $this->limitstart_Num = $limitstart_Num;

            $this->construct(array());
            return FALSE;
        }

        $db_where_Arr = typekey_to_nokey($db_where_Arr);
        $db_where_or_Arr = typekey_to_nokey($db_where_or_Arr);
        $db_where_like_Arr = typekey_to_nokey($db_where_like_Arr);
        

        if($db_where_deletelocale_Bln == TRUE)
        {
            unset($db_where_Arr['locale']);
        }
        else if(empty($db_where_Arr['locale']))
        {
            if( isset( $model_Obj->locale_Str ) )
            {
                $this->load->library('i18n');
                $locale_Str = $this->i18n->get_current_locale();
                $db_where_Arr['locale'] = $locale_Str;
            }
        }

        if($db_where_deletestatus_Bln == TRUE)
        {
            unset($db_where_Arr['status']);
        }
        else if(empty($db_where_Arr['status']))
        {
            if( isset( $model_Obj->status_Num ) )
            {
                $db_where_Arr['status'] = 1;
            }
        }

        if(!empty($model_Obj->db_name_Arr))
        {
            foreach($model_Obj->db_name_Arr as $key => $value_Str)
            {
                if($key == 0)
                {
                    $this->db->from($value_Str);
                }
                else
                {
                    $this->db->join($value_Str, $model_Obj->db_name_Arr[0].'.'.$db_uniqueid_Str.' = '.$value_Str.'.'.$db_uniqueid_Str, 'left');
                }
            }
        }
        else
        {
            $this->db->from($db_name_Str);
        }

        if(!empty($db_where_or_Arr))
        {
            foreach($db_where_or_Arr as $key => $value_Arr)
            {
                foreach($value_Arr as $key2 => $value2)
                {
                    $value2 = trim($value2);
                    // $this->db->or_where(array($key => $value2));
                    $this->db->or_where("FIND_IN_SET('$value2', $key) !=", 0);
                    if(!empty($db_where_Arr))
                    {
                        foreach($db_where_Arr as $key3 => $value3)
                        {
                            if(is_array($value3))
                            {
                                foreach($value3 as $key4 => $value4)
                                {
                                    $this->db->where("FIND_IN_SET('$value4', $key4) !=", 0);
                                }
                            }
                            else
                            {
                                $this->db->where($key3, $value3);
                            }
                        }
                    }
                    if(!empty($db_where_like_Arr))
                    {
                        foreach($db_where_like_Arr as $key3 => $value3)
                        {
                            if(is_array($value3))
                            {
                                foreach($value3 as $key4 => $value4)
                                {
                                    $value2 = trim($value4);
                                    $this->db->like("FIND_IN_SET('$value4', $key4) !=", 0);
                                }
                            }
                            else
                            {
                                $value3 = trim($value4);
                                $this->db->like($key3, $value3);
                            }
                        }
                    }
                }
            }
        }
        else
        {
            if(!empty($db_where_Arr) && is_array($db_where_Arr))
            {
                foreach($db_where_Arr as $key => $value)
                {
                    if(!empty($model_Obj->db_name_Arr) && $key == 'status')
                    {
                        $this->db->where($model_Obj->db_name_Arr[0].'.'.$key, $value);
                    }
                    else if(is_array($value))
                    {
                        foreach($value as $key2 => $value2)
                        {
                            $this->db->where("FIND_IN_SET('$value2', $key2) !=", 0);
                        }
                    }
                    else
                    {
                        $this->db->where($key, $value);
                    }
                }
            }
            if(!empty($db_where_like_Arr) && is_array($db_where_like_Arr))
            {
                foreach($db_where_like_Arr as $key => $value)
                {
                    if(is_array($value))
                    {
                        foreach($value as $key2 => $value2)
                        {
                            $this->db->like("FIND_IN_SET('$value2', $key2) !=", 0);
                        }
                    }
                    else
                    {
                        $this->db->like($key, $value);
                    }
                }
            }
        }

        if(!empty($db_orderby_Arr))
        {
            //這個才是正確的推薦寫法
            if(is_array($db_orderby_Arr) && !is_array($db_orderby_Arr[0]) )
            {
                foreach($db_orderby_Arr as $key => $value)
                {
                    if( !empty($value) && !empty($value[0]) && is_array($value) )
                    {
                        $field_implode_Str = implode(", ", $value);
                        $this->db->order_by("field($key, $field_implode_Str)", NULL, FALSE);
                    }
                    else if( !empty($key) && !empty($value) && !is_array($value) )
                    {
                        $this->db->order_by($key, $value);
                    }
                }
            }
            //這段是舊的寫法，只是為了維持舊版相容性而暫時放錯誤的寫法
            else if(is_array($db_orderby_Arr[0]))
            {
                foreach($db_orderby_Arr as $key => $value)
                {
                    $this->db->order_by($value[0], $value[1]);
                }
            }
        }

        $this->db->limit($limitcount_Num, $limitstart_Num);
        $query = $this->db->get();
        $construct_Arr = $query->result_array();
        
        $this->db_where_Arr = $db_where_Arr;
        $this->db_where_or_Arr = $db_where_or_Arr;
        $this->db_where_like_Arr = $db_where_like_Arr;
        $this->db_name_Str = $db_name_Str;
        $this->db_where_deletenull_Bln = $db_where_deletenull_Bln;
        $this->model_name_Str = $model_name_Str;
        $this->limitcount_Num = $limitcount_Num;
        $this->limitstart_Num = $limitstart_Num;
        
        if(!empty($construct_Arr))
        {
            foreach($construct_Arr as $key => $value_Arr)
            {
                $construct2_Arr[] = nokey_to_typekey($value_Arr);
            }

            $this->construct(array(
                'construct_Arr' => $construct2_Arr
            ));
        }
    }

    public function set_child_value($arg)
    {
        $child_value_Arr = !empty($arg['child_value_Arr']) ? $arg['child_value_Arr'] : array();
        $this->child_value_Arr = $child_value_Arr;
    }
    
    public function create_links($arg)
    {
        $base_url_Str = !empty($arg['base_url_Str']) ? $arg['base_url_Str'] : '';
        
        $limitstart_Num = $this->limitstart_Num;
        $limitcount_Num = $this->limitcount_Num;
        $limitcount_Num = !empty($limitcount_Num) ? $limitcount_Num : 0 ;

        if(strpos($base_url_Str, '/?') > 0)
        {
            $base_url_Str = $base_url_Str.'&';
        }
        else
        {
            $base_url_Str = $base_url_Str.'/?';
        }
        
        $this->load->library('pagination');
        $config = array();
        $config['prev_tag_open'] = '<span class="prev">';
        $config['prev_tag_close'] = '</span>';
        $config['next_tag_open'] = '<span class="next">';
        $config['next_tag_close'] = '</span>';
        $config['first_tag_open'] = '<span class="first">';
        $config['first_tag_close'] = '</span>';
        $config['last_tag_open'] = '<span class="last">';
        $config['last_tag_close'] = '</span>';
        $config['base_url'] = $base_url_Str.'limitcount='.$limitcount_Num;
        $config['per_page'] = $limitcount_Num;
        $config['total_rows'] = $this->get_maxcount();
        $this->pagination->initialize($config); 
        $links_Html = $this->pagination->create_links();
        
        return $links_Html;
    }
    
    public function get_maxcount()
    {
        $db_name_Str = $this->db_name_Str;
        $db_where_Arr = $this->db_where_Arr;
        $db_where_like_Arr = $this->db_where_like_Arr;
        $db_where_or_Arr = $this->db_where_or_Arr;


        if(!empty($db_where_or_Arr) && is_array($db_where_or_Arr))
        {
            $this->db->from($db_name_Str);
            foreach($db_where_or_Arr as $key => $value_Arr)
            {
                foreach($value_Arr as $key2 => $value2)
                {
                    // $this->db->or_where(array($key => $value2));
                    $this->db->or_where("FIND_IN_SET('$value2', $key) !=", 0);
                    $this->db->where($db_where_Arr);
                    if(!empty($db_where_like_Arr))
                    {
                        $this->db->like($db_where_like_Arr);
                    }
                }
            }
        }
        else
        {
            $this->db->from($db_name_Str);
            $this->db->where($db_where_Arr);
            if(!empty($db_where_like_Arr))
            {
                $this->db->like($db_where_like_Arr);
            }
        }
        
        return $this->db->get()->num_rows();
    }

    public function update()
    {
        $obj_Arr = $this->obj_Arr;

        foreach($obj_Arr as $key => $value_Obj)
        {
            $value_Obj->update(array());
        }
    }
}